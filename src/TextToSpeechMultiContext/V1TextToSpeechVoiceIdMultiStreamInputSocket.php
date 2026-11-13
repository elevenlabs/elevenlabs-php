<?php

declare(strict_types=1);

namespace ElevenLabs\TextToSpeechMultiContext;

use ElevenLabs\Core\WebSocket\WebSocketSocket;

/**
 * @extends WebSocketSocket<\ElevenLabs\Types\FinalOutputMulti|\ElevenLabs\Types\AudioOutputMulti|array<mixed>|string>
 */
final class V1TextToSpeechVoiceIdMultiStreamInputSocket extends WebSocketSocket
{
  public function sendPublish(\ElevenLabs\Types\SendMessageMulti $message): void
  {
    $this->send($message);
  }

  /**
   * @return \ElevenLabs\Types\FinalOutputMulti|\ElevenLabs\Types\AudioOutputMulti|array<mixed>|string
   */
  protected function parse(string $text): mixed
  {
    $data = json_decode($text, true, 512, JSON_THROW_ON_ERROR);
    if (!is_array($data)) {
      return $text;
    }
    if (($data['is_final'] ?? null) === true) {
      return self::tryDeserialize(\ElevenLabs\Types\FinalOutputMulti::class, $data) ?? $data;
    }
    $message = self::tryDeserialize(\ElevenLabs\Types\AudioOutputMulti::class, $data);
    if ($message !== null) {
      return $message;
    }
    return $data;
  }
}
