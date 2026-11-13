<?php

declare(strict_types=1);

namespace ElevenLabs\Translation;

use ElevenLabs\Core\WebSocket\WebSocketSocket;

/**
 * @extends WebSocketSocket<\ElevenLabs\Types\TranslateSessionStarted|\ElevenLabs\Types\TranslateStatus|\ElevenLabs\Types\TranslatePartialTranscript|\ElevenLabs\Types\TranslateFinalTranscript|\ElevenLabs\Types\TranslateTranslation|\ElevenLabs\Types\TranslateAudio|\ElevenLabs\Types\TranslateError|\ElevenLabs\Types\TranslateAuthError|\ElevenLabs\Types\TranslateRateLimitedError|\ElevenLabs\Types\TranslateQueueOverflowError|\ElevenLabs\Types\TranslateInputError|\ElevenLabs\Types\TranslateTranscriberError|\ElevenLabs\Types\TranslateTranslationError|\ElevenLabs\Types\TranslateAudioOutputError|\ElevenLabs\Types\TranslateQuotaExceededError|\ElevenLabs\Types\TranslatePaymentIssueError|\ElevenLabs\Types\TranslateUnacceptedTermsError|array<mixed>|string>
 */
final class V1TranslationRealtimeSocket extends WebSocketSocket
{
  public function sendPublish(\ElevenLabs\Types\SendTranslateStreamMessage $message): void
  {
    $this->send($message);
  }

  /**
   * @return \ElevenLabs\Types\TranslateSessionStarted|\ElevenLabs\Types\TranslateStatus|\ElevenLabs\Types\TranslatePartialTranscript|\ElevenLabs\Types\TranslateFinalTranscript|\ElevenLabs\Types\TranslateTranslation|\ElevenLabs\Types\TranslateAudio|\ElevenLabs\Types\TranslateError|\ElevenLabs\Types\TranslateAuthError|\ElevenLabs\Types\TranslateRateLimitedError|\ElevenLabs\Types\TranslateQueueOverflowError|\ElevenLabs\Types\TranslateInputError|\ElevenLabs\Types\TranslateTranscriberError|\ElevenLabs\Types\TranslateTranslationError|\ElevenLabs\Types\TranslateAudioOutputError|\ElevenLabs\Types\TranslateQuotaExceededError|\ElevenLabs\Types\TranslatePaymentIssueError|\ElevenLabs\Types\TranslateUnacceptedTermsError|array<mixed>|string
   */
  protected function parse(string $text): mixed
  {
    $data = json_decode($text, true, 512, JSON_THROW_ON_ERROR);
    if (!is_array($data)) {
      return $text;
    }
    if (($data['message_type'] ?? null) === 'session_started') {
      return self::tryDeserialize(\ElevenLabs\Types\TranslateSessionStarted::class, $data) ?? $data;
    }
    if (($data['message_type'] ?? null) === 'status') {
      return self::tryDeserialize(\ElevenLabs\Types\TranslateStatus::class, $data) ?? $data;
    }
    if (($data['message_type'] ?? null) === 'partial_transcript') {
      return self::tryDeserialize(\ElevenLabs\Types\TranslatePartialTranscript::class, $data) ??
        $data;
    }
    if (($data['message_type'] ?? null) === 'final_transcript') {
      return self::tryDeserialize(\ElevenLabs\Types\TranslateFinalTranscript::class, $data) ??
        $data;
    }
    if (($data['message_type'] ?? null) === 'translation') {
      return self::tryDeserialize(\ElevenLabs\Types\TranslateTranslation::class, $data) ?? $data;
    }
    if (($data['message_type'] ?? null) === 'audio') {
      return self::tryDeserialize(\ElevenLabs\Types\TranslateAudio::class, $data) ?? $data;
    }
    if (($data['message_type'] ?? null) === 'error') {
      return self::tryDeserialize(\ElevenLabs\Types\TranslateError::class, $data) ?? $data;
    }
    if (($data['message_type'] ?? null) === 'auth_error') {
      return self::tryDeserialize(\ElevenLabs\Types\TranslateAuthError::class, $data) ?? $data;
    }
    if (($data['message_type'] ?? null) === 'rate_limited') {
      return self::tryDeserialize(\ElevenLabs\Types\TranslateRateLimitedError::class, $data) ??
        $data;
    }
    if (($data['message_type'] ?? null) === 'queue_overflow') {
      return self::tryDeserialize(\ElevenLabs\Types\TranslateQueueOverflowError::class, $data) ??
        $data;
    }
    if (($data['message_type'] ?? null) === 'input_error') {
      return self::tryDeserialize(\ElevenLabs\Types\TranslateInputError::class, $data) ?? $data;
    }
    if (($data['message_type'] ?? null) === 'transcriber_error') {
      return self::tryDeserialize(\ElevenLabs\Types\TranslateTranscriberError::class, $data) ??
        $data;
    }
    if (($data['message_type'] ?? null) === 'translation_error') {
      return self::tryDeserialize(\ElevenLabs\Types\TranslateTranslationError::class, $data) ??
        $data;
    }
    if (($data['message_type'] ?? null) === 'audio_output_error') {
      return self::tryDeserialize(\ElevenLabs\Types\TranslateAudioOutputError::class, $data) ??
        $data;
    }
    if (($data['message_type'] ?? null) === 'quota_exceeded') {
      return self::tryDeserialize(\ElevenLabs\Types\TranslateQuotaExceededError::class, $data) ??
        $data;
    }
    if (($data['message_type'] ?? null) === 'payment_issue') {
      return self::tryDeserialize(\ElevenLabs\Types\TranslatePaymentIssueError::class, $data) ??
        $data;
    }
    if (($data['message_type'] ?? null) === 'unaccepted_terms') {
      return self::tryDeserialize(\ElevenLabs\Types\TranslateUnacceptedTermsError::class, $data) ??
        $data;
    }
    return $data;
  }
}
