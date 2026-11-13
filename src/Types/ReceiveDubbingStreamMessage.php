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
class ReceiveDubbingStreamMessage extends JsonSerializableType
{
  /**
   * @var string The discriminator value identifying which variant is stored
   */
  public readonly string $messageType;

  /**
   * @var \ElevenLabs\Types\DubbingSessionStarted|\ElevenLabs\Types\DubbingStatus|\ElevenLabs\Types\DubbingPartialTranscript|\ElevenLabs\Types\DubbingCommittedTranscript|\ElevenLabs\Types\DubbingTranslation|\ElevenLabs\Types\DubbingAudio|\ElevenLabs\Types\DubbingErrorPayload|\ElevenLabs\Types\DubbingAuthError|\ElevenLabs\Types\DubbingRateLimitedError|\ElevenLabs\Types\DubbingQueueOverflowError|\ElevenLabs\Types\DubbingInvalidRequestError|\ElevenLabs\Types\DubbingInputError|\ElevenLabs\Types\DubbingTranscriberError|\ElevenLabs\Types\DubbingTranslationError|\ElevenLabs\Types\DubbingAudioOutputError|array<string, mixed> The value, exactly one of the variant types
   */
  public readonly mixed $value;

  /**
   * @var int The type index identifying which variant type is stored
   */
  private int $typeIndex;

  /** The type index of a payload whose discriminator names no variant this SDK knows. */
  private const UNKNOWN = -1;

  /**
   * Whether the payload's discriminator named a variant this SDK does not know (a variant added to
   * the API after this SDK was generated). Its raw payload is kept, as Fern's `_unknown` variant does.
   *
   * Underscore-prefixed because a union may legitimately have a variant NAMED `unknown`, whose own
   * accessors are `isUnknown()`/`asUnknown()`. Declaring both is a fatal `Cannot redeclare` and the
   * class cannot load at all. The prefix matches Fern's `_unknown` sentinel and Java's
   * `_isUnknown()`/`_getUnknown()`, and a variant accessor is always `isX`/`asX`, never `_isX` --
   * so the two can never collide whatever a spec calls its variants.
   */
  public function _isUnknown(): bool
  {
    return $this->typeIndex === self::UNKNOWN;
  }

  /**
   * @return array<string, mixed> The raw payload of an unknown variant
   * @throws \RuntimeException if this ReceiveDubbingStreamMessage holds a known variant
   */
  public function _asUnknown(): array
  {
    if (!$this->_isUnknown()) {
      throw new \RuntimeException(
        'ReceiveDubbingStreamMessage does not contain an unknown variant'
      );
    }
    /** @var array<string, mixed> $value */
    $value = $this->value;
    return $value;
  }

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\DubbingSessionStarted|\ElevenLabs\Types\DubbingStatus|\ElevenLabs\Types\DubbingPartialTranscript|\ElevenLabs\Types\DubbingCommittedTranscript|\ElevenLabs\Types\DubbingTranslation|\ElevenLabs\Types\DubbingAudio|\ElevenLabs\Types\DubbingErrorPayload|\ElevenLabs\Types\DubbingAuthError|\ElevenLabs\Types\DubbingRateLimitedError|\ElevenLabs\Types\DubbingQueueOverflowError|\ElevenLabs\Types\DubbingInvalidRequestError|\ElevenLabs\Types\DubbingInputError|\ElevenLabs\Types\DubbingTranscriberError|\ElevenLabs\Types\DubbingTranslationError|\ElevenLabs\Types\DubbingAudioOutputError|array<string, mixed> $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
    $this->messageType = match ($typeIndex) {
      0 => 'session_started',
      1 => 'status',
      2 => 'partial_transcript',
      3 => 'committed_transcript',
      4 => 'translation',
      5 => 'audio',
      6 => 'error',
      7 => 'auth_error',
      8 => 'rate_limited',
      9 => 'queue_overflow',
      10 => 'invalid_request',
      11 => 'input_error',
      12 => 'transcriber_error',
      13 => 'translation_error',
      14 => 'audio_output_error',
      self::UNKNOWN => '_unknown',
      default => throw new \UnexpectedValueException("Unknown type index: $typeIndex")
    };
  }

  // Factory methods
  /**
   * Create a ReceiveDubbingStreamMessage instance containing a \ElevenLabs\Types\DubbingSessionStarted
   */
  public static function sessionStarted(
    \ElevenLabs\Types\DubbingSessionStarted $sessionStarted
  ): self {
    return new self($sessionStarted, 0);
  }

  /**
   * Create a ReceiveDubbingStreamMessage instance containing a \ElevenLabs\Types\DubbingStatus
   */
  public static function status(\ElevenLabs\Types\DubbingStatus $status): self
  {
    return new self($status, 1);
  }

  /**
   * Create a ReceiveDubbingStreamMessage instance containing a \ElevenLabs\Types\DubbingPartialTranscript
   */
  public static function partialTranscript(
    \ElevenLabs\Types\DubbingPartialTranscript $partialTranscript
  ): self {
    return new self($partialTranscript, 2);
  }

  /**
   * Create a ReceiveDubbingStreamMessage instance containing a \ElevenLabs\Types\DubbingCommittedTranscript
   */
  public static function committedTranscript(
    \ElevenLabs\Types\DubbingCommittedTranscript $committedTranscript
  ): self {
    return new self($committedTranscript, 3);
  }

  /**
   * Create a ReceiveDubbingStreamMessage instance containing a \ElevenLabs\Types\DubbingTranslation
   */
  public static function translation(\ElevenLabs\Types\DubbingTranslation $translation): self
  {
    return new self($translation, 4);
  }

  /**
   * Create a ReceiveDubbingStreamMessage instance containing a \ElevenLabs\Types\DubbingAudio
   */
  public static function audio(\ElevenLabs\Types\DubbingAudio $audio): self
  {
    return new self($audio, 5);
  }

  /**
   * Create a ReceiveDubbingStreamMessage instance containing a \ElevenLabs\Types\DubbingErrorPayload
   */
  public static function error(\ElevenLabs\Types\DubbingErrorPayload $error): self
  {
    return new self($error, 6);
  }

  /**
   * Create a ReceiveDubbingStreamMessage instance containing a \ElevenLabs\Types\DubbingAuthError
   */
  public static function authError(\ElevenLabs\Types\DubbingAuthError $authError): self
  {
    return new self($authError, 7);
  }

  /**
   * Create a ReceiveDubbingStreamMessage instance containing a \ElevenLabs\Types\DubbingRateLimitedError
   */
  public static function rateLimited(\ElevenLabs\Types\DubbingRateLimitedError $rateLimited): self
  {
    return new self($rateLimited, 8);
  }

  /**
   * Create a ReceiveDubbingStreamMessage instance containing a \ElevenLabs\Types\DubbingQueueOverflowError
   */
  public static function queueOverflow(
    \ElevenLabs\Types\DubbingQueueOverflowError $queueOverflow
  ): self {
    return new self($queueOverflow, 9);
  }

  /**
   * Create a ReceiveDubbingStreamMessage instance containing a \ElevenLabs\Types\DubbingInvalidRequestError
   */
  public static function invalidRequest(
    \ElevenLabs\Types\DubbingInvalidRequestError $invalidRequest
  ): self {
    return new self($invalidRequest, 10);
  }

  /**
   * Create a ReceiveDubbingStreamMessage instance containing a \ElevenLabs\Types\DubbingInputError
   */
  public static function inputError(\ElevenLabs\Types\DubbingInputError $inputError): self
  {
    return new self($inputError, 11);
  }

  /**
   * Create a ReceiveDubbingStreamMessage instance containing a \ElevenLabs\Types\DubbingTranscriberError
   */
  public static function transcriberError(
    \ElevenLabs\Types\DubbingTranscriberError $transcriberError
  ): self {
    return new self($transcriberError, 12);
  }

  /**
   * Create a ReceiveDubbingStreamMessage instance containing a \ElevenLabs\Types\DubbingTranslationError
   */
  public static function translationError(
    \ElevenLabs\Types\DubbingTranslationError $translationError
  ): self {
    return new self($translationError, 13);
  }

  /**
   * Create a ReceiveDubbingStreamMessage instance containing a \ElevenLabs\Types\DubbingAudioOutputError
   */
  public static function audioOutputError(
    \ElevenLabs\Types\DubbingAudioOutputError $audioOutputError
  ): self {
    return new self($audioOutputError, 14);
  }

  // Type checking methods
  /**
   * Check if this ReceiveDubbingStreamMessage contains a \ElevenLabs\Types\DubbingSessionStarted
   */
  public function isSessionStarted(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this ReceiveDubbingStreamMessage contains a \ElevenLabs\Types\DubbingStatus
   */
  public function isStatus(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this ReceiveDubbingStreamMessage contains a \ElevenLabs\Types\DubbingPartialTranscript
   */
  public function isPartialTranscript(): bool
  {
    return $this->typeIndex === 2;
  }

  /**
   * Check if this ReceiveDubbingStreamMessage contains a \ElevenLabs\Types\DubbingCommittedTranscript
   */
  public function isCommittedTranscript(): bool
  {
    return $this->typeIndex === 3;
  }

  /**
   * Check if this ReceiveDubbingStreamMessage contains a \ElevenLabs\Types\DubbingTranslation
   */
  public function isTranslation(): bool
  {
    return $this->typeIndex === 4;
  }

  /**
   * Check if this ReceiveDubbingStreamMessage contains a \ElevenLabs\Types\DubbingAudio
   */
  public function isAudio(): bool
  {
    return $this->typeIndex === 5;
  }

  /**
   * Check if this ReceiveDubbingStreamMessage contains a \ElevenLabs\Types\DubbingErrorPayload
   */
  public function isError(): bool
  {
    return $this->typeIndex === 6;
  }

  /**
   * Check if this ReceiveDubbingStreamMessage contains a \ElevenLabs\Types\DubbingAuthError
   */
  public function isAuthError(): bool
  {
    return $this->typeIndex === 7;
  }

  /**
   * Check if this ReceiveDubbingStreamMessage contains a \ElevenLabs\Types\DubbingRateLimitedError
   */
  public function isRateLimited(): bool
  {
    return $this->typeIndex === 8;
  }

  /**
   * Check if this ReceiveDubbingStreamMessage contains a \ElevenLabs\Types\DubbingQueueOverflowError
   */
  public function isQueueOverflow(): bool
  {
    return $this->typeIndex === 9;
  }

  /**
   * Check if this ReceiveDubbingStreamMessage contains a \ElevenLabs\Types\DubbingInvalidRequestError
   */
  public function isInvalidRequest(): bool
  {
    return $this->typeIndex === 10;
  }

  /**
   * Check if this ReceiveDubbingStreamMessage contains a \ElevenLabs\Types\DubbingInputError
   */
  public function isInputError(): bool
  {
    return $this->typeIndex === 11;
  }

  /**
   * Check if this ReceiveDubbingStreamMessage contains a \ElevenLabs\Types\DubbingTranscriberError
   */
  public function isTranscriberError(): bool
  {
    return $this->typeIndex === 12;
  }

  /**
   * Check if this ReceiveDubbingStreamMessage contains a \ElevenLabs\Types\DubbingTranslationError
   */
  public function isTranslationError(): bool
  {
    return $this->typeIndex === 13;
  }

  /**
   * Check if this ReceiveDubbingStreamMessage contains a \ElevenLabs\Types\DubbingAudioOutputError
   */
  public function isAudioOutputError(): bool
  {
    return $this->typeIndex === 14;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\DubbingSessionStarted value
   * @throws \RuntimeException if this ReceiveDubbingStreamMessage does not contain a \ElevenLabs\Types\DubbingSessionStarted
   */
  public function asSessionStarted(): \ElevenLabs\Types\DubbingSessionStarted
  {
    if (!$this->isSessionStarted()) {
      throw new \RuntimeException(
        'ReceiveDubbingStreamMessage does not contain \ElevenLabs\Types\DubbingSessionStarted'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\DubbingStatus value
   * @throws \RuntimeException if this ReceiveDubbingStreamMessage does not contain a \ElevenLabs\Types\DubbingStatus
   */
  public function asStatus(): \ElevenLabs\Types\DubbingStatus
  {
    if (!$this->isStatus()) {
      throw new \RuntimeException(
        'ReceiveDubbingStreamMessage does not contain \ElevenLabs\Types\DubbingStatus'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\DubbingPartialTranscript value
   * @throws \RuntimeException if this ReceiveDubbingStreamMessage does not contain a \ElevenLabs\Types\DubbingPartialTranscript
   */
  public function asPartialTranscript(): \ElevenLabs\Types\DubbingPartialTranscript
  {
    if (!$this->isPartialTranscript()) {
      throw new \RuntimeException(
        'ReceiveDubbingStreamMessage does not contain \ElevenLabs\Types\DubbingPartialTranscript'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\DubbingCommittedTranscript value
   * @throws \RuntimeException if this ReceiveDubbingStreamMessage does not contain a \ElevenLabs\Types\DubbingCommittedTranscript
   */
  public function asCommittedTranscript(): \ElevenLabs\Types\DubbingCommittedTranscript
  {
    if (!$this->isCommittedTranscript()) {
      throw new \RuntimeException(
        'ReceiveDubbingStreamMessage does not contain \ElevenLabs\Types\DubbingCommittedTranscript'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\DubbingTranslation value
   * @throws \RuntimeException if this ReceiveDubbingStreamMessage does not contain a \ElevenLabs\Types\DubbingTranslation
   */
  public function asTranslation(): \ElevenLabs\Types\DubbingTranslation
  {
    if (!$this->isTranslation()) {
      throw new \RuntimeException(
        'ReceiveDubbingStreamMessage does not contain \ElevenLabs\Types\DubbingTranslation'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\DubbingAudio value
   * @throws \RuntimeException if this ReceiveDubbingStreamMessage does not contain a \ElevenLabs\Types\DubbingAudio
   */
  public function asAudio(): \ElevenLabs\Types\DubbingAudio
  {
    if (!$this->isAudio()) {
      throw new \RuntimeException(
        'ReceiveDubbingStreamMessage does not contain \ElevenLabs\Types\DubbingAudio'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\DubbingErrorPayload value
   * @throws \RuntimeException if this ReceiveDubbingStreamMessage does not contain a \ElevenLabs\Types\DubbingErrorPayload
   */
  public function asError(): \ElevenLabs\Types\DubbingErrorPayload
  {
    if (!$this->isError()) {
      throw new \RuntimeException(
        'ReceiveDubbingStreamMessage does not contain \ElevenLabs\Types\DubbingErrorPayload'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\DubbingAuthError value
   * @throws \RuntimeException if this ReceiveDubbingStreamMessage does not contain a \ElevenLabs\Types\DubbingAuthError
   */
  public function asAuthError(): \ElevenLabs\Types\DubbingAuthError
  {
    if (!$this->isAuthError()) {
      throw new \RuntimeException(
        'ReceiveDubbingStreamMessage does not contain \ElevenLabs\Types\DubbingAuthError'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\DubbingRateLimitedError value
   * @throws \RuntimeException if this ReceiveDubbingStreamMessage does not contain a \ElevenLabs\Types\DubbingRateLimitedError
   */
  public function asRateLimited(): \ElevenLabs\Types\DubbingRateLimitedError
  {
    if (!$this->isRateLimited()) {
      throw new \RuntimeException(
        'ReceiveDubbingStreamMessage does not contain \ElevenLabs\Types\DubbingRateLimitedError'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\DubbingQueueOverflowError value
   * @throws \RuntimeException if this ReceiveDubbingStreamMessage does not contain a \ElevenLabs\Types\DubbingQueueOverflowError
   */
  public function asQueueOverflow(): \ElevenLabs\Types\DubbingQueueOverflowError
  {
    if (!$this->isQueueOverflow()) {
      throw new \RuntimeException(
        'ReceiveDubbingStreamMessage does not contain \ElevenLabs\Types\DubbingQueueOverflowError'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\DubbingInvalidRequestError value
   * @throws \RuntimeException if this ReceiveDubbingStreamMessage does not contain a \ElevenLabs\Types\DubbingInvalidRequestError
   */
  public function asInvalidRequest(): \ElevenLabs\Types\DubbingInvalidRequestError
  {
    if (!$this->isInvalidRequest()) {
      throw new \RuntimeException(
        'ReceiveDubbingStreamMessage does not contain \ElevenLabs\Types\DubbingInvalidRequestError'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\DubbingInputError value
   * @throws \RuntimeException if this ReceiveDubbingStreamMessage does not contain a \ElevenLabs\Types\DubbingInputError
   */
  public function asInputError(): \ElevenLabs\Types\DubbingInputError
  {
    if (!$this->isInputError()) {
      throw new \RuntimeException(
        'ReceiveDubbingStreamMessage does not contain \ElevenLabs\Types\DubbingInputError'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\DubbingTranscriberError value
   * @throws \RuntimeException if this ReceiveDubbingStreamMessage does not contain a \ElevenLabs\Types\DubbingTranscriberError
   */
  public function asTranscriberError(): \ElevenLabs\Types\DubbingTranscriberError
  {
    if (!$this->isTranscriberError()) {
      throw new \RuntimeException(
        'ReceiveDubbingStreamMessage does not contain \ElevenLabs\Types\DubbingTranscriberError'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\DubbingTranslationError value
   * @throws \RuntimeException if this ReceiveDubbingStreamMessage does not contain a \ElevenLabs\Types\DubbingTranslationError
   */
  public function asTranslationError(): \ElevenLabs\Types\DubbingTranslationError
  {
    if (!$this->isTranslationError()) {
      throw new \RuntimeException(
        'ReceiveDubbingStreamMessage does not contain \ElevenLabs\Types\DubbingTranslationError'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\DubbingAudioOutputError value
   * @throws \RuntimeException if this ReceiveDubbingStreamMessage does not contain a \ElevenLabs\Types\DubbingAudioOutputError
   */
  public function asAudioOutputError(): \ElevenLabs\Types\DubbingAudioOutputError
  {
    if (!$this->isAudioOutputError()) {
      throw new \RuntimeException(
        'ReceiveDubbingStreamMessage does not contain \ElevenLabs\Types\DubbingAudioOutputError'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\DubbingSessionStarted value
   * @return \ElevenLabs\Types\DubbingSessionStarted|null Returns the value if this ReceiveDubbingStreamMessage contains a \ElevenLabs\Types\DubbingSessionStarted, null otherwise
   */
  public function tryAsSessionStarted(): ?\ElevenLabs\Types\DubbingSessionStarted
  {
    return $this->isSessionStarted() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\DubbingStatus value
   * @return \ElevenLabs\Types\DubbingStatus|null Returns the value if this ReceiveDubbingStreamMessage contains a \ElevenLabs\Types\DubbingStatus, null otherwise
   */
  public function tryAsStatus(): ?\ElevenLabs\Types\DubbingStatus
  {
    return $this->isStatus() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\DubbingPartialTranscript value
   * @return \ElevenLabs\Types\DubbingPartialTranscript|null Returns the value if this ReceiveDubbingStreamMessage contains a \ElevenLabs\Types\DubbingPartialTranscript, null otherwise
   */
  public function tryAsPartialTranscript(): ?\ElevenLabs\Types\DubbingPartialTranscript
  {
    return $this->isPartialTranscript() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\DubbingCommittedTranscript value
   * @return \ElevenLabs\Types\DubbingCommittedTranscript|null Returns the value if this ReceiveDubbingStreamMessage contains a \ElevenLabs\Types\DubbingCommittedTranscript, null otherwise
   */
  public function tryAsCommittedTranscript(): ?\ElevenLabs\Types\DubbingCommittedTranscript
  {
    return $this->isCommittedTranscript() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\DubbingTranslation value
   * @return \ElevenLabs\Types\DubbingTranslation|null Returns the value if this ReceiveDubbingStreamMessage contains a \ElevenLabs\Types\DubbingTranslation, null otherwise
   */
  public function tryAsTranslation(): ?\ElevenLabs\Types\DubbingTranslation
  {
    return $this->isTranslation() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\DubbingAudio value
   * @return \ElevenLabs\Types\DubbingAudio|null Returns the value if this ReceiveDubbingStreamMessage contains a \ElevenLabs\Types\DubbingAudio, null otherwise
   */
  public function tryAsAudio(): ?\ElevenLabs\Types\DubbingAudio
  {
    return $this->isAudio() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\DubbingErrorPayload value
   * @return \ElevenLabs\Types\DubbingErrorPayload|null Returns the value if this ReceiveDubbingStreamMessage contains a \ElevenLabs\Types\DubbingErrorPayload, null otherwise
   */
  public function tryAsError(): ?\ElevenLabs\Types\DubbingErrorPayload
  {
    return $this->isError() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\DubbingAuthError value
   * @return \ElevenLabs\Types\DubbingAuthError|null Returns the value if this ReceiveDubbingStreamMessage contains a \ElevenLabs\Types\DubbingAuthError, null otherwise
   */
  public function tryAsAuthError(): ?\ElevenLabs\Types\DubbingAuthError
  {
    return $this->isAuthError() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\DubbingRateLimitedError value
   * @return \ElevenLabs\Types\DubbingRateLimitedError|null Returns the value if this ReceiveDubbingStreamMessage contains a \ElevenLabs\Types\DubbingRateLimitedError, null otherwise
   */
  public function tryAsRateLimited(): ?\ElevenLabs\Types\DubbingRateLimitedError
  {
    return $this->isRateLimited() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\DubbingQueueOverflowError value
   * @return \ElevenLabs\Types\DubbingQueueOverflowError|null Returns the value if this ReceiveDubbingStreamMessage contains a \ElevenLabs\Types\DubbingQueueOverflowError, null otherwise
   */
  public function tryAsQueueOverflow(): ?\ElevenLabs\Types\DubbingQueueOverflowError
  {
    return $this->isQueueOverflow() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\DubbingInvalidRequestError value
   * @return \ElevenLabs\Types\DubbingInvalidRequestError|null Returns the value if this ReceiveDubbingStreamMessage contains a \ElevenLabs\Types\DubbingInvalidRequestError, null otherwise
   */
  public function tryAsInvalidRequest(): ?\ElevenLabs\Types\DubbingInvalidRequestError
  {
    return $this->isInvalidRequest() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\DubbingInputError value
   * @return \ElevenLabs\Types\DubbingInputError|null Returns the value if this ReceiveDubbingStreamMessage contains a \ElevenLabs\Types\DubbingInputError, null otherwise
   */
  public function tryAsInputError(): ?\ElevenLabs\Types\DubbingInputError
  {
    return $this->isInputError() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\DubbingTranscriberError value
   * @return \ElevenLabs\Types\DubbingTranscriberError|null Returns the value if this ReceiveDubbingStreamMessage contains a \ElevenLabs\Types\DubbingTranscriberError, null otherwise
   */
  public function tryAsTranscriberError(): ?\ElevenLabs\Types\DubbingTranscriberError
  {
    return $this->isTranscriberError() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\DubbingTranslationError value
   * @return \ElevenLabs\Types\DubbingTranslationError|null Returns the value if this ReceiveDubbingStreamMessage contains a \ElevenLabs\Types\DubbingTranslationError, null otherwise
   */
  public function tryAsTranslationError(): ?\ElevenLabs\Types\DubbingTranslationError
  {
    return $this->isTranslationError() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\DubbingAudioOutputError value
   * @return \ElevenLabs\Types\DubbingAudioOutputError|null Returns the value if this ReceiveDubbingStreamMessage contains a \ElevenLabs\Types\DubbingAudioOutputError, null otherwise
   */
  public function tryAsAudioOutputError(): ?\ElevenLabs\Types\DubbingAudioOutputError
  {
    return $this->isAudioOutputError() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\DubbingSessionStarted): T $onSessionStarted
   * @param callable(\ElevenLabs\Types\DubbingStatus): T $onStatus
   * @param callable(\ElevenLabs\Types\DubbingPartialTranscript): T $onPartialTranscript
   * @param callable(\ElevenLabs\Types\DubbingCommittedTranscript): T $onCommittedTranscript
   * @param callable(\ElevenLabs\Types\DubbingTranslation): T $onTranslation
   * @param callable(\ElevenLabs\Types\DubbingAudio): T $onAudio
   * @param callable(\ElevenLabs\Types\DubbingErrorPayload): T $onError
   * @param callable(\ElevenLabs\Types\DubbingAuthError): T $onAuthError
   * @param callable(\ElevenLabs\Types\DubbingRateLimitedError): T $onRateLimited
   * @param callable(\ElevenLabs\Types\DubbingQueueOverflowError): T $onQueueOverflow
   * @param callable(\ElevenLabs\Types\DubbingInvalidRequestError): T $onInvalidRequest
   * @param callable(\ElevenLabs\Types\DubbingInputError): T $onInputError
   * @param callable(\ElevenLabs\Types\DubbingTranscriberError): T $onTranscriberError
   * @param callable(\ElevenLabs\Types\DubbingTranslationError): T $onTranslationError
   * @param callable(\ElevenLabs\Types\DubbingAudioOutputError): T $onAudioOutputError
   * @return T
   */
  public function match(
    callable $onSessionStarted,
    callable $onStatus,
    callable $onPartialTranscript,
    callable $onCommittedTranscript,
    callable $onTranslation,
    callable $onAudio,
    callable $onError,
    callable $onAuthError,
    callable $onRateLimited,
    callable $onQueueOverflow,
    callable $onInvalidRequest,
    callable $onInputError,
    callable $onTranscriberError,
    callable $onTranslationError,
    callable $onAudioOutputError
  ): mixed {
    return match ($this->typeIndex) {
      0 => $onSessionStarted($this->value),
      1 => $onStatus($this->value),
      2 => $onPartialTranscript($this->value),
      3 => $onCommittedTranscript($this->value),
      4 => $onTranslation($this->value),
      5 => $onAudio($this->value),
      6 => $onError($this->value),
      7 => $onAuthError($this->value),
      8 => $onRateLimited($this->value),
      9 => $onQueueOverflow($this->value),
      10 => $onInvalidRequest($this->value),
      11 => $onInputError($this->value),
      12 => $onTranscriberError($this->value),
      13 => $onTranslationError($this->value),
      14 => $onAudioOutputError($this->value),
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
    // The payload's own discriminator value picks the variant. Scoring alone ties whenever two
    // members have the same shape and differ only in that constant, and the first would win.
    if (is_array($data) && isset($data['message_type']) && is_string($data['message_type'])) {
      switch ($data['message_type']) {
        case 'session_started':
          return new self(\ElevenLabs\Types\DubbingSessionStarted::fromArray($data), 0);
        case 'status':
          return new self(\ElevenLabs\Types\DubbingStatus::fromArray($data), 1);
        case 'partial_transcript':
          return new self(\ElevenLabs\Types\DubbingPartialTranscript::fromArray($data), 2);
        case 'committed_transcript':
          return new self(\ElevenLabs\Types\DubbingCommittedTranscript::fromArray($data), 3);
        case 'translation':
          return new self(\ElevenLabs\Types\DubbingTranslation::fromArray($data), 4);
        case 'audio':
          return new self(\ElevenLabs\Types\DubbingAudio::fromArray($data), 5);
        case 'error':
          return new self(\ElevenLabs\Types\DubbingErrorPayload::fromArray($data), 6);
        case 'auth_error':
          return new self(\ElevenLabs\Types\DubbingAuthError::fromArray($data), 7);
        case 'rate_limited':
          return new self(\ElevenLabs\Types\DubbingRateLimitedError::fromArray($data), 8);
        case 'queue_overflow':
          return new self(\ElevenLabs\Types\DubbingQueueOverflowError::fromArray($data), 9);
        case 'invalid_request':
          return new self(\ElevenLabs\Types\DubbingInvalidRequestError::fromArray($data), 10);
        case 'input_error':
          return new self(\ElevenLabs\Types\DubbingInputError::fromArray($data), 11);
        case 'transcriber_error':
          return new self(\ElevenLabs\Types\DubbingTranscriberError::fromArray($data), 12);
        case 'translation_error':
          return new self(\ElevenLabs\Types\DubbingTranslationError::fromArray($data), 13);
        case 'audio_output_error':
          return new self(\ElevenLabs\Types\DubbingAudioOutputError::fromArray($data), 14);
        default:
          // A variant the API added after this SDK was generated: kept, not rejected.
          return new self($data, self::UNKNOWN);
      }
    }

    /** @var list<array{instance: mixed, idx: int, score: int}> */
    $candidates = [];
    try {
      $candidate = \ElevenLabs\Types\DubbingSessionStarted::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\DubbingSessionStarted didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\DubbingStatus::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\DubbingStatus didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\DubbingPartialTranscript::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\DubbingPartialTranscript didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\DubbingCommittedTranscript::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 3, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\DubbingCommittedTranscript didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\DubbingTranslation::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 4, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\DubbingTranslation didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\DubbingAudio::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 5, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\DubbingAudio didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\DubbingErrorPayload::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 6, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\DubbingErrorPayload didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\DubbingAuthError::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 7, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\DubbingAuthError didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\DubbingRateLimitedError::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 8, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\DubbingRateLimitedError didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\DubbingQueueOverflowError::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 9, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\DubbingQueueOverflowError didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\DubbingInvalidRequestError::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 10, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\DubbingInvalidRequestError didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\DubbingInputError::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 11, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\DubbingInputError didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\DubbingTranscriberError::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 12, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\DubbingTranscriberError didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\DubbingTranslationError::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 13, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\DubbingTranslationError didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\DubbingAudioOutputError::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 14, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\DubbingAudioOutputError didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException(
        'Data does not match any ReceiveDubbingStreamMessage type'
      );
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
    if ($this->_isUnknown()) {
      return $this->_asUnknown();
    }
    return $this->value->jsonSerialize();
  }
}
