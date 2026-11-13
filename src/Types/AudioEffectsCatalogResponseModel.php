<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class AudioEffectsCatalogResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\AudioEffectsFilterPresetResponseModel[]
   */
  #[
    JsonProperty('filter_presets', required: true),
    ArrayType([\ElevenLabs\Types\AudioEffectsFilterPresetResponseModel::class])
  ]
  public array $filterPresets;

  /**
   * @var \ElevenLabs\Types\AudioEffectsEnvironmentResponseModel[]
   */
  #[
    JsonProperty('environments', required: true),
    ArrayType([\ElevenLabs\Types\AudioEffectsEnvironmentResponseModel::class])
  ]
  public array $environments;

  /**
   * @var \ElevenLabs\Types\AudioEffectsBackgroundNoiseResponseModel[]
   */
  #[
    JsonProperty('background_noises', required: true),
    ArrayType([\ElevenLabs\Types\AudioEffectsBackgroundNoiseResponseModel::class])
  ]
  public array $backgroundNoises;

  /**
   * @param array{
   *   filterPresets: \ElevenLabs\Types\AudioEffectsFilterPresetResponseModel[],
   *   environments: \ElevenLabs\Types\AudioEffectsEnvironmentResponseModel[],
   *   backgroundNoises: \ElevenLabs\Types\AudioEffectsBackgroundNoiseResponseModel[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->filterPresets = $values['filterPresets'];
    $this->environments = $values['environments'];
    $this->backgroundNoises = $values['backgroundNoises'];

    $this->_dirtyFields = [
      'filter_presets' => true,
      'environments' => true,
      'background_noises' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'filter_presets',
      'contents' => json_encode($this->filterPresets),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'environments',
      'contents' => json_encode($this->environments),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'background_noises',
      'contents' => json_encode($this->backgroundNoises),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->filterPresets as $item) {
      $item->validate();
    }
    foreach ($this->environments as $item) {
      $item->validate();
    }
    foreach ($this->backgroundNoises as $item) {
      $item->validate();
    }
  }
}
