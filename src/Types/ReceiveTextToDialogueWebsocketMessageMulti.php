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
class ReceiveTextToDialogueWebsocketMessageMulti extends JsonSerializableType
{
  /**
   * @var \ElevenLabs\Types\AudioChunkMulti|\ElevenLabs\Types\FinalAudioForTurnMulti|\ElevenLabs\Types\FinalMulti|\ElevenLabs\Types\Error The value, exactly one of the variant types
   */
  public readonly mixed $value;

  /**
   * @var int The type index identifying which variant type is stored
   */
  private int $typeIndex;

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\AudioChunkMulti|\ElevenLabs\Types\FinalAudioForTurnMulti|\ElevenLabs\Types\FinalMulti|\ElevenLabs\Types\Error $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
  }

  // Factory methods
  /**
   * Create a ReceiveTextToDialogueWebsocketMessageMulti instance containing a \ElevenLabs\Types\AudioChunkMulti
   */
  public static function audioChunkMulti(\ElevenLabs\Types\AudioChunkMulti $audioChunkMulti): self
  {
    return new self($audioChunkMulti, 0);
  }

  /**
   * Create a ReceiveTextToDialogueWebsocketMessageMulti instance containing a \ElevenLabs\Types\FinalAudioForTurnMulti
   */
  public static function finalAudioForTurnMulti(
    \ElevenLabs\Types\FinalAudioForTurnMulti $finalAudioForTurnMulti
  ): self {
    return new self($finalAudioForTurnMulti, 1);
  }

  /**
   * Create a ReceiveTextToDialogueWebsocketMessageMulti instance containing a \ElevenLabs\Types\FinalMulti
   */
  public static function finalMulti(\ElevenLabs\Types\FinalMulti $finalMulti): self
  {
    return new self($finalMulti, 2);
  }

  /**
   * Create a ReceiveTextToDialogueWebsocketMessageMulti instance containing a \ElevenLabs\Types\Error
   */
  public static function error(\ElevenLabs\Types\Error $error): self
  {
    return new self($error, 3);
  }

  // Type checking methods
  /**
   * Check if this ReceiveTextToDialogueWebsocketMessageMulti contains a \ElevenLabs\Types\AudioChunkMulti
   */
  public function isAudioChunkMulti(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this ReceiveTextToDialogueWebsocketMessageMulti contains a \ElevenLabs\Types\FinalAudioForTurnMulti
   */
  public function isFinalAudioForTurnMulti(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this ReceiveTextToDialogueWebsocketMessageMulti contains a \ElevenLabs\Types\FinalMulti
   */
  public function isFinalMulti(): bool
  {
    return $this->typeIndex === 2;
  }

  /**
   * Check if this ReceiveTextToDialogueWebsocketMessageMulti contains a \ElevenLabs\Types\Error
   */
  public function isError(): bool
  {
    return $this->typeIndex === 3;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\AudioChunkMulti value
   * @throws \RuntimeException if this ReceiveTextToDialogueWebsocketMessageMulti does not contain a \ElevenLabs\Types\AudioChunkMulti
   */
  public function asAudioChunkMulti(): \ElevenLabs\Types\AudioChunkMulti
  {
    if (!$this->isAudioChunkMulti()) {
      throw new \RuntimeException(
        'ReceiveTextToDialogueWebsocketMessageMulti does not contain \ElevenLabs\Types\AudioChunkMulti'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\FinalAudioForTurnMulti value
   * @throws \RuntimeException if this ReceiveTextToDialogueWebsocketMessageMulti does not contain a \ElevenLabs\Types\FinalAudioForTurnMulti
   */
  public function asFinalAudioForTurnMulti(): \ElevenLabs\Types\FinalAudioForTurnMulti
  {
    if (!$this->isFinalAudioForTurnMulti()) {
      throw new \RuntimeException(
        'ReceiveTextToDialogueWebsocketMessageMulti does not contain \ElevenLabs\Types\FinalAudioForTurnMulti'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\FinalMulti value
   * @throws \RuntimeException if this ReceiveTextToDialogueWebsocketMessageMulti does not contain a \ElevenLabs\Types\FinalMulti
   */
  public function asFinalMulti(): \ElevenLabs\Types\FinalMulti
  {
    if (!$this->isFinalMulti()) {
      throw new \RuntimeException(
        'ReceiveTextToDialogueWebsocketMessageMulti does not contain \ElevenLabs\Types\FinalMulti'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\Error value
   * @throws \RuntimeException if this ReceiveTextToDialogueWebsocketMessageMulti does not contain a \ElevenLabs\Types\Error
   */
  public function asError(): \ElevenLabs\Types\Error
  {
    if (!$this->isError()) {
      throw new \RuntimeException(
        'ReceiveTextToDialogueWebsocketMessageMulti does not contain \ElevenLabs\Types\Error'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\AudioChunkMulti value
   * @return \ElevenLabs\Types\AudioChunkMulti|null Returns the value if this ReceiveTextToDialogueWebsocketMessageMulti contains a \ElevenLabs\Types\AudioChunkMulti, null otherwise
   */
  public function tryAsAudioChunkMulti(): ?\ElevenLabs\Types\AudioChunkMulti
  {
    return $this->isAudioChunkMulti() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\FinalAudioForTurnMulti value
   * @return \ElevenLabs\Types\FinalAudioForTurnMulti|null Returns the value if this ReceiveTextToDialogueWebsocketMessageMulti contains a \ElevenLabs\Types\FinalAudioForTurnMulti, null otherwise
   */
  public function tryAsFinalAudioForTurnMulti(): ?\ElevenLabs\Types\FinalAudioForTurnMulti
  {
    return $this->isFinalAudioForTurnMulti() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\FinalMulti value
   * @return \ElevenLabs\Types\FinalMulti|null Returns the value if this ReceiveTextToDialogueWebsocketMessageMulti contains a \ElevenLabs\Types\FinalMulti, null otherwise
   */
  public function tryAsFinalMulti(): ?\ElevenLabs\Types\FinalMulti
  {
    return $this->isFinalMulti() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\Error value
   * @return \ElevenLabs\Types\Error|null Returns the value if this ReceiveTextToDialogueWebsocketMessageMulti contains a \ElevenLabs\Types\Error, null otherwise
   */
  public function tryAsError(): ?\ElevenLabs\Types\Error
  {
    return $this->isError() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\AudioChunkMulti): T $onAudioChunkMulti
   * @param callable(\ElevenLabs\Types\FinalAudioForTurnMulti): T $onFinalAudioForTurnMulti
   * @param callable(\ElevenLabs\Types\FinalMulti): T $onFinalMulti
   * @param callable(\ElevenLabs\Types\Error): T $onError
   * @return T
   */
  public function match(
    callable $onAudioChunkMulti,
    callable $onFinalAudioForTurnMulti,
    callable $onFinalMulti,
    callable $onError
  ): mixed {
    return match ($this->typeIndex) {
      0 => $onAudioChunkMulti($this->value),
      1 => $onFinalAudioForTurnMulti($this->value),
      2 => $onFinalMulti($this->value),
      3 => $onError($this->value),
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
      $candidate = \ElevenLabs\Types\AudioChunkMulti::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AudioChunkMulti didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\FinalAudioForTurnMulti::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\FinalAudioForTurnMulti didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\FinalMulti::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\FinalMulti didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\Error::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 3, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\Error didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException(
        'Data does not match any ReceiveTextToDialogueWebsocketMessageMulti type'
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
