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
class ProjectVoiceResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('project_voice_ref_id', required: true)]
  public string $projectVoiceRefId;

  #[JsonProperty('voice_id', required: true)]
  public string $voiceId;

  #[JsonProperty('alias', required: true)]
  public string $alias;

  #[JsonProperty('stability', required: true)]
  public float $stability;

  #[JsonProperty('similarity_boost', required: true)]
  public float $similarityBoost;

  #[JsonProperty('style', required: true)]
  public float $style;

  #[JsonProperty('is_pinned', required: true)]
  public bool $isPinned;

  #[JsonProperty('use_speaker_boost', required: true)]
  public bool $useSpeakerBoost;

  #[JsonProperty('volume_gain', required: true)]
  public float $volumeGain;

  #[JsonProperty('speed', required: true)]
  public float $speed;

  /**
   * @param array{
   *   projectVoiceRefId: string,
   *   voiceId: string,
   *   alias: string,
   *   stability: float,
   *   similarityBoost: float,
   *   style: float,
   *   isPinned: bool,
   *   useSpeakerBoost: bool,
   *   volumeGain: float,
   *   speed: float,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->projectVoiceRefId = $values['projectVoiceRefId'];
    $this->voiceId = $values['voiceId'];
    $this->alias = $values['alias'];
    $this->stability = $values['stability'];
    $this->similarityBoost = $values['similarityBoost'];
    $this->style = $values['style'];
    $this->isPinned = $values['isPinned'];
    $this->useSpeakerBoost = $values['useSpeakerBoost'];
    $this->volumeGain = $values['volumeGain'];
    $this->speed = $values['speed'];

    $this->_dirtyFields = [
      'project_voice_ref_id' => true,
      'voice_id' => true,
      'alias' => true,
      'stability' => true,
      'similarity_boost' => true,
      'style' => true,
      'is_pinned' => true,
      'use_speaker_boost' => true,
      'volume_gain' => true,
      'speed' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'project_voice_ref_id',
      'contents' => $this->projectVoiceRefId
    ];

    $parts[] = [
      'name' => 'voice_id',
      'contents' => $this->voiceId
    ];

    $parts[] = [
      'name' => 'alias',
      'contents' => $this->alias
    ];

    $parts[] = [
      'name' => 'stability',
      'contents' => (string) $this->stability
    ];

    $parts[] = [
      'name' => 'similarity_boost',
      'contents' => (string) $this->similarityBoost
    ];

    $parts[] = [
      'name' => 'style',
      'contents' => (string) $this->style
    ];

    $parts[] = [
      'name' => 'is_pinned',
      'contents' => $this->isPinned ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'use_speaker_boost',
      'contents' => $this->useSpeakerBoost ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'volume_gain',
      'contents' => (string) $this->volumeGain
    ];

    $parts[] = [
      'name' => 'speed',
      'contents' => (string) $this->speed
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
