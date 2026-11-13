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
class WhatsAppConversationInfo extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\WhatsAppConversationInfoDirection>
   */
  #[JsonProperty('direction')]
  public ?string $direction;

  #[JsonProperty('whatsapp_phone_number_id')]
  public ?string $whatsappPhoneNumberId;

  #[JsonProperty('whatsapp_user_id', required: true)]
  public string $whatsappUserId;

  #[JsonProperty('awaiting_first_user_message')]
  public ?bool $awaitingFirstUserMessage;

  #[JsonProperty('recipient')]
  public ?\ElevenLabs\Types\WhatsAppRecipient $recipient;

  #[JsonProperty('call_permission_request')]
  public ?\ElevenLabs\Types\WhatsAppCallPermissionRequest $callPermissionRequest;

  /**
   * @var ?value-of<\ElevenLabs\Types\CallResult>
   */
  #[JsonProperty('call_result')]
  public ?string $callResult;

  #[JsonProperty('opening_message')]
  public ?\ElevenLabs\Types\WhatsAppOpeningMessage $openingMessage;

  /**
   * @param array{
   *   whatsappUserId: string,
   *   direction?: ?value-of<\ElevenLabs\Types\WhatsAppConversationInfoDirection>,
   *   whatsappPhoneNumberId?: ?string,
   *   awaitingFirstUserMessage?: ?bool,
   *   recipient?: ?\ElevenLabs\Types\WhatsAppRecipient,
   *   callPermissionRequest?: ?\ElevenLabs\Types\WhatsAppCallPermissionRequest,
   *   callResult?: ?value-of<\ElevenLabs\Types\CallResult>,
   *   openingMessage?: ?\ElevenLabs\Types\WhatsAppOpeningMessage,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->direction = $values['direction'] ?? null;
    $this->whatsappPhoneNumberId = $values['whatsappPhoneNumberId'] ?? null;
    $this->whatsappUserId = $values['whatsappUserId'];
    $this->awaitingFirstUserMessage = $values['awaitingFirstUserMessage'] ?? null;
    $this->recipient = $values['recipient'] ?? null;
    $this->callPermissionRequest = $values['callPermissionRequest'] ?? null;
    $this->callResult = $values['callResult'] ?? null;
    $this->openingMessage = $values['openingMessage'] ?? null;

    $this->_dirtyFields = [
      'whatsapp_user_id' => true
    ];
    if (array_key_exists('direction', $values)) {
      $this->_dirtyFields['direction'] = true;
    }
    if (array_key_exists('whatsappPhoneNumberId', $values)) {
      $this->_dirtyFields['whatsapp_phone_number_id'] = true;
    }
    if (array_key_exists('awaitingFirstUserMessage', $values)) {
      $this->_dirtyFields['awaiting_first_user_message'] = true;
    }
    if (array_key_exists('recipient', $values)) {
      $this->_dirtyFields['recipient'] = true;
    }
    if (array_key_exists('callPermissionRequest', $values)) {
      $this->_dirtyFields['call_permission_request'] = true;
    }
    if (array_key_exists('callResult', $values)) {
      $this->_dirtyFields['call_result'] = true;
    }
    if (array_key_exists('openingMessage', $values)) {
      $this->_dirtyFields['opening_message'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->direction !== null) {
      $parts[] = [
        'name' => 'direction',
        'contents' => $this->direction
      ];
    }

    if ($this->whatsappPhoneNumberId !== null) {
      $parts[] = [
        'name' => 'whatsapp_phone_number_id',
        'contents' => $this->whatsappPhoneNumberId
      ];
    }

    $parts[] = [
      'name' => 'whatsapp_user_id',
      'contents' => $this->whatsappUserId
    ];

    if ($this->awaitingFirstUserMessage !== null) {
      $parts[] = [
        'name' => 'awaiting_first_user_message',
        'contents' => $this->awaitingFirstUserMessage ? 'true' : 'false'
      ];
    }

    if ($this->recipient !== null) {
      $parts[] = [
        'name' => 'recipient',
        'contents' => json_encode($this->recipient),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->callPermissionRequest !== null) {
      $parts[] = [
        'name' => 'call_permission_request',
        'contents' => json_encode($this->callPermissionRequest),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->callResult !== null) {
      $parts[] = [
        'name' => 'call_result',
        'contents' => $this->callResult
      ];
    }

    if ($this->openingMessage !== null) {
      $parts[] = [
        'name' => 'opening_message',
        'contents' => json_encode($this->openingMessage),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->recipient?->validate();
    $this->callPermissionRequest?->validate();
    $this->openingMessage?->validate();
  }
}
