<?php

declare(strict_types=1);

namespace ElevenLabs\Music\Types;

use ElevenLabs\Core\Json\JsonSerializableType;

/**
 * Whether to generate and return the composition plan for the uploaded song. Pass a model id (`music_v1`, `music_v2` or `music_v2_5`) to control which composition plan format is returned. Passing `true`/`false` is deprecated; `true` defaults to the `music_v1` plan format. Enabling this will increase the latency.
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
class UploadMusicRequestExtractCompositionPlan extends JsonSerializableType
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
   * Create a UploadMusicRequestExtractCompositionPlan from multiple types
   * @param array<mixed> $values Array of type instances
   * @return self
   */
  public static function fromMultiple(array $values): self
  {
    $mappedValues = [];
    foreach ($values as $value) {
      if (is_bool($value)) {
        $mappedValues['bool'] = $value;
      }
      if ($value instanceof \ElevenLabs\Types\MusicModelId) {
        $mappedValues['musicmodelid'] = $value;
      }
    }
    return new self($mappedValues);
  }

  // Check presence methods
  /**
   * Check if this UploadMusicRequestExtractCompositionPlan contains a bool
   */
  public function hasBool(): bool
  {
    return isset($this->values['bool']);
  }

  /**
   * Check if this UploadMusicRequestExtractCompositionPlan contains a \ElevenLabs\Types\MusicModelId
   */
  public function hasMusicModelId(): bool
  {
    return isset($this->values['musicmodelid']);
  }

  // Getter methods
  /**
   * Get the bool value if present
   * @return bool|null
   */
  public function getBool(): ?bool
  {
    return $this->values['bool'] ?? null;
  }

  /**
   * Get the \ElevenLabs\Types\MusicModelId value if present
   * @return \ElevenLabs\Types\MusicModelId|null
   */
  public function getMusicModelId(): ?\ElevenLabs\Types\MusicModelId
  {
    return $this->values['musicmodelid'] ?? null;
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
    if (is_bool($data)) {
      $matches['bool'] = $data;
    }

    if (
      (is_string($data) || is_int($data)) &&
      ($enumValue = \ElevenLabs\Types\MusicModelId::tryFrom($data)) !== null
    ) {
      $matches['musicmodelid'] = $enumValue;
    }

    if (empty($matches)) {
      throw new \InvalidArgumentException(
        'Data does not match any UploadMusicRequestExtractCompositionPlan type'
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
