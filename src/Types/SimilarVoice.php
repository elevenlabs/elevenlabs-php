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
class SimilarVoice extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('voice_id', required: true)]
  public string $voiceId;

  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * @var value-of<\ElevenLabs\Types\VoiceCategory>
   */
  #[JsonProperty('category', required: true)]
  public string $category;

  #[JsonProperty('description')]
  public ?string $description;

  #[JsonProperty('preview_url')]
  public ?string $previewUrl;

  /**
   * @param array{
   *   voiceId: string,
   *   name: string,
   *   category: value-of<\ElevenLabs\Types\VoiceCategory>,
   *   description?: ?string,
   *   previewUrl?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->voiceId = $values['voiceId'];
    $this->name = $values['name'];
    $this->category = $values['category'];
    $this->description = $values['description'] ?? null;
    $this->previewUrl = $values['previewUrl'] ?? null;

    $this->_dirtyFields = [
      'voice_id' => true,
      'name' => true,
      'category' => true
    ];
    if (array_key_exists('description', $values)) {
      $this->_dirtyFields['description'] = true;
    }
    if (array_key_exists('previewUrl', $values)) {
      $this->_dirtyFields['preview_url'] = true;
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
      'name' => 'name',
      'contents' => $this->name
    ];

    $parts[] = [
      'name' => 'category',
      'contents' => $this->category
    ];

    if ($this->description !== null) {
      $parts[] = [
        'name' => 'description',
        'contents' => $this->description
      ];
    }

    if ($this->previewUrl !== null) {
      $parts[] = [
        'name' => 'preview_url',
        'contents' => $this->previewUrl
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
