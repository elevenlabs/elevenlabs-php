<?php

declare(strict_types=1);

namespace ElevenLabs\SpeechEngine;

use ElevenLabs\Core\WebSocket\WebSocketSocket;

/**
 * @extends WebSocketSocket<\ElevenLabs\Types\Init|\ElevenLabs\Types\UserTranscript|\ElevenLabs\Types\Ping|\ElevenLabs\Types\Close|\ElevenLabs\Types\SpeechEngineError|array<mixed>|string>
 */
final class SpeechEngineUpstreamSocket extends WebSocketSocket
{
  public function sendPublish(\ElevenLabs\Types\SendUpstreamMessage $message): void
  {
    $this->send($message);
  }

  /**
   * @return \ElevenLabs\Types\Init|\ElevenLabs\Types\UserTranscript|\ElevenLabs\Types\Ping|\ElevenLabs\Types\Close|\ElevenLabs\Types\SpeechEngineError|array<mixed>|string
   */
  protected function parse(string $text): mixed
  {
    $data = json_decode($text, true, 512, JSON_THROW_ON_ERROR);
    if (!is_array($data)) {
      return $text;
    }
    if (($data['type'] ?? null) === 'init') {
      return self::tryDeserialize(\ElevenLabs\Types\Init::class, $data) ?? $data;
    }
    if (($data['type'] ?? null) === 'user_transcript') {
      return self::tryDeserialize(\ElevenLabs\Types\UserTranscript::class, $data) ?? $data;
    }
    if (($data['type'] ?? null) === 'ping') {
      return self::tryDeserialize(\ElevenLabs\Types\Ping::class, $data) ?? $data;
    }
    if (($data['type'] ?? null) === 'close') {
      return self::tryDeserialize(\ElevenLabs\Types\Close::class, $data) ?? $data;
    }
    if (($data['type'] ?? null) === 'error') {
      return self::tryDeserialize(\ElevenLabs\Types\SpeechEngineError::class, $data) ?? $data;
    }
    return $data;
  }
}
