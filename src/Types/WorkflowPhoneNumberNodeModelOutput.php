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
class WorkflowPhoneNumberNodeModelOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\WorkflowPhoneNumberNodeModelOutputCustomSipHeadersItem[]
   * Custom SIP headers to include when transferring the call. Each header can be either a static value or a dynamic variable reference.
   */
  #[
    JsonProperty('custom_sip_headers', required: true),
    ArrayType([\ElevenLabs\Types\WorkflowPhoneNumberNodeModelOutputCustomSipHeadersItem::class])
  ]
  public array $customSipHeaders;

  #[JsonProperty('transfer_destination', required: true)]
  public \ElevenLabs\Types\WorkflowPhoneNumberNodeModelOutputTransferDestination $transferDestination;

  /**
   * @var value-of<\ElevenLabs\Types\TransferTypeEnum>
   */
  #[JsonProperty('transfer_type', required: true)]
  public string $transferType;

  /**
   * When True, a ringing tone is played on the original call leg while a SIP REFER transfer completes. The tone is carried over RTP to the SIP peer executing the REFER, so disable this if the receiving system (e.g. an SBC or contact center) should not hear it. When disabled the caller hears silence until the transfer completes. SIP REFER transfers only.
   */
  #[JsonProperty('sip_refer_play_dialtone', required: true)]
  public bool $sipReferPlayDialtone;

  /**
   * User-to-User Information (RFC 7433) to attach to SIP REFER transfers. Carries call context such as CRM identifiers or escalation reason across the transfer boundary.
   */
  #[JsonProperty('uui', required: true)]
  public ?\ElevenLabs\Types\UuiTransferConfig $uui;

  /**
   * DTMF digits to send after call connects (e.g., 'ww1234' for extension). Can be either a static value or a dynamic variable reference. Use 'w' for 0.5s pause. Only supported for Twilio transfers.
   */
  #[JsonProperty('post_dial_digits', required: true)]
  public ?\ElevenLabs\Types\WorkflowPhoneNumberNodeModelOutputPostDialDigits $postDialDigits;

  /**
   * @var value-of<\ElevenLabs\Types\WorkflowPhoneNumberNodeModelOutputType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  #[JsonProperty('position', required: true)]
  public \ElevenLabs\Types\PositionOutput $position;

  /**
   * @var string[]
   * The ids of outgoing edges in the order they should be evaluated.
   */
  #[JsonProperty('edge_order', required: true), ArrayType(['string'])]
  public array $edgeOrder;

  /**
   * @param array{
   *   customSipHeaders: \ElevenLabs\Types\WorkflowPhoneNumberNodeModelOutputCustomSipHeadersItem[],
   *   transferDestination: \ElevenLabs\Types\WorkflowPhoneNumberNodeModelOutputTransferDestination,
   *   transferType: value-of<\ElevenLabs\Types\TransferTypeEnum>,
   *   sipReferPlayDialtone: bool,
   *   uui: ?\ElevenLabs\Types\UuiTransferConfig,
   *   postDialDigits: ?\ElevenLabs\Types\WorkflowPhoneNumberNodeModelOutputPostDialDigits,
   *   type: value-of<\ElevenLabs\Types\WorkflowPhoneNumberNodeModelOutputType>,
   *   position: \ElevenLabs\Types\PositionOutput,
   *   edgeOrder: string[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->customSipHeaders = $values['customSipHeaders'];
    $this->transferDestination = $values['transferDestination'];
    $this->transferType = $values['transferType'];
    $this->sipReferPlayDialtone = $values['sipReferPlayDialtone'];
    $this->uui = $values['uui'];
    $this->postDialDigits = $values['postDialDigits'];
    $this->type = $values['type'];
    $this->position = $values['position'];
    $this->edgeOrder = $values['edgeOrder'];

    $this->_dirtyFields = [
      'custom_sip_headers' => true,
      'transfer_destination' => true,
      'transfer_type' => true,
      'sip_refer_play_dialtone' => true,
      'uui' => true,
      'post_dial_digits' => true,
      'type' => true,
      'position' => true,
      'edge_order' => true
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
      'name' => 'transfer_type',
      'contents' => $this->transferType
    ];

    $parts[] = [
      'name' => 'sip_refer_play_dialtone',
      'contents' => $this->sipReferPlayDialtone ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'uui',
      'contents' => json_encode($this->uui),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'post_dial_digits',
      'contents' => json_encode($this->postDialDigits),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
    ];

    $parts[] = [
      'name' => 'position',
      'contents' => json_encode($this->position),
      'headers' => ['Content-Type' => 'application/json']
    ];

    foreach ($this->edgeOrder as $item) {
      $parts[] = [
        'name' => 'edge_order',
        'contents' => $item
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateArray($this->customSipHeaders, 'custom_sip_headers', maxItems: 20);
    $this->uui?->validate();
    $this->position->validate();
  }
}
