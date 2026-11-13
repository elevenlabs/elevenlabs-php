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
class PhoneNumberTransfer extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\PhoneNumberTransferCustomSipHeadersItem[]|null
   * Custom SIP headers to include when transferring the call. Each header can be either a static value or a dynamic variable reference.
   */
  #[
    JsonProperty('custom_sip_headers'),
    ArrayType([\ElevenLabs\Types\PhoneNumberTransferCustomSipHeadersItem::class])
  ]
  public ?array $customSipHeaders;

  #[JsonProperty('transfer_destination', required: true)]
  public \ElevenLabs\Types\PhoneNumberTransferTransferDestination $transferDestination;

  /**
   * @var ?value-of<\ElevenLabs\Types\TransferTypeEnum>
   */
  #[JsonProperty('transfer_type')]
  public ?string $transferType;

  /**
   * When True, a ringing tone is played on the original call leg while a SIP REFER transfer completes. The tone is carried over RTP to the SIP peer executing the REFER, so disable this if the receiving system (e.g. an SBC or contact center) should not hear it. When disabled the caller hears silence until the transfer completes. SIP REFER transfers only.
   */
  #[JsonProperty('sip_refer_play_dialtone')]
  public ?bool $sipReferPlayDialtone;

  /**
   * User-to-User Information (RFC 7433) to attach to SIP REFER transfers. Carries call context such as CRM identifiers or escalation reason across the transfer boundary.
   */
  #[JsonProperty('uui')]
  public ?\ElevenLabs\Types\UuiTransferConfig $uui;

  /**
   * DTMF digits to send after call connects (e.g., 'ww1234' for extension). Can be either a static value or a dynamic variable reference. Use 'w' for 0.5s pause. Only supported for Twilio transfers.
   */
  #[JsonProperty('post_dial_digits')]
  public ?\ElevenLabs\Types\PhoneNumberTransferPostDialDigits $postDialDigits;

  #[JsonProperty('phone_number')]
  public ?string $phoneNumber;

  #[JsonProperty('condition', required: true)]
  public string $condition;

  /**
   * @param array{
   *   transferDestination: \ElevenLabs\Types\PhoneNumberTransferTransferDestination,
   *   condition: string,
   *   customSipHeaders?: \ElevenLabs\Types\PhoneNumberTransferCustomSipHeadersItem[]|null,
   *   transferType?: ?value-of<\ElevenLabs\Types\TransferTypeEnum>,
   *   sipReferPlayDialtone?: ?bool,
   *   uui?: ?\ElevenLabs\Types\UuiTransferConfig,
   *   postDialDigits?: ?\ElevenLabs\Types\PhoneNumberTransferPostDialDigits,
   *   phoneNumber?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->customSipHeaders = $values['customSipHeaders'] ?? null;
    $this->transferDestination = $values['transferDestination'];
    $this->transferType = $values['transferType'] ?? null;
    $this->sipReferPlayDialtone = $values['sipReferPlayDialtone'] ?? null;
    $this->uui = $values['uui'] ?? null;
    $this->postDialDigits = $values['postDialDigits'] ?? null;
    $this->phoneNumber = $values['phoneNumber'] ?? null;
    $this->condition = $values['condition'];

    $this->_dirtyFields = [
      'transfer_destination' => true,
      'condition' => true
    ];
    if (array_key_exists('customSipHeaders', $values)) {
      $this->_dirtyFields['custom_sip_headers'] = true;
    }
    if (array_key_exists('transferType', $values)) {
      $this->_dirtyFields['transfer_type'] = true;
    }
    if (array_key_exists('sipReferPlayDialtone', $values)) {
      $this->_dirtyFields['sip_refer_play_dialtone'] = true;
    }
    if (array_key_exists('uui', $values)) {
      $this->_dirtyFields['uui'] = true;
    }
    if (array_key_exists('postDialDigits', $values)) {
      $this->_dirtyFields['post_dial_digits'] = true;
    }
    if (array_key_exists('phoneNumber', $values)) {
      $this->_dirtyFields['phone_number'] = true;
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

    if ($this->transferType !== null) {
      $parts[] = [
        'name' => 'transfer_type',
        'contents' => $this->transferType
      ];
    }

    if ($this->sipReferPlayDialtone !== null) {
      $parts[] = [
        'name' => 'sip_refer_play_dialtone',
        'contents' => $this->sipReferPlayDialtone ? 'true' : 'false'
      ];
    }

    if ($this->uui !== null) {
      $parts[] = [
        'name' => 'uui',
        'contents' => json_encode($this->uui),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->postDialDigits !== null) {
      $parts[] = [
        'name' => 'post_dial_digits',
        'contents' => json_encode($this->postDialDigits),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->phoneNumber !== null) {
      $parts[] = [
        'name' => 'phone_number',
        'contents' => $this->phoneNumber
      ];
    }

    $parts[] = [
      'name' => 'condition',
      'contents' => $this->condition
    ];

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateArray($this->customSipHeaders, 'custom_sip_headers', maxItems: 20);
    $this->uui?->validate();
  }
}
