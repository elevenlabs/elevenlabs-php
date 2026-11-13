<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Summaries\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;

class GetSummariesRequest extends JsonSerializableType
{
  /**
   * @var ?array $agentIds List of agent IDs to fetch summaries for
   */
  public ?array $agentIds;

  /**
   * @param array{
   *   agentIds?: ?array,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->agentIds = $values['agentIds'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'agentIds' => $data['agent_ids'] ?? null
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    if ($this->agentIds !== null) {
      $result['agent_ids'] = $this->agentIds;
    }
    return $result;
  }
}
