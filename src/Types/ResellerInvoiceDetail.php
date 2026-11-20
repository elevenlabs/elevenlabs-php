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
class ResellerInvoiceDetail extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('invoice_id', required: true)]
  public string $invoiceId;

  /**
   * The workspace this charge paid for.
   */
  #[JsonProperty('workspace_id', required: true)]
  public ?string $workspaceId;

  #[JsonProperty('workspace_name', required: true)]
  public string $workspaceName;

  /**
   * @var value-of<\ElevenLabs\Types\ResellerInvoiceStatus>
   * `open` while the card is still being retried; `void` once retries ran out and the workspace's plan was ended.
   */
  #[JsonProperty('status', required: true)]
  public string $status;

  /**
   * Invoice total, in the currency's minor unit.
   */
  #[JsonProperty('amount_cents', required: true)]
  public int $amountCents;

  #[JsonProperty('currency', required: true)]
  public string $currency;

  #[JsonProperty('created_unix', required: true)]
  public int $createdUnix;

  #[JsonProperty('paid_unix')]
  public ?int $paidUnix;

  /**
   * Stripe's hosted payment page, only while open.
   */
  #[JsonProperty('pay_url')]
  public ?string $payUrl;

  #[JsonProperty('pdf_url')]
  public ?string $pdfUrl;

  /**
   * @var \ElevenLabs\Types\ResellerInvoiceLine[]
   */
  #[
    JsonProperty('lines', required: true),
    ArrayType([\ElevenLabs\Types\ResellerInvoiceLine::class])
  ]
  public array $lines;

  /**
   * @param array{
   *   invoiceId: string,
   *   workspaceId: ?string,
   *   workspaceName: string,
   *   status: value-of<\ElevenLabs\Types\ResellerInvoiceStatus>,
   *   amountCents: int,
   *   currency: string,
   *   createdUnix: int,
   *   lines: \ElevenLabs\Types\ResellerInvoiceLine[],
   *   paidUnix?: ?int,
   *   payUrl?: ?string,
   *   pdfUrl?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->invoiceId = $values['invoiceId'];
    $this->workspaceId = $values['workspaceId'];
    $this->workspaceName = $values['workspaceName'];
    $this->status = $values['status'];
    $this->amountCents = $values['amountCents'];
    $this->currency = $values['currency'];
    $this->createdUnix = $values['createdUnix'];
    $this->paidUnix = $values['paidUnix'] ?? null;
    $this->payUrl = $values['payUrl'] ?? null;
    $this->pdfUrl = $values['pdfUrl'] ?? null;
    $this->lines = $values['lines'];

    $this->_dirtyFields = [
      'invoice_id' => true,
      'workspace_id' => true,
      'workspace_name' => true,
      'status' => true,
      'amount_cents' => true,
      'currency' => true,
      'created_unix' => true,
      'lines' => true
    ];
    if (array_key_exists('paidUnix', $values)) {
      $this->_dirtyFields['paid_unix'] = true;
    }
    if (array_key_exists('payUrl', $values)) {
      $this->_dirtyFields['pay_url'] = true;
    }
    if (array_key_exists('pdfUrl', $values)) {
      $this->_dirtyFields['pdf_url'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'invoice_id',
      'contents' => $this->invoiceId
    ];

    $parts[] = [
      'name' => 'workspace_id',
      'contents' => $this->workspaceId
    ];

    $parts[] = [
      'name' => 'workspace_name',
      'contents' => $this->workspaceName
    ];

    $parts[] = [
      'name' => 'status',
      'contents' => $this->status
    ];

    $parts[] = [
      'name' => 'amount_cents',
      'contents' => (string) $this->amountCents
    ];

    $parts[] = [
      'name' => 'currency',
      'contents' => $this->currency
    ];

    $parts[] = [
      'name' => 'created_unix',
      'contents' => (string) $this->createdUnix
    ];

    if ($this->paidUnix !== null) {
      $parts[] = [
        'name' => 'paid_unix',
        'contents' => (string) $this->paidUnix
      ];
    }

    if ($this->payUrl !== null) {
      $parts[] = [
        'name' => 'pay_url',
        'contents' => $this->payUrl
      ];
    }

    if ($this->pdfUrl !== null) {
      $parts[] = [
        'name' => 'pdf_url',
        'contents' => $this->pdfUrl
      ];
    }

    $parts[] = [
      'name' => 'lines',
      'contents' => json_encode($this->lines),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->lines as $item) {
      $item->validate();
    }
  }
}
