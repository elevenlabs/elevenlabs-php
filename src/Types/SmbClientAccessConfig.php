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
class SmbClientAccessConfig extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('enable_secure_mode')]
  public ?bool $enableSecureMode;

  #[JsonProperty('identity_verification_enabled')]
  public ?bool $identityVerificationEnabled;

  #[JsonProperty('identity_verification_email_enabled')]
  public ?bool $identityVerificationEmailEnabled;

  #[JsonProperty('identity_verification_sms_enabled')]
  public ?bool $identityVerificationSmsEnabled;

  /**
   * @param array{
   *   enableSecureMode?: ?bool,
   *   identityVerificationEnabled?: ?bool,
   *   identityVerificationEmailEnabled?: ?bool,
   *   identityVerificationSmsEnabled?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->enableSecureMode = $values['enableSecureMode'] ?? null;
    $this->identityVerificationEnabled = $values['identityVerificationEnabled'] ?? null;
    $this->identityVerificationEmailEnabled = $values['identityVerificationEmailEnabled'] ?? null;
    $this->identityVerificationSmsEnabled = $values['identityVerificationSmsEnabled'] ?? null;

    if (array_key_exists('enableSecureMode', $values)) {
      $this->_dirtyFields['enable_secure_mode'] = true;
    }
    if (array_key_exists('identityVerificationEnabled', $values)) {
      $this->_dirtyFields['identity_verification_enabled'] = true;
    }
    if (array_key_exists('identityVerificationEmailEnabled', $values)) {
      $this->_dirtyFields['identity_verification_email_enabled'] = true;
    }
    if (array_key_exists('identityVerificationSmsEnabled', $values)) {
      $this->_dirtyFields['identity_verification_sms_enabled'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->enableSecureMode !== null) {
      $parts[] = [
        'name' => 'enable_secure_mode',
        'contents' => $this->enableSecureMode ? 'true' : 'false'
      ];
    }

    if ($this->identityVerificationEnabled !== null) {
      $parts[] = [
        'name' => 'identity_verification_enabled',
        'contents' => $this->identityVerificationEnabled ? 'true' : 'false'
      ];
    }

    if ($this->identityVerificationEmailEnabled !== null) {
      $parts[] = [
        'name' => 'identity_verification_email_enabled',
        'contents' => $this->identityVerificationEmailEnabled ? 'true' : 'false'
      ];
    }

    if ($this->identityVerificationSmsEnabled !== null) {
      $parts[] = [
        'name' => 'identity_verification_sms_enabled',
        'contents' => $this->identityVerificationSmsEnabled ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
