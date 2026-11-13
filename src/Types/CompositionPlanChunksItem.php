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
class CompositionPlanChunksItem extends JsonSerializableType
{
  /**
   * @var \ElevenLabs\Types\GenerationChunkInput|\ElevenLabs\Types\AudioRefChunk The value, exactly one of the variant types
   */
  public readonly mixed $value;

  /**
   * @var int The type index identifying which variant type is stored
   */
  private int $typeIndex;

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\GenerationChunkInput|\ElevenLabs\Types\AudioRefChunk $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
  }

  // Factory methods
  /**
   * Create a CompositionPlanChunksItem instance containing a \ElevenLabs\Types\GenerationChunkInput
   */
  public static function generationChunkInput(
    \ElevenLabs\Types\GenerationChunkInput $generationChunkInput
  ): self {
    return new self($generationChunkInput, 0);
  }

  /**
   * Create a CompositionPlanChunksItem instance containing a \ElevenLabs\Types\AudioRefChunk
   */
  public static function audioRefChunk(\ElevenLabs\Types\AudioRefChunk $audioRefChunk): self
  {
    return new self($audioRefChunk, 1);
  }

  // Type checking methods
  /**
   * Check if this CompositionPlanChunksItem contains a \ElevenLabs\Types\GenerationChunkInput
   */
  public function isGenerationChunkInput(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this CompositionPlanChunksItem contains a \ElevenLabs\Types\AudioRefChunk
   */
  public function isAudioRefChunk(): bool
  {
    return $this->typeIndex === 1;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\GenerationChunkInput value
   * @throws \RuntimeException if this CompositionPlanChunksItem does not contain a \ElevenLabs\Types\GenerationChunkInput
   */
  public function asGenerationChunkInput(): \ElevenLabs\Types\GenerationChunkInput
  {
    if (!$this->isGenerationChunkInput()) {
      throw new \RuntimeException(
        'CompositionPlanChunksItem does not contain \ElevenLabs\Types\GenerationChunkInput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AudioRefChunk value
   * @throws \RuntimeException if this CompositionPlanChunksItem does not contain a \ElevenLabs\Types\AudioRefChunk
   */
  public function asAudioRefChunk(): \ElevenLabs\Types\AudioRefChunk
  {
    if (!$this->isAudioRefChunk()) {
      throw new \RuntimeException(
        'CompositionPlanChunksItem does not contain \ElevenLabs\Types\AudioRefChunk'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\GenerationChunkInput value
   * @return \ElevenLabs\Types\GenerationChunkInput|null Returns the value if this CompositionPlanChunksItem contains a \ElevenLabs\Types\GenerationChunkInput, null otherwise
   */
  public function tryAsGenerationChunkInput(): ?\ElevenLabs\Types\GenerationChunkInput
  {
    return $this->isGenerationChunkInput() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AudioRefChunk value
   * @return \ElevenLabs\Types\AudioRefChunk|null Returns the value if this CompositionPlanChunksItem contains a \ElevenLabs\Types\AudioRefChunk, null otherwise
   */
  public function tryAsAudioRefChunk(): ?\ElevenLabs\Types\AudioRefChunk
  {
    return $this->isAudioRefChunk() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\GenerationChunkInput): T $onGenerationChunkInput
   * @param callable(\ElevenLabs\Types\AudioRefChunk): T $onAudioRefChunk
   * @return T
   */
  public function match(callable $onGenerationChunkInput, callable $onAudioRefChunk): mixed
  {
    return match ($this->typeIndex) {
      0 => $onGenerationChunkInput($this->value),
      1 => $onAudioRefChunk($this->value),
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
      $candidate = \ElevenLabs\Types\GenerationChunkInput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\GenerationChunkInput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AudioRefChunk::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AudioRefChunk didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException('Data does not match any CompositionPlanChunksItem type');
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
