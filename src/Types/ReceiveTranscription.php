<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;

/**
 * Discriminated union type (oneOf) representing exactly one of multiple possible types.
 *
 * This class implements a type-safe union where the value can be exactly one of the
 * defined variant types. It provides factory methods for construction, type-checking
 * methods, safe and throwing getters, and pattern matching for exhaustive handling.
 *
 * The oneOf pattern enforces that only one type can be present at a time, unlike anyOf
 * which allows multiple types simultaneously.
 */
class ReceiveTranscription extends JsonSerializableType
{
  /**
   * @var \ElevenLabs\Types\SessionStarted|\ElevenLabs\Types\PartialTranscript|\ElevenLabs\Types\CommittedTranscript|\ElevenLabs\Types\DiarizedTranscript|\ElevenLabs\Types\SpeakersMerged|\ElevenLabs\Types\CommittedTranscriptWithTimestamps|\ElevenLabs\Types\CommittedTranscriptEntities|\ElevenLabs\Types\RedactedTranscript|\ElevenLabs\Types\EditedTranscript|\ElevenLabs\Types\ScribeWarning|\ElevenLabs\Types\ScribeError|\ElevenLabs\Types\ScribeAuthError|\ElevenLabs\Types\ScribeQuotaExceededError|\ElevenLabs\Types\ScribeThrottledError|\ElevenLabs\Types\ScribeUnacceptedTermsError|\ElevenLabs\Types\ScribeRateLimitedError|\ElevenLabs\Types\ScribeQueueOverflowError|\ElevenLabs\Types\ScribeResourceExhaustedError|\ElevenLabs\Types\ScribeSessionTimeLimitExceededError|\ElevenLabs\Types\ScribeInputError|\ElevenLabs\Types\ScribeInvalidRequestError|\ElevenLabs\Types\ScribeChunkSizeExceededError|\ElevenLabs\Types\ScribeInsufficientAudioActivityError|\ElevenLabs\Types\ScribeTranscriberError The value, exactly one of the variant types
   */
  public readonly mixed $value;

  /**
   * @var int The type index identifying which variant type is stored
   */
  private int $typeIndex;

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\SessionStarted|\ElevenLabs\Types\PartialTranscript|\ElevenLabs\Types\CommittedTranscript|\ElevenLabs\Types\DiarizedTranscript|\ElevenLabs\Types\SpeakersMerged|\ElevenLabs\Types\CommittedTranscriptWithTimestamps|\ElevenLabs\Types\CommittedTranscriptEntities|\ElevenLabs\Types\RedactedTranscript|\ElevenLabs\Types\EditedTranscript|\ElevenLabs\Types\ScribeWarning|\ElevenLabs\Types\ScribeError|\ElevenLabs\Types\ScribeAuthError|\ElevenLabs\Types\ScribeQuotaExceededError|\ElevenLabs\Types\ScribeThrottledError|\ElevenLabs\Types\ScribeUnacceptedTermsError|\ElevenLabs\Types\ScribeRateLimitedError|\ElevenLabs\Types\ScribeQueueOverflowError|\ElevenLabs\Types\ScribeResourceExhaustedError|\ElevenLabs\Types\ScribeSessionTimeLimitExceededError|\ElevenLabs\Types\ScribeInputError|\ElevenLabs\Types\ScribeInvalidRequestError|\ElevenLabs\Types\ScribeChunkSizeExceededError|\ElevenLabs\Types\ScribeInsufficientAudioActivityError|\ElevenLabs\Types\ScribeTranscriberError $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
  }

  // Factory methods
  /**
   * Create a ReceiveTranscription instance containing a \ElevenLabs\Types\SessionStarted
   */
  public static function sessionStarted(\ElevenLabs\Types\SessionStarted $sessionStarted): self
  {
    return new self($sessionStarted, 0);
  }

  /**
   * Create a ReceiveTranscription instance containing a \ElevenLabs\Types\PartialTranscript
   */
  public static function partialTranscript(
    \ElevenLabs\Types\PartialTranscript $partialTranscript
  ): self {
    return new self($partialTranscript, 1);
  }

  /**
   * Create a ReceiveTranscription instance containing a \ElevenLabs\Types\CommittedTranscript
   */
  public static function committedTranscript(
    \ElevenLabs\Types\CommittedTranscript $committedTranscript
  ): self {
    return new self($committedTranscript, 2);
  }

  /**
   * Create a ReceiveTranscription instance containing a \ElevenLabs\Types\DiarizedTranscript
   */
  public static function diarizedTranscript(
    \ElevenLabs\Types\DiarizedTranscript $diarizedTranscript
  ): self {
    return new self($diarizedTranscript, 3);
  }

  /**
   * Create a ReceiveTranscription instance containing a \ElevenLabs\Types\SpeakersMerged
   */
  public static function speakersMerged(\ElevenLabs\Types\SpeakersMerged $speakersMerged): self
  {
    return new self($speakersMerged, 4);
  }

  /**
   * Create a ReceiveTranscription instance containing a \ElevenLabs\Types\CommittedTranscriptWithTimestamps
   */
  public static function committedTranscriptWithTimestamps(
    \ElevenLabs\Types\CommittedTranscriptWithTimestamps $committedTranscriptWithTimestamps
  ): self {
    return new self($committedTranscriptWithTimestamps, 5);
  }

  /**
   * Create a ReceiveTranscription instance containing a \ElevenLabs\Types\CommittedTranscriptEntities
   */
  public static function committedTranscriptEntities(
    \ElevenLabs\Types\CommittedTranscriptEntities $committedTranscriptEntities
  ): self {
    return new self($committedTranscriptEntities, 6);
  }

  /**
   * Create a ReceiveTranscription instance containing a \ElevenLabs\Types\RedactedTranscript
   */
  public static function redactedTranscript(
    \ElevenLabs\Types\RedactedTranscript $redactedTranscript
  ): self {
    return new self($redactedTranscript, 7);
  }

  /**
   * Create a ReceiveTranscription instance containing a \ElevenLabs\Types\EditedTranscript
   */
  public static function editedTranscript(
    \ElevenLabs\Types\EditedTranscript $editedTranscript
  ): self {
    return new self($editedTranscript, 8);
  }

  /**
   * Create a ReceiveTranscription instance containing a \ElevenLabs\Types\ScribeWarning
   */
  public static function scribeWarning(\ElevenLabs\Types\ScribeWarning $scribeWarning): self
  {
    return new self($scribeWarning, 9);
  }

  /**
   * Create a ReceiveTranscription instance containing a \ElevenLabs\Types\ScribeError
   */
  public static function scribeError(\ElevenLabs\Types\ScribeError $scribeError): self
  {
    return new self($scribeError, 10);
  }

  /**
   * Create a ReceiveTranscription instance containing a \ElevenLabs\Types\ScribeAuthError
   */
  public static function scribeAuthError(\ElevenLabs\Types\ScribeAuthError $scribeAuthError): self
  {
    return new self($scribeAuthError, 11);
  }

  /**
   * Create a ReceiveTranscription instance containing a \ElevenLabs\Types\ScribeQuotaExceededError
   */
  public static function scribeQuotaExceededError(
    \ElevenLabs\Types\ScribeQuotaExceededError $scribeQuotaExceededError
  ): self {
    return new self($scribeQuotaExceededError, 12);
  }

  /**
   * Create a ReceiveTranscription instance containing a \ElevenLabs\Types\ScribeThrottledError
   */
  public static function scribeThrottledError(
    \ElevenLabs\Types\ScribeThrottledError $scribeThrottledError
  ): self {
    return new self($scribeThrottledError, 13);
  }

  /**
   * Create a ReceiveTranscription instance containing a \ElevenLabs\Types\ScribeUnacceptedTermsError
   */
  public static function scribeUnacceptedTermsError(
    \ElevenLabs\Types\ScribeUnacceptedTermsError $scribeUnacceptedTermsError
  ): self {
    return new self($scribeUnacceptedTermsError, 14);
  }

  /**
   * Create a ReceiveTranscription instance containing a \ElevenLabs\Types\ScribeRateLimitedError
   */
  public static function scribeRateLimitedError(
    \ElevenLabs\Types\ScribeRateLimitedError $scribeRateLimitedError
  ): self {
    return new self($scribeRateLimitedError, 15);
  }

  /**
   * Create a ReceiveTranscription instance containing a \ElevenLabs\Types\ScribeQueueOverflowError
   */
  public static function scribeQueueOverflowError(
    \ElevenLabs\Types\ScribeQueueOverflowError $scribeQueueOverflowError
  ): self {
    return new self($scribeQueueOverflowError, 16);
  }

  /**
   * Create a ReceiveTranscription instance containing a \ElevenLabs\Types\ScribeResourceExhaustedError
   */
  public static function scribeResourceExhaustedError(
    \ElevenLabs\Types\ScribeResourceExhaustedError $scribeResourceExhaustedError
  ): self {
    return new self($scribeResourceExhaustedError, 17);
  }

  /**
   * Create a ReceiveTranscription instance containing a \ElevenLabs\Types\ScribeSessionTimeLimitExceededError
   */
  public static function scribeSessionTimeLimitExceededError(
    \ElevenLabs\Types\ScribeSessionTimeLimitExceededError $scribeSessionTimeLimitExceededError
  ): self {
    return new self($scribeSessionTimeLimitExceededError, 18);
  }

  /**
   * Create a ReceiveTranscription instance containing a \ElevenLabs\Types\ScribeInputError
   */
  public static function scribeInputError(
    \ElevenLabs\Types\ScribeInputError $scribeInputError
  ): self {
    return new self($scribeInputError, 19);
  }

  /**
   * Create a ReceiveTranscription instance containing a \ElevenLabs\Types\ScribeInvalidRequestError
   */
  public static function scribeInvalidRequestError(
    \ElevenLabs\Types\ScribeInvalidRequestError $scribeInvalidRequestError
  ): self {
    return new self($scribeInvalidRequestError, 20);
  }

  /**
   * Create a ReceiveTranscription instance containing a \ElevenLabs\Types\ScribeChunkSizeExceededError
   */
  public static function scribeChunkSizeExceededError(
    \ElevenLabs\Types\ScribeChunkSizeExceededError $scribeChunkSizeExceededError
  ): self {
    return new self($scribeChunkSizeExceededError, 21);
  }

  /**
   * Create a ReceiveTranscription instance containing a \ElevenLabs\Types\ScribeInsufficientAudioActivityError
   */
  public static function scribeInsufficientAudioActivityError(
    \ElevenLabs\Types\ScribeInsufficientAudioActivityError $scribeInsufficientAudioActivityError
  ): self {
    return new self($scribeInsufficientAudioActivityError, 22);
  }

  /**
   * Create a ReceiveTranscription instance containing a \ElevenLabs\Types\ScribeTranscriberError
   */
  public static function scribeTranscriberError(
    \ElevenLabs\Types\ScribeTranscriberError $scribeTranscriberError
  ): self {
    return new self($scribeTranscriberError, 23);
  }

  // Type checking methods
  /**
   * Check if this ReceiveTranscription contains a \ElevenLabs\Types\SessionStarted
   */
  public function isSessionStarted(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this ReceiveTranscription contains a \ElevenLabs\Types\PartialTranscript
   */
  public function isPartialTranscript(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this ReceiveTranscription contains a \ElevenLabs\Types\CommittedTranscript
   */
  public function isCommittedTranscript(): bool
  {
    return $this->typeIndex === 2;
  }

  /**
   * Check if this ReceiveTranscription contains a \ElevenLabs\Types\DiarizedTranscript
   */
  public function isDiarizedTranscript(): bool
  {
    return $this->typeIndex === 3;
  }

  /**
   * Check if this ReceiveTranscription contains a \ElevenLabs\Types\SpeakersMerged
   */
  public function isSpeakersMerged(): bool
  {
    return $this->typeIndex === 4;
  }

  /**
   * Check if this ReceiveTranscription contains a \ElevenLabs\Types\CommittedTranscriptWithTimestamps
   */
  public function isCommittedTranscriptWithTimestamps(): bool
  {
    return $this->typeIndex === 5;
  }

  /**
   * Check if this ReceiveTranscription contains a \ElevenLabs\Types\CommittedTranscriptEntities
   */
  public function isCommittedTranscriptEntities(): bool
  {
    return $this->typeIndex === 6;
  }

  /**
   * Check if this ReceiveTranscription contains a \ElevenLabs\Types\RedactedTranscript
   */
  public function isRedactedTranscript(): bool
  {
    return $this->typeIndex === 7;
  }

  /**
   * Check if this ReceiveTranscription contains a \ElevenLabs\Types\EditedTranscript
   */
  public function isEditedTranscript(): bool
  {
    return $this->typeIndex === 8;
  }

  /**
   * Check if this ReceiveTranscription contains a \ElevenLabs\Types\ScribeWarning
   */
  public function isScribeWarning(): bool
  {
    return $this->typeIndex === 9;
  }

  /**
   * Check if this ReceiveTranscription contains a \ElevenLabs\Types\ScribeError
   */
  public function isScribeError(): bool
  {
    return $this->typeIndex === 10;
  }

  /**
   * Check if this ReceiveTranscription contains a \ElevenLabs\Types\ScribeAuthError
   */
  public function isScribeAuthError(): bool
  {
    return $this->typeIndex === 11;
  }

  /**
   * Check if this ReceiveTranscription contains a \ElevenLabs\Types\ScribeQuotaExceededError
   */
  public function isScribeQuotaExceededError(): bool
  {
    return $this->typeIndex === 12;
  }

  /**
   * Check if this ReceiveTranscription contains a \ElevenLabs\Types\ScribeThrottledError
   */
  public function isScribeThrottledError(): bool
  {
    return $this->typeIndex === 13;
  }

  /**
   * Check if this ReceiveTranscription contains a \ElevenLabs\Types\ScribeUnacceptedTermsError
   */
  public function isScribeUnacceptedTermsError(): bool
  {
    return $this->typeIndex === 14;
  }

  /**
   * Check if this ReceiveTranscription contains a \ElevenLabs\Types\ScribeRateLimitedError
   */
  public function isScribeRateLimitedError(): bool
  {
    return $this->typeIndex === 15;
  }

  /**
   * Check if this ReceiveTranscription contains a \ElevenLabs\Types\ScribeQueueOverflowError
   */
  public function isScribeQueueOverflowError(): bool
  {
    return $this->typeIndex === 16;
  }

  /**
   * Check if this ReceiveTranscription contains a \ElevenLabs\Types\ScribeResourceExhaustedError
   */
  public function isScribeResourceExhaustedError(): bool
  {
    return $this->typeIndex === 17;
  }

  /**
   * Check if this ReceiveTranscription contains a \ElevenLabs\Types\ScribeSessionTimeLimitExceededError
   */
  public function isScribeSessionTimeLimitExceededError(): bool
  {
    return $this->typeIndex === 18;
  }

  /**
   * Check if this ReceiveTranscription contains a \ElevenLabs\Types\ScribeInputError
   */
  public function isScribeInputError(): bool
  {
    return $this->typeIndex === 19;
  }

  /**
   * Check if this ReceiveTranscription contains a \ElevenLabs\Types\ScribeInvalidRequestError
   */
  public function isScribeInvalidRequestError(): bool
  {
    return $this->typeIndex === 20;
  }

  /**
   * Check if this ReceiveTranscription contains a \ElevenLabs\Types\ScribeChunkSizeExceededError
   */
  public function isScribeChunkSizeExceededError(): bool
  {
    return $this->typeIndex === 21;
  }

  /**
   * Check if this ReceiveTranscription contains a \ElevenLabs\Types\ScribeInsufficientAudioActivityError
   */
  public function isScribeInsufficientAudioActivityError(): bool
  {
    return $this->typeIndex === 22;
  }

  /**
   * Check if this ReceiveTranscription contains a \ElevenLabs\Types\ScribeTranscriberError
   */
  public function isScribeTranscriberError(): bool
  {
    return $this->typeIndex === 23;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\SessionStarted value
   * @throws \RuntimeException if this ReceiveTranscription does not contain a \ElevenLabs\Types\SessionStarted
   */
  public function asSessionStarted(): \ElevenLabs\Types\SessionStarted
  {
    if (!$this->isSessionStarted()) {
      throw new \RuntimeException(
        'ReceiveTranscription does not contain \ElevenLabs\Types\SessionStarted'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\PartialTranscript value
   * @throws \RuntimeException if this ReceiveTranscription does not contain a \ElevenLabs\Types\PartialTranscript
   */
  public function asPartialTranscript(): \ElevenLabs\Types\PartialTranscript
  {
    if (!$this->isPartialTranscript()) {
      throw new \RuntimeException(
        'ReceiveTranscription does not contain \ElevenLabs\Types\PartialTranscript'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\CommittedTranscript value
   * @throws \RuntimeException if this ReceiveTranscription does not contain a \ElevenLabs\Types\CommittedTranscript
   */
  public function asCommittedTranscript(): \ElevenLabs\Types\CommittedTranscript
  {
    if (!$this->isCommittedTranscript()) {
      throw new \RuntimeException(
        'ReceiveTranscription does not contain \ElevenLabs\Types\CommittedTranscript'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\DiarizedTranscript value
   * @throws \RuntimeException if this ReceiveTranscription does not contain a \ElevenLabs\Types\DiarizedTranscript
   */
  public function asDiarizedTranscript(): \ElevenLabs\Types\DiarizedTranscript
  {
    if (!$this->isDiarizedTranscript()) {
      throw new \RuntimeException(
        'ReceiveTranscription does not contain \ElevenLabs\Types\DiarizedTranscript'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\SpeakersMerged value
   * @throws \RuntimeException if this ReceiveTranscription does not contain a \ElevenLabs\Types\SpeakersMerged
   */
  public function asSpeakersMerged(): \ElevenLabs\Types\SpeakersMerged
  {
    if (!$this->isSpeakersMerged()) {
      throw new \RuntimeException(
        'ReceiveTranscription does not contain \ElevenLabs\Types\SpeakersMerged'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\CommittedTranscriptWithTimestamps value
   * @throws \RuntimeException if this ReceiveTranscription does not contain a \ElevenLabs\Types\CommittedTranscriptWithTimestamps
   */
  public function asCommittedTranscriptWithTimestamps(): \ElevenLabs\Types\CommittedTranscriptWithTimestamps
  {
    if (!$this->isCommittedTranscriptWithTimestamps()) {
      throw new \RuntimeException(
        'ReceiveTranscription does not contain \ElevenLabs\Types\CommittedTranscriptWithTimestamps'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\CommittedTranscriptEntities value
   * @throws \RuntimeException if this ReceiveTranscription does not contain a \ElevenLabs\Types\CommittedTranscriptEntities
   */
  public function asCommittedTranscriptEntities(): \ElevenLabs\Types\CommittedTranscriptEntities
  {
    if (!$this->isCommittedTranscriptEntities()) {
      throw new \RuntimeException(
        'ReceiveTranscription does not contain \ElevenLabs\Types\CommittedTranscriptEntities'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\RedactedTranscript value
   * @throws \RuntimeException if this ReceiveTranscription does not contain a \ElevenLabs\Types\RedactedTranscript
   */
  public function asRedactedTranscript(): \ElevenLabs\Types\RedactedTranscript
  {
    if (!$this->isRedactedTranscript()) {
      throw new \RuntimeException(
        'ReceiveTranscription does not contain \ElevenLabs\Types\RedactedTranscript'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\EditedTranscript value
   * @throws \RuntimeException if this ReceiveTranscription does not contain a \ElevenLabs\Types\EditedTranscript
   */
  public function asEditedTranscript(): \ElevenLabs\Types\EditedTranscript
  {
    if (!$this->isEditedTranscript()) {
      throw new \RuntimeException(
        'ReceiveTranscription does not contain \ElevenLabs\Types\EditedTranscript'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ScribeWarning value
   * @throws \RuntimeException if this ReceiveTranscription does not contain a \ElevenLabs\Types\ScribeWarning
   */
  public function asScribeWarning(): \ElevenLabs\Types\ScribeWarning
  {
    if (!$this->isScribeWarning()) {
      throw new \RuntimeException(
        'ReceiveTranscription does not contain \ElevenLabs\Types\ScribeWarning'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ScribeError value
   * @throws \RuntimeException if this ReceiveTranscription does not contain a \ElevenLabs\Types\ScribeError
   */
  public function asScribeError(): \ElevenLabs\Types\ScribeError
  {
    if (!$this->isScribeError()) {
      throw new \RuntimeException(
        'ReceiveTranscription does not contain \ElevenLabs\Types\ScribeError'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ScribeAuthError value
   * @throws \RuntimeException if this ReceiveTranscription does not contain a \ElevenLabs\Types\ScribeAuthError
   */
  public function asScribeAuthError(): \ElevenLabs\Types\ScribeAuthError
  {
    if (!$this->isScribeAuthError()) {
      throw new \RuntimeException(
        'ReceiveTranscription does not contain \ElevenLabs\Types\ScribeAuthError'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ScribeQuotaExceededError value
   * @throws \RuntimeException if this ReceiveTranscription does not contain a \ElevenLabs\Types\ScribeQuotaExceededError
   */
  public function asScribeQuotaExceededError(): \ElevenLabs\Types\ScribeQuotaExceededError
  {
    if (!$this->isScribeQuotaExceededError()) {
      throw new \RuntimeException(
        'ReceiveTranscription does not contain \ElevenLabs\Types\ScribeQuotaExceededError'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ScribeThrottledError value
   * @throws \RuntimeException if this ReceiveTranscription does not contain a \ElevenLabs\Types\ScribeThrottledError
   */
  public function asScribeThrottledError(): \ElevenLabs\Types\ScribeThrottledError
  {
    if (!$this->isScribeThrottledError()) {
      throw new \RuntimeException(
        'ReceiveTranscription does not contain \ElevenLabs\Types\ScribeThrottledError'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ScribeUnacceptedTermsError value
   * @throws \RuntimeException if this ReceiveTranscription does not contain a \ElevenLabs\Types\ScribeUnacceptedTermsError
   */
  public function asScribeUnacceptedTermsError(): \ElevenLabs\Types\ScribeUnacceptedTermsError
  {
    if (!$this->isScribeUnacceptedTermsError()) {
      throw new \RuntimeException(
        'ReceiveTranscription does not contain \ElevenLabs\Types\ScribeUnacceptedTermsError'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ScribeRateLimitedError value
   * @throws \RuntimeException if this ReceiveTranscription does not contain a \ElevenLabs\Types\ScribeRateLimitedError
   */
  public function asScribeRateLimitedError(): \ElevenLabs\Types\ScribeRateLimitedError
  {
    if (!$this->isScribeRateLimitedError()) {
      throw new \RuntimeException(
        'ReceiveTranscription does not contain \ElevenLabs\Types\ScribeRateLimitedError'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ScribeQueueOverflowError value
   * @throws \RuntimeException if this ReceiveTranscription does not contain a \ElevenLabs\Types\ScribeQueueOverflowError
   */
  public function asScribeQueueOverflowError(): \ElevenLabs\Types\ScribeQueueOverflowError
  {
    if (!$this->isScribeQueueOverflowError()) {
      throw new \RuntimeException(
        'ReceiveTranscription does not contain \ElevenLabs\Types\ScribeQueueOverflowError'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ScribeResourceExhaustedError value
   * @throws \RuntimeException if this ReceiveTranscription does not contain a \ElevenLabs\Types\ScribeResourceExhaustedError
   */
  public function asScribeResourceExhaustedError(): \ElevenLabs\Types\ScribeResourceExhaustedError
  {
    if (!$this->isScribeResourceExhaustedError()) {
      throw new \RuntimeException(
        'ReceiveTranscription does not contain \ElevenLabs\Types\ScribeResourceExhaustedError'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ScribeSessionTimeLimitExceededError value
   * @throws \RuntimeException if this ReceiveTranscription does not contain a \ElevenLabs\Types\ScribeSessionTimeLimitExceededError
   */
  public function asScribeSessionTimeLimitExceededError(): \ElevenLabs\Types\ScribeSessionTimeLimitExceededError
  {
    if (!$this->isScribeSessionTimeLimitExceededError()) {
      throw new \RuntimeException(
        'ReceiveTranscription does not contain \ElevenLabs\Types\ScribeSessionTimeLimitExceededError'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ScribeInputError value
   * @throws \RuntimeException if this ReceiveTranscription does not contain a \ElevenLabs\Types\ScribeInputError
   */
  public function asScribeInputError(): \ElevenLabs\Types\ScribeInputError
  {
    if (!$this->isScribeInputError()) {
      throw new \RuntimeException(
        'ReceiveTranscription does not contain \ElevenLabs\Types\ScribeInputError'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ScribeInvalidRequestError value
   * @throws \RuntimeException if this ReceiveTranscription does not contain a \ElevenLabs\Types\ScribeInvalidRequestError
   */
  public function asScribeInvalidRequestError(): \ElevenLabs\Types\ScribeInvalidRequestError
  {
    if (!$this->isScribeInvalidRequestError()) {
      throw new \RuntimeException(
        'ReceiveTranscription does not contain \ElevenLabs\Types\ScribeInvalidRequestError'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ScribeChunkSizeExceededError value
   * @throws \RuntimeException if this ReceiveTranscription does not contain a \ElevenLabs\Types\ScribeChunkSizeExceededError
   */
  public function asScribeChunkSizeExceededError(): \ElevenLabs\Types\ScribeChunkSizeExceededError
  {
    if (!$this->isScribeChunkSizeExceededError()) {
      throw new \RuntimeException(
        'ReceiveTranscription does not contain \ElevenLabs\Types\ScribeChunkSizeExceededError'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ScribeInsufficientAudioActivityError value
   * @throws \RuntimeException if this ReceiveTranscription does not contain a \ElevenLabs\Types\ScribeInsufficientAudioActivityError
   */
  public function asScribeInsufficientAudioActivityError(): \ElevenLabs\Types\ScribeInsufficientAudioActivityError
  {
    if (!$this->isScribeInsufficientAudioActivityError()) {
      throw new \RuntimeException(
        'ReceiveTranscription does not contain \ElevenLabs\Types\ScribeInsufficientAudioActivityError'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ScribeTranscriberError value
   * @throws \RuntimeException if this ReceiveTranscription does not contain a \ElevenLabs\Types\ScribeTranscriberError
   */
  public function asScribeTranscriberError(): \ElevenLabs\Types\ScribeTranscriberError
  {
    if (!$this->isScribeTranscriberError()) {
      throw new \RuntimeException(
        'ReceiveTranscription does not contain \ElevenLabs\Types\ScribeTranscriberError'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\SessionStarted value
   * @return \ElevenLabs\Types\SessionStarted|null Returns the value if this ReceiveTranscription contains a \ElevenLabs\Types\SessionStarted, null otherwise
   */
  public function tryAsSessionStarted(): ?\ElevenLabs\Types\SessionStarted
  {
    return $this->isSessionStarted() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\PartialTranscript value
   * @return \ElevenLabs\Types\PartialTranscript|null Returns the value if this ReceiveTranscription contains a \ElevenLabs\Types\PartialTranscript, null otherwise
   */
  public function tryAsPartialTranscript(): ?\ElevenLabs\Types\PartialTranscript
  {
    return $this->isPartialTranscript() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\CommittedTranscript value
   * @return \ElevenLabs\Types\CommittedTranscript|null Returns the value if this ReceiveTranscription contains a \ElevenLabs\Types\CommittedTranscript, null otherwise
   */
  public function tryAsCommittedTranscript(): ?\ElevenLabs\Types\CommittedTranscript
  {
    return $this->isCommittedTranscript() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\DiarizedTranscript value
   * @return \ElevenLabs\Types\DiarizedTranscript|null Returns the value if this ReceiveTranscription contains a \ElevenLabs\Types\DiarizedTranscript, null otherwise
   */
  public function tryAsDiarizedTranscript(): ?\ElevenLabs\Types\DiarizedTranscript
  {
    return $this->isDiarizedTranscript() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\SpeakersMerged value
   * @return \ElevenLabs\Types\SpeakersMerged|null Returns the value if this ReceiveTranscription contains a \ElevenLabs\Types\SpeakersMerged, null otherwise
   */
  public function tryAsSpeakersMerged(): ?\ElevenLabs\Types\SpeakersMerged
  {
    return $this->isSpeakersMerged() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\CommittedTranscriptWithTimestamps value
   * @return \ElevenLabs\Types\CommittedTranscriptWithTimestamps|null Returns the value if this ReceiveTranscription contains a \ElevenLabs\Types\CommittedTranscriptWithTimestamps, null otherwise
   */
  public function tryAsCommittedTranscriptWithTimestamps(): ?\ElevenLabs\Types\CommittedTranscriptWithTimestamps
  {
    return $this->isCommittedTranscriptWithTimestamps() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\CommittedTranscriptEntities value
   * @return \ElevenLabs\Types\CommittedTranscriptEntities|null Returns the value if this ReceiveTranscription contains a \ElevenLabs\Types\CommittedTranscriptEntities, null otherwise
   */
  public function tryAsCommittedTranscriptEntities(): ?\ElevenLabs\Types\CommittedTranscriptEntities
  {
    return $this->isCommittedTranscriptEntities() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\RedactedTranscript value
   * @return \ElevenLabs\Types\RedactedTranscript|null Returns the value if this ReceiveTranscription contains a \ElevenLabs\Types\RedactedTranscript, null otherwise
   */
  public function tryAsRedactedTranscript(): ?\ElevenLabs\Types\RedactedTranscript
  {
    return $this->isRedactedTranscript() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\EditedTranscript value
   * @return \ElevenLabs\Types\EditedTranscript|null Returns the value if this ReceiveTranscription contains a \ElevenLabs\Types\EditedTranscript, null otherwise
   */
  public function tryAsEditedTranscript(): ?\ElevenLabs\Types\EditedTranscript
  {
    return $this->isEditedTranscript() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ScribeWarning value
   * @return \ElevenLabs\Types\ScribeWarning|null Returns the value if this ReceiveTranscription contains a \ElevenLabs\Types\ScribeWarning, null otherwise
   */
  public function tryAsScribeWarning(): ?\ElevenLabs\Types\ScribeWarning
  {
    return $this->isScribeWarning() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ScribeError value
   * @return \ElevenLabs\Types\ScribeError|null Returns the value if this ReceiveTranscription contains a \ElevenLabs\Types\ScribeError, null otherwise
   */
  public function tryAsScribeError(): ?\ElevenLabs\Types\ScribeError
  {
    return $this->isScribeError() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ScribeAuthError value
   * @return \ElevenLabs\Types\ScribeAuthError|null Returns the value if this ReceiveTranscription contains a \ElevenLabs\Types\ScribeAuthError, null otherwise
   */
  public function tryAsScribeAuthError(): ?\ElevenLabs\Types\ScribeAuthError
  {
    return $this->isScribeAuthError() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ScribeQuotaExceededError value
   * @return \ElevenLabs\Types\ScribeQuotaExceededError|null Returns the value if this ReceiveTranscription contains a \ElevenLabs\Types\ScribeQuotaExceededError, null otherwise
   */
  public function tryAsScribeQuotaExceededError(): ?\ElevenLabs\Types\ScribeQuotaExceededError
  {
    return $this->isScribeQuotaExceededError() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ScribeThrottledError value
   * @return \ElevenLabs\Types\ScribeThrottledError|null Returns the value if this ReceiveTranscription contains a \ElevenLabs\Types\ScribeThrottledError, null otherwise
   */
  public function tryAsScribeThrottledError(): ?\ElevenLabs\Types\ScribeThrottledError
  {
    return $this->isScribeThrottledError() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ScribeUnacceptedTermsError value
   * @return \ElevenLabs\Types\ScribeUnacceptedTermsError|null Returns the value if this ReceiveTranscription contains a \ElevenLabs\Types\ScribeUnacceptedTermsError, null otherwise
   */
  public function tryAsScribeUnacceptedTermsError(): ?\ElevenLabs\Types\ScribeUnacceptedTermsError
  {
    return $this->isScribeUnacceptedTermsError() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ScribeRateLimitedError value
   * @return \ElevenLabs\Types\ScribeRateLimitedError|null Returns the value if this ReceiveTranscription contains a \ElevenLabs\Types\ScribeRateLimitedError, null otherwise
   */
  public function tryAsScribeRateLimitedError(): ?\ElevenLabs\Types\ScribeRateLimitedError
  {
    return $this->isScribeRateLimitedError() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ScribeQueueOverflowError value
   * @return \ElevenLabs\Types\ScribeQueueOverflowError|null Returns the value if this ReceiveTranscription contains a \ElevenLabs\Types\ScribeQueueOverflowError, null otherwise
   */
  public function tryAsScribeQueueOverflowError(): ?\ElevenLabs\Types\ScribeQueueOverflowError
  {
    return $this->isScribeQueueOverflowError() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ScribeResourceExhaustedError value
   * @return \ElevenLabs\Types\ScribeResourceExhaustedError|null Returns the value if this ReceiveTranscription contains a \ElevenLabs\Types\ScribeResourceExhaustedError, null otherwise
   */
  public function tryAsScribeResourceExhaustedError(): ?\ElevenLabs\Types\ScribeResourceExhaustedError
  {
    return $this->isScribeResourceExhaustedError() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ScribeSessionTimeLimitExceededError value
   * @return \ElevenLabs\Types\ScribeSessionTimeLimitExceededError|null Returns the value if this ReceiveTranscription contains a \ElevenLabs\Types\ScribeSessionTimeLimitExceededError, null otherwise
   */
  public function tryAsScribeSessionTimeLimitExceededError(): ?\ElevenLabs\Types\ScribeSessionTimeLimitExceededError
  {
    return $this->isScribeSessionTimeLimitExceededError() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ScribeInputError value
   * @return \ElevenLabs\Types\ScribeInputError|null Returns the value if this ReceiveTranscription contains a \ElevenLabs\Types\ScribeInputError, null otherwise
   */
  public function tryAsScribeInputError(): ?\ElevenLabs\Types\ScribeInputError
  {
    return $this->isScribeInputError() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ScribeInvalidRequestError value
   * @return \ElevenLabs\Types\ScribeInvalidRequestError|null Returns the value if this ReceiveTranscription contains a \ElevenLabs\Types\ScribeInvalidRequestError, null otherwise
   */
  public function tryAsScribeInvalidRequestError(): ?\ElevenLabs\Types\ScribeInvalidRequestError
  {
    return $this->isScribeInvalidRequestError() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ScribeChunkSizeExceededError value
   * @return \ElevenLabs\Types\ScribeChunkSizeExceededError|null Returns the value if this ReceiveTranscription contains a \ElevenLabs\Types\ScribeChunkSizeExceededError, null otherwise
   */
  public function tryAsScribeChunkSizeExceededError(): ?\ElevenLabs\Types\ScribeChunkSizeExceededError
  {
    return $this->isScribeChunkSizeExceededError() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ScribeInsufficientAudioActivityError value
   * @return \ElevenLabs\Types\ScribeInsufficientAudioActivityError|null Returns the value if this ReceiveTranscription contains a \ElevenLabs\Types\ScribeInsufficientAudioActivityError, null otherwise
   */
  public function tryAsScribeInsufficientAudioActivityError(): ?\ElevenLabs\Types\ScribeInsufficientAudioActivityError
  {
    return $this->isScribeInsufficientAudioActivityError() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ScribeTranscriberError value
   * @return \ElevenLabs\Types\ScribeTranscriberError|null Returns the value if this ReceiveTranscription contains a \ElevenLabs\Types\ScribeTranscriberError, null otherwise
   */
  public function tryAsScribeTranscriberError(): ?\ElevenLabs\Types\ScribeTranscriberError
  {
    return $this->isScribeTranscriberError() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\SessionStarted): T $onSessionStarted
   * @param callable(\ElevenLabs\Types\PartialTranscript): T $onPartialTranscript
   * @param callable(\ElevenLabs\Types\CommittedTranscript): T $onCommittedTranscript
   * @param callable(\ElevenLabs\Types\DiarizedTranscript): T $onDiarizedTranscript
   * @param callable(\ElevenLabs\Types\SpeakersMerged): T $onSpeakersMerged
   * @param callable(\ElevenLabs\Types\CommittedTranscriptWithTimestamps): T $onCommittedTranscriptWithTimestamps
   * @param callable(\ElevenLabs\Types\CommittedTranscriptEntities): T $onCommittedTranscriptEntities
   * @param callable(\ElevenLabs\Types\RedactedTranscript): T $onRedactedTranscript
   * @param callable(\ElevenLabs\Types\EditedTranscript): T $onEditedTranscript
   * @param callable(\ElevenLabs\Types\ScribeWarning): T $onScribeWarning
   * @param callable(\ElevenLabs\Types\ScribeError): T $onScribeError
   * @param callable(\ElevenLabs\Types\ScribeAuthError): T $onScribeAuthError
   * @param callable(\ElevenLabs\Types\ScribeQuotaExceededError): T $onScribeQuotaExceededError
   * @param callable(\ElevenLabs\Types\ScribeThrottledError): T $onScribeThrottledError
   * @param callable(\ElevenLabs\Types\ScribeUnacceptedTermsError): T $onScribeUnacceptedTermsError
   * @param callable(\ElevenLabs\Types\ScribeRateLimitedError): T $onScribeRateLimitedError
   * @param callable(\ElevenLabs\Types\ScribeQueueOverflowError): T $onScribeQueueOverflowError
   * @param callable(\ElevenLabs\Types\ScribeResourceExhaustedError): T $onScribeResourceExhaustedError
   * @param callable(\ElevenLabs\Types\ScribeSessionTimeLimitExceededError): T $onScribeSessionTimeLimitExceededError
   * @param callable(\ElevenLabs\Types\ScribeInputError): T $onScribeInputError
   * @param callable(\ElevenLabs\Types\ScribeInvalidRequestError): T $onScribeInvalidRequestError
   * @param callable(\ElevenLabs\Types\ScribeChunkSizeExceededError): T $onScribeChunkSizeExceededError
   * @param callable(\ElevenLabs\Types\ScribeInsufficientAudioActivityError): T $onScribeInsufficientAudioActivityError
   * @param callable(\ElevenLabs\Types\ScribeTranscriberError): T $onScribeTranscriberError
   * @return T
   */
  public function match(
    callable $onSessionStarted,
    callable $onPartialTranscript,
    callable $onCommittedTranscript,
    callable $onDiarizedTranscript,
    callable $onSpeakersMerged,
    callable $onCommittedTranscriptWithTimestamps,
    callable $onCommittedTranscriptEntities,
    callable $onRedactedTranscript,
    callable $onEditedTranscript,
    callable $onScribeWarning,
    callable $onScribeError,
    callable $onScribeAuthError,
    callable $onScribeQuotaExceededError,
    callable $onScribeThrottledError,
    callable $onScribeUnacceptedTermsError,
    callable $onScribeRateLimitedError,
    callable $onScribeQueueOverflowError,
    callable $onScribeResourceExhaustedError,
    callable $onScribeSessionTimeLimitExceededError,
    callable $onScribeInputError,
    callable $onScribeInvalidRequestError,
    callable $onScribeChunkSizeExceededError,
    callable $onScribeInsufficientAudioActivityError,
    callable $onScribeTranscriberError
  ): mixed {
    return match ($this->typeIndex) {
      0 => $onSessionStarted($this->value),
      1 => $onPartialTranscript($this->value),
      2 => $onCommittedTranscript($this->value),
      3 => $onDiarizedTranscript($this->value),
      4 => $onSpeakersMerged($this->value),
      5 => $onCommittedTranscriptWithTimestamps($this->value),
      6 => $onCommittedTranscriptEntities($this->value),
      7 => $onRedactedTranscript($this->value),
      8 => $onEditedTranscript($this->value),
      9 => $onScribeWarning($this->value),
      10 => $onScribeError($this->value),
      11 => $onScribeAuthError($this->value),
      12 => $onScribeQuotaExceededError($this->value),
      13 => $onScribeThrottledError($this->value),
      14 => $onScribeUnacceptedTermsError($this->value),
      15 => $onScribeRateLimitedError($this->value),
      16 => $onScribeQueueOverflowError($this->value),
      17 => $onScribeResourceExhaustedError($this->value),
      18 => $onScribeSessionTimeLimitExceededError($this->value),
      19 => $onScribeInputError($this->value),
      20 => $onScribeInvalidRequestError($this->value),
      21 => $onScribeChunkSizeExceededError($this->value),
      22 => $onScribeInsufficientAudioActivityError($this->value),
      23 => $onScribeTranscriberError($this->value),
      default => throw new \UnexpectedValueException("Unknown type index: $this->typeIndex")
    };
  }

  /**
   * Deserialize from data - try each type in order
   * @param array<string, mixed> $data
   * @return self
   * @throws \InvalidArgumentException if data doesn't match any type
   */
  public static function fromArray(array $data): self
  {
    // Best-match-wins: collect every variant that fromArray() accepted,
    // score each by how many of the input keys it actually consumed
    // (looked up via the per-instance _dirtyFields populated by the
    // variant's own fromArray), then keep the highest-scoring one. Ties
    // break to the first-declared variant because PHP's usort is stable
    // when compared values are equal and we visit variants in order.
    // This is what makes oneOf with overlapping schemas (e.g. Cat & Dog
    // both have `name`, only Cat has `color`) pick the right variant
    // when discriminating fields are present.
    /** @var list<array{instance: mixed, idx: int, score: int}> */
    $candidates = [];
    try {
      $candidate = \ElevenLabs\Types\SessionStarted::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\SessionStarted didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\PartialTranscript::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\PartialTranscript didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\CommittedTranscript::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\CommittedTranscript didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\DiarizedTranscript::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 3, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\DiarizedTranscript didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\SpeakersMerged::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 4, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\SpeakersMerged didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\CommittedTranscriptWithTimestamps::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 5, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\CommittedTranscriptWithTimestamps didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\CommittedTranscriptEntities::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 6, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\CommittedTranscriptEntities didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\RedactedTranscript::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 7, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\RedactedTranscript didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\EditedTranscript::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 8, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\EditedTranscript didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ScribeWarning::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 9, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ScribeWarning didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ScribeError::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 10, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ScribeError didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ScribeAuthError::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 11, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ScribeAuthError didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ScribeQuotaExceededError::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 12, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ScribeQuotaExceededError didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ScribeThrottledError::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 13, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ScribeThrottledError didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ScribeUnacceptedTermsError::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 14, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ScribeUnacceptedTermsError didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ScribeRateLimitedError::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 15, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ScribeRateLimitedError didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ScribeQueueOverflowError::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 16, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ScribeQueueOverflowError didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ScribeResourceExhaustedError::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 17, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ScribeResourceExhaustedError didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ScribeSessionTimeLimitExceededError::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 18, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ScribeSessionTimeLimitExceededError didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ScribeInputError::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 19, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ScribeInputError didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ScribeInvalidRequestError::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 20, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ScribeInvalidRequestError didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ScribeChunkSizeExceededError::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 21, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ScribeChunkSizeExceededError didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ScribeInsufficientAudioActivityError::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 22, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ScribeInsufficientAudioActivityError didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ScribeTranscriberError::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 23, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ScribeTranscriberError didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException('Data does not match any ReceiveTranscription type');
    }
    $best = $candidates[0];
    foreach ($candidates as $candidate) {
      if ($candidate['score'] > $best['score']) {
        $best = $candidate;
      }
    }
    return new self($best['instance'], $best['idx']);
  }

  /**
   * Serialize to JSON - returns the serialized inner value
   *
   * @return array<mixed>
   */
  public function jsonSerialize(): array
  {
    return $this->value->jsonSerialize();
  }
}
