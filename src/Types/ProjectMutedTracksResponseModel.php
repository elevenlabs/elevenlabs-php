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
class ProjectMutedTracksResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var string[]
   * List of chapter IDs that have muted tracks.
   */
  #[JsonProperty('chapter_ids', required: true), ArrayType(['string'])]
  public array $chapterIds;

  /**
   * @param array{
   *   chapterIds: string[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->chapterIds = $values['chapterIds'];

    $this->_dirtyFields = [
      'chapter_ids' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    foreach ($this->chapterIds as $item) {
      $parts[] = [
        'name' => 'chapter_ids',
        'contents' => $item
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
