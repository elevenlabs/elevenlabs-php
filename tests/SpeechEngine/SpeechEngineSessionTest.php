<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\SpeechEngine;

use ElevenLabs\SpeechEngine\ConversationMessage;
use ElevenLabs\SpeechEngine\SpeechEngineSession;
use PHPUnit\Framework\TestCase;

class SpeechEngineSessionTest extends TestCase
{
  /** @var list<string> */
  private array $sent = [];
  private bool $closed = false;

  private function session(bool $debug = false): SpeechEngineSession
  {
    $this->sent = [];
    $this->closed = false;
    return new SpeechEngineSession(
      send: function (string $text): void {
        $this->sent[] = $text;
      },
      close: function (): void {
        $this->closed = true;
      },
      debug: $debug,
    );
  }

  /** @return list<array<string, mixed>> */
  private function decodedSent(): array
  {
    return array_map(static fn(string $s): array => json_decode($s, true, 512, JSON_THROW_ON_ERROR), $this->sent);
  }

  public function testInitSetsConversationIdAndEmits(): void
  {
    $session = $this->session();
    $seen = null;
    $session->on('init', function (?string $id, SpeechEngineSession $s) use (&$seen): void {
      $seen = $id;
    });

    $session->handleRawMessage('{"type":"init","conversation_id":"conv_1"}');

    $this->assertSame('conv_1', $seen);
    $this->assertSame('conv_1', $session->conversationId());
  }

  public function testPingReceivesPong(): void
  {
    $session = $this->session();
    $session->handleRawMessage('{"type":"ping"}');
    $this->assertSame([['type' => 'pong']], $this->decodedSent());
  }

  public function testTranscriptDeliversMessagesAndStringResponse(): void
  {
    $session = $this->session();
    $received = null;
    $session->on('user_transcript', function (array $transcript, SpeechEngineSession $s) use (&$received): void {
      $received = $transcript;
      $s->sendResponse('hello there');
    });

    $session->handleRawMessage(
      '{"type":"user_transcript","event_id":7,"user_transcript":[{"role":"user","content":"hi"}]}'
    );

    $this->assertIsArray($received);
    $this->assertCount(1, $received);
    $this->assertInstanceOf(ConversationMessage::class, $received[0]);
    $this->assertSame('user', $received[0]->role);
    $this->assertSame('hi', $received[0]->content);

    $this->assertSame([
      ['type' => 'agent_response', 'content' => 'hello there', 'event_id' => 7, 'is_final' => false],
      ['type' => 'agent_response', 'content' => '', 'event_id' => 7, 'is_final' => true],
    ], $this->decodedSent());
  }

  public function testStreamedResponseSendsChunksThenFinal(): void
  {
    $session = $this->session();
    $session->on('user_transcript', function (array $t, SpeechEngineSession $s): void {
      $s->sendResponse(['foo', '', 'bar']); // empty chunk is skipped
    });

    $session->handleRawMessage('{"type":"user_transcript","event_id":3,"user_transcript":[]}');

    $this->assertSame([
      ['type' => 'agent_response', 'content' => 'foo', 'event_id' => 3, 'is_final' => false],
      ['type' => 'agent_response', 'content' => 'bar', 'event_id' => 3, 'is_final' => false],
      ['type' => 'agent_response', 'content' => '', 'event_id' => 3, 'is_final' => true],
    ], $this->decodedSent());
  }

  public function testStreamedResponseExtractsOpenAiChatChunks(): void
  {
    $session = $this->session();
    $session->on('user_transcript', function (array $t, SpeechEngineSession $s): void {
      $s->sendResponse([
        ['choices' => [['delta' => ['content' => 'Hel']]]],
        ['choices' => [['delta' => ['content' => 'lo']]]],
      ]);
    });

    $session->handleRawMessage('{"type":"user_transcript","event_id":1,"user_transcript":[]}');

    $contents = array_column($this->decodedSent(), 'content');
    $this->assertSame(['Hel', 'lo', ''], $contents);
  }

  public function testSendResponseOutsideHandlerIsSuppressed(): void
  {
    $session = $this->session();
    $session->sendResponse('nope');
    $this->assertSame([], $this->sent);
  }

  public function testCloseMessageEmitsCloseAndClosesSession(): void
  {
    $session = $this->session();
    $closedEvent = false;
    $session->on('close', function (SpeechEngineSession $s) use (&$closedEvent): void {
      $closedEvent = true;
    });

    $session->handleRawMessage('{"type":"close"}');

    $this->assertTrue($closedEvent);
    $this->assertFalse($session->isOpen());
    $this->assertTrue($this->closed, 'protocol close must shut the transport down');
  }

  public function testCloseHandlerCanCloseTheTransportItself(): void
  {
    $session = $this->session();
    $session->on('close', function (SpeechEngineSession $s): void {
      // The session is still open while the handler runs, so this close()
      // actually shuts the transport down rather than being a no-op.
      $this->assertTrue($s->isOpen());
      $s->close();
    });

    $session->handleRawMessage('{"type":"close"}');

    $this->assertTrue($this->closed);
    $this->assertFalse($session->isOpen());
  }

  public function testSendFailureMarksDisconnectedAndEmitsError(): void
  {
    $this->sent = [];
    $this->closed = false;
    $attempts = 0;
    $session = new SpeechEngineSession(
      send: function (string $text) use (&$attempts): void {
        $attempts++;
        throw new \RuntimeException('socket gone');
      },
      close: function (): void {
        $this->closed = true;
      },
    );

    $disconnected = 0;
    $error = null;
    $session->on('disconnected', function (SpeechEngineSession $s) use (&$disconnected): void {
      $disconnected++;
    });
    $session->on('error', function (\Throwable $e, SpeechEngineSession $s) use (&$error): void {
      $error = $e;
    });
    $session->on('user_transcript', function (array $t, SpeechEngineSession $s): void {
      // A multi-chunk stream: the first write fails, so the rest must not be consumed.
      $s->sendResponse(['one', 'two', 'three']);
    });

    $session->handleRawMessage('{"type":"user_transcript","event_id":1,"user_transcript":[]}');

    $this->assertSame(1, $attempts, 'the stream must stop after the first failed write');
    $this->assertSame(1, $disconnected);
    $this->assertInstanceOf(\Throwable::class, $error);
    $this->assertSame('socket gone', $error->getMessage());
    $this->assertFalse($session->isOpen());
  }

  public function testFailedWriteStopsConsumingTheResponseGenerator(): void
  {
    $session = new SpeechEngineSession(
      send: function (string $text): void {
        throw new \RuntimeException('socket gone'); // the first write fails
      },
      close: function (): void {},
    );

    $resumed = 0;
    $generator = (function () use (&$resumed): \Generator {
      $resumed++;
      yield 'first';
      // Reaching here means the generator was advanced after the failed write — for a
      // network-backed stream that advance would block the synchronous server.
      $resumed++;
      yield 'second';
    })();

    $session->on('user_transcript', function (array $t, SpeechEngineSession $s) use ($generator): void {
      $s->sendResponse($generator);
    });

    $session->handleRawMessage('{"type":"user_transcript","event_id":1,"user_transcript":[]}');

    $this->assertSame(1, $resumed, 'the generator must not be advanced after a failed write');
    $this->assertFalse($session->isOpen());
  }

  public function testFramesAfterCloseAreIgnored(): void
  {
    $session = $this->session();
    $invoked = false;
    $session->on('user_transcript', function (array $t, SpeechEngineSession $s) use (&$invoked): void {
      $invoked = true;
    });

    $session->close();
    // A buffered frame delivered during shutdown must not reach a handler.
    $session->handleRawMessage('{"type":"user_transcript","event_id":1,"user_transcript":[]}');

    $this->assertFalse($invoked, 'frames arriving after close must be ignored');
  }

  public function testEncodingFailureEmitsErrorButKeepsSessionOpen(): void
  {
    $session = $this->session();
    $error = null;
    $disconnected = 0;
    $session->on('error', function (\Throwable $e, SpeechEngineSession $s) use (&$error): void {
      $error = $e;
    });
    $session->on('disconnected', function (SpeechEngineSession $s) use (&$disconnected): void {
      $disconnected++;
    });
    $session->on('user_transcript', function (array $t, SpeechEngineSession $s): void {
      // The middle chunk is invalid UTF-8, so json_encode throws for it; the
      // session must stay open and keep delivering the surrounding chunks.
      $s->sendResponse(['before', "\xB1\x31", 'after']);
    });

    $session->handleRawMessage('{"type":"user_transcript","event_id":1,"user_transcript":[]}');

    $this->assertInstanceOf(\JsonException::class, $error);
    $this->assertSame(0, $disconnected, 'an encoding failure is not a transport disconnect');
    $this->assertTrue($session->isOpen());
    $contents = array_column($this->decodedSent(), 'content');
    $this->assertSame(['before', 'after', ''], $contents);
  }

  public function testErrorMessageEmitsError(): void
  {
    $session = $this->session();
    $err = null;
    $session->on('error', function (\Throwable $e, SpeechEngineSession $s) use (&$err): void {
      $err = $e;
    });

    $session->handleRawMessage('{"type":"error","message":"boom"}');

    $this->assertInstanceOf(\Throwable::class, $err);
    $this->assertSame('boom', $err->getMessage());
  }

  public function testMalformedJsonEmitsError(): void
  {
    $session = $this->session();
    $err = null;
    $session->on('error', function (\Throwable $e, SpeechEngineSession $s) use (&$err): void {
      $err = $e;
    });

    $session->handleRawMessage('{not json');

    $this->assertInstanceOf(\Throwable::class, $err);
  }

  public function testCloseInvokesCloseCallback(): void
  {
    $session = $this->session();
    $this->assertTrue($session->isOpen());

    $session->close();

    $this->assertTrue($this->closed);
    $this->assertFalse($session->isOpen());
  }

  public function testTransportDisconnectEmitsDisconnectedOnce(): void
  {
    $session = $this->session();
    $count = 0;
    $session->on('disconnected', function (SpeechEngineSession $s) use (&$count): void {
      $count++;
    });

    $session->handleDisconnect();
    $session->handleDisconnect();

    $this->assertSame(1, $count);
    $this->assertFalse($session->isOpen());
  }
}
