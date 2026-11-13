<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Whatsapp\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyMakeAnOutboundCallViaWhatsAppV1ConvaiWhatsappOutboundCallPost extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('whatsapp_phone_number_id', required: true)]
  public string $whatsappPhoneNumberId;

  #[JsonProperty('whatsapp_user_id', required: true)]
  public string $whatsappUserId;

  #[JsonProperty('whatsapp_call_permission_request_template_name', required: true)]
  public string $whatsappCallPermissionRequestTemplateName;

  #[JsonProperty('whatsapp_call_permission_request_template_language_code', required: true)]
  public string $whatsappCallPermissionRequestTemplateLanguageCode;

  #[JsonProperty('agent_id', required: true)]
  public string $agentId;

  #[JsonProperty('conversation_initiation_client_data')]
  public ?\ElevenLabs\Types\ConversationInitiationClientDataRequestInput $conversationInitiationClientData;

  /**
   * @param array{
   *   whatsappPhoneNumberId: string,
   *   whatsappUserId: string,
   *   whatsappCallPermissionRequestTemplateName: string,
   *   whatsappCallPermissionRequestTemplateLanguageCode: string,
   *   agentId: string,
   *   conversationInitiationClientData?: ?\ElevenLabs\Types\ConversationInitiationClientDataRequestInput,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->whatsappPhoneNumberId = $values['whatsappPhoneNumberId'];
    $this->whatsappUserId = $values['whatsappUserId'];
    $this->whatsappCallPermissionRequestTemplateName =
      $values['whatsappCallPermissionRequestTemplateName'];
    $this->whatsappCallPermissionRequestTemplateLanguageCode =
      $values['whatsappCallPermissionRequestTemplateLanguageCode'];
    $this->agentId = $values['agentId'];
    $this->conversationInitiationClientData = $values['conversationInitiationClientData'] ?? null;

    $this->_dirtyFields = [
      'whatsapp_phone_number_id' => true,
      'whatsapp_user_id' => true,
      'whatsapp_call_permission_request_template_name' => true,
      'whatsapp_call_permission_request_template_language_code' => true,
      'agent_id' => true
    ];
    if (array_key_exists('conversationInitiationClientData', $values)) {
      $this->_dirtyFields['conversation_initiation_client_data'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'whatsapp_phone_number_id',
      'contents' => $this->whatsappPhoneNumberId
    ];

    $parts[] = [
      'name' => 'whatsapp_user_id',
      'contents' => $this->whatsappUserId
    ];

    $parts[] = [
      'name' => 'whatsapp_call_permission_request_template_name',
      'contents' => $this->whatsappCallPermissionRequestTemplateName
    ];

    $parts[] = [
      'name' => 'whatsapp_call_permission_request_template_language_code',
      'contents' => $this->whatsappCallPermissionRequestTemplateLanguageCode
    ];

    $parts[] = [
      'name' => 'agent_id',
      'contents' => $this->agentId
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
