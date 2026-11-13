<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class WhatsAppChannelConfig extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\WhatsAppChannelConfigChannel>
   */
  #[JsonProperty('channel')]
  public ?string $channel;

  /**
   * The WhatsApp phone number to call or message from.
   */
  #[JsonProperty('whatsapp_phone_number_id', required: true)]
  public string $whatsappPhoneNumberId;

  #[JsonProperty('mode_config', required: true)]
  public \ElevenLabs\Types\WhatsAppChannelConfigModeConfig $modeConfig;

  /**
   * @param array{
   *   whatsappPhoneNumberId: string,
   *   modeConfig: \ElevenLabs\Types\WhatsAppChannelConfigModeConfig,
   *   channel?: ?value-of<\ElevenLabs\Types\WhatsAppChannelConfigChannel>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->channel = $values['channel'] ?? 'whatsapp';
    $this->whatsappPhoneNumberId = $values['whatsappPhoneNumberId'];
    $this->modeConfig = $values['modeConfig'];

    $this->_dirtyFields = [
      'whatsapp_phone_number_id' => true,
      'mode_config' => true
    ];
    if (array_key_exists('channel', $values)) {
      $this->_dirtyFields['channel'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->channel !== null) {
      $parts[] = [
        'name' => 'channel',
        'contents' => $this->channel
      ];
    }

    $parts[] = [
      'name' => 'whatsapp_phone_number_id',
      'contents' => $this->whatsappPhoneNumberId
    ];

    $parts[] = [
      'name' => 'mode_config',
      'contents' => json_encode($this->modeConfig),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString(
      $this->whatsappPhoneNumberId,
      'whatsapp_phone_number_id',
      minLength: 1
    );
  }
}
