<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class InvoiceResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The amount due in cents.
   */
  #[JsonProperty('amount_due_cents', required: true)]
  public int $amountDueCents;

  /**
   * The subtotal amount in cents before tax (exclusive of tax and discounts).
   */
  #[JsonProperty('subtotal_cents')]
  public ?int $subtotalCents;

  /**
   * The tax amount in cents.
   */
  #[JsonProperty('tax_cents')]
  public ?int $taxCents;

  /**
   * Deprecated. Use [discounts] instead. The discount applied to the invoice. E.g. [20.0f] for 20% off.
   */
  #[JsonProperty('discount_percent_off')]
  public ?float $discountPercentOff;

  /**
   * Deprecated. Use [discounts] instead. The discount applied to the invoice. E.g. [20.0f] for 20 cents off.
   */
  #[JsonProperty('discount_amount_off')]
  public ?float $discountAmountOff;

  /**
   * @var \ElevenLabs\Types\DiscountResponseModel[]
   * The discounts applied to the invoice.
   */
  #[
    JsonProperty('discounts', required: true),
    ArrayType([\ElevenLabs\Types\DiscountResponseModel::class])
  ]
  public array $discounts;

  /**
   * The Unix timestamp of the next payment attempt. -1 when there is no next payment attempt.
   */
  #[JsonProperty('next_payment_attempt_unix', required: true)]
  public int $nextPaymentAttemptUnix;

  /**
   * @var ?value-of<\ElevenLabs\Types\InvoiceResponsePaymentIntentStatus>
   * Deprecated. Use [payment_intent_statusses] instead. The status of this invoice's first payment intent. None when there is no payment intent.
   */
  #[JsonProperty('payment_intent_status', required: true)]
  public ?string $paymentIntentStatus;

  /**
   * @var array<value-of<\ElevenLabs\Types\InvoiceResponsePaymentIntentStatussesItem>>
   * The statuses of this invoice's payment intents. Empty list when there are no payment intents.
   */
  #[JsonProperty('payment_intent_statusses', required: true), ArrayType(['string'])]
  public array $paymentIntentStatusses;

  /**
   * @param array{
   *   amountDueCents: int,
   *   discounts: \ElevenLabs\Types\DiscountResponseModel[],
   *   nextPaymentAttemptUnix: int,
   *   paymentIntentStatus: ?value-of<\ElevenLabs\Types\InvoiceResponsePaymentIntentStatus>,
   *   paymentIntentStatusses: array<value-of<\ElevenLabs\Types\InvoiceResponsePaymentIntentStatussesItem>>,
   *   subtotalCents?: ?int,
   *   taxCents?: ?int,
   *   discountPercentOff?: ?float,
   *   discountAmountOff?: ?float,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->amountDueCents = $values['amountDueCents'];
    $this->subtotalCents = $values['subtotalCents'] ?? null;
    $this->taxCents = $values['taxCents'] ?? null;
    $this->discountPercentOff = $values['discountPercentOff'] ?? null;
    $this->discountAmountOff = $values['discountAmountOff'] ?? null;
    $this->discounts = $values['discounts'];
    $this->nextPaymentAttemptUnix = $values['nextPaymentAttemptUnix'];
    $this->paymentIntentStatus = $values['paymentIntentStatus'];
    $this->paymentIntentStatusses = $values['paymentIntentStatusses'];

    $this->_dirtyFields = [
      'amount_due_cents' => true,
      'discounts' => true,
      'next_payment_attempt_unix' => true,
      'payment_intent_status' => true,
      'payment_intent_statusses' => true
    ];
    if (array_key_exists('subtotalCents', $values)) {
      $this->_dirtyFields['subtotal_cents'] = true;
    }
    if (array_key_exists('taxCents', $values)) {
      $this->_dirtyFields['tax_cents'] = true;
    }
    if (array_key_exists('discountPercentOff', $values)) {
      $this->_dirtyFields['discount_percent_off'] = true;
    }
    if (array_key_exists('discountAmountOff', $values)) {
      $this->_dirtyFields['discount_amount_off'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'amount_due_cents',
      'contents' => (string) $this->amountDueCents
    ];

    if ($this->subtotalCents !== null) {
      $parts[] = [
        'name' => 'subtotal_cents',
        'contents' => (string) $this->subtotalCents
      ];
    }

    if ($this->taxCents !== null) {
      $parts[] = [
        'name' => 'tax_cents',
        'contents' => (string) $this->taxCents
      ];
    }

    if ($this->discountPercentOff !== null) {
      $parts[] = [
        'name' => 'discount_percent_off',
        'contents' => (string) $this->discountPercentOff
      ];
    }

    if ($this->discountAmountOff !== null) {
      $parts[] = [
        'name' => 'discount_amount_off',
        'contents' => (string) $this->discountAmountOff
      ];
    }

    $parts[] = [
      'name' => 'discounts',
      'contents' => json_encode($this->discounts),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'next_payment_attempt_unix',
      'contents' => (string) $this->nextPaymentAttemptUnix
    ];

    $parts[] = [
      'name' => 'payment_intent_status',
      'contents' => $this->paymentIntentStatus
    ];

    foreach ($this->paymentIntentStatusses as $item) {
      $parts[] = [
        'name' => 'payment_intent_statusses',
        'contents' => $item
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->discounts as $item) {
      $item->validate();
    }
  }
}
