<?php

declare(strict_types=1);

namespace ElevenLabs\Reception\Subscriptions\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * Move a workspace to another of the reseller's tiers.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ChangeResellerTierRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('tier_id', required: true)]
  public string $tierId;

  /**
   * @var ?value-of<\ElevenLabs\Reception\Subscriptions\Types\ChangeResellerTierRequestBillingPeriod>
   */
  #[JsonProperty('billing_period')]
  public ?string $billingPeriod;

  /**
   * Client-generated key that makes a retry safe. The same key and body within 24 hours returns the first result without running again. While that first request is still running, a retry gets 409 `idempotency_key_in_progress`; a different body with the same key gets 400 `idempotency_key_reused`. A request that fails is not saved, so it can be retried with the same key.
   */
  #[JsonProperty('idempotency_key')]
  public ?string $idempotencyKey;

  /**
   * @param array{
   *   tierId: string,
   *   billingPeriod?: ?value-of<\ElevenLabs\Reception\Subscriptions\Types\ChangeResellerTierRequestBillingPeriod>,
   *   idempotencyKey?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->tierId = $values['tierId'];
    $this->billingPeriod = $values['billingPeriod'] ?? null;
    $this->idempotencyKey = $values['idempotencyKey'] ?? null;

    $this->_dirtyFields = [
      'tier_id' => true
    ];
    if (array_key_exists('billingPeriod', $values)) {
      $this->_dirtyFields['billing_period'] = true;
    }
    if (array_key_exists('idempotencyKey', $values)) {
      $this->_dirtyFields['idempotency_key'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'tier_id',
      'contents' => $this->tierId
    ];

    if ($this->billingPeriod !== null) {
      $parts[] = [
        'name' => 'billing_period',
        'contents' => $this->billingPeriod
      ];
    }

    if ($this->idempotencyKey !== null) {
      $parts[] = [
        'name' => 'idempotency_key',
        'contents' => $this->idempotencyKey
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->idempotencyKey, 'idempotency_key', maxLength: 255);
  }
}
