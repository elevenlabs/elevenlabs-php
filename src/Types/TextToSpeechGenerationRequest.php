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
class TextToSpeechGenerationRequest extends JsonSerializableType
{
  /**
   * @var string The discriminator value identifying which variant is stored
   */
  public readonly string $modelId;

  /**
   * @var \ElevenLabs\Types\ElevenFlashV25Request|\ElevenLabs\Types\ElevenMultilingualV2Request|\ElevenLabs\Types\ElevenV3Request|array<string, mixed> The value, exactly one of the variant types
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
   * @throws \RuntimeException if this TextToSpeechGenerationRequest holds a known variant
   */
  public function _asUnknown(): array
  {
    if (!$this->_isUnknown()) {
      throw new \RuntimeException(
        'TextToSpeechGenerationRequest does not contain an unknown variant'
      );
    }
    /** @var array<string, mixed> $value */
    $value = $this->value;
    return $value;
  }

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\ElevenFlashV25Request|\ElevenLabs\Types\ElevenMultilingualV2Request|\ElevenLabs\Types\ElevenV3Request|array<string, mixed> $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
    $this->modelId = match ($typeIndex) {
      0 => 'eleven_flash_v2_5',
      1 => 'eleven_multilingual_v2',
      2 => 'eleven_v3',
      self::UNKNOWN => '_unknown',
      default => throw new \UnexpectedValueException("Unknown type index: $typeIndex")
    };
  }

  // Factory methods
  /**
   * Create a TextToSpeechGenerationRequest instance containing a \ElevenLabs\Types\ElevenFlashV25Request
   */
  public static function elevenFlashV2_5(
    \ElevenLabs\Types\ElevenFlashV25Request $elevenFlashV2_5
  ): self {
    return new self($elevenFlashV2_5, 0);
  }

  /**
   * Create a TextToSpeechGenerationRequest instance containing a \ElevenLabs\Types\ElevenMultilingualV2Request
   */
  public static function elevenMultilingualV2(
    \ElevenLabs\Types\ElevenMultilingualV2Request $elevenMultilingualV2
  ): self {
    return new self($elevenMultilingualV2, 1);
  }

  /**
   * Create a TextToSpeechGenerationRequest instance containing a \ElevenLabs\Types\ElevenV3Request
   */
  public static function elevenV3(\ElevenLabs\Types\ElevenV3Request $elevenV3): self
  {
    return new self($elevenV3, 2);
  }

  // Type checking methods
  /**
   * Check if this TextToSpeechGenerationRequest contains a \ElevenLabs\Types\ElevenFlashV25Request
   */
  public function isElevenFlashV2_5(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this TextToSpeechGenerationRequest contains a \ElevenLabs\Types\ElevenMultilingualV2Request
   */
  public function isElevenMultilingualV2(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this TextToSpeechGenerationRequest contains a \ElevenLabs\Types\ElevenV3Request
   */
  public function isElevenV3(): bool
  {
    return $this->typeIndex === 2;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\ElevenFlashV25Request value
   * @throws \RuntimeException if this TextToSpeechGenerationRequest does not contain a \ElevenLabs\Types\ElevenFlashV25Request
   */
  public function asElevenFlashV2_5(): \ElevenLabs\Types\ElevenFlashV25Request
  {
    if (!$this->isElevenFlashV2_5()) {
      throw new \RuntimeException(
        'TextToSpeechGenerationRequest does not contain \ElevenLabs\Types\ElevenFlashV25Request'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ElevenMultilingualV2Request value
   * @throws \RuntimeException if this TextToSpeechGenerationRequest does not contain a \ElevenLabs\Types\ElevenMultilingualV2Request
   */
  public function asElevenMultilingualV2(): \ElevenLabs\Types\ElevenMultilingualV2Request
  {
    if (!$this->isElevenMultilingualV2()) {
      throw new \RuntimeException(
        'TextToSpeechGenerationRequest does not contain \ElevenLabs\Types\ElevenMultilingualV2Request'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ElevenV3Request value
   * @throws \RuntimeException if this TextToSpeechGenerationRequest does not contain a \ElevenLabs\Types\ElevenV3Request
   */
  public function asElevenV3(): \ElevenLabs\Types\ElevenV3Request
  {
    if (!$this->isElevenV3()) {
      throw new \RuntimeException(
        'TextToSpeechGenerationRequest does not contain \ElevenLabs\Types\ElevenV3Request'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\ElevenFlashV25Request value
   * @return \ElevenLabs\Types\ElevenFlashV25Request|null Returns the value if this TextToSpeechGenerationRequest contains a \ElevenLabs\Types\ElevenFlashV25Request, null otherwise
   */
  public function tryAsElevenFlashV2_5(): ?\ElevenLabs\Types\ElevenFlashV25Request
  {
    return $this->isElevenFlashV2_5() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ElevenMultilingualV2Request value
   * @return \ElevenLabs\Types\ElevenMultilingualV2Request|null Returns the value if this TextToSpeechGenerationRequest contains a \ElevenLabs\Types\ElevenMultilingualV2Request, null otherwise
   */
  public function tryAsElevenMultilingualV2(): ?\ElevenLabs\Types\ElevenMultilingualV2Request
  {
    return $this->isElevenMultilingualV2() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ElevenV3Request value
   * @return \ElevenLabs\Types\ElevenV3Request|null Returns the value if this TextToSpeechGenerationRequest contains a \ElevenLabs\Types\ElevenV3Request, null otherwise
   */
  public function tryAsElevenV3(): ?\ElevenLabs\Types\ElevenV3Request
  {
    return $this->isElevenV3() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\ElevenFlashV25Request): T $onElevenFlashV2_5
   * @param callable(\ElevenLabs\Types\ElevenMultilingualV2Request): T $onElevenMultilingualV2
   * @param callable(\ElevenLabs\Types\ElevenV3Request): T $onElevenV3
   * @return T
   */
  public function match(
    callable $onElevenFlashV2_5,
    callable $onElevenMultilingualV2,
    callable $onElevenV3
  ): mixed {
    return match ($this->typeIndex) {
      0 => $onElevenFlashV2_5($this->value),
      1 => $onElevenMultilingualV2($this->value),
      2 => $onElevenV3($this->value),
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
    if (is_array($data) && isset($data['model_id']) && is_string($data['model_id'])) {
      switch ($data['model_id']) {
        case 'eleven_flash_v2_5':
          return new self(\ElevenLabs\Types\ElevenFlashV25Request::fromArray($data), 0);
        case 'eleven_multilingual_v2':
          return new self(\ElevenLabs\Types\ElevenMultilingualV2Request::fromArray($data), 1);
        case 'eleven_v3':
          return new self(\ElevenLabs\Types\ElevenV3Request::fromArray($data), 2);
        default:
          // A variant the API added after this SDK was generated: kept, not rejected.
          return new self($data, self::UNKNOWN);
      }
    }

    /** @var list<array{instance: mixed, idx: int, score: int}> */
    $candidates = [];
    try {
      $candidate = \ElevenLabs\Types\ElevenFlashV25Request::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ElevenFlashV25Request didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ElevenMultilingualV2Request::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ElevenMultilingualV2Request didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ElevenV3Request::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ElevenV3Request didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException(
        'Data does not match any TextToSpeechGenerationRequest type'
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
    if ($this->_isUnknown()) {
      return $this->_asUnknown();
    }
    return $this->value->jsonSerialize();
  }
}
