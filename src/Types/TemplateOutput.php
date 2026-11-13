<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;

/**
 * One output of a template run, discriminated on `type`: the `type` of the
 * port's `content_schema`. Check `status` for where it is in its lifecycle.
 */
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
class TemplateOutput extends JsonSerializableType
{
  /**
   * @var string The discriminator value identifying which variant is stored
   */
  public readonly string $type;

  /**
   * @var \ElevenLabs\Types\TemplateImageOutput|\ElevenLabs\Types\TemplateVideoOutput|\ElevenLabs\Types\TemplateAudioOutput|\ElevenLabs\Types\TemplateStringOutput|\ElevenLabs\Types\TemplateIntegerOutput|\ElevenLabs\Types\TemplateNumberOutput|\ElevenLabs\Types\TemplateBooleanOutput|\ElevenLabs\Types\TemplateArrayOutput|\ElevenLabs\Types\TemplateObjectOutput|array<string, mixed> The value, exactly one of the variant types
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
   * @throws \RuntimeException if this TemplateOutput holds a known variant
   */
  public function _asUnknown(): array
  {
    if (!$this->_isUnknown()) {
      throw new \RuntimeException('TemplateOutput does not contain an unknown variant');
    }
    /** @var array<string, mixed> $value */
    $value = $this->value;
    return $value;
  }

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\TemplateImageOutput|\ElevenLabs\Types\TemplateVideoOutput|\ElevenLabs\Types\TemplateAudioOutput|\ElevenLabs\Types\TemplateStringOutput|\ElevenLabs\Types\TemplateIntegerOutput|\ElevenLabs\Types\TemplateNumberOutput|\ElevenLabs\Types\TemplateBooleanOutput|\ElevenLabs\Types\TemplateArrayOutput|\ElevenLabs\Types\TemplateObjectOutput|array<string, mixed> $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
    $this->type = match ($typeIndex) {
      0 => 'image',
      1 => 'video',
      2 => 'audio',
      3 => 'string',
      4 => 'integer',
      5 => 'number',
      6 => 'boolean',
      7 => 'array',
      8 => 'object',
      self::UNKNOWN => '_unknown',
      default => throw new \UnexpectedValueException("Unknown type index: $typeIndex")
    };
  }

  // Factory methods
  /**
   * Create a TemplateOutput instance containing a \ElevenLabs\Types\TemplateImageOutput
   */
  public static function image(\ElevenLabs\Types\TemplateImageOutput $image): self
  {
    return new self($image, 0);
  }

  /**
   * Create a TemplateOutput instance containing a \ElevenLabs\Types\TemplateVideoOutput
   */
  public static function video(\ElevenLabs\Types\TemplateVideoOutput $video): self
  {
    return new self($video, 1);
  }

  /**
   * Create a TemplateOutput instance containing a \ElevenLabs\Types\TemplateAudioOutput
   */
  public static function audio(\ElevenLabs\Types\TemplateAudioOutput $audio): self
  {
    return new self($audio, 2);
  }

  /**
   * Create a TemplateOutput instance containing a \ElevenLabs\Types\TemplateStringOutput
   */
  public static function string(\ElevenLabs\Types\TemplateStringOutput $string): self
  {
    return new self($string, 3);
  }

  /**
   * Create a TemplateOutput instance containing a \ElevenLabs\Types\TemplateIntegerOutput
   */
  public static function integer(\ElevenLabs\Types\TemplateIntegerOutput $integer): self
  {
    return new self($integer, 4);
  }

  /**
   * Create a TemplateOutput instance containing a \ElevenLabs\Types\TemplateNumberOutput
   */
  public static function number(\ElevenLabs\Types\TemplateNumberOutput $number): self
  {
    return new self($number, 5);
  }

  /**
   * Create a TemplateOutput instance containing a \ElevenLabs\Types\TemplateBooleanOutput
   */
  public static function boolean(\ElevenLabs\Types\TemplateBooleanOutput $boolean): self
  {
    return new self($boolean, 6);
  }

  /**
   * Create a TemplateOutput instance containing a \ElevenLabs\Types\TemplateArrayOutput
   */
  public static function array(\ElevenLabs\Types\TemplateArrayOutput $array): self
  {
    return new self($array, 7);
  }

  /**
   * Create a TemplateOutput instance containing a \ElevenLabs\Types\TemplateObjectOutput
   */
  public static function object(\ElevenLabs\Types\TemplateObjectOutput $object): self
  {
    return new self($object, 8);
  }

  // Type checking methods
  /**
   * Check if this TemplateOutput contains a \ElevenLabs\Types\TemplateImageOutput
   */
  public function isImage(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this TemplateOutput contains a \ElevenLabs\Types\TemplateVideoOutput
   */
  public function isVideo(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this TemplateOutput contains a \ElevenLabs\Types\TemplateAudioOutput
   */
  public function isAudio(): bool
  {
    return $this->typeIndex === 2;
  }

  /**
   * Check if this TemplateOutput contains a \ElevenLabs\Types\TemplateStringOutput
   */
  public function isString(): bool
  {
    return $this->typeIndex === 3;
  }

  /**
   * Check if this TemplateOutput contains a \ElevenLabs\Types\TemplateIntegerOutput
   */
  public function isInteger(): bool
  {
    return $this->typeIndex === 4;
  }

  /**
   * Check if this TemplateOutput contains a \ElevenLabs\Types\TemplateNumberOutput
   */
  public function isNumber(): bool
  {
    return $this->typeIndex === 5;
  }

  /**
   * Check if this TemplateOutput contains a \ElevenLabs\Types\TemplateBooleanOutput
   */
  public function isBoolean(): bool
  {
    return $this->typeIndex === 6;
  }

  /**
   * Check if this TemplateOutput contains a \ElevenLabs\Types\TemplateArrayOutput
   */
  public function isArray(): bool
  {
    return $this->typeIndex === 7;
  }

  /**
   * Check if this TemplateOutput contains a \ElevenLabs\Types\TemplateObjectOutput
   */
  public function isObject(): bool
  {
    return $this->typeIndex === 8;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\TemplateImageOutput value
   * @throws \RuntimeException if this TemplateOutput does not contain a \ElevenLabs\Types\TemplateImageOutput
   */
  public function asImage(): \ElevenLabs\Types\TemplateImageOutput
  {
    if (!$this->isImage()) {
      throw new \RuntimeException(
        'TemplateOutput does not contain \ElevenLabs\Types\TemplateImageOutput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\TemplateVideoOutput value
   * @throws \RuntimeException if this TemplateOutput does not contain a \ElevenLabs\Types\TemplateVideoOutput
   */
  public function asVideo(): \ElevenLabs\Types\TemplateVideoOutput
  {
    if (!$this->isVideo()) {
      throw new \RuntimeException(
        'TemplateOutput does not contain \ElevenLabs\Types\TemplateVideoOutput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\TemplateAudioOutput value
   * @throws \RuntimeException if this TemplateOutput does not contain a \ElevenLabs\Types\TemplateAudioOutput
   */
  public function asAudio(): \ElevenLabs\Types\TemplateAudioOutput
  {
    if (!$this->isAudio()) {
      throw new \RuntimeException(
        'TemplateOutput does not contain \ElevenLabs\Types\TemplateAudioOutput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\TemplateStringOutput value
   * @throws \RuntimeException if this TemplateOutput does not contain a \ElevenLabs\Types\TemplateStringOutput
   */
  public function asString(): \ElevenLabs\Types\TemplateStringOutput
  {
    if (!$this->isString()) {
      throw new \RuntimeException(
        'TemplateOutput does not contain \ElevenLabs\Types\TemplateStringOutput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\TemplateIntegerOutput value
   * @throws \RuntimeException if this TemplateOutput does not contain a \ElevenLabs\Types\TemplateIntegerOutput
   */
  public function asInteger(): \ElevenLabs\Types\TemplateIntegerOutput
  {
    if (!$this->isInteger()) {
      throw new \RuntimeException(
        'TemplateOutput does not contain \ElevenLabs\Types\TemplateIntegerOutput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\TemplateNumberOutput value
   * @throws \RuntimeException if this TemplateOutput does not contain a \ElevenLabs\Types\TemplateNumberOutput
   */
  public function asNumber(): \ElevenLabs\Types\TemplateNumberOutput
  {
    if (!$this->isNumber()) {
      throw new \RuntimeException(
        'TemplateOutput does not contain \ElevenLabs\Types\TemplateNumberOutput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\TemplateBooleanOutput value
   * @throws \RuntimeException if this TemplateOutput does not contain a \ElevenLabs\Types\TemplateBooleanOutput
   */
  public function asBoolean(): \ElevenLabs\Types\TemplateBooleanOutput
  {
    if (!$this->isBoolean()) {
      throw new \RuntimeException(
        'TemplateOutput does not contain \ElevenLabs\Types\TemplateBooleanOutput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\TemplateArrayOutput value
   * @throws \RuntimeException if this TemplateOutput does not contain a \ElevenLabs\Types\TemplateArrayOutput
   */
  public function asArray(): \ElevenLabs\Types\TemplateArrayOutput
  {
    if (!$this->isArray()) {
      throw new \RuntimeException(
        'TemplateOutput does not contain \ElevenLabs\Types\TemplateArrayOutput'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\TemplateObjectOutput value
   * @throws \RuntimeException if this TemplateOutput does not contain a \ElevenLabs\Types\TemplateObjectOutput
   */
  public function asObject(): \ElevenLabs\Types\TemplateObjectOutput
  {
    if (!$this->isObject()) {
      throw new \RuntimeException(
        'TemplateOutput does not contain \ElevenLabs\Types\TemplateObjectOutput'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\TemplateImageOutput value
   * @return \ElevenLabs\Types\TemplateImageOutput|null Returns the value if this TemplateOutput contains a \ElevenLabs\Types\TemplateImageOutput, null otherwise
   */
  public function tryAsImage(): ?\ElevenLabs\Types\TemplateImageOutput
  {
    return $this->isImage() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\TemplateVideoOutput value
   * @return \ElevenLabs\Types\TemplateVideoOutput|null Returns the value if this TemplateOutput contains a \ElevenLabs\Types\TemplateVideoOutput, null otherwise
   */
  public function tryAsVideo(): ?\ElevenLabs\Types\TemplateVideoOutput
  {
    return $this->isVideo() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\TemplateAudioOutput value
   * @return \ElevenLabs\Types\TemplateAudioOutput|null Returns the value if this TemplateOutput contains a \ElevenLabs\Types\TemplateAudioOutput, null otherwise
   */
  public function tryAsAudio(): ?\ElevenLabs\Types\TemplateAudioOutput
  {
    return $this->isAudio() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\TemplateStringOutput value
   * @return \ElevenLabs\Types\TemplateStringOutput|null Returns the value if this TemplateOutput contains a \ElevenLabs\Types\TemplateStringOutput, null otherwise
   */
  public function tryAsString(): ?\ElevenLabs\Types\TemplateStringOutput
  {
    return $this->isString() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\TemplateIntegerOutput value
   * @return \ElevenLabs\Types\TemplateIntegerOutput|null Returns the value if this TemplateOutput contains a \ElevenLabs\Types\TemplateIntegerOutput, null otherwise
   */
  public function tryAsInteger(): ?\ElevenLabs\Types\TemplateIntegerOutput
  {
    return $this->isInteger() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\TemplateNumberOutput value
   * @return \ElevenLabs\Types\TemplateNumberOutput|null Returns the value if this TemplateOutput contains a \ElevenLabs\Types\TemplateNumberOutput, null otherwise
   */
  public function tryAsNumber(): ?\ElevenLabs\Types\TemplateNumberOutput
  {
    return $this->isNumber() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\TemplateBooleanOutput value
   * @return \ElevenLabs\Types\TemplateBooleanOutput|null Returns the value if this TemplateOutput contains a \ElevenLabs\Types\TemplateBooleanOutput, null otherwise
   */
  public function tryAsBoolean(): ?\ElevenLabs\Types\TemplateBooleanOutput
  {
    return $this->isBoolean() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\TemplateArrayOutput value
   * @return \ElevenLabs\Types\TemplateArrayOutput|null Returns the value if this TemplateOutput contains a \ElevenLabs\Types\TemplateArrayOutput, null otherwise
   */
  public function tryAsArray(): ?\ElevenLabs\Types\TemplateArrayOutput
  {
    return $this->isArray() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\TemplateObjectOutput value
   * @return \ElevenLabs\Types\TemplateObjectOutput|null Returns the value if this TemplateOutput contains a \ElevenLabs\Types\TemplateObjectOutput, null otherwise
   */
  public function tryAsObject(): ?\ElevenLabs\Types\TemplateObjectOutput
  {
    return $this->isObject() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\TemplateImageOutput): T $onImage
   * @param callable(\ElevenLabs\Types\TemplateVideoOutput): T $onVideo
   * @param callable(\ElevenLabs\Types\TemplateAudioOutput): T $onAudio
   * @param callable(\ElevenLabs\Types\TemplateStringOutput): T $onString
   * @param callable(\ElevenLabs\Types\TemplateIntegerOutput): T $onInteger
   * @param callable(\ElevenLabs\Types\TemplateNumberOutput): T $onNumber
   * @param callable(\ElevenLabs\Types\TemplateBooleanOutput): T $onBoolean
   * @param callable(\ElevenLabs\Types\TemplateArrayOutput): T $onArray
   * @param callable(\ElevenLabs\Types\TemplateObjectOutput): T $onObject
   * @return T
   */
  public function match(
    callable $onImage,
    callable $onVideo,
    callable $onAudio,
    callable $onString,
    callable $onInteger,
    callable $onNumber,
    callable $onBoolean,
    callable $onArray,
    callable $onObject
  ): mixed {
    return match ($this->typeIndex) {
      0 => $onImage($this->value),
      1 => $onVideo($this->value),
      2 => $onAudio($this->value),
      3 => $onString($this->value),
      4 => $onInteger($this->value),
      5 => $onNumber($this->value),
      6 => $onBoolean($this->value),
      7 => $onArray($this->value),
      8 => $onObject($this->value),
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
          return new self(\ElevenLabs\Types\TemplateArrayOutput::fromArray($data), 7);
        case 'audio':
          return new self(\ElevenLabs\Types\TemplateAudioOutput::fromArray($data), 2);
        case 'boolean':
          return new self(\ElevenLabs\Types\TemplateBooleanOutput::fromArray($data), 6);
        case 'image':
          return new self(\ElevenLabs\Types\TemplateImageOutput::fromArray($data), 0);
        case 'integer':
          return new self(\ElevenLabs\Types\TemplateIntegerOutput::fromArray($data), 4);
        case 'number':
          return new self(\ElevenLabs\Types\TemplateNumberOutput::fromArray($data), 5);
        case 'object':
          return new self(\ElevenLabs\Types\TemplateObjectOutput::fromArray($data), 8);
        case 'string':
          return new self(\ElevenLabs\Types\TemplateStringOutput::fromArray($data), 3);
        case 'video':
          return new self(\ElevenLabs\Types\TemplateVideoOutput::fromArray($data), 1);
        default:
          // A variant the API added after this SDK was generated: kept, not rejected.
          return new self($data, self::UNKNOWN);
      }
    }

    /** @var list<array{instance: mixed, idx: int, score: int}> */
    $candidates = [];
    try {
      $candidate = \ElevenLabs\Types\TemplateImageOutput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\TemplateImageOutput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\TemplateVideoOutput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\TemplateVideoOutput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\TemplateAudioOutput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\TemplateAudioOutput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\TemplateStringOutput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 3, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\TemplateStringOutput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\TemplateIntegerOutput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 4, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\TemplateIntegerOutput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\TemplateNumberOutput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 5, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\TemplateNumberOutput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\TemplateBooleanOutput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 6, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\TemplateBooleanOutput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\TemplateArrayOutput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 7, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\TemplateArrayOutput didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\TemplateObjectOutput::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 8, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\TemplateObjectOutput didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException('Data does not match any TemplateOutput type');
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
