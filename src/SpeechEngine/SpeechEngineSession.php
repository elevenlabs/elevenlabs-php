<?php

declare(strict_types=1);

namespace ElevenLabs\SpeechEngine;

/**
 * One Speech Engine conversation over a single WebSocket connection.
 *
 * The session is transport-agnostic: it is handed a `$send` callable that writes
 * a text frame and a `$close` callable that closes the connection, so the same
 * protocol logic drives the bundled {@see SpeechEngineServer} and any custom
 * integration. Feed inbound frames to {@see handleRawMessage()}; register
 * handlers with {@see on()}.
 *
 * Hand-written (see `.fernignore`), mirroring `SpeechEngineSession` in the
 * Python/TS SDKs. One behavioural difference: PHP's server runs synchronously,
 * so there is no task cancellation — a new user transcript does not interrupt an
 * in-flight response handler the way it does in the async Node/Python SDKs.
 * Events: `init` ($conversationId, $session), `user_transcript`
 * (ConversationMessage[] $transcript, $session), `close` ($session),
 * `disconnected` ($session), `error` (\Throwable $error, $session).
 */
final class SpeechEngineSession
{
  /** @var array<string, list<\Closure>> */
  private array $handlers = [];

  private ?string $conversationId = null;
  private ?int $currentEventId = null;
  private bool $inTranscriptHandler = false;
  private bool $closed = false;

  /** @var \Closure(string): void */
  private readonly \Closure $send;
  /** @var \Closure(): void */
  private readonly \Closure $closeConnection;
  /** @var \Closure(string): void */
  private readonly \Closure $log;

  /**
   * @param callable(string): void $send Writes a text frame to the connection.
   * @param ?callable(): void $close Closes the connection. No-op if omitted.
   */
  public function __construct(callable $send, ?callable $close = null, bool $debug = false)
  {
    $this->send = \Closure::fromCallable($send);
    $this->closeConnection = $close !== null ? \Closure::fromCallable($close) : static fn() => null;
    $this->log = $debug
      ? static fn(string $m) => error_log("[SpeechEngine] {$m}")
      : static fn(string $m) => null;
  }

  /**
   * Register a handler for an event. Returns $this for chaining.
   */
  public function on(string $event, callable $handler): self
  {
    $this->handlers[$event][] = \Closure::fromCallable($handler);
    return $this;
  }

  /** The conversation ID assigned by the API, available after the `init` event. */
  public function conversationId(): ?string
  {
    return $this->conversationId;
  }

  /** Whether the session is still open. */
  public function isOpen(): bool
  {
    return !$this->closed;
  }

  /**
   * Parse and dispatch one inbound text frame. Malformed frames surface on the
   * `error` event rather than throwing, so one bad message never ends the loop.
   */
  public function handleRawMessage(string $raw): void
  {
    try {
      $msg = json_decode($raw, true, 512, JSON_THROW_ON_ERROR);
    } catch (\JsonException $e) {
      $this->emit('error', $e);
      return;
    }
    if (!is_array($msg)) {
      $this->emit('error', new \RuntimeException('Expected a JSON object message'));
      return;
    }
    $this->handleMessage($msg);
  }

  /**
   * Send an LLM response back for TTS synthesis. Accepts a plain string or an
   * iterable of chunks (strings, or OpenAI/Anthropic/Gemini stream events —
   * text is auto-extracted). Only valid inside an `on('user_transcript')`
   * handler; called elsewhere it warns and does nothing.
   *
   * @param string|iterable<mixed> $response
   */
  public function sendResponse(string|iterable $response): void
  {
    if ($this->closed) {
      throw new \RuntimeException('Cannot send response: session is closed');
    }
    if (!$this->inTranscriptHandler) {
      error_log(
        '[SpeechEngine] sendResponse() called outside an on(\'user_transcript\') handler; '
          . 'responses can only be sent in reply to a user transcript. To have the agent speak '
          . 'first, set a first message in your Speech Engine conversation config.'
      );
      return;
    }

    $eventId = $this->currentEventId;
    if (is_string($response)) {
      $this->sendAgentResponse($response, false, $eventId);
      $this->sendAgentResponse('', true, $eventId);
      return;
    }

    foreach ($response as $chunk) {
      if ($this->closed) {
        return;
      }
      $text = self::extractText($chunk);
      if ($text !== null && $text !== '') {
        $this->sendAgentResponse($text, false, $eventId);
      }
    }
    if (!$this->closed) {
      $this->sendAgentResponse('', true, $eventId);
    }
  }

  /**
   * Notify the session that the underlying connection dropped at the transport
   * level. Fires `disconnected` once. Called by {@see SpeechEngineServer}; not
   * needed when driving the session yourself through {@see handleRawMessage()}.
   */
  public function handleDisconnect(): void
  {
    if ($this->closed) {
      return;
    }
    $this->closed = true;
    $this->emit('disconnected');
  }

  /** Close the session and its underlying connection. */
  public function close(): void
  {
    if ($this->closed) {
      return;
    }
    $this->closed = true;
    ($this->closeConnection)();
  }

  /**
   * @param array<string, mixed> $msg
   */
  private function handleMessage(array $msg): void
  {
    switch ($msg['type'] ?? null) {
      case 'init':
        $this->conversationId = is_string($msg['conversation_id'] ?? null) ? $msg['conversation_id'] : null;
        ($this->log)("session initialized, conversation_id={$this->conversationId}");
        $this->emit('init', $this->conversationId);
        break;

      case 'user_transcript':
        $this->currentEventId = is_int($msg['event_id'] ?? null) ? $msg['event_id'] : null;
        $raw = $msg['user_transcript'] ?? [];
        $transcript = [];
        if (is_array($raw)) {
          foreach ($raw as $m) {
            if (is_array($m) && isset($m['role'], $m['content']) && is_string($m['role']) && is_string($m['content'])) {
              $transcript[] = new ConversationMessage($m['role'], $m['content']);
            }
          }
        }
        $this->inTranscriptHandler = true;
        try {
          $this->emit('user_transcript', $transcript);
        } finally {
          $this->inTranscriptHandler = false;
        }
        break;

      case 'ping':
        $this->sendJson(['type' => 'pong']);
        break;

      case 'close':
        // Emit before closing so a `close` handler still sees an open session
        // and can call close() itself; close() then shuts the transport down
        // (and is idempotent, so the explicit call here is a safe no-op after).
        $this->emit('close');
        $this->close();
        break;

      case 'error':
        $message = is_string($msg['message'] ?? null) ? $msg['message'] : '';
        $this->emit('error', new \RuntimeException($message));
        break;

      // Unknown types are ignored for forward compatibility.
    }
  }

  private function sendAgentResponse(string $content, bool $isFinal, ?int $eventId): void
  {
    $this->sendJson([
      'type' => 'agent_response',
      'content' => $content,
      'event_id' => $eventId,
      'is_final' => $isFinal,
    ]);
  }

  /**
   * @param array<string, mixed> $msg
   */
  private function sendJson(array $msg): void
  {
    if ($this->closed) {
      return;
    }
    try {
      $encoded = json_encode($msg, JSON_THROW_ON_ERROR);
    } catch (\JsonException $e) {
      // Encoding failure is a bug in the payload, not a dropped connection:
      // surface it and keep the session open.
      $this->emit('error', $e);
      return;
    }
    try {
      ($this->send)($encoded);
    } catch (\Throwable $e) {
      // The transport write failed, so the connection is gone. Mark the
      // session disconnected (this also stops sendResponse() from consuming
      // the rest of the LLM stream, which the synchronous server cannot
      // otherwise detect mid-handler) and surface the cause.
      $this->handleDisconnect();
      $this->emit('error', $e);
    }
  }

  private function emit(string $event, mixed ...$args): void
  {
    foreach ($this->handlers[$event] ?? [] as $handler) {
      try {
        $handler(...$args, ...[$this]);
      } catch (\Throwable $e) {
        if ($event !== 'error') {
          $this->emit('error', $e);
        } else {
          error_log('[SpeechEngine] unhandled error in error handler: ' . $e->getMessage());
        }
      }
    }
  }

  /**
   * Extract text from one LLM stream chunk. Handles plain strings and the common
   * streaming shapes (as associative arrays): OpenAI Responses
   * (`response.output_text.delta`), OpenAI Chat Completions
   * (`choices[0].delta.content`), Anthropic (`content_block_delta` /
   * `text_delta`), and Google Gemini (text parts of `candidates[0].content.parts`).
   */
  private static function extractText(mixed $chunk): ?string
  {
    if (is_string($chunk)) {
      return $chunk;
    }
    if (!is_array($chunk)) {
      return null;
    }

    // OpenAI Responses API
    if (($chunk['type'] ?? null) === 'response.output_text.delta' && is_string($chunk['delta'] ?? null)) {
      return $chunk['delta'];
    }

    // OpenAI Chat Completions API
    $choices = $chunk['choices'] ?? null;
    if (is_array($choices) && isset($choices[0]) && is_array($choices[0])) {
      $content = $choices[0]['delta']['content'] ?? null;
      if (is_string($content)) {
        return $content;
      }
    }

    // Anthropic Messages API
    if (($chunk['type'] ?? null) === 'content_block_delta') {
      $delta = $chunk['delta'] ?? null;
      if (is_array($delta) && ($delta['type'] ?? null) === 'text_delta' && is_string($delta['text'] ?? null)) {
        return $delta['text'];
      }
    }

    // Google Gemini API
    $candidates = $chunk['candidates'] ?? null;
    if (is_array($candidates) && isset($candidates[0]) && is_array($candidates[0])) {
      $parts = $candidates[0]['content']['parts'] ?? null;
      if (is_array($parts)) {
        $texts = [];
        foreach ($parts as $part) {
          if (is_array($part) && ($part['thought'] ?? null) !== true && is_string($part['text'] ?? null)) {
            $texts[] = $part['text'];
          }
        }
        if ($texts !== []) {
          return implode('', $texts);
        }
      }
    }

    return null;
  }
}
