<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * Audio effects applied to generated speech: a filter preset, perceived distance, a reverb
 * environment, a background noise bed, and stereo panning. Leave every field at its default
 * to get unprocessed audio.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class EffectsSpecOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * ID of a filter preset that colors the voice, such as `phone` or `old_radio`. List valid IDs with `GET /v1/audio-effects/catalog`.
   */
  #[JsonProperty('filter_preset_id', required: true)]
  public ?string $filterPresetId;

  /**
   * How far the speaker sounds from the microphone, from 0 (close, unchanged) to 1 (far). Higher values roll off low and high frequencies and, when an environment is set, shift the balance from the dry voice toward the reverb.
   */
  #[JsonProperty('distance', required: true)]
  public float $distance;

  /**
   * ID of a reverb environment that places the voice in a space, such as `small_room` or `hall`. List valid IDs with `GET /v1/audio-effects/catalog`. Reverb is rendered in stereo and adds a tail of up to several seconds after the speech ends.
   */
  #[JsonProperty('environment_id', required: true)]
  public ?string $environmentId;

  /**
   * ID of a background noise bed looped under the voice, such as `cafe` or `keyboard`. List valid IDs with `GET /v1/audio-effects/catalog`.
   */
  #[JsonProperty('background_noise_id', required: true)]
  public ?string $backgroundNoiseId;

  /**
   * How much of the voice feeds the reverb, from 0 (none) to 1 (full). Only applies when `environment_id` is set; 0 turns the reverb off.
   */
  #[JsonProperty('send_level', required: true)]
  public float $sendLevel;

  /**
   * Stereo position of the voice, from -1 (hard left) through 0 (center) to 1 (hard right). Only the voice is panned; reverb and background noise stay centered.
   */
  #[JsonProperty('pan', required: true)]
  public float $pan;

  /**
   * @param array{
   *   filterPresetId: ?string,
   *   distance: float,
   *   environmentId: ?string,
   *   backgroundNoiseId: ?string,
   *   sendLevel: float,
   *   pan: float,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->filterPresetId = $values['filterPresetId'];
    $this->distance = $values['distance'];
    $this->environmentId = $values['environmentId'];
    $this->backgroundNoiseId = $values['backgroundNoiseId'];
    $this->sendLevel = $values['sendLevel'];
    $this->pan = $values['pan'];

    $this->_dirtyFields = [
      'filter_preset_id' => true,
      'distance' => true,
      'environment_id' => true,
      'background_noise_id' => true,
      'send_level' => true,
      'pan' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'filter_preset_id',
      'contents' => $this->filterPresetId
    ];

    $parts[] = [
      'name' => 'distance',
      'contents' => (string) $this->distance
    ];

    $parts[] = [
      'name' => 'environment_id',
      'contents' => $this->environmentId
    ];

    $parts[] = [
      'name' => 'background_noise_id',
      'contents' => $this->backgroundNoiseId
    ];

    $parts[] = [
      'name' => 'send_level',
      'contents' => (string) $this->sendLevel
    ];

    $parts[] = [
      'name' => 'pan',
      'contents' => (string) $this->pan
    ];

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateNumber($this->distance, 'distance', min: 0, max: 1);
    Validator::validateNumber($this->sendLevel, 'send_level', min: 0, max: 1);
    Validator::validateNumber($this->pan, 'pan', min: -1, max: 1);
  }
}
