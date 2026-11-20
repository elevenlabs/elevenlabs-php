<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * One line of the workspace's invoice; an `adjustment` line covers any remainder, so lines sum to the charge.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ResellerInvoiceLine extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\ResellerInvoiceLineKind>
   */
  #[JsonProperty('kind', required: true)]
  public string $kind;

  #[JsonProperty('description', required: true)]
  public string $description;

  #[JsonProperty('quantity')]
  public ?int $quantity;

  /**
   * Negative for a proration credit.
   */
  #[JsonProperty('amount_cents', required: true)]
  public int $amountCents;

  #[JsonProperty('period_start_unix', required: true)]
  public int $periodStartUnix;

  #[JsonProperty('period_end_unix', required: true)]
  public int $periodEndUnix;

  /**
   * @param array{
   *   kind: value-of<\ElevenLabs\Types\ResellerInvoiceLineKind>,
   *   description: string,
   *   amountCents: int,
   *   periodStartUnix: int,
   *   periodEndUnix: int,
   *   quantity?: ?int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->kind = $values['kind'];
    $this->description = $values['description'];
    $this->quantity = $values['quantity'] ?? null;
    $this->amountCents = $values['amountCents'];
    $this->periodStartUnix = $values['periodStartUnix'];
    $this->periodEndUnix = $values['periodEndUnix'];

    $this->_dirtyFields = [
      'kind' => true,
      'description' => true,
      'amount_cents' => true,
      'period_start_unix' => true,
      'period_end_unix' => true
    ];
    if (array_key_exists('quantity', $values)) {
      $this->_dirtyFields['quantity'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'kind',
      'contents' => $this->kind
    ];

    $parts[] = [
      'name' => 'description',
      'contents' => $this->description
    ];

    if ($this->quantity !== null) {
      $parts[] = [
        'name' => 'quantity',
        'contents' => (string) $this->quantity
      ];
    }

    $parts[] = [
      'name' => 'amount_cents',
      'contents' => (string) $this->amountCents
    ];

    $parts[] = [
      'name' => 'period_start_unix',
      'contents' => (string) $this->periodStartUnix
    ];

    $parts[] = [
      'name' => 'period_end_unix',
      'contents' => (string) $this->periodEndUnix
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
