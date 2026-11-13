<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class WorkflowStandaloneAgentNodeModelInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\WorkflowStandaloneAgentNodeModelInputType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  #[JsonProperty('position')]
  public ?\ElevenLabs\Types\PositionInput $position;

  /**
   * @var string[]|null
   * The ids of outgoing edges in the order they should be evaluated.
   */
  #[JsonProperty('edge_order'), ArrayType(['string'])]
  public ?array $edgeOrder;

  /**
   * The ID of the agent to transfer the conversation to. None means transfer within the current agent.
   */
  #[JsonProperty('agent_id')]
  public ?string $agentId;

  /**
   * Optional branch ID for the target agent. None follows the target agent's traffic deployment, or uses its main branch when node_id is set.
   */
  #[JsonProperty('branch_id')]
  public ?string $branchId;

  /**
   * Optional target node ID in the destination agent's workflow. When set, the transfer starts at this node instead of the default entry node.
   */
  #[JsonProperty('node_id')]
  public ?string $nodeId;

  /**
   * Artificial delay in milliseconds applied before transferring the conversation.
   */
  #[JsonProperty('delay_ms')]
  public ?int $delayMs;

  /**
   * Optional message sent to the user before the transfer is initiated.
   */
  #[JsonProperty('transfer_message')]
  public ?string $transferMessage;

  /**
   * Whether to enable the transferred agent to send its configured first message after the transfer.
   */
  #[JsonProperty('enable_transferred_agent_first_message')]
  public ?bool $enableTransferredAgentFirstMessage;

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
   *   type?: ?value-of<\ElevenLabs\Types\WorkflowStandaloneAgentNodeModelInputType>,
   *   position?: ?\ElevenLabs\Types\PositionInput,
   *   edgeOrder?: string[]|null,
   *   agentId?: ?string,
   *   branchId?: ?string,
   *   nodeId?: ?string,
   *   delayMs?: ?int,
   *   transferMessage?: ?string,
   *   enableTransferredAgentFirstMessage?: ?bool,
   *   preserveClientTtsOverrides?: ?bool,
   *   preserveVoiceSettings?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->type = $values['type'] ?? 'standalone_agent';
    $this->position = $values['position'] ?? null;
    $this->edgeOrder = $values['edgeOrder'] ?? null;
    $this->agentId = $values['agentId'] ?? null;
    $this->branchId = $values['branchId'] ?? null;
    $this->nodeId = $values['nodeId'] ?? null;
    $this->delayMs = $values['delayMs'] ?? null;
    $this->transferMessage = $values['transferMessage'] ?? null;
    $this->enableTransferredAgentFirstMessage =
      $values['enableTransferredAgentFirstMessage'] ?? null;
    $this->preserveClientTtsOverrides = $values['preserveClientTtsOverrides'] ?? null;
    $this->preserveVoiceSettings = $values['preserveVoiceSettings'] ?? null;

    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
    if (array_key_exists('position', $values)) {
      $this->_dirtyFields['position'] = true;
    }
    if (array_key_exists('edgeOrder', $values)) {
      $this->_dirtyFields['edge_order'] = true;
    }
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
    if ($this->type !== null) {
      $parts[] = [
        'name' => 'type',
        'contents' => $this->type
      ];
    }

    if ($this->position !== null) {
      $parts[] = [
        'name' => 'position',
        'contents' => json_encode($this->position),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->edgeOrder !== null) {
      foreach ($this->edgeOrder ?? [] as $item) {
        $parts[] = [
          'name' => 'edge_order',
          'contents' => $item
        ];
      }
    }

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
    $this->position?->validate();
    Validator::validateString($this->nodeId, 'node_id', minLength: 1);
  }
}
