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
class MediaGenerationResponse extends JsonSerializableType
{
  /**
   * @var string The discriminator value identifying which variant is stored
   */
  public readonly string $status;

  /**
   * @var \ElevenLabs\Types\MediaGenerationInProgressResponse|\ElevenLabs\Types\MediaGenerationCompletedResponse|\ElevenLabs\Types\MediaGenerationFailedResponse|array<string, mixed> The value, exactly one of the variant types
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
   * @throws \RuntimeException if this MediaGenerationResponse holds a known variant
   */
  public function _asUnknown(): array
  {
    if (!$this->_isUnknown()) {
      throw new \RuntimeException('MediaGenerationResponse does not contain an unknown variant');
    }
    /** @var array<string, mixed> $value */
    $value = $this->value;
    return $value;
  }

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\MediaGenerationInProgressResponse|\ElevenLabs\Types\MediaGenerationCompletedResponse|\ElevenLabs\Types\MediaGenerationFailedResponse|array<string, mixed> $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
    $this->status = match ($typeIndex) {
      0 => 'generating',
      3 => 'pending',
      1 => 'completed',
      2 => 'failed',
      self::UNKNOWN => '_unknown',
      default => throw new \UnexpectedValueException("Unknown type index: $typeIndex")
    };
  }

  // Factory methods
  /**
   * Create a MediaGenerationResponse instance containing a \ElevenLabs\Types\MediaGenerationInProgressResponse
   */
  public static function generating(
    \ElevenLabs\Types\MediaGenerationInProgressResponse $generating
  ): self {
    return new self($generating, 0);
  }

  /**
   * Create a MediaGenerationResponse instance containing a \ElevenLabs\Types\MediaGenerationInProgressResponse
   */
  public static function pending(\ElevenLabs\Types\MediaGenerationInProgressResponse $pending): self
  {
    return new self($pending, 3);
  }

  /**
   * Create a MediaGenerationResponse instance containing a \ElevenLabs\Types\MediaGenerationCompletedResponse
   */
  public static function completed(
    \ElevenLabs\Types\MediaGenerationCompletedResponse $completed
  ): self {
    return new self($completed, 1);
  }

  /**
   * Create a MediaGenerationResponse instance containing a \ElevenLabs\Types\MediaGenerationFailedResponse
   */
  public static function failed(\ElevenLabs\Types\MediaGenerationFailedResponse $failed): self
  {
    return new self($failed, 2);
  }

  // Type checking methods
  /**
   * Check if this MediaGenerationResponse contains a \ElevenLabs\Types\MediaGenerationInProgressResponse
   */
  public function isGenerating(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this MediaGenerationResponse contains a \ElevenLabs\Types\MediaGenerationInProgressResponse
   */
  public function isPending(): bool
  {
    return $this->typeIndex === 3;
  }

  /**
   * Check if this MediaGenerationResponse contains a \ElevenLabs\Types\MediaGenerationCompletedResponse
   */
  public function isCompleted(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this MediaGenerationResponse contains a \ElevenLabs\Types\MediaGenerationFailedResponse
   */
  public function isFailed(): bool
  {
    return $this->typeIndex === 2;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\MediaGenerationInProgressResponse value
   * @throws \RuntimeException if this MediaGenerationResponse does not contain a \ElevenLabs\Types\MediaGenerationInProgressResponse
   */
  public function asGenerating(): \ElevenLabs\Types\MediaGenerationInProgressResponse
  {
    if (!$this->isGenerating()) {
      throw new \RuntimeException(
        'MediaGenerationResponse does not contain \ElevenLabs\Types\MediaGenerationInProgressResponse'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\MediaGenerationInProgressResponse value
   * @throws \RuntimeException if this MediaGenerationResponse does not contain a \ElevenLabs\Types\MediaGenerationInProgressResponse
   */
  public function asPending(): \ElevenLabs\Types\MediaGenerationInProgressResponse
  {
    if (!$this->isPending()) {
      throw new \RuntimeException(
        'MediaGenerationResponse does not contain \ElevenLabs\Types\MediaGenerationInProgressResponse'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\MediaGenerationCompletedResponse value
   * @throws \RuntimeException if this MediaGenerationResponse does not contain a \ElevenLabs\Types\MediaGenerationCompletedResponse
   */
  public function asCompleted(): \ElevenLabs\Types\MediaGenerationCompletedResponse
  {
    if (!$this->isCompleted()) {
      throw new \RuntimeException(
        'MediaGenerationResponse does not contain \ElevenLabs\Types\MediaGenerationCompletedResponse'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\MediaGenerationFailedResponse value
   * @throws \RuntimeException if this MediaGenerationResponse does not contain a \ElevenLabs\Types\MediaGenerationFailedResponse
   */
  public function asFailed(): \ElevenLabs\Types\MediaGenerationFailedResponse
  {
    if (!$this->isFailed()) {
      throw new \RuntimeException(
        'MediaGenerationResponse does not contain \ElevenLabs\Types\MediaGenerationFailedResponse'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\MediaGenerationInProgressResponse value
   * @return \ElevenLabs\Types\MediaGenerationInProgressResponse|null Returns the value if this MediaGenerationResponse contains a \ElevenLabs\Types\MediaGenerationInProgressResponse, null otherwise
   */
  public function tryAsGenerating(): ?\ElevenLabs\Types\MediaGenerationInProgressResponse
  {
    return $this->isGenerating() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\MediaGenerationInProgressResponse value
   * @return \ElevenLabs\Types\MediaGenerationInProgressResponse|null Returns the value if this MediaGenerationResponse contains a \ElevenLabs\Types\MediaGenerationInProgressResponse, null otherwise
   */
  public function tryAsPending(): ?\ElevenLabs\Types\MediaGenerationInProgressResponse
  {
    return $this->isPending() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\MediaGenerationCompletedResponse value
   * @return \ElevenLabs\Types\MediaGenerationCompletedResponse|null Returns the value if this MediaGenerationResponse contains a \ElevenLabs\Types\MediaGenerationCompletedResponse, null otherwise
   */
  public function tryAsCompleted(): ?\ElevenLabs\Types\MediaGenerationCompletedResponse
  {
    return $this->isCompleted() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\MediaGenerationFailedResponse value
   * @return \ElevenLabs\Types\MediaGenerationFailedResponse|null Returns the value if this MediaGenerationResponse contains a \ElevenLabs\Types\MediaGenerationFailedResponse, null otherwise
   */
  public function tryAsFailed(): ?\ElevenLabs\Types\MediaGenerationFailedResponse
  {
    return $this->isFailed() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\MediaGenerationInProgressResponse): T $onGenerating
   * @param callable(\ElevenLabs\Types\MediaGenerationInProgressResponse): T $onPending
   * @param callable(\ElevenLabs\Types\MediaGenerationCompletedResponse): T $onCompleted
   * @param callable(\ElevenLabs\Types\MediaGenerationFailedResponse): T $onFailed
   * @return T
   */
  public function match(
    callable $onGenerating,
    callable $onPending,
    callable $onCompleted,
    callable $onFailed
  ): mixed {
    return match ($this->typeIndex) {
      0 => $onGenerating($this->value),
      3 => $onPending($this->value),
      1 => $onCompleted($this->value),
      2 => $onFailed($this->value),
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
    if (is_array($data) && isset($data['status']) && is_string($data['status'])) {
      switch ($data['status']) {
        case 'completed':
          return new self(\ElevenLabs\Types\MediaGenerationCompletedResponse::fromArray($data), 1);
        case 'failed':
          return new self(\ElevenLabs\Types\MediaGenerationFailedResponse::fromArray($data), 2);
        case 'generating':
          return new self(\ElevenLabs\Types\MediaGenerationInProgressResponse::fromArray($data), 0);
        case 'pending':
          return new self(\ElevenLabs\Types\MediaGenerationInProgressResponse::fromArray($data), 3);
        default:
          // A variant the API added after this SDK was generated: kept, not rejected.
          return new self($data, self::UNKNOWN);
      }
    }

    /** @var list<array{instance: mixed, idx: int, score: int}> */
    $candidates = [];
    try {
      $candidate = \ElevenLabs\Types\MediaGenerationInProgressResponse::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\MediaGenerationInProgressResponse didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\MediaGenerationInProgressResponse::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 3, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\MediaGenerationInProgressResponse didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\MediaGenerationCompletedResponse::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\MediaGenerationCompletedResponse didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\MediaGenerationFailedResponse::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\MediaGenerationFailedResponse didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException('Data does not match any MediaGenerationResponse type');
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
