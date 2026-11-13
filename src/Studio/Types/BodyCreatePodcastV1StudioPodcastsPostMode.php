<?php

declare(strict_types=1);

namespace ElevenLabs\Studio\Types;

use ElevenLabs\Core\Json\JsonSerializableType;

/**
 * The type of podcast to generate. Can be 'conversation', an interaction between two voices, or 'bulletin', a monologue.
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
class BodyCreatePodcastV1StudioPodcastsPostMode extends JsonSerializableType
{
  /**
   * @var string The discriminator value identifying which variant is stored
   */
  public readonly string $type;

  /**
   * @var \ElevenLabs\Types\PodcastConversationMode|\ElevenLabs\Types\PodcastBulletinMode|array<string, mixed> The value, exactly one of the variant types
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
   * @throws \RuntimeException if this BodyCreatePodcastV1StudioPodcastsPostMode holds a known variant
   */
  public function _asUnknown(): array
  {
    if (!$this->_isUnknown()) {
      throw new \RuntimeException(
        'BodyCreatePodcastV1StudioPodcastsPostMode does not contain an unknown variant'
      );
    }
    /** @var array<string, mixed> $value */
    $value = $this->value;
    return $value;
  }

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\PodcastConversationMode|\ElevenLabs\Types\PodcastBulletinMode|array<string, mixed> $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
    $this->type = match ($typeIndex) {
      0 => 'conversation',
      1 => 'bulletin',
      self::UNKNOWN => '_unknown',
      default => throw new \UnexpectedValueException("Unknown type index: $typeIndex")
    };
  }

  // Factory methods
  /**
   * Create a BodyCreatePodcastV1StudioPodcastsPostMode instance containing a \ElevenLabs\Types\PodcastConversationMode
   */
  public static function conversation(\ElevenLabs\Types\PodcastConversationMode $conversation): self
  {
    return new self($conversation, 0);
  }

  /**
   * Create a BodyCreatePodcastV1StudioPodcastsPostMode instance containing a \ElevenLabs\Types\PodcastBulletinMode
   */
  public static function bulletin(\ElevenLabs\Types\PodcastBulletinMode $bulletin): self
  {
    return new self($bulletin, 1);
  }

  // Type checking methods
  /**
   * Check if this BodyCreatePodcastV1StudioPodcastsPostMode contains a \ElevenLabs\Types\PodcastConversationMode
   */
  public function isConversation(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this BodyCreatePodcastV1StudioPodcastsPostMode contains a \ElevenLabs\Types\PodcastBulletinMode
   */
  public function isBulletin(): bool
  {
    return $this->typeIndex === 1;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\PodcastConversationMode value
   * @throws \RuntimeException if this BodyCreatePodcastV1StudioPodcastsPostMode does not contain a \ElevenLabs\Types\PodcastConversationMode
   */
  public function asConversation(): \ElevenLabs\Types\PodcastConversationMode
  {
    if (!$this->isConversation()) {
      throw new \RuntimeException(
        'BodyCreatePodcastV1StudioPodcastsPostMode does not contain \ElevenLabs\Types\PodcastConversationMode'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\PodcastBulletinMode value
   * @throws \RuntimeException if this BodyCreatePodcastV1StudioPodcastsPostMode does not contain a \ElevenLabs\Types\PodcastBulletinMode
   */
  public function asBulletin(): \ElevenLabs\Types\PodcastBulletinMode
  {
    if (!$this->isBulletin()) {
      throw new \RuntimeException(
        'BodyCreatePodcastV1StudioPodcastsPostMode does not contain \ElevenLabs\Types\PodcastBulletinMode'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\PodcastConversationMode value
   * @return \ElevenLabs\Types\PodcastConversationMode|null Returns the value if this BodyCreatePodcastV1StudioPodcastsPostMode contains a \ElevenLabs\Types\PodcastConversationMode, null otherwise
   */
  public function tryAsConversation(): ?\ElevenLabs\Types\PodcastConversationMode
  {
    return $this->isConversation() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\PodcastBulletinMode value
   * @return \ElevenLabs\Types\PodcastBulletinMode|null Returns the value if this BodyCreatePodcastV1StudioPodcastsPostMode contains a \ElevenLabs\Types\PodcastBulletinMode, null otherwise
   */
  public function tryAsBulletin(): ?\ElevenLabs\Types\PodcastBulletinMode
  {
    return $this->isBulletin() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\PodcastConversationMode): T $onConversation
   * @param callable(\ElevenLabs\Types\PodcastBulletinMode): T $onBulletin
   * @return T
   */
  public function match(callable $onConversation, callable $onBulletin): mixed
  {
    return match ($this->typeIndex) {
      0 => $onConversation($this->value),
      1 => $onBulletin($this->value),
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
        case 'conversation':
          return new self(\ElevenLabs\Types\PodcastConversationMode::fromArray($data), 0);
        case 'bulletin':
          return new self(\ElevenLabs\Types\PodcastBulletinMode::fromArray($data), 1);
        default:
          // A variant the API added after this SDK was generated: kept, not rejected.
          return new self($data, self::UNKNOWN);
      }
    }

    /** @var list<array{instance: mixed, idx: int, score: int}> */
    $candidates = [];
    try {
      $candidate = \ElevenLabs\Types\PodcastConversationMode::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\PodcastConversationMode didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\PodcastBulletinMode::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\PodcastBulletinMode didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException(
        'Data does not match any BodyCreatePodcastV1StudioPodcastsPostMode type'
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
