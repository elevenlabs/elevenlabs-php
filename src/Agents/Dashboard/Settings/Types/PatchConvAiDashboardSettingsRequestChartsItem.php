<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Dashboard\Settings\Types;

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
class PatchConvAiDashboardSettingsRequestChartsItem extends JsonSerializableType
{
  /**
   * @var string The discriminator value identifying which variant is stored
   */
  public readonly string $type;

  /**
   * @var \ElevenLabs\Types\DashboardCallSuccessChartModel|\ElevenLabs\Types\DashboardCriteriaChartModel|\ElevenLabs\Types\DashboardDataCollectionChartModel|array<string, mixed> The value, exactly one of the variant types
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
   * @throws \RuntimeException if this PatchConvAiDashboardSettingsRequestChartsItem holds a known variant
   */
  public function _asUnknown(): array
  {
    if (!$this->_isUnknown()) {
      throw new \RuntimeException(
        'PatchConvAiDashboardSettingsRequestChartsItem does not contain an unknown variant'
      );
    }
    /** @var array<string, mixed> $value */
    $value = $this->value;
    return $value;
  }

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\DashboardCallSuccessChartModel|\ElevenLabs\Types\DashboardCriteriaChartModel|\ElevenLabs\Types\DashboardDataCollectionChartModel|array<string, mixed> $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
    $this->type = match ($typeIndex) {
      0 => 'call_success',
      1 => 'criteria',
      2 => 'data_collection',
      self::UNKNOWN => '_unknown',
      default => throw new \UnexpectedValueException("Unknown type index: $typeIndex")
    };
  }

  // Factory methods
  /**
   * Create a PatchConvAiDashboardSettingsRequestChartsItem instance containing a \ElevenLabs\Types\DashboardCallSuccessChartModel
   */
  public static function callSuccess(
    \ElevenLabs\Types\DashboardCallSuccessChartModel $callSuccess
  ): self {
    return new self($callSuccess, 0);
  }

  /**
   * Create a PatchConvAiDashboardSettingsRequestChartsItem instance containing a \ElevenLabs\Types\DashboardCriteriaChartModel
   */
  public static function criteria(\ElevenLabs\Types\DashboardCriteriaChartModel $criteria): self
  {
    return new self($criteria, 1);
  }

  /**
   * Create a PatchConvAiDashboardSettingsRequestChartsItem instance containing a \ElevenLabs\Types\DashboardDataCollectionChartModel
   */
  public static function dataCollection(
    \ElevenLabs\Types\DashboardDataCollectionChartModel $dataCollection
  ): self {
    return new self($dataCollection, 2);
  }

  // Type checking methods
  /**
   * Check if this PatchConvAiDashboardSettingsRequestChartsItem contains a \ElevenLabs\Types\DashboardCallSuccessChartModel
   */
  public function isCallSuccess(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this PatchConvAiDashboardSettingsRequestChartsItem contains a \ElevenLabs\Types\DashboardCriteriaChartModel
   */
  public function isCriteria(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this PatchConvAiDashboardSettingsRequestChartsItem contains a \ElevenLabs\Types\DashboardDataCollectionChartModel
   */
  public function isDataCollection(): bool
  {
    return $this->typeIndex === 2;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\DashboardCallSuccessChartModel value
   * @throws \RuntimeException if this PatchConvAiDashboardSettingsRequestChartsItem does not contain a \ElevenLabs\Types\DashboardCallSuccessChartModel
   */
  public function asCallSuccess(): \ElevenLabs\Types\DashboardCallSuccessChartModel
  {
    if (!$this->isCallSuccess()) {
      throw new \RuntimeException(
        'PatchConvAiDashboardSettingsRequestChartsItem does not contain \ElevenLabs\Types\DashboardCallSuccessChartModel'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\DashboardCriteriaChartModel value
   * @throws \RuntimeException if this PatchConvAiDashboardSettingsRequestChartsItem does not contain a \ElevenLabs\Types\DashboardCriteriaChartModel
   */
  public function asCriteria(): \ElevenLabs\Types\DashboardCriteriaChartModel
  {
    if (!$this->isCriteria()) {
      throw new \RuntimeException(
        'PatchConvAiDashboardSettingsRequestChartsItem does not contain \ElevenLabs\Types\DashboardCriteriaChartModel'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\DashboardDataCollectionChartModel value
   * @throws \RuntimeException if this PatchConvAiDashboardSettingsRequestChartsItem does not contain a \ElevenLabs\Types\DashboardDataCollectionChartModel
   */
  public function asDataCollection(): \ElevenLabs\Types\DashboardDataCollectionChartModel
  {
    if (!$this->isDataCollection()) {
      throw new \RuntimeException(
        'PatchConvAiDashboardSettingsRequestChartsItem does not contain \ElevenLabs\Types\DashboardDataCollectionChartModel'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\DashboardCallSuccessChartModel value
   * @return \ElevenLabs\Types\DashboardCallSuccessChartModel|null Returns the value if this PatchConvAiDashboardSettingsRequestChartsItem contains a \ElevenLabs\Types\DashboardCallSuccessChartModel, null otherwise
   */
  public function tryAsCallSuccess(): ?\ElevenLabs\Types\DashboardCallSuccessChartModel
  {
    return $this->isCallSuccess() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\DashboardCriteriaChartModel value
   * @return \ElevenLabs\Types\DashboardCriteriaChartModel|null Returns the value if this PatchConvAiDashboardSettingsRequestChartsItem contains a \ElevenLabs\Types\DashboardCriteriaChartModel, null otherwise
   */
  public function tryAsCriteria(): ?\ElevenLabs\Types\DashboardCriteriaChartModel
  {
    return $this->isCriteria() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\DashboardDataCollectionChartModel value
   * @return \ElevenLabs\Types\DashboardDataCollectionChartModel|null Returns the value if this PatchConvAiDashboardSettingsRequestChartsItem contains a \ElevenLabs\Types\DashboardDataCollectionChartModel, null otherwise
   */
  public function tryAsDataCollection(): ?\ElevenLabs\Types\DashboardDataCollectionChartModel
  {
    return $this->isDataCollection() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\DashboardCallSuccessChartModel): T $onCallSuccess
   * @param callable(\ElevenLabs\Types\DashboardCriteriaChartModel): T $onCriteria
   * @param callable(\ElevenLabs\Types\DashboardDataCollectionChartModel): T $onDataCollection
   * @return T
   */
  public function match(
    callable $onCallSuccess,
    callable $onCriteria,
    callable $onDataCollection
  ): mixed {
    return match ($this->typeIndex) {
      0 => $onCallSuccess($this->value),
      1 => $onCriteria($this->value),
      2 => $onDataCollection($this->value),
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
        case 'call_success':
          return new self(\ElevenLabs\Types\DashboardCallSuccessChartModel::fromArray($data), 0);
        case 'criteria':
          return new self(\ElevenLabs\Types\DashboardCriteriaChartModel::fromArray($data), 1);
        case 'data_collection':
          return new self(\ElevenLabs\Types\DashboardDataCollectionChartModel::fromArray($data), 2);
        default:
          // A variant the API added after this SDK was generated: kept, not rejected.
          return new self($data, self::UNKNOWN);
      }
    }

    /** @var list<array{instance: mixed, idx: int, score: int}> */
    $candidates = [];
    try {
      $candidate = \ElevenLabs\Types\DashboardCallSuccessChartModel::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\DashboardCallSuccessChartModel didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\DashboardCriteriaChartModel::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\DashboardCriteriaChartModel didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\DashboardDataCollectionChartModel::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\DashboardDataCollectionChartModel didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException(
        'Data does not match any PatchConvAiDashboardSettingsRequestChartsItem type'
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
