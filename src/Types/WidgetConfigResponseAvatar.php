<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;

/**
 * The avatar of the widget
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
class WidgetConfigResponseAvatar extends JsonSerializableType
{
  /**
   * @var string The discriminator value identifying which variant is stored
   */
  public readonly string $type;

  /**
   * @var \ElevenLabs\Types\OrbAvatar|\ElevenLabs\Types\UrlAvatar|\ElevenLabs\Types\ImageAvatar|array<string, mixed> The value, exactly one of the variant types
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
   * @throws \RuntimeException if this WidgetConfigResponseAvatar holds a known variant
   */
  public function _asUnknown(): array
  {
    if (!$this->_isUnknown()) {
      throw new \RuntimeException('WidgetConfigResponseAvatar does not contain an unknown variant');
    }
    /** @var array<string, mixed> $value */
    $value = $this->value;
    return $value;
  }

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\OrbAvatar|\ElevenLabs\Types\UrlAvatar|\ElevenLabs\Types\ImageAvatar|array<string, mixed> $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
    $this->type = match ($typeIndex) {
      0 => 'orb',
      1 => 'url',
      2 => 'image',
      self::UNKNOWN => '_unknown',
      default => throw new \UnexpectedValueException("Unknown type index: $typeIndex")
    };
  }

  // Factory methods
  /**
   * Create a WidgetConfigResponseAvatar instance containing a \ElevenLabs\Types\OrbAvatar
   */
  public static function orb(\ElevenLabs\Types\OrbAvatar $orb): self
  {
    return new self($orb, 0);
  }

  /**
   * Create a WidgetConfigResponseAvatar instance containing a \ElevenLabs\Types\UrlAvatar
   */
  public static function url(\ElevenLabs\Types\UrlAvatar $url): self
  {
    return new self($url, 1);
  }

  /**
   * Create a WidgetConfigResponseAvatar instance containing a \ElevenLabs\Types\ImageAvatar
   */
  public static function image(\ElevenLabs\Types\ImageAvatar $image): self
  {
    return new self($image, 2);
  }

  // Type checking methods
  /**
   * Check if this WidgetConfigResponseAvatar contains a \ElevenLabs\Types\OrbAvatar
   */
  public function isOrb(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this WidgetConfigResponseAvatar contains a \ElevenLabs\Types\UrlAvatar
   */
  public function isUrl(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this WidgetConfigResponseAvatar contains a \ElevenLabs\Types\ImageAvatar
   */
  public function isImage(): bool
  {
    return $this->typeIndex === 2;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\OrbAvatar value
   * @throws \RuntimeException if this WidgetConfigResponseAvatar does not contain a \ElevenLabs\Types\OrbAvatar
   */
  public function asOrb(): \ElevenLabs\Types\OrbAvatar
  {
    if (!$this->isOrb()) {
      throw new \RuntimeException(
        'WidgetConfigResponseAvatar does not contain \ElevenLabs\Types\OrbAvatar'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\UrlAvatar value
   * @throws \RuntimeException if this WidgetConfigResponseAvatar does not contain a \ElevenLabs\Types\UrlAvatar
   */
  public function asUrl(): \ElevenLabs\Types\UrlAvatar
  {
    if (!$this->isUrl()) {
      throw new \RuntimeException(
        'WidgetConfigResponseAvatar does not contain \ElevenLabs\Types\UrlAvatar'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ImageAvatar value
   * @throws \RuntimeException if this WidgetConfigResponseAvatar does not contain a \ElevenLabs\Types\ImageAvatar
   */
  public function asImage(): \ElevenLabs\Types\ImageAvatar
  {
    if (!$this->isImage()) {
      throw new \RuntimeException(
        'WidgetConfigResponseAvatar does not contain \ElevenLabs\Types\ImageAvatar'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\OrbAvatar value
   * @return \ElevenLabs\Types\OrbAvatar|null Returns the value if this WidgetConfigResponseAvatar contains a \ElevenLabs\Types\OrbAvatar, null otherwise
   */
  public function tryAsOrb(): ?\ElevenLabs\Types\OrbAvatar
  {
    return $this->isOrb() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\UrlAvatar value
   * @return \ElevenLabs\Types\UrlAvatar|null Returns the value if this WidgetConfigResponseAvatar contains a \ElevenLabs\Types\UrlAvatar, null otherwise
   */
  public function tryAsUrl(): ?\ElevenLabs\Types\UrlAvatar
  {
    return $this->isUrl() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ImageAvatar value
   * @return \ElevenLabs\Types\ImageAvatar|null Returns the value if this WidgetConfigResponseAvatar contains a \ElevenLabs\Types\ImageAvatar, null otherwise
   */
  public function tryAsImage(): ?\ElevenLabs\Types\ImageAvatar
  {
    return $this->isImage() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\OrbAvatar): T $onOrb
   * @param callable(\ElevenLabs\Types\UrlAvatar): T $onUrl
   * @param callable(\ElevenLabs\Types\ImageAvatar): T $onImage
   * @return T
   */
  public function match(callable $onOrb, callable $onUrl, callable $onImage): mixed
  {
    return match ($this->typeIndex) {
      0 => $onOrb($this->value),
      1 => $onUrl($this->value),
      2 => $onImage($this->value),
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
        case 'orb':
          return new self(\ElevenLabs\Types\OrbAvatar::fromArray($data), 0);
        case 'url':
          return new self(\ElevenLabs\Types\UrlAvatar::fromArray($data), 1);
        case 'image':
          return new self(\ElevenLabs\Types\ImageAvatar::fromArray($data), 2);
        default:
          // A variant the API added after this SDK was generated: kept, not rejected.
          return new self($data, self::UNKNOWN);
      }
    }

    /** @var list<array{instance: mixed, idx: int, score: int}> */
    $candidates = [];
    try {
      $candidate = \ElevenLabs\Types\OrbAvatar::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\OrbAvatar didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\UrlAvatar::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\UrlAvatar didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ImageAvatar::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ImageAvatar didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException(
        'Data does not match any WidgetConfigResponseAvatar type'
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
