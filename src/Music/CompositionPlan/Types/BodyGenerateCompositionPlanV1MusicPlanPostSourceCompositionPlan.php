<?php

declare(strict_types=1);

namespace ElevenLabs\Music\CompositionPlan\Types;

use ElevenLabs\Core\Json\JsonSerializableType;

/**
 * An optional composition plan to use as a source for the new composition plan.
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
class BodyGenerateCompositionPlanV1MusicPlanPostSourceCompositionPlan extends JsonSerializableType
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
   * Create a BodyGenerateCompositionPlanV1MusicPlanPostSourceCompositionPlan from multiple types
   * @param array<mixed> $values Array of type instances
   * @return self
   */
  public static function fromMultiple(array $values): self
  {
    $mappedValues = [];
    foreach ($values as $value) {
      if ($value instanceof \ElevenLabs\Types\MusicPrompt) {
        $mappedValues['musicprompt'] = $value;
      }
      if ($value instanceof \ElevenLabs\Types\CompositionPlan) {
        $mappedValues['compositionplan'] = $value;
      }
    }
    return new self($mappedValues);
  }

  // Check presence methods
  /**
   * Check if this BodyGenerateCompositionPlanV1MusicPlanPostSourceCompositionPlan contains a \ElevenLabs\Types\MusicPrompt
   */
  public function hasMusicPrompt(): bool
  {
    return isset($this->values['musicprompt']);
  }

  /**
   * Check if this BodyGenerateCompositionPlanV1MusicPlanPostSourceCompositionPlan contains a \ElevenLabs\Types\CompositionPlan
   */
  public function hasCompositionPlan(): bool
  {
    return isset($this->values['compositionplan']);
  }

  // Getter methods
  /**
   * Get the \ElevenLabs\Types\MusicPrompt value if present
   * @return \ElevenLabs\Types\MusicPrompt|null
   */
  public function getMusicPrompt(): ?\ElevenLabs\Types\MusicPrompt
  {
    return $this->values['musicprompt'] ?? null;
  }

  /**
   * Get the \ElevenLabs\Types\CompositionPlan value if present
   * @return \ElevenLabs\Types\CompositionPlan|null
   */
  public function getCompositionPlan(): ?\ElevenLabs\Types\CompositionPlan
  {
    return $this->values['compositionplan'] ?? null;
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
      $matches['musicprompt'] = \ElevenLabs\Types\MusicPrompt::fromArray($data);
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\MusicPrompt didn't match, continue
    }

    try {
      $matches['compositionplan'] = \ElevenLabs\Types\CompositionPlan::fromArray($data);
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\CompositionPlan didn't match, continue
    }

    if (empty($matches)) {
      throw new \InvalidArgumentException(
        'Data does not match any BodyGenerateCompositionPlanV1MusicPlanPostSourceCompositionPlan type'
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
