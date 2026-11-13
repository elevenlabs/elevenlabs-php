<?php

declare(strict_types=1);

namespace ElevenLabs\Music\Types;

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
class BodyStreamComposedMusicWithADetailedResponseV1MusicDetailedStreamPostCompositionPlan extends
  JsonSerializableType
{
  /**
   * @var \ElevenLabs\Types\MusicPrompt|\ElevenLabs\Types\CompositionPlan The value, exactly one of the variant types
   */
  public readonly mixed $value;

  /**
   * @var int The type index identifying which variant type is stored
   */
  private int $typeIndex;

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\MusicPrompt|\ElevenLabs\Types\CompositionPlan $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
  }

  // Factory methods
  /**
   * Create a BodyStreamComposedMusicWithADetailedResponseV1MusicDetailedStreamPostCompositionPlan instance containing a \ElevenLabs\Types\MusicPrompt
   */
  public static function musicPrompt(\ElevenLabs\Types\MusicPrompt $musicPrompt): self
  {
    return new self($musicPrompt, 0);
  }

  /**
   * Create a BodyStreamComposedMusicWithADetailedResponseV1MusicDetailedStreamPostCompositionPlan instance containing a \ElevenLabs\Types\CompositionPlan
   */
  public static function compositionPlan(\ElevenLabs\Types\CompositionPlan $compositionPlan): self
  {
    return new self($compositionPlan, 1);
  }

  // Type checking methods
  /**
   * Check if this BodyStreamComposedMusicWithADetailedResponseV1MusicDetailedStreamPostCompositionPlan contains a \ElevenLabs\Types\MusicPrompt
   */
  public function isMusicPrompt(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this BodyStreamComposedMusicWithADetailedResponseV1MusicDetailedStreamPostCompositionPlan contains a \ElevenLabs\Types\CompositionPlan
   */
  public function isCompositionPlan(): bool
  {
    return $this->typeIndex === 1;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\MusicPrompt value
   * @throws \RuntimeException if this BodyStreamComposedMusicWithADetailedResponseV1MusicDetailedStreamPostCompositionPlan does not contain a \ElevenLabs\Types\MusicPrompt
   */
  public function asMusicPrompt(): \ElevenLabs\Types\MusicPrompt
  {
    if (!$this->isMusicPrompt()) {
      throw new \RuntimeException(
        'BodyStreamComposedMusicWithADetailedResponseV1MusicDetailedStreamPostCompositionPlan does not contain \ElevenLabs\Types\MusicPrompt'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\CompositionPlan value
   * @throws \RuntimeException if this BodyStreamComposedMusicWithADetailedResponseV1MusicDetailedStreamPostCompositionPlan does not contain a \ElevenLabs\Types\CompositionPlan
   */
  public function asCompositionPlan(): \ElevenLabs\Types\CompositionPlan
  {
    if (!$this->isCompositionPlan()) {
      throw new \RuntimeException(
        'BodyStreamComposedMusicWithADetailedResponseV1MusicDetailedStreamPostCompositionPlan does not contain \ElevenLabs\Types\CompositionPlan'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\MusicPrompt value
   * @return \ElevenLabs\Types\MusicPrompt|null Returns the value if this BodyStreamComposedMusicWithADetailedResponseV1MusicDetailedStreamPostCompositionPlan contains a \ElevenLabs\Types\MusicPrompt, null otherwise
   */
  public function tryAsMusicPrompt(): ?\ElevenLabs\Types\MusicPrompt
  {
    return $this->isMusicPrompt() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\CompositionPlan value
   * @return \ElevenLabs\Types\CompositionPlan|null Returns the value if this BodyStreamComposedMusicWithADetailedResponseV1MusicDetailedStreamPostCompositionPlan contains a \ElevenLabs\Types\CompositionPlan, null otherwise
   */
  public function tryAsCompositionPlan(): ?\ElevenLabs\Types\CompositionPlan
  {
    return $this->isCompositionPlan() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\MusicPrompt): T $onMusicPrompt
   * @param callable(\ElevenLabs\Types\CompositionPlan): T $onCompositionPlan
   * @return T
   */
  public function match(callable $onMusicPrompt, callable $onCompositionPlan): mixed
  {
    return match ($this->typeIndex) {
      0 => $onMusicPrompt($this->value),
      1 => $onCompositionPlan($this->value),
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
      $candidate = \ElevenLabs\Types\MusicPrompt::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\MusicPrompt didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\CompositionPlan::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\CompositionPlan didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException(
        'Data does not match any BodyStreamComposedMusicWithADetailedResponseV1MusicDetailedStreamPostCompositionPlan type'
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
