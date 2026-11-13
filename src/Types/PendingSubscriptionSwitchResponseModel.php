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
class PendingSubscriptionSwitchResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\PendingSubscriptionSwitchResponseModelKind>
   */
  #[JsonProperty('kind')]
  public ?string $kind;

  /**
   * @var value-of<\ElevenLabs\Types\PendingSubscriptionSwitchResponseModelNextTier>
   * The tier to change to.
   */
  #[JsonProperty('next_tier', required: true)]
  public string $nextTier;

  /**
   * @var value-of<\ElevenLabs\Types\BillingPeriod>
   */
  #[JsonProperty('next_billing_period', required: true)]
  public string $nextBillingPeriod;

  /**
   * The timestamp of the change.
   */
  #[JsonProperty('timestamp_seconds', required: true)]
  public int $timestampSeconds;

  /**
   * @param array{
   *   nextTier: value-of<\ElevenLabs\Types\PendingSubscriptionSwitchResponseModelNextTier>,
   *   nextBillingPeriod: value-of<\ElevenLabs\Types\BillingPeriod>,
   *   timestampSeconds: int,
   *   kind?: ?value-of<\ElevenLabs\Types\PendingSubscriptionSwitchResponseModelKind>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->kind = $values['kind'] ?? 'change';
    $this->nextTier = $values['nextTier'];
    $this->nextBillingPeriod = $values['nextBillingPeriod'];
    $this->timestampSeconds = $values['timestampSeconds'];

    $this->_dirtyFields = [
      'next_tier' => true,
      'next_billing_period' => true,
      'timestamp_seconds' => true
    ];
    if (array_key_exists('kind', $values)) {
      $this->_dirtyFields['kind'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->kind !== null) {
      $parts[] = [
        'name' => 'kind',
        'contents' => $this->kind
      ];
    }

    $parts[] = [
      'name' => 'next_tier',
      'contents' => $this->nextTier
    ];

    $parts[] = [
      'name' => 'next_billing_period',
      'contents' => $this->nextBillingPeriod
    ];

    $parts[] = [
      'name' => 'timestamp_seconds',
      'contents' => (string) $this->timestampSeconds
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
