<?php

declare(strict_types=1);

namespace ElevenLabs\SpeechEngine;

use ElevenLabs\Types\SpeechEngineResponse;

/**
 * A handle to a Speech Engine instance, returned by `speechEngine.create()` /
 * `speechEngine.get()` once the root client is wired to return it.
 *
 * Use {@see serve()} to run a standalone WebSocket server for this engine, or
 * {@see createSession()} to drive a session over a connection you manage
 * yourself. {@see verifyRequest()} checks an inbound request's authorization
 * header when you handle the WebSocket upgrade.
 *
 * Hand-written (see `.fernignore`), mirroring `SpeechEngineResource` in the
 * Python/TS SDKs.
 */
final class SpeechEngineResource
{
  public function __construct(
    /** The speech engine ID. */
    public readonly string $engineId,
    private readonly ?string $apiKey = null,
    /** The full API response, or null when constructed without an API call. */
    public readonly ?SpeechEngineResponse $config = null,
  ) {
  }

  /**
   * Verify that an incoming request carries a valid Speech Engine authorization
   * JWT. Only needed when managing the WebSocket upgrade yourself; {@see serve()}
   * verifies automatically.
   *
   * @param array<string, string|list<string>> $headers Request headers (name => value); names are matched case-insensitively.
   */
  public function verifyRequest(array $headers): bool
  {
    if ($this->apiKey === null || $this->apiKey === '') {
      return false;
    }
    $value = null;
    foreach ($headers as $name => $v) {
      if (strcasecmp($name, 'X-ElevenLabs-Speech-Engine-Authorization') === 0) {
        $value = is_array($v) ? ($v[0] ?? null) : $v;
        break;
      }
    }
    if (!is_string($value) || $value === '') {
      return false;
    }
    try {
      SpeechEngineJwtVerifier::verify($value, $this->apiKey);
      return true;
    } catch (\Throwable) {
      return false;
    }
  }

  /**
   * Start a standalone WebSocket server for this engine. Blocks until stopped.
   * Verification uses the engine's API key unless `$disableAuth` is set.
   */
  public function serve(
    int $port = 3001,
    ?string $path = null,
    bool $debug = false,
    bool $disableAuth = false,
    ?\Closure $onInit = null,
    ?\Closure $onTranscript = null,
    ?\Closure $onClose = null,
    ?\Closure $onDisconnect = null,
    ?\Closure $onError = null,
  ): void {
    $handlers = array_filter([
      'onInit' => $onInit,
      'onTranscript' => $onTranscript,
      'onClose' => $onClose,
      'onDisconnect' => $onDisconnect,
      'onError' => $onError,
    ], static fn($h) => $h instanceof \Closure);

    (new SpeechEngineServer(
      port: $port,
      path: $path,
      apiKey: $this->apiKey,
      debug: $debug,
      disableAuth: $disableAuth,
      handlers: $handlers,
    ))->serve();
  }

  /**
   * Create a session over a connection you manage yourself (any transport).
   *
   * @param callable(string): void $send Writes a text frame to the connection.
   * @param ?callable(): void $close Closes the connection.
   */
  public function createSession(callable $send, ?callable $close = null, bool $debug = false): SpeechEngineSession
  {
    return new SpeechEngineSession($send, $close, $debug);
  }
}
