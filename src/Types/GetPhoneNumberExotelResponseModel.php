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
class GetPhoneNumberExotelResponseModel extends JsonSerializableType
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
   * @var ?value-of<\ElevenLabs\Types\GetPhoneNumberExotelResponseModelProvider>
   * Phone provider
   */
  #[JsonProperty('provider')]
  public ?string $provider;

  /**
   * @param array{
   *   phoneNumber: string,
   *   label: string,
   *   phoneNumberId: string,
   *   supportsInbound?: ?bool,
   *   supportsOutbound?: ?bool,
   *   assignedAgent?: ?\ElevenLabs\Types\PhoneNumberAgentInfo,
   *   provider?: ?value-of<\ElevenLabs\Types\GetPhoneNumberExotelResponseModelProvider>,
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
    $this->provider = $values['provider'] ?? 'exotel';

    $this->_dirtyFields = [
      'phone_number' => true,
      'label' => true,
      'phone_number_id' => true
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

    return $parts;
  }

  public function validate(): void
  {
    $this->assignedAgent?->validate();
  }
}
