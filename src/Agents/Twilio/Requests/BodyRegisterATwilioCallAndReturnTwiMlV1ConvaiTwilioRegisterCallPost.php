<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Twilio\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyRegisterATwilioCallAndReturnTwiMlV1ConvaiTwilioRegisterCallPost extends
  JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('agent_id', required: true)]
  public string $agentId;

  #[JsonProperty('from_number', required: true)]
  public string $fromNumber;

  #[JsonProperty('to_number', required: true)]
  public string $toNumber;

  /**
   * @var ?value-of<\ElevenLabs\Types\TelephonyDirection>
   */
  #[JsonProperty('direction')]
  public ?string $direction;

  #[JsonProperty('conversation_initiation_client_data')]
  public ?\ElevenLabs\Types\ConversationInitiationClientDataRequestInput $conversationInitiationClientData;

  /**
   * @param array{
   *   agentId: string,
   *   fromNumber: string,
   *   toNumber: string,
   *   direction?: ?value-of<\ElevenLabs\Types\TelephonyDirection>,
   *   conversationInitiationClientData?: ?\ElevenLabs\Types\ConversationInitiationClientDataRequestInput,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->agentId = $values['agentId'];
    $this->fromNumber = $values['fromNumber'];
    $this->toNumber = $values['toNumber'];
    $this->direction = $values['direction'] ?? null;
    $this->conversationInitiationClientData = $values['conversationInitiationClientData'] ?? null;

    $this->_dirtyFields = [
      'agent_id' => true,
      'from_number' => true,
      'to_number' => true
    ];
    if (array_key_exists('direction', $values)) {
      $this->_dirtyFields['direction'] = true;
    }
    if (array_key_exists('conversationInitiationClientData', $values)) {
      $this->_dirtyFields['conversation_initiation_client_data'] = true;
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
      'name' => 'from_number',
      'contents' => $this->fromNumber
    ];

    $parts[] = [
      'name' => 'to_number',
      'contents' => $this->toNumber
    ];

    if ($this->direction !== null) {
      $parts[] = [
        'name' => 'direction',
        'contents' => $this->direction
      ];
    }

    if ($this->conversationInitiationClientData !== null) {
      $parts[] = [
        'name' => 'conversation_initiation_client_data',
        'contents' => json_encode($this->conversationInitiationClientData),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->conversationInitiationClientData?->validate();
  }
}
