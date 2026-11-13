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
class UpdateMusicFinetuneRequestModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Updated name for the finetune.
   */
  #[JsonProperty('name')]
  public ?string $name;

  /**
   * @var string[]|null
   * Replacement set of tags.
   */
  #[JsonProperty('tags'), ArrayType(['string'])]
  public ?array $tags;

  /**
   * Updated primary musical genre.
   */
  #[JsonProperty('primary_genre')]
  public ?string $primaryGenre;

  /**
   * @var ?value-of<\ElevenLabs\Music\Finetunes\Types\UpdateMusicFinetuneRequestModelVisibility>
   * Finetune visibility. Only 'private' and 'workspace' can be set.
   */
  #[JsonProperty('visibility')]
  public ?string $visibility;

  /**
   * @param array{
   *   name?: ?string,
   *   tags?: string[]|null,
   *   primaryGenre?: ?string,
   *   visibility?: ?value-of<\ElevenLabs\Music\Finetunes\Types\UpdateMusicFinetuneRequestModelVisibility>,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->name = $values['name'] ?? null;
    $this->tags = $values['tags'] ?? null;
    $this->primaryGenre = $values['primaryGenre'] ?? null;
    $this->visibility = $values['visibility'] ?? null;

    if (array_key_exists('name', $values)) {
      $this->_dirtyFields['name'] = true;
    }
    if (array_key_exists('tags', $values)) {
      $this->_dirtyFields['tags'] = true;
    }
    if (array_key_exists('primaryGenre', $values)) {
      $this->_dirtyFields['primary_genre'] = true;
    }
    if (array_key_exists('visibility', $values)) {
      $this->_dirtyFields['visibility'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->name !== null) {
      $parts[] = [
        'name' => 'name',
        'contents' => $this->name
      ];
    }

    if ($this->tags !== null) {
      foreach ($this->tags ?? [] as $item) {
        $parts[] = [
          'name' => 'tags',
          'contents' => $item
        ];
      }
    }

    if ($this->primaryGenre !== null) {
      $parts[] = [
        'name' => 'primary_genre',
        'contents' => $this->primaryGenre
      ];
    }

    if ($this->visibility !== null) {
      $parts[] = [
        'name' => 'visibility',
        'contents' => $this->visibility
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->name, 'name', minLength: 5, maxLength: 200);
    Validator::validateArray($this->tags, 'tags', maxItems: 5);
  }
}
