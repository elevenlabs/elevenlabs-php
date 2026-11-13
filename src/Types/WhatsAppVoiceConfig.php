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
class WhatsAppVoiceConfig extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\WhatsAppVoiceConfigMode>
   */
  #[JsonProperty('mode')]
  public ?string $mode;

  /**
   * The approved template that asks the contact for permission to call.
   */
  #[JsonProperty('whatsapp_call_permission_request_template_name', required: true)]
  public string $whatsappCallPermissionRequestTemplateName;

  /**
   * The language code of that template.
   */
  #[JsonProperty('whatsapp_call_permission_request_template_language_code', required: true)]
  public string $whatsappCallPermissionRequestTemplateLanguageCode;

  /**
   * @param array{
   *   whatsappCallPermissionRequestTemplateName: string,
   *   whatsappCallPermissionRequestTemplateLanguageCode: string,
   *   mode?: ?value-of<\ElevenLabs\Types\WhatsAppVoiceConfigMode>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->mode = $values['mode'] ?? 'voice';
    $this->whatsappCallPermissionRequestTemplateName =
      $values['whatsappCallPermissionRequestTemplateName'];
    $this->whatsappCallPermissionRequestTemplateLanguageCode =
      $values['whatsappCallPermissionRequestTemplateLanguageCode'];

    $this->_dirtyFields = [
      'whatsapp_call_permission_request_template_name' => true,
      'whatsapp_call_permission_request_template_language_code' => true
    ];
    if (array_key_exists('mode', $values)) {
      $this->_dirtyFields['mode'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->mode !== null) {
      $parts[] = [
        'name' => 'mode',
        'contents' => $this->mode
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
