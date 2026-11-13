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
class GetOrCreateRagIndexRequestModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * ID of the knowledgebase document for which to retrieve the index
   */
  #[JsonProperty('document_id', required: true)]
  public string $documentId;

  /**
   * Whether to create the RAG index if it does not exist
   */
  #[JsonProperty('create_if_missing', required: true)]
  public bool $createIfMissing;

  /**
   * @var value-of<\ElevenLabs\Types\EmbeddingModelEnum>
   */
  #[JsonProperty('model', required: true)]
  public string $model;

  /**
   * @param array{
   *   documentId: string,
   *   createIfMissing: bool,
   *   model: value-of<\ElevenLabs\Types\EmbeddingModelEnum>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->documentId = $values['documentId'];
    $this->createIfMissing = $values['createIfMissing'];
    $this->model = $values['model'];

    $this->_dirtyFields = [
      'document_id' => true,
      'create_if_missing' => true,
      'model' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'document_id',
      'contents' => $this->documentId
    ];

    $parts[] = [
      'name' => 'create_if_missing',
      'contents' => $this->createIfMissing ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'model',
      'contents' => $this->model
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
