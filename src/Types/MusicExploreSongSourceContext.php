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
class MusicExploreSongSourceContext extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\MusicExploreSongSourceContextSourceType>
   */
  #[JsonProperty('source_type')]
  public ?string $sourceType;

  #[JsonProperty('music_explore_song_id', required: true)]
  public string $musicExploreSongId;

  #[JsonProperty('title')]
  public ?string $title;

  #[JsonProperty('description')]
  public ?string $description;

  #[JsonProperty('bpm')]
  public ?int $bpm;

  #[JsonProperty('vocals')]
  public ?string $vocals;

  #[JsonProperty('lyrics')]
  public ?string $lyrics;

  /**
   * @param array{
   *   musicExploreSongId: string,
   *   sourceType?: ?value-of<\ElevenLabs\Types\MusicExploreSongSourceContextSourceType>,
   *   title?: ?string,
   *   description?: ?string,
   *   bpm?: ?int,
   *   vocals?: ?string,
   *   lyrics?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->sourceType = $values['sourceType'] ?? 'music_explore_song';
    $this->musicExploreSongId = $values['musicExploreSongId'];
    $this->title = $values['title'] ?? null;
    $this->description = $values['description'] ?? null;
    $this->bpm = $values['bpm'] ?? null;
    $this->vocals = $values['vocals'] ?? null;
    $this->lyrics = $values['lyrics'] ?? null;

    $this->_dirtyFields = [
      'music_explore_song_id' => true
    ];
    if (array_key_exists('sourceType', $values)) {
      $this->_dirtyFields['source_type'] = true;
    }
    if (array_key_exists('title', $values)) {
      $this->_dirtyFields['title'] = true;
    }
    if (array_key_exists('description', $values)) {
      $this->_dirtyFields['description'] = true;
    }
    if (array_key_exists('bpm', $values)) {
      $this->_dirtyFields['bpm'] = true;
    }
    if (array_key_exists('vocals', $values)) {
      $this->_dirtyFields['vocals'] = true;
    }
    if (array_key_exists('lyrics', $values)) {
      $this->_dirtyFields['lyrics'] = true;
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
      'name' => 'music_explore_song_id',
      'contents' => $this->musicExploreSongId
    ];

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

    if ($this->bpm !== null) {
      $parts[] = [
        'name' => 'bpm',
        'contents' => (string) $this->bpm
      ];
    }

    if ($this->vocals !== null) {
      $parts[] = [
        'name' => 'vocals',
        'contents' => $this->vocals
      ];
    }

    if ($this->lyrics !== null) {
      $parts[] = [
        'name' => 'lyrics',
        'contents' => $this->lyrics
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
