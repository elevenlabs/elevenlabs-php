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
class LlmObjectJsonSchemaPropertyInputPropertiesValue extends JsonSerializableType
{
  /**
   * @var \ElevenLabs\Types\LlmLiteralJsonSchemaProperty|\ElevenLabs\Types\LlmObjectJsonSchemaPropertyInput|\ElevenLabs\Types\LlmArrayJsonSchemaPropertyInput|\ElevenLabs\Types\LlmAnyOfJsonSchemaPropertyInput The value, exactly one of the variant types
   */
  public readonly mixed $value;

  /**
   * @var int The type index identifying which variant type is stored
   */
  private int $typeIndex;

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\LlmLiteralJsonSchemaProperty|\ElevenLabs\Types\LlmObjectJsonSchemaPropertyInput|\ElevenLabs\Types\LlmArrayJsonSchemaPropertyInput|\ElevenLabs\Types\LlmAnyOfJsonSchemaPropertyInput $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
  }

  // Factory methods
  /**
   * Create a LlmObjectJsonSchemaPropertyInputPropertiesValue instance containing a \ElevenLabs\Types\LlmLiteralJsonSchemaProperty
   */
  public static function llmLiteralJsonSchemaProperty(
    \ElevenLabs\Types\LlmLiteralJsonSchemaProperty $llmLiteralJsonSchemaProperty
  ): self {
    return new self($llmLiteralJsonSchemaProperty, 0);
  }

  /**
   * Create a LlmObjectJsonSchemaPropertyInputPropertiesValue instance containing a \ElevenLabs\Types\LlmObjectJsonSchemaPropertyInput
   */
  public static function llmObjectJsonSchemaPropertyInput(
    \ElevenLabs\Types\LlmObjectJsonSchemaPropertyInput $llmObjectJsonSchemaPropertyInput
  ): self {
    return new self($llmObjectJsonSchemaPropertyInput, 1);
  }

  /**
   * Create a LlmObjectJsonSchemaPropertyInputPropertiesValue instance containing a \ElevenLabs\Types\LlmArrayJsonSchemaPropertyInput
   */
  public static function llmArrayJsonSchemaPropertyInput(
    \ElevenLabs\Types\LlmArrayJsonSchemaPropertyInput $llmArrayJsonSchemaPropertyInput
  ): self {
    return new self($llmArrayJsonSchemaPropertyInput, 2);
  }

  /**
   * Create a LlmObjectJsonSchemaPropertyInputPropertiesValue instance containing a \ElevenLabs\Types\LlmAnyOfJsonSchemaPropertyInput
   */
  public static function llmAnyOfJsonSchemaPropertyInput(
    \ElevenLabs\Types\LlmAnyOfJsonSchemaPropertyInput $llmAnyOfJsonSchemaPropertyInput
  ): self {
    return new self($llmAnyOfJsonSchemaPropertyInput, 3);
  }

  // Type checking methods
  /**
   * Check if this LlmObjectJsonSchemaPropertyInputPropertiesValue contains a \ElevenLabs\Types\LlmLiteralJsonSchemaProperty
   */
  public function isLlmLiteralJsonSchemaProperty(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this LlmObjectJsonSchemaPropertyInputPropertiesValue contains a \ElevenLabs\Types\LlmObjectJsonSchemaPropertyInput
   */
  public function isLlmObjectJsonSchemaPropertyInput(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this LlmObjectJsonSchemaPropertyInputPropertiesValue contains a \ElevenLabs\Types\LlmArrayJsonSchemaPropertyInput
   */
  public function isLlmArrayJsonSchemaPropertyInput(): bool
  {
    return $this->typeIndex === 2;
  }

  /**
   * Check if this LlmObjectJsonSchemaPropertyInputPropertiesValue contains a \ElevenLabs\Types\LlmAnyOfJsonSchemaPropertyInput
   */
  public function isLlmAnyOfJsonSchemaPropertyInput(): bool
  {
    return $this->typeIndex === 3;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\LlmLiteralJsonSchemaProperty value
   * @throws \RuntimeException if this LlmObjectJsonSchemaPropertyInputPropertiesValue does not contain a \ElevenLabs\Types\LlmLiteralJsonSchemaProperty
   */
  public function asLlmLiteralJsonSchemaProperty(): \ElevenLabs\Types\LlmLiteralJsonSchemaProperty
  {
    if (!$this->isLlmLiteralJsonSchemaProperty()) {
      throw new \RuntimeException(
        'LlmObjectJsonSchemaPropertyInputPropertiesValue does not contain \ElevenLabs\Types\LlmLiteralJsonSchemaProperty'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\LlmObjectJsonSchemaPropertyInput value
   * @throws \RuntimeException if this LlmObjectJsonSchemaPropertyInputPropertiesValue does not contain a \ElevenLabs\Types\LlmObjectJsonSchemaPropertyInput
   */
  public function asLlmObjectJsonSchemaPropertyInput(): \ElevenLabs\Types\LlmObjectJsonSchemaPropertyInput
  {
    if (!$this->isLlmObjectJsonSchemaPropertyInput()) {
      throw new \RuntimeException(
        'LlmObjectJsonSchemaPropertyInputPropertiesValue does not contain \ElevenLabs\Types\LlmObjectJsonSchemaPropertyInput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\LlmArrayJsonSchemaPropertyInput value
   * @throws \RuntimeException if this LlmObjectJsonSchemaPropertyInputPropertiesValue does not contain a \ElevenLabs\Types\LlmArrayJsonSchemaPropertyInput
   */
  public function asLlmArrayJsonSchemaPropertyInput(): \ElevenLabs\Types\LlmArrayJsonSchemaPropertyInput
  {
    if (!$this->isLlmArrayJsonSchemaPropertyInput()) {
      throw new \RuntimeException(
        'LlmObjectJsonSchemaPropertyInputPropertiesValue does not contain \ElevenLabs\Types\LlmArrayJsonSchemaPropertyInput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\LlmAnyOfJsonSchemaPropertyInput value
   * @throws \RuntimeException if this LlmObjectJsonSchemaPropertyInputPropertiesValue does not contain a \ElevenLabs\Types\LlmAnyOfJsonSchemaPropertyInput
   */
  public function asLlmAnyOfJsonSchemaPropertyInput(): \ElevenLabs\Types\LlmAnyOfJsonSchemaPropertyInput
  {
    if (!$this->isLlmAnyOfJsonSchemaPropertyInput()) {
      throw new \RuntimeException(
        'LlmObjectJsonSchemaPropertyInputPropertiesValue does not contain \ElevenLabs\Types\LlmAnyOfJsonSchemaPropertyInput'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\LlmLiteralJsonSchemaProperty value
   * @return \ElevenLabs\Types\LlmLiteralJsonSchemaProperty|null Returns the value if this LlmObjectJsonSchemaPropertyInputPropertiesValue contains a \ElevenLabs\Types\LlmLiteralJsonSchemaProperty, null otherwise
   */
  public function tryAsLlmLiteralJsonSchemaProperty(): ?\ElevenLabs\Types\LlmLiteralJsonSchemaProperty
  {
    return $this->isLlmLiteralJsonSchemaProperty() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\LlmObjectJsonSchemaPropertyInput value
   * @return \ElevenLabs\Types\LlmObjectJsonSchemaPropertyInput|null Returns the value if this LlmObjectJsonSchemaPropertyInputPropertiesValue contains a \ElevenLabs\Types\LlmObjectJsonSchemaPropertyInput, null otherwise
   */
  public function tryAsLlmObjectJsonSchemaPropertyInput(): ?\ElevenLabs\Types\LlmObjectJsonSchemaPropertyInput
  {
    return $this->isLlmObjectJsonSchemaPropertyInput() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\LlmArrayJsonSchemaPropertyInput value
   * @return \ElevenLabs\Types\LlmArrayJsonSchemaPropertyInput|null Returns the value if this LlmObjectJsonSchemaPropertyInputPropertiesValue contains a \ElevenLabs\Types\LlmArrayJsonSchemaPropertyInput, null otherwise
   */
  public function tryAsLlmArrayJsonSchemaPropertyInput(): ?\ElevenLabs\Types\LlmArrayJsonSchemaPropertyInput
  {
    return $this->isLlmArrayJsonSchemaPropertyInput() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\LlmAnyOfJsonSchemaPropertyInput value
   * @return \ElevenLabs\Types\LlmAnyOfJsonSchemaPropertyInput|null Returns the value if this LlmObjectJsonSchemaPropertyInputPropertiesValue contains a \ElevenLabs\Types\LlmAnyOfJsonSchemaPropertyInput, null otherwise
   */
  public function tryAsLlmAnyOfJsonSchemaPropertyInput(): ?\ElevenLabs\Types\LlmAnyOfJsonSchemaPropertyInput
  {
    return $this->isLlmAnyOfJsonSchemaPropertyInput() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\LlmLiteralJsonSchemaProperty): T $onLlmLiteralJsonSchemaProperty
   * @param callable(\ElevenLabs\Types\LlmObjectJsonSchemaPropertyInput): T $onLlmObjectJsonSchemaPropertyInput
   * @param callable(\ElevenLabs\Types\LlmArrayJsonSchemaPropertyInput): T $onLlmArrayJsonSchemaPropertyInput
   * @param callable(\ElevenLabs\Types\LlmAnyOfJsonSchemaPropertyInput): T $onLlmAnyOfJsonSchemaPropertyInput
   * @return T
   */
  public function match(
    callable $onLlmLiteralJsonSchemaProperty,
    callable $onLlmObjectJsonSchemaPropertyInput,
    callable $onLlmArrayJsonSchemaPropertyInput,
    callable $onLlmAnyOfJsonSchemaPropertyInput
  ): mixed {
    return match ($this->typeIndex) {
      0 => $onLlmLiteralJsonSchemaProperty($this->value),
      1 => $onLlmObjectJsonSchemaPropertyInput($this->value),
      2 => $onLlmArrayJsonSchemaPropertyInput($this->value),
      3 => $onLlmAnyOfJsonSchemaPropertyInput($this->value),
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
    /** @var list<array{instance: mixed, idx: int, score: int}> */
    $candidates = [];
    try {
      $candidate = \ElevenLabs\Types\LlmLiteralJsonSchemaProperty::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\LlmLiteralJsonSchemaProperty didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\LlmObjectJsonSchemaPropertyInput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\LlmObjectJsonSchemaPropertyInput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\LlmArrayJsonSchemaPropertyInput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\LlmArrayJsonSchemaPropertyInput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\LlmAnyOfJsonSchemaPropertyInput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 3, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\LlmAnyOfJsonSchemaPropertyInput didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException(
        'Data does not match any LlmObjectJsonSchemaPropertyInputPropertiesValue type'
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
    return $this->value->jsonSerialize();
  }
}
