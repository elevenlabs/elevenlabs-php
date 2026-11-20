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
class QueryParamsJsonSchemaInputPropertiesValue extends JsonSerializableType
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
   * Create a QueryParamsJsonSchemaInputPropertiesValue from multiple types
   * @param array<mixed> $values Array of type instances
   * @return self
   */
  public static function fromMultiple(array $values): self
  {
    $mappedValues = [];
    foreach ($values as $value) {
      if ($value instanceof \ElevenLabs\Types\LiteralJsonSchemaProperty) {
        $mappedValues['literaljsonschemaproperty'] = $value;
      }
      if ($value instanceof \ElevenLabs\Types\QueryArrayJsonSchemaPropertyInput) {
        $mappedValues['queryarrayjsonschemapropertyinput'] = $value;
      }
    }
    return new self($mappedValues);
  }

  // Check presence methods
  /**
   * Check if this QueryParamsJsonSchemaInputPropertiesValue contains a \ElevenLabs\Types\LiteralJsonSchemaProperty
   */
  public function hasLiteralJsonSchemaProperty(): bool
  {
    return isset($this->values['literaljsonschemaproperty']);
  }

  /**
   * Check if this QueryParamsJsonSchemaInputPropertiesValue contains a \ElevenLabs\Types\QueryArrayJsonSchemaPropertyInput
   */
  public function hasQueryArrayJsonSchemaPropertyInput(): bool
  {
    return isset($this->values['queryarrayjsonschemapropertyinput']);
  }

  // Getter methods
  /**
   * Get the \ElevenLabs\Types\LiteralJsonSchemaProperty value if present
   * @return \ElevenLabs\Types\LiteralJsonSchemaProperty|null
   */
  public function getLiteralJsonSchemaProperty(): ?\ElevenLabs\Types\LiteralJsonSchemaProperty
  {
    return $this->values['literaljsonschemaproperty'] ?? null;
  }

  /**
   * Get the \ElevenLabs\Types\QueryArrayJsonSchemaPropertyInput value if present
   * @return \ElevenLabs\Types\QueryArrayJsonSchemaPropertyInput|null
   */
  public function getQueryArrayJsonSchemaPropertyInput(): ?\ElevenLabs\Types\QueryArrayJsonSchemaPropertyInput
  {
    return $this->values['queryarrayjsonschemapropertyinput'] ?? null;
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
      $matches[
        'literaljsonschemaproperty'
      ] = \ElevenLabs\Types\LiteralJsonSchemaProperty::fromArray($data);
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\LiteralJsonSchemaProperty didn't match, continue
    }

    try {
      $matches[
        'queryarrayjsonschemapropertyinput'
      ] = \ElevenLabs\Types\QueryArrayJsonSchemaPropertyInput::fromArray($data);
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\QueryArrayJsonSchemaPropertyInput didn't match, continue
    }

    if (empty($matches)) {
      throw new \InvalidArgumentException(
        'Data does not match any QueryParamsJsonSchemaInputPropertiesValue type'
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
