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
class SubmitCampaignRecipient extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The number to call, in E.164 format such as `+14155550100`.
   */
  #[JsonProperty('phone_number')]
  public ?string $phoneNumber;

  /**
   * @var string[]|null
   * More numbers to call, in order after `phone_number`. The lead moves on to the next one when calls to its current number keep failing.
   */
  #[JsonProperty('phone_numbers'), ArrayType(['string'])]
  public ?array $phoneNumbers;

  /**
   * The contact's WhatsApp user ID. WhatsApp campaigns use it instead of the phone numbers.
   */
  #[JsonProperty('whatsapp_user_id')]
  public ?string $whatsappUserId;

  /**
   * Your identifier for the recipient, returned as its lead's `recipient_id`.
   */
  #[JsonProperty('id')]
  public ?string $id;

  /**
   * Dynamic variables and overrides for this recipient's calls.
   */
  #[JsonProperty('conversation_initiation_client_data')]
  public ?\ElevenLabs\Types\ConversationInitiationClientDataRequestInput $conversationInitiationClientData;

  /**
   * @param array{
   *   phoneNumber?: ?string,
   *   phoneNumbers?: string[]|null,
   *   whatsappUserId?: ?string,
   *   id?: ?string,
   *   conversationInitiationClientData?: ?\ElevenLabs\Types\ConversationInitiationClientDataRequestInput,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->phoneNumber = $values['phoneNumber'] ?? null;
    $this->phoneNumbers = $values['phoneNumbers'] ?? null;
    $this->whatsappUserId = $values['whatsappUserId'] ?? null;
    $this->id = $values['id'] ?? null;
    $this->conversationInitiationClientData = $values['conversationInitiationClientData'] ?? null;

    if (array_key_exists('phoneNumber', $values)) {
      $this->_dirtyFields['phone_number'] = true;
    }
    if (array_key_exists('phoneNumbers', $values)) {
      $this->_dirtyFields['phone_numbers'] = true;
    }
    if (array_key_exists('whatsappUserId', $values)) {
      $this->_dirtyFields['whatsapp_user_id'] = true;
    }
    if (array_key_exists('id', $values)) {
      $this->_dirtyFields['id'] = true;
    }
    if (array_key_exists('conversationInitiationClientData', $values)) {
      $this->_dirtyFields['conversation_initiation_client_data'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->phoneNumber !== null) {
      $parts[] = [
        'name' => 'phone_number',
        'contents' => $this->phoneNumber
      ];
    }

    if ($this->phoneNumbers !== null) {
      foreach ($this->phoneNumbers ?? [] as $item) {
        $parts[] = [
          'name' => 'phone_numbers',
          'contents' => $item
        ];
      }
    }

    if ($this->whatsappUserId !== null) {
      $parts[] = [
        'name' => 'whatsapp_user_id',
        'contents' => $this->whatsappUserId
      ];
    }

    if ($this->id !== null) {
      $parts[] = [
        'name' => 'id',
        'contents' => $this->id
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
    Validator::validateString($this->phoneNumber, 'phone_number', maxLength: 64);
    Validator::validateArray($this->phoneNumbers, 'phone_numbers', maxItems: 5);
    Validator::validateString($this->whatsappUserId, 'whatsapp_user_id', maxLength: 256);
    Validator::validateString($this->id, 'id', maxLength: 256);
    $this->conversationInitiationClientData?->validate();
  }
}
