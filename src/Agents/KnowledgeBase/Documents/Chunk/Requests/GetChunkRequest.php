<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\KnowledgeBase\Documents\Chunk\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Types\EmbeddingModelEnum;

class GetChunkRequest extends JsonSerializableType
{
  /**
   * @var ?value-of<EmbeddingModelEnum> $embeddingModel The embedding model used to retrieve the chunk.
   */
  public ?string $embeddingModel;

  /**
   * @param array{
   *   embeddingModel?: ?value-of<EmbeddingModelEnum>,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->embeddingModel = $values['embeddingModel'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'embeddingModel' => $data['embedding_model'] ?? null
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    if ($this->embeddingModel !== null) {
      $result['embedding_model'] = $this->embeddingModel;
    }
    return $result;
  }
}
