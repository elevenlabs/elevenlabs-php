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
class SendDubbingStreamMessage extends JsonSerializableType
{
  /**
   * @var string The discriminator value identifying which variant is stored
   */
  public readonly string $messageType;

  /**
   * @var \ElevenLabs\Types\DubbingInputAudioChunk|\ElevenLabs\Types\DubbingEndOfStream|array<string, mixed> The value, exactly one of the variant types
   */
  public readonly mixed $value;

  /**
   * @var int The type index identifying which variant type is stored
   */
  private int $typeIndex;

  /** The type index of a payload whose discriminator names no variant this SDK knows. */
  private const UNKNOWN = -1;

  /**
   * Whether the payload's discriminator named a variant this SDK does not know (a variant added to
   * the API after this SDK was generated). Its raw payload is kept, as Fern's `_unknown` variant does.
   *
   * Underscore-prefixed because a union may legitimately have a variant NAMED `unknown`, whose own
   * accessors are `isUnknown()`/`asUnknown()`. Declaring both is a fatal `Cannot redeclare` and the
   * class cannot load at all. The prefix matches Fern's `_unknown` sentinel and Java's
   * `_isUnknown()`/`_getUnknown()`, and a variant accessor is always `isX`/`asX`, never `_isX` --
   * so the two can never collide whatever a spec calls its variants.
   */
  public function _isUnknown(): bool
  {
    return $this->typeIndex === self::UNKNOWN;
  }

  /**
   * @return array<string, mixed> The raw payload of an unknown variant
   * @throws \RuntimeException if this SendDubbingStreamMessage holds a known variant
   */
  public function _asUnknown(): array
  {
    if (!$this->_isUnknown()) {
      throw new \RuntimeException('SendDubbingStreamMessage does not contain an unknown variant');
    }
    /** @var array<string, mixed> $value */
    $value = $this->value;
    return $value;
  }

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\DubbingInputAudioChunk|\ElevenLabs\Types\DubbingEndOfStream|array<string, mixed> $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
    $this->messageType = match ($typeIndex) {
      0 => 'input_audio_chunk',
      1 => 'end_of_stream',
      self::UNKNOWN => '_unknown',
      default => throw new \UnexpectedValueException("Unknown type index: $typeIndex")
    };
  }

  // Factory methods
  /**
   * Create a SendDubbingStreamMessage instance containing a \ElevenLabs\Types\DubbingInputAudioChunk
   */
  public static function inputAudioChunk(
    \ElevenLabs\Types\DubbingInputAudioChunk $inputAudioChunk
  ): self {
    return new self($inputAudioChunk, 0);
  }

  /**
   * Create a SendDubbingStreamMessage instance containing a \ElevenLabs\Types\DubbingEndOfStream
   */
  public static function endOfStream(\ElevenLabs\Types\DubbingEndOfStream $endOfStream): self
  {
    return new self($endOfStream, 1);
  }

  // Type checking methods
  /**
   * Check if this SendDubbingStreamMessage contains a \ElevenLabs\Types\DubbingInputAudioChunk
   */
  public function isInputAudioChunk(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this SendDubbingStreamMessage contains a \ElevenLabs\Types\DubbingEndOfStream
   */
  public function isEndOfStream(): bool
  {
    return $this->typeIndex === 1;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\DubbingInputAudioChunk value
   * @throws \RuntimeException if this SendDubbingStreamMessage does not contain a \ElevenLabs\Types\DubbingInputAudioChunk
   */
  public function asInputAudioChunk(): \ElevenLabs\Types\DubbingInputAudioChunk
  {
    if (!$this->isInputAudioChunk()) {
      throw new \RuntimeException(
        'SendDubbingStreamMessage does not contain \ElevenLabs\Types\DubbingInputAudioChunk'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\DubbingEndOfStream value
   * @throws \RuntimeException if this SendDubbingStreamMessage does not contain a \ElevenLabs\Types\DubbingEndOfStream
   */
  public function asEndOfStream(): \ElevenLabs\Types\DubbingEndOfStream
  {
    if (!$this->isEndOfStream()) {
      throw new \RuntimeException(
        'SendDubbingStreamMessage does not contain \ElevenLabs\Types\DubbingEndOfStream'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\DubbingInputAudioChunk value
   * @return \ElevenLabs\Types\DubbingInputAudioChunk|null Returns the value if this SendDubbingStreamMessage contains a \ElevenLabs\Types\DubbingInputAudioChunk, null otherwise
   */
  public function tryAsInputAudioChunk(): ?\ElevenLabs\Types\DubbingInputAudioChunk
  {
    return $this->isInputAudioChunk() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\DubbingEndOfStream value
   * @return \ElevenLabs\Types\DubbingEndOfStream|null Returns the value if this SendDubbingStreamMessage contains a \ElevenLabs\Types\DubbingEndOfStream, null otherwise
   */
  public function tryAsEndOfStream(): ?\ElevenLabs\Types\DubbingEndOfStream
  {
    return $this->isEndOfStream() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\DubbingInputAudioChunk): T $onInputAudioChunk
   * @param callable(\ElevenLabs\Types\DubbingEndOfStream): T $onEndOfStream
   * @return T
   */
  public function match(callable $onInputAudioChunk, callable $onEndOfStream): mixed
  {
    return match ($this->typeIndex) {
      0 => $onInputAudioChunk($this->value),
      1 => $onEndOfStream($this->value),
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
    // The payload's own discriminator value picks the variant. Scoring alone ties whenever two
    // members have the same shape and differ only in that constant, and the first would win.
    if (is_array($data) && isset($data['message_type']) && is_string($data['message_type'])) {
      switch ($data['message_type']) {
        case 'input_audio_chunk':
          return new self(\ElevenLabs\Types\DubbingInputAudioChunk::fromArray($data), 0);
        case 'end_of_stream':
          return new self(\ElevenLabs\Types\DubbingEndOfStream::fromArray($data), 1);
        default:
          // A variant the API added after this SDK was generated: kept, not rejected.
          return new self($data, self::UNKNOWN);
      }
    }

    /** @var list<array{instance: mixed, idx: int, score: int}> */
    $candidates = [];
    try {
      $candidate = \ElevenLabs\Types\DubbingInputAudioChunk::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\DubbingInputAudioChunk didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\DubbingEndOfStream::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\DubbingEndOfStream didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException('Data does not match any SendDubbingStreamMessage type');
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
    if ($this->_isUnknown()) {
      return $this->_asUnknown();
    }
    return $this->value->jsonSerialize();
  }
}
