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
class TransferToAgentToolResultSuccessModelInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\TransferToAgentToolResultSuccessModelInputResultType>
   */
  #[JsonProperty('result_type')]
  public ?string $resultType;

  /**
   * @var ?value-of<\ElevenLabs\Types\TransferToAgentToolResultSuccessModelInputStatus>
   */
  #[JsonProperty('status')]
  public ?string $status;

  #[JsonProperty('from_agent', required: true)]
  public string $fromAgent;

  #[JsonProperty('to_agent', required: true)]
  public string $toAgent;

  #[JsonProperty('to_node')]
  public ?string $toNode;

  #[JsonProperty('condition', required: true)]
  public string $condition;

  #[JsonProperty('delay_ms')]
  public ?int $delayMs;

  #[JsonProperty('transfer_message')]
  public ?string $transferMessage;

  #[JsonProperty('enable_transferred_agent_first_message')]
  public ?bool $enableTransferredAgentFirstMessage;

  #[JsonProperty('branch_info')]
  public ?\ElevenLabs\Types\TransferToAgentToolResultSuccessModelInputBranchInfo $branchInfo;

  #[JsonProperty('preserve_client_tts_overrides')]
  public ?bool $preserveClientTtsOverrides;

  #[JsonProperty('preserve_voice_settings')]
  public ?bool $preserveVoiceSettings;

  /**
   * @param array{
   *   fromAgent: string,
   *   toAgent: string,
   *   condition: string,
   *   resultType?: ?value-of<\ElevenLabs\Types\TransferToAgentToolResultSuccessModelInputResultType>,
   *   status?: ?value-of<\ElevenLabs\Types\TransferToAgentToolResultSuccessModelInputStatus>,
   *   toNode?: ?string,
   *   delayMs?: ?int,
   *   transferMessage?: ?string,
   *   enableTransferredAgentFirstMessage?: ?bool,
   *   branchInfo?: ?\ElevenLabs\Types\TransferToAgentToolResultSuccessModelInputBranchInfo,
   *   preserveClientTtsOverrides?: ?bool,
   *   preserveVoiceSettings?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->resultType = $values['resultType'] ?? 'transfer_to_agent_success';
    $this->status = $values['status'] ?? 'success';
    $this->fromAgent = $values['fromAgent'];
    $this->toAgent = $values['toAgent'];
    $this->toNode = $values['toNode'] ?? null;
    $this->condition = $values['condition'];
    $this->delayMs = $values['delayMs'] ?? null;
    $this->transferMessage = $values['transferMessage'] ?? null;
    $this->enableTransferredAgentFirstMessage =
      $values['enableTransferredAgentFirstMessage'] ?? null;
    $this->branchInfo = $values['branchInfo'] ?? null;
    $this->preserveClientTtsOverrides = $values['preserveClientTtsOverrides'] ?? null;
    $this->preserveVoiceSettings = $values['preserveVoiceSettings'] ?? null;

    $this->_dirtyFields = [
      'from_agent' => true,
      'to_agent' => true,
      'condition' => true
    ];
    if (array_key_exists('resultType', $values)) {
      $this->_dirtyFields['result_type'] = true;
    }
    if (array_key_exists('status', $values)) {
      $this->_dirtyFields['status'] = true;
    }
    if (array_key_exists('toNode', $values)) {
      $this->_dirtyFields['to_node'] = true;
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
    if (array_key_exists('branchInfo', $values)) {
      $this->_dirtyFields['branch_info'] = true;
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
    if ($this->resultType !== null) {
      $parts[] = [
        'name' => 'result_type',
        'contents' => $this->resultType
      ];
    }

    if ($this->status !== null) {
      $parts[] = [
        'name' => 'status',
        'contents' => $this->status
      ];
    }

    $parts[] = [
      'name' => 'from_agent',
      'contents' => $this->fromAgent
    ];

    $parts[] = [
      'name' => 'to_agent',
      'contents' => $this->toAgent
    ];

    if ($this->toNode !== null) {
      $parts[] = [
        'name' => 'to_node',
        'contents' => $this->toNode
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

    if ($this->branchInfo !== null) {
      $parts[] = [
        'name' => 'branch_info',
        'contents' => json_encode($this->branchInfo),
        'headers' => ['Content-Type' => 'application/json']
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
