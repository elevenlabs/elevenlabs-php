<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\KnowledgeBase\Documents\Chunks\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Types\EmbeddingModelEnum;

class ListChunksRequest extends JsonSerializableType
{
  /**
   * @var value-of<EmbeddingModelEnum> $embeddingModel The embedding model used to retrieve the chunk.
   */
  public string $embeddingModel;

  /**
   * @var ?int $pageSize How many documents to return at maximum. Can not exceed 100, defaults to 30.
   */
  public ?int $pageSize;

  /**
   * @var ?string $cursor Used for fetching next page. Cursor is returned in the response.
   */
  public ?string $cursor;

  /**
   * @param array{
   *   embeddingModel: value-of<EmbeddingModelEnum>,
   *   pageSize?: ?int,
   *   cursor?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->embeddingModel = $values['embeddingModel'];
    $this->pageSize = $values['pageSize'] ?? null;
    $this->cursor = $values['cursor'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'embeddingModel' => $data['embedding_model'],
      'pageSize' => $data['page_size'] ?? null,
      'cursor' => $data['cursor'] ?? null
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    $result['embedding_model'] = $this->embeddingModel;
    if ($this->pageSize !== null) {
      $result['page_size'] = $this->pageSize;
    }
    if ($this->cursor !== null) {
      $result['cursor'] = $this->cursor;
    }
    return $result;
  }
}
