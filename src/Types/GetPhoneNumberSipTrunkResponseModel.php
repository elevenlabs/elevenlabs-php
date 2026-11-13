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
class GetPhoneNumberSipTrunkResponseModel extends JsonSerializableType
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
   * The ID of the phone number
   */
  #[JsonProperty('phone_number_id', required: true)]
  public string $phoneNumberId;

  /**
   * The agent that is assigned to the phone number
   */
  #[JsonProperty('assigned_agent')]
  public ?\ElevenLabs\Types\PhoneNumberAgentInfo $assignedAgent;

  /**
   * @var ?value-of<\ElevenLabs\Types\GetPhoneNumberSipTrunkResponseModelProvider>
   * Phone provider
   */
  #[JsonProperty('provider')]
  public ?string $provider;

  #[JsonProperty('provider_config')]
  public ?\ElevenLabs\Types\GetPhoneNumberOutboundSipTrunkConfigResponseModel $providerConfig;

  /**
   * Configuration of the Outbound SIP trunk - if configured.
   */
  #[JsonProperty('outbound_trunk')]
  public ?\ElevenLabs\Types\GetPhoneNumberOutboundSipTrunkConfigResponseModel $outboundTrunk;

  /**
   * Configuration of the Inbound SIP trunk - if configured.
   */
  #[JsonProperty('inbound_trunk')]
  public ?\ElevenLabs\Types\GetPhoneNumberInboundSipTrunkConfigResponseModel $inboundTrunk;

  /**
   * @var value-of<\ElevenLabs\Types\LivekitStackType>
   */
  #[JsonProperty('livekit_stack', required: true)]
  public string $livekitStack;

  /**
   * Whether to store SIP messages for this phone number.
   */
  #[JsonProperty('store_sip_messages')]
  public ?bool $storeSipMessages;

  /**
   * @param array{
   *   phoneNumber: string,
   *   label: string,
   *   phoneNumberId: string,
   *   livekitStack: value-of<\ElevenLabs\Types\LivekitStackType>,
   *   supportsInbound?: ?bool,
   *   supportsOutbound?: ?bool,
   *   assignedAgent?: ?\ElevenLabs\Types\PhoneNumberAgentInfo,
   *   provider?: ?value-of<\ElevenLabs\Types\GetPhoneNumberSipTrunkResponseModelProvider>,
   *   providerConfig?: ?\ElevenLabs\Types\GetPhoneNumberOutboundSipTrunkConfigResponseModel,
   *   outboundTrunk?: ?\ElevenLabs\Types\GetPhoneNumberOutboundSipTrunkConfigResponseModel,
   *   inboundTrunk?: ?\ElevenLabs\Types\GetPhoneNumberInboundSipTrunkConfigResponseModel,
   *   storeSipMessages?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->phoneNumber = $values['phoneNumber'];
    $this->label = $values['label'];
    $this->supportsInbound = $values['supportsInbound'] ?? null;
    $this->supportsOutbound = $values['supportsOutbound'] ?? null;
    $this->phoneNumberId = $values['phoneNumberId'];
    $this->assignedAgent = $values['assignedAgent'] ?? null;
    $this->provider = $values['provider'] ?? 'sip_trunk';
    $this->providerConfig = $values['providerConfig'] ?? null;
    $this->outboundTrunk = $values['outboundTrunk'] ?? null;
    $this->inboundTrunk = $values['inboundTrunk'] ?? null;
    $this->livekitStack = $values['livekitStack'];
    $this->storeSipMessages = $values['storeSipMessages'] ?? null;

    $this->_dirtyFields = [
      'phone_number' => true,
      'label' => true,
      'phone_number_id' => true,
      'livekit_stack' => true
    ];
    if (array_key_exists('supportsInbound', $values)) {
      $this->_dirtyFields['supports_inbound'] = true;
    }
    if (array_key_exists('supportsOutbound', $values)) {
      $this->_dirtyFields['supports_outbound'] = true;
    }
    if (array_key_exists('assignedAgent', $values)) {
      $this->_dirtyFields['assigned_agent'] = true;
    }
    if (array_key_exists('provider', $values)) {
      $this->_dirtyFields['provider'] = true;
    }
    if (array_key_exists('providerConfig', $values)) {
      $this->_dirtyFields['provider_config'] = true;
    }
    if (array_key_exists('outboundTrunk', $values)) {
      $this->_dirtyFields['outbound_trunk'] = true;
    }
    if (array_key_exists('inboundTrunk', $values)) {
      $this->_dirtyFields['inbound_trunk'] = true;
    }
    if (array_key_exists('storeSipMessages', $values)) {
      $this->_dirtyFields['store_sip_messages'] = true;
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

    $parts[] = [
      'name' => 'phone_number_id',
      'contents' => $this->phoneNumberId
    ];

    if ($this->assignedAgent !== null) {
      $parts[] = [
        'name' => 'assigned_agent',
        'contents' => json_encode($this->assignedAgent),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->provider !== null) {
      $parts[] = [
        'name' => 'provider',
        'contents' => $this->provider
      ];
    }

    if ($this->providerConfig !== null) {
      $parts[] = [
        'name' => 'provider_config',
        'contents' => json_encode($this->providerConfig),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->outboundTrunk !== null) {
      $parts[] = [
        'name' => 'outbound_trunk',
        'contents' => json_encode($this->outboundTrunk),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->inboundTrunk !== null) {
      $parts[] = [
        'name' => 'inbound_trunk',
        'contents' => json_encode($this->inboundTrunk),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    $parts[] = [
      'name' => 'livekit_stack',
      'contents' => $this->livekitStack
    ];

    if ($this->storeSipMessages !== null) {
      $parts[] = [
        'name' => 'store_sip_messages',
        'contents' => $this->storeSipMessages ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->assignedAgent?->validate();
    $this->providerConfig?->validate();
    $this->outboundTrunk?->validate();
    $this->inboundTrunk?->validate();
  }
}
