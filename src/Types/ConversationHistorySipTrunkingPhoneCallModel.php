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
class ConversationHistorySipTrunkingPhoneCallModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\TelephonyDirection>
   */
  #[JsonProperty('direction', required: true)]
  public string $direction;

  #[JsonProperty('phone_number_id', required: true)]
  public string $phoneNumberId;

  #[JsonProperty('agent_number', required: true)]
  public string $agentNumber;

  #[JsonProperty('external_number', required: true)]
  public string $externalNumber;

  /**
   * @var ?value-of<\ElevenLabs\Types\CallResult>
   */
  #[JsonProperty('call_result')]
  public ?string $callResult;

  /**
   * @var value-of<\ElevenLabs\Types\ConversationHistorySipTrunkingPhoneCallModelType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  #[JsonProperty('call_id')]
  public ?string $callId;

  #[JsonProperty('call_sid', required: true)]
  public string $callSid;

  /**
   * @var array<string, string>|null
   */
  #[JsonProperty('sip_header_dynamic_variables'), ArrayType(['string' => 'string'])]
  public ?array $sipHeaderDynamicVariables;

  /**
   * @param array{
   *   direction: value-of<\ElevenLabs\Types\TelephonyDirection>,
   *   phoneNumberId: string,
   *   agentNumber: string,
   *   externalNumber: string,
   *   type: value-of<\ElevenLabs\Types\ConversationHistorySipTrunkingPhoneCallModelType>,
   *   callSid: string,
   *   callResult?: ?value-of<\ElevenLabs\Types\CallResult>,
   *   callId?: ?string,
   *   sipHeaderDynamicVariables?: array<string, string>|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->direction = $values['direction'];
    $this->phoneNumberId = $values['phoneNumberId'];
    $this->agentNumber = $values['agentNumber'];
    $this->externalNumber = $values['externalNumber'];
    $this->callResult = $values['callResult'] ?? null;
    $this->type = $values['type'];
    $this->callId = $values['callId'] ?? null;
    $this->callSid = $values['callSid'];
    $this->sipHeaderDynamicVariables = $values['sipHeaderDynamicVariables'] ?? null;

    $this->_dirtyFields = [
      'direction' => true,
      'phone_number_id' => true,
      'agent_number' => true,
      'external_number' => true,
      'type' => true,
      'call_sid' => true
    ];
    if (array_key_exists('callResult', $values)) {
      $this->_dirtyFields['call_result'] = true;
    }
    if (array_key_exists('callId', $values)) {
      $this->_dirtyFields['call_id'] = true;
    }
    if (array_key_exists('sipHeaderDynamicVariables', $values)) {
      $this->_dirtyFields['sip_header_dynamic_variables'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'direction',
      'contents' => $this->direction
    ];

    $parts[] = [
      'name' => 'phone_number_id',
      'contents' => $this->phoneNumberId
    ];

    $parts[] = [
      'name' => 'agent_number',
      'contents' => $this->agentNumber
    ];

    $parts[] = [
      'name' => 'external_number',
      'contents' => $this->externalNumber
    ];

    if ($this->callResult !== null) {
      $parts[] = [
        'name' => 'call_result',
        'contents' => $this->callResult
      ];
    }

    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
    ];

    if ($this->callId !== null) {
      $parts[] = [
        'name' => 'call_id',
        'contents' => $this->callId
      ];
    }

    $parts[] = [
      'name' => 'call_sid',
      'contents' => $this->callSid
    ];

    if ($this->sipHeaderDynamicVariables !== null) {
      $parts[] = [
        'name' => 'sip_header_dynamic_variables',
        'contents' => json_encode($this->sipHeaderDynamicVariables),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
