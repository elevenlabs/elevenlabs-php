<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\McpServers\ToolConfigs\Types;

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
class McpToolConfigOverrideUpdateRequestModelInputOverridesValue extends JsonSerializableType
{
  /**
   * @var string The discriminator value identifying which variant is stored
   */
  public readonly string $source;

  /**
   * @var \ElevenLabs\Types\ConstantSchemaOverride|\ElevenLabs\Types\DynamicVariableSchemaOverride|\ElevenLabs\Types\LlmSchemaOverride|\ElevenLabs\Types\OmitSchemaOverride|array<string, mixed> The value, exactly one of the variant types
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
   * @throws \RuntimeException if this McpToolConfigOverrideUpdateRequestModelInputOverridesValue holds a known variant
   */
  public function _asUnknown(): array
  {
    if (!$this->_isUnknown()) {
      throw new \RuntimeException(
        'McpToolConfigOverrideUpdateRequestModelInputOverridesValue does not contain an unknown variant'
      );
    }
    /** @var array<string, mixed> $value */
    $value = $this->value;
    return $value;
  }

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\ConstantSchemaOverride|\ElevenLabs\Types\DynamicVariableSchemaOverride|\ElevenLabs\Types\LlmSchemaOverride|\ElevenLabs\Types\OmitSchemaOverride|array<string, mixed> $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
    $this->source = match ($typeIndex) {
      0 => 'constant',
      1 => 'dynamic_variable',
      2 => 'llm',
      3 => 'omit',
      self::UNKNOWN => '_unknown',
      default => throw new \UnexpectedValueException("Unknown type index: $typeIndex")
    };
  }

  // Factory methods
  /**
   * Create a McpToolConfigOverrideUpdateRequestModelInputOverridesValue instance containing a \ElevenLabs\Types\ConstantSchemaOverride
   */
  public static function constant(\ElevenLabs\Types\ConstantSchemaOverride $constant): self
  {
    return new self($constant, 0);
  }

  /**
   * Create a McpToolConfigOverrideUpdateRequestModelInputOverridesValue instance containing a \ElevenLabs\Types\DynamicVariableSchemaOverride
   */
  public static function dynamicVariable(
    \ElevenLabs\Types\DynamicVariableSchemaOverride $dynamicVariable
  ): self {
    return new self($dynamicVariable, 1);
  }

  /**
   * Create a McpToolConfigOverrideUpdateRequestModelInputOverridesValue instance containing a \ElevenLabs\Types\LlmSchemaOverride
   */
  public static function llm(\ElevenLabs\Types\LlmSchemaOverride $llm): self
  {
    return new self($llm, 2);
  }

  /**
   * Create a McpToolConfigOverrideUpdateRequestModelInputOverridesValue instance containing a \ElevenLabs\Types\OmitSchemaOverride
   */
  public static function omit(\ElevenLabs\Types\OmitSchemaOverride $omit): self
  {
    return new self($omit, 3);
  }

  // Type checking methods
  /**
   * Check if this McpToolConfigOverrideUpdateRequestModelInputOverridesValue contains a \ElevenLabs\Types\ConstantSchemaOverride
   */
  public function isConstant(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this McpToolConfigOverrideUpdateRequestModelInputOverridesValue contains a \ElevenLabs\Types\DynamicVariableSchemaOverride
   */
  public function isDynamicVariable(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this McpToolConfigOverrideUpdateRequestModelInputOverridesValue contains a \ElevenLabs\Types\LlmSchemaOverride
   */
  public function isLlm(): bool
  {
    return $this->typeIndex === 2;
  }

  /**
   * Check if this McpToolConfigOverrideUpdateRequestModelInputOverridesValue contains a \ElevenLabs\Types\OmitSchemaOverride
   */
  public function isOmit(): bool
  {
    return $this->typeIndex === 3;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\ConstantSchemaOverride value
   * @throws \RuntimeException if this McpToolConfigOverrideUpdateRequestModelInputOverridesValue does not contain a \ElevenLabs\Types\ConstantSchemaOverride
   */
  public function asConstant(): \ElevenLabs\Types\ConstantSchemaOverride
  {
    if (!$this->isConstant()) {
      throw new \RuntimeException(
        'McpToolConfigOverrideUpdateRequestModelInputOverridesValue does not contain \ElevenLabs\Types\ConstantSchemaOverride'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\DynamicVariableSchemaOverride value
   * @throws \RuntimeException if this McpToolConfigOverrideUpdateRequestModelInputOverridesValue does not contain a \ElevenLabs\Types\DynamicVariableSchemaOverride
   */
  public function asDynamicVariable(): \ElevenLabs\Types\DynamicVariableSchemaOverride
  {
    if (!$this->isDynamicVariable()) {
      throw new \RuntimeException(
        'McpToolConfigOverrideUpdateRequestModelInputOverridesValue does not contain \ElevenLabs\Types\DynamicVariableSchemaOverride'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\LlmSchemaOverride value
   * @throws \RuntimeException if this McpToolConfigOverrideUpdateRequestModelInputOverridesValue does not contain a \ElevenLabs\Types\LlmSchemaOverride
   */
  public function asLlm(): \ElevenLabs\Types\LlmSchemaOverride
  {
    if (!$this->isLlm()) {
      throw new \RuntimeException(
        'McpToolConfigOverrideUpdateRequestModelInputOverridesValue does not contain \ElevenLabs\Types\LlmSchemaOverride'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\OmitSchemaOverride value
   * @throws \RuntimeException if this McpToolConfigOverrideUpdateRequestModelInputOverridesValue does not contain a \ElevenLabs\Types\OmitSchemaOverride
   */
  public function asOmit(): \ElevenLabs\Types\OmitSchemaOverride
  {
    if (!$this->isOmit()) {
      throw new \RuntimeException(
        'McpToolConfigOverrideUpdateRequestModelInputOverridesValue does not contain \ElevenLabs\Types\OmitSchemaOverride'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\ConstantSchemaOverride value
   * @return \ElevenLabs\Types\ConstantSchemaOverride|null Returns the value if this McpToolConfigOverrideUpdateRequestModelInputOverridesValue contains a \ElevenLabs\Types\ConstantSchemaOverride, null otherwise
   */
  public function tryAsConstant(): ?\ElevenLabs\Types\ConstantSchemaOverride
  {
    return $this->isConstant() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\DynamicVariableSchemaOverride value
   * @return \ElevenLabs\Types\DynamicVariableSchemaOverride|null Returns the value if this McpToolConfigOverrideUpdateRequestModelInputOverridesValue contains a \ElevenLabs\Types\DynamicVariableSchemaOverride, null otherwise
   */
  public function tryAsDynamicVariable(): ?\ElevenLabs\Types\DynamicVariableSchemaOverride
  {
    return $this->isDynamicVariable() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\LlmSchemaOverride value
   * @return \ElevenLabs\Types\LlmSchemaOverride|null Returns the value if this McpToolConfigOverrideUpdateRequestModelInputOverridesValue contains a \ElevenLabs\Types\LlmSchemaOverride, null otherwise
   */
  public function tryAsLlm(): ?\ElevenLabs\Types\LlmSchemaOverride
  {
    return $this->isLlm() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\OmitSchemaOverride value
   * @return \ElevenLabs\Types\OmitSchemaOverride|null Returns the value if this McpToolConfigOverrideUpdateRequestModelInputOverridesValue contains a \ElevenLabs\Types\OmitSchemaOverride, null otherwise
   */
  public function tryAsOmit(): ?\ElevenLabs\Types\OmitSchemaOverride
  {
    return $this->isOmit() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\ConstantSchemaOverride): T $onConstant
   * @param callable(\ElevenLabs\Types\DynamicVariableSchemaOverride): T $onDynamicVariable
   * @param callable(\ElevenLabs\Types\LlmSchemaOverride): T $onLlm
   * @param callable(\ElevenLabs\Types\OmitSchemaOverride): T $onOmit
   * @return T
   */
  public function match(
    callable $onConstant,
    callable $onDynamicVariable,
    callable $onLlm,
    callable $onOmit
  ): mixed {
    return match ($this->typeIndex) {
      0 => $onConstant($this->value),
      1 => $onDynamicVariable($this->value),
      2 => $onLlm($this->value),
      3 => $onOmit($this->value),
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
    if (is_array($data) && isset($data['source']) && is_string($data['source'])) {
      switch ($data['source']) {
        case 'constant':
          return new self(\ElevenLabs\Types\ConstantSchemaOverride::fromArray($data), 0);
        case 'dynamic_variable':
          return new self(\ElevenLabs\Types\DynamicVariableSchemaOverride::fromArray($data), 1);
        case 'llm':
          return new self(\ElevenLabs\Types\LlmSchemaOverride::fromArray($data), 2);
        case 'omit':
          return new self(\ElevenLabs\Types\OmitSchemaOverride::fromArray($data), 3);
        default:
          // A variant the API added after this SDK was generated: kept, not rejected.
          return new self($data, self::UNKNOWN);
      }
    }

    /** @var list<array{instance: mixed, idx: int, score: int}> */
    $candidates = [];
    try {
      $candidate = \ElevenLabs\Types\ConstantSchemaOverride::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ConstantSchemaOverride didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\DynamicVariableSchemaOverride::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\DynamicVariableSchemaOverride didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\LlmSchemaOverride::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\LlmSchemaOverride didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\OmitSchemaOverride::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 3, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\OmitSchemaOverride didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException(
        'Data does not match any McpToolConfigOverrideUpdateRequestModelInputOverridesValue type'
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
