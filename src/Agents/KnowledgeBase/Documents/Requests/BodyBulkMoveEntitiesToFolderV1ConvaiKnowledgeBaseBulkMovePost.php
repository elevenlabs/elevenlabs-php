<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\KnowledgeBase\Documents\Requests;

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
class BodyBulkMoveEntitiesToFolderV1ConvaiKnowledgeBaseBulkMovePost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var string[]
   * The ids of documents or folders from the knowledge base.
   */
  #[JsonProperty('document_ids', required: true), ArrayType(['string'])]
  public array $documentIds;

  /**
   * The folder to move the entities to. If not set, the entities will be moved to the root folder.
   */
  #[JsonProperty('move_to')]
  public ?string $moveTo;

  /**
   * @param array{
   *   documentIds: string[],
   *   moveTo?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->documentIds = $values['documentIds'];
    $this->moveTo = $values['moveTo'] ?? null;

    $this->_dirtyFields = [
      'document_ids' => true
    ];
    if (array_key_exists('moveTo', $values)) {
      $this->_dirtyFields['move_to'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    foreach ($this->documentIds as $item) {
      $parts[] = [
        'name' => 'document_ids',
        'contents' => $item
      ];
    }

    if ($this->moveTo !== null) {
      $parts[] = [
        'name' => 'move_to',
        'contents' => $this->moveTo
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateArray(
      $this->documentIds,
      'document_ids',
      minItems: 1,
      maxItems: 20,
      uniqueItems: true
    );
  }
}
