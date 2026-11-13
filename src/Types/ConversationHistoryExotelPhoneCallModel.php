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
class ConversationHistoryExotelPhoneCallModel extends JsonSerializableType
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
   * @var ?value-of<\ElevenLabs\Types\ConversationHistoryExotelPhoneCallModelType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  #[JsonProperty('stream_sid', required: true)]
  public string $streamSid;

  #[JsonProperty('call_sid', required: true)]
  public string $callSid;

  /**
   * @param array{
   *   direction: value-of<\ElevenLabs\Types\TelephonyDirection>,
   *   phoneNumberId: string,
   *   agentNumber: string,
   *   externalNumber: string,
   *   streamSid: string,
   *   callSid: string,
   *   callResult?: ?value-of<\ElevenLabs\Types\CallResult>,
   *   type?: ?value-of<\ElevenLabs\Types\ConversationHistoryExotelPhoneCallModelType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->direction = $values['direction'];
    $this->phoneNumberId = $values['phoneNumberId'];
    $this->agentNumber = $values['agentNumber'];
    $this->externalNumber = $values['externalNumber'];
    $this->callResult = $values['callResult'] ?? null;
    $this->type = $values['type'] ?? 'exotel';
    $this->streamSid = $values['streamSid'];
    $this->callSid = $values['callSid'];

    $this->_dirtyFields = [
      'direction' => true,
      'phone_number_id' => true,
      'agent_number' => true,
      'external_number' => true,
      'stream_sid' => true,
      'call_sid' => true
    ];
    if (array_key_exists('callResult', $values)) {
      $this->_dirtyFields['call_result'] = true;
    }
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
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

    if ($this->type !== null) {
      $parts[] = [
        'name' => 'type',
        'contents' => $this->type
      ];
    }

    $parts[] = [
      'name' => 'stream_sid',
      'contents' => $this->streamSid
    ];

    $parts[] = [
      'name' => 'call_sid',
      'contents' => $this->callSid
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
