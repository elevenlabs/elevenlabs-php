<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\SipTrunk\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyHandleAnOutboundCallViaSipTrunkV1ConvaiSipTrunkOutboundCallPost extends
  JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('agent_id', required: true)]
  public string $agentId;

  #[JsonProperty('agent_phone_number_id', required: true)]
  public string $agentPhoneNumberId;

  #[JsonProperty('to_number', required: true)]
  public string $toNumber;

  #[JsonProperty('conversation_initiation_client_data')]
  public ?\ElevenLabs\Types\ConversationInitiationClientDataRequestInput $conversationInitiationClientData;

  #[JsonProperty('telephony_call_config')]
  public ?\ElevenLabs\Types\TelephonyCallConfigInput $telephonyCallConfig;

  /**
   * @param array{
   *   agentId: string,
   *   agentPhoneNumberId: string,
   *   toNumber: string,
   *   conversationInitiationClientData?: ?\ElevenLabs\Types\ConversationInitiationClientDataRequestInput,
   *   telephonyCallConfig?: ?\ElevenLabs\Types\TelephonyCallConfigInput,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->agentId = $values['agentId'];
    $this->agentPhoneNumberId = $values['agentPhoneNumberId'];
    $this->toNumber = $values['toNumber'];
    $this->conversationInitiationClientData = $values['conversationInitiationClientData'] ?? null;
    $this->telephonyCallConfig = $values['telephonyCallConfig'] ?? null;

    $this->_dirtyFields = [
      'agent_id' => true,
      'agent_phone_number_id' => true,
      'to_number' => true
    ];
    if (array_key_exists('conversationInitiationClientData', $values)) {
      $this->_dirtyFields['conversation_initiation_client_data'] = true;
    }
    if (array_key_exists('telephonyCallConfig', $values)) {
      $this->_dirtyFields['telephony_call_config'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'agent_id',
      'contents' => $this->agentId
    ];

    $parts[] = [
      'name' => 'agent_phone_number_id',
      'contents' => $this->agentPhoneNumberId
    ];

    $parts[] = [
      'name' => 'to_number',
      'contents' => $this->toNumber
    ];

    if ($this->conversationInitiationClientData !== null) {
      $parts[] = [
        'name' => 'conversation_initiation_client_data',
        'contents' => json_encode($this->conversationInitiationClientData),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->telephonyCallConfig !== null) {
      $parts[] = [
        'name' => 'telephony_call_config',
        'contents' => json_encode($this->telephonyCallConfig),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->conversationInitiationClientData?->validate();
    $this->telephonyCallConfig?->validate();
  }
}
