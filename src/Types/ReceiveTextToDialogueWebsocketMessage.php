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
class ReceiveTextToDialogueWebsocketMessage extends JsonSerializableType
{
  /**
   * @var \ElevenLabs\Types\AudioChunk|\ElevenLabs\Types\FinalAudioForTurn|\ElevenLabs\Types\Final_|\ElevenLabs\Types\Error The value, exactly one of the variant types
   */
  public readonly mixed $value;

  /**
   * @var int The type index identifying which variant type is stored
   */
  private int $typeIndex;

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\AudioChunk|\ElevenLabs\Types\FinalAudioForTurn|\ElevenLabs\Types\Final_|\ElevenLabs\Types\Error $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
  }

  // Factory methods
  /**
   * Create a ReceiveTextToDialogueWebsocketMessage instance containing a \ElevenLabs\Types\AudioChunk
   */
  public static function audioChunk(\ElevenLabs\Types\AudioChunk $audioChunk): self
  {
    return new self($audioChunk, 0);
  }

  /**
   * Create a ReceiveTextToDialogueWebsocketMessage instance containing a \ElevenLabs\Types\FinalAudioForTurn
   */
  public static function finalAudioForTurn(
    \ElevenLabs\Types\FinalAudioForTurn $finalAudioForTurn
  ): self {
    return new self($finalAudioForTurn, 1);
  }

  /**
   * Create a ReceiveTextToDialogueWebsocketMessage instance containing a \ElevenLabs\Types\Final_
   */
  public static function final_(\ElevenLabs\Types\Final_ $final_): self
  {
    return new self($final_, 2);
  }

  /**
   * Create a ReceiveTextToDialogueWebsocketMessage instance containing a \ElevenLabs\Types\Error
   */
  public static function error(\ElevenLabs\Types\Error $error): self
  {
    return new self($error, 3);
  }

  // Type checking methods
  /**
   * Check if this ReceiveTextToDialogueWebsocketMessage contains a \ElevenLabs\Types\AudioChunk
   */
  public function isAudioChunk(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this ReceiveTextToDialogueWebsocketMessage contains a \ElevenLabs\Types\FinalAudioForTurn
   */
  public function isFinalAudioForTurn(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this ReceiveTextToDialogueWebsocketMessage contains a \ElevenLabs\Types\Final_
   */
  public function isFinal_(): bool
  {
    return $this->typeIndex === 2;
  }

  /**
   * Check if this ReceiveTextToDialogueWebsocketMessage contains a \ElevenLabs\Types\Error
   */
  public function isError(): bool
  {
    return $this->typeIndex === 3;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\AudioChunk value
   * @throws \RuntimeException if this ReceiveTextToDialogueWebsocketMessage does not contain a \ElevenLabs\Types\AudioChunk
   */
  public function asAudioChunk(): \ElevenLabs\Types\AudioChunk
  {
    if (!$this->isAudioChunk()) {
      throw new \RuntimeException(
        'ReceiveTextToDialogueWebsocketMessage does not contain \ElevenLabs\Types\AudioChunk'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\FinalAudioForTurn value
   * @throws \RuntimeException if this ReceiveTextToDialogueWebsocketMessage does not contain a \ElevenLabs\Types\FinalAudioForTurn
   */
  public function asFinalAudioForTurn(): \ElevenLabs\Types\FinalAudioForTurn
  {
    if (!$this->isFinalAudioForTurn()) {
      throw new \RuntimeException(
        'ReceiveTextToDialogueWebsocketMessage does not contain \ElevenLabs\Types\FinalAudioForTurn'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\Final_ value
   * @throws \RuntimeException if this ReceiveTextToDialogueWebsocketMessage does not contain a \ElevenLabs\Types\Final_
   */
  public function asFinal_(): \ElevenLabs\Types\Final_
  {
    if (!$this->isFinal_()) {
      throw new \RuntimeException(
        'ReceiveTextToDialogueWebsocketMessage does not contain \ElevenLabs\Types\Final_'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\Error value
   * @throws \RuntimeException if this ReceiveTextToDialogueWebsocketMessage does not contain a \ElevenLabs\Types\Error
   */
  public function asError(): \ElevenLabs\Types\Error
  {
    if (!$this->isError()) {
      throw new \RuntimeException(
        'ReceiveTextToDialogueWebsocketMessage does not contain \ElevenLabs\Types\Error'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\AudioChunk value
   * @return \ElevenLabs\Types\AudioChunk|null Returns the value if this ReceiveTextToDialogueWebsocketMessage contains a \ElevenLabs\Types\AudioChunk, null otherwise
   */
  public function tryAsAudioChunk(): ?\ElevenLabs\Types\AudioChunk
  {
    return $this->isAudioChunk() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\FinalAudioForTurn value
   * @return \ElevenLabs\Types\FinalAudioForTurn|null Returns the value if this ReceiveTextToDialogueWebsocketMessage contains a \ElevenLabs\Types\FinalAudioForTurn, null otherwise
   */
  public function tryAsFinalAudioForTurn(): ?\ElevenLabs\Types\FinalAudioForTurn
  {
    return $this->isFinalAudioForTurn() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\Final_ value
   * @return \ElevenLabs\Types\Final_|null Returns the value if this ReceiveTextToDialogueWebsocketMessage contains a \ElevenLabs\Types\Final_, null otherwise
   */
  public function tryAsFinal_(): ?\ElevenLabs\Types\Final_
  {
    return $this->isFinal_() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\Error value
   * @return \ElevenLabs\Types\Error|null Returns the value if this ReceiveTextToDialogueWebsocketMessage contains a \ElevenLabs\Types\Error, null otherwise
   */
  public function tryAsError(): ?\ElevenLabs\Types\Error
  {
    return $this->isError() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\AudioChunk): T $onAudioChunk
   * @param callable(\ElevenLabs\Types\FinalAudioForTurn): T $onFinalAudioForTurn
   * @param callable(\ElevenLabs\Types\Final_): T $onFinal_
   * @param callable(\ElevenLabs\Types\Error): T $onError
   * @return T
   */
  public function match(
    callable $onAudioChunk,
    callable $onFinalAudioForTurn,
    callable $onFinal_,
    callable $onError
  ): mixed {
    return match ($this->typeIndex) {
      0 => $onAudioChunk($this->value),
      1 => $onFinalAudioForTurn($this->value),
      2 => $onFinal_($this->value),
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
      $candidate = \ElevenLabs\Types\AudioChunk::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AudioChunk didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\FinalAudioForTurn::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\FinalAudioForTurn didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\Final_::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\Final_ didn't match, continue to next type
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
        'Data does not match any ReceiveTextToDialogueWebsocketMessage type'
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
