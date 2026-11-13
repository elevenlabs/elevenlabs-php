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
class SongSourceContext extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\SongSourceContextSourceType>
   */
  #[JsonProperty('source_type')]
  public ?string $sourceType;

  #[JsonProperty('song_id', required: true)]
  public string $songId;

  #[JsonProperty('chat_id')]
  public ?string $chatId;

  #[JsonProperty('title')]
  public ?string $title;

  #[JsonProperty('description')]
  public ?string $description;

  /**
   * @var string[]|null
   */
  #[JsonProperty('genres'), ArrayType(['string'])]
  public ?array $genres;

  /**
   * @var string[]|null
   */
  #[JsonProperty('languages'), ArrayType(['string'])]
  public ?array $languages;

  #[JsonProperty('is_explicit')]
  public ?bool $isExplicit;

  #[JsonProperty('bpm')]
  public ?int $bpm;

  /**
   * @var array<string, mixed>|null
   */
  #[JsonProperty('generation_settings'), ArrayType(['string' => 'mixed'])]
  public ?array $generationSettings;

  /**
   * @param array{
   *   songId: string,
   *   sourceType?: ?value-of<\ElevenLabs\Types\SongSourceContextSourceType>,
   *   chatId?: ?string,
   *   title?: ?string,
   *   description?: ?string,
   *   genres?: string[]|null,
   *   languages?: string[]|null,
   *   isExplicit?: ?bool,
   *   bpm?: ?int,
   *   generationSettings?: array<string, mixed>|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->sourceType = $values['sourceType'] ?? 'song';
    $this->songId = $values['songId'];
    $this->chatId = $values['chatId'] ?? null;
    $this->title = $values['title'] ?? null;
    $this->description = $values['description'] ?? null;
    $this->genres = $values['genres'] ?? null;
    $this->languages = $values['languages'] ?? null;
    $this->isExplicit = $values['isExplicit'] ?? null;
    $this->bpm = $values['bpm'] ?? null;
    $this->generationSettings = $values['generationSettings'] ?? null;

    $this->_dirtyFields = [
      'song_id' => true
    ];
    if (array_key_exists('sourceType', $values)) {
      $this->_dirtyFields['source_type'] = true;
    }
    if (array_key_exists('chatId', $values)) {
      $this->_dirtyFields['chat_id'] = true;
    }
    if (array_key_exists('title', $values)) {
      $this->_dirtyFields['title'] = true;
    }
    if (array_key_exists('description', $values)) {
      $this->_dirtyFields['description'] = true;
    }
    if (array_key_exists('genres', $values)) {
      $this->_dirtyFields['genres'] = true;
    }
    if (array_key_exists('languages', $values)) {
      $this->_dirtyFields['languages'] = true;
    }
    if (array_key_exists('isExplicit', $values)) {
      $this->_dirtyFields['is_explicit'] = true;
    }
    if (array_key_exists('bpm', $values)) {
      $this->_dirtyFields['bpm'] = true;
    }
    if (array_key_exists('generationSettings', $values)) {
      $this->_dirtyFields['generation_settings'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->sourceType !== null) {
      $parts[] = [
        'name' => 'source_type',
        'contents' => $this->sourceType
      ];
    }

    $parts[] = [
      'name' => 'song_id',
      'contents' => $this->songId
    ];

    if ($this->chatId !== null) {
      $parts[] = [
        'name' => 'chat_id',
        'contents' => $this->chatId
      ];
    }

    if ($this->title !== null) {
      $parts[] = [
        'name' => 'title',
        'contents' => $this->title
      ];
    }

    if ($this->description !== null) {
      $parts[] = [
        'name' => 'description',
        'contents' => $this->description
      ];
    }

    if ($this->genres !== null) {
      foreach ($this->genres ?? [] as $item) {
        $parts[] = [
          'name' => 'genres',
          'contents' => $item
        ];
      }
    }

    if ($this->languages !== null) {
      foreach ($this->languages ?? [] as $item) {
        $parts[] = [
          'name' => 'languages',
          'contents' => $item
        ];
      }
    }

    if ($this->isExplicit !== null) {
      $parts[] = [
        'name' => 'is_explicit',
        'contents' => $this->isExplicit ? 'true' : 'false'
      ];
    }

    if ($this->bpm !== null) {
      $parts[] = [
        'name' => 'bpm',
        'contents' => (string) $this->bpm
      ];
    }

    if ($this->generationSettings !== null) {
      $parts[] = [
        'name' => 'generation_settings',
        'contents' => json_encode($this->generationSettings),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
