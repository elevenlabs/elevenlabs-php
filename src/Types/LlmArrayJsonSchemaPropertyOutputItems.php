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
class LlmArrayJsonSchemaPropertyOutputItems extends JsonSerializableType
{
  /**
   * @var \ElevenLabs\Types\LlmLiteralJsonSchemaProperty|\ElevenLabs\Types\LlmObjectJsonSchemaPropertyOutput|\ElevenLabs\Types\LlmArrayJsonSchemaPropertyOutput The value, exactly one of the variant types
   */
  public readonly mixed $value;

  /**
   * @var int The type index identifying which variant type is stored
   */
  private int $typeIndex;

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\LlmLiteralJsonSchemaProperty|\ElevenLabs\Types\LlmObjectJsonSchemaPropertyOutput|\ElevenLabs\Types\LlmArrayJsonSchemaPropertyOutput $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
  }

  // Factory methods
  /**
   * Create a LlmArrayJsonSchemaPropertyOutputItems instance containing a \ElevenLabs\Types\LlmLiteralJsonSchemaProperty
   */
  public static function llmLiteralJsonSchemaProperty(
    \ElevenLabs\Types\LlmLiteralJsonSchemaProperty $llmLiteralJsonSchemaProperty
  ): self {
    return new self($llmLiteralJsonSchemaProperty, 0);
  }

  /**
   * Create a LlmArrayJsonSchemaPropertyOutputItems instance containing a \ElevenLabs\Types\LlmObjectJsonSchemaPropertyOutput
   */
  public static function llmObjectJsonSchemaPropertyOutput(
    \ElevenLabs\Types\LlmObjectJsonSchemaPropertyOutput $llmObjectJsonSchemaPropertyOutput
  ): self {
    return new self($llmObjectJsonSchemaPropertyOutput, 1);
  }

  /**
   * Create a LlmArrayJsonSchemaPropertyOutputItems instance containing a \ElevenLabs\Types\LlmArrayJsonSchemaPropertyOutput
   */
  public static function llmArrayJsonSchemaPropertyOutput(
    \ElevenLabs\Types\LlmArrayJsonSchemaPropertyOutput $llmArrayJsonSchemaPropertyOutput
  ): self {
    return new self($llmArrayJsonSchemaPropertyOutput, 2);
  }

  // Type checking methods
  /**
   * Check if this LlmArrayJsonSchemaPropertyOutputItems contains a \ElevenLabs\Types\LlmLiteralJsonSchemaProperty
   */
  public function isLlmLiteralJsonSchemaProperty(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this LlmArrayJsonSchemaPropertyOutputItems contains a \ElevenLabs\Types\LlmObjectJsonSchemaPropertyOutput
   */
  public function isLlmObjectJsonSchemaPropertyOutput(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this LlmArrayJsonSchemaPropertyOutputItems contains a \ElevenLabs\Types\LlmArrayJsonSchemaPropertyOutput
   */
  public function isLlmArrayJsonSchemaPropertyOutput(): bool
  {
    return $this->typeIndex === 2;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\LlmLiteralJsonSchemaProperty value
   * @throws \RuntimeException if this LlmArrayJsonSchemaPropertyOutputItems does not contain a \ElevenLabs\Types\LlmLiteralJsonSchemaProperty
   */
  public function asLlmLiteralJsonSchemaProperty(): \ElevenLabs\Types\LlmLiteralJsonSchemaProperty
  {
    if (!$this->isLlmLiteralJsonSchemaProperty()) {
      throw new \RuntimeException(
        'LlmArrayJsonSchemaPropertyOutputItems does not contain \ElevenLabs\Types\LlmLiteralJsonSchemaProperty'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\LlmObjectJsonSchemaPropertyOutput value
   * @throws \RuntimeException if this LlmArrayJsonSchemaPropertyOutputItems does not contain a \ElevenLabs\Types\LlmObjectJsonSchemaPropertyOutput
   */
  public function asLlmObjectJsonSchemaPropertyOutput(): \ElevenLabs\Types\LlmObjectJsonSchemaPropertyOutput
  {
    if (!$this->isLlmObjectJsonSchemaPropertyOutput()) {
      throw new \RuntimeException(
        'LlmArrayJsonSchemaPropertyOutputItems does not contain \ElevenLabs\Types\LlmObjectJsonSchemaPropertyOutput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\LlmArrayJsonSchemaPropertyOutput value
   * @throws \RuntimeException if this LlmArrayJsonSchemaPropertyOutputItems does not contain a \ElevenLabs\Types\LlmArrayJsonSchemaPropertyOutput
   */
  public function asLlmArrayJsonSchemaPropertyOutput(): \ElevenLabs\Types\LlmArrayJsonSchemaPropertyOutput
  {
    if (!$this->isLlmArrayJsonSchemaPropertyOutput()) {
      throw new \RuntimeException(
        'LlmArrayJsonSchemaPropertyOutputItems does not contain \ElevenLabs\Types\LlmArrayJsonSchemaPropertyOutput'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\LlmLiteralJsonSchemaProperty value
   * @return \ElevenLabs\Types\LlmLiteralJsonSchemaProperty|null Returns the value if this LlmArrayJsonSchemaPropertyOutputItems contains a \ElevenLabs\Types\LlmLiteralJsonSchemaProperty, null otherwise
   */
  public function tryAsLlmLiteralJsonSchemaProperty(): ?\ElevenLabs\Types\LlmLiteralJsonSchemaProperty
  {
    return $this->isLlmLiteralJsonSchemaProperty() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\LlmObjectJsonSchemaPropertyOutput value
   * @return \ElevenLabs\Types\LlmObjectJsonSchemaPropertyOutput|null Returns the value if this LlmArrayJsonSchemaPropertyOutputItems contains a \ElevenLabs\Types\LlmObjectJsonSchemaPropertyOutput, null otherwise
   */
  public function tryAsLlmObjectJsonSchemaPropertyOutput(): ?\ElevenLabs\Types\LlmObjectJsonSchemaPropertyOutput
  {
    return $this->isLlmObjectJsonSchemaPropertyOutput() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\LlmArrayJsonSchemaPropertyOutput value
   * @return \ElevenLabs\Types\LlmArrayJsonSchemaPropertyOutput|null Returns the value if this LlmArrayJsonSchemaPropertyOutputItems contains a \ElevenLabs\Types\LlmArrayJsonSchemaPropertyOutput, null otherwise
   */
  public function tryAsLlmArrayJsonSchemaPropertyOutput(): ?\ElevenLabs\Types\LlmArrayJsonSchemaPropertyOutput
  {
    return $this->isLlmArrayJsonSchemaPropertyOutput() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\LlmLiteralJsonSchemaProperty): T $onLlmLiteralJsonSchemaProperty
   * @param callable(\ElevenLabs\Types\LlmObjectJsonSchemaPropertyOutput): T $onLlmObjectJsonSchemaPropertyOutput
   * @param callable(\ElevenLabs\Types\LlmArrayJsonSchemaPropertyOutput): T $onLlmArrayJsonSchemaPropertyOutput
   * @return T
   */
  public function match(
    callable $onLlmLiteralJsonSchemaProperty,
    callable $onLlmObjectJsonSchemaPropertyOutput,
    callable $onLlmArrayJsonSchemaPropertyOutput
  ): mixed {
    return match ($this->typeIndex) {
      0 => $onLlmLiteralJsonSchemaProperty($this->value),
      1 => $onLlmObjectJsonSchemaPropertyOutput($this->value),
      2 => $onLlmArrayJsonSchemaPropertyOutput($this->value),
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
      $candidate = \ElevenLabs\Types\LlmObjectJsonSchemaPropertyOutput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\LlmObjectJsonSchemaPropertyOutput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\LlmArrayJsonSchemaPropertyOutput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\LlmArrayJsonSchemaPropertyOutput didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException(
        'Data does not match any LlmArrayJsonSchemaPropertyOutputItems type'
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
