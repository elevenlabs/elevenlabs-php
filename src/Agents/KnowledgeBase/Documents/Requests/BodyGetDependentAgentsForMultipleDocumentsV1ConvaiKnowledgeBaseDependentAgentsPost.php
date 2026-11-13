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
class BodyGetDependentAgentsForMultipleDocumentsV1ConvaiKnowledgeBaseDependentAgentsPost extends
  JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\KnowledgeBaseDependentType>
   * Type of dependent agents to return.
   */
  public ?string $dependentType;

  /**
   * How many documents to return at maximum. Can not exceed 100, defaults to 30.
   */
  public ?int $pageSize;

  /**
   * Used for fetching next page. Cursor is returned in the response.
   */
  public ?string $cursor;

  /**
   * @var string[]
   * The ids of documents or folders from the knowledge base.
   */
  #[JsonProperty('document_ids', required: true), ArrayType(['string'])]
  public array $documentIds;

  /**
   * @param array{
   *   documentIds: string[],
   *   dependentType?: ?value-of<\ElevenLabs\Types\KnowledgeBaseDependentType>,
   *   pageSize?: ?int,
   *   cursor?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->dependentType = $values['dependentType'] ?? null;
    $this->pageSize = $values['pageSize'] ?? null;
    $this->cursor = $values['cursor'] ?? null;
    $this->documentIds = $values['documentIds'];

    $this->_dirtyFields = [
      'document_ids' => true
    ];
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
