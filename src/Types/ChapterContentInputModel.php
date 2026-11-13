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
class ChapterContentInputModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\ChapterContentBlockInputModel[]
   */
  #[
    JsonProperty('blocks', required: true),
    ArrayType([\ElevenLabs\Types\ChapterContentBlockInputModel::class])
  ]
  public array $blocks;

  /**
   * @param array{
   *   blocks: \ElevenLabs\Types\ChapterContentBlockInputModel[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->blocks = $values['blocks'];

    $this->_dirtyFields = [
      'blocks' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'blocks',
      'contents' => json_encode($this->blocks),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->blocks as $item) {
      $item->validate();
    }
  }
}
