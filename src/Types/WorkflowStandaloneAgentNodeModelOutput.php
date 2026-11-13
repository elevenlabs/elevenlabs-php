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
class WorkflowStandaloneAgentNodeModelOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\WorkflowStandaloneAgentNodeModelOutputType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  #[JsonProperty('position', required: true)]
  public \ElevenLabs\Types\PositionOutput $position;

  /**
   * @var string[]
   * The ids of outgoing edges in the order they should be evaluated.
   */
  #[JsonProperty('edge_order', required: true), ArrayType(['string'])]
  public array $edgeOrder;

  /**
   * The ID of the agent to transfer the conversation to. None means transfer within the current agent.
   */
  #[JsonProperty('agent_id', required: true)]
  public ?string $agentId;

  /**
   * Optional branch ID for the target agent. None follows the target agent's traffic deployment, or uses its main branch when node_id is set.
   */
  #[JsonProperty('branch_id', required: true)]
  public ?string $branchId;

  /**
   * Optional target node ID in the destination agent's workflow. When set, the transfer starts at this node instead of the default entry node.
   */
  #[JsonProperty('node_id', required: true)]
  public ?string $nodeId;

  /**
   * Artificial delay in milliseconds applied before transferring the conversation.
   */
  #[JsonProperty('delay_ms', required: true)]
  public int $delayMs;

  /**
   * Optional message sent to the user before the transfer is initiated.
   */
  #[JsonProperty('transfer_message', required: true)]
  public ?string $transferMessage;

  /**
   * Whether to enable the transferred agent to send its configured first message after the transfer.
   */
  #[JsonProperty('enable_transferred_agent_first_message', required: true)]
  public bool $enableTransferredAgentFirstMessage;

  /**
   * Defines whether TTS client overrides should be carried over to the transferred agent.
   */
  #[JsonProperty('preserve_client_tts_overrides', required: true)]
  public bool $preserveClientTtsOverrides;

  /**
   * Defines whether the base voice, TTS model and voice settings should be carried over to the transferred agent.
   */
  #[JsonProperty('preserve_voice_settings', required: true)]
  public bool $preserveVoiceSettings;

  /**
   * @param array{
   *   type: value-of<\ElevenLabs\Types\WorkflowStandaloneAgentNodeModelOutputType>,
   *   position: \ElevenLabs\Types\PositionOutput,
   *   edgeOrder: string[],
   *   agentId: ?string,
   *   branchId: ?string,
   *   nodeId: ?string,
   *   delayMs: int,
   *   transferMessage: ?string,
   *   enableTransferredAgentFirstMessage: bool,
   *   preserveClientTtsOverrides: bool,
   *   preserveVoiceSettings: bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];
    $this->position = $values['position'];
    $this->edgeOrder = $values['edgeOrder'];
    $this->agentId = $values['agentId'];
    $this->branchId = $values['branchId'];
    $this->nodeId = $values['nodeId'];
    $this->delayMs = $values['delayMs'];
    $this->transferMessage = $values['transferMessage'];
    $this->enableTransferredAgentFirstMessage = $values['enableTransferredAgentFirstMessage'];
    $this->preserveClientTtsOverrides = $values['preserveClientTtsOverrides'];
    $this->preserveVoiceSettings = $values['preserveVoiceSettings'];

    $this->_dirtyFields = [
      'type' => true,
      'position' => true,
      'edge_order' => true,
      'agent_id' => true,
      'branch_id' => true,
      'node_id' => true,
      'delay_ms' => true,
      'transfer_message' => true,
      'enable_transferred_agent_first_message' => true,
      'preserve_client_tts_overrides' => true,
      'preserve_voice_settings' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
    ];

    $parts[] = [
      'name' => 'position',
      'contents' => json_encode($this->position),
      'headers' => ['Content-Type' => 'application/json']
    ];

    foreach ($this->edgeOrder as $item) {
      $parts[] = [
        'name' => 'edge_order',
        'contents' => $item
      ];
    }

    $parts[] = [
      'name' => 'agent_id',
      'contents' => $this->agentId
    ];

    $parts[] = [
      'name' => 'branch_id',
      'contents' => $this->branchId
    ];

    $parts[] = [
      'name' => 'node_id',
      'contents' => $this->nodeId
    ];

    $parts[] = [
      'name' => 'delay_ms',
      'contents' => (string) $this->delayMs
    ];

    $parts[] = [
      'name' => 'transfer_message',
      'contents' => $this->transferMessage
    ];

    $parts[] = [
      'name' => 'enable_transferred_agent_first_message',
      'contents' => $this->enableTransferredAgentFirstMessage ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'preserve_client_tts_overrides',
      'contents' => $this->preserveClientTtsOverrides ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'preserve_voice_settings',
      'contents' => $this->preserveVoiceSettings ? 'true' : 'false'
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->position->validate();
    Validator::validateString($this->nodeId, 'node_id', minLength: 1);
  }
}
