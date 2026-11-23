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
class McpToolCallMcpToolCall extends JsonSerializableType
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
   * Create a McpToolCallMcpToolCall from multiple types
   * @param array<mixed> $values Array of type instances
   * @return self
   */
  public static function fromMultiple(array $values): self
  {
    $mappedValues = [];
    foreach ($values as $value) {
      if ($value instanceof \ElevenLabs\Types\McpToolCallMcpToolCallLoading) {
        $mappedValues['loading'] = $value;
      }
      if ($value instanceof \ElevenLabs\Types\McpToolCallMcpToolCallAwaitingApproval) {
        $mappedValues['awaitingapproval'] = $value;
      }
      if ($value instanceof \ElevenLabs\Types\McpToolCallMcpToolCallSuccess) {
        $mappedValues['success'] = $value;
      }
      if ($value instanceof \ElevenLabs\Types\McpToolCallMcpToolCallFailure) {
        $mappedValues['failure'] = $value;
      }
    }
    return new self($mappedValues);
  }

  // Check presence methods
  /**
   * Check if this McpToolCallMcpToolCall contains a \ElevenLabs\Types\McpToolCallMcpToolCallLoading
   */
  public function hasLoading(): bool
  {
    return isset($this->values['loading']);
  }

  /**
   * Check if this McpToolCallMcpToolCall contains a \ElevenLabs\Types\McpToolCallMcpToolCallAwaitingApproval
   */
  public function hasAwaitingApproval(): bool
  {
    return isset($this->values['awaitingapproval']);
  }

  /**
   * Check if this McpToolCallMcpToolCall contains a \ElevenLabs\Types\McpToolCallMcpToolCallSuccess
   */
  public function hasSuccess(): bool
  {
    return isset($this->values['success']);
  }

  /**
   * Check if this McpToolCallMcpToolCall contains a \ElevenLabs\Types\McpToolCallMcpToolCallFailure
   */
  public function hasFailure(): bool
  {
    return isset($this->values['failure']);
  }

  // Getter methods
  /**
   * Get the \ElevenLabs\Types\McpToolCallMcpToolCallLoading value if present
   * @return \ElevenLabs\Types\McpToolCallMcpToolCallLoading|null
   */
  public function getLoading(): ?\ElevenLabs\Types\McpToolCallMcpToolCallLoading
  {
    return $this->values['loading'] ?? null;
  }

  /**
   * Get the \ElevenLabs\Types\McpToolCallMcpToolCallAwaitingApproval value if present
   * @return \ElevenLabs\Types\McpToolCallMcpToolCallAwaitingApproval|null
   */
  public function getAwaitingApproval(): ?\ElevenLabs\Types\McpToolCallMcpToolCallAwaitingApproval
  {
    return $this->values['awaitingapproval'] ?? null;
  }

  /**
   * Get the \ElevenLabs\Types\McpToolCallMcpToolCallSuccess value if present
   * @return \ElevenLabs\Types\McpToolCallMcpToolCallSuccess|null
   */
  public function getSuccess(): ?\ElevenLabs\Types\McpToolCallMcpToolCallSuccess
  {
    return $this->values['success'] ?? null;
  }

  /**
   * Get the \ElevenLabs\Types\McpToolCallMcpToolCallFailure value if present
   * @return \ElevenLabs\Types\McpToolCallMcpToolCallFailure|null
   */
  public function getFailure(): ?\ElevenLabs\Types\McpToolCallMcpToolCallFailure
  {
    return $this->values['failure'] ?? null;
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
   * @param array<string, mixed> $data
   * @return self
   * @throws \InvalidArgumentException if data doesn't match any type
   */
  public static function fromArray(array $data): self
  {
    $matches = [];

    // Try each type and collect successful matches
    try {
      $matches['loading'] = \ElevenLabs\Types\McpToolCallMcpToolCallLoading::fromArray($data);
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\McpToolCallMcpToolCallLoading didn't match, continue
    }

    try {
      $matches[
        'awaitingapproval'
      ] = \ElevenLabs\Types\McpToolCallMcpToolCallAwaitingApproval::fromArray($data);
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\McpToolCallMcpToolCallAwaitingApproval didn't match, continue
    }

    try {
      $matches['success'] = \ElevenLabs\Types\McpToolCallMcpToolCallSuccess::fromArray($data);
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\McpToolCallMcpToolCallSuccess didn't match, continue
    }

    try {
      $matches['failure'] = \ElevenLabs\Types\McpToolCallMcpToolCallFailure::fromArray($data);
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\McpToolCallMcpToolCallFailure didn't match, continue
    }

    if (empty($matches)) {
      throw new \InvalidArgumentException('Data does not match any McpToolCallMcpToolCall type');
    }

    return new self($matches);
  }

  /**
   * Serialize to JSON - merge all values
   *
   * @return array<mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    foreach ($this->values as $value) {
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
