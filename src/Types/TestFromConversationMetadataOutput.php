<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class TestFromConversationMetadataOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('conversation_id', required: true)]
  public string $conversationId;

  #[JsonProperty('agent_id', required: true)]
  public string $agentId;

  #[JsonProperty('branch_id')]
  public ?string $branchId;

  #[JsonProperty('workflow_node_id')]
  public ?string $workflowNodeId;

  /**
   * @var \ElevenLabs\Types\ConversationHistoryTranscriptCommonModelOutput[]|null
   */
  #[
    JsonProperty('original_agent_reply'),
    ArrayType([\ElevenLabs\Types\ConversationHistoryTranscriptCommonModelOutput::class])
  ]
  public ?array $originalAgentReply;

  /**
   * @param array{
   *   conversationId: string,
   *   agentId: string,
   *   branchId?: ?string,
   *   workflowNodeId?: ?string,
   *   originalAgentReply?: \ElevenLabs\Types\ConversationHistoryTranscriptCommonModelOutput[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->conversationId = $values['conversationId'];
    $this->agentId = $values['agentId'];
    $this->branchId = $values['branchId'] ?? null;
    $this->workflowNodeId = $values['workflowNodeId'] ?? null;
    $this->originalAgentReply = $values['originalAgentReply'] ?? null;

    $this->_dirtyFields = [
      'conversation_id' => true,
      'agent_id' => true
    ];
    if (array_key_exists('branchId', $values)) {
      $this->_dirtyFields['branch_id'] = true;
    }
    if (array_key_exists('workflowNodeId', $values)) {
      $this->_dirtyFields['workflow_node_id'] = true;
    }
    if (array_key_exists('originalAgentReply', $values)) {
      $this->_dirtyFields['original_agent_reply'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'conversation_id',
      'contents' => $this->conversationId
    ];

    $parts[] = [
      'name' => 'agent_id',
      'contents' => $this->agentId
    ];

    if ($this->branchId !== null) {
      $parts[] = [
        'name' => 'branch_id',
        'contents' => $this->branchId
      ];
    }

    if ($this->workflowNodeId !== null) {
      $parts[] = [
        'name' => 'workflow_node_id',
        'contents' => $this->workflowNodeId
      ];
    }

    if ($this->originalAgentReply !== null) {
      $parts[] = [
        'name' => 'original_agent_reply',
        'contents' => json_encode($this->originalAgentReply),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->originalAgentReply ?? [] as $item) {
      $item->validate();
    }
  }
}
