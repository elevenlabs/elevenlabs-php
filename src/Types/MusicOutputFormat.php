<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;

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
class MusicOutputFormat extends JsonSerializableType
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
   * Create a MusicOutputFormat from multiple types
   * @param array<mixed> $values Array of type instances
   * @return self
   */
  public static function fromMultiple(array $values): self
  {
    $mappedValues = [];
    foreach ($values as $value) {
      if ($value instanceof \ElevenLabs\Types\MusicAllowedOutputFormats) {
        $mappedValues['musicallowedoutputformats'] = $value;
      }
      if ($value instanceof \ElevenLabs\Types\MusicOutputFormat2) {
        $mappedValues['musicoutputformat2'] = $value;
      }
    }
    return new self($mappedValues);
  }

  // Check presence methods
  /**
   * Check if this MusicOutputFormat contains a \ElevenLabs\Types\MusicAllowedOutputFormats
   */
  public function hasMusicAllowedOutputFormats(): bool
  {
    return isset($this->values['musicallowedoutputformats']);
  }

  /**
   * Check if this MusicOutputFormat contains a \ElevenLabs\Types\MusicOutputFormat2
   */
  public function hasMusicOutputFormat2(): bool
  {
    return isset($this->values['musicoutputformat2']);
  }

  // Getter methods
  /**
   * Get the \ElevenLabs\Types\MusicAllowedOutputFormats value if present
   * @return \ElevenLabs\Types\MusicAllowedOutputFormats|null
   */
  public function getMusicAllowedOutputFormats(): ?\ElevenLabs\Types\MusicAllowedOutputFormats
  {
    return $this->values['musicallowedoutputformats'] ?? null;
  }

  /**
   * Get the \ElevenLabs\Types\MusicOutputFormat2 value if present
   * @return \ElevenLabs\Types\MusicOutputFormat2|null
   */
  public function getMusicOutputFormat2(): ?\ElevenLabs\Types\MusicOutputFormat2
  {
    return $this->values['musicoutputformat2'] ?? null;
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
      $matches[
        'musicallowedoutputformats'
      ] = \ElevenLabs\Types\MusicAllowedOutputFormats::fromArray($data);
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\MusicAllowedOutputFormats didn't match, continue
    }

    if (
      (is_string($data) || is_int($data)) &&
      ($enumValue = \ElevenLabs\Types\MusicOutputFormat2::tryFrom($data)) !== null
    ) {
      $matches['musicoutputformat2'] = $enumValue;
    }

    if (empty($matches)) {
      throw new \InvalidArgumentException('Data does not match any MusicOutputFormat type');
    }

    return new self($matches);
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
