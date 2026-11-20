<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * Per-agent (receptionist) configuration for client identity verification codes.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ReceptionIdentityVerificationConfig extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * When enabled, the receptionist may only look up or modify a client's appointments and records after that client has completed OTP identity verification in this conversation.
   */
  #[JsonProperty('enabled')]
  public ?bool $enabled;

  /**
   * @var array<value-of<\ElevenLabs\Types\ReceptionNotificationChannel>>|null
   */
  #[JsonProperty('channels'), ArrayType(['string'])]
  public ?array $channels;

  /**
   * Twilio phone number ID used to send SMS verification codes.
   */
  #[JsonProperty('sms_phone_number_id')]
  public ?string $smsPhoneNumberId;

  /**
   * @param array{
   *   enabled?: ?bool,
   *   channels?: array<value-of<\ElevenLabs\Types\ReceptionNotificationChannel>>|null,
   *   smsPhoneNumberId?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->enabled = $values['enabled'] ?? null;
    $this->channels = $values['channels'] ?? null;
    $this->smsPhoneNumberId = $values['smsPhoneNumberId'] ?? null;

    if (array_key_exists('enabled', $values)) {
      $this->_dirtyFields['enabled'] = true;
    }
    if (array_key_exists('channels', $values)) {
      $this->_dirtyFields['channels'] = true;
    }
    if (array_key_exists('smsPhoneNumberId', $values)) {
      $this->_dirtyFields['sms_phone_number_id'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->enabled !== null) {
      $parts[] = [
        'name' => 'enabled',
        'contents' => $this->enabled ? 'true' : 'false'
      ];
    }

    if ($this->channels !== null) {
      foreach ($this->channels ?? [] as $item) {
        $parts[] = [
          'name' => 'channels',
          'contents' => $item
        ];
      }
    }

    if ($this->smsPhoneNumberId !== null) {
      $parts[] = [
        'name' => 'sms_phone_number_id',
        'contents' => $this->smsPhoneNumberId
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateArray($this->channels, 'channels', uniqueItems: true);
  }
}
