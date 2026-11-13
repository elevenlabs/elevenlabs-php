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
class RagDocumentIndexResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('id', required: true)]
  public string $id;

  /**
   * @var value-of<\ElevenLabs\Types\EmbeddingModelEnum>
   */
  #[JsonProperty('model', required: true)]
  public string $model;

  /**
   * @var value-of<\ElevenLabs\Types\RagIndexStatus>
   */
  #[JsonProperty('status', required: true)]
  public string $status;

  #[JsonProperty('progress_percentage', required: true)]
  public float $progressPercentage;

  #[JsonProperty('document_model_index_usage', required: true)]
  public \ElevenLabs\Types\RagDocumentIndexUsage $documentModelIndexUsage;

  /**
   * @param array{
   *   id: string,
   *   model: value-of<\ElevenLabs\Types\EmbeddingModelEnum>,
   *   status: value-of<\ElevenLabs\Types\RagIndexStatus>,
   *   progressPercentage: float,
   *   documentModelIndexUsage: \ElevenLabs\Types\RagDocumentIndexUsage,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->id = $values['id'];
    $this->model = $values['model'];
    $this->status = $values['status'];
    $this->progressPercentage = $values['progressPercentage'];
    $this->documentModelIndexUsage = $values['documentModelIndexUsage'];

    $this->_dirtyFields = [
      'id' => true,
      'model' => true,
      'status' => true,
      'progress_percentage' => true,
      'document_model_index_usage' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'id',
      'contents' => $this->id
    ];

    $parts[] = [
      'name' => 'model',
      'contents' => $this->model
    ];

    $parts[] = [
      'name' => 'status',
      'contents' => $this->status
    ];

    $parts[] = [
      'name' => 'progress_percentage',
      'contents' => (string) $this->progressPercentage
    ];

    $parts[] = [
      'name' => 'document_model_index_usage',
      'contents' => json_encode($this->documentModelIndexUsage),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->documentModelIndexUsage->validate();
  }
}
