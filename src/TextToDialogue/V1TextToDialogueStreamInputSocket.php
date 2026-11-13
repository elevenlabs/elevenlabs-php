<?php

declare(strict_types=1);

namespace ElevenLabs\TextToDialogue;

use ElevenLabs\Core\WebSocket\WebSocketSocket;

/**
 * @extends WebSocketSocket<\ElevenLabs\Types\Final_|\ElevenLabs\Types\AudioChunk|\ElevenLabs\Types\FinalAudioForTurn|\ElevenLabs\Types\Error|array<mixed>|string>
 */
final class V1TextToDialogueStreamInputSocket extends WebSocketSocket
{
  public function sendPublish(\ElevenLabs\Types\TextToDialogueClientMessage $message): void
  {
    $this->send($message);
  }

  /**
   * @return \ElevenLabs\Types\Final_|\ElevenLabs\Types\AudioChunk|\ElevenLabs\Types\FinalAudioForTurn|\ElevenLabs\Types\Error|array<mixed>|string
   */
  protected function parse(string $text): mixed
  {
    $data = json_decode($text, true, 512, JSON_THROW_ON_ERROR);
    if (!is_array($data)) {
      return $text;
    }
    if (($data['is_final'] ?? null) === true) {
      return self::tryDeserialize(\ElevenLabs\Types\Final_::class, $data) ?? $data;
    }
    $message = self::tryDeserialize(\ElevenLabs\Types\AudioChunk::class, $data);
    if ($message !== null) {
      return $message;
    }
    $message = self::tryDeserialize(\ElevenLabs\Types\FinalAudioForTurn::class, $data);
    if ($message !== null) {
      return $message;
    }
    $message = self::tryDeserialize(\ElevenLabs\Types\Error::class, $data);
    if ($message !== null) {
      return $message;
    }
    return $data;
  }
}
