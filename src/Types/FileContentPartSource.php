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
class FileContentPartSource extends JsonSerializableType
{
  /**
   * @var string The discriminator value identifying which variant is stored
   */
  public readonly string $type;

  /**
   * @var \ElevenLabs\Types\Base64FileSource|\ElevenLabs\Types\FileIdSource|array<string, mixed> The value, exactly one of the variant types
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
   * @throws \RuntimeException if this FileContentPartSource holds a known variant
   */
  public function _asUnknown(): array
  {
    if (!$this->_isUnknown()) {
      throw new \RuntimeException('FileContentPartSource does not contain an unknown variant');
    }
    /** @var array<string, mixed> $value */
    $value = $this->value;
    return $value;
  }

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\Base64FileSource|\ElevenLabs\Types\FileIdSource|array<string, mixed> $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
    $this->type = match ($typeIndex) {
      0 => 'base64',
      1 => 'file_id',
      self::UNKNOWN => '_unknown',
      default => throw new \UnexpectedValueException("Unknown type index: $typeIndex")
    };
  }

  // Factory methods
  /**
   * Create a FileContentPartSource instance containing a \ElevenLabs\Types\Base64FileSource
   */
  public static function base64(\ElevenLabs\Types\Base64FileSource $base64): self
  {
    return new self($base64, 0);
  }

  /**
   * Create a FileContentPartSource instance containing a \ElevenLabs\Types\FileIdSource
   */
  public static function fileId(\ElevenLabs\Types\FileIdSource $fileId): self
  {
    return new self($fileId, 1);
  }

  // Type checking methods
  /**
   * Check if this FileContentPartSource contains a \ElevenLabs\Types\Base64FileSource
   */
  public function isBase64(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this FileContentPartSource contains a \ElevenLabs\Types\FileIdSource
   */
  public function isFileId(): bool
  {
    return $this->typeIndex === 1;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\Base64FileSource value
   * @throws \RuntimeException if this FileContentPartSource does not contain a \ElevenLabs\Types\Base64FileSource
   */
  public function asBase64(): \ElevenLabs\Types\Base64FileSource
  {
    if (!$this->isBase64()) {
      throw new \RuntimeException(
        'FileContentPartSource does not contain \ElevenLabs\Types\Base64FileSource'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\FileIdSource value
   * @throws \RuntimeException if this FileContentPartSource does not contain a \ElevenLabs\Types\FileIdSource
   */
  public function asFileId(): \ElevenLabs\Types\FileIdSource
  {
    if (!$this->isFileId()) {
      throw new \RuntimeException(
        'FileContentPartSource does not contain \ElevenLabs\Types\FileIdSource'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\Base64FileSource value
   * @return \ElevenLabs\Types\Base64FileSource|null Returns the value if this FileContentPartSource contains a \ElevenLabs\Types\Base64FileSource, null otherwise
   */
  public function tryAsBase64(): ?\ElevenLabs\Types\Base64FileSource
  {
    return $this->isBase64() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\FileIdSource value
   * @return \ElevenLabs\Types\FileIdSource|null Returns the value if this FileContentPartSource contains a \ElevenLabs\Types\FileIdSource, null otherwise
   */
  public function tryAsFileId(): ?\ElevenLabs\Types\FileIdSource
  {
    return $this->isFileId() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\Base64FileSource): T $onBase64
   * @param callable(\ElevenLabs\Types\FileIdSource): T $onFileId
   * @return T
   */
  public function match(callable $onBase64, callable $onFileId): mixed
  {
    return match ($this->typeIndex) {
      0 => $onBase64($this->value),
      1 => $onFileId($this->value),
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
        case 'base64':
          return new self(\ElevenLabs\Types\Base64FileSource::fromArray($data), 0);
        case 'file_id':
          return new self(\ElevenLabs\Types\FileIdSource::fromArray($data), 1);
        default:
          // A variant the API added after this SDK was generated: kept, not rejected.
          return new self($data, self::UNKNOWN);
      }
    }

    /** @var list<array{instance: mixed, idx: int, score: int}> */
    $candidates = [];
    try {
      $candidate = \ElevenLabs\Types\Base64FileSource::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\Base64FileSource didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\FileIdSource::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\FileIdSource didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException('Data does not match any FileContentPartSource type');
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
