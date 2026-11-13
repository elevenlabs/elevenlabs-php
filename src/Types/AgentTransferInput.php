<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class AgentTransferInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('agent_id')]
  public ?string $agentId;

  #[JsonProperty('branch_id')]
  public ?string $branchId;

  #[JsonProperty('node_id')]
  public ?string $nodeId;

  #[JsonProperty('condition', required: true)]
  public string $condition;

  #[JsonProperty('delay_ms')]
  public ?int $delayMs;

  #[JsonProperty('transfer_message')]
  public ?string $transferMessage;

  #[JsonProperty('enable_transferred_agent_first_message')]
  public ?bool $enableTransferredAgentFirstMessage;

  #[JsonProperty('is_workflow_node_transfer')]
  public ?bool $isWorkflowNodeTransfer;

  /**
   * Defines whether TTS client overrides should be carried over to the transferred agent.
   */
  #[JsonProperty('preserve_client_tts_overrides')]
  public ?bool $preserveClientTtsOverrides;

  /**
   * Defines whether the base voice, TTS model and voice settings should be carried over to the transferred agent.
   */
  #[JsonProperty('preserve_voice_settings')]
  public ?bool $preserveVoiceSettings;

  /**
   * @param array{
   *   condition: string,
   *   agentId?: ?string,
   *   branchId?: ?string,
   *   nodeId?: ?string,
   *   delayMs?: ?int,
   *   transferMessage?: ?string,
   *   enableTransferredAgentFirstMessage?: ?bool,
   *   isWorkflowNodeTransfer?: ?bool,
   *   preserveClientTtsOverrides?: ?bool,
   *   preserveVoiceSettings?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->agentId = $values['agentId'] ?? null;
    $this->branchId = $values['branchId'] ?? null;
    $this->nodeId = $values['nodeId'] ?? null;
    $this->condition = $values['condition'];
    $this->delayMs = $values['delayMs'] ?? null;
    $this->transferMessage = $values['transferMessage'] ?? null;
    $this->enableTransferredAgentFirstMessage =
      $values['enableTransferredAgentFirstMessage'] ?? null;
    $this->isWorkflowNodeTransfer = $values['isWorkflowNodeTransfer'] ?? null;
    $this->preserveClientTtsOverrides = $values['preserveClientTtsOverrides'] ?? null;
    $this->preserveVoiceSettings = $values['preserveVoiceSettings'] ?? null;

    $this->_dirtyFields = [
      'condition' => true
    ];
    if (array_key_exists('agentId', $values)) {
      $this->_dirtyFields['agent_id'] = true;
    }
    if (array_key_exists('branchId', $values)) {
      $this->_dirtyFields['branch_id'] = true;
    }
    if (array_key_exists('nodeId', $values)) {
      $this->_dirtyFields['node_id'] = true;
    }
    if (array_key_exists('delayMs', $values)) {
      $this->_dirtyFields['delay_ms'] = true;
    }
    if (array_key_exists('transferMessage', $values)) {
      $this->_dirtyFields['transfer_message'] = true;
    }
    if (array_key_exists('enableTransferredAgentFirstMessage', $values)) {
      $this->_dirtyFields['enable_transferred_agent_first_message'] = true;
    }
    if (array_key_exists('isWorkflowNodeTransfer', $values)) {
      $this->_dirtyFields['is_workflow_node_transfer'] = true;
    }
    if (array_key_exists('preserveClientTtsOverrides', $values)) {
      $this->_dirtyFields['preserve_client_tts_overrides'] = true;
    }
    if (array_key_exists('preserveVoiceSettings', $values)) {
      $this->_dirtyFields['preserve_voice_settings'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->agentId !== null) {
      $parts[] = [
        'name' => 'agent_id',
        'contents' => $this->agentId
      ];
    }

    if ($this->branchId !== null) {
      $parts[] = [
        'name' => 'branch_id',
        'contents' => $this->branchId
      ];
    }

    if ($this->nodeId !== null) {
      $parts[] = [
        'name' => 'node_id',
        'contents' => $this->nodeId
      ];
    }

    $parts[] = [
      'name' => 'condition',
      'contents' => $this->condition
    ];

    if ($this->delayMs !== null) {
      $parts[] = [
        'name' => 'delay_ms',
        'contents' => (string) $this->delayMs
      ];
    }

    if ($this->transferMessage !== null) {
      $parts[] = [
        'name' => 'transfer_message',
        'contents' => $this->transferMessage
      ];
    }

    if ($this->enableTransferredAgentFirstMessage !== null) {
      $parts[] = [
        'name' => 'enable_transferred_agent_first_message',
        'contents' => $this->enableTransferredAgentFirstMessage ? 'true' : 'false'
      ];
    }

    if ($this->isWorkflowNodeTransfer !== null) {
      $parts[] = [
        'name' => 'is_workflow_node_transfer',
        'contents' => $this->isWorkflowNodeTransfer ? 'true' : 'false'
      ];
    }

    if ($this->preserveClientTtsOverrides !== null) {
      $parts[] = [
        'name' => 'preserve_client_tts_overrides',
        'contents' => $this->preserveClientTtsOverrides ? 'true' : 'false'
      ];
    }

    if ($this->preserveVoiceSettings !== null) {
      $parts[] = [
        'name' => 'preserve_voice_settings',
        'contents' => $this->preserveVoiceSettings ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
