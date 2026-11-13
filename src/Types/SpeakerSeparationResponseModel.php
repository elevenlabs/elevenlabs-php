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
class SpeakerSeparationResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The ID of the voice.
   */
  #[JsonProperty('voice_id', required: true)]
  public string $voiceId;

  /**
   * The ID of the sample.
   */
  #[JsonProperty('sample_id', required: true)]
  public string $sampleId;

  /**
   * @var value-of<\ElevenLabs\Types\SpeakerSeparationResponseModelStatus>
   * The status of the speaker separation.
   */
  #[JsonProperty('status', required: true)]
  public string $status;

  /**
   * @var array<string, \ElevenLabs\Types\SpeakerResponseModel>|null
   * The speakers of the sample.
   */
  #[
    JsonProperty('speakers'),
    ArrayType(['string' => \ElevenLabs\Types\SpeakerResponseModel::class])
  ]
  public ?array $speakers;

  /**
   * @var string[]|null
   * The IDs of the selected speakers.
   */
  #[JsonProperty('selected_speaker_ids'), ArrayType(['string'])]
  public ?array $selectedSpeakerIds;

  /**
   * @param array{
   *   voiceId: string,
   *   sampleId: string,
   *   status: value-of<\ElevenLabs\Types\SpeakerSeparationResponseModelStatus>,
   *   speakers?: array<string, \ElevenLabs\Types\SpeakerResponseModel>|null,
   *   selectedSpeakerIds?: string[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->voiceId = $values['voiceId'];
    $this->sampleId = $values['sampleId'];
    $this->status = $values['status'];
    $this->speakers = $values['speakers'] ?? null;
    $this->selectedSpeakerIds = $values['selectedSpeakerIds'] ?? null;

    $this->_dirtyFields = [
      'voice_id' => true,
      'sample_id' => true,
      'status' => true
    ];
    if (array_key_exists('speakers', $values)) {
      $this->_dirtyFields['speakers'] = true;
    }
    if (array_key_exists('selectedSpeakerIds', $values)) {
      $this->_dirtyFields['selected_speaker_ids'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'voice_id',
      'contents' => $this->voiceId
    ];

    $parts[] = [
      'name' => 'sample_id',
      'contents' => $this->sampleId
    ];

    $parts[] = [
      'name' => 'status',
      'contents' => $this->status
    ];

    if ($this->speakers !== null) {
      $parts[] = [
        'name' => 'speakers',
        'contents' => json_encode($this->speakers),
        'headers' => ['Content-Type' => 'application/json']
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

    return $parts;
  }

  public function validate(): void
  {
  }
}
