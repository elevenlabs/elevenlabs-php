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
class VoiceSamplePreviewResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The base64 encoded audio.
   */
  #[JsonProperty('audio_base_64', required: true)]
  public string $audioBase64;

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
   * The media type of the audio.
   */
  #[JsonProperty('media_type', required: true)]
  public string $mediaType;

  /**
   * The duration of the audio in seconds.
   */
  #[JsonProperty('duration_secs')]
  public ?float $durationSecs;

  /**
   * @param array{
   *   audioBase64: string,
   *   voiceId: string,
   *   sampleId: string,
   *   mediaType: string,
   *   durationSecs?: ?float,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->audioBase64 = $values['audioBase64'];
    $this->voiceId = $values['voiceId'];
    $this->sampleId = $values['sampleId'];
    $this->mediaType = $values['mediaType'];
    $this->durationSecs = $values['durationSecs'] ?? null;

    $this->_dirtyFields = [
      'audio_base_64' => true,
      'voice_id' => true,
      'sample_id' => true,
      'media_type' => true
    ];
    if (array_key_exists('durationSecs', $values)) {
      $this->_dirtyFields['duration_secs'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'audio_base_64',
      'contents' => $this->audioBase64
    ];

    $parts[] = [
      'name' => 'voice_id',
      'contents' => $this->voiceId
    ];

    $parts[] = [
      'name' => 'sample_id',
      'contents' => $this->sampleId
    ];

    $parts[] = [
      'name' => 'media_type',
      'contents' => $this->mediaType
    ];

    if ($this->durationSecs !== null) {
      $parts[] = [
        'name' => 'duration_secs',
        'contents' => (string) $this->durationSecs
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
