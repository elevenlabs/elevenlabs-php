<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\KnowledgeBase\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;

class SearchKnowledgeBaseRequest extends JsonSerializableType
{
  /**
   * @var string $query The search query text
   */
  public string $query;

  /**
   * @var ?int $pageSize How many documents to return at maximum. Can not exceed 100, defaults to 30.
   */
  public ?int $pageSize;

  /**
   * @var ?array $types If present, the endpoint will return only documents of the given types.
   */
  public ?array $types;

  /**
   * @var ?string $cursor Used for fetching next page. Cursor is returned in the response.
   */
  public ?string $cursor;

  /**
   * @param array{
   *   query: string,
   *   pageSize?: ?int,
   *   types?: ?array,
   *   cursor?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->query = $values['query'];
    $this->pageSize = $values['pageSize'] ?? null;
    $this->types = $values['types'] ?? null;
    $this->cursor = $values['cursor'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'query' => $data['query'],
      'pageSize' => $data['page_size'] ?? null,
      'types' => $data['types'] ?? null,
      'cursor' => $data['cursor'] ?? null
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    $result['query'] = $this->query;
    if ($this->pageSize !== null) {
      $result['page_size'] = $this->pageSize;
    }
    if ($this->types !== null) {
      $result['types'] = $this->types;
    }
    if ($this->cursor !== null) {
      $result['cursor'] = $this->cursor;
    }
    return $result;
  }
}
