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
class OpenAiSessionConfigInputTurnDetection extends JsonSerializableType
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
   * Create a OpenAiSessionConfigInputTurnDetection from multiple types
   * @param array<mixed> $values Array of type instances
   * @return self
   */
  public static function fromMultiple(array $values): self
  {
    $mappedValues = [];
    foreach ($values as $value) {
      if ($value instanceof \ElevenLabs\Types\OpenAiTurnDetection) {
        $mappedValues['openaiturndetection'] = $value;
      }
      if (is_string($value)) {
        $mappedValues['string'] = $value;
      }
    }
    return new self($mappedValues);
  }

  // Check presence methods
  /**
   * Check if this OpenAiSessionConfigInputTurnDetection contains a \ElevenLabs\Types\OpenAiTurnDetection
   */
  public function hasOpenAiTurnDetection(): bool
  {
    return isset($this->values['openaiturndetection']);
  }

  /**
   * Check if this OpenAiSessionConfigInputTurnDetection contains a string
   */
  public function hasString(): bool
  {
    return isset($this->values['string']);
  }

  // Getter methods
  /**
   * Get the \ElevenLabs\Types\OpenAiTurnDetection value if present
   * @return \ElevenLabs\Types\OpenAiTurnDetection|null
   */
  public function getOpenAiTurnDetection(): ?\ElevenLabs\Types\OpenAiTurnDetection
  {
    return $this->values['openaiturndetection'] ?? null;
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
    try {
      $matches['openaiturndetection'] = \ElevenLabs\Types\OpenAiTurnDetection::fromArray($data);
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\OpenAiTurnDetection didn't match, continue
    }

    if (is_string($data)) {
      $matches['string'] = $data;
    }

    if (empty($matches)) {
      throw new \InvalidArgumentException(
        'Data does not match any OpenAiSessionConfigInputTurnDetection type'
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
