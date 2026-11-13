<?php

declare(strict_types=1);

namespace ElevenLabs\Dubbing;

use ElevenLabs\Core\WebSocket\WebSocketSocket;

/**
 * @extends WebSocketSocket<\ElevenLabs\Types\DubbingSessionStarted|\ElevenLabs\Types\DubbingStatus|\ElevenLabs\Types\DubbingPartialTranscript|\ElevenLabs\Types\DubbingCommittedTranscript|\ElevenLabs\Types\DubbingTranslation|\ElevenLabs\Types\DubbingAudio|\ElevenLabs\Types\DubbingErrorPayload|\ElevenLabs\Types\DubbingAuthError|\ElevenLabs\Types\DubbingRateLimitedError|\ElevenLabs\Types\DubbingQueueOverflowError|\ElevenLabs\Types\DubbingInvalidRequestError|\ElevenLabs\Types\DubbingInputError|\ElevenLabs\Types\DubbingTranscriberError|\ElevenLabs\Types\DubbingTranslationError|\ElevenLabs\Types\DubbingAudioOutputError|array<mixed>|string>
 */
final class V1DubbingLiveSocket extends WebSocketSocket
{
  public function sendPublish(\ElevenLabs\Types\SendDubbingStreamMessage $message): void
  {
    $this->send($message);
  }

  /**
   * @return \ElevenLabs\Types\DubbingSessionStarted|\ElevenLabs\Types\DubbingStatus|\ElevenLabs\Types\DubbingPartialTranscript|\ElevenLabs\Types\DubbingCommittedTranscript|\ElevenLabs\Types\DubbingTranslation|\ElevenLabs\Types\DubbingAudio|\ElevenLabs\Types\DubbingErrorPayload|\ElevenLabs\Types\DubbingAuthError|\ElevenLabs\Types\DubbingRateLimitedError|\ElevenLabs\Types\DubbingQueueOverflowError|\ElevenLabs\Types\DubbingInvalidRequestError|\ElevenLabs\Types\DubbingInputError|\ElevenLabs\Types\DubbingTranscriberError|\ElevenLabs\Types\DubbingTranslationError|\ElevenLabs\Types\DubbingAudioOutputError|array<mixed>|string
   */
  protected function parse(string $text): mixed
  {
    $data = json_decode($text, true, 512, JSON_THROW_ON_ERROR);
    if (!is_array($data)) {
      return $text;
    }
    if (($data['message_type'] ?? null) === 'session_started') {
      return self::tryDeserialize(\ElevenLabs\Types\DubbingSessionStarted::class, $data) ?? $data;
    }
    if (($data['message_type'] ?? null) === 'status') {
      return self::tryDeserialize(\ElevenLabs\Types\DubbingStatus::class, $data) ?? $data;
    }
    if (($data['message_type'] ?? null) === 'partial_transcript') {
      return self::tryDeserialize(\ElevenLabs\Types\DubbingPartialTranscript::class, $data) ??
        $data;
    }
    if (($data['message_type'] ?? null) === 'committed_transcript') {
      return self::tryDeserialize(\ElevenLabs\Types\DubbingCommittedTranscript::class, $data) ??
        $data;
    }
    if (($data['message_type'] ?? null) === 'translation') {
      return self::tryDeserialize(\ElevenLabs\Types\DubbingTranslation::class, $data) ?? $data;
    }
    if (($data['message_type'] ?? null) === 'audio') {
      return self::tryDeserialize(\ElevenLabs\Types\DubbingAudio::class, $data) ?? $data;
    }
    if (($data['message_type'] ?? null) === 'error') {
      return self::tryDeserialize(\ElevenLabs\Types\DubbingErrorPayload::class, $data) ?? $data;
    }
    if (($data['message_type'] ?? null) === 'auth_error') {
      return self::tryDeserialize(\ElevenLabs\Types\DubbingAuthError::class, $data) ?? $data;
    }
    if (($data['message_type'] ?? null) === 'rate_limited') {
      return self::tryDeserialize(\ElevenLabs\Types\DubbingRateLimitedError::class, $data) ?? $data;
    }
    if (($data['message_type'] ?? null) === 'queue_overflow') {
      return self::tryDeserialize(\ElevenLabs\Types\DubbingQueueOverflowError::class, $data) ??
        $data;
    }
    if (($data['message_type'] ?? null) === 'invalid_request') {
      return self::tryDeserialize(\ElevenLabs\Types\DubbingInvalidRequestError::class, $data) ??
        $data;
    }
    if (($data['message_type'] ?? null) === 'input_error') {
      return self::tryDeserialize(\ElevenLabs\Types\DubbingInputError::class, $data) ?? $data;
    }
    if (($data['message_type'] ?? null) === 'transcriber_error') {
      return self::tryDeserialize(\ElevenLabs\Types\DubbingTranscriberError::class, $data) ?? $data;
    }
    if (($data['message_type'] ?? null) === 'translation_error') {
      return self::tryDeserialize(\ElevenLabs\Types\DubbingTranslationError::class, $data) ?? $data;
    }
    if (($data['message_type'] ?? null) === 'audio_output_error') {
      return self::tryDeserialize(\ElevenLabs\Types\DubbingAudioOutputError::class, $data) ?? $data;
    }
    return $data;
  }
}
