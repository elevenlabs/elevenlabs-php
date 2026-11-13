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
class ObjectJsonSchemaPropertyOutputPropertiesValue extends JsonSerializableType
{
  /**
   * @var \ElevenLabs\Types\LiteralJsonSchemaProperty|\ElevenLabs\Types\ObjectJsonSchemaPropertyOutput|\ElevenLabs\Types\ArrayJsonSchemaPropertyOutput The value, exactly one of the variant types
   */
  public readonly mixed $value;

  /**
   * @var int The type index identifying which variant type is stored
   */
  private int $typeIndex;

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\LiteralJsonSchemaProperty|\ElevenLabs\Types\ObjectJsonSchemaPropertyOutput|\ElevenLabs\Types\ArrayJsonSchemaPropertyOutput $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
  }

  // Factory methods
  /**
   * Create a ObjectJsonSchemaPropertyOutputPropertiesValue instance containing a \ElevenLabs\Types\LiteralJsonSchemaProperty
   */
  public static function literalJsonSchemaProperty(
    \ElevenLabs\Types\LiteralJsonSchemaProperty $literalJsonSchemaProperty
  ): self {
    return new self($literalJsonSchemaProperty, 0);
  }

  /**
   * Create a ObjectJsonSchemaPropertyOutputPropertiesValue instance containing a \ElevenLabs\Types\ObjectJsonSchemaPropertyOutput
   */
  public static function objectJsonSchemaPropertyOutput(
    \ElevenLabs\Types\ObjectJsonSchemaPropertyOutput $objectJsonSchemaPropertyOutput
  ): self {
    return new self($objectJsonSchemaPropertyOutput, 1);
  }

  /**
   * Create a ObjectJsonSchemaPropertyOutputPropertiesValue instance containing a \ElevenLabs\Types\ArrayJsonSchemaPropertyOutput
   */
  public static function arrayJsonSchemaPropertyOutput(
    \ElevenLabs\Types\ArrayJsonSchemaPropertyOutput $arrayJsonSchemaPropertyOutput
  ): self {
    return new self($arrayJsonSchemaPropertyOutput, 2);
  }

  // Type checking methods
  /**
   * Check if this ObjectJsonSchemaPropertyOutputPropertiesValue contains a \ElevenLabs\Types\LiteralJsonSchemaProperty
   */
  public function isLiteralJsonSchemaProperty(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this ObjectJsonSchemaPropertyOutputPropertiesValue contains a \ElevenLabs\Types\ObjectJsonSchemaPropertyOutput
   */
  public function isObjectJsonSchemaPropertyOutput(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this ObjectJsonSchemaPropertyOutputPropertiesValue contains a \ElevenLabs\Types\ArrayJsonSchemaPropertyOutput
   */
  public function isArrayJsonSchemaPropertyOutput(): bool
  {
    return $this->typeIndex === 2;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\LiteralJsonSchemaProperty value
   * @throws \RuntimeException if this ObjectJsonSchemaPropertyOutputPropertiesValue does not contain a \ElevenLabs\Types\LiteralJsonSchemaProperty
   */
  public function asLiteralJsonSchemaProperty(): \ElevenLabs\Types\LiteralJsonSchemaProperty
  {
    if (!$this->isLiteralJsonSchemaProperty()) {
      throw new \RuntimeException(
        'ObjectJsonSchemaPropertyOutputPropertiesValue does not contain \ElevenLabs\Types\LiteralJsonSchemaProperty'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ObjectJsonSchemaPropertyOutput value
   * @throws \RuntimeException if this ObjectJsonSchemaPropertyOutputPropertiesValue does not contain a \ElevenLabs\Types\ObjectJsonSchemaPropertyOutput
   */
  public function asObjectJsonSchemaPropertyOutput(): \ElevenLabs\Types\ObjectJsonSchemaPropertyOutput
  {
    if (!$this->isObjectJsonSchemaPropertyOutput()) {
      throw new \RuntimeException(
        'ObjectJsonSchemaPropertyOutputPropertiesValue does not contain \ElevenLabs\Types\ObjectJsonSchemaPropertyOutput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ArrayJsonSchemaPropertyOutput value
   * @throws \RuntimeException if this ObjectJsonSchemaPropertyOutputPropertiesValue does not contain a \ElevenLabs\Types\ArrayJsonSchemaPropertyOutput
   */
  public function asArrayJsonSchemaPropertyOutput(): \ElevenLabs\Types\ArrayJsonSchemaPropertyOutput
  {
    if (!$this->isArrayJsonSchemaPropertyOutput()) {
      throw new \RuntimeException(
        'ObjectJsonSchemaPropertyOutputPropertiesValue does not contain \ElevenLabs\Types\ArrayJsonSchemaPropertyOutput'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\LiteralJsonSchemaProperty value
   * @return \ElevenLabs\Types\LiteralJsonSchemaProperty|null Returns the value if this ObjectJsonSchemaPropertyOutputPropertiesValue contains a \ElevenLabs\Types\LiteralJsonSchemaProperty, null otherwise
   */
  public function tryAsLiteralJsonSchemaProperty(): ?\ElevenLabs\Types\LiteralJsonSchemaProperty
  {
    return $this->isLiteralJsonSchemaProperty() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ObjectJsonSchemaPropertyOutput value
   * @return \ElevenLabs\Types\ObjectJsonSchemaPropertyOutput|null Returns the value if this ObjectJsonSchemaPropertyOutputPropertiesValue contains a \ElevenLabs\Types\ObjectJsonSchemaPropertyOutput, null otherwise
   */
  public function tryAsObjectJsonSchemaPropertyOutput(): ?\ElevenLabs\Types\ObjectJsonSchemaPropertyOutput
  {
    return $this->isObjectJsonSchemaPropertyOutput() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ArrayJsonSchemaPropertyOutput value
   * @return \ElevenLabs\Types\ArrayJsonSchemaPropertyOutput|null Returns the value if this ObjectJsonSchemaPropertyOutputPropertiesValue contains a \ElevenLabs\Types\ArrayJsonSchemaPropertyOutput, null otherwise
   */
  public function tryAsArrayJsonSchemaPropertyOutput(): ?\ElevenLabs\Types\ArrayJsonSchemaPropertyOutput
  {
    return $this->isArrayJsonSchemaPropertyOutput() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\LiteralJsonSchemaProperty): T $onLiteralJsonSchemaProperty
   * @param callable(\ElevenLabs\Types\ObjectJsonSchemaPropertyOutput): T $onObjectJsonSchemaPropertyOutput
   * @param callable(\ElevenLabs\Types\ArrayJsonSchemaPropertyOutput): T $onArrayJsonSchemaPropertyOutput
   * @return T
   */
  public function match(
    callable $onLiteralJsonSchemaProperty,
    callable $onObjectJsonSchemaPropertyOutput,
    callable $onArrayJsonSchemaPropertyOutput
  ): mixed {
    return match ($this->typeIndex) {
      0 => $onLiteralJsonSchemaProperty($this->value),
      1 => $onObjectJsonSchemaPropertyOutput($this->value),
      2 => $onArrayJsonSchemaPropertyOutput($this->value),
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
      $candidate = \ElevenLabs\Types\LiteralJsonSchemaProperty::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\LiteralJsonSchemaProperty didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ObjectJsonSchemaPropertyOutput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ObjectJsonSchemaPropertyOutput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ArrayJsonSchemaPropertyOutput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ArrayJsonSchemaPropertyOutput didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException(
        'Data does not match any ObjectJsonSchemaPropertyOutputPropertiesValue type'
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
