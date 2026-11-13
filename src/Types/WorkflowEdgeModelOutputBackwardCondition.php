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
class WorkflowEdgeModelOutputBackwardCondition extends JsonSerializableType
{
  /**
   * @var string The discriminator value identifying which variant is stored
   */
  public readonly string $type;

  /**
   * @var \ElevenLabs\Types\WorkflowUnconditionalModelOutput|\ElevenLabs\Types\WorkflowLlmConditionModelOutput|\ElevenLabs\Types\WorkflowResultConditionModelOutput|\ElevenLabs\Types\WorkflowExpressionConditionModelOutput|array<string, mixed> The value, exactly one of the variant types
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
   * @throws \RuntimeException if this WorkflowEdgeModelOutputBackwardCondition holds a known variant
   */
  public function _asUnknown(): array
  {
    if (!$this->_isUnknown()) {
      throw new \RuntimeException(
        'WorkflowEdgeModelOutputBackwardCondition does not contain an unknown variant'
      );
    }
    /** @var array<string, mixed> $value */
    $value = $this->value;
    return $value;
  }

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\WorkflowUnconditionalModelOutput|\ElevenLabs\Types\WorkflowLlmConditionModelOutput|\ElevenLabs\Types\WorkflowResultConditionModelOutput|\ElevenLabs\Types\WorkflowExpressionConditionModelOutput|array<string, mixed> $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
    $this->type = match ($typeIndex) {
      0 => 'unconditional',
      1 => 'llm',
      2 => 'result',
      3 => 'expression',
      self::UNKNOWN => '_unknown',
      default => throw new \UnexpectedValueException("Unknown type index: $typeIndex")
    };
  }

  // Factory methods
  /**
   * Create a WorkflowEdgeModelOutputBackwardCondition instance containing a \ElevenLabs\Types\WorkflowUnconditionalModelOutput
   */
  public static function unconditional(
    \ElevenLabs\Types\WorkflowUnconditionalModelOutput $unconditional
  ): self {
    return new self($unconditional, 0);
  }

  /**
   * Create a WorkflowEdgeModelOutputBackwardCondition instance containing a \ElevenLabs\Types\WorkflowLlmConditionModelOutput
   */
  public static function llm(\ElevenLabs\Types\WorkflowLlmConditionModelOutput $llm): self
  {
    return new self($llm, 1);
  }

  /**
   * Create a WorkflowEdgeModelOutputBackwardCondition instance containing a \ElevenLabs\Types\WorkflowResultConditionModelOutput
   */
  public static function result(\ElevenLabs\Types\WorkflowResultConditionModelOutput $result): self
  {
    return new self($result, 2);
  }

  /**
   * Create a WorkflowEdgeModelOutputBackwardCondition instance containing a \ElevenLabs\Types\WorkflowExpressionConditionModelOutput
   */
  public static function expression(
    \ElevenLabs\Types\WorkflowExpressionConditionModelOutput $expression
  ): self {
    return new self($expression, 3);
  }

  // Type checking methods
  /**
   * Check if this WorkflowEdgeModelOutputBackwardCondition contains a \ElevenLabs\Types\WorkflowUnconditionalModelOutput
   */
  public function isUnconditional(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this WorkflowEdgeModelOutputBackwardCondition contains a \ElevenLabs\Types\WorkflowLlmConditionModelOutput
   */
  public function isLlm(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this WorkflowEdgeModelOutputBackwardCondition contains a \ElevenLabs\Types\WorkflowResultConditionModelOutput
   */
  public function isResult(): bool
  {
    return $this->typeIndex === 2;
  }

  /**
   * Check if this WorkflowEdgeModelOutputBackwardCondition contains a \ElevenLabs\Types\WorkflowExpressionConditionModelOutput
   */
  public function isExpression(): bool
  {
    return $this->typeIndex === 3;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\WorkflowUnconditionalModelOutput value
   * @throws \RuntimeException if this WorkflowEdgeModelOutputBackwardCondition does not contain a \ElevenLabs\Types\WorkflowUnconditionalModelOutput
   */
  public function asUnconditional(): \ElevenLabs\Types\WorkflowUnconditionalModelOutput
  {
    if (!$this->isUnconditional()) {
      throw new \RuntimeException(
        'WorkflowEdgeModelOutputBackwardCondition does not contain \ElevenLabs\Types\WorkflowUnconditionalModelOutput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\WorkflowLlmConditionModelOutput value
   * @throws \RuntimeException if this WorkflowEdgeModelOutputBackwardCondition does not contain a \ElevenLabs\Types\WorkflowLlmConditionModelOutput
   */
  public function asLlm(): \ElevenLabs\Types\WorkflowLlmConditionModelOutput
  {
    if (!$this->isLlm()) {
      throw new \RuntimeException(
        'WorkflowEdgeModelOutputBackwardCondition does not contain \ElevenLabs\Types\WorkflowLlmConditionModelOutput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\WorkflowResultConditionModelOutput value
   * @throws \RuntimeException if this WorkflowEdgeModelOutputBackwardCondition does not contain a \ElevenLabs\Types\WorkflowResultConditionModelOutput
   */
  public function asResult(): \ElevenLabs\Types\WorkflowResultConditionModelOutput
  {
    if (!$this->isResult()) {
      throw new \RuntimeException(
        'WorkflowEdgeModelOutputBackwardCondition does not contain \ElevenLabs\Types\WorkflowResultConditionModelOutput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\WorkflowExpressionConditionModelOutput value
   * @throws \RuntimeException if this WorkflowEdgeModelOutputBackwardCondition does not contain a \ElevenLabs\Types\WorkflowExpressionConditionModelOutput
   */
  public function asExpression(): \ElevenLabs\Types\WorkflowExpressionConditionModelOutput
  {
    if (!$this->isExpression()) {
      throw new \RuntimeException(
        'WorkflowEdgeModelOutputBackwardCondition does not contain \ElevenLabs\Types\WorkflowExpressionConditionModelOutput'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\WorkflowUnconditionalModelOutput value
   * @return \ElevenLabs\Types\WorkflowUnconditionalModelOutput|null Returns the value if this WorkflowEdgeModelOutputBackwardCondition contains a \ElevenLabs\Types\WorkflowUnconditionalModelOutput, null otherwise
   */
  public function tryAsUnconditional(): ?\ElevenLabs\Types\WorkflowUnconditionalModelOutput
  {
    return $this->isUnconditional() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\WorkflowLlmConditionModelOutput value
   * @return \ElevenLabs\Types\WorkflowLlmConditionModelOutput|null Returns the value if this WorkflowEdgeModelOutputBackwardCondition contains a \ElevenLabs\Types\WorkflowLlmConditionModelOutput, null otherwise
   */
  public function tryAsLlm(): ?\ElevenLabs\Types\WorkflowLlmConditionModelOutput
  {
    return $this->isLlm() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\WorkflowResultConditionModelOutput value
   * @return \ElevenLabs\Types\WorkflowResultConditionModelOutput|null Returns the value if this WorkflowEdgeModelOutputBackwardCondition contains a \ElevenLabs\Types\WorkflowResultConditionModelOutput, null otherwise
   */
  public function tryAsResult(): ?\ElevenLabs\Types\WorkflowResultConditionModelOutput
  {
    return $this->isResult() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\WorkflowExpressionConditionModelOutput value
   * @return \ElevenLabs\Types\WorkflowExpressionConditionModelOutput|null Returns the value if this WorkflowEdgeModelOutputBackwardCondition contains a \ElevenLabs\Types\WorkflowExpressionConditionModelOutput, null otherwise
   */
  public function tryAsExpression(): ?\ElevenLabs\Types\WorkflowExpressionConditionModelOutput
  {
    return $this->isExpression() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\WorkflowUnconditionalModelOutput): T $onUnconditional
   * @param callable(\ElevenLabs\Types\WorkflowLlmConditionModelOutput): T $onLlm
   * @param callable(\ElevenLabs\Types\WorkflowResultConditionModelOutput): T $onResult
   * @param callable(\ElevenLabs\Types\WorkflowExpressionConditionModelOutput): T $onExpression
   * @return T
   */
  public function match(
    callable $onUnconditional,
    callable $onLlm,
    callable $onResult,
    callable $onExpression
  ): mixed {
    return match ($this->typeIndex) {
      0 => $onUnconditional($this->value),
      1 => $onLlm($this->value),
      2 => $onResult($this->value),
      3 => $onExpression($this->value),
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
        case 'expression':
          return new self(
            \ElevenLabs\Types\WorkflowExpressionConditionModelOutput::fromArray($data),
            3
          );
        case 'llm':
          return new self(\ElevenLabs\Types\WorkflowLlmConditionModelOutput::fromArray($data), 1);
        case 'result':
          return new self(
            \ElevenLabs\Types\WorkflowResultConditionModelOutput::fromArray($data),
            2
          );
        case 'unconditional':
          return new self(\ElevenLabs\Types\WorkflowUnconditionalModelOutput::fromArray($data), 0);
        default:
          // A variant the API added after this SDK was generated: kept, not rejected.
          return new self($data, self::UNKNOWN);
      }
    }

    /** @var list<array{instance: mixed, idx: int, score: int}> */
    $candidates = [];
    try {
      $candidate = \ElevenLabs\Types\WorkflowUnconditionalModelOutput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\WorkflowUnconditionalModelOutput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\WorkflowLlmConditionModelOutput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\WorkflowLlmConditionModelOutput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\WorkflowResultConditionModelOutput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\WorkflowResultConditionModelOutput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\WorkflowExpressionConditionModelOutput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 3, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\WorkflowExpressionConditionModelOutput didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException(
        'Data does not match any WorkflowEdgeModelOutputBackwardCondition type'
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
