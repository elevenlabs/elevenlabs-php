<?php

declare(strict_types=1);

namespace ElevenLabs\Voices\Ivc\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyAddVoiceV1VoicesAddPost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The name that identifies this voice. This will be displayed in the dropdown of the website.
   */
  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * @var mixed[]
   * A list of file paths to audio recordings intended for voice cloning.
   */
  #[JsonProperty('files', required: true)]
  public array $files;

  /**
   * If set will remove background noise for voice samples using our audio isolation model. If the samples do not include background noise, it can make the quality worse.
   */
  #[JsonProperty('remove_background_noise')]
  public ?bool $removeBackgroundNoise;

  /**
   * A description of the voice.
   */
  #[JsonProperty('description')]
  public ?string $description;

  /**
   * Labels for the voice. Keys can be language, accent, gender, or age.
   */
  #[JsonProperty('labels')]
  public array|string|null $labels;

  /**
   * @param array{
   *   name: string,
   *   files: mixed[],
   *   removeBackgroundNoise?: ?bool,
   *   description?: ?string,
   *   labels?: array|string|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->name = $values['name'];
    $this->files = $values['files'];
    $this->removeBackgroundNoise = $values['removeBackgroundNoise'] ?? null;
    $this->description = $values['description'] ?? null;
    $this->labels = $values['labels'] ?? null;

    $this->_dirtyFields = [
      'name' => true,
      'files' => true
    ];
    if (array_key_exists('removeBackgroundNoise', $values)) {
      $this->_dirtyFields['remove_background_noise'] = true;
    }
    if (array_key_exists('description', $values)) {
      $this->_dirtyFields['description'] = true;
    }
    if (array_key_exists('labels', $values)) {
      $this->_dirtyFields['labels'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    foreach ($this->files as $item) {
      $parts[] = $item->toMultipartFormDataPart('files')->toGuzzlePart();
    }

    if ($this->removeBackgroundNoise !== null) {
      $parts[] = [
        'name' => 'remove_background_noise',
        'contents' => $this->removeBackgroundNoise ? 'true' : 'false'
      ];
    }

    if ($this->description !== null) {
      $parts[] = [
        'name' => 'description',
        'contents' => $this->description
      ];
    }

    if ($this->labels !== null) {
      $parts[] = [
        'name' => 'labels',
        'contents' => json_encode($this->labels),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
