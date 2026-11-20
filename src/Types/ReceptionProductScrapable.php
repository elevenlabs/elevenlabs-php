<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * Scrape-reachable subset of a product (retail/catalog item).
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ReceptionProductScrapable extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\PricingMode>
   * Whether a catalog item's price and duration are known up front.
   *
   * - `fixed`: the catalog price and duration apply (the default).
   * - `quote`: neither is known until the owner has seen the job. The
   *   receptionist collects intake answers and files a quote request instead
   *   of booking a slot or taking an order.
   */
  #[JsonProperty('pricing_mode')]
  public ?string $pricingMode;

  /**
   * @var \ElevenLabs\Types\ReceptionGroupMembership[]|null
   * Group memberships for this item. Each entry carries the group label and the item's 0-based rank within that group.
   */
  #[JsonProperty('groups'), ArrayType([\ElevenLabs\Types\ReceptionGroupMembership::class])]
  public ?array $groups;

  /**
   * Display position among items with no group; `null` sorts last. Change it with the reorder endpoint.
   */
  #[JsonProperty('ungrouped_rank')]
  public ?int $ungroupedRank;

  #[JsonProperty('name', required: true)]
  public string $name;

  #[JsonProperty('description')]
  public ?string $description;

  /**
   * Price of the product; null for no listed price.
   */
  #[JsonProperty('price')]
  public ?float $price;

  /**
   * @param array{
   *   name: string,
   *   pricingMode?: ?value-of<\ElevenLabs\Types\PricingMode>,
   *   groups?: \ElevenLabs\Types\ReceptionGroupMembership[]|null,
   *   ungroupedRank?: ?int,
   *   description?: ?string,
   *   price?: ?float,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->pricingMode = $values['pricingMode'] ?? null;
    $this->groups = $values['groups'] ?? null;
    $this->ungroupedRank = $values['ungroupedRank'] ?? null;
    $this->name = $values['name'];
    $this->description = $values['description'] ?? null;
    $this->price = $values['price'] ?? null;

    $this->_dirtyFields = [
      'name' => true
    ];
    if (array_key_exists('pricingMode', $values)) {
      $this->_dirtyFields['pricing_mode'] = true;
    }
    if (array_key_exists('groups', $values)) {
      $this->_dirtyFields['groups'] = true;
    }
    if (array_key_exists('ungroupedRank', $values)) {
      $this->_dirtyFields['ungrouped_rank'] = true;
    }
    if (array_key_exists('description', $values)) {
      $this->_dirtyFields['description'] = true;
    }
    if (array_key_exists('price', $values)) {
      $this->_dirtyFields['price'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->pricingMode !== null) {
      $parts[] = [
        'name' => 'pricing_mode',
        'contents' => $this->pricingMode
      ];
    }

    if ($this->groups !== null) {
      $parts[] = [
        'name' => 'groups',
        'contents' => json_encode($this->groups),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->ungroupedRank !== null) {
      $parts[] = [
        'name' => 'ungrouped_rank',
        'contents' => (string) $this->ungroupedRank
      ];
    }

    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    if ($this->description !== null) {
      $parts[] = [
        'name' => 'description',
        'contents' => $this->description
      ];
    }

    if ($this->price !== null) {
      $parts[] = [
        'name' => 'price',
        'contents' => (string) $this->price
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->groups ?? [] as $item) {
      $item->validate();
    }
    Validator::validateArray($this->groups, 'groups', maxItems: 20);
    Validator::validateNumber($this->ungroupedRank, 'ungrouped_rank', min: 0);
    Validator::validateNumber($this->price, 'price', min: 0);
  }
}
