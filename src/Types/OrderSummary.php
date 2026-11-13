<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\Date;
use ElevenLabs\Utils\Validator;
use DateTime;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class OrderSummary extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('order_id', required: true)]
  public string $orderId;

  /**
   * The display name of the order.
   */
  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * @var value-of<\ElevenLabs\Types\OrderState>
   */
  #[JsonProperty('state', required: true)]
  public string $state;

  /**
   * The total price for all items in USD. Excluded from response until quotes are available.
   */
  #[JsonProperty('total_amount_usd')]
  public ?float $totalAmountUsd;

  /**
   * Whether this is a sandbox order that auto-progresses without producer intervention.
   */
  #[JsonProperty('sandbox')]
  public ?bool $sandbox;

  /**
   * The timestamp when the order was submitted, if applicable.
   */
  #[JsonProperty('submitted_at'), Date(Date::TYPE_DATETIME)]
  public ?DateTime $submittedAt;

  /**
   * The timestamp when the order was last modified, if applicable.
   */
  #[JsonProperty('updated_at'), Date(Date::TYPE_DATETIME)]
  public ?DateTime $updatedAt;

  /**
   * The reason the order was cancelled, if applicable.
   */
  #[JsonProperty('cancel_reason')]
  public ?string $cancelReason;

  /**
   * @param array{
   *   orderId: string,
   *   name: string,
   *   state: value-of<\ElevenLabs\Types\OrderState>,
   *   totalAmountUsd?: ?float,
   *   sandbox?: ?bool,
   *   submittedAt?: ?DateTime,
   *   updatedAt?: ?DateTime,
   *   cancelReason?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->orderId = $values['orderId'];
    $this->name = $values['name'];
    $this->state = $values['state'];
    $this->totalAmountUsd = $values['totalAmountUsd'] ?? null;
    $this->sandbox = $values['sandbox'] ?? null;
    $this->submittedAt = $values['submittedAt'] ?? null;
    $this->updatedAt = $values['updatedAt'] ?? null;
    $this->cancelReason = $values['cancelReason'] ?? null;

    $this->_dirtyFields = [
      'order_id' => true,
      'name' => true,
      'state' => true
    ];
    if (array_key_exists('totalAmountUsd', $values)) {
      $this->_dirtyFields['total_amount_usd'] = true;
    }
    if (array_key_exists('sandbox', $values)) {
      $this->_dirtyFields['sandbox'] = true;
    }
    if (array_key_exists('submittedAt', $values)) {
      $this->_dirtyFields['submitted_at'] = true;
    }
    if (array_key_exists('updatedAt', $values)) {
      $this->_dirtyFields['updated_at'] = true;
    }
    if (array_key_exists('cancelReason', $values)) {
      $this->_dirtyFields['cancel_reason'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'order_id',
      'contents' => $this->orderId
    ];

    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    $parts[] = [
      'name' => 'state',
      'contents' => $this->state
    ];

    if ($this->totalAmountUsd !== null) {
      $parts[] = [
        'name' => 'total_amount_usd',
        'contents' => (string) $this->totalAmountUsd
      ];
    }

    if ($this->sandbox !== null) {
      $parts[] = [
        'name' => 'sandbox',
        'contents' => $this->sandbox ? 'true' : 'false'
      ];
    }

    if ($this->submittedAt !== null) {
      $parts[] = [
        'name' => 'submitted_at',
        'contents' => $this->submittedAt
      ];
    }

    if ($this->updatedAt !== null) {
      $parts[] = [
        'name' => 'updated_at',
        'contents' => $this->updatedAt
      ];
    }

    if ($this->cancelReason !== null) {
      $parts[] = [
        'name' => 'cancel_reason',
        'contents' => $this->cancelReason
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->orderId, 'order_id', pattern: '^prodorder_[a-z0-9]{26}$');
  }
}
