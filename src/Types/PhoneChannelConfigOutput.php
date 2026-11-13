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
class PhoneChannelConfigOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\PhoneChannelConfigOutputChannel>
   */
  #[JsonProperty('channel')]
  public ?string $channel;

  /**
   * The phone number to call from.
   */
  #[JsonProperty('agent_phone_number_id', required: true)]
  public string $agentPhoneNumberId;

  #[JsonProperty('mode_config')]
  public ?\ElevenLabs\Types\PhoneVoiceConfigOutput $modeConfig;

  /**
   * @param array{
   *   agentPhoneNumberId: string,
   *   channel?: ?value-of<\ElevenLabs\Types\PhoneChannelConfigOutputChannel>,
   *   modeConfig?: ?\ElevenLabs\Types\PhoneVoiceConfigOutput,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->channel = $values['channel'] ?? 'phone';
    $this->agentPhoneNumberId = $values['agentPhoneNumberId'];
    $this->modeConfig = $values['modeConfig'] ?? null;

    $this->_dirtyFields = [
      'agent_phone_number_id' => true
    ];
    if (array_key_exists('channel', $values)) {
      $this->_dirtyFields['channel'] = true;
    }
    if (array_key_exists('modeConfig', $values)) {
      $this->_dirtyFields['mode_config'] = true;
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
      'name' => 'agent_phone_number_id',
      'contents' => $this->agentPhoneNumberId
    ];

    if ($this->modeConfig !== null) {
      $parts[] = [
        'name' => 'mode_config',
        'contents' => json_encode($this->modeConfig),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString(
      $this->agentPhoneNumberId,
      'agent_phone_number_id',
      minLength: 1,
      maxLength: 256
    );
    $this->modeConfig?->validate();
  }
}
