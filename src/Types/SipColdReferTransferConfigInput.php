<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class SipColdReferTransferConfigInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\SipColdReferTransferConfigInputCustomSipHeadersItem[]|null
   * Custom SIP headers to include when transferring the call. Each header can be either a static value or a dynamic variable reference.
   */
  #[
    JsonProperty('custom_sip_headers'),
    ArrayType([\ElevenLabs\Types\SipColdReferTransferConfigInputCustomSipHeadersItem::class])
  ]
  public ?array $customSipHeaders;

  #[JsonProperty('transfer_destination', required: true)]
  public \ElevenLabs\Types\SipColdReferTransferConfigInputTransferDestination $transferDestination;

  /**
   * @var ?value-of<\ElevenLabs\Types\SipColdReferTransferConfigInputType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * User-to-User Information (RFC 7433) attached to the REFER. Carries call context such as CRM identifiers or escalation reason across the transfer boundary.
   */
  #[JsonProperty('uui')]
  public ?\ElevenLabs\Types\UuiTransferConfig $uui;

  /**
   * Play a ringing tone on the original call leg while the REFER completes. Disable if the receiving SBC/contact center should not hear it; the caller then hears silence until the transfer completes.
   */
  #[JsonProperty('play_dialtone')]
  public ?bool $playDialtone;

  /**
   * @param array{
   *   transferDestination: \ElevenLabs\Types\SipColdReferTransferConfigInputTransferDestination,
   *   customSipHeaders?: \ElevenLabs\Types\SipColdReferTransferConfigInputCustomSipHeadersItem[]|null,
   *   type?: ?value-of<\ElevenLabs\Types\SipColdReferTransferConfigInputType>,
   *   uui?: ?\ElevenLabs\Types\UuiTransferConfig,
   *   playDialtone?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->customSipHeaders = $values['customSipHeaders'] ?? null;
    $this->transferDestination = $values['transferDestination'];
    $this->type = $values['type'] ?? 'sip_cold_refer_transfer';
    $this->uui = $values['uui'] ?? null;
    $this->playDialtone = $values['playDialtone'] ?? null;

    $this->_dirtyFields = [
      'transfer_destination' => true
    ];
    if (array_key_exists('customSipHeaders', $values)) {
      $this->_dirtyFields['custom_sip_headers'] = true;
    }
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
    if (array_key_exists('uui', $values)) {
      $this->_dirtyFields['uui'] = true;
    }
    if (array_key_exists('playDialtone', $values)) {
      $this->_dirtyFields['play_dialtone'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->customSipHeaders !== null) {
      $parts[] = [
        'name' => 'custom_sip_headers',
        'contents' => json_encode($this->customSipHeaders),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    $parts[] = [
      'name' => 'transfer_destination',
      'contents' => json_encode($this->transferDestination),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->type !== null) {
      $parts[] = [
        'name' => 'type',
        'contents' => $this->type
      ];
    }

    if ($this->uui !== null) {
      $parts[] = [
        'name' => 'uui',
        'contents' => json_encode($this->uui),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->playDialtone !== null) {
      $parts[] = [
        'name' => 'play_dialtone',
        'contents' => $this->playDialtone ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateArray($this->customSipHeaders, 'custom_sip_headers', maxItems: 20);
    $this->uui?->validate();
  }
}
