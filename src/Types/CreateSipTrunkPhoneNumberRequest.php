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
class CreateSipTrunkPhoneNumberRequest extends JsonSerializableType
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
   * @var ?value-of<\ElevenLabs\Types\CreateSipTrunkPhoneNumberRequestProvider>
   */
  #[JsonProperty('provider')]
  public ?string $provider;

  /**
   * Agent ID to assign the phone number to
   */
  #[JsonProperty('agent_id')]
  public ?string $agentId;

  #[JsonProperty('inbound_trunk_config')]
  public ?\ElevenLabs\Types\InboundSipTrunkConfigRequestModel $inboundTrunkConfig;

  #[JsonProperty('outbound_trunk_config')]
  public ?\ElevenLabs\Types\OutboundSipTrunkConfigRequestModel $outboundTrunkConfig;

  /**
   * @param array{
   *   phoneNumber: string,
   *   label: string,
   *   supportsInbound?: ?bool,
   *   supportsOutbound?: ?bool,
   *   provider?: ?value-of<\ElevenLabs\Types\CreateSipTrunkPhoneNumberRequestProvider>,
   *   agentId?: ?string,
   *   inboundTrunkConfig?: ?\ElevenLabs\Types\InboundSipTrunkConfigRequestModel,
   *   outboundTrunkConfig?: ?\ElevenLabs\Types\OutboundSipTrunkConfigRequestModel,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->phoneNumber = $values['phoneNumber'];
    $this->label = $values['label'];
    $this->supportsInbound = $values['supportsInbound'] ?? null;
    $this->supportsOutbound = $values['supportsOutbound'] ?? null;
    $this->provider = $values['provider'] ?? 'sip_trunk';
    $this->agentId = $values['agentId'] ?? null;
    $this->inboundTrunkConfig = $values['inboundTrunkConfig'] ?? null;
    $this->outboundTrunkConfig = $values['outboundTrunkConfig'] ?? null;

    $this->_dirtyFields = [
      'phone_number' => true,
      'label' => true
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
    if (array_key_exists('inboundTrunkConfig', $values)) {
      $this->_dirtyFields['inbound_trunk_config'] = true;
    }
    if (array_key_exists('outboundTrunkConfig', $values)) {
      $this->_dirtyFields['outbound_trunk_config'] = true;
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

    if ($this->inboundTrunkConfig !== null) {
      $parts[] = [
        'name' => 'inbound_trunk_config',
        'contents' => json_encode($this->inboundTrunkConfig),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->outboundTrunkConfig !== null) {
      $parts[] = [
        'name' => 'outbound_trunk_config',
        'contents' => json_encode($this->outboundTrunkConfig),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->inboundTrunkConfig?->validate();
    $this->outboundTrunkConfig?->validate();
  }
}
