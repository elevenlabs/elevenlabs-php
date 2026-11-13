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
class UnitTestToolCallParameterEval extends JsonSerializableType
{
  /**
   * @var string The discriminator value identifying which variant is stored
   */
  public readonly string $type;

  /**
   * @var \ElevenLabs\Types\LlmParameterEvaluationStrategy|\ElevenLabs\Types\RegexParameterEvaluationStrategy|\ElevenLabs\Types\ExactParameterEvaluationStrategy|\ElevenLabs\Types\MatchAnythingParameterEvaluationStrategy|array<string, mixed> The value, exactly one of the variant types
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
   * @throws \RuntimeException if this UnitTestToolCallParameterEval holds a known variant
   */
  public function _asUnknown(): array
  {
    if (!$this->_isUnknown()) {
      throw new \RuntimeException(
        'UnitTestToolCallParameterEval does not contain an unknown variant'
      );
    }
    /** @var array<string, mixed> $value */
    $value = $this->value;
    return $value;
  }

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\LlmParameterEvaluationStrategy|\ElevenLabs\Types\RegexParameterEvaluationStrategy|\ElevenLabs\Types\ExactParameterEvaluationStrategy|\ElevenLabs\Types\MatchAnythingParameterEvaluationStrategy|array<string, mixed> $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
    $this->type = match ($typeIndex) {
      0 => 'llm',
      1 => 'regex',
      2 => 'exact',
      3 => 'anything',
      self::UNKNOWN => '_unknown',
      default => throw new \UnexpectedValueException("Unknown type index: $typeIndex")
    };
  }

  // Factory methods
  /**
   * Create a UnitTestToolCallParameterEval instance containing a \ElevenLabs\Types\LlmParameterEvaluationStrategy
   */
  public static function llm(\ElevenLabs\Types\LlmParameterEvaluationStrategy $llm): self
  {
    return new self($llm, 0);
  }

  /**
   * Create a UnitTestToolCallParameterEval instance containing a \ElevenLabs\Types\RegexParameterEvaluationStrategy
   */
  public static function regex(\ElevenLabs\Types\RegexParameterEvaluationStrategy $regex): self
  {
    return new self($regex, 1);
  }

  /**
   * Create a UnitTestToolCallParameterEval instance containing a \ElevenLabs\Types\ExactParameterEvaluationStrategy
   */
  public static function exact(\ElevenLabs\Types\ExactParameterEvaluationStrategy $exact): self
  {
    return new self($exact, 2);
  }

  /**
   * Create a UnitTestToolCallParameterEval instance containing a \ElevenLabs\Types\MatchAnythingParameterEvaluationStrategy
   */
  public static function anything(
    \ElevenLabs\Types\MatchAnythingParameterEvaluationStrategy $anything
  ): self {
    return new self($anything, 3);
  }

  // Type checking methods
  /**
   * Check if this UnitTestToolCallParameterEval contains a \ElevenLabs\Types\LlmParameterEvaluationStrategy
   */
  public function isLlm(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this UnitTestToolCallParameterEval contains a \ElevenLabs\Types\RegexParameterEvaluationStrategy
   */
  public function isRegex(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this UnitTestToolCallParameterEval contains a \ElevenLabs\Types\ExactParameterEvaluationStrategy
   */
  public function isExact(): bool
  {
    return $this->typeIndex === 2;
  }

  /**
   * Check if this UnitTestToolCallParameterEval contains a \ElevenLabs\Types\MatchAnythingParameterEvaluationStrategy
   */
  public function isAnything(): bool
  {
    return $this->typeIndex === 3;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\LlmParameterEvaluationStrategy value
   * @throws \RuntimeException if this UnitTestToolCallParameterEval does not contain a \ElevenLabs\Types\LlmParameterEvaluationStrategy
   */
  public function asLlm(): \ElevenLabs\Types\LlmParameterEvaluationStrategy
  {
    if (!$this->isLlm()) {
      throw new \RuntimeException(
        'UnitTestToolCallParameterEval does not contain \ElevenLabs\Types\LlmParameterEvaluationStrategy'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\RegexParameterEvaluationStrategy value
   * @throws \RuntimeException if this UnitTestToolCallParameterEval does not contain a \ElevenLabs\Types\RegexParameterEvaluationStrategy
   */
  public function asRegex(): \ElevenLabs\Types\RegexParameterEvaluationStrategy
  {
    if (!$this->isRegex()) {
      throw new \RuntimeException(
        'UnitTestToolCallParameterEval does not contain \ElevenLabs\Types\RegexParameterEvaluationStrategy'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ExactParameterEvaluationStrategy value
   * @throws \RuntimeException if this UnitTestToolCallParameterEval does not contain a \ElevenLabs\Types\ExactParameterEvaluationStrategy
   */
  public function asExact(): \ElevenLabs\Types\ExactParameterEvaluationStrategy
  {
    if (!$this->isExact()) {
      throw new \RuntimeException(
        'UnitTestToolCallParameterEval does not contain \ElevenLabs\Types\ExactParameterEvaluationStrategy'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\MatchAnythingParameterEvaluationStrategy value
   * @throws \RuntimeException if this UnitTestToolCallParameterEval does not contain a \ElevenLabs\Types\MatchAnythingParameterEvaluationStrategy
   */
  public function asAnything(): \ElevenLabs\Types\MatchAnythingParameterEvaluationStrategy
  {
    if (!$this->isAnything()) {
      throw new \RuntimeException(
        'UnitTestToolCallParameterEval does not contain \ElevenLabs\Types\MatchAnythingParameterEvaluationStrategy'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\LlmParameterEvaluationStrategy value
   * @return \ElevenLabs\Types\LlmParameterEvaluationStrategy|null Returns the value if this UnitTestToolCallParameterEval contains a \ElevenLabs\Types\LlmParameterEvaluationStrategy, null otherwise
   */
  public function tryAsLlm(): ?\ElevenLabs\Types\LlmParameterEvaluationStrategy
  {
    return $this->isLlm() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\RegexParameterEvaluationStrategy value
   * @return \ElevenLabs\Types\RegexParameterEvaluationStrategy|null Returns the value if this UnitTestToolCallParameterEval contains a \ElevenLabs\Types\RegexParameterEvaluationStrategy, null otherwise
   */
  public function tryAsRegex(): ?\ElevenLabs\Types\RegexParameterEvaluationStrategy
  {
    return $this->isRegex() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ExactParameterEvaluationStrategy value
   * @return \ElevenLabs\Types\ExactParameterEvaluationStrategy|null Returns the value if this UnitTestToolCallParameterEval contains a \ElevenLabs\Types\ExactParameterEvaluationStrategy, null otherwise
   */
  public function tryAsExact(): ?\ElevenLabs\Types\ExactParameterEvaluationStrategy
  {
    return $this->isExact() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\MatchAnythingParameterEvaluationStrategy value
   * @return \ElevenLabs\Types\MatchAnythingParameterEvaluationStrategy|null Returns the value if this UnitTestToolCallParameterEval contains a \ElevenLabs\Types\MatchAnythingParameterEvaluationStrategy, null otherwise
   */
  public function tryAsAnything(): ?\ElevenLabs\Types\MatchAnythingParameterEvaluationStrategy
  {
    return $this->isAnything() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\LlmParameterEvaluationStrategy): T $onLlm
   * @param callable(\ElevenLabs\Types\RegexParameterEvaluationStrategy): T $onRegex
   * @param callable(\ElevenLabs\Types\ExactParameterEvaluationStrategy): T $onExact
   * @param callable(\ElevenLabs\Types\MatchAnythingParameterEvaluationStrategy): T $onAnything
   * @return T
   */
  public function match(
    callable $onLlm,
    callable $onRegex,
    callable $onExact,
    callable $onAnything
  ): mixed {
    return match ($this->typeIndex) {
      0 => $onLlm($this->value),
      1 => $onRegex($this->value),
      2 => $onExact($this->value),
      3 => $onAnything($this->value),
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
        case 'anything':
          return new self(
            \ElevenLabs\Types\MatchAnythingParameterEvaluationStrategy::fromArray($data),
            3
          );
        case 'exact':
          return new self(\ElevenLabs\Types\ExactParameterEvaluationStrategy::fromArray($data), 2);
        case 'llm':
          return new self(\ElevenLabs\Types\LlmParameterEvaluationStrategy::fromArray($data), 0);
        case 'regex':
          return new self(\ElevenLabs\Types\RegexParameterEvaluationStrategy::fromArray($data), 1);
        default:
          // A variant the API added after this SDK was generated: kept, not rejected.
          return new self($data, self::UNKNOWN);
      }
    }

    /** @var list<array{instance: mixed, idx: int, score: int}> */
    $candidates = [];
    try {
      $candidate = \ElevenLabs\Types\LlmParameterEvaluationStrategy::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\LlmParameterEvaluationStrategy didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\RegexParameterEvaluationStrategy::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\RegexParameterEvaluationStrategy didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ExactParameterEvaluationStrategy::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ExactParameterEvaluationStrategy didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\MatchAnythingParameterEvaluationStrategy::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 3, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\MatchAnythingParameterEvaluationStrategy didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException(
        'Data does not match any UnitTestToolCallParameterEval type'
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
