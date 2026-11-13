<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class SongMetadata extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The title of the song
   */
  #[JsonProperty('title', required: true)]
  public ?string $title;

  /**
   * The description of the song
   */
  #[JsonProperty('description', required: true)]
  public ?string $description;

  /**
   * @var string[]
   * The genres of the song
   */
  #[JsonProperty('genres', required: true), ArrayType(['string'])]
  public array $genres;

  /**
   * @var string[]
   * The languages of the song
   */
  #[JsonProperty('languages', required: true), ArrayType(['string'])]
  public array $languages;

  /**
   * Whether the song is explicit
   */
  #[JsonProperty('is_explicit', required: true)]
  public ?bool $isExplicit;

  /**
   * @param array{
   *   title: ?string,
   *   description: ?string,
   *   genres: string[],
   *   languages: string[],
   *   isExplicit: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->title = $values['title'];
    $this->description = $values['description'];
    $this->genres = $values['genres'];
    $this->languages = $values['languages'];
    $this->isExplicit = $values['isExplicit'];

    $this->_dirtyFields = [
      'title' => true,
      'description' => true,
      'genres' => true,
      'languages' => true,
      'is_explicit' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'title',
      'contents' => $this->title
    ];

    $parts[] = [
      'name' => 'description',
      'contents' => $this->description
    ];

    foreach ($this->genres as $item) {
      $parts[] = [
        'name' => 'genres',
        'contents' => $item
      ];
    }

    foreach ($this->languages as $item) {
      $parts[] = [
        'name' => 'languages',
        'contents' => $item
      ];
    }

    $parts[] = [
      'name' => 'is_explicit',
      'contents' => $this->isExplicit ? 'true' : 'false'
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
