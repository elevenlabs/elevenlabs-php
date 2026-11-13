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
class ReceiveMessageMulti extends JsonSerializableType
{
  /**
   * @var \ElevenLabs\Types\AudioOutputMulti|\ElevenLabs\Types\FinalOutputMulti The value, exactly one of the variant types
   */
  public readonly mixed $value;

  /**
   * @var int The type index identifying which variant type is stored
   */
  private int $typeIndex;

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\AudioOutputMulti|\ElevenLabs\Types\FinalOutputMulti $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
  }

  // Factory methods
  /**
   * Create a ReceiveMessageMulti instance containing a \ElevenLabs\Types\AudioOutputMulti
   */
  public static function audioOutputMulti(
    \ElevenLabs\Types\AudioOutputMulti $audioOutputMulti
  ): self {
    return new self($audioOutputMulti, 0);
  }

  /**
   * Create a ReceiveMessageMulti instance containing a \ElevenLabs\Types\FinalOutputMulti
   */
  public static function finalOutputMulti(
    \ElevenLabs\Types\FinalOutputMulti $finalOutputMulti
  ): self {
    return new self($finalOutputMulti, 1);
  }

  // Type checking methods
  /**
   * Check if this ReceiveMessageMulti contains a \ElevenLabs\Types\AudioOutputMulti
   */
  public function isAudioOutputMulti(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this ReceiveMessageMulti contains a \ElevenLabs\Types\FinalOutputMulti
   */
  public function isFinalOutputMulti(): bool
  {
    return $this->typeIndex === 1;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\AudioOutputMulti value
   * @throws \RuntimeException if this ReceiveMessageMulti does not contain a \ElevenLabs\Types\AudioOutputMulti
   */
  public function asAudioOutputMulti(): \ElevenLabs\Types\AudioOutputMulti
  {
    if (!$this->isAudioOutputMulti()) {
      throw new \RuntimeException(
        'ReceiveMessageMulti does not contain \ElevenLabs\Types\AudioOutputMulti'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\FinalOutputMulti value
   * @throws \RuntimeException if this ReceiveMessageMulti does not contain a \ElevenLabs\Types\FinalOutputMulti
   */
  public function asFinalOutputMulti(): \ElevenLabs\Types\FinalOutputMulti
  {
    if (!$this->isFinalOutputMulti()) {
      throw new \RuntimeException(
        'ReceiveMessageMulti does not contain \ElevenLabs\Types\FinalOutputMulti'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\AudioOutputMulti value
   * @return \ElevenLabs\Types\AudioOutputMulti|null Returns the value if this ReceiveMessageMulti contains a \ElevenLabs\Types\AudioOutputMulti, null otherwise
   */
  public function tryAsAudioOutputMulti(): ?\ElevenLabs\Types\AudioOutputMulti
  {
    return $this->isAudioOutputMulti() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\FinalOutputMulti value
   * @return \ElevenLabs\Types\FinalOutputMulti|null Returns the value if this ReceiveMessageMulti contains a \ElevenLabs\Types\FinalOutputMulti, null otherwise
   */
  public function tryAsFinalOutputMulti(): ?\ElevenLabs\Types\FinalOutputMulti
  {
    return $this->isFinalOutputMulti() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\AudioOutputMulti): T $onAudioOutputMulti
   * @param callable(\ElevenLabs\Types\FinalOutputMulti): T $onFinalOutputMulti
   * @return T
   */
  public function match(callable $onAudioOutputMulti, callable $onFinalOutputMulti): mixed
  {
    return match ($this->typeIndex) {
      0 => $onAudioOutputMulti($this->value),
      1 => $onFinalOutputMulti($this->value),
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
      $candidate = \ElevenLabs\Types\AudioOutputMulti::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AudioOutputMulti didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\FinalOutputMulti::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\FinalOutputMulti didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException('Data does not match any ReceiveMessageMulti type');
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
