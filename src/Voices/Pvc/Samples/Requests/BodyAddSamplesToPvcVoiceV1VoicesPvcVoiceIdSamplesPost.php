<?php

declare(strict_types=1);

namespace ElevenLabs\Voices\Pvc\Samples\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyAddSamplesToPvcVoiceV1VoicesPvcVoiceIdSamplesPost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var mixed[]
   * Audio files used to create the voice.
   */
  #[JsonProperty('files', required: true)]
  public array $files;

  /**
   * If set will remove background noise for voice samples using our audio isolation model. If the samples do not include background noise, it can make the quality worse.
   */
  #[JsonProperty('remove_background_noise')]
  public ?bool $removeBackgroundNoise;

  /**
   * @param array{
   *   files: mixed[],
   *   removeBackgroundNoise?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->files = $values['files'];
    $this->removeBackgroundNoise = $values['removeBackgroundNoise'] ?? null;

    $this->_dirtyFields = [
      'files' => true
    ];
    if (array_key_exists('removeBackgroundNoise', $values)) {
      $this->_dirtyFields['remove_background_noise'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    foreach ($this->files as $item) {
      $parts[] = $item->toMultipartFormDataPart('files')->toGuzzlePart();
    }

    if ($this->removeBackgroundNoise !== null) {
      $parts[] = [
        'name' => 'remove_background_noise',
        'contents' => $this->removeBackgroundNoise ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
