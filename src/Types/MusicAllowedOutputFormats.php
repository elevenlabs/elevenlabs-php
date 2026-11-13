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
class MusicAllowedOutputFormats extends JsonSerializableType
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
   * Create a MusicAllowedOutputFormats from multiple types
   * @param array<mixed> $values Array of type instances
   * @return self
   */
  public static function fromMultiple(array $values): self
  {
    $mappedValues = [];
    foreach ($values as $value) {
      if ($value instanceof \ElevenLabs\Types\AllowedOutputFormats) {
        $mappedValues['allowedoutputformats'] = $value;
      }
      if ($value instanceof \ElevenLabs\Types\MusicOnlyOutputFormats) {
        $mappedValues['musiconlyoutputformats'] = $value;
      }
    }
    return new self($mappedValues);
  }

  // Check presence methods
  /**
   * Check if this MusicAllowedOutputFormats contains a \ElevenLabs\Types\AllowedOutputFormats
   */
  public function hasAllowedOutputFormats(): bool
  {
    return isset($this->values['allowedoutputformats']);
  }

  /**
   * Check if this MusicAllowedOutputFormats contains a \ElevenLabs\Types\MusicOnlyOutputFormats
   */
  public function hasMusicOnlyOutputFormats(): bool
  {
    return isset($this->values['musiconlyoutputformats']);
  }

  // Getter methods
  /**
   * Get the \ElevenLabs\Types\AllowedOutputFormats value if present
   * @return \ElevenLabs\Types\AllowedOutputFormats|null
   */
  public function getAllowedOutputFormats(): ?\ElevenLabs\Types\AllowedOutputFormats
  {
    return $this->values['allowedoutputformats'] ?? null;
  }

  /**
   * Get the \ElevenLabs\Types\MusicOnlyOutputFormats value if present
   * @return \ElevenLabs\Types\MusicOnlyOutputFormats|null
   */
  public function getMusicOnlyOutputFormats(): ?\ElevenLabs\Types\MusicOnlyOutputFormats
  {
    return $this->values['musiconlyoutputformats'] ?? null;
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
    if (
      (is_string($data) || is_int($data)) &&
      ($enumValue = \ElevenLabs\Types\AllowedOutputFormats::tryFrom($data)) !== null
    ) {
      $matches['allowedoutputformats'] = $enumValue;
    }

    if (
      (is_string($data) || is_int($data)) &&
      ($enumValue = \ElevenLabs\Types\MusicOnlyOutputFormats::tryFrom($data)) !== null
    ) {
      $matches['musiconlyoutputformats'] = $enumValue;
    }

    if (empty($matches)) {
      throw new \InvalidArgumentException('Data does not match any MusicAllowedOutputFormats type');
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
