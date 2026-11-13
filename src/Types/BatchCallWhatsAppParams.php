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
class BatchCallWhatsAppParams extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('whatsapp_phone_number_id')]
  public ?string $whatsappPhoneNumberId;

  #[JsonProperty('whatsapp_call_permission_request_template_name', required: true)]
  public string $whatsappCallPermissionRequestTemplateName;

  #[JsonProperty('whatsapp_call_permission_request_template_language_code', required: true)]
  public string $whatsappCallPermissionRequestTemplateLanguageCode;

  /**
   * @param array{
   *   whatsappCallPermissionRequestTemplateName: string,
   *   whatsappCallPermissionRequestTemplateLanguageCode: string,
   *   whatsappPhoneNumberId?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->whatsappPhoneNumberId = $values['whatsappPhoneNumberId'] ?? null;
    $this->whatsappCallPermissionRequestTemplateName =
      $values['whatsappCallPermissionRequestTemplateName'];
    $this->whatsappCallPermissionRequestTemplateLanguageCode =
      $values['whatsappCallPermissionRequestTemplateLanguageCode'];

    $this->_dirtyFields = [
      'whatsapp_call_permission_request_template_name' => true,
      'whatsapp_call_permission_request_template_language_code' => true
    ];
    if (array_key_exists('whatsappPhoneNumberId', $values)) {
      $this->_dirtyFields['whatsapp_phone_number_id'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->whatsappPhoneNumberId !== null) {
      $parts[] = [
        'name' => 'whatsapp_phone_number_id',
        'contents' => $this->whatsappPhoneNumberId
      ];
    }

    $parts[] = [
      'name' => 'whatsapp_call_permission_request_template_name',
      'contents' => $this->whatsappCallPermissionRequestTemplateName
    ];

    $parts[] = [
      'name' => 'whatsapp_call_permission_request_template_language_code',
      'contents' => $this->whatsappCallPermissionRequestTemplateLanguageCode
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
