<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\KnowledgeBase\Document\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class RagIndexRequestModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\EmbeddingModelEnum>
   */
  #[JsonProperty('model', required: true)]
  public string $model;

  /**
   * @param array{
   *   model: value-of<\ElevenLabs\Types\EmbeddingModelEnum>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->model = $values['model'];

    $this->_dirtyFields = [
      'model' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
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
