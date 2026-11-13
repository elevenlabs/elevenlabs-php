<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\KnowledgeBase\Requests;

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
class BodyComputeRagIndexesInBatchV1ConvaiKnowledgeBaseRagIndexPost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\GetOrCreateRagIndexRequestModel[]
   * List of requested RAG indexes. Minimum 1, maximum 100 items.
   */
  #[
    JsonProperty('items', required: true),
    ArrayType([\ElevenLabs\Types\GetOrCreateRagIndexRequestModel::class])
  ]
  public array $items;

  /**
   * @param array{
   *   items: \ElevenLabs\Types\GetOrCreateRagIndexRequestModel[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->items = $values['items'];

    $this->_dirtyFields = [
      'items' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'items',
      'contents' => json_encode($this->items),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->items as $item) {
      $item->validate();
    }
    Validator::validateArray($this->items, 'items', minItems: 1, maxItems: 100);
  }
}
