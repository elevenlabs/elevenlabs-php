<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class AudioEffectsEnvironmentResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Value for `audio_effects.environment_id`.
   */
  #[JsonProperty('environment_id', required: true)]
  public string $environmentId;

  /**
   * Display name.
   */
  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * What the space sounds like.
   */
  #[JsonProperty('description', required: true)]
  public ?string $description;

  /**
   * @param array{
   *   environmentId: string,
   *   name: string,
   *   description: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->environmentId = $values['environmentId'];
    $this->name = $values['name'];
    $this->description = $values['description'];

    $this->_dirtyFields = [
      'environment_id' => true,
      'name' => true,
      'description' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'environment_id',
      'contents' => $this->environmentId
    ];

    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    $parts[] = [
      'name' => 'description',
      'contents' => $this->description
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
