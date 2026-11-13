<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;

/**
 * Activity ID
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
class WorkspaceAuditLogEntryResponseActivityId extends JsonSerializableType
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
   * Create a WorkspaceAuditLogEntryResponseActivityId from multiple types
   * @param array<mixed> $values Array of type instances
   * @return self
   */
  public static function fromMultiple(array $values): self
  {
    $mappedValues = [];
    foreach ($values as $value) {
      if ($value instanceof \ElevenLabs\Types\AccountChangeActivityId) {
        $mappedValues['accountchangeactivityid'] = $value;
      }
      if ($value instanceof \ElevenLabs\Types\AuthenticationActivityId) {
        $mappedValues['authenticationactivityid'] = $value;
      }
      if ($value instanceof \ElevenLabs\Types\EntityManagementActivityId) {
        $mappedValues['entitymanagementactivityid'] = $value;
      }
      if ($value instanceof \ElevenLabs\Types\UserAccessManagementActivityId) {
        $mappedValues['useraccessmanagementactivityid'] = $value;
      }
      if ($value instanceof \ElevenLabs\Types\GroupManagementActivityId) {
        $mappedValues['groupmanagementactivityid'] = $value;
      }
    }
    return new self($mappedValues);
  }

  // Check presence methods
  /**
   * Check if this WorkspaceAuditLogEntryResponseActivityId contains a \ElevenLabs\Types\AccountChangeActivityId
   */
  public function hasAccountChangeActivityId(): bool
  {
    return isset($this->values['accountchangeactivityid']);
  }

  /**
   * Check if this WorkspaceAuditLogEntryResponseActivityId contains a \ElevenLabs\Types\AuthenticationActivityId
   */
  public function hasAuthenticationActivityId(): bool
  {
    return isset($this->values['authenticationactivityid']);
  }

  /**
   * Check if this WorkspaceAuditLogEntryResponseActivityId contains a \ElevenLabs\Types\EntityManagementActivityId
   */
  public function hasEntityManagementActivityId(): bool
  {
    return isset($this->values['entitymanagementactivityid']);
  }

  /**
   * Check if this WorkspaceAuditLogEntryResponseActivityId contains a \ElevenLabs\Types\UserAccessManagementActivityId
   */
  public function hasUserAccessManagementActivityId(): bool
  {
    return isset($this->values['useraccessmanagementactivityid']);
  }

  /**
   * Check if this WorkspaceAuditLogEntryResponseActivityId contains a \ElevenLabs\Types\GroupManagementActivityId
   */
  public function hasGroupManagementActivityId(): bool
  {
    return isset($this->values['groupmanagementactivityid']);
  }

  // Getter methods
  /**
   * Get the \ElevenLabs\Types\AccountChangeActivityId value if present
   * @return \ElevenLabs\Types\AccountChangeActivityId|null
   */
  public function getAccountChangeActivityId(): ?\ElevenLabs\Types\AccountChangeActivityId
  {
    return $this->values['accountchangeactivityid'] ?? null;
  }

  /**
   * Get the \ElevenLabs\Types\AuthenticationActivityId value if present
   * @return \ElevenLabs\Types\AuthenticationActivityId|null
   */
  public function getAuthenticationActivityId(): ?\ElevenLabs\Types\AuthenticationActivityId
  {
    return $this->values['authenticationactivityid'] ?? null;
  }

  /**
   * Get the \ElevenLabs\Types\EntityManagementActivityId value if present
   * @return \ElevenLabs\Types\EntityManagementActivityId|null
   */
  public function getEntityManagementActivityId(): ?\ElevenLabs\Types\EntityManagementActivityId
  {
    return $this->values['entitymanagementactivityid'] ?? null;
  }

  /**
   * Get the \ElevenLabs\Types\UserAccessManagementActivityId value if present
   * @return \ElevenLabs\Types\UserAccessManagementActivityId|null
   */
  public function getUserAccessManagementActivityId(): ?\ElevenLabs\Types\UserAccessManagementActivityId
  {
    return $this->values['useraccessmanagementactivityid'] ?? null;
  }

  /**
   * Get the \ElevenLabs\Types\GroupManagementActivityId value if present
   * @return \ElevenLabs\Types\GroupManagementActivityId|null
   */
  public function getGroupManagementActivityId(): ?\ElevenLabs\Types\GroupManagementActivityId
  {
    return $this->values['groupmanagementactivityid'] ?? null;
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
      ($enumValue = \ElevenLabs\Types\AccountChangeActivityId::tryFrom($data)) !== null
    ) {
      $matches['accountchangeactivityid'] = $enumValue;
    }

    if (
      (is_string($data) || is_int($data)) &&
      ($enumValue = \ElevenLabs\Types\AuthenticationActivityId::tryFrom($data)) !== null
    ) {
      $matches['authenticationactivityid'] = $enumValue;
    }

    if (
      (is_string($data) || is_int($data)) &&
      ($enumValue = \ElevenLabs\Types\EntityManagementActivityId::tryFrom($data)) !== null
    ) {
      $matches['entitymanagementactivityid'] = $enumValue;
    }

    if (
      (is_string($data) || is_int($data)) &&
      ($enumValue = \ElevenLabs\Types\UserAccessManagementActivityId::tryFrom($data)) !== null
    ) {
      $matches['useraccessmanagementactivityid'] = $enumValue;
    }

    if (
      (is_string($data) || is_int($data)) &&
      ($enumValue = \ElevenLabs\Types\GroupManagementActivityId::tryFrom($data)) !== null
    ) {
      $matches['groupmanagementactivityid'] = $enumValue;
    }

    if (empty($matches)) {
      throw new \InvalidArgumentException(
        'Data does not match any WorkspaceAuditLogEntryResponseActivityId type'
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
