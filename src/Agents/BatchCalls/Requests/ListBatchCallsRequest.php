<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\BatchCalls\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;

class ListBatchCallsRequest extends JsonSerializableType
{
  /**
   * @var ?int $limit
   */
  public ?int $limit;

  /**
   * @var ?string $lastDoc
   */
  public ?string $lastDoc;

  /**
   * @var ?string $agentId Filter batch calls to a single agent.
   */
  public ?string $agentId;

  /**
   * @param array{
   *   limit?: ?int,
   *   lastDoc?: ?string,
   *   agentId?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->limit = $values['limit'] ?? null;
    $this->lastDoc = $values['lastDoc'] ?? null;
    $this->agentId = $values['agentId'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'limit' => $data['limit'] ?? null,
      'lastDoc' => $data['last_doc'] ?? null,
      'agentId' => $data['agent_id'] ?? null
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    if ($this->limit !== null) {
      $result['limit'] = $this->limit;
    }
    if ($this->lastDoc !== null) {
      $result['last_doc'] = $this->lastDoc;
    }
    if ($this->agentId !== null) {
      $result['agent_id'] = $this->agentId;
    }
    return $result;
  }
}
