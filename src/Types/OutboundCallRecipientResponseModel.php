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
class OutboundCallRecipientResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('id', required: true)]
  public string $id;

  #[JsonProperty('phone_number')]
  public ?string $phoneNumber;

  #[JsonProperty('whatsapp_user_id')]
  public ?string $whatsappUserId;

  /**
   * @var value-of<\ElevenLabs\Types\BatchCallRecipientStatus>
   */
  #[JsonProperty('status', required: true)]
  public string $status;

  #[JsonProperty('created_at_unix', required: true)]
  public int $createdAtUnix;

  #[JsonProperty('updated_at_unix', required: true)]
  public int $updatedAtUnix;

  #[JsonProperty('conversation_id', required: true)]
  public ?string $conversationId;

  #[JsonProperty('conversation_initiation_client_data')]
  public ?\ElevenLabs\Types\ConversationInitiationClientDataInternal $conversationInitiationClientData;

  /**
   * @param array{
   *   id: string,
   *   status: value-of<\ElevenLabs\Types\BatchCallRecipientStatus>,
   *   createdAtUnix: int,
   *   updatedAtUnix: int,
   *   conversationId: ?string,
   *   phoneNumber?: ?string,
   *   whatsappUserId?: ?string,
   *   conversationInitiationClientData?: ?\ElevenLabs\Types\ConversationInitiationClientDataInternal,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->id = $values['id'];
    $this->phoneNumber = $values['phoneNumber'] ?? null;
    $this->whatsappUserId = $values['whatsappUserId'] ?? null;
    $this->status = $values['status'];
    $this->createdAtUnix = $values['createdAtUnix'];
    $this->updatedAtUnix = $values['updatedAtUnix'];
    $this->conversationId = $values['conversationId'];
    $this->conversationInitiationClientData = $values['conversationInitiationClientData'] ?? null;

    $this->_dirtyFields = [
      'id' => true,
      'status' => true,
      'created_at_unix' => true,
      'updated_at_unix' => true,
      'conversation_id' => true
    ];
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
    $parts[] = [
      'name' => 'id',
      'contents' => $this->id
    ];

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

    $parts[] = [
      'name' => 'status',
      'contents' => $this->status
    ];

    $parts[] = [
      'name' => 'created_at_unix',
      'contents' => (string) $this->createdAtUnix
    ];

    $parts[] = [
      'name' => 'updated_at_unix',
      'contents' => (string) $this->updatedAtUnix
    ];

    $parts[] = [
      'name' => 'conversation_id',
      'contents' => $this->conversationId
    ];

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
