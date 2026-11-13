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
class CreateTwilioPhoneNumberRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Phone number
   */
  #[JsonProperty('phone_number', required: true)]
  public string $phoneNumber;

  /**
   * Label for the phone number
   */
  #[JsonProperty('label', required: true)]
  public string $label;

  /**
   * This field is deprecated and will be removed in the future. Whether this phone number supports inbound calls
   */
  #[JsonProperty('supports_inbound')]
  public ?bool $supportsInbound;

  /**
   * This field is deprecated and will be removed in the future. Whether this phone number supports outbound calls
   */
  #[JsonProperty('supports_outbound')]
  public ?bool $supportsOutbound;

  /**
   * @var ?value-of<\ElevenLabs\Types\CreateTwilioPhoneNumberRequestProvider>
   */
  #[JsonProperty('provider')]
  public ?string $provider;

  /**
   * Agent ID to assign the phone number to
   */
  #[JsonProperty('agent_id')]
  public ?string $agentId;

  /**
   * Twilio Account SID (starts with `AC`) or API Key SID (starts with `SK`)
   */
  #[JsonProperty('sid', required: true)]
  public string $sid;

  /**
   * Secret paired with `sid`: the Account Auth Token for an Account SID, or the API Key Secret for an API Key SID
   */
  #[JsonProperty('token', required: true)]
  public string $token;

  /**
   * Twilio Account Auth Token, required for API Key imports to validate inbound webhook signatures
   */
  #[JsonProperty('account_auth_token')]
  public ?string $accountAuthToken;

  /**
   * Twilio Additional Region Configuration
   */
  #[JsonProperty('region_config')]
  public ?\ElevenLabs\Types\RegionConfigRequest $regionConfig;

  /**
   * Route inbound SMS to ElevenLabs. On by default; set to false to skip SMS configuration for numbers that don't support it.
   */
  #[JsonProperty('enable_sms')]
  public ?bool $enableSms;

  /**
   * @param array{
   *   phoneNumber: string,
   *   label: string,
   *   sid: string,
   *   token: string,
   *   supportsInbound?: ?bool,
   *   supportsOutbound?: ?bool,
   *   provider?: ?value-of<\ElevenLabs\Types\CreateTwilioPhoneNumberRequestProvider>,
   *   agentId?: ?string,
   *   accountAuthToken?: ?string,
   *   regionConfig?: ?\ElevenLabs\Types\RegionConfigRequest,
   *   enableSms?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->phoneNumber = $values['phoneNumber'];
    $this->label = $values['label'];
    $this->supportsInbound = $values['supportsInbound'] ?? null;
    $this->supportsOutbound = $values['supportsOutbound'] ?? null;
    $this->provider = $values['provider'] ?? 'twilio';
    $this->agentId = $values['agentId'] ?? null;
    $this->sid = $values['sid'];
    $this->token = $values['token'];
    $this->accountAuthToken = $values['accountAuthToken'] ?? null;
    $this->regionConfig = $values['regionConfig'] ?? null;
    $this->enableSms = $values['enableSms'] ?? null;

    $this->_dirtyFields = [
      'phone_number' => true,
      'label' => true,
      'sid' => true,
      'token' => true
    ];
    if (array_key_exists('supportsInbound', $values)) {
      $this->_dirtyFields['supports_inbound'] = true;
    }
    if (array_key_exists('supportsOutbound', $values)) {
      $this->_dirtyFields['supports_outbound'] = true;
    }
    if (array_key_exists('provider', $values)) {
      $this->_dirtyFields['provider'] = true;
    }
    if (array_key_exists('agentId', $values)) {
      $this->_dirtyFields['agent_id'] = true;
    }
    if (array_key_exists('accountAuthToken', $values)) {
      $this->_dirtyFields['account_auth_token'] = true;
    }
    if (array_key_exists('regionConfig', $values)) {
      $this->_dirtyFields['region_config'] = true;
    }
    if (array_key_exists('enableSms', $values)) {
      $this->_dirtyFields['enable_sms'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'phone_number',
      'contents' => $this->phoneNumber
    ];

    $parts[] = [
      'name' => 'label',
      'contents' => $this->label
    ];

    if ($this->supportsInbound !== null) {
      $parts[] = [
        'name' => 'supports_inbound',
        'contents' => $this->supportsInbound ? 'true' : 'false'
      ];
    }

    if ($this->supportsOutbound !== null) {
      $parts[] = [
        'name' => 'supports_outbound',
        'contents' => $this->supportsOutbound ? 'true' : 'false'
      ];
    }

    if ($this->provider !== null) {
      $parts[] = [
        'name' => 'provider',
        'contents' => $this->provider
      ];
    }

    if ($this->agentId !== null) {
      $parts[] = [
        'name' => 'agent_id',
        'contents' => $this->agentId
      ];
    }

    $parts[] = [
      'name' => 'sid',
      'contents' => $this->sid
    ];

    $parts[] = [
      'name' => 'token',
      'contents' => $this->token
    ];

    if ($this->accountAuthToken !== null) {
      $parts[] = [
        'name' => 'account_auth_token',
        'contents' => $this->accountAuthToken
      ];
    }

    if ($this->regionConfig !== null) {
      $parts[] = [
        'name' => 'region_config',
        'contents' => json_encode($this->regionConfig),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->enableSms !== null) {
      $parts[] = [
        'name' => 'enable_sms',
        'contents' => $this->enableSms ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->regionConfig?->validate();
  }
}
