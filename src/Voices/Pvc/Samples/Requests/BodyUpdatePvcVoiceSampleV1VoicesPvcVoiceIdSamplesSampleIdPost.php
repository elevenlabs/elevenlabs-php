<?php

declare(strict_types=1);

namespace ElevenLabs\Voices\Pvc\Samples\Requests;

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
class BodyUpdatePvcVoiceSampleV1VoicesPvcVoiceIdSamplesSampleIdPost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * If set will remove background noise for voice samples using our audio isolation model. If the samples do not include background noise, it can make the quality worse.
   */
  #[JsonProperty('remove_background_noise')]
  public ?bool $removeBackgroundNoise;

  /**
   * @var string[]|null
   * Speaker IDs to be used for PVC training. Make sure you send all the speaker IDs you want to use for PVC training in one request because the last request will override the previous ones.
   */
  #[JsonProperty('selected_speaker_ids'), ArrayType(['string'])]
  public ?array $selectedSpeakerIds;

  /**
   * The start time of the audio to be used for PVC training. Time should be in milliseconds
   */
  #[JsonProperty('trim_start_time')]
  public ?int $trimStartTime;

  /**
   * The end time of the audio to be used for PVC training. Time should be in milliseconds
   */
  #[JsonProperty('trim_end_time')]
  public ?int $trimEndTime;

  /**
   * The name of the audio file to be used for PVC training.
   */
  #[JsonProperty('file_name')]
  public ?string $fileName;

  /**
   * @param array{
   *   removeBackgroundNoise?: ?bool,
   *   selectedSpeakerIds?: string[]|null,
   *   trimStartTime?: ?int,
   *   trimEndTime?: ?int,
   *   fileName?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->removeBackgroundNoise = $values['removeBackgroundNoise'] ?? null;
    $this->selectedSpeakerIds = $values['selectedSpeakerIds'] ?? null;
    $this->trimStartTime = $values['trimStartTime'] ?? null;
    $this->trimEndTime = $values['trimEndTime'] ?? null;
    $this->fileName = $values['fileName'] ?? null;

    if (array_key_exists('removeBackgroundNoise', $values)) {
      $this->_dirtyFields['remove_background_noise'] = true;
    }
    if (array_key_exists('selectedSpeakerIds', $values)) {
      $this->_dirtyFields['selected_speaker_ids'] = true;
    }
    if (array_key_exists('trimStartTime', $values)) {
      $this->_dirtyFields['trim_start_time'] = true;
    }
    if (array_key_exists('trimEndTime', $values)) {
      $this->_dirtyFields['trim_end_time'] = true;
    }
    if (array_key_exists('fileName', $values)) {
      $this->_dirtyFields['file_name'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->removeBackgroundNoise !== null) {
      $parts[] = [
        'name' => 'remove_background_noise',
        'contents' => $this->removeBackgroundNoise ? 'true' : 'false'
      ];
    }

    if ($this->selectedSpeakerIds !== null) {
      foreach ($this->selectedSpeakerIds ?? [] as $item) {
        $parts[] = [
          'name' => 'selected_speaker_ids',
          'contents' => $item
        ];
      }
    }

    if ($this->trimStartTime !== null) {
      $parts[] = [
        'name' => 'trim_start_time',
        'contents' => (string) $this->trimStartTime
      ];
    }

    if ($this->trimEndTime !== null) {
      $parts[] = [
        'name' => 'trim_end_time',
        'contents' => (string) $this->trimEndTime
      ];
    }

    if ($this->fileName !== null) {
      $parts[] = [
        'name' => 'file_name',
        'contents' => $this->fileName
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
