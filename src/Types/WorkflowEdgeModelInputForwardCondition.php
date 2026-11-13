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
class WorkflowEdgeModelInputForwardCondition extends JsonSerializableType
{
  /**
   * @var string The discriminator value identifying which variant is stored
   */
  public readonly string $type;

  /**
   * @var \ElevenLabs\Types\WorkflowUnconditionalModelInput|\ElevenLabs\Types\WorkflowLlmConditionModelInput|\ElevenLabs\Types\WorkflowResultConditionModelInput|\ElevenLabs\Types\WorkflowExpressionConditionModelInput|array<string, mixed> The value, exactly one of the variant types
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
   * @throws \RuntimeException if this WorkflowEdgeModelInputForwardCondition holds a known variant
   */
  public function _asUnknown(): array
  {
    if (!$this->_isUnknown()) {
      throw new \RuntimeException(
        'WorkflowEdgeModelInputForwardCondition does not contain an unknown variant'
      );
    }
    /** @var array<string, mixed> $value */
    $value = $this->value;
    return $value;
  }

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\WorkflowUnconditionalModelInput|\ElevenLabs\Types\WorkflowLlmConditionModelInput|\ElevenLabs\Types\WorkflowResultConditionModelInput|\ElevenLabs\Types\WorkflowExpressionConditionModelInput|array<string, mixed> $value
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
   * Create a WorkflowEdgeModelInputForwardCondition instance containing a \ElevenLabs\Types\WorkflowUnconditionalModelInput
   */
  public static function unconditional(
    \ElevenLabs\Types\WorkflowUnconditionalModelInput $unconditional
  ): self {
    return new self($unconditional, 0);
  }

  /**
   * Create a WorkflowEdgeModelInputForwardCondition instance containing a \ElevenLabs\Types\WorkflowLlmConditionModelInput
   */
  public static function llm(\ElevenLabs\Types\WorkflowLlmConditionModelInput $llm): self
  {
    return new self($llm, 1);
  }

  /**
   * Create a WorkflowEdgeModelInputForwardCondition instance containing a \ElevenLabs\Types\WorkflowResultConditionModelInput
   */
  public static function result(\ElevenLabs\Types\WorkflowResultConditionModelInput $result): self
  {
    return new self($result, 2);
  }

  /**
   * Create a WorkflowEdgeModelInputForwardCondition instance containing a \ElevenLabs\Types\WorkflowExpressionConditionModelInput
   */
  public static function expression(
    \ElevenLabs\Types\WorkflowExpressionConditionModelInput $expression
  ): self {
    return new self($expression, 3);
  }

  // Type checking methods
  /**
   * Check if this WorkflowEdgeModelInputForwardCondition contains a \ElevenLabs\Types\WorkflowUnconditionalModelInput
   */
  public function isUnconditional(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this WorkflowEdgeModelInputForwardCondition contains a \ElevenLabs\Types\WorkflowLlmConditionModelInput
   */
  public function isLlm(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this WorkflowEdgeModelInputForwardCondition contains a \ElevenLabs\Types\WorkflowResultConditionModelInput
   */
  public function isResult(): bool
  {
    return $this->typeIndex === 2;
  }

  /**
   * Check if this WorkflowEdgeModelInputForwardCondition contains a \ElevenLabs\Types\WorkflowExpressionConditionModelInput
   */
  public function isExpression(): bool
  {
    return $this->typeIndex === 3;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\WorkflowUnconditionalModelInput value
   * @throws \RuntimeException if this WorkflowEdgeModelInputForwardCondition does not contain a \ElevenLabs\Types\WorkflowUnconditionalModelInput
   */
  public function asUnconditional(): \ElevenLabs\Types\WorkflowUnconditionalModelInput
  {
    if (!$this->isUnconditional()) {
      throw new \RuntimeException(
        'WorkflowEdgeModelInputForwardCondition does not contain \ElevenLabs\Types\WorkflowUnconditionalModelInput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\WorkflowLlmConditionModelInput value
   * @throws \RuntimeException if this WorkflowEdgeModelInputForwardCondition does not contain a \ElevenLabs\Types\WorkflowLlmConditionModelInput
   */
  public function asLlm(): \ElevenLabs\Types\WorkflowLlmConditionModelInput
  {
    if (!$this->isLlm()) {
      throw new \RuntimeException(
        'WorkflowEdgeModelInputForwardCondition does not contain \ElevenLabs\Types\WorkflowLlmConditionModelInput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\WorkflowResultConditionModelInput value
   * @throws \RuntimeException if this WorkflowEdgeModelInputForwardCondition does not contain a \ElevenLabs\Types\WorkflowResultConditionModelInput
   */
  public function asResult(): \ElevenLabs\Types\WorkflowResultConditionModelInput
  {
    if (!$this->isResult()) {
      throw new \RuntimeException(
        'WorkflowEdgeModelInputForwardCondition does not contain \ElevenLabs\Types\WorkflowResultConditionModelInput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\WorkflowExpressionConditionModelInput value
   * @throws \RuntimeException if this WorkflowEdgeModelInputForwardCondition does not contain a \ElevenLabs\Types\WorkflowExpressionConditionModelInput
   */
  public function asExpression(): \ElevenLabs\Types\WorkflowExpressionConditionModelInput
  {
    if (!$this->isExpression()) {
      throw new \RuntimeException(
        'WorkflowEdgeModelInputForwardCondition does not contain \ElevenLabs\Types\WorkflowExpressionConditionModelInput'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\WorkflowUnconditionalModelInput value
   * @return \ElevenLabs\Types\WorkflowUnconditionalModelInput|null Returns the value if this WorkflowEdgeModelInputForwardCondition contains a \ElevenLabs\Types\WorkflowUnconditionalModelInput, null otherwise
   */
  public function tryAsUnconditional(): ?\ElevenLabs\Types\WorkflowUnconditionalModelInput
  {
    return $this->isUnconditional() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\WorkflowLlmConditionModelInput value
   * @return \ElevenLabs\Types\WorkflowLlmConditionModelInput|null Returns the value if this WorkflowEdgeModelInputForwardCondition contains a \ElevenLabs\Types\WorkflowLlmConditionModelInput, null otherwise
   */
  public function tryAsLlm(): ?\ElevenLabs\Types\WorkflowLlmConditionModelInput
  {
    return $this->isLlm() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\WorkflowResultConditionModelInput value
   * @return \ElevenLabs\Types\WorkflowResultConditionModelInput|null Returns the value if this WorkflowEdgeModelInputForwardCondition contains a \ElevenLabs\Types\WorkflowResultConditionModelInput, null otherwise
   */
  public function tryAsResult(): ?\ElevenLabs\Types\WorkflowResultConditionModelInput
  {
    return $this->isResult() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\WorkflowExpressionConditionModelInput value
   * @return \ElevenLabs\Types\WorkflowExpressionConditionModelInput|null Returns the value if this WorkflowEdgeModelInputForwardCondition contains a \ElevenLabs\Types\WorkflowExpressionConditionModelInput, null otherwise
   */
  public function tryAsExpression(): ?\ElevenLabs\Types\WorkflowExpressionConditionModelInput
  {
    return $this->isExpression() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\WorkflowUnconditionalModelInput): T $onUnconditional
   * @param callable(\ElevenLabs\Types\WorkflowLlmConditionModelInput): T $onLlm
   * @param callable(\ElevenLabs\Types\WorkflowResultConditionModelInput): T $onResult
   * @param callable(\ElevenLabs\Types\WorkflowExpressionConditionModelInput): T $onExpression
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
            \ElevenLabs\Types\WorkflowExpressionConditionModelInput::fromArray($data),
            3
          );
        case 'llm':
          return new self(\ElevenLabs\Types\WorkflowLlmConditionModelInput::fromArray($data), 1);
        case 'result':
          return new self(\ElevenLabs\Types\WorkflowResultConditionModelInput::fromArray($data), 2);
        case 'unconditional':
          return new self(\ElevenLabs\Types\WorkflowUnconditionalModelInput::fromArray($data), 0);
        default:
          // A variant the API added after this SDK was generated: kept, not rejected.
          return new self($data, self::UNKNOWN);
      }
    }

    /** @var list<array{instance: mixed, idx: int, score: int}> */
    $candidates = [];
    try {
      $candidate = \ElevenLabs\Types\WorkflowUnconditionalModelInput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\WorkflowUnconditionalModelInput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\WorkflowLlmConditionModelInput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\WorkflowLlmConditionModelInput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\WorkflowResultConditionModelInput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\WorkflowResultConditionModelInput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\WorkflowExpressionConditionModelInput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 3, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\WorkflowExpressionConditionModelInput didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException(
        'Data does not match any WorkflowEdgeModelInputForwardCondition type'
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
