<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ProvisionResellerWorkspaceSubscription extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('tier_id', required: true)]
  public string $tierId;

  /**
   * @var ?value-of<\ElevenLabs\Types\ProvisionResellerWorkspaceSubscriptionBillingPeriod>
   */
  #[JsonProperty('billing_period')]
  public ?string $billingPeriod;

  /**
   * @param array{
   *   tierId: string,
   *   billingPeriod?: ?value-of<\ElevenLabs\Types\ProvisionResellerWorkspaceSubscriptionBillingPeriod>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->tierId = $values['tierId'];
    $this->billingPeriod = $values['billingPeriod'] ?? null;

    $this->_dirtyFields = [
      'tier_id' => true
    ];
    if (array_key_exists('billingPeriod', $values)) {
      $this->_dirtyFields['billing_period'] = true;
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

    return $parts;
  }

  public function validate(): void
  {
  }
}
