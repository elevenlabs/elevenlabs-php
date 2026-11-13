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
class SmsConversationInfo extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\SmsConversationInfoDirection>
   */
  #[JsonProperty('direction', required: true)]
  public string $direction;

  #[JsonProperty('phone_number_id')]
  public ?string $phoneNumberId;

  #[JsonProperty('sms_user_phone_number', required: true)]
  public string $smsUserPhoneNumber;

  #[JsonProperty('agent_phone_number')]
  public ?string $agentPhoneNumber;

  /**
   * @param array{
   *   direction: value-of<\ElevenLabs\Types\SmsConversationInfoDirection>,
   *   smsUserPhoneNumber: string,
   *   phoneNumberId?: ?string,
   *   agentPhoneNumber?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->direction = $values['direction'];
    $this->phoneNumberId = $values['phoneNumberId'] ?? null;
    $this->smsUserPhoneNumber = $values['smsUserPhoneNumber'];
    $this->agentPhoneNumber = $values['agentPhoneNumber'] ?? null;

    $this->_dirtyFields = [
      'direction' => true,
      'sms_user_phone_number' => true
    ];
    if (array_key_exists('phoneNumberId', $values)) {
      $this->_dirtyFields['phone_number_id'] = true;
    }
    if (array_key_exists('agentPhoneNumber', $values)) {
      $this->_dirtyFields['agent_phone_number'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'direction',
      'contents' => $this->direction
    ];

    if ($this->phoneNumberId !== null) {
      $parts[] = [
        'name' => 'phone_number_id',
        'contents' => $this->phoneNumberId
      ];
    }

    $parts[] = [
      'name' => 'sms_user_phone_number',
      'contents' => $this->smsUserPhoneNumber
    ];

    if ($this->agentPhoneNumber !== null) {
      $parts[] = [
        'name' => 'agent_phone_number',
        'contents' => $this->agentPhoneNumber
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
