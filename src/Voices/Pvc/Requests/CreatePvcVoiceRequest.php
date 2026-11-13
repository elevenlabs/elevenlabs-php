<?php

declare(strict_types=1);

namespace ElevenLabs\Voices\Pvc\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class CreatePvcVoiceRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The name that identifies this voice. This will be displayed in the dropdown of the website.
   */
  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * Language used in the samples.
   */
  #[JsonProperty('language', required: true)]
  public string $language;

  /**
   * Description to use for the created voice.
   */
  #[JsonProperty('description')]
  public ?string $description;

  /**
   * @var array<string, string>|null
   * Labels for the voice. Keys can be language, accent, gender, or age.
   */
  #[JsonProperty('labels'), ArrayType(['string' => 'string'])]
  public ?array $labels;

  /**
   * @param array{
   *   name: string,
   *   language: string,
   *   description?: ?string,
   *   labels?: array<string, string>|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->name = $values['name'];
    $this->language = $values['language'];
    $this->description = $values['description'] ?? null;
    $this->labels = $values['labels'] ?? null;

    $this->_dirtyFields = [
      'name' => true,
      'language' => true
    ];
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

    $parts[] = [
      'name' => 'language',
      'contents' => $this->language
    ];

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
    Validator::validateString($this->name, 'name', maxLength: 100);
    Validator::validateString($this->description, 'description', maxLength: 500);
  }
}
