<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;

/**
 * Configuration for backup LLM cascading. Can be disabled, use system defaults, or specify custom order.
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
class PromptAgentApiModelWorkflowOverrideOutputBackupLlmConfig extends JsonSerializableType
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
   * Create a PromptAgentApiModelWorkflowOverrideOutputBackupLlmConfig from multiple types
   * @param array<mixed> $values Array of type instances
   * @return self
   */
  public static function fromMultiple(array $values): self
  {
    $mappedValues = [];
    foreach ($values as $value) {
      if ($value instanceof \ElevenLabs\Types\BackupLlmDefault) {
        $mappedValues['backupllmdefault'] = $value;
      }
      if ($value instanceof \ElevenLabs\Types\BackupLlmDisabled) {
        $mappedValues['backupllmdisabled'] = $value;
      }
      if ($value instanceof \ElevenLabs\Types\BackupLlmOverride) {
        $mappedValues['backupllmoverride'] = $value;
      }
    }
    return new self($mappedValues);
  }

  // Check presence methods
  /**
   * Check if this PromptAgentApiModelWorkflowOverrideOutputBackupLlmConfig contains a \ElevenLabs\Types\BackupLlmDefault
   */
  public function hasBackupLlmDefault(): bool
  {
    return isset($this->values['backupllmdefault']);
  }

  /**
   * Check if this PromptAgentApiModelWorkflowOverrideOutputBackupLlmConfig contains a \ElevenLabs\Types\BackupLlmDisabled
   */
  public function hasBackupLlmDisabled(): bool
  {
    return isset($this->values['backupllmdisabled']);
  }

  /**
   * Check if this PromptAgentApiModelWorkflowOverrideOutputBackupLlmConfig contains a \ElevenLabs\Types\BackupLlmOverride
   */
  public function hasBackupLlmOverride(): bool
  {
    return isset($this->values['backupllmoverride']);
  }

  // Getter methods
  /**
   * Get the \ElevenLabs\Types\BackupLlmDefault value if present
   * @return \ElevenLabs\Types\BackupLlmDefault|null
   */
  public function getBackupLlmDefault(): ?\ElevenLabs\Types\BackupLlmDefault
  {
    return $this->values['backupllmdefault'] ?? null;
  }

  /**
   * Get the \ElevenLabs\Types\BackupLlmDisabled value if present
   * @return \ElevenLabs\Types\BackupLlmDisabled|null
   */
  public function getBackupLlmDisabled(): ?\ElevenLabs\Types\BackupLlmDisabled
  {
    return $this->values['backupllmdisabled'] ?? null;
  }

  /**
   * Get the \ElevenLabs\Types\BackupLlmOverride value if present
   * @return \ElevenLabs\Types\BackupLlmOverride|null
   */
  public function getBackupLlmOverride(): ?\ElevenLabs\Types\BackupLlmOverride
  {
    return $this->values['backupllmoverride'] ?? null;
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
      $matches['backupllmdefault'] = \ElevenLabs\Types\BackupLlmDefault::fromArray($data);
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\BackupLlmDefault didn't match, continue
    }

    try {
      $matches['backupllmdisabled'] = \ElevenLabs\Types\BackupLlmDisabled::fromArray($data);
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\BackupLlmDisabled didn't match, continue
    }

    try {
      $matches['backupllmoverride'] = \ElevenLabs\Types\BackupLlmOverride::fromArray($data);
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\BackupLlmOverride didn't match, continue
    }

    if (empty($matches)) {
      throw new \InvalidArgumentException(
        'Data does not match any PromptAgentApiModelWorkflowOverrideOutputBackupLlmConfig type'
      );
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
