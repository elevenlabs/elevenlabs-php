<?php

declare(strict_types=1);

namespace ElevenLabs\Dubbing\Project\Types;

use ElevenLabs\Core\Json\JsonSerializableType;

/**
 * Dubbing model (`dubbing_v1` or `dubbing_v2`) every language target of this project is dubbed with. Defaults to `dubbing_v2`. Fixed at create time — the source is prepared for this model, so neither the project nor an individual target can change it later.
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
class CreateProjectRequestModelId extends JsonSerializableType
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
   * Create a CreateProjectRequestModelId from multiple types
   * @param array<mixed> $values Array of type instances
   * @return self
   */
  public static function fromMultiple(array $values): self
  {
    $mappedValues = [];
    foreach ($values as $value) {
      if ($value instanceof \ElevenLabs\Dubbing\Project\Types\ModelId1) {
        $mappedValues['modelid1'] = $value;
      }
      if (is_string($value)) {
        $mappedValues['string'] = $value;
      }
    }
    return new self($mappedValues);
  }

  // Check presence methods
  /**
   * Check if this CreateProjectRequestModelId contains a \ElevenLabs\Dubbing\Project\Types\ModelId1
   */
  public function hasModelId1(): bool
  {
    return isset($this->values['modelid1']);
  }

  /**
   * Check if this CreateProjectRequestModelId contains a string
   */
  public function hasString(): bool
  {
    return isset($this->values['string']);
  }

  // Getter methods
  /**
   * Get the \ElevenLabs\Dubbing\Project\Types\ModelId1 value if present
   * @return \ElevenLabs\Dubbing\Project\Types\ModelId1|null
   */
  public function getModelId1(): ?\ElevenLabs\Dubbing\Project\Types\ModelId1
  {
    return $this->values['modelid1'] ?? null;
  }

  /**
   * Get the string value if present
   * @return string|null
   */
  public function getString(): ?string
  {
    return $this->values['string'] ?? null;
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
      ($enumValue = \ElevenLabs\Dubbing\Project\Types\ModelId1::tryFrom($data)) !== null
    ) {
      $matches['modelid1'] = $enumValue;
    }

    if (is_string($data)) {
      $matches['string'] = $data;
    }

    if (empty($matches)) {
      throw new \InvalidArgumentException(
        'Data does not match any CreateProjectRequestModelId type'
      );
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
