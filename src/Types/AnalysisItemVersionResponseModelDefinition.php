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
class AnalysisItemVersionResponseModelDefinition extends JsonSerializableType
{
  /**
   * @var string The discriminator value identifying which variant is stored
   */
  public readonly string $kind;

  /**
   * @var \ElevenLabs\Types\UserEvaluationAnalysisItem|\ElevenLabs\Types\UserDataCollectionAnalysisItemOutput|array<string, mixed> The value, exactly one of the variant types
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
   * @throws \RuntimeException if this AnalysisItemVersionResponseModelDefinition holds a known variant
   */
  public function _asUnknown(): array
  {
    if (!$this->_isUnknown()) {
      throw new \RuntimeException(
        'AnalysisItemVersionResponseModelDefinition does not contain an unknown variant'
      );
    }
    /** @var array<string, mixed> $value */
    $value = $this->value;
    return $value;
  }

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\UserEvaluationAnalysisItem|\ElevenLabs\Types\UserDataCollectionAnalysisItemOutput|array<string, mixed> $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
    $this->kind = match ($typeIndex) {
      0 => 'evaluation',
      1 => 'data_collection',
      self::UNKNOWN => '_unknown',
      default => throw new \UnexpectedValueException("Unknown type index: $typeIndex")
    };
  }

  // Factory methods
  /**
   * Create a AnalysisItemVersionResponseModelDefinition instance containing a \ElevenLabs\Types\UserEvaluationAnalysisItem
   */
  public static function evaluation(\ElevenLabs\Types\UserEvaluationAnalysisItem $evaluation): self
  {
    return new self($evaluation, 0);
  }

  /**
   * Create a AnalysisItemVersionResponseModelDefinition instance containing a \ElevenLabs\Types\UserDataCollectionAnalysisItemOutput
   */
  public static function dataCollection(
    \ElevenLabs\Types\UserDataCollectionAnalysisItemOutput $dataCollection
  ): self {
    return new self($dataCollection, 1);
  }

  // Type checking methods
  /**
   * Check if this AnalysisItemVersionResponseModelDefinition contains a \ElevenLabs\Types\UserEvaluationAnalysisItem
   */
  public function isEvaluation(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this AnalysisItemVersionResponseModelDefinition contains a \ElevenLabs\Types\UserDataCollectionAnalysisItemOutput
   */
  public function isDataCollection(): bool
  {
    return $this->typeIndex === 1;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\UserEvaluationAnalysisItem value
   * @throws \RuntimeException if this AnalysisItemVersionResponseModelDefinition does not contain a \ElevenLabs\Types\UserEvaluationAnalysisItem
   */
  public function asEvaluation(): \ElevenLabs\Types\UserEvaluationAnalysisItem
  {
    if (!$this->isEvaluation()) {
      throw new \RuntimeException(
        'AnalysisItemVersionResponseModelDefinition does not contain \ElevenLabs\Types\UserEvaluationAnalysisItem'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\UserDataCollectionAnalysisItemOutput value
   * @throws \RuntimeException if this AnalysisItemVersionResponseModelDefinition does not contain a \ElevenLabs\Types\UserDataCollectionAnalysisItemOutput
   */
  public function asDataCollection(): \ElevenLabs\Types\UserDataCollectionAnalysisItemOutput
  {
    if (!$this->isDataCollection()) {
      throw new \RuntimeException(
        'AnalysisItemVersionResponseModelDefinition does not contain \ElevenLabs\Types\UserDataCollectionAnalysisItemOutput'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\UserEvaluationAnalysisItem value
   * @return \ElevenLabs\Types\UserEvaluationAnalysisItem|null Returns the value if this AnalysisItemVersionResponseModelDefinition contains a \ElevenLabs\Types\UserEvaluationAnalysisItem, null otherwise
   */
  public function tryAsEvaluation(): ?\ElevenLabs\Types\UserEvaluationAnalysisItem
  {
    return $this->isEvaluation() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\UserDataCollectionAnalysisItemOutput value
   * @return \ElevenLabs\Types\UserDataCollectionAnalysisItemOutput|null Returns the value if this AnalysisItemVersionResponseModelDefinition contains a \ElevenLabs\Types\UserDataCollectionAnalysisItemOutput, null otherwise
   */
  public function tryAsDataCollection(): ?\ElevenLabs\Types\UserDataCollectionAnalysisItemOutput
  {
    return $this->isDataCollection() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\UserEvaluationAnalysisItem): T $onEvaluation
   * @param callable(\ElevenLabs\Types\UserDataCollectionAnalysisItemOutput): T $onDataCollection
   * @return T
   */
  public function match(callable $onEvaluation, callable $onDataCollection): mixed
  {
    return match ($this->typeIndex) {
      0 => $onEvaluation($this->value),
      1 => $onDataCollection($this->value),
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
    if (is_array($data) && isset($data['kind']) && is_string($data['kind'])) {
      switch ($data['kind']) {
        case 'data_collection':
          return new self(
            \ElevenLabs\Types\UserDataCollectionAnalysisItemOutput::fromArray($data),
            1
          );
        case 'evaluation':
          return new self(\ElevenLabs\Types\UserEvaluationAnalysisItem::fromArray($data), 0);
        default:
          // A variant the API added after this SDK was generated: kept, not rejected.
          return new self($data, self::UNKNOWN);
      }
    }

    /** @var list<array{instance: mixed, idx: int, score: int}> */
    $candidates = [];
    try {
      $candidate = \ElevenLabs\Types\UserEvaluationAnalysisItem::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\UserEvaluationAnalysisItem didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\UserDataCollectionAnalysisItemOutput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\UserDataCollectionAnalysisItemOutput didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException(
        'Data does not match any AnalysisItemVersionResponseModelDefinition type'
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
