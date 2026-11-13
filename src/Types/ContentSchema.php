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
class ContentSchema extends JsonSerializableType
{
  /**
   * @var string The discriminator value identifying which variant is stored
   */
  public readonly string $type;

  /**
   * @var \ElevenLabs\Types\StringSchema|\ElevenLabs\Types\NumberSchema|\ElevenLabs\Types\IntegerSchema|\ElevenLabs\Types\BooleanSchema|\ElevenLabs\Types\ImageSchema|\ElevenLabs\Types\VideoSchema|\ElevenLabs\Types\AudioSchema|\ElevenLabs\Types\VoiceSchema|\ElevenLabs\Types\ObjectSchema|\ElevenLabs\Types\ArraySchema|array<string, mixed> The value, exactly one of the variant types
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
   * @throws \RuntimeException if this ContentSchema holds a known variant
   */
  public function _asUnknown(): array
  {
    if (!$this->_isUnknown()) {
      throw new \RuntimeException('ContentSchema does not contain an unknown variant');
    }
    /** @var array<string, mixed> $value */
    $value = $this->value;
    return $value;
  }

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\StringSchema|\ElevenLabs\Types\NumberSchema|\ElevenLabs\Types\IntegerSchema|\ElevenLabs\Types\BooleanSchema|\ElevenLabs\Types\ImageSchema|\ElevenLabs\Types\VideoSchema|\ElevenLabs\Types\AudioSchema|\ElevenLabs\Types\VoiceSchema|\ElevenLabs\Types\ObjectSchema|\ElevenLabs\Types\ArraySchema|array<string, mixed> $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
    $this->type = match ($typeIndex) {
      0 => 'string',
      1 => 'number',
      2 => 'integer',
      3 => 'boolean',
      4 => 'image',
      5 => 'video',
      6 => 'audio',
      7 => 'voice',
      8 => 'object',
      9 => 'array',
      self::UNKNOWN => '_unknown',
      default => throw new \UnexpectedValueException("Unknown type index: $typeIndex")
    };
  }

  // Factory methods
  /**
   * Create a ContentSchema instance containing a \ElevenLabs\Types\StringSchema
   */
  public static function string(\ElevenLabs\Types\StringSchema $string): self
  {
    return new self($string, 0);
  }

  /**
   * Create a ContentSchema instance containing a \ElevenLabs\Types\NumberSchema
   */
  public static function number(\ElevenLabs\Types\NumberSchema $number): self
  {
    return new self($number, 1);
  }

  /**
   * Create a ContentSchema instance containing a \ElevenLabs\Types\IntegerSchema
   */
  public static function integer(\ElevenLabs\Types\IntegerSchema $integer): self
  {
    return new self($integer, 2);
  }

  /**
   * Create a ContentSchema instance containing a \ElevenLabs\Types\BooleanSchema
   */
  public static function boolean(\ElevenLabs\Types\BooleanSchema $boolean): self
  {
    return new self($boolean, 3);
  }

  /**
   * Create a ContentSchema instance containing a \ElevenLabs\Types\ImageSchema
   */
  public static function image(\ElevenLabs\Types\ImageSchema $image): self
  {
    return new self($image, 4);
  }

  /**
   * Create a ContentSchema instance containing a \ElevenLabs\Types\VideoSchema
   */
  public static function video(\ElevenLabs\Types\VideoSchema $video): self
  {
    return new self($video, 5);
  }

  /**
   * Create a ContentSchema instance containing a \ElevenLabs\Types\AudioSchema
   */
  public static function audio(\ElevenLabs\Types\AudioSchema $audio): self
  {
    return new self($audio, 6);
  }

  /**
   * Create a ContentSchema instance containing a \ElevenLabs\Types\VoiceSchema
   */
  public static function voice(\ElevenLabs\Types\VoiceSchema $voice): self
  {
    return new self($voice, 7);
  }

  /**
   * Create a ContentSchema instance containing a \ElevenLabs\Types\ObjectSchema
   */
  public static function object(\ElevenLabs\Types\ObjectSchema $object): self
  {
    return new self($object, 8);
  }

  /**
   * Create a ContentSchema instance containing a \ElevenLabs\Types\ArraySchema
   */
  public static function array(\ElevenLabs\Types\ArraySchema $array): self
  {
    return new self($array, 9);
  }

  // Type checking methods
  /**
   * Check if this ContentSchema contains a \ElevenLabs\Types\StringSchema
   */
  public function isString(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this ContentSchema contains a \ElevenLabs\Types\NumberSchema
   */
  public function isNumber(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this ContentSchema contains a \ElevenLabs\Types\IntegerSchema
   */
  public function isInteger(): bool
  {
    return $this->typeIndex === 2;
  }

  /**
   * Check if this ContentSchema contains a \ElevenLabs\Types\BooleanSchema
   */
  public function isBoolean(): bool
  {
    return $this->typeIndex === 3;
  }

  /**
   * Check if this ContentSchema contains a \ElevenLabs\Types\ImageSchema
   */
  public function isImage(): bool
  {
    return $this->typeIndex === 4;
  }

  /**
   * Check if this ContentSchema contains a \ElevenLabs\Types\VideoSchema
   */
  public function isVideo(): bool
  {
    return $this->typeIndex === 5;
  }

  /**
   * Check if this ContentSchema contains a \ElevenLabs\Types\AudioSchema
   */
  public function isAudio(): bool
  {
    return $this->typeIndex === 6;
  }

  /**
   * Check if this ContentSchema contains a \ElevenLabs\Types\VoiceSchema
   */
  public function isVoice(): bool
  {
    return $this->typeIndex === 7;
  }

  /**
   * Check if this ContentSchema contains a \ElevenLabs\Types\ObjectSchema
   */
  public function isObject(): bool
  {
    return $this->typeIndex === 8;
  }

  /**
   * Check if this ContentSchema contains a \ElevenLabs\Types\ArraySchema
   */
  public function isArray(): bool
  {
    return $this->typeIndex === 9;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\StringSchema value
   * @throws \RuntimeException if this ContentSchema does not contain a \ElevenLabs\Types\StringSchema
   */
  public function asString(): \ElevenLabs\Types\StringSchema
  {
    if (!$this->isString()) {
      throw new \RuntimeException('ContentSchema does not contain \ElevenLabs\Types\StringSchema');
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\NumberSchema value
   * @throws \RuntimeException if this ContentSchema does not contain a \ElevenLabs\Types\NumberSchema
   */
  public function asNumber(): \ElevenLabs\Types\NumberSchema
  {
    if (!$this->isNumber()) {
      throw new \RuntimeException('ContentSchema does not contain \ElevenLabs\Types\NumberSchema');
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\IntegerSchema value
   * @throws \RuntimeException if this ContentSchema does not contain a \ElevenLabs\Types\IntegerSchema
   */
  public function asInteger(): \ElevenLabs\Types\IntegerSchema
  {
    if (!$this->isInteger()) {
      throw new \RuntimeException('ContentSchema does not contain \ElevenLabs\Types\IntegerSchema');
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\BooleanSchema value
   * @throws \RuntimeException if this ContentSchema does not contain a \ElevenLabs\Types\BooleanSchema
   */
  public function asBoolean(): \ElevenLabs\Types\BooleanSchema
  {
    if (!$this->isBoolean()) {
      throw new \RuntimeException('ContentSchema does not contain \ElevenLabs\Types\BooleanSchema');
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ImageSchema value
   * @throws \RuntimeException if this ContentSchema does not contain a \ElevenLabs\Types\ImageSchema
   */
  public function asImage(): \ElevenLabs\Types\ImageSchema
  {
    if (!$this->isImage()) {
      throw new \RuntimeException('ContentSchema does not contain \ElevenLabs\Types\ImageSchema');
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\VideoSchema value
   * @throws \RuntimeException if this ContentSchema does not contain a \ElevenLabs\Types\VideoSchema
   */
  public function asVideo(): \ElevenLabs\Types\VideoSchema
  {
    if (!$this->isVideo()) {
      throw new \RuntimeException('ContentSchema does not contain \ElevenLabs\Types\VideoSchema');
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AudioSchema value
   * @throws \RuntimeException if this ContentSchema does not contain a \ElevenLabs\Types\AudioSchema
   */
  public function asAudio(): \ElevenLabs\Types\AudioSchema
  {
    if (!$this->isAudio()) {
      throw new \RuntimeException('ContentSchema does not contain \ElevenLabs\Types\AudioSchema');
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\VoiceSchema value
   * @throws \RuntimeException if this ContentSchema does not contain a \ElevenLabs\Types\VoiceSchema
   */
  public function asVoice(): \ElevenLabs\Types\VoiceSchema
  {
    if (!$this->isVoice()) {
      throw new \RuntimeException('ContentSchema does not contain \ElevenLabs\Types\VoiceSchema');
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ObjectSchema value
   * @throws \RuntimeException if this ContentSchema does not contain a \ElevenLabs\Types\ObjectSchema
   */
  public function asObject(): \ElevenLabs\Types\ObjectSchema
  {
    if (!$this->isObject()) {
      throw new \RuntimeException('ContentSchema does not contain \ElevenLabs\Types\ObjectSchema');
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ArraySchema value
   * @throws \RuntimeException if this ContentSchema does not contain a \ElevenLabs\Types\ArraySchema
   */
  public function asArray(): \ElevenLabs\Types\ArraySchema
  {
    if (!$this->isArray()) {
      throw new \RuntimeException('ContentSchema does not contain \ElevenLabs\Types\ArraySchema');
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\StringSchema value
   * @return \ElevenLabs\Types\StringSchema|null Returns the value if this ContentSchema contains a \ElevenLabs\Types\StringSchema, null otherwise
   */
  public function tryAsString(): ?\ElevenLabs\Types\StringSchema
  {
    return $this->isString() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\NumberSchema value
   * @return \ElevenLabs\Types\NumberSchema|null Returns the value if this ContentSchema contains a \ElevenLabs\Types\NumberSchema, null otherwise
   */
  public function tryAsNumber(): ?\ElevenLabs\Types\NumberSchema
  {
    return $this->isNumber() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\IntegerSchema value
   * @return \ElevenLabs\Types\IntegerSchema|null Returns the value if this ContentSchema contains a \ElevenLabs\Types\IntegerSchema, null otherwise
   */
  public function tryAsInteger(): ?\ElevenLabs\Types\IntegerSchema
  {
    return $this->isInteger() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\BooleanSchema value
   * @return \ElevenLabs\Types\BooleanSchema|null Returns the value if this ContentSchema contains a \ElevenLabs\Types\BooleanSchema, null otherwise
   */
  public function tryAsBoolean(): ?\ElevenLabs\Types\BooleanSchema
  {
    return $this->isBoolean() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ImageSchema value
   * @return \ElevenLabs\Types\ImageSchema|null Returns the value if this ContentSchema contains a \ElevenLabs\Types\ImageSchema, null otherwise
   */
  public function tryAsImage(): ?\ElevenLabs\Types\ImageSchema
  {
    return $this->isImage() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\VideoSchema value
   * @return \ElevenLabs\Types\VideoSchema|null Returns the value if this ContentSchema contains a \ElevenLabs\Types\VideoSchema, null otherwise
   */
  public function tryAsVideo(): ?\ElevenLabs\Types\VideoSchema
  {
    return $this->isVideo() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AudioSchema value
   * @return \ElevenLabs\Types\AudioSchema|null Returns the value if this ContentSchema contains a \ElevenLabs\Types\AudioSchema, null otherwise
   */
  public function tryAsAudio(): ?\ElevenLabs\Types\AudioSchema
  {
    return $this->isAudio() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\VoiceSchema value
   * @return \ElevenLabs\Types\VoiceSchema|null Returns the value if this ContentSchema contains a \ElevenLabs\Types\VoiceSchema, null otherwise
   */
  public function tryAsVoice(): ?\ElevenLabs\Types\VoiceSchema
  {
    return $this->isVoice() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ObjectSchema value
   * @return \ElevenLabs\Types\ObjectSchema|null Returns the value if this ContentSchema contains a \ElevenLabs\Types\ObjectSchema, null otherwise
   */
  public function tryAsObject(): ?\ElevenLabs\Types\ObjectSchema
  {
    return $this->isObject() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ArraySchema value
   * @return \ElevenLabs\Types\ArraySchema|null Returns the value if this ContentSchema contains a \ElevenLabs\Types\ArraySchema, null otherwise
   */
  public function tryAsArray(): ?\ElevenLabs\Types\ArraySchema
  {
    return $this->isArray() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\StringSchema): T $onString
   * @param callable(\ElevenLabs\Types\NumberSchema): T $onNumber
   * @param callable(\ElevenLabs\Types\IntegerSchema): T $onInteger
   * @param callable(\ElevenLabs\Types\BooleanSchema): T $onBoolean
   * @param callable(\ElevenLabs\Types\ImageSchema): T $onImage
   * @param callable(\ElevenLabs\Types\VideoSchema): T $onVideo
   * @param callable(\ElevenLabs\Types\AudioSchema): T $onAudio
   * @param callable(\ElevenLabs\Types\VoiceSchema): T $onVoice
   * @param callable(\ElevenLabs\Types\ObjectSchema): T $onObject
   * @param callable(\ElevenLabs\Types\ArraySchema): T $onArray
   * @return T
   */
  public function match(
    callable $onString,
    callable $onNumber,
    callable $onInteger,
    callable $onBoolean,
    callable $onImage,
    callable $onVideo,
    callable $onAudio,
    callable $onVoice,
    callable $onObject,
    callable $onArray
  ): mixed {
    return match ($this->typeIndex) {
      0 => $onString($this->value),
      1 => $onNumber($this->value),
      2 => $onInteger($this->value),
      3 => $onBoolean($this->value),
      4 => $onImage($this->value),
      5 => $onVideo($this->value),
      6 => $onAudio($this->value),
      7 => $onVoice($this->value),
      8 => $onObject($this->value),
      9 => $onArray($this->value),
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
        case 'array':
          return new self(\ElevenLabs\Types\ArraySchema::fromArray($data), 9);
        case 'audio':
          return new self(\ElevenLabs\Types\AudioSchema::fromArray($data), 6);
        case 'boolean':
          return new self(\ElevenLabs\Types\BooleanSchema::fromArray($data), 3);
        case 'image':
          return new self(\ElevenLabs\Types\ImageSchema::fromArray($data), 4);
        case 'integer':
          return new self(\ElevenLabs\Types\IntegerSchema::fromArray($data), 2);
        case 'number':
          return new self(\ElevenLabs\Types\NumberSchema::fromArray($data), 1);
        case 'object':
          return new self(\ElevenLabs\Types\ObjectSchema::fromArray($data), 8);
        case 'string':
          return new self(\ElevenLabs\Types\StringSchema::fromArray($data), 0);
        case 'video':
          return new self(\ElevenLabs\Types\VideoSchema::fromArray($data), 5);
        case 'voice':
          return new self(\ElevenLabs\Types\VoiceSchema::fromArray($data), 7);
        default:
          // A variant the API added after this SDK was generated: kept, not rejected.
          return new self($data, self::UNKNOWN);
      }
    }

    /** @var list<array{instance: mixed, idx: int, score: int}> */
    $candidates = [];
    try {
      $candidate = \ElevenLabs\Types\StringSchema::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\StringSchema didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\NumberSchema::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\NumberSchema didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\IntegerSchema::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\IntegerSchema didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\BooleanSchema::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 3, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\BooleanSchema didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ImageSchema::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 4, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ImageSchema didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\VideoSchema::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 5, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\VideoSchema didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AudioSchema::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 6, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AudioSchema didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\VoiceSchema::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 7, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\VoiceSchema didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ObjectSchema::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 8, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ObjectSchema didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ArraySchema::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 9, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ArraySchema didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException('Data does not match any ContentSchema type');
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
