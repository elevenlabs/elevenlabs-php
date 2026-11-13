<?php

declare(strict_types=1);

namespace ElevenLabs\Music\Finetunes\Requests;

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
class BodyCreateMusicFinetuneV1MusicFinetunesPost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Name for the finetune (5-200 characters).
   */
  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * Primary musical genre of the finetune.
   */
  #[JsonProperty('primary_genre', required: true)]
  public string $primaryGenre;

  /**
   * @var mixed[]|null
   * Audio files to train on.
   */
  #[JsonProperty('files')]
  public ?array $files;

  /**
   * @var string[]|null
   * Tags to associate with the finetune.
   */
  #[JsonProperty('tags'), ArrayType(['string'])]
  public ?array $tags;

  /**
   * @var ?value-of<\ElevenLabs\Music\Finetunes\Types\CreateFinetunesRequestVisibility>
   * Finetune visibility. Only 'private' and 'workspace' can be set.
   */
  #[JsonProperty('visibility')]
  public ?string $visibility;

  /**
   * @var ?value-of<\ElevenLabs\Types\MusicModelId>
   */
  #[JsonProperty('model_id')]
  public ?string $modelId;

  /**
   * @param array{
   *   name: string,
   *   primaryGenre: string,
   *   files?: mixed[]|null,
   *   tags?: string[]|null,
   *   visibility?: ?value-of<\ElevenLabs\Music\Finetunes\Types\CreateFinetunesRequestVisibility>,
   *   modelId?: ?value-of<\ElevenLabs\Types\MusicModelId>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->name = $values['name'];
    $this->primaryGenre = $values['primaryGenre'];
    $this->files = $values['files'] ?? null;
    $this->tags = $values['tags'] ?? null;
    $this->visibility = $values['visibility'] ?? null;
    $this->modelId = $values['modelId'] ?? null;

    $this->_dirtyFields = [
      'name' => true,
      'primary_genre' => true
    ];
    if (array_key_exists('files', $values)) {
      $this->_dirtyFields['files'] = true;
    }
    if (array_key_exists('tags', $values)) {
      $this->_dirtyFields['tags'] = true;
    }
    if (array_key_exists('visibility', $values)) {
      $this->_dirtyFields['visibility'] = true;
    }
    if (array_key_exists('modelId', $values)) {
      $this->_dirtyFields['model_id'] = true;
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
      'name' => 'primary_genre',
      'contents' => $this->primaryGenre
    ];

    if ($this->files !== null) {
      foreach ($this->files ?? [] as $item) {
        $parts[] = $item->toMultipartFormDataPart('files')->toGuzzlePart();
      }
    }

    if ($this->tags !== null) {
      foreach ($this->tags ?? [] as $item) {
        $parts[] = [
          'name' => 'tags',
          'contents' => $item
        ];
      }
    }

    if ($this->visibility !== null) {
      $parts[] = [
        'name' => 'visibility',
        'contents' => $this->visibility
      ];
    }

    if ($this->modelId !== null) {
      $parts[] = [
        'name' => 'model_id',
        'contents' => $this->modelId
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->name, 'name', minLength: 5, maxLength: 200);
    Validator::validateArray($this->files, 'files', maxItems: 50);
  }
}
