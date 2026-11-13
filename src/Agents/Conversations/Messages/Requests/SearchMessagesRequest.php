<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Conversations\Messages\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;

class SearchMessagesRequest extends JsonSerializableType
{
  /**
   * @var string $textQuery The search query text for semantic similarity matching
   */
  public string $textQuery;

  /**
   * @var ?string $agentId Agent id (agent_…) or speech engine external id (seng_), resolved to the same underlying resource.
   */
  public ?string $agentId;

  /**
   * @var ?string $branchId Filter conversations by branch ID.
   */
  public ?string $branchId;

  /**
   * @var ?int $pageSize Number of results per page. Max 50.
   */
  public ?int $pageSize;

  /**
   * @var ?string $cursor Used for fetching next page. Cursor is returned in the response.
   */
  public ?string $cursor;

  /**
   * @param array{
   *   textQuery: string,
   *   agentId?: ?string,
   *   branchId?: ?string,
   *   pageSize?: ?int,
   *   cursor?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->textQuery = $values['textQuery'];
    $this->agentId = $values['agentId'] ?? null;
    $this->branchId = $values['branchId'] ?? null;
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
      'textQuery' => $data['text_query'],
      'agentId' => $data['agent_id'] ?? null,
      'branchId' => $data['branch_id'] ?? null,
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
    $result['text_query'] = $this->textQuery;
    if ($this->agentId !== null) {
      $result['agent_id'] = $this->agentId;
    }
    if ($this->branchId !== null) {
      $result['branch_id'] = $this->branchId;
    }
    if ($this->pageSize !== null) {
      $result['page_size'] = $this->pageSize;
    }
    if ($this->cursor !== null) {
      $result['cursor'] = $this->cursor;
    }
    return $result;
  }
}
