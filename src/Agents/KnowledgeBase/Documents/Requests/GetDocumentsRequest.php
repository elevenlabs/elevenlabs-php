<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\KnowledgeBase\Documents\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;

class GetDocumentsRequest extends JsonSerializableType
{
  /**
   * @var ?string $agentId
   */
  public ?string $agentId;

  /**
   * @param array{
   *   agentId?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->agentId = $values['agentId'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'agentId' => $data['agent_id'] ?? null
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
    return $result;
  }
}
