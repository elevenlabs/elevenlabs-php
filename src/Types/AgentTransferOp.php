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
class AgentTransferOp extends JsonSerializableType
{
  /**
   * @var string The discriminator value identifying which variant is stored
   */
  public readonly string $type;

  /**
   * @var \ElevenLabs\Types\AgentTransferOpReplace|\ElevenLabs\Types\AgentTransferOpPush|\ElevenLabs\Types\AgentTransferOpPop|array<string, mixed> The value, exactly one of the variant types
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
   * @throws \RuntimeException if this AgentTransferOp holds a known variant
   */
  public function _asUnknown(): array
  {
    if (!$this->_isUnknown()) {
      throw new \RuntimeException('AgentTransferOp does not contain an unknown variant');
    }
    /** @var array<string, mixed> $value */
    $value = $this->value;
    return $value;
  }

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\AgentTransferOpReplace|\ElevenLabs\Types\AgentTransferOpPush|\ElevenLabs\Types\AgentTransferOpPop|array<string, mixed> $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
    $this->type = match ($typeIndex) {
      0 => 'replace',
      1 => 'push',
      2 => 'pop',
      self::UNKNOWN => '_unknown',
      default => throw new \UnexpectedValueException("Unknown type index: $typeIndex")
    };
  }

  // Factory methods
  /**
   * Create a AgentTransferOp instance containing a \ElevenLabs\Types\AgentTransferOpReplace
   */
  public static function replace(\ElevenLabs\Types\AgentTransferOpReplace $replace): self
  {
    return new self($replace, 0);
  }

  /**
   * Create a AgentTransferOp instance containing a \ElevenLabs\Types\AgentTransferOpPush
   */
  public static function push(\ElevenLabs\Types\AgentTransferOpPush $push): self
  {
    return new self($push, 1);
  }

  /**
   * Create a AgentTransferOp instance containing a \ElevenLabs\Types\AgentTransferOpPop
   */
  public static function pop(\ElevenLabs\Types\AgentTransferOpPop $pop): self
  {
    return new self($pop, 2);
  }

  // Type checking methods
  /**
   * Check if this AgentTransferOp contains a \ElevenLabs\Types\AgentTransferOpReplace
   */
  public function isReplace(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this AgentTransferOp contains a \ElevenLabs\Types\AgentTransferOpPush
   */
  public function isPush(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this AgentTransferOp contains a \ElevenLabs\Types\AgentTransferOpPop
   */
  public function isPop(): bool
  {
    return $this->typeIndex === 2;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\AgentTransferOpReplace value
   * @throws \RuntimeException if this AgentTransferOp does not contain a \ElevenLabs\Types\AgentTransferOpReplace
   */
  public function asReplace(): \ElevenLabs\Types\AgentTransferOpReplace
  {
    if (!$this->isReplace()) {
      throw new \RuntimeException(
        'AgentTransferOp does not contain \ElevenLabs\Types\AgentTransferOpReplace'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AgentTransferOpPush value
   * @throws \RuntimeException if this AgentTransferOp does not contain a \ElevenLabs\Types\AgentTransferOpPush
   */
  public function asPush(): \ElevenLabs\Types\AgentTransferOpPush
  {
    if (!$this->isPush()) {
      throw new \RuntimeException(
        'AgentTransferOp does not contain \ElevenLabs\Types\AgentTransferOpPush'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AgentTransferOpPop value
   * @throws \RuntimeException if this AgentTransferOp does not contain a \ElevenLabs\Types\AgentTransferOpPop
   */
  public function asPop(): \ElevenLabs\Types\AgentTransferOpPop
  {
    if (!$this->isPop()) {
      throw new \RuntimeException(
        'AgentTransferOp does not contain \ElevenLabs\Types\AgentTransferOpPop'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\AgentTransferOpReplace value
   * @return \ElevenLabs\Types\AgentTransferOpReplace|null Returns the value if this AgentTransferOp contains a \ElevenLabs\Types\AgentTransferOpReplace, null otherwise
   */
  public function tryAsReplace(): ?\ElevenLabs\Types\AgentTransferOpReplace
  {
    return $this->isReplace() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AgentTransferOpPush value
   * @return \ElevenLabs\Types\AgentTransferOpPush|null Returns the value if this AgentTransferOp contains a \ElevenLabs\Types\AgentTransferOpPush, null otherwise
   */
  public function tryAsPush(): ?\ElevenLabs\Types\AgentTransferOpPush
  {
    return $this->isPush() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AgentTransferOpPop value
   * @return \ElevenLabs\Types\AgentTransferOpPop|null Returns the value if this AgentTransferOp contains a \ElevenLabs\Types\AgentTransferOpPop, null otherwise
   */
  public function tryAsPop(): ?\ElevenLabs\Types\AgentTransferOpPop
  {
    return $this->isPop() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\AgentTransferOpReplace): T $onReplace
   * @param callable(\ElevenLabs\Types\AgentTransferOpPush): T $onPush
   * @param callable(\ElevenLabs\Types\AgentTransferOpPop): T $onPop
   * @return T
   */
  public function match(callable $onReplace, callable $onPush, callable $onPop): mixed
  {
    return match ($this->typeIndex) {
      0 => $onReplace($this->value),
      1 => $onPush($this->value),
      2 => $onPop($this->value),
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
    if (is_array($data) && isset($data['type']) && is_string($data['type'])) {
      switch ($data['type']) {
        case 'pop':
          return new self(\ElevenLabs\Types\AgentTransferOpPop::fromArray($data), 2);
        case 'push':
          return new self(\ElevenLabs\Types\AgentTransferOpPush::fromArray($data), 1);
        case 'replace':
          return new self(\ElevenLabs\Types\AgentTransferOpReplace::fromArray($data), 0);
        default:
          // A variant the API added after this SDK was generated: kept, not rejected.
          return new self($data, self::UNKNOWN);
      }
    }

    /** @var list<array{instance: mixed, idx: int, score: int}> */
    $candidates = [];
    try {
      $candidate = \ElevenLabs\Types\AgentTransferOpReplace::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AgentTransferOpReplace didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AgentTransferOpPush::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AgentTransferOpPush didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AgentTransferOpPop::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AgentTransferOpPop didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException('Data does not match any AgentTransferOp type');
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
