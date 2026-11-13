<?php

declare(strict_types=1);

namespace ElevenLabs\TextToDialogueMultiContext;

use ElevenLabs\Core\WebSocket\WebSocketSocket;

/**
 * @extends WebSocketSocket<\ElevenLabs\Types\FinalMulti|\ElevenLabs\Types\AudioChunkMulti|\ElevenLabs\Types\FinalAudioForTurnMulti|\ElevenLabs\Types\Error|array<mixed>|string>
 */
final class V1TextToDialogueMultiStreamInputSocket extends WebSocketSocket
{
  public function sendPublish(\ElevenLabs\Types\TextToDialogueMultiClientMessage $message): void
  {
    $this->send($message);
  }

  /**
   * @return \ElevenLabs\Types\FinalMulti|\ElevenLabs\Types\AudioChunkMulti|\ElevenLabs\Types\FinalAudioForTurnMulti|\ElevenLabs\Types\Error|array<mixed>|string
   */
  protected function parse(string $text): mixed
  {
    $data = json_decode($text, true, 512, JSON_THROW_ON_ERROR);
    if (!is_array($data)) {
      return $text;
    }
    if (($data['is_final'] ?? null) === true) {
      return self::tryDeserialize(\ElevenLabs\Types\FinalMulti::class, $data) ?? $data;
    }
    $message = self::tryDeserialize(\ElevenLabs\Types\AudioChunkMulti::class, $data);
    if ($message !== null) {
      return $message;
    }
    $message = self::tryDeserialize(\ElevenLabs\Types\FinalAudioForTurnMulti::class, $data);
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
