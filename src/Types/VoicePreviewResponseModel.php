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
class VoicePreviewResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The base64 encoded audio of the preview.
   */
  #[JsonProperty('audio_base_64', required: true)]
  public string $audioBase64;

  /**
   * The ID of the generated voice. Use it to create a voice from the preview.
   */
  #[JsonProperty('generated_voice_id', required: true)]
  public string $generatedVoiceId;

  /**
   * The media type of the preview.
   */
  #[JsonProperty('media_type', required: true)]
  public string $mediaType;

  /**
   * The duration of the preview in seconds.
   */
  #[JsonProperty('duration_secs', required: true)]
  public float $durationSecs;

  /**
   * The language of the preview.
   */
  #[JsonProperty('language', required: true)]
  public ?string $language;

  /**
   * @param array{
   *   audioBase64: string,
   *   generatedVoiceId: string,
   *   mediaType: string,
   *   durationSecs: float,
   *   language: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->audioBase64 = $values['audioBase64'];
    $this->generatedVoiceId = $values['generatedVoiceId'];
    $this->mediaType = $values['mediaType'];
    $this->durationSecs = $values['durationSecs'];
    $this->language = $values['language'];

    $this->_dirtyFields = [
      'audio_base_64' => true,
      'generated_voice_id' => true,
      'media_type' => true,
      'duration_secs' => true,
      'language' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'audio_base_64',
      'contents' => $this->audioBase64
    ];

    $parts[] = [
      'name' => 'generated_voice_id',
      'contents' => $this->generatedVoiceId
    ];

    $parts[] = [
      'name' => 'media_type',
      'contents' => $this->mediaType
    ];

    $parts[] = [
      'name' => 'duration_secs',
      'contents' => (string) $this->durationSecs
    ];

    $parts[] = [
      'name' => 'language',
      'contents' => $this->language
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
