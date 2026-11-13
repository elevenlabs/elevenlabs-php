<?php

declare(strict_types=1);

namespace ElevenLabs\ServiceAccounts\ApiKeys\Types;

use ElevenLabs\Core\Json\JsonSerializableType;

/**
 * Maximum concurrent dubbing requests for this API key. Only available for enterprise customers.
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
class BodyEditServiceAccountApiKeyV1ServiceAccountsServiceAccountUserIdApiKeysApiKeyIdPatchDubbingConcurrencyLimit
  extends JsonSerializableType
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
   * Create a BodyEditServiceAccountApiKeyV1ServiceAccountsServiceAccountUserIdApiKeysApiKeyIdPatchDubbingConcurrencyLimit from multiple types
   * @param array<mixed> $values Array of type instances
   * @return self
   */
  public static function fromMultiple(array $values): self
  {
    $mappedValues = [];
    foreach ($values as $value) {
      if (is_int($value)) {
        $mappedValues['int'] = $value;
      }
      if ($value instanceof \ElevenLabs\ServiceAccounts\ApiKeys\Types\DubbingConcurrencyLimit2) {
        $mappedValues['dubbingconcurrencylimit2'] = $value;
      }
    }
    return new self($mappedValues);
  }

  // Check presence methods
  /**
   * Check if this BodyEditServiceAccountApiKeyV1ServiceAccountsServiceAccountUserIdApiKeysApiKeyIdPatchDubbingConcurrencyLimit contains a int
   */
  public function hasInt(): bool
  {
    return isset($this->values['int']);
  }

  /**
   * Check if this BodyEditServiceAccountApiKeyV1ServiceAccountsServiceAccountUserIdApiKeysApiKeyIdPatchDubbingConcurrencyLimit contains a \ElevenLabs\ServiceAccounts\ApiKeys\Types\DubbingConcurrencyLimit2
   */
  public function hasDubbingConcurrencyLimit2(): bool
  {
    return isset($this->values['dubbingconcurrencylimit2']);
  }

  // Getter methods
  /**
   * Get the int value if present
   * @return int|null
   */
  public function getInt(): ?int
  {
    return $this->values['int'] ?? null;
  }

  /**
   * Get the \ElevenLabs\ServiceAccounts\ApiKeys\Types\DubbingConcurrencyLimit2 value if present
   * @return \ElevenLabs\ServiceAccounts\ApiKeys\Types\DubbingConcurrencyLimit2|null
   */
  public function getDubbingConcurrencyLimit2(): ?\ElevenLabs\ServiceAccounts\ApiKeys\Types\DubbingConcurrencyLimit2
  {
    return $this->values['dubbingconcurrencylimit2'] ?? null;
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
    if (is_int($data)) {
      $matches['int'] = $data;
    }

    if (
      (is_string($data) || is_int($data)) &&
      ($enumValue = \ElevenLabs\ServiceAccounts\ApiKeys\Types\DubbingConcurrencyLimit2::tryFrom(
        $data
      )) !== null
    ) {
      $matches['dubbingconcurrencylimit2'] = $enumValue;
    }

    if (empty($matches)) {
      throw new \InvalidArgumentException(
        'Data does not match any BodyEditServiceAccountApiKeyV1ServiceAccountsServiceAccountUserIdApiKeysApiKeyIdPatchDubbingConcurrencyLimit type'
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
