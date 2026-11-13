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
class ChapterContentBlockResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('block_id', required: true)]
  public string $blockId;

  /**
   * @var \ElevenLabs\Types\ChapterContentBlockResponseModelNodesItem[]
   */
  #[
    JsonProperty('nodes', required: true),
    ArrayType([\ElevenLabs\Types\ChapterContentBlockResponseModelNodesItem::class])
  ]
  public array $nodes;

  /**
   * @param array{
   *   blockId: string,
   *   nodes: \ElevenLabs\Types\ChapterContentBlockResponseModelNodesItem[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->blockId = $values['blockId'];
    $this->nodes = $values['nodes'];

    $this->_dirtyFields = [
      'block_id' => true,
      'nodes' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'block_id',
      'contents' => $this->blockId
    ];

    $parts[] = [
      'name' => 'nodes',
      'contents' => json_encode($this->nodes),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
