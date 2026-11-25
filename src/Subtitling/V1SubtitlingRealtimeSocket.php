<?php

declare(strict_types=1);

namespace ElevenLabs\Subtitling;

use ElevenLabs\Core\WebSocket\WebSocketSocket;

/**
 * @extends WebSocketSocket<\ElevenLabs\Types\SubtitlingSessionStarted|\ElevenLabs\Types\SubtitlingStatus|\ElevenLabs\Types\SubtitlingPartialTranscript|\ElevenLabs\Types\SubtitlingFinalTranscript|\ElevenLabs\Types\SubtitlingPartialSubtitle|\ElevenLabs\Types\SubtitlingCommittedSubtitle|\ElevenLabs\Types\SubtitlingError|\ElevenLabs\Types\SubtitlingAuthError|\ElevenLabs\Types\SubtitlingRateLimitedError|\ElevenLabs\Types\SubtitlingQueueOverflowError|\ElevenLabs\Types\SubtitlingInputError|\ElevenLabs\Types\SubtitlingTranscriberError|\ElevenLabs\Types\SubtitlingTranslationError|\ElevenLabs\Types\SubtitlingQuotaExceededError|\ElevenLabs\Types\SubtitlingPaymentIssueError|\ElevenLabs\Types\SubtitlingUnacceptedTermsError|array<mixed>|string>
 */
final class V1SubtitlingRealtimeSocket extends WebSocketSocket
{
  public function sendPublish(\ElevenLabs\Types\SendSubtitlingStreamMessage $message): void
  {
    $this->send($message);
  }

  /**
   * @return \ElevenLabs\Types\SubtitlingSessionStarted|\ElevenLabs\Types\SubtitlingStatus|\ElevenLabs\Types\SubtitlingPartialTranscript|\ElevenLabs\Types\SubtitlingFinalTranscript|\ElevenLabs\Types\SubtitlingPartialSubtitle|\ElevenLabs\Types\SubtitlingCommittedSubtitle|\ElevenLabs\Types\SubtitlingError|\ElevenLabs\Types\SubtitlingAuthError|\ElevenLabs\Types\SubtitlingRateLimitedError|\ElevenLabs\Types\SubtitlingQueueOverflowError|\ElevenLabs\Types\SubtitlingInputError|\ElevenLabs\Types\SubtitlingTranscriberError|\ElevenLabs\Types\SubtitlingTranslationError|\ElevenLabs\Types\SubtitlingQuotaExceededError|\ElevenLabs\Types\SubtitlingPaymentIssueError|\ElevenLabs\Types\SubtitlingUnacceptedTermsError|array<mixed>|string
   */
  protected function parse(string $text): mixed
  {
    $data = json_decode($text, true, 512, JSON_THROW_ON_ERROR);
    if (!is_array($data)) {
      return $text;
    }
    if (($data['message_type'] ?? null) === 'session_started') {
      return self::tryDeserialize(\ElevenLabs\Types\SubtitlingSessionStarted::class, $data) ??
        $data;
    }
    if (($data['message_type'] ?? null) === 'status') {
      return self::tryDeserialize(\ElevenLabs\Types\SubtitlingStatus::class, $data) ?? $data;
    }
    if (($data['message_type'] ?? null) === 'partial_transcript') {
      return self::tryDeserialize(\ElevenLabs\Types\SubtitlingPartialTranscript::class, $data) ??
        $data;
    }
    if (($data['message_type'] ?? null) === 'final_transcript') {
      return self::tryDeserialize(\ElevenLabs\Types\SubtitlingFinalTranscript::class, $data) ??
        $data;
    }
    if (($data['message_type'] ?? null) === 'partial_subtitle') {
      return self::tryDeserialize(\ElevenLabs\Types\SubtitlingPartialSubtitle::class, $data) ??
        $data;
    }
    if (($data['message_type'] ?? null) === 'committed_subtitle') {
      return self::tryDeserialize(\ElevenLabs\Types\SubtitlingCommittedSubtitle::class, $data) ??
        $data;
    }
    if (($data['message_type'] ?? null) === 'error') {
      return self::tryDeserialize(\ElevenLabs\Types\SubtitlingError::class, $data) ?? $data;
    }
    if (($data['message_type'] ?? null) === 'auth_error') {
      return self::tryDeserialize(\ElevenLabs\Types\SubtitlingAuthError::class, $data) ?? $data;
    }
    if (($data['message_type'] ?? null) === 'rate_limited') {
      return self::tryDeserialize(\ElevenLabs\Types\SubtitlingRateLimitedError::class, $data) ??
        $data;
    }
    if (($data['message_type'] ?? null) === 'queue_overflow') {
      return self::tryDeserialize(\ElevenLabs\Types\SubtitlingQueueOverflowError::class, $data) ??
        $data;
    }
    if (($data['message_type'] ?? null) === 'input_error') {
      return self::tryDeserialize(\ElevenLabs\Types\SubtitlingInputError::class, $data) ?? $data;
    }
    if (($data['message_type'] ?? null) === 'transcriber_error') {
      return self::tryDeserialize(\ElevenLabs\Types\SubtitlingTranscriberError::class, $data) ??
        $data;
    }
    if (($data['message_type'] ?? null) === 'translation_error') {
      return self::tryDeserialize(\ElevenLabs\Types\SubtitlingTranslationError::class, $data) ??
        $data;
    }
    if (($data['message_type'] ?? null) === 'quota_exceeded') {
      return self::tryDeserialize(\ElevenLabs\Types\SubtitlingQuotaExceededError::class, $data) ??
        $data;
    }
    if (($data['message_type'] ?? null) === 'payment_issue') {
      return self::tryDeserialize(\ElevenLabs\Types\SubtitlingPaymentIssueError::class, $data) ??
        $data;
    }
    if (($data['message_type'] ?? null) === 'unaccepted_terms') {
      return self::tryDeserialize(\ElevenLabs\Types\SubtitlingUnacceptedTermsError::class, $data) ??
        $data;
    }
    return $data;
  }
}
