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
class VoiceStatisticsResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The project voice reference ID.
   */
  #[JsonProperty('project_voice_ref_id', required: true)]
  public string $projectVoiceRefId;

  /**
   * The number of unconverted characters for this voice.
   */
  #[JsonProperty('characters_unconverted', required: true)]
  public int $charactersUnconverted;

  /**
   * The number of converted characters for this voice.
   */
  #[JsonProperty('characters_converted', required: true)]
  public int $charactersConverted;

  /**
   * The number of credits needed to convert the remaining audio for this voice.
   */
  #[JsonProperty('credits_needed_to_convert')]
  public ?int $creditsNeededToConvert;

  /**
   * The voice ID.
   */
  #[JsonProperty('voice_id')]
  public ?string $voiceId;

  /**
   * @param array{
   *   projectVoiceRefId: string,
   *   charactersUnconverted: int,
   *   charactersConverted: int,
   *   creditsNeededToConvert?: ?int,
   *   voiceId?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->projectVoiceRefId = $values['projectVoiceRefId'];
    $this->charactersUnconverted = $values['charactersUnconverted'];
    $this->charactersConverted = $values['charactersConverted'];
    $this->creditsNeededToConvert = $values['creditsNeededToConvert'] ?? null;
    $this->voiceId = $values['voiceId'] ?? null;

    $this->_dirtyFields = [
      'project_voice_ref_id' => true,
      'characters_unconverted' => true,
      'characters_converted' => true
    ];
    if (array_key_exists('creditsNeededToConvert', $values)) {
      $this->_dirtyFields['credits_needed_to_convert'] = true;
    }
    if (array_key_exists('voiceId', $values)) {
      $this->_dirtyFields['voice_id'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'project_voice_ref_id',
      'contents' => $this->projectVoiceRefId
    ];

    $parts[] = [
      'name' => 'characters_unconverted',
      'contents' => (string) $this->charactersUnconverted
    ];

    $parts[] = [
      'name' => 'characters_converted',
      'contents' => (string) $this->charactersConverted
    ];

    if ($this->creditsNeededToConvert !== null) {
      $parts[] = [
        'name' => 'credits_needed_to_convert',
        'contents' => (string) $this->creditsNeededToConvert
      ];
    }

    if ($this->voiceId !== null) {
      $parts[] = [
        'name' => 'voice_id',
        'contents' => $this->voiceId
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
