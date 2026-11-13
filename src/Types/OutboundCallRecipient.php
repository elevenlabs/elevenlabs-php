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
class OutboundCallRecipient extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('id')]
  public ?string $id;

  #[JsonProperty('phone_number')]
  public ?string $phoneNumber;

  #[JsonProperty('whatsapp_user_id')]
  public ?string $whatsappUserId;

  #[JsonProperty('conversation_initiation_client_data')]
  public ?\ElevenLabs\Types\ConversationInitiationClientDataRequestInput $conversationInitiationClientData;

  /**
   * @param array{
   *   id?: ?string,
   *   phoneNumber?: ?string,
   *   whatsappUserId?: ?string,
   *   conversationInitiationClientData?: ?\ElevenLabs\Types\ConversationInitiationClientDataRequestInput,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->id = $values['id'] ?? null;
    $this->phoneNumber = $values['phoneNumber'] ?? null;
    $this->whatsappUserId = $values['whatsappUserId'] ?? null;
    $this->conversationInitiationClientData = $values['conversationInitiationClientData'] ?? null;

    if (array_key_exists('id', $values)) {
      $this->_dirtyFields['id'] = true;
    }
    if (array_key_exists('phoneNumber', $values)) {
      $this->_dirtyFields['phone_number'] = true;
    }
    if (array_key_exists('whatsappUserId', $values)) {
      $this->_dirtyFields['whatsapp_user_id'] = true;
    }
    if (array_key_exists('conversationInitiationClientData', $values)) {
      $this->_dirtyFields['conversation_initiation_client_data'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->id !== null) {
      $parts[] = [
        'name' => 'id',
        'contents' => $this->id
      ];
    }

    if ($this->phoneNumber !== null) {
      $parts[] = [
        'name' => 'phone_number',
        'contents' => $this->phoneNumber
      ];
    }

    if ($this->whatsappUserId !== null) {
      $parts[] = [
        'name' => 'whatsapp_user_id',
        'contents' => $this->whatsappUserId
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
