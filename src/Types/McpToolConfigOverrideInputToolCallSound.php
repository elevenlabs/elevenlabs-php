<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;

/**
 * Overrides the server's tool_call_sound setting for this tool. A sound name plays that sound; 'off' overrides to no sound (silence); null means do not override (inherit the server default).
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
class McpToolConfigOverrideInputToolCallSound extends JsonSerializableType
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
   * Create a McpToolConfigOverrideInputToolCallSound from multiple types
   * @param array<mixed> $values Array of type instances
   * @return self
   */
  public static function fromMultiple(array $values): self
  {
    $mappedValues = [];
    foreach ($values as $value) {
      if ($value instanceof \ElevenLabs\Types\ToolCallSoundType) {
        $mappedValues['toolcallsoundtype'] = $value;
      }
      if ($value instanceof \ElevenLabs\Types\ToolCallSound22) {
        $mappedValues['toolcallsound22'] = $value;
      }
    }
    return new self($mappedValues);
  }

  // Check presence methods
  /**
   * Check if this McpToolConfigOverrideInputToolCallSound contains a \ElevenLabs\Types\ToolCallSoundType
   */
  public function hasToolCallSoundType(): bool
  {
    return isset($this->values['toolcallsoundtype']);
  }

  /**
   * Check if this McpToolConfigOverrideInputToolCallSound contains a \ElevenLabs\Types\ToolCallSound22
   */
  public function hasToolCallSound22(): bool
  {
    return isset($this->values['toolcallsound22']);
  }

  // Getter methods
  /**
   * Get the \ElevenLabs\Types\ToolCallSoundType value if present
   * @return \ElevenLabs\Types\ToolCallSoundType|null
   */
  public function getToolCallSoundType(): ?\ElevenLabs\Types\ToolCallSoundType
  {
    return $this->values['toolcallsoundtype'] ?? null;
  }

  /**
   * Get the \ElevenLabs\Types\ToolCallSound22 value if present
   * @return \ElevenLabs\Types\ToolCallSound22|null
   */
  public function getToolCallSound22(): ?\ElevenLabs\Types\ToolCallSound22
  {
    return $this->values['toolcallsound22'] ?? null;
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
      ($enumValue = \ElevenLabs\Types\ToolCallSoundType::tryFrom($data)) !== null
    ) {
      $matches['toolcallsoundtype'] = $enumValue;
    }

    if (
      (is_string($data) || is_int($data)) &&
      ($enumValue = \ElevenLabs\Types\ToolCallSound22::tryFrom($data)) !== null
    ) {
      $matches['toolcallsound22'] = $enumValue;
    }

    if (empty($matches)) {
      throw new \InvalidArgumentException(
        'Data does not match any McpToolConfigOverrideInputToolCallSound type'
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
