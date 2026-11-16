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
