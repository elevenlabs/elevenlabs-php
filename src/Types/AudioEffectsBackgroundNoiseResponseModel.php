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
class AudioEffectsBackgroundNoiseResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Value for `audio_effects.background_noise_id`.
   */
  #[JsonProperty('background_noise_id', required: true)]
  public string $backgroundNoiseId;

  /**
   * Display name.
   */
  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * What the noise bed sounds like.
   */
  #[JsonProperty('description', required: true)]
  public ?string $description;

  /**
   * @param array{
   *   backgroundNoiseId: string,
   *   name: string,
   *   description: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->backgroundNoiseId = $values['backgroundNoiseId'];
    $this->name = $values['name'];
    $this->description = $values['description'];

    $this->_dirtyFields = [
      'background_noise_id' => true,
      'name' => true,
      'description' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'background_noise_id',
      'contents' => $this->backgroundNoiseId
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
