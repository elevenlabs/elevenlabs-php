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
class WorkflowPhoneNumberNodeModelInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\WorkflowPhoneNumberNodeModelInputCustomSipHeadersItem[]|null
   * Custom SIP headers to include when transferring the call. Each header can be either a static value or a dynamic variable reference.
   */
  #[
    JsonProperty('custom_sip_headers'),
    ArrayType([\ElevenLabs\Types\WorkflowPhoneNumberNodeModelInputCustomSipHeadersItem::class])
  ]
  public ?array $customSipHeaders;

  #[JsonProperty('transfer_destination', required: true)]
  public \ElevenLabs\Types\WorkflowPhoneNumberNodeModelInputTransferDestination $transferDestination;

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
  public ?\ElevenLabs\Types\WorkflowPhoneNumberNodeModelInputPostDialDigits $postDialDigits;

  /**
   * @var ?value-of<\ElevenLabs\Types\WorkflowPhoneNumberNodeModelInputType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  #[JsonProperty('position')]
  public ?\ElevenLabs\Types\PositionInput $position;

  /**
   * @var string[]|null
   * The ids of outgoing edges in the order they should be evaluated.
   */
  #[JsonProperty('edge_order'), ArrayType(['string'])]
  public ?array $edgeOrder;

  /**
   * @param array{
   *   transferDestination: \ElevenLabs\Types\WorkflowPhoneNumberNodeModelInputTransferDestination,
   *   customSipHeaders?: \ElevenLabs\Types\WorkflowPhoneNumberNodeModelInputCustomSipHeadersItem[]|null,
   *   transferType?: ?value-of<\ElevenLabs\Types\TransferTypeEnum>,
   *   sipReferPlayDialtone?: ?bool,
   *   uui?: ?\ElevenLabs\Types\UuiTransferConfig,
   *   postDialDigits?: ?\ElevenLabs\Types\WorkflowPhoneNumberNodeModelInputPostDialDigits,
   *   type?: ?value-of<\ElevenLabs\Types\WorkflowPhoneNumberNodeModelInputType>,
   *   position?: ?\ElevenLabs\Types\PositionInput,
   *   edgeOrder?: string[]|null,
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
    $this->type = $values['type'] ?? 'phone_number';
    $this->position = $values['position'] ?? null;
    $this->edgeOrder = $values['edgeOrder'] ?? null;

    $this->_dirtyFields = [
      'transfer_destination' => true
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
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
    if (array_key_exists('position', $values)) {
      $this->_dirtyFields['position'] = true;
    }
    if (array_key_exists('edgeOrder', $values)) {
      $this->_dirtyFields['edge_order'] = true;
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

    if ($this->type !== null) {
      $parts[] = [
        'name' => 'type',
        'contents' => $this->type
      ];
    }

    if ($this->position !== null) {
      $parts[] = [
        'name' => 'position',
        'contents' => json_encode($this->position),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->edgeOrder !== null) {
      foreach ($this->edgeOrder ?? [] as $item) {
        $parts[] = [
          'name' => 'edge_order',
          'contents' => $item
        ];
      }
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateArray($this->customSipHeaders, 'custom_sip_headers', maxItems: 20);
    $this->uui?->validate();
    $this->position?->validate();
  }
}
