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
class CreateExotelPhoneNumberRequest extends JsonSerializableType
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
   * @var ?value-of<\ElevenLabs\Types\CreateExotelPhoneNumberRequestProvider>
   */
  #[JsonProperty('provider')]
  public ?string $provider;

  /**
   * Agent ID to assign the phone number to
   */
  #[JsonProperty('agent_id')]
  public ?string $agentId;

  /**
   * Exotel Account SID
   */
  #[JsonProperty('account_sid', required: true)]
  public string $accountSid;

  /**
   * Exotel API Key
   */
  #[JsonProperty('api_key', required: true)]
  public string $apiKey;

  /**
   * Exotel API Token
   */
  #[JsonProperty('api_token', required: true)]
  public string $apiToken;

  /**
   * @var value-of<\ElevenLabs\Types\ExotelApiSubdomain>
   */
  #[JsonProperty('api_subdomain', required: true)]
  public string $apiSubdomain;

  /**
   * Exotel applet identifier used in Calls/connect
   */
  #[JsonProperty('app_id', required: true)]
  public string $appId;

  /**
   * Optional full applet URL override. Defaults to Exotel start_voice URL derived from account SID and app ID.
   */
  #[JsonProperty('applet_url')]
  public ?string $appletUrl;

  /**
   * @param array{
   *   phoneNumber: string,
   *   label: string,
   *   accountSid: string,
   *   apiKey: string,
   *   apiToken: string,
   *   apiSubdomain: value-of<\ElevenLabs\Types\ExotelApiSubdomain>,
   *   appId: string,
   *   supportsInbound?: ?bool,
   *   supportsOutbound?: ?bool,
   *   provider?: ?value-of<\ElevenLabs\Types\CreateExotelPhoneNumberRequestProvider>,
   *   agentId?: ?string,
   *   appletUrl?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->phoneNumber = $values['phoneNumber'];
    $this->label = $values['label'];
    $this->supportsInbound = $values['supportsInbound'] ?? null;
    $this->supportsOutbound = $values['supportsOutbound'] ?? null;
    $this->provider = $values['provider'] ?? 'exotel';
    $this->agentId = $values['agentId'] ?? null;
    $this->accountSid = $values['accountSid'];
    $this->apiKey = $values['apiKey'];
    $this->apiToken = $values['apiToken'];
    $this->apiSubdomain = $values['apiSubdomain'];
    $this->appId = $values['appId'];
    $this->appletUrl = $values['appletUrl'] ?? null;

    $this->_dirtyFields = [
      'phone_number' => true,
      'label' => true,
      'account_sid' => true,
      'api_key' => true,
      'api_token' => true,
      'api_subdomain' => true,
      'app_id' => true
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
    if (array_key_exists('appletUrl', $values)) {
      $this->_dirtyFields['applet_url'] = true;
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
      'name' => 'account_sid',
      'contents' => $this->accountSid
    ];

    $parts[] = [
      'name' => 'api_key',
      'contents' => $this->apiKey
    ];

    $parts[] = [
      'name' => 'api_token',
      'contents' => $this->apiToken
    ];

    $parts[] = [
      'name' => 'api_subdomain',
      'contents' => $this->apiSubdomain
    ];

    $parts[] = [
      'name' => 'app_id',
      'contents' => $this->appId
    ];

    if ($this->appletUrl !== null) {
      $parts[] = [
        'name' => 'applet_url',
        'contents' => $this->appletUrl
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
