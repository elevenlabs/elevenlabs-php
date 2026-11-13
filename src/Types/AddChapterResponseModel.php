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
class AddChapterResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('chapter', required: true)]
  public \ElevenLabs\Types\ChapterWithContentResponseModel $chapter;

  /**
   * @param array{
   *   chapter: \ElevenLabs\Types\ChapterWithContentResponseModel,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->chapter = $values['chapter'];

    $this->_dirtyFields = [
      'chapter' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'chapter',
      'contents' => json_encode($this->chapter),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->chapter->validate();
  }
}
