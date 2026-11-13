<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Conversations\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;

class ResolveConversationsRequest extends JsonSerializableType
{
  /**
   * @var string $agentId Agent id (agent_…) or speech engine external id (seng_), resolved to the same underlying resource.
   */
  public string $agentId;

  /**
   * @var string $reference A Slack message URL or a Zendesk ticket URL.
   */
  public string $reference;

  /**
   * @param array{
   *   agentId: string,
   *   reference: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->agentId = $values['agentId'];
    $this->reference = $values['reference'];
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'agentId' => $data['agent_id'],
      'reference' => $data['reference']
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    $result['agent_id'] = $this->agentId;
    $result['reference'] = $this->reference;
    return $result;
  }
}
