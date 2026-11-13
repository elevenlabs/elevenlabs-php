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
class ReceiveTranslateStreamMessage extends JsonSerializableType
{
  /**
   * @var string The discriminator value identifying which variant is stored
   */
  public readonly string $messageType;

  /**
   * @var \ElevenLabs\Types\TranslateSessionStarted|\ElevenLabs\Types\TranslateStatus|\ElevenLabs\Types\TranslatePartialTranscript|\ElevenLabs\Types\TranslateFinalTranscript|\ElevenLabs\Types\TranslateTranslation|\ElevenLabs\Types\TranslateAudio|\ElevenLabs\Types\TranslateError|\ElevenLabs\Types\TranslateAuthError|\ElevenLabs\Types\TranslateRateLimitedError|\ElevenLabs\Types\TranslateQueueOverflowError|\ElevenLabs\Types\TranslateInputError|\ElevenLabs\Types\TranslateTranscriberError|\ElevenLabs\Types\TranslateTranslationError|\ElevenLabs\Types\TranslateAudioOutputError|\ElevenLabs\Types\TranslateQuotaExceededError|\ElevenLabs\Types\TranslatePaymentIssueError|\ElevenLabs\Types\TranslateUnacceptedTermsError|array<string, mixed> The value, exactly one of the variant types
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
   * @throws \RuntimeException if this ReceiveTranslateStreamMessage holds a known variant
   */
  public function _asUnknown(): array
  {
    if (!$this->_isUnknown()) {
      throw new \RuntimeException(
        'ReceiveTranslateStreamMessage does not contain an unknown variant'
      );
    }
    /** @var array<string, mixed> $value */
    $value = $this->value;
    return $value;
  }

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\TranslateSessionStarted|\ElevenLabs\Types\TranslateStatus|\ElevenLabs\Types\TranslatePartialTranscript|\ElevenLabs\Types\TranslateFinalTranscript|\ElevenLabs\Types\TranslateTranslation|\ElevenLabs\Types\TranslateAudio|\ElevenLabs\Types\TranslateError|\ElevenLabs\Types\TranslateAuthError|\ElevenLabs\Types\TranslateRateLimitedError|\ElevenLabs\Types\TranslateQueueOverflowError|\ElevenLabs\Types\TranslateInputError|\ElevenLabs\Types\TranslateTranscriberError|\ElevenLabs\Types\TranslateTranslationError|\ElevenLabs\Types\TranslateAudioOutputError|\ElevenLabs\Types\TranslateQuotaExceededError|\ElevenLabs\Types\TranslatePaymentIssueError|\ElevenLabs\Types\TranslateUnacceptedTermsError|array<string, mixed> $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
    $this->messageType = match ($typeIndex) {
      0 => 'session_started',
      1 => 'status',
      2 => 'partial_transcript',
      3 => 'final_transcript',
      4 => 'translation',
      5 => 'audio',
      6 => 'error',
      7 => 'auth_error',
      8 => 'rate_limited',
      9 => 'queue_overflow',
      10 => 'input_error',
      11 => 'transcriber_error',
      12 => 'translation_error',
      13 => 'audio_output_error',
      14 => 'quota_exceeded',
      15 => 'payment_issue',
      16 => 'unaccepted_terms',
      self::UNKNOWN => '_unknown',
      default => throw new \UnexpectedValueException("Unknown type index: $typeIndex")
    };
  }

  // Factory methods
  /**
   * Create a ReceiveTranslateStreamMessage instance containing a \ElevenLabs\Types\TranslateSessionStarted
   */
  public static function sessionStarted(
    \ElevenLabs\Types\TranslateSessionStarted $sessionStarted
  ): self {
    return new self($sessionStarted, 0);
  }

  /**
   * Create a ReceiveTranslateStreamMessage instance containing a \ElevenLabs\Types\TranslateStatus
   */
  public static function status(\ElevenLabs\Types\TranslateStatus $status): self
  {
    return new self($status, 1);
  }

  /**
   * Create a ReceiveTranslateStreamMessage instance containing a \ElevenLabs\Types\TranslatePartialTranscript
   */
  public static function partialTranscript(
    \ElevenLabs\Types\TranslatePartialTranscript $partialTranscript
  ): self {
    return new self($partialTranscript, 2);
  }

  /**
   * Create a ReceiveTranslateStreamMessage instance containing a \ElevenLabs\Types\TranslateFinalTranscript
   */
  public static function finalTranscript(
    \ElevenLabs\Types\TranslateFinalTranscript $finalTranscript
  ): self {
    return new self($finalTranscript, 3);
  }

  /**
   * Create a ReceiveTranslateStreamMessage instance containing a \ElevenLabs\Types\TranslateTranslation
   */
  public static function translation(\ElevenLabs\Types\TranslateTranslation $translation): self
  {
    return new self($translation, 4);
  }

  /**
   * Create a ReceiveTranslateStreamMessage instance containing a \ElevenLabs\Types\TranslateAudio
   */
  public static function audio(\ElevenLabs\Types\TranslateAudio $audio): self
  {
    return new self($audio, 5);
  }

  /**
   * Create a ReceiveTranslateStreamMessage instance containing a \ElevenLabs\Types\TranslateError
   */
  public static function error(\ElevenLabs\Types\TranslateError $error): self
  {
    return new self($error, 6);
  }

  /**
   * Create a ReceiveTranslateStreamMessage instance containing a \ElevenLabs\Types\TranslateAuthError
   */
  public static function authError(\ElevenLabs\Types\TranslateAuthError $authError): self
  {
    return new self($authError, 7);
  }

  /**
   * Create a ReceiveTranslateStreamMessage instance containing a \ElevenLabs\Types\TranslateRateLimitedError
   */
  public static function rateLimited(\ElevenLabs\Types\TranslateRateLimitedError $rateLimited): self
  {
    return new self($rateLimited, 8);
  }

  /**
   * Create a ReceiveTranslateStreamMessage instance containing a \ElevenLabs\Types\TranslateQueueOverflowError
   */
  public static function queueOverflow(
    \ElevenLabs\Types\TranslateQueueOverflowError $queueOverflow
  ): self {
    return new self($queueOverflow, 9);
  }

  /**
   * Create a ReceiveTranslateStreamMessage instance containing a \ElevenLabs\Types\TranslateInputError
   */
  public static function inputError(\ElevenLabs\Types\TranslateInputError $inputError): self
  {
    return new self($inputError, 10);
  }

  /**
   * Create a ReceiveTranslateStreamMessage instance containing a \ElevenLabs\Types\TranslateTranscriberError
   */
  public static function transcriberError(
    \ElevenLabs\Types\TranslateTranscriberError $transcriberError
  ): self {
    return new self($transcriberError, 11);
  }

  /**
   * Create a ReceiveTranslateStreamMessage instance containing a \ElevenLabs\Types\TranslateTranslationError
   */
  public static function translationError(
    \ElevenLabs\Types\TranslateTranslationError $translationError
  ): self {
    return new self($translationError, 12);
  }

  /**
   * Create a ReceiveTranslateStreamMessage instance containing a \ElevenLabs\Types\TranslateAudioOutputError
   */
  public static function audioOutputError(
    \ElevenLabs\Types\TranslateAudioOutputError $audioOutputError
  ): self {
    return new self($audioOutputError, 13);
  }

  /**
   * Create a ReceiveTranslateStreamMessage instance containing a \ElevenLabs\Types\TranslateQuotaExceededError
   */
  public static function quotaExceeded(
    \ElevenLabs\Types\TranslateQuotaExceededError $quotaExceeded
  ): self {
    return new self($quotaExceeded, 14);
  }

  /**
   * Create a ReceiveTranslateStreamMessage instance containing a \ElevenLabs\Types\TranslatePaymentIssueError
   */
  public static function paymentIssue(
    \ElevenLabs\Types\TranslatePaymentIssueError $paymentIssue
  ): self {
    return new self($paymentIssue, 15);
  }

  /**
   * Create a ReceiveTranslateStreamMessage instance containing a \ElevenLabs\Types\TranslateUnacceptedTermsError
   */
  public static function unacceptedTerms(
    \ElevenLabs\Types\TranslateUnacceptedTermsError $unacceptedTerms
  ): self {
    return new self($unacceptedTerms, 16);
  }

  // Type checking methods
  /**
   * Check if this ReceiveTranslateStreamMessage contains a \ElevenLabs\Types\TranslateSessionStarted
   */
  public function isSessionStarted(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this ReceiveTranslateStreamMessage contains a \ElevenLabs\Types\TranslateStatus
   */
  public function isStatus(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this ReceiveTranslateStreamMessage contains a \ElevenLabs\Types\TranslatePartialTranscript
   */
  public function isPartialTranscript(): bool
  {
    return $this->typeIndex === 2;
  }

  /**
   * Check if this ReceiveTranslateStreamMessage contains a \ElevenLabs\Types\TranslateFinalTranscript
   */
  public function isFinalTranscript(): bool
  {
    return $this->typeIndex === 3;
  }

  /**
   * Check if this ReceiveTranslateStreamMessage contains a \ElevenLabs\Types\TranslateTranslation
   */
  public function isTranslation(): bool
  {
    return $this->typeIndex === 4;
  }

  /**
   * Check if this ReceiveTranslateStreamMessage contains a \ElevenLabs\Types\TranslateAudio
   */
  public function isAudio(): bool
  {
    return $this->typeIndex === 5;
  }

  /**
   * Check if this ReceiveTranslateStreamMessage contains a \ElevenLabs\Types\TranslateError
   */
  public function isError(): bool
  {
    return $this->typeIndex === 6;
  }

  /**
   * Check if this ReceiveTranslateStreamMessage contains a \ElevenLabs\Types\TranslateAuthError
   */
  public function isAuthError(): bool
  {
    return $this->typeIndex === 7;
  }

  /**
   * Check if this ReceiveTranslateStreamMessage contains a \ElevenLabs\Types\TranslateRateLimitedError
   */
  public function isRateLimited(): bool
  {
    return $this->typeIndex === 8;
  }

  /**
   * Check if this ReceiveTranslateStreamMessage contains a \ElevenLabs\Types\TranslateQueueOverflowError
   */
  public function isQueueOverflow(): bool
  {
    return $this->typeIndex === 9;
  }

  /**
   * Check if this ReceiveTranslateStreamMessage contains a \ElevenLabs\Types\TranslateInputError
   */
  public function isInputError(): bool
  {
    return $this->typeIndex === 10;
  }

  /**
   * Check if this ReceiveTranslateStreamMessage contains a \ElevenLabs\Types\TranslateTranscriberError
   */
  public function isTranscriberError(): bool
  {
    return $this->typeIndex === 11;
  }

  /**
   * Check if this ReceiveTranslateStreamMessage contains a \ElevenLabs\Types\TranslateTranslationError
   */
  public function isTranslationError(): bool
  {
    return $this->typeIndex === 12;
  }

  /**
   * Check if this ReceiveTranslateStreamMessage contains a \ElevenLabs\Types\TranslateAudioOutputError
   */
  public function isAudioOutputError(): bool
  {
    return $this->typeIndex === 13;
  }

  /**
   * Check if this ReceiveTranslateStreamMessage contains a \ElevenLabs\Types\TranslateQuotaExceededError
   */
  public function isQuotaExceeded(): bool
  {
    return $this->typeIndex === 14;
  }

  /**
   * Check if this ReceiveTranslateStreamMessage contains a \ElevenLabs\Types\TranslatePaymentIssueError
   */
  public function isPaymentIssue(): bool
  {
    return $this->typeIndex === 15;
  }

  /**
   * Check if this ReceiveTranslateStreamMessage contains a \ElevenLabs\Types\TranslateUnacceptedTermsError
   */
  public function isUnacceptedTerms(): bool
  {
    return $this->typeIndex === 16;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\TranslateSessionStarted value
   * @throws \RuntimeException if this ReceiveTranslateStreamMessage does not contain a \ElevenLabs\Types\TranslateSessionStarted
   */
  public function asSessionStarted(): \ElevenLabs\Types\TranslateSessionStarted
  {
    if (!$this->isSessionStarted()) {
      throw new \RuntimeException(
        'ReceiveTranslateStreamMessage does not contain \ElevenLabs\Types\TranslateSessionStarted'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\TranslateStatus value
   * @throws \RuntimeException if this ReceiveTranslateStreamMessage does not contain a \ElevenLabs\Types\TranslateStatus
   */
  public function asStatus(): \ElevenLabs\Types\TranslateStatus
  {
    if (!$this->isStatus()) {
      throw new \RuntimeException(
        'ReceiveTranslateStreamMessage does not contain \ElevenLabs\Types\TranslateStatus'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\TranslatePartialTranscript value
   * @throws \RuntimeException if this ReceiveTranslateStreamMessage does not contain a \ElevenLabs\Types\TranslatePartialTranscript
   */
  public function asPartialTranscript(): \ElevenLabs\Types\TranslatePartialTranscript
  {
    if (!$this->isPartialTranscript()) {
      throw new \RuntimeException(
        'ReceiveTranslateStreamMessage does not contain \ElevenLabs\Types\TranslatePartialTranscript'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\TranslateFinalTranscript value
   * @throws \RuntimeException if this ReceiveTranslateStreamMessage does not contain a \ElevenLabs\Types\TranslateFinalTranscript
   */
  public function asFinalTranscript(): \ElevenLabs\Types\TranslateFinalTranscript
  {
    if (!$this->isFinalTranscript()) {
      throw new \RuntimeException(
        'ReceiveTranslateStreamMessage does not contain \ElevenLabs\Types\TranslateFinalTranscript'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\TranslateTranslation value
   * @throws \RuntimeException if this ReceiveTranslateStreamMessage does not contain a \ElevenLabs\Types\TranslateTranslation
   */
  public function asTranslation(): \ElevenLabs\Types\TranslateTranslation
  {
    if (!$this->isTranslation()) {
      throw new \RuntimeException(
        'ReceiveTranslateStreamMessage does not contain \ElevenLabs\Types\TranslateTranslation'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\TranslateAudio value
   * @throws \RuntimeException if this ReceiveTranslateStreamMessage does not contain a \ElevenLabs\Types\TranslateAudio
   */
  public function asAudio(): \ElevenLabs\Types\TranslateAudio
  {
    if (!$this->isAudio()) {
      throw new \RuntimeException(
        'ReceiveTranslateStreamMessage does not contain \ElevenLabs\Types\TranslateAudio'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\TranslateError value
   * @throws \RuntimeException if this ReceiveTranslateStreamMessage does not contain a \ElevenLabs\Types\TranslateError
   */
  public function asError(): \ElevenLabs\Types\TranslateError
  {
    if (!$this->isError()) {
      throw new \RuntimeException(
        'ReceiveTranslateStreamMessage does not contain \ElevenLabs\Types\TranslateError'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\TranslateAuthError value
   * @throws \RuntimeException if this ReceiveTranslateStreamMessage does not contain a \ElevenLabs\Types\TranslateAuthError
   */
  public function asAuthError(): \ElevenLabs\Types\TranslateAuthError
  {
    if (!$this->isAuthError()) {
      throw new \RuntimeException(
        'ReceiveTranslateStreamMessage does not contain \ElevenLabs\Types\TranslateAuthError'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\TranslateRateLimitedError value
   * @throws \RuntimeException if this ReceiveTranslateStreamMessage does not contain a \ElevenLabs\Types\TranslateRateLimitedError
   */
  public function asRateLimited(): \ElevenLabs\Types\TranslateRateLimitedError
  {
    if (!$this->isRateLimited()) {
      throw new \RuntimeException(
        'ReceiveTranslateStreamMessage does not contain \ElevenLabs\Types\TranslateRateLimitedError'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\TranslateQueueOverflowError value
   * @throws \RuntimeException if this ReceiveTranslateStreamMessage does not contain a \ElevenLabs\Types\TranslateQueueOverflowError
   */
  public function asQueueOverflow(): \ElevenLabs\Types\TranslateQueueOverflowError
  {
    if (!$this->isQueueOverflow()) {
      throw new \RuntimeException(
        'ReceiveTranslateStreamMessage does not contain \ElevenLabs\Types\TranslateQueueOverflowError'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\TranslateInputError value
   * @throws \RuntimeException if this ReceiveTranslateStreamMessage does not contain a \ElevenLabs\Types\TranslateInputError
   */
  public function asInputError(): \ElevenLabs\Types\TranslateInputError
  {
    if (!$this->isInputError()) {
      throw new \RuntimeException(
        'ReceiveTranslateStreamMessage does not contain \ElevenLabs\Types\TranslateInputError'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\TranslateTranscriberError value
   * @throws \RuntimeException if this ReceiveTranslateStreamMessage does not contain a \ElevenLabs\Types\TranslateTranscriberError
   */
  public function asTranscriberError(): \ElevenLabs\Types\TranslateTranscriberError
  {
    if (!$this->isTranscriberError()) {
      throw new \RuntimeException(
        'ReceiveTranslateStreamMessage does not contain \ElevenLabs\Types\TranslateTranscriberError'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\TranslateTranslationError value
   * @throws \RuntimeException if this ReceiveTranslateStreamMessage does not contain a \ElevenLabs\Types\TranslateTranslationError
   */
  public function asTranslationError(): \ElevenLabs\Types\TranslateTranslationError
  {
    if (!$this->isTranslationError()) {
      throw new \RuntimeException(
        'ReceiveTranslateStreamMessage does not contain \ElevenLabs\Types\TranslateTranslationError'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\TranslateAudioOutputError value
   * @throws \RuntimeException if this ReceiveTranslateStreamMessage does not contain a \ElevenLabs\Types\TranslateAudioOutputError
   */
  public function asAudioOutputError(): \ElevenLabs\Types\TranslateAudioOutputError
  {
    if (!$this->isAudioOutputError()) {
      throw new \RuntimeException(
        'ReceiveTranslateStreamMessage does not contain \ElevenLabs\Types\TranslateAudioOutputError'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\TranslateQuotaExceededError value
   * @throws \RuntimeException if this ReceiveTranslateStreamMessage does not contain a \ElevenLabs\Types\TranslateQuotaExceededError
   */
  public function asQuotaExceeded(): \ElevenLabs\Types\TranslateQuotaExceededError
  {
    if (!$this->isQuotaExceeded()) {
      throw new \RuntimeException(
        'ReceiveTranslateStreamMessage does not contain \ElevenLabs\Types\TranslateQuotaExceededError'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\TranslatePaymentIssueError value
   * @throws \RuntimeException if this ReceiveTranslateStreamMessage does not contain a \ElevenLabs\Types\TranslatePaymentIssueError
   */
  public function asPaymentIssue(): \ElevenLabs\Types\TranslatePaymentIssueError
  {
    if (!$this->isPaymentIssue()) {
      throw new \RuntimeException(
        'ReceiveTranslateStreamMessage does not contain \ElevenLabs\Types\TranslatePaymentIssueError'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\TranslateUnacceptedTermsError value
   * @throws \RuntimeException if this ReceiveTranslateStreamMessage does not contain a \ElevenLabs\Types\TranslateUnacceptedTermsError
   */
  public function asUnacceptedTerms(): \ElevenLabs\Types\TranslateUnacceptedTermsError
  {
    if (!$this->isUnacceptedTerms()) {
      throw new \RuntimeException(
        'ReceiveTranslateStreamMessage does not contain \ElevenLabs\Types\TranslateUnacceptedTermsError'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\TranslateSessionStarted value
   * @return \ElevenLabs\Types\TranslateSessionStarted|null Returns the value if this ReceiveTranslateStreamMessage contains a \ElevenLabs\Types\TranslateSessionStarted, null otherwise
   */
  public function tryAsSessionStarted(): ?\ElevenLabs\Types\TranslateSessionStarted
  {
    return $this->isSessionStarted() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\TranslateStatus value
   * @return \ElevenLabs\Types\TranslateStatus|null Returns the value if this ReceiveTranslateStreamMessage contains a \ElevenLabs\Types\TranslateStatus, null otherwise
   */
  public function tryAsStatus(): ?\ElevenLabs\Types\TranslateStatus
  {
    return $this->isStatus() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\TranslatePartialTranscript value
   * @return \ElevenLabs\Types\TranslatePartialTranscript|null Returns the value if this ReceiveTranslateStreamMessage contains a \ElevenLabs\Types\TranslatePartialTranscript, null otherwise
   */
  public function tryAsPartialTranscript(): ?\ElevenLabs\Types\TranslatePartialTranscript
  {
    return $this->isPartialTranscript() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\TranslateFinalTranscript value
   * @return \ElevenLabs\Types\TranslateFinalTranscript|null Returns the value if this ReceiveTranslateStreamMessage contains a \ElevenLabs\Types\TranslateFinalTranscript, null otherwise
   */
  public function tryAsFinalTranscript(): ?\ElevenLabs\Types\TranslateFinalTranscript
  {
    return $this->isFinalTranscript() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\TranslateTranslation value
   * @return \ElevenLabs\Types\TranslateTranslation|null Returns the value if this ReceiveTranslateStreamMessage contains a \ElevenLabs\Types\TranslateTranslation, null otherwise
   */
  public function tryAsTranslation(): ?\ElevenLabs\Types\TranslateTranslation
  {
    return $this->isTranslation() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\TranslateAudio value
   * @return \ElevenLabs\Types\TranslateAudio|null Returns the value if this ReceiveTranslateStreamMessage contains a \ElevenLabs\Types\TranslateAudio, null otherwise
   */
  public function tryAsAudio(): ?\ElevenLabs\Types\TranslateAudio
  {
    return $this->isAudio() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\TranslateError value
   * @return \ElevenLabs\Types\TranslateError|null Returns the value if this ReceiveTranslateStreamMessage contains a \ElevenLabs\Types\TranslateError, null otherwise
   */
  public function tryAsError(): ?\ElevenLabs\Types\TranslateError
  {
    return $this->isError() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\TranslateAuthError value
   * @return \ElevenLabs\Types\TranslateAuthError|null Returns the value if this ReceiveTranslateStreamMessage contains a \ElevenLabs\Types\TranslateAuthError, null otherwise
   */
  public function tryAsAuthError(): ?\ElevenLabs\Types\TranslateAuthError
  {
    return $this->isAuthError() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\TranslateRateLimitedError value
   * @return \ElevenLabs\Types\TranslateRateLimitedError|null Returns the value if this ReceiveTranslateStreamMessage contains a \ElevenLabs\Types\TranslateRateLimitedError, null otherwise
   */
  public function tryAsRateLimited(): ?\ElevenLabs\Types\TranslateRateLimitedError
  {
    return $this->isRateLimited() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\TranslateQueueOverflowError value
   * @return \ElevenLabs\Types\TranslateQueueOverflowError|null Returns the value if this ReceiveTranslateStreamMessage contains a \ElevenLabs\Types\TranslateQueueOverflowError, null otherwise
   */
  public function tryAsQueueOverflow(): ?\ElevenLabs\Types\TranslateQueueOverflowError
  {
    return $this->isQueueOverflow() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\TranslateInputError value
   * @return \ElevenLabs\Types\TranslateInputError|null Returns the value if this ReceiveTranslateStreamMessage contains a \ElevenLabs\Types\TranslateInputError, null otherwise
   */
  public function tryAsInputError(): ?\ElevenLabs\Types\TranslateInputError
  {
    return $this->isInputError() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\TranslateTranscriberError value
   * @return \ElevenLabs\Types\TranslateTranscriberError|null Returns the value if this ReceiveTranslateStreamMessage contains a \ElevenLabs\Types\TranslateTranscriberError, null otherwise
   */
  public function tryAsTranscriberError(): ?\ElevenLabs\Types\TranslateTranscriberError
  {
    return $this->isTranscriberError() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\TranslateTranslationError value
   * @return \ElevenLabs\Types\TranslateTranslationError|null Returns the value if this ReceiveTranslateStreamMessage contains a \ElevenLabs\Types\TranslateTranslationError, null otherwise
   */
  public function tryAsTranslationError(): ?\ElevenLabs\Types\TranslateTranslationError
  {
    return $this->isTranslationError() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\TranslateAudioOutputError value
   * @return \ElevenLabs\Types\TranslateAudioOutputError|null Returns the value if this ReceiveTranslateStreamMessage contains a \ElevenLabs\Types\TranslateAudioOutputError, null otherwise
   */
  public function tryAsAudioOutputError(): ?\ElevenLabs\Types\TranslateAudioOutputError
  {
    return $this->isAudioOutputError() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\TranslateQuotaExceededError value
   * @return \ElevenLabs\Types\TranslateQuotaExceededError|null Returns the value if this ReceiveTranslateStreamMessage contains a \ElevenLabs\Types\TranslateQuotaExceededError, null otherwise
   */
  public function tryAsQuotaExceeded(): ?\ElevenLabs\Types\TranslateQuotaExceededError
  {
    return $this->isQuotaExceeded() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\TranslatePaymentIssueError value
   * @return \ElevenLabs\Types\TranslatePaymentIssueError|null Returns the value if this ReceiveTranslateStreamMessage contains a \ElevenLabs\Types\TranslatePaymentIssueError, null otherwise
   */
  public function tryAsPaymentIssue(): ?\ElevenLabs\Types\TranslatePaymentIssueError
  {
    return $this->isPaymentIssue() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\TranslateUnacceptedTermsError value
   * @return \ElevenLabs\Types\TranslateUnacceptedTermsError|null Returns the value if this ReceiveTranslateStreamMessage contains a \ElevenLabs\Types\TranslateUnacceptedTermsError, null otherwise
   */
  public function tryAsUnacceptedTerms(): ?\ElevenLabs\Types\TranslateUnacceptedTermsError
  {
    return $this->isUnacceptedTerms() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\TranslateSessionStarted): T $onSessionStarted
   * @param callable(\ElevenLabs\Types\TranslateStatus): T $onStatus
   * @param callable(\ElevenLabs\Types\TranslatePartialTranscript): T $onPartialTranscript
   * @param callable(\ElevenLabs\Types\TranslateFinalTranscript): T $onFinalTranscript
   * @param callable(\ElevenLabs\Types\TranslateTranslation): T $onTranslation
   * @param callable(\ElevenLabs\Types\TranslateAudio): T $onAudio
   * @param callable(\ElevenLabs\Types\TranslateError): T $onError
   * @param callable(\ElevenLabs\Types\TranslateAuthError): T $onAuthError
   * @param callable(\ElevenLabs\Types\TranslateRateLimitedError): T $onRateLimited
   * @param callable(\ElevenLabs\Types\TranslateQueueOverflowError): T $onQueueOverflow
   * @param callable(\ElevenLabs\Types\TranslateInputError): T $onInputError
   * @param callable(\ElevenLabs\Types\TranslateTranscriberError): T $onTranscriberError
   * @param callable(\ElevenLabs\Types\TranslateTranslationError): T $onTranslationError
   * @param callable(\ElevenLabs\Types\TranslateAudioOutputError): T $onAudioOutputError
   * @param callable(\ElevenLabs\Types\TranslateQuotaExceededError): T $onQuotaExceeded
   * @param callable(\ElevenLabs\Types\TranslatePaymentIssueError): T $onPaymentIssue
   * @param callable(\ElevenLabs\Types\TranslateUnacceptedTermsError): T $onUnacceptedTerms
   * @return T
   */
  public function match(
    callable $onSessionStarted,
    callable $onStatus,
    callable $onPartialTranscript,
    callable $onFinalTranscript,
    callable $onTranslation,
    callable $onAudio,
    callable $onError,
    callable $onAuthError,
    callable $onRateLimited,
    callable $onQueueOverflow,
    callable $onInputError,
    callable $onTranscriberError,
    callable $onTranslationError,
    callable $onAudioOutputError,
    callable $onQuotaExceeded,
    callable $onPaymentIssue,
    callable $onUnacceptedTerms
  ): mixed {
    return match ($this->typeIndex) {
      0 => $onSessionStarted($this->value),
      1 => $onStatus($this->value),
      2 => $onPartialTranscript($this->value),
      3 => $onFinalTranscript($this->value),
      4 => $onTranslation($this->value),
      5 => $onAudio($this->value),
      6 => $onError($this->value),
      7 => $onAuthError($this->value),
      8 => $onRateLimited($this->value),
      9 => $onQueueOverflow($this->value),
      10 => $onInputError($this->value),
      11 => $onTranscriberError($this->value),
      12 => $onTranslationError($this->value),
      13 => $onAudioOutputError($this->value),
      14 => $onQuotaExceeded($this->value),
      15 => $onPaymentIssue($this->value),
      16 => $onUnacceptedTerms($this->value),
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
          return new self(\ElevenLabs\Types\TranslateSessionStarted::fromArray($data), 0);
        case 'status':
          return new self(\ElevenLabs\Types\TranslateStatus::fromArray($data), 1);
        case 'partial_transcript':
          return new self(\ElevenLabs\Types\TranslatePartialTranscript::fromArray($data), 2);
        case 'final_transcript':
          return new self(\ElevenLabs\Types\TranslateFinalTranscript::fromArray($data), 3);
        case 'translation':
          return new self(\ElevenLabs\Types\TranslateTranslation::fromArray($data), 4);
        case 'audio':
          return new self(\ElevenLabs\Types\TranslateAudio::fromArray($data), 5);
        case 'error':
          return new self(\ElevenLabs\Types\TranslateError::fromArray($data), 6);
        case 'auth_error':
          return new self(\ElevenLabs\Types\TranslateAuthError::fromArray($data), 7);
        case 'rate_limited':
          return new self(\ElevenLabs\Types\TranslateRateLimitedError::fromArray($data), 8);
        case 'queue_overflow':
          return new self(\ElevenLabs\Types\TranslateQueueOverflowError::fromArray($data), 9);
        case 'input_error':
          return new self(\ElevenLabs\Types\TranslateInputError::fromArray($data), 10);
        case 'transcriber_error':
          return new self(\ElevenLabs\Types\TranslateTranscriberError::fromArray($data), 11);
        case 'translation_error':
          return new self(\ElevenLabs\Types\TranslateTranslationError::fromArray($data), 12);
        case 'audio_output_error':
          return new self(\ElevenLabs\Types\TranslateAudioOutputError::fromArray($data), 13);
        case 'quota_exceeded':
          return new self(\ElevenLabs\Types\TranslateQuotaExceededError::fromArray($data), 14);
        case 'payment_issue':
          return new self(\ElevenLabs\Types\TranslatePaymentIssueError::fromArray($data), 15);
        case 'unaccepted_terms':
          return new self(\ElevenLabs\Types\TranslateUnacceptedTermsError::fromArray($data), 16);
        default:
          // A variant the API added after this SDK was generated: kept, not rejected.
          return new self($data, self::UNKNOWN);
      }
    }

    /** @var list<array{instance: mixed, idx: int, score: int}> */
    $candidates = [];
    try {
      $candidate = \ElevenLabs\Types\TranslateSessionStarted::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\TranslateSessionStarted didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\TranslateStatus::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\TranslateStatus didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\TranslatePartialTranscript::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\TranslatePartialTranscript didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\TranslateFinalTranscript::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 3, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\TranslateFinalTranscript didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\TranslateTranslation::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 4, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\TranslateTranslation didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\TranslateAudio::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 5, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\TranslateAudio didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\TranslateError::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 6, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\TranslateError didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\TranslateAuthError::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 7, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\TranslateAuthError didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\TranslateRateLimitedError::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 8, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\TranslateRateLimitedError didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\TranslateQueueOverflowError::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 9, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\TranslateQueueOverflowError didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\TranslateInputError::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 10, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\TranslateInputError didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\TranslateTranscriberError::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 11, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\TranslateTranscriberError didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\TranslateTranslationError::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 12, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\TranslateTranslationError didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\TranslateAudioOutputError::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 13, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\TranslateAudioOutputError didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\TranslateQuotaExceededError::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 14, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\TranslateQuotaExceededError didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\TranslatePaymentIssueError::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 15, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\TranslatePaymentIssueError didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\TranslateUnacceptedTermsError::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 16, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\TranslateUnacceptedTermsError didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException(
        'Data does not match any ReceiveTranslateStreamMessage type'
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
