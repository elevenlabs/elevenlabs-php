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
class SipColdReferTransferConfigOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\SipColdReferTransferConfigOutputCustomSipHeadersItem[]
   * Custom SIP headers to include when transferring the call. Each header can be either a static value or a dynamic variable reference.
   */
  #[
    JsonProperty('custom_sip_headers', required: true),
    ArrayType([\ElevenLabs\Types\SipColdReferTransferConfigOutputCustomSipHeadersItem::class])
  ]
  public array $customSipHeaders;

  #[JsonProperty('transfer_destination', required: true)]
  public \ElevenLabs\Types\SipColdReferTransferConfigOutputTransferDestination $transferDestination;

  /**
   * @var value-of<\ElevenLabs\Types\SipColdReferTransferConfigOutputType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  /**
   * User-to-User Information (RFC 7433) attached to the REFER. Carries call context such as CRM identifiers or escalation reason across the transfer boundary.
   */
  #[JsonProperty('uui', required: true)]
  public ?\ElevenLabs\Types\UuiTransferConfig $uui;

  /**
   * Play a ringing tone on the original call leg while the REFER completes. Disable if the receiving SBC/contact center should not hear it; the caller then hears silence until the transfer completes.
   */
  #[JsonProperty('play_dialtone', required: true)]
  public bool $playDialtone;

  /**
   * @param array{
   *   customSipHeaders: \ElevenLabs\Types\SipColdReferTransferConfigOutputCustomSipHeadersItem[],
   *   transferDestination: \ElevenLabs\Types\SipColdReferTransferConfigOutputTransferDestination,
   *   type: value-of<\ElevenLabs\Types\SipColdReferTransferConfigOutputType>,
   *   uui: ?\ElevenLabs\Types\UuiTransferConfig,
   *   playDialtone: bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->customSipHeaders = $values['customSipHeaders'];
    $this->transferDestination = $values['transferDestination'];
    $this->type = $values['type'];
    $this->uui = $values['uui'];
    $this->playDialtone = $values['playDialtone'];

    $this->_dirtyFields = [
      'custom_sip_headers' => true,
      'transfer_destination' => true,
      'type' => true,
      'uui' => true,
      'play_dialtone' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'custom_sip_headers',
      'contents' => json_encode($this->customSipHeaders),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'transfer_destination',
      'contents' => json_encode($this->transferDestination),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
    ];

    $parts[] = [
      'name' => 'uui',
      'contents' => json_encode($this->uui),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'play_dialtone',
      'contents' => $this->playDialtone ? 'true' : 'false'
    ];

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateArray($this->customSipHeaders, 'custom_sip_headers', maxItems: 20);
    $this->uui?->validate();
  }
}
