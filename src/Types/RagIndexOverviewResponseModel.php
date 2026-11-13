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
class RagIndexOverviewResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('total_used_bytes', required: true)]
  public int $totalUsedBytes;

  #[JsonProperty('total_max_bytes', required: true)]
  public int $totalMaxBytes;

  /**
   * @var \ElevenLabs\Types\RagIndexOverviewEmbeddingModelResponseModel[]
   */
  #[
    JsonProperty('models', required: true),
    ArrayType([\ElevenLabs\Types\RagIndexOverviewEmbeddingModelResponseModel::class])
  ]
  public array $models;

  /**
   * @param array{
   *   totalUsedBytes: int,
   *   totalMaxBytes: int,
   *   models: \ElevenLabs\Types\RagIndexOverviewEmbeddingModelResponseModel[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->totalUsedBytes = $values['totalUsedBytes'];
    $this->totalMaxBytes = $values['totalMaxBytes'];
    $this->models = $values['models'];

    $this->_dirtyFields = [
      'total_used_bytes' => true,
      'total_max_bytes' => true,
      'models' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'total_used_bytes',
      'contents' => (string) $this->totalUsedBytes
    ];

    $parts[] = [
      'name' => 'total_max_bytes',
      'contents' => (string) $this->totalMaxBytes
    ];

    $parts[] = [
      'name' => 'models',
      'contents' => json_encode($this->models),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->models as $item) {
      $item->validate();
    }
  }
}
