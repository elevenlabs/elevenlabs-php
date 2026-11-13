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
class AgentMergeProposalResponseOutcome extends JsonSerializableType
{
  /**
   * @var string The discriminator value identifying which variant is stored
   */
  public readonly string $status;

  /**
   * @var \ElevenLabs\Types\OpenOutcome|\ElevenLabs\Types\MergedOutcome|\ElevenLabs\Types\ClosedOutcome|array<string, mixed> The value, exactly one of the variant types
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
   * @throws \RuntimeException if this AgentMergeProposalResponseOutcome holds a known variant
   */
  public function _asUnknown(): array
  {
    if (!$this->_isUnknown()) {
      throw new \RuntimeException(
        'AgentMergeProposalResponseOutcome does not contain an unknown variant'
      );
    }
    /** @var array<string, mixed> $value */
    $value = $this->value;
    return $value;
  }

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\OpenOutcome|\ElevenLabs\Types\MergedOutcome|\ElevenLabs\Types\ClosedOutcome|array<string, mixed> $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
    $this->status = match ($typeIndex) {
      0 => 'open',
      1 => 'merged',
      2 => 'closed',
      self::UNKNOWN => '_unknown',
      default => throw new \UnexpectedValueException("Unknown type index: $typeIndex")
    };
  }

  // Factory methods
  /**
   * Create a AgentMergeProposalResponseOutcome instance containing a \ElevenLabs\Types\OpenOutcome
   */
  public static function open(\ElevenLabs\Types\OpenOutcome $open): self
  {
    return new self($open, 0);
  }

  /**
   * Create a AgentMergeProposalResponseOutcome instance containing a \ElevenLabs\Types\MergedOutcome
   */
  public static function merged(\ElevenLabs\Types\MergedOutcome $merged): self
  {
    return new self($merged, 1);
  }

  /**
   * Create a AgentMergeProposalResponseOutcome instance containing a \ElevenLabs\Types\ClosedOutcome
   */
  public static function closed(\ElevenLabs\Types\ClosedOutcome $closed): self
  {
    return new self($closed, 2);
  }

  // Type checking methods
  /**
   * Check if this AgentMergeProposalResponseOutcome contains a \ElevenLabs\Types\OpenOutcome
   */
  public function isOpen(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this AgentMergeProposalResponseOutcome contains a \ElevenLabs\Types\MergedOutcome
   */
  public function isMerged(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this AgentMergeProposalResponseOutcome contains a \ElevenLabs\Types\ClosedOutcome
   */
  public function isClosed(): bool
  {
    return $this->typeIndex === 2;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\OpenOutcome value
   * @throws \RuntimeException if this AgentMergeProposalResponseOutcome does not contain a \ElevenLabs\Types\OpenOutcome
   */
  public function asOpen(): \ElevenLabs\Types\OpenOutcome
  {
    if (!$this->isOpen()) {
      throw new \RuntimeException(
        'AgentMergeProposalResponseOutcome does not contain \ElevenLabs\Types\OpenOutcome'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\MergedOutcome value
   * @throws \RuntimeException if this AgentMergeProposalResponseOutcome does not contain a \ElevenLabs\Types\MergedOutcome
   */
  public function asMerged(): \ElevenLabs\Types\MergedOutcome
  {
    if (!$this->isMerged()) {
      throw new \RuntimeException(
        'AgentMergeProposalResponseOutcome does not contain \ElevenLabs\Types\MergedOutcome'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ClosedOutcome value
   * @throws \RuntimeException if this AgentMergeProposalResponseOutcome does not contain a \ElevenLabs\Types\ClosedOutcome
   */
  public function asClosed(): \ElevenLabs\Types\ClosedOutcome
  {
    if (!$this->isClosed()) {
      throw new \RuntimeException(
        'AgentMergeProposalResponseOutcome does not contain \ElevenLabs\Types\ClosedOutcome'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\OpenOutcome value
   * @return \ElevenLabs\Types\OpenOutcome|null Returns the value if this AgentMergeProposalResponseOutcome contains a \ElevenLabs\Types\OpenOutcome, null otherwise
   */
  public function tryAsOpen(): ?\ElevenLabs\Types\OpenOutcome
  {
    return $this->isOpen() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\MergedOutcome value
   * @return \ElevenLabs\Types\MergedOutcome|null Returns the value if this AgentMergeProposalResponseOutcome contains a \ElevenLabs\Types\MergedOutcome, null otherwise
   */
  public function tryAsMerged(): ?\ElevenLabs\Types\MergedOutcome
  {
    return $this->isMerged() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ClosedOutcome value
   * @return \ElevenLabs\Types\ClosedOutcome|null Returns the value if this AgentMergeProposalResponseOutcome contains a \ElevenLabs\Types\ClosedOutcome, null otherwise
   */
  public function tryAsClosed(): ?\ElevenLabs\Types\ClosedOutcome
  {
    return $this->isClosed() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\OpenOutcome): T $onOpen
   * @param callable(\ElevenLabs\Types\MergedOutcome): T $onMerged
   * @param callable(\ElevenLabs\Types\ClosedOutcome): T $onClosed
   * @return T
   */
  public function match(callable $onOpen, callable $onMerged, callable $onClosed): mixed
  {
    return match ($this->typeIndex) {
      0 => $onOpen($this->value),
      1 => $onMerged($this->value),
      2 => $onClosed($this->value),
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
        case 'closed':
          return new self(\ElevenLabs\Types\ClosedOutcome::fromArray($data), 2);
        case 'merged':
          return new self(\ElevenLabs\Types\MergedOutcome::fromArray($data), 1);
        case 'open':
          return new self(\ElevenLabs\Types\OpenOutcome::fromArray($data), 0);
        default:
          // A variant the API added after this SDK was generated: kept, not rejected.
          return new self($data, self::UNKNOWN);
      }
    }

    /** @var list<array{instance: mixed, idx: int, score: int}> */
    $candidates = [];
    try {
      $candidate = \ElevenLabs\Types\OpenOutcome::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\OpenOutcome didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\MergedOutcome::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\MergedOutcome didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ClosedOutcome::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ClosedOutcome didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException(
        'Data does not match any AgentMergeProposalResponseOutcome type'
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
