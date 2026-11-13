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
class SendMessage extends JsonSerializableType
{
  /**
   * @var \ElevenLabs\Types\InitializeConnection|\ElevenLabs\Types\SendText|\ElevenLabs\Types\CloseConnection The value, exactly one of the variant types
   */
  public readonly mixed $value;

  /**
   * @var int The type index identifying which variant type is stored
   */
  private int $typeIndex;

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\InitializeConnection|\ElevenLabs\Types\SendText|\ElevenLabs\Types\CloseConnection $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
  }

  // Factory methods
  /**
   * Create a SendMessage instance containing a \ElevenLabs\Types\InitializeConnection
   */
  public static function initializeConnection(
    \ElevenLabs\Types\InitializeConnection $initializeConnection
  ): self {
    return new self($initializeConnection, 0);
  }

  /**
   * Create a SendMessage instance containing a \ElevenLabs\Types\SendText
   */
  public static function sendText(\ElevenLabs\Types\SendText $sendText): self
  {
    return new self($sendText, 1);
  }

  /**
   * Create a SendMessage instance containing a \ElevenLabs\Types\CloseConnection
   */
  public static function closeConnection(\ElevenLabs\Types\CloseConnection $closeConnection): self
  {
    return new self($closeConnection, 2);
  }

  // Type checking methods
  /**
   * Check if this SendMessage contains a \ElevenLabs\Types\InitializeConnection
   */
  public function isInitializeConnection(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this SendMessage contains a \ElevenLabs\Types\SendText
   */
  public function isSendText(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this SendMessage contains a \ElevenLabs\Types\CloseConnection
   */
  public function isCloseConnection(): bool
  {
    return $this->typeIndex === 2;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\InitializeConnection value
   * @throws \RuntimeException if this SendMessage does not contain a \ElevenLabs\Types\InitializeConnection
   */
  public function asInitializeConnection(): \ElevenLabs\Types\InitializeConnection
  {
    if (!$this->isInitializeConnection()) {
      throw new \RuntimeException(
        'SendMessage does not contain \ElevenLabs\Types\InitializeConnection'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\SendText value
   * @throws \RuntimeException if this SendMessage does not contain a \ElevenLabs\Types\SendText
   */
  public function asSendText(): \ElevenLabs\Types\SendText
  {
    if (!$this->isSendText()) {
      throw new \RuntimeException('SendMessage does not contain \ElevenLabs\Types\SendText');
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\CloseConnection value
   * @throws \RuntimeException if this SendMessage does not contain a \ElevenLabs\Types\CloseConnection
   */
  public function asCloseConnection(): \ElevenLabs\Types\CloseConnection
  {
    if (!$this->isCloseConnection()) {
      throw new \RuntimeException('SendMessage does not contain \ElevenLabs\Types\CloseConnection');
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\InitializeConnection value
   * @return \ElevenLabs\Types\InitializeConnection|null Returns the value if this SendMessage contains a \ElevenLabs\Types\InitializeConnection, null otherwise
   */
  public function tryAsInitializeConnection(): ?\ElevenLabs\Types\InitializeConnection
  {
    return $this->isInitializeConnection() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\SendText value
   * @return \ElevenLabs\Types\SendText|null Returns the value if this SendMessage contains a \ElevenLabs\Types\SendText, null otherwise
   */
  public function tryAsSendText(): ?\ElevenLabs\Types\SendText
  {
    return $this->isSendText() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\CloseConnection value
   * @return \ElevenLabs\Types\CloseConnection|null Returns the value if this SendMessage contains a \ElevenLabs\Types\CloseConnection, null otherwise
   */
  public function tryAsCloseConnection(): ?\ElevenLabs\Types\CloseConnection
  {
    return $this->isCloseConnection() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\InitializeConnection): T $onInitializeConnection
   * @param callable(\ElevenLabs\Types\SendText): T $onSendText
   * @param callable(\ElevenLabs\Types\CloseConnection): T $onCloseConnection
   * @return T
   */
  public function match(
    callable $onInitializeConnection,
    callable $onSendText,
    callable $onCloseConnection
  ): mixed {
    return match ($this->typeIndex) {
      0 => $onInitializeConnection($this->value),
      1 => $onSendText($this->value),
      2 => $onCloseConnection($this->value),
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
      $candidate = \ElevenLabs\Types\InitializeConnection::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\InitializeConnection didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\SendText::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\SendText didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\CloseConnection::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\CloseConnection didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException('Data does not match any SendMessage type');
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
