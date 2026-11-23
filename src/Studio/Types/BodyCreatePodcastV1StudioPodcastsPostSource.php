<?php

declare(strict_types=1);

namespace ElevenLabs\Studio\Types;

use ElevenLabs\Core\Json\JsonSerializableType;

/**
 * The source content for the Podcast.
 */
/**
 * Union type (anyOf) representing one or more of multiple possible types simultaneously.
 *
 * This class implements a type-safe union where the value can match multiple variant
 * types at the same time. It provides factory methods for construction, presence-checking
 * methods, and getters for accessing each matched type.
 *
 * The anyOf pattern differs from oneOf by allowing multiple types to be present
 * simultaneously. During deserialization, all types that successfully match the
 * input data are stored.
 */
class BodyCreatePodcastV1StudioPodcastsPostSource extends JsonSerializableType
{
  /**
   * @var array<string, mixed> Internal storage for all matched types (keyed by variant)
   */
  private array $values = [];

  /**
   * Private constructor - use factory methods to create instances
   * @param array<string, mixed> $values
   */
  private function __construct(array $values)
  {
    $this->values = $values;
  }

  /**
   * Create a BodyCreatePodcastV1StudioPodcastsPostSource from multiple types
   * @param array<mixed> $values Array of type instances
   * @return self
   */
  public static function fromMultiple(array $values): self
  {
    $mappedValues = [];
    foreach ($values as $value) {
      if ($value instanceof \ElevenLabs\Types\PodcastTextSource) {
        $mappedValues['podcasttextsource'] = $value;
      }
      if ($value instanceof \ElevenLabs\Types\PodcastUrlSource) {
        $mappedValues['podcasturlsource'] = $value;
      }
      if (is_array($value) && array_is_list($value)) {
        $mappedValues['array'] = $value;
      }
    }
    return new self($mappedValues);
  }

  // Check presence methods
  /**
   * Check if this BodyCreatePodcastV1StudioPodcastsPostSource contains a \ElevenLabs\Types\PodcastTextSource
   */
  public function hasPodcastTextSource(): bool
  {
    return isset($this->values['podcasttextsource']);
  }

  /**
   * Check if this BodyCreatePodcastV1StudioPodcastsPostSource contains a \ElevenLabs\Types\PodcastUrlSource
   */
  public function hasPodcastUrlSource(): bool
  {
    return isset($this->values['podcasturlsource']);
  }

  /**
   * Check if this BodyCreatePodcastV1StudioPodcastsPostSource contains a array
   */
  public function hasArray(): bool
  {
    return isset($this->values['array']);
  }

  // Getter methods
  /**
   * Get the \ElevenLabs\Types\PodcastTextSource value if present
   * @return \ElevenLabs\Types\PodcastTextSource|null
   */
  public function getPodcastTextSource(): ?\ElevenLabs\Types\PodcastTextSource
  {
    return $this->values['podcasttextsource'] ?? null;
  }

  /**
   * Get the \ElevenLabs\Types\PodcastUrlSource value if present
   * @return \ElevenLabs\Types\PodcastUrlSource|null
   */
  public function getPodcastUrlSource(): ?\ElevenLabs\Types\PodcastUrlSource
  {
    return $this->values['podcasturlsource'] ?? null;
  }

  /**
   * Get the array value if present
   * @return array|null
   */
  public function getArray(): ?array
  {
    return $this->values['array'] ?? null;
  }

  /**
   * Get all matched types
   * @return array<mixed>
   */
  public function getAllMatches(): array
  {
    return array_values($this->values);
  }

  /**
   * Deserialize from array - try all types, keep successful ones
   * @param mixed $data
   * @return self
   * @throws \InvalidArgumentException if data doesn't match any type
   */
  public static function fromArray(mixed $data): self
  {
    $matches = [];

    // Try each type and collect successful matches
    try {
      $matches['podcasttextsource'] = \ElevenLabs\Types\PodcastTextSource::fromArray($data);
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\PodcastTextSource didn't match, continue
    }

    try {
      $matches['podcasturlsource'] = \ElevenLabs\Types\PodcastUrlSource::fromArray($data);
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\PodcastUrlSource didn't match, continue
    }

    if (is_array($data) && array_is_list($data)) {
      $matches['array'] = $data;
    }

    if (empty($matches)) {
      throw new \InvalidArgumentException(
        'Data does not match any BodyCreatePodcastV1StudioPodcastsPostSource type'
      );
    }

    return new self($matches);
  }

  protected function encodesEmptyArrayAsList(): bool
  {
    return array_key_exists('array', $this->values);
  }

  /**
   * Serialize to JSON - merge all values
   */
  public function jsonSerialize(): mixed
  {
    $result = [];
    foreach ($this->values as $value) {
      // A scalar or enum match is the whole value; there is nothing to merge it with.
      if ($value instanceof \BackedEnum) {
        return $value->value;
      }
      if (!is_object($value) && !is_array($value)) {
        return $value;
      }
      if ($value instanceof \JsonSerializable) {
        $serialized = $value->jsonSerialize();
      } elseif (is_array($value)) {
        $serialized = $value;
      } else {
        $serialized = get_object_vars($value);
      }

      if (is_array($serialized)) {
        $result = array_merge($result, $serialized);
      }
    }
    return $result;
  }
}
