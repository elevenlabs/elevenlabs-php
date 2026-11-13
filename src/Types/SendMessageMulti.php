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
class SendMessageMulti extends JsonSerializableType
{
  /**
   * @var \ElevenLabs\Types\InitializeConnectionMulti|\ElevenLabs\Types\InitialiseContext|\ElevenLabs\Types\SendTextMulti|\ElevenLabs\Types\FlushContext|\ElevenLabs\Types\CloseContext|\ElevenLabs\Types\CloseSocket|\ElevenLabs\Types\KeepContextAlive The value, exactly one of the variant types
   */
  public readonly mixed $value;

  /**
   * @var int The type index identifying which variant type is stored
   */
  private int $typeIndex;

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\InitializeConnectionMulti|\ElevenLabs\Types\InitialiseContext|\ElevenLabs\Types\SendTextMulti|\ElevenLabs\Types\FlushContext|\ElevenLabs\Types\CloseContext|\ElevenLabs\Types\CloseSocket|\ElevenLabs\Types\KeepContextAlive $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
  }

  // Factory methods
  /**
   * Create a SendMessageMulti instance containing a \ElevenLabs\Types\InitializeConnectionMulti
   */
  public static function initializeConnectionMulti(
    \ElevenLabs\Types\InitializeConnectionMulti $initializeConnectionMulti
  ): self {
    return new self($initializeConnectionMulti, 0);
  }

  /**
   * Create a SendMessageMulti instance containing a \ElevenLabs\Types\InitialiseContext
   */
  public static function initialiseContext(
    \ElevenLabs\Types\InitialiseContext $initialiseContext
  ): self {
    return new self($initialiseContext, 1);
  }

  /**
   * Create a SendMessageMulti instance containing a \ElevenLabs\Types\SendTextMulti
   */
  public static function sendTextMulti(\ElevenLabs\Types\SendTextMulti $sendTextMulti): self
  {
    return new self($sendTextMulti, 2);
  }

  /**
   * Create a SendMessageMulti instance containing a \ElevenLabs\Types\FlushContext
   */
  public static function flushContext(\ElevenLabs\Types\FlushContext $flushContext): self
  {
    return new self($flushContext, 3);
  }

  /**
   * Create a SendMessageMulti instance containing a \ElevenLabs\Types\CloseContext
   */
  public static function closeContext(\ElevenLabs\Types\CloseContext $closeContext): self
  {
    return new self($closeContext, 4);
  }

  /**
   * Create a SendMessageMulti instance containing a \ElevenLabs\Types\CloseSocket
   */
  public static function closeSocket(\ElevenLabs\Types\CloseSocket $closeSocket): self
  {
    return new self($closeSocket, 5);
  }

  /**
   * Create a SendMessageMulti instance containing a \ElevenLabs\Types\KeepContextAlive
   */
  public static function keepContextAlive(
    \ElevenLabs\Types\KeepContextAlive $keepContextAlive
  ): self {
    return new self($keepContextAlive, 6);
  }

  // Type checking methods
  /**
   * Check if this SendMessageMulti contains a \ElevenLabs\Types\InitializeConnectionMulti
   */
  public function isInitializeConnectionMulti(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this SendMessageMulti contains a \ElevenLabs\Types\InitialiseContext
   */
  public function isInitialiseContext(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this SendMessageMulti contains a \ElevenLabs\Types\SendTextMulti
   */
  public function isSendTextMulti(): bool
  {
    return $this->typeIndex === 2;
  }

  /**
   * Check if this SendMessageMulti contains a \ElevenLabs\Types\FlushContext
   */
  public function isFlushContext(): bool
  {
    return $this->typeIndex === 3;
  }

  /**
   * Check if this SendMessageMulti contains a \ElevenLabs\Types\CloseContext
   */
  public function isCloseContext(): bool
  {
    return $this->typeIndex === 4;
  }

  /**
   * Check if this SendMessageMulti contains a \ElevenLabs\Types\CloseSocket
   */
  public function isCloseSocket(): bool
  {
    return $this->typeIndex === 5;
  }

  /**
   * Check if this SendMessageMulti contains a \ElevenLabs\Types\KeepContextAlive
   */
  public function isKeepContextAlive(): bool
  {
    return $this->typeIndex === 6;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\InitializeConnectionMulti value
   * @throws \RuntimeException if this SendMessageMulti does not contain a \ElevenLabs\Types\InitializeConnectionMulti
   */
  public function asInitializeConnectionMulti(): \ElevenLabs\Types\InitializeConnectionMulti
  {
    if (!$this->isInitializeConnectionMulti()) {
      throw new \RuntimeException(
        'SendMessageMulti does not contain \ElevenLabs\Types\InitializeConnectionMulti'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\InitialiseContext value
   * @throws \RuntimeException if this SendMessageMulti does not contain a \ElevenLabs\Types\InitialiseContext
   */
  public function asInitialiseContext(): \ElevenLabs\Types\InitialiseContext
  {
    if (!$this->isInitialiseContext()) {
      throw new \RuntimeException(
        'SendMessageMulti does not contain \ElevenLabs\Types\InitialiseContext'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\SendTextMulti value
   * @throws \RuntimeException if this SendMessageMulti does not contain a \ElevenLabs\Types\SendTextMulti
   */
  public function asSendTextMulti(): \ElevenLabs\Types\SendTextMulti
  {
    if (!$this->isSendTextMulti()) {
      throw new \RuntimeException(
        'SendMessageMulti does not contain \ElevenLabs\Types\SendTextMulti'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\FlushContext value
   * @throws \RuntimeException if this SendMessageMulti does not contain a \ElevenLabs\Types\FlushContext
   */
  public function asFlushContext(): \ElevenLabs\Types\FlushContext
  {
    if (!$this->isFlushContext()) {
      throw new \RuntimeException(
        'SendMessageMulti does not contain \ElevenLabs\Types\FlushContext'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\CloseContext value
   * @throws \RuntimeException if this SendMessageMulti does not contain a \ElevenLabs\Types\CloseContext
   */
  public function asCloseContext(): \ElevenLabs\Types\CloseContext
  {
    if (!$this->isCloseContext()) {
      throw new \RuntimeException(
        'SendMessageMulti does not contain \ElevenLabs\Types\CloseContext'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\CloseSocket value
   * @throws \RuntimeException if this SendMessageMulti does not contain a \ElevenLabs\Types\CloseSocket
   */
  public function asCloseSocket(): \ElevenLabs\Types\CloseSocket
  {
    if (!$this->isCloseSocket()) {
      throw new \RuntimeException(
        'SendMessageMulti does not contain \ElevenLabs\Types\CloseSocket'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\KeepContextAlive value
   * @throws \RuntimeException if this SendMessageMulti does not contain a \ElevenLabs\Types\KeepContextAlive
   */
  public function asKeepContextAlive(): \ElevenLabs\Types\KeepContextAlive
  {
    if (!$this->isKeepContextAlive()) {
      throw new \RuntimeException(
        'SendMessageMulti does not contain \ElevenLabs\Types\KeepContextAlive'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\InitializeConnectionMulti value
   * @return \ElevenLabs\Types\InitializeConnectionMulti|null Returns the value if this SendMessageMulti contains a \ElevenLabs\Types\InitializeConnectionMulti, null otherwise
   */
  public function tryAsInitializeConnectionMulti(): ?\ElevenLabs\Types\InitializeConnectionMulti
  {
    return $this->isInitializeConnectionMulti() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\InitialiseContext value
   * @return \ElevenLabs\Types\InitialiseContext|null Returns the value if this SendMessageMulti contains a \ElevenLabs\Types\InitialiseContext, null otherwise
   */
  public function tryAsInitialiseContext(): ?\ElevenLabs\Types\InitialiseContext
  {
    return $this->isInitialiseContext() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\SendTextMulti value
   * @return \ElevenLabs\Types\SendTextMulti|null Returns the value if this SendMessageMulti contains a \ElevenLabs\Types\SendTextMulti, null otherwise
   */
  public function tryAsSendTextMulti(): ?\ElevenLabs\Types\SendTextMulti
  {
    return $this->isSendTextMulti() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\FlushContext value
   * @return \ElevenLabs\Types\FlushContext|null Returns the value if this SendMessageMulti contains a \ElevenLabs\Types\FlushContext, null otherwise
   */
  public function tryAsFlushContext(): ?\ElevenLabs\Types\FlushContext
  {
    return $this->isFlushContext() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\CloseContext value
   * @return \ElevenLabs\Types\CloseContext|null Returns the value if this SendMessageMulti contains a \ElevenLabs\Types\CloseContext, null otherwise
   */
  public function tryAsCloseContext(): ?\ElevenLabs\Types\CloseContext
  {
    return $this->isCloseContext() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\CloseSocket value
   * @return \ElevenLabs\Types\CloseSocket|null Returns the value if this SendMessageMulti contains a \ElevenLabs\Types\CloseSocket, null otherwise
   */
  public function tryAsCloseSocket(): ?\ElevenLabs\Types\CloseSocket
  {
    return $this->isCloseSocket() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\KeepContextAlive value
   * @return \ElevenLabs\Types\KeepContextAlive|null Returns the value if this SendMessageMulti contains a \ElevenLabs\Types\KeepContextAlive, null otherwise
   */
  public function tryAsKeepContextAlive(): ?\ElevenLabs\Types\KeepContextAlive
  {
    return $this->isKeepContextAlive() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\InitializeConnectionMulti): T $onInitializeConnectionMulti
   * @param callable(\ElevenLabs\Types\InitialiseContext): T $onInitialiseContext
   * @param callable(\ElevenLabs\Types\SendTextMulti): T $onSendTextMulti
   * @param callable(\ElevenLabs\Types\FlushContext): T $onFlushContext
   * @param callable(\ElevenLabs\Types\CloseContext): T $onCloseContext
   * @param callable(\ElevenLabs\Types\CloseSocket): T $onCloseSocket
   * @param callable(\ElevenLabs\Types\KeepContextAlive): T $onKeepContextAlive
   * @return T
   */
  public function match(
    callable $onInitializeConnectionMulti,
    callable $onInitialiseContext,
    callable $onSendTextMulti,
    callable $onFlushContext,
    callable $onCloseContext,
    callable $onCloseSocket,
    callable $onKeepContextAlive
  ): mixed {
    return match ($this->typeIndex) {
      0 => $onInitializeConnectionMulti($this->value),
      1 => $onInitialiseContext($this->value),
      2 => $onSendTextMulti($this->value),
      3 => $onFlushContext($this->value),
      4 => $onCloseContext($this->value),
      5 => $onCloseSocket($this->value),
      6 => $onKeepContextAlive($this->value),
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
      $candidate = \ElevenLabs\Types\InitializeConnectionMulti::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\InitializeConnectionMulti didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\InitialiseContext::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\InitialiseContext didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\SendTextMulti::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\SendTextMulti didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\FlushContext::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 3, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\FlushContext didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\CloseContext::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 4, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\CloseContext didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\CloseSocket::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 5, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\CloseSocket didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\KeepContextAlive::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 6, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\KeepContextAlive didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException('Data does not match any SendMessageMulti type');
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
