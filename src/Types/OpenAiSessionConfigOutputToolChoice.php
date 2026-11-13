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
class OpenAiSessionConfigOutputToolChoice extends JsonSerializableType
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
   * Create a OpenAiSessionConfigOutputToolChoice from multiple types
   * @param array<mixed> $values Array of type instances
   * @return self
   */
  public static function fromMultiple(array $values): self
  {
    $mappedValues = [];
    foreach ($values as $value) {
      if (is_string($value)) {
        $mappedValues['string'] = $value;
      }
      if ($value instanceof \ElevenLabs\Types\OpenAiToolChoiceFunction) {
        $mappedValues['openaitoolchoicefunction'] = $value;
      }
    }
    return new self($mappedValues);
  }

  // Check presence methods
  /**
   * Check if this OpenAiSessionConfigOutputToolChoice contains a string
   */
  public function hasString(): bool
  {
    return isset($this->values['string']);
  }

  /**
   * Check if this OpenAiSessionConfigOutputToolChoice contains a \ElevenLabs\Types\OpenAiToolChoiceFunction
   */
  public function hasOpenAiToolChoiceFunction(): bool
  {
    return isset($this->values['openaitoolchoicefunction']);
  }

  // Getter methods
  /**
   * Get the string value if present
   * @return string|null
   */
  public function getString(): ?string
  {
    return $this->values['string'] ?? null;
  }

  /**
   * Get the \ElevenLabs\Types\OpenAiToolChoiceFunction value if present
   * @return \ElevenLabs\Types\OpenAiToolChoiceFunction|null
   */
  public function getOpenAiToolChoiceFunction(): ?\ElevenLabs\Types\OpenAiToolChoiceFunction
  {
    return $this->values['openaitoolchoicefunction'] ?? null;
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
    if (is_string($data)) {
      $matches['string'] = $data;
    }

    try {
      $matches['openaitoolchoicefunction'] = \ElevenLabs\Types\OpenAiToolChoiceFunction::fromArray(
        $data
      );
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\OpenAiToolChoiceFunction didn't match, continue
    }

    if (empty($matches)) {
      throw new \InvalidArgumentException(
        'Data does not match any OpenAiSessionConfigOutputToolChoice type'
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
