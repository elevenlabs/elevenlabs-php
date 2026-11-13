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
class BodyBulkDeleteKnowledgeBaseDocumentsV1ConvaiKnowledgeBaseBulkDeletePost extends
  JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var string[]
   * The ids of documents or folders from the knowledge base.
   */
  #[JsonProperty('document_ids', required: true), ArrayType(['string'])]
  public array $documentIds;

  /**
   * If set to true, documents or folders will be deleted regardless of whether they are used by any agents and will be removed from the dependent agents. For non-empty folders, this will also delete all child documents and folders.
   */
  #[JsonProperty('force')]
  public ?bool $force;

  /**
   * @param array{
   *   documentIds: string[],
   *   force?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->documentIds = $values['documentIds'];
    $this->force = $values['force'] ?? null;

    $this->_dirtyFields = [
      'document_ids' => true
    ];
    if (array_key_exists('force', $values)) {
      $this->_dirtyFields['force'] = true;
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

    if ($this->force !== null) {
      $parts[] = [
        'name' => 'force',
        'contents' => $this->force ? 'true' : 'false'
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
