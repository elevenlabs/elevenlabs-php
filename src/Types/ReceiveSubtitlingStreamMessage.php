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
class ReceiveSubtitlingStreamMessage extends JsonSerializableType
{
  /**
   * @var string The discriminator value identifying which variant is stored
   */
  public readonly string $messageType;

  /**
   * @var \ElevenLabs\Types\SubtitlingSessionStarted|\ElevenLabs\Types\SubtitlingStatus|\ElevenLabs\Types\SubtitlingPartialTranscript|\ElevenLabs\Types\SubtitlingFinalTranscript|\ElevenLabs\Types\SubtitlingPartialSubtitle|\ElevenLabs\Types\SubtitlingCommittedSubtitle|\ElevenLabs\Types\SubtitlingError|\ElevenLabs\Types\SubtitlingAuthError|\ElevenLabs\Types\SubtitlingRateLimitedError|\ElevenLabs\Types\SubtitlingQueueOverflowError|\ElevenLabs\Types\SubtitlingInputError|\ElevenLabs\Types\SubtitlingTranscriberError|\ElevenLabs\Types\SubtitlingTranslationError|\ElevenLabs\Types\SubtitlingQuotaExceededError|\ElevenLabs\Types\SubtitlingPaymentIssueError|\ElevenLabs\Types\SubtitlingUnacceptedTermsError|array<string, mixed> The value, exactly one of the variant types
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
   * @throws \RuntimeException if this ReceiveSubtitlingStreamMessage holds a known variant
   */
  public function _asUnknown(): array
  {
    if (!$this->_isUnknown()) {
      throw new \RuntimeException(
        'ReceiveSubtitlingStreamMessage does not contain an unknown variant'
      );
    }
    /** @var array<string, mixed> $value */
    $value = $this->value;
    return $value;
  }

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\SubtitlingSessionStarted|\ElevenLabs\Types\SubtitlingStatus|\ElevenLabs\Types\SubtitlingPartialTranscript|\ElevenLabs\Types\SubtitlingFinalTranscript|\ElevenLabs\Types\SubtitlingPartialSubtitle|\ElevenLabs\Types\SubtitlingCommittedSubtitle|\ElevenLabs\Types\SubtitlingError|\ElevenLabs\Types\SubtitlingAuthError|\ElevenLabs\Types\SubtitlingRateLimitedError|\ElevenLabs\Types\SubtitlingQueueOverflowError|\ElevenLabs\Types\SubtitlingInputError|\ElevenLabs\Types\SubtitlingTranscriberError|\ElevenLabs\Types\SubtitlingTranslationError|\ElevenLabs\Types\SubtitlingQuotaExceededError|\ElevenLabs\Types\SubtitlingPaymentIssueError|\ElevenLabs\Types\SubtitlingUnacceptedTermsError|array<string, mixed> $value
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
      4 => 'partial_subtitle',
      5 => 'committed_subtitle',
      6 => 'error',
      7 => 'auth_error',
      8 => 'rate_limited',
      9 => 'queue_overflow',
      10 => 'input_error',
      11 => 'transcriber_error',
      12 => 'translation_error',
      13 => 'quota_exceeded',
      14 => 'payment_issue',
      15 => 'unaccepted_terms',
      self::UNKNOWN => '_unknown',
      default => throw new \UnexpectedValueException("Unknown type index: $typeIndex")
    };
  }

  // Factory methods
  /**
   * Create a ReceiveSubtitlingStreamMessage instance containing a \ElevenLabs\Types\SubtitlingSessionStarted
   */
  public static function sessionStarted(
    \ElevenLabs\Types\SubtitlingSessionStarted $sessionStarted
  ): self {
    return new self($sessionStarted, 0);
  }

  /**
   * Create a ReceiveSubtitlingStreamMessage instance containing a \ElevenLabs\Types\SubtitlingStatus
   */
  public static function status(\ElevenLabs\Types\SubtitlingStatus $status): self
  {
    return new self($status, 1);
  }

  /**
   * Create a ReceiveSubtitlingStreamMessage instance containing a \ElevenLabs\Types\SubtitlingPartialTranscript
   */
  public static function partialTranscript(
    \ElevenLabs\Types\SubtitlingPartialTranscript $partialTranscript
  ): self {
    return new self($partialTranscript, 2);
  }

  /**
   * Create a ReceiveSubtitlingStreamMessage instance containing a \ElevenLabs\Types\SubtitlingFinalTranscript
   */
  public static function finalTranscript(
    \ElevenLabs\Types\SubtitlingFinalTranscript $finalTranscript
  ): self {
    return new self($finalTranscript, 3);
  }

  /**
   * Create a ReceiveSubtitlingStreamMessage instance containing a \ElevenLabs\Types\SubtitlingPartialSubtitle
   */
  public static function partialSubtitle(
    \ElevenLabs\Types\SubtitlingPartialSubtitle $partialSubtitle
  ): self {
    return new self($partialSubtitle, 4);
  }

  /**
   * Create a ReceiveSubtitlingStreamMessage instance containing a \ElevenLabs\Types\SubtitlingCommittedSubtitle
   */
  public static function committedSubtitle(
    \ElevenLabs\Types\SubtitlingCommittedSubtitle $committedSubtitle
  ): self {
    return new self($committedSubtitle, 5);
  }

  /**
   * Create a ReceiveSubtitlingStreamMessage instance containing a \ElevenLabs\Types\SubtitlingError
   */
  public static function error(\ElevenLabs\Types\SubtitlingError $error): self
  {
    return new self($error, 6);
  }

  /**
   * Create a ReceiveSubtitlingStreamMessage instance containing a \ElevenLabs\Types\SubtitlingAuthError
   */
  public static function authError(\ElevenLabs\Types\SubtitlingAuthError $authError): self
  {
    return new self($authError, 7);
  }

  /**
   * Create a ReceiveSubtitlingStreamMessage instance containing a \ElevenLabs\Types\SubtitlingRateLimitedError
   */
  public static function rateLimited(
    \ElevenLabs\Types\SubtitlingRateLimitedError $rateLimited
  ): self {
    return new self($rateLimited, 8);
  }

  /**
   * Create a ReceiveSubtitlingStreamMessage instance containing a \ElevenLabs\Types\SubtitlingQueueOverflowError
   */
  public static function queueOverflow(
    \ElevenLabs\Types\SubtitlingQueueOverflowError $queueOverflow
  ): self {
    return new self($queueOverflow, 9);
  }

  /**
   * Create a ReceiveSubtitlingStreamMessage instance containing a \ElevenLabs\Types\SubtitlingInputError
   */
  public static function inputError(\ElevenLabs\Types\SubtitlingInputError $inputError): self
  {
    return new self($inputError, 10);
  }

  /**
   * Create a ReceiveSubtitlingStreamMessage instance containing a \ElevenLabs\Types\SubtitlingTranscriberError
   */
  public static function transcriberError(
    \ElevenLabs\Types\SubtitlingTranscriberError $transcriberError
  ): self {
    return new self($transcriberError, 11);
  }

  /**
   * Create a ReceiveSubtitlingStreamMessage instance containing a \ElevenLabs\Types\SubtitlingTranslationError
   */
  public static function translationError(
    \ElevenLabs\Types\SubtitlingTranslationError $translationError
  ): self {
    return new self($translationError, 12);
  }

  /**
   * Create a ReceiveSubtitlingStreamMessage instance containing a \ElevenLabs\Types\SubtitlingQuotaExceededError
   */
  public static function quotaExceeded(
    \ElevenLabs\Types\SubtitlingQuotaExceededError $quotaExceeded
  ): self {
    return new self($quotaExceeded, 13);
  }

  /**
   * Create a ReceiveSubtitlingStreamMessage instance containing a \ElevenLabs\Types\SubtitlingPaymentIssueError
   */
  public static function paymentIssue(
    \ElevenLabs\Types\SubtitlingPaymentIssueError $paymentIssue
  ): self {
    return new self($paymentIssue, 14);
  }

  /**
   * Create a ReceiveSubtitlingStreamMessage instance containing a \ElevenLabs\Types\SubtitlingUnacceptedTermsError
   */
  public static function unacceptedTerms(
    \ElevenLabs\Types\SubtitlingUnacceptedTermsError $unacceptedTerms
  ): self {
    return new self($unacceptedTerms, 15);
  }

  // Type checking methods
  /**
   * Check if this ReceiveSubtitlingStreamMessage contains a \ElevenLabs\Types\SubtitlingSessionStarted
   */
  public function isSessionStarted(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this ReceiveSubtitlingStreamMessage contains a \ElevenLabs\Types\SubtitlingStatus
   */
  public function isStatus(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this ReceiveSubtitlingStreamMessage contains a \ElevenLabs\Types\SubtitlingPartialTranscript
   */
  public function isPartialTranscript(): bool
  {
    return $this->typeIndex === 2;
  }

  /**
   * Check if this ReceiveSubtitlingStreamMessage contains a \ElevenLabs\Types\SubtitlingFinalTranscript
   */
  public function isFinalTranscript(): bool
  {
    return $this->typeIndex === 3;
  }

  /**
   * Check if this ReceiveSubtitlingStreamMessage contains a \ElevenLabs\Types\SubtitlingPartialSubtitle
   */
  public function isPartialSubtitle(): bool
  {
    return $this->typeIndex === 4;
  }

  /**
   * Check if this ReceiveSubtitlingStreamMessage contains a \ElevenLabs\Types\SubtitlingCommittedSubtitle
   */
  public function isCommittedSubtitle(): bool
  {
    return $this->typeIndex === 5;
  }

  /**
   * Check if this ReceiveSubtitlingStreamMessage contains a \ElevenLabs\Types\SubtitlingError
   */
  public function isError(): bool
  {
    return $this->typeIndex === 6;
  }

  /**
   * Check if this ReceiveSubtitlingStreamMessage contains a \ElevenLabs\Types\SubtitlingAuthError
   */
  public function isAuthError(): bool
  {
    return $this->typeIndex === 7;
  }

  /**
   * Check if this ReceiveSubtitlingStreamMessage contains a \ElevenLabs\Types\SubtitlingRateLimitedError
   */
  public function isRateLimited(): bool
  {
    return $this->typeIndex === 8;
  }

  /**
   * Check if this ReceiveSubtitlingStreamMessage contains a \ElevenLabs\Types\SubtitlingQueueOverflowError
   */
  public function isQueueOverflow(): bool
  {
    return $this->typeIndex === 9;
  }

  /**
   * Check if this ReceiveSubtitlingStreamMessage contains a \ElevenLabs\Types\SubtitlingInputError
   */
  public function isInputError(): bool
  {
    return $this->typeIndex === 10;
  }

  /**
   * Check if this ReceiveSubtitlingStreamMessage contains a \ElevenLabs\Types\SubtitlingTranscriberError
   */
  public function isTranscriberError(): bool
  {
    return $this->typeIndex === 11;
  }

  /**
   * Check if this ReceiveSubtitlingStreamMessage contains a \ElevenLabs\Types\SubtitlingTranslationError
   */
  public function isTranslationError(): bool
  {
    return $this->typeIndex === 12;
  }

  /**
   * Check if this ReceiveSubtitlingStreamMessage contains a \ElevenLabs\Types\SubtitlingQuotaExceededError
   */
  public function isQuotaExceeded(): bool
  {
    return $this->typeIndex === 13;
  }

  /**
   * Check if this ReceiveSubtitlingStreamMessage contains a \ElevenLabs\Types\SubtitlingPaymentIssueError
   */
  public function isPaymentIssue(): bool
  {
    return $this->typeIndex === 14;
  }

  /**
   * Check if this ReceiveSubtitlingStreamMessage contains a \ElevenLabs\Types\SubtitlingUnacceptedTermsError
   */
  public function isUnacceptedTerms(): bool
  {
    return $this->typeIndex === 15;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\SubtitlingSessionStarted value
   * @throws \RuntimeException if this ReceiveSubtitlingStreamMessage does not contain a \ElevenLabs\Types\SubtitlingSessionStarted
   */
  public function asSessionStarted(): \ElevenLabs\Types\SubtitlingSessionStarted
  {
    if (!$this->isSessionStarted()) {
      throw new \RuntimeException(
        'ReceiveSubtitlingStreamMessage does not contain \ElevenLabs\Types\SubtitlingSessionStarted'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\SubtitlingStatus value
   * @throws \RuntimeException if this ReceiveSubtitlingStreamMessage does not contain a \ElevenLabs\Types\SubtitlingStatus
   */
  public function asStatus(): \ElevenLabs\Types\SubtitlingStatus
  {
    if (!$this->isStatus()) {
      throw new \RuntimeException(
        'ReceiveSubtitlingStreamMessage does not contain \ElevenLabs\Types\SubtitlingStatus'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\SubtitlingPartialTranscript value
   * @throws \RuntimeException if this ReceiveSubtitlingStreamMessage does not contain a \ElevenLabs\Types\SubtitlingPartialTranscript
   */
  public function asPartialTranscript(): \ElevenLabs\Types\SubtitlingPartialTranscript
  {
    if (!$this->isPartialTranscript()) {
      throw new \RuntimeException(
        'ReceiveSubtitlingStreamMessage does not contain \ElevenLabs\Types\SubtitlingPartialTranscript'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\SubtitlingFinalTranscript value
   * @throws \RuntimeException if this ReceiveSubtitlingStreamMessage does not contain a \ElevenLabs\Types\SubtitlingFinalTranscript
   */
  public function asFinalTranscript(): \ElevenLabs\Types\SubtitlingFinalTranscript
  {
    if (!$this->isFinalTranscript()) {
      throw new \RuntimeException(
        'ReceiveSubtitlingStreamMessage does not contain \ElevenLabs\Types\SubtitlingFinalTranscript'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\SubtitlingPartialSubtitle value
   * @throws \RuntimeException if this ReceiveSubtitlingStreamMessage does not contain a \ElevenLabs\Types\SubtitlingPartialSubtitle
   */
  public function asPartialSubtitle(): \ElevenLabs\Types\SubtitlingPartialSubtitle
  {
    if (!$this->isPartialSubtitle()) {
      throw new \RuntimeException(
        'ReceiveSubtitlingStreamMessage does not contain \ElevenLabs\Types\SubtitlingPartialSubtitle'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\SubtitlingCommittedSubtitle value
   * @throws \RuntimeException if this ReceiveSubtitlingStreamMessage does not contain a \ElevenLabs\Types\SubtitlingCommittedSubtitle
   */
  public function asCommittedSubtitle(): \ElevenLabs\Types\SubtitlingCommittedSubtitle
  {
    if (!$this->isCommittedSubtitle()) {
      throw new \RuntimeException(
        'ReceiveSubtitlingStreamMessage does not contain \ElevenLabs\Types\SubtitlingCommittedSubtitle'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\SubtitlingError value
   * @throws \RuntimeException if this ReceiveSubtitlingStreamMessage does not contain a \ElevenLabs\Types\SubtitlingError
   */
  public function asError(): \ElevenLabs\Types\SubtitlingError
  {
    if (!$this->isError()) {
      throw new \RuntimeException(
        'ReceiveSubtitlingStreamMessage does not contain \ElevenLabs\Types\SubtitlingError'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\SubtitlingAuthError value
   * @throws \RuntimeException if this ReceiveSubtitlingStreamMessage does not contain a \ElevenLabs\Types\SubtitlingAuthError
   */
  public function asAuthError(): \ElevenLabs\Types\SubtitlingAuthError
  {
    if (!$this->isAuthError()) {
      throw new \RuntimeException(
        'ReceiveSubtitlingStreamMessage does not contain \ElevenLabs\Types\SubtitlingAuthError'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\SubtitlingRateLimitedError value
   * @throws \RuntimeException if this ReceiveSubtitlingStreamMessage does not contain a \ElevenLabs\Types\SubtitlingRateLimitedError
   */
  public function asRateLimited(): \ElevenLabs\Types\SubtitlingRateLimitedError
  {
    if (!$this->isRateLimited()) {
      throw new \RuntimeException(
        'ReceiveSubtitlingStreamMessage does not contain \ElevenLabs\Types\SubtitlingRateLimitedError'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\SubtitlingQueueOverflowError value
   * @throws \RuntimeException if this ReceiveSubtitlingStreamMessage does not contain a \ElevenLabs\Types\SubtitlingQueueOverflowError
   */
  public function asQueueOverflow(): \ElevenLabs\Types\SubtitlingQueueOverflowError
  {
    if (!$this->isQueueOverflow()) {
      throw new \RuntimeException(
        'ReceiveSubtitlingStreamMessage does not contain \ElevenLabs\Types\SubtitlingQueueOverflowError'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\SubtitlingInputError value
   * @throws \RuntimeException if this ReceiveSubtitlingStreamMessage does not contain a \ElevenLabs\Types\SubtitlingInputError
   */
  public function asInputError(): \ElevenLabs\Types\SubtitlingInputError
  {
    if (!$this->isInputError()) {
      throw new \RuntimeException(
        'ReceiveSubtitlingStreamMessage does not contain \ElevenLabs\Types\SubtitlingInputError'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\SubtitlingTranscriberError value
   * @throws \RuntimeException if this ReceiveSubtitlingStreamMessage does not contain a \ElevenLabs\Types\SubtitlingTranscriberError
   */
  public function asTranscriberError(): \ElevenLabs\Types\SubtitlingTranscriberError
  {
    if (!$this->isTranscriberError()) {
      throw new \RuntimeException(
        'ReceiveSubtitlingStreamMessage does not contain \ElevenLabs\Types\SubtitlingTranscriberError'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\SubtitlingTranslationError value
   * @throws \RuntimeException if this ReceiveSubtitlingStreamMessage does not contain a \ElevenLabs\Types\SubtitlingTranslationError
   */
  public function asTranslationError(): \ElevenLabs\Types\SubtitlingTranslationError
  {
    if (!$this->isTranslationError()) {
      throw new \RuntimeException(
        'ReceiveSubtitlingStreamMessage does not contain \ElevenLabs\Types\SubtitlingTranslationError'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\SubtitlingQuotaExceededError value
   * @throws \RuntimeException if this ReceiveSubtitlingStreamMessage does not contain a \ElevenLabs\Types\SubtitlingQuotaExceededError
   */
  public function asQuotaExceeded(): \ElevenLabs\Types\SubtitlingQuotaExceededError
  {
    if (!$this->isQuotaExceeded()) {
      throw new \RuntimeException(
        'ReceiveSubtitlingStreamMessage does not contain \ElevenLabs\Types\SubtitlingQuotaExceededError'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\SubtitlingPaymentIssueError value
   * @throws \RuntimeException if this ReceiveSubtitlingStreamMessage does not contain a \ElevenLabs\Types\SubtitlingPaymentIssueError
   */
  public function asPaymentIssue(): \ElevenLabs\Types\SubtitlingPaymentIssueError
  {
    if (!$this->isPaymentIssue()) {
      throw new \RuntimeException(
        'ReceiveSubtitlingStreamMessage does not contain \ElevenLabs\Types\SubtitlingPaymentIssueError'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\SubtitlingUnacceptedTermsError value
   * @throws \RuntimeException if this ReceiveSubtitlingStreamMessage does not contain a \ElevenLabs\Types\SubtitlingUnacceptedTermsError
   */
  public function asUnacceptedTerms(): \ElevenLabs\Types\SubtitlingUnacceptedTermsError
  {
    if (!$this->isUnacceptedTerms()) {
      throw new \RuntimeException(
        'ReceiveSubtitlingStreamMessage does not contain \ElevenLabs\Types\SubtitlingUnacceptedTermsError'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\SubtitlingSessionStarted value
   * @return \ElevenLabs\Types\SubtitlingSessionStarted|null Returns the value if this ReceiveSubtitlingStreamMessage contains a \ElevenLabs\Types\SubtitlingSessionStarted, null otherwise
   */
  public function tryAsSessionStarted(): ?\ElevenLabs\Types\SubtitlingSessionStarted
  {
    return $this->isSessionStarted() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\SubtitlingStatus value
   * @return \ElevenLabs\Types\SubtitlingStatus|null Returns the value if this ReceiveSubtitlingStreamMessage contains a \ElevenLabs\Types\SubtitlingStatus, null otherwise
   */
  public function tryAsStatus(): ?\ElevenLabs\Types\SubtitlingStatus
  {
    return $this->isStatus() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\SubtitlingPartialTranscript value
   * @return \ElevenLabs\Types\SubtitlingPartialTranscript|null Returns the value if this ReceiveSubtitlingStreamMessage contains a \ElevenLabs\Types\SubtitlingPartialTranscript, null otherwise
   */
  public function tryAsPartialTranscript(): ?\ElevenLabs\Types\SubtitlingPartialTranscript
  {
    return $this->isPartialTranscript() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\SubtitlingFinalTranscript value
   * @return \ElevenLabs\Types\SubtitlingFinalTranscript|null Returns the value if this ReceiveSubtitlingStreamMessage contains a \ElevenLabs\Types\SubtitlingFinalTranscript, null otherwise
   */
  public function tryAsFinalTranscript(): ?\ElevenLabs\Types\SubtitlingFinalTranscript
  {
    return $this->isFinalTranscript() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\SubtitlingPartialSubtitle value
   * @return \ElevenLabs\Types\SubtitlingPartialSubtitle|null Returns the value if this ReceiveSubtitlingStreamMessage contains a \ElevenLabs\Types\SubtitlingPartialSubtitle, null otherwise
   */
  public function tryAsPartialSubtitle(): ?\ElevenLabs\Types\SubtitlingPartialSubtitle
  {
    return $this->isPartialSubtitle() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\SubtitlingCommittedSubtitle value
   * @return \ElevenLabs\Types\SubtitlingCommittedSubtitle|null Returns the value if this ReceiveSubtitlingStreamMessage contains a \ElevenLabs\Types\SubtitlingCommittedSubtitle, null otherwise
   */
  public function tryAsCommittedSubtitle(): ?\ElevenLabs\Types\SubtitlingCommittedSubtitle
  {
    return $this->isCommittedSubtitle() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\SubtitlingError value
   * @return \ElevenLabs\Types\SubtitlingError|null Returns the value if this ReceiveSubtitlingStreamMessage contains a \ElevenLabs\Types\SubtitlingError, null otherwise
   */
  public function tryAsError(): ?\ElevenLabs\Types\SubtitlingError
  {
    return $this->isError() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\SubtitlingAuthError value
   * @return \ElevenLabs\Types\SubtitlingAuthError|null Returns the value if this ReceiveSubtitlingStreamMessage contains a \ElevenLabs\Types\SubtitlingAuthError, null otherwise
   */
  public function tryAsAuthError(): ?\ElevenLabs\Types\SubtitlingAuthError
  {
    return $this->isAuthError() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\SubtitlingRateLimitedError value
   * @return \ElevenLabs\Types\SubtitlingRateLimitedError|null Returns the value if this ReceiveSubtitlingStreamMessage contains a \ElevenLabs\Types\SubtitlingRateLimitedError, null otherwise
   */
  public function tryAsRateLimited(): ?\ElevenLabs\Types\SubtitlingRateLimitedError
  {
    return $this->isRateLimited() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\SubtitlingQueueOverflowError value
   * @return \ElevenLabs\Types\SubtitlingQueueOverflowError|null Returns the value if this ReceiveSubtitlingStreamMessage contains a \ElevenLabs\Types\SubtitlingQueueOverflowError, null otherwise
   */
  public function tryAsQueueOverflow(): ?\ElevenLabs\Types\SubtitlingQueueOverflowError
  {
    return $this->isQueueOverflow() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\SubtitlingInputError value
   * @return \ElevenLabs\Types\SubtitlingInputError|null Returns the value if this ReceiveSubtitlingStreamMessage contains a \ElevenLabs\Types\SubtitlingInputError, null otherwise
   */
  public function tryAsInputError(): ?\ElevenLabs\Types\SubtitlingInputError
  {
    return $this->isInputError() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\SubtitlingTranscriberError value
   * @return \ElevenLabs\Types\SubtitlingTranscriberError|null Returns the value if this ReceiveSubtitlingStreamMessage contains a \ElevenLabs\Types\SubtitlingTranscriberError, null otherwise
   */
  public function tryAsTranscriberError(): ?\ElevenLabs\Types\SubtitlingTranscriberError
  {
    return $this->isTranscriberError() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\SubtitlingTranslationError value
   * @return \ElevenLabs\Types\SubtitlingTranslationError|null Returns the value if this ReceiveSubtitlingStreamMessage contains a \ElevenLabs\Types\SubtitlingTranslationError, null otherwise
   */
  public function tryAsTranslationError(): ?\ElevenLabs\Types\SubtitlingTranslationError
  {
    return $this->isTranslationError() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\SubtitlingQuotaExceededError value
   * @return \ElevenLabs\Types\SubtitlingQuotaExceededError|null Returns the value if this ReceiveSubtitlingStreamMessage contains a \ElevenLabs\Types\SubtitlingQuotaExceededError, null otherwise
   */
  public function tryAsQuotaExceeded(): ?\ElevenLabs\Types\SubtitlingQuotaExceededError
  {
    return $this->isQuotaExceeded() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\SubtitlingPaymentIssueError value
   * @return \ElevenLabs\Types\SubtitlingPaymentIssueError|null Returns the value if this ReceiveSubtitlingStreamMessage contains a \ElevenLabs\Types\SubtitlingPaymentIssueError, null otherwise
   */
  public function tryAsPaymentIssue(): ?\ElevenLabs\Types\SubtitlingPaymentIssueError
  {
    return $this->isPaymentIssue() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\SubtitlingUnacceptedTermsError value
   * @return \ElevenLabs\Types\SubtitlingUnacceptedTermsError|null Returns the value if this ReceiveSubtitlingStreamMessage contains a \ElevenLabs\Types\SubtitlingUnacceptedTermsError, null otherwise
   */
  public function tryAsUnacceptedTerms(): ?\ElevenLabs\Types\SubtitlingUnacceptedTermsError
  {
    return $this->isUnacceptedTerms() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\SubtitlingSessionStarted): T $onSessionStarted
   * @param callable(\ElevenLabs\Types\SubtitlingStatus): T $onStatus
   * @param callable(\ElevenLabs\Types\SubtitlingPartialTranscript): T $onPartialTranscript
   * @param callable(\ElevenLabs\Types\SubtitlingFinalTranscript): T $onFinalTranscript
   * @param callable(\ElevenLabs\Types\SubtitlingPartialSubtitle): T $onPartialSubtitle
   * @param callable(\ElevenLabs\Types\SubtitlingCommittedSubtitle): T $onCommittedSubtitle
   * @param callable(\ElevenLabs\Types\SubtitlingError): T $onError
   * @param callable(\ElevenLabs\Types\SubtitlingAuthError): T $onAuthError
   * @param callable(\ElevenLabs\Types\SubtitlingRateLimitedError): T $onRateLimited
   * @param callable(\ElevenLabs\Types\SubtitlingQueueOverflowError): T $onQueueOverflow
   * @param callable(\ElevenLabs\Types\SubtitlingInputError): T $onInputError
   * @param callable(\ElevenLabs\Types\SubtitlingTranscriberError): T $onTranscriberError
   * @param callable(\ElevenLabs\Types\SubtitlingTranslationError): T $onTranslationError
   * @param callable(\ElevenLabs\Types\SubtitlingQuotaExceededError): T $onQuotaExceeded
   * @param callable(\ElevenLabs\Types\SubtitlingPaymentIssueError): T $onPaymentIssue
   * @param callable(\ElevenLabs\Types\SubtitlingUnacceptedTermsError): T $onUnacceptedTerms
   * @return T
   */
  public function match(
    callable $onSessionStarted,
    callable $onStatus,
    callable $onPartialTranscript,
    callable $onFinalTranscript,
    callable $onPartialSubtitle,
    callable $onCommittedSubtitle,
    callable $onError,
    callable $onAuthError,
    callable $onRateLimited,
    callable $onQueueOverflow,
    callable $onInputError,
    callable $onTranscriberError,
    callable $onTranslationError,
    callable $onQuotaExceeded,
    callable $onPaymentIssue,
    callable $onUnacceptedTerms
  ): mixed {
    return match ($this->typeIndex) {
      0 => $onSessionStarted($this->value),
      1 => $onStatus($this->value),
      2 => $onPartialTranscript($this->value),
      3 => $onFinalTranscript($this->value),
      4 => $onPartialSubtitle($this->value),
      5 => $onCommittedSubtitle($this->value),
      6 => $onError($this->value),
      7 => $onAuthError($this->value),
      8 => $onRateLimited($this->value),
      9 => $onQueueOverflow($this->value),
      10 => $onInputError($this->value),
      11 => $onTranscriberError($this->value),
      12 => $onTranslationError($this->value),
      13 => $onQuotaExceeded($this->value),
      14 => $onPaymentIssue($this->value),
      15 => $onUnacceptedTerms($this->value),
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
          return new self(\ElevenLabs\Types\SubtitlingSessionStarted::fromArray($data), 0);
        case 'status':
          return new self(\ElevenLabs\Types\SubtitlingStatus::fromArray($data), 1);
        case 'partial_transcript':
          return new self(\ElevenLabs\Types\SubtitlingPartialTranscript::fromArray($data), 2);
        case 'final_transcript':
          return new self(\ElevenLabs\Types\SubtitlingFinalTranscript::fromArray($data), 3);
        case 'partial_subtitle':
          return new self(\ElevenLabs\Types\SubtitlingPartialSubtitle::fromArray($data), 4);
        case 'committed_subtitle':
          return new self(\ElevenLabs\Types\SubtitlingCommittedSubtitle::fromArray($data), 5);
        case 'error':
          return new self(\ElevenLabs\Types\SubtitlingError::fromArray($data), 6);
        case 'auth_error':
          return new self(\ElevenLabs\Types\SubtitlingAuthError::fromArray($data), 7);
        case 'rate_limited':
          return new self(\ElevenLabs\Types\SubtitlingRateLimitedError::fromArray($data), 8);
        case 'queue_overflow':
          return new self(\ElevenLabs\Types\SubtitlingQueueOverflowError::fromArray($data), 9);
        case 'input_error':
          return new self(\ElevenLabs\Types\SubtitlingInputError::fromArray($data), 10);
        case 'transcriber_error':
          return new self(\ElevenLabs\Types\SubtitlingTranscriberError::fromArray($data), 11);
        case 'translation_error':
          return new self(\ElevenLabs\Types\SubtitlingTranslationError::fromArray($data), 12);
        case 'quota_exceeded':
          return new self(\ElevenLabs\Types\SubtitlingQuotaExceededError::fromArray($data), 13);
        case 'payment_issue':
          return new self(\ElevenLabs\Types\SubtitlingPaymentIssueError::fromArray($data), 14);
        case 'unaccepted_terms':
          return new self(\ElevenLabs\Types\SubtitlingUnacceptedTermsError::fromArray($data), 15);
        default:
          // A variant the API added after this SDK was generated: kept, not rejected.
          return new self($data, self::UNKNOWN);
      }
    }

    /** @var list<array{instance: mixed, idx: int, score: int}> */
    $candidates = [];
    try {
      $candidate = \ElevenLabs\Types\SubtitlingSessionStarted::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\SubtitlingSessionStarted didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\SubtitlingStatus::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\SubtitlingStatus didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\SubtitlingPartialTranscript::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\SubtitlingPartialTranscript didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\SubtitlingFinalTranscript::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 3, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\SubtitlingFinalTranscript didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\SubtitlingPartialSubtitle::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 4, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\SubtitlingPartialSubtitle didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\SubtitlingCommittedSubtitle::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 5, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\SubtitlingCommittedSubtitle didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\SubtitlingError::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 6, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\SubtitlingError didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\SubtitlingAuthError::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 7, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\SubtitlingAuthError didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\SubtitlingRateLimitedError::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 8, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\SubtitlingRateLimitedError didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\SubtitlingQueueOverflowError::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 9, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\SubtitlingQueueOverflowError didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\SubtitlingInputError::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 10, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\SubtitlingInputError didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\SubtitlingTranscriberError::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 11, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\SubtitlingTranscriberError didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\SubtitlingTranslationError::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 12, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\SubtitlingTranslationError didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\SubtitlingQuotaExceededError::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 13, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\SubtitlingQuotaExceededError didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\SubtitlingPaymentIssueError::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 14, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\SubtitlingPaymentIssueError didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\SubtitlingUnacceptedTermsError::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 15, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\SubtitlingUnacceptedTermsError didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException(
        'Data does not match any ReceiveSubtitlingStreamMessage type'
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
