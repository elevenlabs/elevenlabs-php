<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Tests\Types;

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
class UpdateTestsResponse extends JsonSerializableType
{
  /**
   * @var string The discriminator value identifying which variant is stored
   */
  public readonly string $type;

  /**
   * @var \ElevenLabs\Types\GetResponseUnitTestResponseModel|\ElevenLabs\Types\GetToolCallUnitTestResponseModel|\ElevenLabs\Types\GetSimulationTestResponseModel|array<string, mixed> The value, exactly one of the variant types
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
   * @throws \RuntimeException if this UpdateTestsResponse holds a known variant
   */
  public function _asUnknown(): array
  {
    if (!$this->_isUnknown()) {
      throw new \RuntimeException('UpdateTestsResponse does not contain an unknown variant');
    }
    /** @var array<string, mixed> $value */
    $value = $this->value;
    return $value;
  }

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\GetResponseUnitTestResponseModel|\ElevenLabs\Types\GetToolCallUnitTestResponseModel|\ElevenLabs\Types\GetSimulationTestResponseModel|array<string, mixed> $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
    $this->type = match ($typeIndex) {
      0 => 'llm',
      1 => 'tool',
      2 => 'simulation',
      self::UNKNOWN => '_unknown',
      default => throw new \UnexpectedValueException("Unknown type index: $typeIndex")
    };
  }

  // Factory methods
  /**
   * Create a UpdateTestsResponse instance containing a \ElevenLabs\Types\GetResponseUnitTestResponseModel
   */
  public static function llm(\ElevenLabs\Types\GetResponseUnitTestResponseModel $llm): self
  {
    return new self($llm, 0);
  }

  /**
   * Create a UpdateTestsResponse instance containing a \ElevenLabs\Types\GetToolCallUnitTestResponseModel
   */
  public static function tool(\ElevenLabs\Types\GetToolCallUnitTestResponseModel $tool): self
  {
    return new self($tool, 1);
  }

  /**
   * Create a UpdateTestsResponse instance containing a \ElevenLabs\Types\GetSimulationTestResponseModel
   */
  public static function simulation(
    \ElevenLabs\Types\GetSimulationTestResponseModel $simulation
  ): self {
    return new self($simulation, 2);
  }

  // Type checking methods
  /**
   * Check if this UpdateTestsResponse contains a \ElevenLabs\Types\GetResponseUnitTestResponseModel
   */
  public function isLlm(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this UpdateTestsResponse contains a \ElevenLabs\Types\GetToolCallUnitTestResponseModel
   */
  public function isTool(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this UpdateTestsResponse contains a \ElevenLabs\Types\GetSimulationTestResponseModel
   */
  public function isSimulation(): bool
  {
    return $this->typeIndex === 2;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\GetResponseUnitTestResponseModel value
   * @throws \RuntimeException if this UpdateTestsResponse does not contain a \ElevenLabs\Types\GetResponseUnitTestResponseModel
   */
  public function asLlm(): \ElevenLabs\Types\GetResponseUnitTestResponseModel
  {
    if (!$this->isLlm()) {
      throw new \RuntimeException(
        'UpdateTestsResponse does not contain \ElevenLabs\Types\GetResponseUnitTestResponseModel'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\GetToolCallUnitTestResponseModel value
   * @throws \RuntimeException if this UpdateTestsResponse does not contain a \ElevenLabs\Types\GetToolCallUnitTestResponseModel
   */
  public function asTool(): \ElevenLabs\Types\GetToolCallUnitTestResponseModel
  {
    if (!$this->isTool()) {
      throw new \RuntimeException(
        'UpdateTestsResponse does not contain \ElevenLabs\Types\GetToolCallUnitTestResponseModel'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\GetSimulationTestResponseModel value
   * @throws \RuntimeException if this UpdateTestsResponse does not contain a \ElevenLabs\Types\GetSimulationTestResponseModel
   */
  public function asSimulation(): \ElevenLabs\Types\GetSimulationTestResponseModel
  {
    if (!$this->isSimulation()) {
      throw new \RuntimeException(
        'UpdateTestsResponse does not contain \ElevenLabs\Types\GetSimulationTestResponseModel'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\GetResponseUnitTestResponseModel value
   * @return \ElevenLabs\Types\GetResponseUnitTestResponseModel|null Returns the value if this UpdateTestsResponse contains a \ElevenLabs\Types\GetResponseUnitTestResponseModel, null otherwise
   */
  public function tryAsLlm(): ?\ElevenLabs\Types\GetResponseUnitTestResponseModel
  {
    return $this->isLlm() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\GetToolCallUnitTestResponseModel value
   * @return \ElevenLabs\Types\GetToolCallUnitTestResponseModel|null Returns the value if this UpdateTestsResponse contains a \ElevenLabs\Types\GetToolCallUnitTestResponseModel, null otherwise
   */
  public function tryAsTool(): ?\ElevenLabs\Types\GetToolCallUnitTestResponseModel
  {
    return $this->isTool() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\GetSimulationTestResponseModel value
   * @return \ElevenLabs\Types\GetSimulationTestResponseModel|null Returns the value if this UpdateTestsResponse contains a \ElevenLabs\Types\GetSimulationTestResponseModel, null otherwise
   */
  public function tryAsSimulation(): ?\ElevenLabs\Types\GetSimulationTestResponseModel
  {
    return $this->isSimulation() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\GetResponseUnitTestResponseModel): T $onLlm
   * @param callable(\ElevenLabs\Types\GetToolCallUnitTestResponseModel): T $onTool
   * @param callable(\ElevenLabs\Types\GetSimulationTestResponseModel): T $onSimulation
   * @return T
   */
  public function match(callable $onLlm, callable $onTool, callable $onSimulation): mixed
  {
    return match ($this->typeIndex) {
      0 => $onLlm($this->value),
      1 => $onTool($this->value),
      2 => $onSimulation($this->value),
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
        case 'llm':
          return new self(\ElevenLabs\Types\GetResponseUnitTestResponseModel::fromArray($data), 0);
        case 'tool':
          return new self(\ElevenLabs\Types\GetToolCallUnitTestResponseModel::fromArray($data), 1);
        case 'simulation':
          return new self(\ElevenLabs\Types\GetSimulationTestResponseModel::fromArray($data), 2);
        default:
          // A variant the API added after this SDK was generated: kept, not rejected.
          return new self($data, self::UNKNOWN);
      }
    }

    /** @var list<array{instance: mixed, idx: int, score: int}> */
    $candidates = [];
    try {
      $candidate = \ElevenLabs\Types\GetResponseUnitTestResponseModel::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\GetResponseUnitTestResponseModel didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\GetToolCallUnitTestResponseModel::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\GetToolCallUnitTestResponseModel didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\GetSimulationTestResponseModel::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\GetSimulationTestResponseModel didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException('Data does not match any UpdateTestsResponse type');
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
