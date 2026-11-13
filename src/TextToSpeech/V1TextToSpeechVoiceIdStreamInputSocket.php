<?php

declare(strict_types=1);

namespace ElevenLabs\TextToSpeech;

use ElevenLabs\Core\WebSocket\WebSocketSocket;

/**
 * @extends WebSocketSocket<\ElevenLabs\Types\FinalOutput|\ElevenLabs\Types\AudioOutput|array<mixed>|string>
 */
final class V1TextToSpeechVoiceIdStreamInputSocket extends WebSocketSocket
{
  public function sendPublish(\ElevenLabs\Types\SendMessage $message): void
  {
    $this->send($message);
  }

  /**
   * @return \ElevenLabs\Types\FinalOutput|\ElevenLabs\Types\AudioOutput|array<mixed>|string
   */
  protected function parse(string $text): mixed
  {
    $data = json_decode($text, true, 512, JSON_THROW_ON_ERROR);
    if (!is_array($data)) {
      return $text;
    }
    if (($data['is_final'] ?? null) === true) {
      return self::tryDeserialize(\ElevenLabs\Types\FinalOutput::class, $data) ?? $data;
    }
    $message = self::tryDeserialize(\ElevenLabs\Types\AudioOutput::class, $data);
    if ($message !== null) {
      return $message;
    }
    return $data;
  }
}
