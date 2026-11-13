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
class ReceiveUpstreamMessage extends JsonSerializableType
{
  /**
   * @var string The discriminator value identifying which variant is stored
   */
  public readonly string $type;

  /**
   * @var \ElevenLabs\Types\Init|\ElevenLabs\Types\UserTranscript|\ElevenLabs\Types\Ping|\ElevenLabs\Types\Close|\ElevenLabs\Types\SpeechEngineError|array<string, mixed> The value, exactly one of the variant types
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
   * @throws \RuntimeException if this ReceiveUpstreamMessage holds a known variant
   */
  public function _asUnknown(): array
  {
    if (!$this->_isUnknown()) {
      throw new \RuntimeException('ReceiveUpstreamMessage does not contain an unknown variant');
    }
    /** @var array<string, mixed> $value */
    $value = $this->value;
    return $value;
  }

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\Init|\ElevenLabs\Types\UserTranscript|\ElevenLabs\Types\Ping|\ElevenLabs\Types\Close|\ElevenLabs\Types\SpeechEngineError|array<string, mixed> $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
    $this->type = match ($typeIndex) {
      0 => 'init',
      1 => 'user_transcript',
      2 => 'ping',
      3 => 'close',
      4 => 'error',
      self::UNKNOWN => '_unknown',
      default => throw new \UnexpectedValueException("Unknown type index: $typeIndex")
    };
  }

  // Factory methods
  /**
   * Create a ReceiveUpstreamMessage instance containing a \ElevenLabs\Types\Init
   */
  public static function init(\ElevenLabs\Types\Init $init): self
  {
    return new self($init, 0);
  }

  /**
   * Create a ReceiveUpstreamMessage instance containing a \ElevenLabs\Types\UserTranscript
   */
  public static function userTranscript(\ElevenLabs\Types\UserTranscript $userTranscript): self
  {
    return new self($userTranscript, 1);
  }

  /**
   * Create a ReceiveUpstreamMessage instance containing a \ElevenLabs\Types\Ping
   */
  public static function ping(\ElevenLabs\Types\Ping $ping): self
  {
    return new self($ping, 2);
  }

  /**
   * Create a ReceiveUpstreamMessage instance containing a \ElevenLabs\Types\Close
   */
  public static function close(\ElevenLabs\Types\Close $close): self
  {
    return new self($close, 3);
  }

  /**
   * Create a ReceiveUpstreamMessage instance containing a \ElevenLabs\Types\SpeechEngineError
   */
  public static function error(\ElevenLabs\Types\SpeechEngineError $error): self
  {
    return new self($error, 4);
  }

  // Type checking methods
  /**
   * Check if this ReceiveUpstreamMessage contains a \ElevenLabs\Types\Init
   */
  public function isInit(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this ReceiveUpstreamMessage contains a \ElevenLabs\Types\UserTranscript
   */
  public function isUserTranscript(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this ReceiveUpstreamMessage contains a \ElevenLabs\Types\Ping
   */
  public function isPing(): bool
  {
    return $this->typeIndex === 2;
  }

  /**
   * Check if this ReceiveUpstreamMessage contains a \ElevenLabs\Types\Close
   */
  public function isClose(): bool
  {
    return $this->typeIndex === 3;
  }

  /**
   * Check if this ReceiveUpstreamMessage contains a \ElevenLabs\Types\SpeechEngineError
   */
  public function isError(): bool
  {
    return $this->typeIndex === 4;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\Init value
   * @throws \RuntimeException if this ReceiveUpstreamMessage does not contain a \ElevenLabs\Types\Init
   */
  public function asInit(): \ElevenLabs\Types\Init
  {
    if (!$this->isInit()) {
      throw new \RuntimeException('ReceiveUpstreamMessage does not contain \ElevenLabs\Types\Init');
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\UserTranscript value
   * @throws \RuntimeException if this ReceiveUpstreamMessage does not contain a \ElevenLabs\Types\UserTranscript
   */
  public function asUserTranscript(): \ElevenLabs\Types\UserTranscript
  {
    if (!$this->isUserTranscript()) {
      throw new \RuntimeException(
        'ReceiveUpstreamMessage does not contain \ElevenLabs\Types\UserTranscript'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\Ping value
   * @throws \RuntimeException if this ReceiveUpstreamMessage does not contain a \ElevenLabs\Types\Ping
   */
  public function asPing(): \ElevenLabs\Types\Ping
  {
    if (!$this->isPing()) {
      throw new \RuntimeException('ReceiveUpstreamMessage does not contain \ElevenLabs\Types\Ping');
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\Close value
   * @throws \RuntimeException if this ReceiveUpstreamMessage does not contain a \ElevenLabs\Types\Close
   */
  public function asClose(): \ElevenLabs\Types\Close
  {
    if (!$this->isClose()) {
      throw new \RuntimeException(
        'ReceiveUpstreamMessage does not contain \ElevenLabs\Types\Close'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\SpeechEngineError value
   * @throws \RuntimeException if this ReceiveUpstreamMessage does not contain a \ElevenLabs\Types\SpeechEngineError
   */
  public function asError(): \ElevenLabs\Types\SpeechEngineError
  {
    if (!$this->isError()) {
      throw new \RuntimeException(
        'ReceiveUpstreamMessage does not contain \ElevenLabs\Types\SpeechEngineError'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\Init value
   * @return \ElevenLabs\Types\Init|null Returns the value if this ReceiveUpstreamMessage contains a \ElevenLabs\Types\Init, null otherwise
   */
  public function tryAsInit(): ?\ElevenLabs\Types\Init
  {
    return $this->isInit() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\UserTranscript value
   * @return \ElevenLabs\Types\UserTranscript|null Returns the value if this ReceiveUpstreamMessage contains a \ElevenLabs\Types\UserTranscript, null otherwise
   */
  public function tryAsUserTranscript(): ?\ElevenLabs\Types\UserTranscript
  {
    return $this->isUserTranscript() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\Ping value
   * @return \ElevenLabs\Types\Ping|null Returns the value if this ReceiveUpstreamMessage contains a \ElevenLabs\Types\Ping, null otherwise
   */
  public function tryAsPing(): ?\ElevenLabs\Types\Ping
  {
    return $this->isPing() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\Close value
   * @return \ElevenLabs\Types\Close|null Returns the value if this ReceiveUpstreamMessage contains a \ElevenLabs\Types\Close, null otherwise
   */
  public function tryAsClose(): ?\ElevenLabs\Types\Close
  {
    return $this->isClose() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\SpeechEngineError value
   * @return \ElevenLabs\Types\SpeechEngineError|null Returns the value if this ReceiveUpstreamMessage contains a \ElevenLabs\Types\SpeechEngineError, null otherwise
   */
  public function tryAsError(): ?\ElevenLabs\Types\SpeechEngineError
  {
    return $this->isError() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\Init): T $onInit
   * @param callable(\ElevenLabs\Types\UserTranscript): T $onUserTranscript
   * @param callable(\ElevenLabs\Types\Ping): T $onPing
   * @param callable(\ElevenLabs\Types\Close): T $onClose
   * @param callable(\ElevenLabs\Types\SpeechEngineError): T $onError
   * @return T
   */
  public function match(
    callable $onInit,
    callable $onUserTranscript,
    callable $onPing,
    callable $onClose,
    callable $onError
  ): mixed {
    return match ($this->typeIndex) {
      0 => $onInit($this->value),
      1 => $onUserTranscript($this->value),
      2 => $onPing($this->value),
      3 => $onClose($this->value),
      4 => $onError($this->value),
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
    if (is_array($data) && isset($data['type']) && is_string($data['type'])) {
      switch ($data['type']) {
        case 'init':
          return new self(\ElevenLabs\Types\Init::fromArray($data), 0);
        case 'user_transcript':
          return new self(\ElevenLabs\Types\UserTranscript::fromArray($data), 1);
        case 'ping':
          return new self(\ElevenLabs\Types\Ping::fromArray($data), 2);
        case 'close':
          return new self(\ElevenLabs\Types\Close::fromArray($data), 3);
        case 'error':
          return new self(\ElevenLabs\Types\SpeechEngineError::fromArray($data), 4);
        default:
          // A variant the API added after this SDK was generated: kept, not rejected.
          return new self($data, self::UNKNOWN);
      }
    }

    /** @var list<array{instance: mixed, idx: int, score: int}> */
    $candidates = [];
    try {
      $candidate = \ElevenLabs\Types\Init::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\Init didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\UserTranscript::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\UserTranscript didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\Ping::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\Ping didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\Close::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 3, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\Close didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\SpeechEngineError::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 4, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\SpeechEngineError didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException('Data does not match any ReceiveUpstreamMessage type');
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
