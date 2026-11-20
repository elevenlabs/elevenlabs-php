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
class ExotelTransferOutputConfig extends JsonSerializableType
{
  /**
   * @var string The discriminator value identifying which variant is stored
   */
  public readonly string $type;

  /**
   * @var \ElevenLabs\Types\ExotelColdBlindTransferConfigOutput|\ElevenLabs\Types\ExotelWarmTransferConfigOutput|array<string, mixed> The value, exactly one of the variant types
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
   * @throws \RuntimeException if this ExotelTransferOutputConfig holds a known variant
   */
  public function _asUnknown(): array
  {
    if (!$this->_isUnknown()) {
      throw new \RuntimeException('ExotelTransferOutputConfig does not contain an unknown variant');
    }
    /** @var array<string, mixed> $value */
    $value = $this->value;
    return $value;
  }

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\ExotelColdBlindTransferConfigOutput|\ElevenLabs\Types\ExotelWarmTransferConfigOutput|array<string, mixed> $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
    $this->type = match ($typeIndex) {
      0 => 'exotel_cold_blind_transfer',
      1 => 'exotel_warm_transfer',
      self::UNKNOWN => '_unknown',
      default => throw new \UnexpectedValueException("Unknown type index: $typeIndex")
    };
  }

  // Factory methods
  /**
   * Create a ExotelTransferOutputConfig instance containing a \ElevenLabs\Types\ExotelColdBlindTransferConfigOutput
   */
  public static function exotelColdBlindTransfer(
    \ElevenLabs\Types\ExotelColdBlindTransferConfigOutput $exotelColdBlindTransfer
  ): self {
    return new self($exotelColdBlindTransfer, 0);
  }

  /**
   * Create a ExotelTransferOutputConfig instance containing a \ElevenLabs\Types\ExotelWarmTransferConfigOutput
   */
  public static function exotelWarmTransfer(
    \ElevenLabs\Types\ExotelWarmTransferConfigOutput $exotelWarmTransfer
  ): self {
    return new self($exotelWarmTransfer, 1);
  }

  // Type checking methods
  /**
   * Check if this ExotelTransferOutputConfig contains a \ElevenLabs\Types\ExotelColdBlindTransferConfigOutput
   */
  public function isExotelColdBlindTransfer(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this ExotelTransferOutputConfig contains a \ElevenLabs\Types\ExotelWarmTransferConfigOutput
   */
  public function isExotelWarmTransfer(): bool
  {
    return $this->typeIndex === 1;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\ExotelColdBlindTransferConfigOutput value
   * @throws \RuntimeException if this ExotelTransferOutputConfig does not contain a \ElevenLabs\Types\ExotelColdBlindTransferConfigOutput
   */
  public function asExotelColdBlindTransfer(): \ElevenLabs\Types\ExotelColdBlindTransferConfigOutput
  {
    if (!$this->isExotelColdBlindTransfer()) {
      throw new \RuntimeException(
        'ExotelTransferOutputConfig does not contain \ElevenLabs\Types\ExotelColdBlindTransferConfigOutput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ExotelWarmTransferConfigOutput value
   * @throws \RuntimeException if this ExotelTransferOutputConfig does not contain a \ElevenLabs\Types\ExotelWarmTransferConfigOutput
   */
  public function asExotelWarmTransfer(): \ElevenLabs\Types\ExotelWarmTransferConfigOutput
  {
    if (!$this->isExotelWarmTransfer()) {
      throw new \RuntimeException(
        'ExotelTransferOutputConfig does not contain \ElevenLabs\Types\ExotelWarmTransferConfigOutput'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\ExotelColdBlindTransferConfigOutput value
   * @return \ElevenLabs\Types\ExotelColdBlindTransferConfigOutput|null Returns the value if this ExotelTransferOutputConfig contains a \ElevenLabs\Types\ExotelColdBlindTransferConfigOutput, null otherwise
   */
  public function tryAsExotelColdBlindTransfer(): ?\ElevenLabs\Types\ExotelColdBlindTransferConfigOutput
  {
    return $this->isExotelColdBlindTransfer() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ExotelWarmTransferConfigOutput value
   * @return \ElevenLabs\Types\ExotelWarmTransferConfigOutput|null Returns the value if this ExotelTransferOutputConfig contains a \ElevenLabs\Types\ExotelWarmTransferConfigOutput, null otherwise
   */
  public function tryAsExotelWarmTransfer(): ?\ElevenLabs\Types\ExotelWarmTransferConfigOutput
  {
    return $this->isExotelWarmTransfer() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\ExotelColdBlindTransferConfigOutput): T $onExotelColdBlindTransfer
   * @param callable(\ElevenLabs\Types\ExotelWarmTransferConfigOutput): T $onExotelWarmTransfer
   * @return T
   */
  public function match(callable $onExotelColdBlindTransfer, callable $onExotelWarmTransfer): mixed
  {
    return match ($this->typeIndex) {
      0 => $onExotelColdBlindTransfer($this->value),
      1 => $onExotelWarmTransfer($this->value),
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
        case 'exotel_cold_blind_transfer':
          return new self(
            \ElevenLabs\Types\ExotelColdBlindTransferConfigOutput::fromArray($data),
            0
          );
        case 'exotel_warm_transfer':
          return new self(\ElevenLabs\Types\ExotelWarmTransferConfigOutput::fromArray($data), 1);
        default:
          // A variant the API added after this SDK was generated: kept, not rejected.
          return new self($data, self::UNKNOWN);
      }
    }

    /** @var list<array{instance: mixed, idx: int, score: int}> */
    $candidates = [];
    try {
      $candidate = \ElevenLabs\Types\ExotelColdBlindTransferConfigOutput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ExotelColdBlindTransferConfigOutput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ExotelWarmTransferConfigOutput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ExotelWarmTransferConfigOutput didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException(
        'Data does not match any ExotelTransferOutputConfig type'
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
