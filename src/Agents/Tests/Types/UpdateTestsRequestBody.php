<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Tests\Types;

use ElevenLabs\Core\Json\JsonSerializableType;

/**
 * Agent test to update
 */
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
class UpdateTestsRequestBody extends JsonSerializableType
{
  /**
   * @var string The discriminator value identifying which variant is stored
   */
  public readonly string $type;

  /**
   * @var \ElevenLabs\Types\UpdateResponseUnitTestRequest|\ElevenLabs\Types\UpdateToolCallUnitTestRequest|\ElevenLabs\Types\UpdateSimulationTestRequest|array<string, mixed> The value, exactly one of the variant types
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
   * @throws \RuntimeException if this UpdateTestsRequestBody holds a known variant
   */
  public function _asUnknown(): array
  {
    if (!$this->_isUnknown()) {
      throw new \RuntimeException('UpdateTestsRequestBody does not contain an unknown variant');
    }
    /** @var array<string, mixed> $value */
    $value = $this->value;
    return $value;
  }

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\UpdateResponseUnitTestRequest|\ElevenLabs\Types\UpdateToolCallUnitTestRequest|\ElevenLabs\Types\UpdateSimulationTestRequest|array<string, mixed> $value
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
   * Create a UpdateTestsRequestBody instance containing a \ElevenLabs\Types\UpdateResponseUnitTestRequest
   */
  public static function llm(\ElevenLabs\Types\UpdateResponseUnitTestRequest $llm): self
  {
    return new self($llm, 0);
  }

  /**
   * Create a UpdateTestsRequestBody instance containing a \ElevenLabs\Types\UpdateToolCallUnitTestRequest
   */
  public static function tool(\ElevenLabs\Types\UpdateToolCallUnitTestRequest $tool): self
  {
    return new self($tool, 1);
  }

  /**
   * Create a UpdateTestsRequestBody instance containing a \ElevenLabs\Types\UpdateSimulationTestRequest
   */
  public static function simulation(\ElevenLabs\Types\UpdateSimulationTestRequest $simulation): self
  {
    return new self($simulation, 2);
  }

  // Type checking methods
  /**
   * Check if this UpdateTestsRequestBody contains a \ElevenLabs\Types\UpdateResponseUnitTestRequest
   */
  public function isLlm(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this UpdateTestsRequestBody contains a \ElevenLabs\Types\UpdateToolCallUnitTestRequest
   */
  public function isTool(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this UpdateTestsRequestBody contains a \ElevenLabs\Types\UpdateSimulationTestRequest
   */
  public function isSimulation(): bool
  {
    return $this->typeIndex === 2;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\UpdateResponseUnitTestRequest value
   * @throws \RuntimeException if this UpdateTestsRequestBody does not contain a \ElevenLabs\Types\UpdateResponseUnitTestRequest
   */
  public function asLlm(): \ElevenLabs\Types\UpdateResponseUnitTestRequest
  {
    if (!$this->isLlm()) {
      throw new \RuntimeException(
        'UpdateTestsRequestBody does not contain \ElevenLabs\Types\UpdateResponseUnitTestRequest'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\UpdateToolCallUnitTestRequest value
   * @throws \RuntimeException if this UpdateTestsRequestBody does not contain a \ElevenLabs\Types\UpdateToolCallUnitTestRequest
   */
  public function asTool(): \ElevenLabs\Types\UpdateToolCallUnitTestRequest
  {
    if (!$this->isTool()) {
      throw new \RuntimeException(
        'UpdateTestsRequestBody does not contain \ElevenLabs\Types\UpdateToolCallUnitTestRequest'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\UpdateSimulationTestRequest value
   * @throws \RuntimeException if this UpdateTestsRequestBody does not contain a \ElevenLabs\Types\UpdateSimulationTestRequest
   */
  public function asSimulation(): \ElevenLabs\Types\UpdateSimulationTestRequest
  {
    if (!$this->isSimulation()) {
      throw new \RuntimeException(
        'UpdateTestsRequestBody does not contain \ElevenLabs\Types\UpdateSimulationTestRequest'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\UpdateResponseUnitTestRequest value
   * @return \ElevenLabs\Types\UpdateResponseUnitTestRequest|null Returns the value if this UpdateTestsRequestBody contains a \ElevenLabs\Types\UpdateResponseUnitTestRequest, null otherwise
   */
  public function tryAsLlm(): ?\ElevenLabs\Types\UpdateResponseUnitTestRequest
  {
    return $this->isLlm() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\UpdateToolCallUnitTestRequest value
   * @return \ElevenLabs\Types\UpdateToolCallUnitTestRequest|null Returns the value if this UpdateTestsRequestBody contains a \ElevenLabs\Types\UpdateToolCallUnitTestRequest, null otherwise
   */
  public function tryAsTool(): ?\ElevenLabs\Types\UpdateToolCallUnitTestRequest
  {
    return $this->isTool() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\UpdateSimulationTestRequest value
   * @return \ElevenLabs\Types\UpdateSimulationTestRequest|null Returns the value if this UpdateTestsRequestBody contains a \ElevenLabs\Types\UpdateSimulationTestRequest, null otherwise
   */
  public function tryAsSimulation(): ?\ElevenLabs\Types\UpdateSimulationTestRequest
  {
    return $this->isSimulation() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\UpdateResponseUnitTestRequest): T $onLlm
   * @param callable(\ElevenLabs\Types\UpdateToolCallUnitTestRequest): T $onTool
   * @param callable(\ElevenLabs\Types\UpdateSimulationTestRequest): T $onSimulation
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
          return new self(\ElevenLabs\Types\UpdateResponseUnitTestRequest::fromArray($data), 0);
        case 'tool':
          return new self(\ElevenLabs\Types\UpdateToolCallUnitTestRequest::fromArray($data), 1);
        case 'simulation':
          return new self(\ElevenLabs\Types\UpdateSimulationTestRequest::fromArray($data), 2);
        default:
          // A variant the API added after this SDK was generated: kept, not rejected.
          return new self($data, self::UNKNOWN);
      }
    }

    /** @var list<array{instance: mixed, idx: int, score: int}> */
    $candidates = [];
    try {
      $candidate = \ElevenLabs\Types\UpdateResponseUnitTestRequest::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\UpdateResponseUnitTestRequest didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\UpdateToolCallUnitTestRequest::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\UpdateToolCallUnitTestRequest didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\UpdateSimulationTestRequest::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\UpdateSimulationTestRequest didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException('Data does not match any UpdateTestsRequestBody type');
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
