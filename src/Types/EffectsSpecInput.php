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
class EffectsSpecInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * ID of a filter preset that colors the voice, such as `phone` or `old_radio`. List valid IDs with `GET /v1/audio-effects/catalog`.
   */
  #[JsonProperty('filter_preset_id')]
  public ?string $filterPresetId;

  /**
   * How far the speaker sounds from the microphone, from 0 (close, unchanged) to 1 (far). Higher values roll off low and high frequencies and, when an environment is set, shift the balance from the dry voice toward the reverb.
   */
  #[JsonProperty('distance')]
  public ?float $distance;

  /**
   * ID of a reverb environment that places the voice in a space, such as `small_room` or `hall`. List valid IDs with `GET /v1/audio-effects/catalog`. Reverb is rendered in stereo and adds a tail of up to several seconds after the speech ends.
   */
  #[JsonProperty('environment_id')]
  public ?string $environmentId;

  /**
   * ID of a background noise bed looped under the voice, such as `cafe` or `keyboard`. List valid IDs with `GET /v1/audio-effects/catalog`.
   */
  #[JsonProperty('background_noise_id')]
  public ?string $backgroundNoiseId;

  /**
   * How much of the voice feeds the reverb, from 0 (none) to 1 (full). Only applies when `environment_id` is set; 0 turns the reverb off.
   */
  #[JsonProperty('send_level')]
  public ?float $sendLevel;

  /**
   * Stereo position of the voice, from -1 (hard left) through 0 (center) to 1 (hard right). Only the voice is panned; reverb and background noise stay centered.
   */
  #[JsonProperty('pan')]
  public ?float $pan;

  /**
   * @param array{
   *   filterPresetId?: ?string,
   *   distance?: ?float,
   *   environmentId?: ?string,
   *   backgroundNoiseId?: ?string,
   *   sendLevel?: ?float,
   *   pan?: ?float,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->filterPresetId = $values['filterPresetId'] ?? null;
    $this->distance = $values['distance'] ?? null;
    $this->environmentId = $values['environmentId'] ?? null;
    $this->backgroundNoiseId = $values['backgroundNoiseId'] ?? null;
    $this->sendLevel = $values['sendLevel'] ?? null;
    $this->pan = $values['pan'] ?? null;

    if (array_key_exists('filterPresetId', $values)) {
      $this->_dirtyFields['filter_preset_id'] = true;
    }
    if (array_key_exists('distance', $values)) {
      $this->_dirtyFields['distance'] = true;
    }
    if (array_key_exists('environmentId', $values)) {
      $this->_dirtyFields['environment_id'] = true;
    }
    if (array_key_exists('backgroundNoiseId', $values)) {
      $this->_dirtyFields['background_noise_id'] = true;
    }
    if (array_key_exists('sendLevel', $values)) {
      $this->_dirtyFields['send_level'] = true;
    }
    if (array_key_exists('pan', $values)) {
      $this->_dirtyFields['pan'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->filterPresetId !== null) {
      $parts[] = [
        'name' => 'filter_preset_id',
        'contents' => $this->filterPresetId
      ];
    }

    if ($this->distance !== null) {
      $parts[] = [
        'name' => 'distance',
        'contents' => (string) $this->distance
      ];
    }

    if ($this->environmentId !== null) {
      $parts[] = [
        'name' => 'environment_id',
        'contents' => $this->environmentId
      ];
    }

    if ($this->backgroundNoiseId !== null) {
      $parts[] = [
        'name' => 'background_noise_id',
        'contents' => $this->backgroundNoiseId
      ];
    }

    if ($this->sendLevel !== null) {
      $parts[] = [
        'name' => 'send_level',
        'contents' => (string) $this->sendLevel
      ];
    }

    if ($this->pan !== null) {
      $parts[] = [
        'name' => 'pan',
        'contents' => (string) $this->pan
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateNumber($this->distance, 'distance', min: 0, max: 1);
    Validator::validateNumber($this->sendLevel, 'send_level', min: 0, max: 1);
    Validator::validateNumber($this->pan, 'pan', min: -1, max: 1);
  }
}
