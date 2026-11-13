<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;

/**
 * One value bound to a template input port, in the form its `content_schema`
 * calls for. A `string` port takes the text itself; `number`, `integer` and
 * `boolean` ports take a JSON value of that type. Anything stored elsewhere is
 * a reference discriminated on `type`: a prior `generation`, an uploaded
 * `asset`, a `voice`, or media passed `inline_base64`. An `array` port takes a
 * JSON array with one value per element, admissible for the schema's `items`.
 * `object` ports cannot be bound through this API yet.
 *
 * No constraints beyond the wire shape live here: what a port accepts (an
 * `enum`, a length) is stated by its `content_schema`, and the run path
 * validates against that same schema.
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
class TemplateRunInput extends JsonSerializableType
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
   * Create a TemplateRunInput from multiple types
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
      if (is_bool($value)) {
        $mappedValues['bool'] = $value;
      }
      if (is_int($value)) {
        $mappedValues['int'] = $value;
      }
      if (is_float($value) || is_int($value)) {
        $mappedValues['float'] = $value;
      }
      if ($value instanceof \ElevenLabs\Types\TemplateInputReference) {
        $mappedValues['templateinputreference'] = $value;
      }
    }
    return new self($mappedValues);
  }

  // Check presence methods
  /**
   * Check if this TemplateRunInput contains a string
   */
  public function hasString(): bool
  {
    return isset($this->values['string']);
  }

  /**
   * Check if this TemplateRunInput contains a bool
   */
  public function hasBool(): bool
  {
    return isset($this->values['bool']);
  }

  /**
   * Check if this TemplateRunInput contains a int
   */
  public function hasInt(): bool
  {
    return isset($this->values['int']);
  }

  /**
   * Check if this TemplateRunInput contains a float
   */
  public function hasFloat(): bool
  {
    return isset($this->values['float']);
  }

  /**
   * Check if this TemplateRunInput contains a \ElevenLabs\Types\TemplateInputReference
   */
  public function hasTemplateInputReference(): bool
  {
    return isset($this->values['templateinputreference']);
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
   * Get the bool value if present
   * @return bool|null
   */
  public function getBool(): ?bool
  {
    return $this->values['bool'] ?? null;
  }

  /**
   * Get the int value if present
   * @return int|null
   */
  public function getInt(): ?int
  {
    return $this->values['int'] ?? null;
  }

  /**
   * Get the float value if present
   * @return float|null
   */
  public function getFloat(): ?float
  {
    return $this->values['float'] ?? null;
  }

  /**
   * Get the \ElevenLabs\Types\TemplateInputReference value if present
   * @return \ElevenLabs\Types\TemplateInputReference|null
   */
  public function getTemplateInputReference(): ?\ElevenLabs\Types\TemplateInputReference
  {
    return $this->values['templateinputreference'] ?? null;
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

    if (is_bool($data)) {
      $matches['bool'] = $data;
    }

    if (is_int($data)) {
      $matches['int'] = $data;
    }

    if (is_float($data) || is_int($data)) {
      $matches['float'] = $data;
    }

    try {
      $matches['templateinputreference'] = \ElevenLabs\Types\TemplateInputReference::fromArray(
        $data
      );
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\TemplateInputReference didn't match, continue
    }

    if (empty($matches)) {
      throw new \InvalidArgumentException('Data does not match any TemplateRunInput type');
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
