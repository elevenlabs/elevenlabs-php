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
class AstllmNodeInput extends JsonSerializableType
{
  /**
   * @var \ElevenLabs\Types\AstllmNodeInputValueSchema|\ElevenLabs\Types\AstllmNodeInputPrompt The value, exactly one of the variant types
   */
  public readonly mixed $value;

  /**
   * @var int The type index identifying which variant type is stored
   */
  private int $typeIndex;

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\AstllmNodeInputValueSchema|\ElevenLabs\Types\AstllmNodeInputPrompt $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
  }

  // Factory methods
  /**
   * Create a AstllmNodeInput instance containing a \ElevenLabs\Types\AstllmNodeInputValueSchema
   */
  public static function astllmNodeInputValueSchema(
    \ElevenLabs\Types\AstllmNodeInputValueSchema $astllmNodeInputValueSchema
  ): self {
    return new self($astllmNodeInputValueSchema, 0);
  }

  /**
   * Create a AstllmNodeInput instance containing a \ElevenLabs\Types\AstllmNodeInputPrompt
   */
  public static function astllmNodeInputPrompt(
    \ElevenLabs\Types\AstllmNodeInputPrompt $astllmNodeInputPrompt
  ): self {
    return new self($astllmNodeInputPrompt, 1);
  }

  // Type checking methods
  /**
   * Check if this AstllmNodeInput contains a \ElevenLabs\Types\AstllmNodeInputValueSchema
   */
  public function isAstllmNodeInputValueSchema(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this AstllmNodeInput contains a \ElevenLabs\Types\AstllmNodeInputPrompt
   */
  public function isAstllmNodeInputPrompt(): bool
  {
    return $this->typeIndex === 1;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\AstllmNodeInputValueSchema value
   * @throws \RuntimeException if this AstllmNodeInput does not contain a \ElevenLabs\Types\AstllmNodeInputValueSchema
   */
  public function asAstllmNodeInputValueSchema(): \ElevenLabs\Types\AstllmNodeInputValueSchema
  {
    if (!$this->isAstllmNodeInputValueSchema()) {
      throw new \RuntimeException(
        'AstllmNodeInput does not contain \ElevenLabs\Types\AstllmNodeInputValueSchema'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AstllmNodeInputPrompt value
   * @throws \RuntimeException if this AstllmNodeInput does not contain a \ElevenLabs\Types\AstllmNodeInputPrompt
   */
  public function asAstllmNodeInputPrompt(): \ElevenLabs\Types\AstllmNodeInputPrompt
  {
    if (!$this->isAstllmNodeInputPrompt()) {
      throw new \RuntimeException(
        'AstllmNodeInput does not contain \ElevenLabs\Types\AstllmNodeInputPrompt'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\AstllmNodeInputValueSchema value
   * @return \ElevenLabs\Types\AstllmNodeInputValueSchema|null Returns the value if this AstllmNodeInput contains a \ElevenLabs\Types\AstllmNodeInputValueSchema, null otherwise
   */
  public function tryAsAstllmNodeInputValueSchema(): ?\ElevenLabs\Types\AstllmNodeInputValueSchema
  {
    return $this->isAstllmNodeInputValueSchema() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AstllmNodeInputPrompt value
   * @return \ElevenLabs\Types\AstllmNodeInputPrompt|null Returns the value if this AstllmNodeInput contains a \ElevenLabs\Types\AstllmNodeInputPrompt, null otherwise
   */
  public function tryAsAstllmNodeInputPrompt(): ?\ElevenLabs\Types\AstllmNodeInputPrompt
  {
    return $this->isAstllmNodeInputPrompt() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\AstllmNodeInputValueSchema): T $onAstllmNodeInputValueSchema
   * @param callable(\ElevenLabs\Types\AstllmNodeInputPrompt): T $onAstllmNodeInputPrompt
   * @return T
   */
  public function match(
    callable $onAstllmNodeInputValueSchema,
    callable $onAstllmNodeInputPrompt
  ): mixed {
    return match ($this->typeIndex) {
      0 => $onAstllmNodeInputValueSchema($this->value),
      1 => $onAstllmNodeInputPrompt($this->value),
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
      $candidate = \ElevenLabs\Types\AstllmNodeInputValueSchema::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AstllmNodeInputValueSchema didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AstllmNodeInputPrompt::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AstllmNodeInputPrompt didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException('Data does not match any AstllmNodeInput type');
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
