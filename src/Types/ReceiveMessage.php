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
class ReceiveMessage extends JsonSerializableType
{
  /**
   * @var \ElevenLabs\Types\AudioOutput|\ElevenLabs\Types\FinalOutput The value, exactly one of the variant types
   */
  public readonly mixed $value;

  /**
   * @var int The type index identifying which variant type is stored
   */
  private int $typeIndex;

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\AudioOutput|\ElevenLabs\Types\FinalOutput $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
  }

  // Factory methods
  /**
   * Create a ReceiveMessage instance containing a \ElevenLabs\Types\AudioOutput
   */
  public static function audioOutput(\ElevenLabs\Types\AudioOutput $audioOutput): self
  {
    return new self($audioOutput, 0);
  }

  /**
   * Create a ReceiveMessage instance containing a \ElevenLabs\Types\FinalOutput
   */
  public static function finalOutput(\ElevenLabs\Types\FinalOutput $finalOutput): self
  {
    return new self($finalOutput, 1);
  }

  // Type checking methods
  /**
   * Check if this ReceiveMessage contains a \ElevenLabs\Types\AudioOutput
   */
  public function isAudioOutput(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this ReceiveMessage contains a \ElevenLabs\Types\FinalOutput
   */
  public function isFinalOutput(): bool
  {
    return $this->typeIndex === 1;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\AudioOutput value
   * @throws \RuntimeException if this ReceiveMessage does not contain a \ElevenLabs\Types\AudioOutput
   */
  public function asAudioOutput(): \ElevenLabs\Types\AudioOutput
  {
    if (!$this->isAudioOutput()) {
      throw new \RuntimeException('ReceiveMessage does not contain \ElevenLabs\Types\AudioOutput');
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\FinalOutput value
   * @throws \RuntimeException if this ReceiveMessage does not contain a \ElevenLabs\Types\FinalOutput
   */
  public function asFinalOutput(): \ElevenLabs\Types\FinalOutput
  {
    if (!$this->isFinalOutput()) {
      throw new \RuntimeException('ReceiveMessage does not contain \ElevenLabs\Types\FinalOutput');
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\AudioOutput value
   * @return \ElevenLabs\Types\AudioOutput|null Returns the value if this ReceiveMessage contains a \ElevenLabs\Types\AudioOutput, null otherwise
   */
  public function tryAsAudioOutput(): ?\ElevenLabs\Types\AudioOutput
  {
    return $this->isAudioOutput() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\FinalOutput value
   * @return \ElevenLabs\Types\FinalOutput|null Returns the value if this ReceiveMessage contains a \ElevenLabs\Types\FinalOutput, null otherwise
   */
  public function tryAsFinalOutput(): ?\ElevenLabs\Types\FinalOutput
  {
    return $this->isFinalOutput() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\AudioOutput): T $onAudioOutput
   * @param callable(\ElevenLabs\Types\FinalOutput): T $onFinalOutput
   * @return T
   */
  public function match(callable $onAudioOutput, callable $onFinalOutput): mixed
  {
    return match ($this->typeIndex) {
      0 => $onAudioOutput($this->value),
      1 => $onFinalOutput($this->value),
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
      $candidate = \ElevenLabs\Types\AudioOutput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AudioOutput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\FinalOutput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\FinalOutput didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException('Data does not match any ReceiveMessage type');
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
