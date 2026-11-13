<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Conversations\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;

class GetSignedUrlConversationsRequest extends JsonSerializableType
{
  /**
   * @var string $agentId Agent id (agent_…) or speech engine external id (seng_), resolved to the same underlying resource.
   */
  public string $agentId;

  /**
   * @var ?bool $includeConversationId Whether to include a conversation_id with the response. If included, the conversation_signature cannot be used again.
   */
  public ?bool $includeConversationId;

  /**
   * @var ?string $branchId The ID of the branch to use
   */
  public ?string $branchId;

  /**
   * @var ?string $versionId The ID of the version to use
   */
  public ?string $versionId;

  /**
   * @var ?string $environment The environment to use for resolving environment variables (e.g. 'production', 'staging'). Defaults to 'production'.
   */
  public ?string $environment;

  /**
   * @var ?bool $debugEventsRequest Whether to enable debug events. Only available for users with editor access to the agent.
   */
  public ?bool $debugEventsRequest;

  /**
   * @param array{
   *   agentId: string,
   *   includeConversationId?: ?bool,
   *   branchId?: ?string,
   *   versionId?: ?string,
   *   environment?: ?string,
   *   debugEventsRequest?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->agentId = $values['agentId'];
    $this->includeConversationId = $values['includeConversationId'] ?? null;
    $this->branchId = $values['branchId'] ?? null;
    $this->versionId = $values['versionId'] ?? null;
    $this->environment = $values['environment'] ?? null;
    $this->debugEventsRequest = $values['debugEventsRequest'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'agentId' => $data['agent_id'],
      'includeConversationId' => $data['include_conversation_id'] ?? null,
      'branchId' => $data['branch_id'] ?? null,
      'versionId' => $data['version_id'] ?? null,
      'environment' => $data['environment'] ?? null,
      'debugEventsRequest' => $data['debug_events_request'] ?? null
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    $result['agent_id'] = $this->agentId;
    if ($this->includeConversationId !== null) {
      $result['include_conversation_id'] = $this->includeConversationId;
    }
    if ($this->branchId !== null) {
      $result['branch_id'] = $this->branchId;
    }
    if ($this->versionId !== null) {
      $result['version_id'] = $this->versionId;
    }
    if ($this->environment !== null) {
      $result['environment'] = $this->environment;
    }
    if ($this->debugEventsRequest !== null) {
      $result['debug_events_request'] = $this->debugEventsRequest;
    }
    return $result;
  }
}
