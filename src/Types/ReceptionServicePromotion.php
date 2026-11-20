<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * A time-bound promotion on a service/variant or on add-ons.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ReceptionServicePromotion extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Stable ID of this promotion.
   */
  #[JsonProperty('id')]
  public ?string $id;

  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * @var ?value-of<\ElevenLabs\Types\PromotionTarget>
   * What a promotion discounts: the service price or add-on prices.
   */
  #[JsonProperty('target')]
  public ?string $target;

  /**
   * When set (target=service), the promotion applies only to this variant.
   */
  #[JsonProperty('variant_id')]
  public ?string $variantId;

  /**
   * When set (target=add_on), the promotion applies only to this add-on.
   */
  #[JsonProperty('add_on_id')]
  public ?string $addOnId;

  /**
   * The final price when this promotion is applied to a matching line item.
   */
  #[JsonProperty('promotional_price', required: true)]
  public float $promotionalPrice;

  /**
   * @var int[]|null
   * Days when the promotion is active (0=Monday, 6=Sunday); empty means every day.
   */
  #[JsonProperty('days_of_week'), ArrayType(['integer'])]
  public ?array $daysOfWeek;

  /**
   * First day the promotion applies, inclusive.
   */
  #[JsonProperty('start_date', required: true)]
  public string $startDate;

  /**
   * Last day the promotion applies, inclusive; on or after `start_date`.
   */
  #[JsonProperty('end_date', required: true)]
  public string $endDate;

  /**
   * Whether the promotion applies; inactive promotions are ignored.
   */
  #[JsonProperty('is_active')]
  public ?bool $isActive;

  /**
   * @param array{
   *   name: string,
   *   promotionalPrice: float,
   *   startDate: string,
   *   endDate: string,
   *   id?: ?string,
   *   target?: ?value-of<\ElevenLabs\Types\PromotionTarget>,
   *   variantId?: ?string,
   *   addOnId?: ?string,
   *   daysOfWeek?: int[]|null,
   *   isActive?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->id = $values['id'] ?? null;
    $this->name = $values['name'];
    $this->target = $values['target'] ?? null;
    $this->variantId = $values['variantId'] ?? null;
    $this->addOnId = $values['addOnId'] ?? null;
    $this->promotionalPrice = $values['promotionalPrice'];
    $this->daysOfWeek = $values['daysOfWeek'] ?? null;
    $this->startDate = $values['startDate'];
    $this->endDate = $values['endDate'];
    $this->isActive = $values['isActive'] ?? null;

    $this->_dirtyFields = [
      'name' => true,
      'promotional_price' => true,
      'start_date' => true,
      'end_date' => true
    ];
    if (array_key_exists('id', $values)) {
      $this->_dirtyFields['id'] = true;
    }
    if (array_key_exists('target', $values)) {
      $this->_dirtyFields['target'] = true;
    }
    if (array_key_exists('variantId', $values)) {
      $this->_dirtyFields['variant_id'] = true;
    }
    if (array_key_exists('addOnId', $values)) {
      $this->_dirtyFields['add_on_id'] = true;
    }
    if (array_key_exists('daysOfWeek', $values)) {
      $this->_dirtyFields['days_of_week'] = true;
    }
    if (array_key_exists('isActive', $values)) {
      $this->_dirtyFields['is_active'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->id !== null) {
      $parts[] = [
        'name' => 'id',
        'contents' => $this->id
      ];
    }

    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    if ($this->target !== null) {
      $parts[] = [
        'name' => 'target',
        'contents' => $this->target
      ];
    }

    if ($this->variantId !== null) {
      $parts[] = [
        'name' => 'variant_id',
        'contents' => $this->variantId
      ];
    }

    if ($this->addOnId !== null) {
      $parts[] = [
        'name' => 'add_on_id',
        'contents' => $this->addOnId
      ];
    }

    $parts[] = [
      'name' => 'promotional_price',
      'contents' => (string) $this->promotionalPrice
    ];

    if ($this->daysOfWeek !== null) {
      foreach ($this->daysOfWeek ?? [] as $item) {
        $parts[] = [
          'name' => 'days_of_week',
          'contents' => (string) $item
        ];
      }
    }

    $parts[] = [
      'name' => 'start_date',
      'contents' => $this->startDate
    ];

    $parts[] = [
      'name' => 'end_date',
      'contents' => $this->endDate
    ];

    if ($this->isActive !== null) {
      $parts[] = [
        'name' => 'is_active',
        'contents' => $this->isActive ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateNumber($this->promotionalPrice, 'promotional_price', min: 0);
  }
}
