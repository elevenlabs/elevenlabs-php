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
class ChapterContentBlockInputModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\ChapterContentBlockInputModelSubType>
   */
  #[JsonProperty('sub_type')]
  public ?string $subType;

  /**
   * @var \ElevenLabs\Types\ChapterContentParagraphTtsNodeInputModel[]
   */
  #[
    JsonProperty('nodes', required: true),
    ArrayType([\ElevenLabs\Types\ChapterContentParagraphTtsNodeInputModel::class])
  ]
  public array $nodes;

  #[JsonProperty('block_id')]
  public ?string $blockId;

  /**
   * @param array{
   *   nodes: \ElevenLabs\Types\ChapterContentParagraphTtsNodeInputModel[],
   *   subType?: ?value-of<\ElevenLabs\Types\ChapterContentBlockInputModelSubType>,
   *   blockId?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->subType = $values['subType'] ?? null;
    $this->nodes = $values['nodes'];
    $this->blockId = $values['blockId'] ?? null;

    $this->_dirtyFields = [
      'nodes' => true
    ];
    if (array_key_exists('subType', $values)) {
      $this->_dirtyFields['sub_type'] = true;
    }
    if (array_key_exists('blockId', $values)) {
      $this->_dirtyFields['block_id'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->subType !== null) {
      $parts[] = [
        'name' => 'sub_type',
        'contents' => $this->subType
      ];
    }

    $parts[] = [
      'name' => 'nodes',
      'contents' => json_encode($this->nodes),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->blockId !== null) {
      $parts[] = [
        'name' => 'block_id',
        'contents' => $this->blockId
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->nodes as $item) {
      $item->validate();
    }
  }
}
