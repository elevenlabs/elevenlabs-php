<?php

declare(strict_types=1);

namespace ElevenLabs\SpeechToText;

use ElevenLabs\Core\WebSocket\WebSocketSocket;

/**
 * @extends WebSocketSocket<\ElevenLabs\Types\SessionStarted|\ElevenLabs\Types\PartialTranscript|\ElevenLabs\Types\CommittedTranscript|\ElevenLabs\Types\DiarizedTranscript|\ElevenLabs\Types\SpeakersMerged|\ElevenLabs\Types\CommittedTranscriptWithTimestamps|\ElevenLabs\Types\CommittedTranscriptEntities|\ElevenLabs\Types\RedactedTranscript|\ElevenLabs\Types\ScribeWarning|\ElevenLabs\Types\ScribeError|\ElevenLabs\Types\ScribeAuthError|\ElevenLabs\Types\ScribeQuotaExceededError|\ElevenLabs\Types\ScribeThrottledError|\ElevenLabs\Types\ScribeUnacceptedTermsError|\ElevenLabs\Types\ScribeRateLimitedError|\ElevenLabs\Types\ScribeQueueOverflowError|\ElevenLabs\Types\ScribeResourceExhaustedError|\ElevenLabs\Types\ScribeSessionTimeLimitExceededError|\ElevenLabs\Types\ScribeInputError|\ElevenLabs\Types\ScribeInvalidRequestError|\ElevenLabs\Types\ScribeChunkSizeExceededError|\ElevenLabs\Types\ScribeInsufficientAudioActivityError|\ElevenLabs\Types\ScribeTranscriberError|\ElevenLabs\Types\EditedTranscript|array<mixed>|string>
 */
final class V1SpeechToTextRealtimeSocket extends WebSocketSocket
{
  public function sendPublish(\ElevenLabs\Types\InputAudioChunk $message): void
  {
    $this->send($message);
  }

  /**
   * @return \ElevenLabs\Types\SessionStarted|\ElevenLabs\Types\PartialTranscript|\ElevenLabs\Types\CommittedTranscript|\ElevenLabs\Types\DiarizedTranscript|\ElevenLabs\Types\SpeakersMerged|\ElevenLabs\Types\CommittedTranscriptWithTimestamps|\ElevenLabs\Types\CommittedTranscriptEntities|\ElevenLabs\Types\RedactedTranscript|\ElevenLabs\Types\ScribeWarning|\ElevenLabs\Types\ScribeError|\ElevenLabs\Types\ScribeAuthError|\ElevenLabs\Types\ScribeQuotaExceededError|\ElevenLabs\Types\ScribeThrottledError|\ElevenLabs\Types\ScribeUnacceptedTermsError|\ElevenLabs\Types\ScribeRateLimitedError|\ElevenLabs\Types\ScribeQueueOverflowError|\ElevenLabs\Types\ScribeResourceExhaustedError|\ElevenLabs\Types\ScribeSessionTimeLimitExceededError|\ElevenLabs\Types\ScribeInputError|\ElevenLabs\Types\ScribeInvalidRequestError|\ElevenLabs\Types\ScribeChunkSizeExceededError|\ElevenLabs\Types\ScribeInsufficientAudioActivityError|\ElevenLabs\Types\ScribeTranscriberError|\ElevenLabs\Types\EditedTranscript|array<mixed>|string
   */
  protected function parse(string $text): mixed
  {
    $data = json_decode($text, true, 512, JSON_THROW_ON_ERROR);
    if (!is_array($data)) {
      return $text;
    }
    if (($data['message_type'] ?? null) === 'session_started') {
      return self::tryDeserialize(\ElevenLabs\Types\SessionStarted::class, $data) ?? $data;
    }
    if (($data['message_type'] ?? null) === 'partial_transcript') {
      return self::tryDeserialize(\ElevenLabs\Types\PartialTranscript::class, $data) ?? $data;
    }
    if (($data['message_type'] ?? null) === 'committed_transcript') {
      return self::tryDeserialize(\ElevenLabs\Types\CommittedTranscript::class, $data) ?? $data;
    }
    if (($data['message_type'] ?? null) === 'diarized_transcript') {
      return self::tryDeserialize(\ElevenLabs\Types\DiarizedTranscript::class, $data) ?? $data;
    }
    if (($data['message_type'] ?? null) === 'speakers_merged') {
      return self::tryDeserialize(\ElevenLabs\Types\SpeakersMerged::class, $data) ?? $data;
    }
    if (($data['message_type'] ?? null) === 'committed_transcript_with_timestamps') {
      return self::tryDeserialize(
        \ElevenLabs\Types\CommittedTranscriptWithTimestamps::class,
        $data
      ) ?? $data;
    }
    if (($data['message_type'] ?? null) === 'committed_transcript_entities') {
      return self::tryDeserialize(\ElevenLabs\Types\CommittedTranscriptEntities::class, $data) ??
        $data;
    }
    if (($data['message_type'] ?? null) === 'redacted_transcript') {
      return self::tryDeserialize(\ElevenLabs\Types\RedactedTranscript::class, $data) ?? $data;
    }
    if (($data['message_type'] ?? null) === 'warning') {
      return self::tryDeserialize(\ElevenLabs\Types\ScribeWarning::class, $data) ?? $data;
    }
    if (($data['message_type'] ?? null) === 'error') {
      return self::tryDeserialize(\ElevenLabs\Types\ScribeError::class, $data) ?? $data;
    }
    if (($data['message_type'] ?? null) === 'auth_error') {
      return self::tryDeserialize(\ElevenLabs\Types\ScribeAuthError::class, $data) ?? $data;
    }
    if (($data['message_type'] ?? null) === 'quota_exceeded') {
      return self::tryDeserialize(\ElevenLabs\Types\ScribeQuotaExceededError::class, $data) ??
        $data;
    }
    if (($data['message_type'] ?? null) === 'commit_throttled') {
      return self::tryDeserialize(\ElevenLabs\Types\ScribeThrottledError::class, $data) ?? $data;
    }
    if (($data['message_type'] ?? null) === 'unaccepted_terms') {
      return self::tryDeserialize(\ElevenLabs\Types\ScribeUnacceptedTermsError::class, $data) ??
        $data;
    }
    if (($data['message_type'] ?? null) === 'rate_limited') {
      return self::tryDeserialize(\ElevenLabs\Types\ScribeRateLimitedError::class, $data) ?? $data;
    }
    if (($data['message_type'] ?? null) === 'queue_overflow') {
      return self::tryDeserialize(\ElevenLabs\Types\ScribeQueueOverflowError::class, $data) ??
        $data;
    }
    if (($data['message_type'] ?? null) === 'resource_exhausted') {
      return self::tryDeserialize(\ElevenLabs\Types\ScribeResourceExhaustedError::class, $data) ??
        $data;
    }
    if (($data['message_type'] ?? null) === 'session_time_limit_exceeded') {
      return self::tryDeserialize(
        \ElevenLabs\Types\ScribeSessionTimeLimitExceededError::class,
        $data
      ) ?? $data;
    }
    if (($data['message_type'] ?? null) === 'input_error') {
      return self::tryDeserialize(\ElevenLabs\Types\ScribeInputError::class, $data) ?? $data;
    }
    if (($data['message_type'] ?? null) === 'invalid_request') {
      return self::tryDeserialize(\ElevenLabs\Types\ScribeInvalidRequestError::class, $data) ??
        $data;
    }
    if (($data['message_type'] ?? null) === 'chunk_size_exceeded') {
      return self::tryDeserialize(\ElevenLabs\Types\ScribeChunkSizeExceededError::class, $data) ??
        $data;
    }
    if (($data['message_type'] ?? null) === 'insufficient_audio_activity') {
      return self::tryDeserialize(
        \ElevenLabs\Types\ScribeInsufficientAudioActivityError::class,
        $data
      ) ?? $data;
    }
    if (($data['message_type'] ?? null) === 'transcriber_error') {
      return self::tryDeserialize(\ElevenLabs\Types\ScribeTranscriberError::class, $data) ?? $data;
    }
    $message = self::tryDeserialize(\ElevenLabs\Types\EditedTranscript::class, $data);
    if ($message !== null) {
      return $message;
    }
    return $data;
  }
}
