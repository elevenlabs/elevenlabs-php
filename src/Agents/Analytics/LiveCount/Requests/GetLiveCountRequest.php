<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Analytics\LiveCount\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;

class GetLiveCountRequest extends JsonSerializableType
{
  /**
   * @var ?string $agentId The id of an agent to restrict the analytics to.
   */
  public ?string $agentId;

  /**
   * @var ?array $agentIds Restrict analytics to the union of the given agents. Takes precedence over `agent_id` when both are supplied.
   */
  public ?array $agentIds;

  /**
   * @param array{
   *   agentId?: ?string,
   *   agentIds?: ?array,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->agentId = $values['agentId'] ?? null;
    $this->agentIds = $values['agentIds'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'agentId' => $data['agent_id'] ?? null,
      'agentIds' => $data['agent_ids'] ?? null
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    if ($this->agentId !== null) {
      $result['agent_id'] = $this->agentId;
    }
    if ($this->agentIds !== null) {
      $result['agent_ids'] = $this->agentIds;
    }
    return $result;
  }
}
