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
class ConversationHistoryRagUsageCommonModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('usage_count', required: true)]
  public int $usageCount;

  #[JsonProperty('embedding_model', required: true)]
  public string $embeddingModel;

  /**
   * @param array{
   *   usageCount: int,
   *   embeddingModel: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->usageCount = $values['usageCount'];
    $this->embeddingModel = $values['embeddingModel'];

    $this->_dirtyFields = [
      'usage_count' => true,
      'embedding_model' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'usage_count',
      'contents' => (string) $this->usageCount
    ];

    $parts[] = [
      'name' => 'embedding_model',
      'contents' => $this->embeddingModel
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
