<?php

declare(strict_types=1);

namespace ElevenLabs\Reception\Products\Requests;

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
class ReceptionCreateProductRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The customer workspace a reseller's API key acts on.
   */
  public string $xiWorkspaceId;

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
   * @var \ElevenLabs\Types\ReceptionIntakeQuestion[]|null
   * Questions the agent asks before booking or ordering this item. Required for a useful `pricing_mode='quote'` item -- without them a quote request arrives with nothing to price -- but also valid on fixed-price items that need extra detail (current hair color before a dye job, allergies before a treatment).
   */
  #[JsonProperty('intake_questions'), ArrayType([\ElevenLabs\Types\ReceptionIntakeQuestion::class])]
  public ?array $intakeQuestions;

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
   * False hides the product without deleting it.
   */
  #[JsonProperty('is_active')]
  public ?bool $isActive;

  /**
   * False keeps the product listed (callers can ask about it) but not orderable.
   */
  #[JsonProperty('orderable')]
  public ?bool $orderable;

  /**
   * @var array<value-of<\ElevenLabs\Types\OrderFulfillmentType>>|null
   * Fulfillment options customers may choose when ordering this product.
   */
  #[JsonProperty('allowed_fulfillment_types'), ArrayType(['string'])]
  public ?array $allowedFulfillmentTypes;

  /**
   * @var string[]|null
   * Locations where this product is sold; empty list means all locations.
   */
  #[JsonProperty('location_ids'), ArrayType(['string'])]
  public ?array $locationIds;

  /**
   * Whether this product is counted. A counted product starts with nothing on hand at every location.
   */
  #[JsonProperty('track_quantity')]
  public ?bool $trackQuantity;

  /**
   * @param array{
   *   xiWorkspaceId: string,
   *   name: string,
   *   pricingMode?: ?value-of<\ElevenLabs\Types\PricingMode>,
   *   intakeQuestions?: \ElevenLabs\Types\ReceptionIntakeQuestion[]|null,
   *   groups?: \ElevenLabs\Types\ReceptionGroupMembership[]|null,
   *   ungroupedRank?: ?int,
   *   description?: ?string,
   *   price?: ?float,
   *   isActive?: ?bool,
   *   orderable?: ?bool,
   *   allowedFulfillmentTypes?: array<value-of<\ElevenLabs\Types\OrderFulfillmentType>>|null,
   *   locationIds?: string[]|null,
   *   trackQuantity?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->xiWorkspaceId = $values['xiWorkspaceId'];
    $this->pricingMode = $values['pricingMode'] ?? null;
    $this->intakeQuestions = $values['intakeQuestions'] ?? null;
    $this->groups = $values['groups'] ?? null;
    $this->ungroupedRank = $values['ungroupedRank'] ?? null;
    $this->name = $values['name'];
    $this->description = $values['description'] ?? null;
    $this->price = $values['price'] ?? null;
    $this->isActive = $values['isActive'] ?? null;
    $this->orderable = $values['orderable'] ?? null;
    $this->allowedFulfillmentTypes = $values['allowedFulfillmentTypes'] ?? null;
    $this->locationIds = $values['locationIds'] ?? null;
    $this->trackQuantity = $values['trackQuantity'] ?? null;

    $this->_dirtyFields = [
      'name' => true
    ];
    if (array_key_exists('pricingMode', $values)) {
      $this->_dirtyFields['pricing_mode'] = true;
    }
    if (array_key_exists('intakeQuestions', $values)) {
      $this->_dirtyFields['intake_questions'] = true;
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
    if (array_key_exists('isActive', $values)) {
      $this->_dirtyFields['is_active'] = true;
    }
    if (array_key_exists('orderable', $values)) {
      $this->_dirtyFields['orderable'] = true;
    }
    if (array_key_exists('allowedFulfillmentTypes', $values)) {
      $this->_dirtyFields['allowed_fulfillment_types'] = true;
    }
    if (array_key_exists('locationIds', $values)) {
      $this->_dirtyFields['location_ids'] = true;
    }
    if (array_key_exists('trackQuantity', $values)) {
      $this->_dirtyFields['track_quantity'] = true;
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

    if ($this->intakeQuestions !== null) {
      $parts[] = [
        'name' => 'intake_questions',
        'contents' => json_encode($this->intakeQuestions),
        'headers' => ['Content-Type' => 'application/json']
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

    if ($this->isActive !== null) {
      $parts[] = [
        'name' => 'is_active',
        'contents' => $this->isActive ? 'true' : 'false'
      ];
    }

    if ($this->orderable !== null) {
      $parts[] = [
        'name' => 'orderable',
        'contents' => $this->orderable ? 'true' : 'false'
      ];
    }

    if ($this->allowedFulfillmentTypes !== null) {
      foreach ($this->allowedFulfillmentTypes ?? [] as $item) {
        $parts[] = [
          'name' => 'allowed_fulfillment_types',
          'contents' => $item
        ];
      }
    }

    if ($this->locationIds !== null) {
      foreach ($this->locationIds ?? [] as $item) {
        $parts[] = [
          'name' => 'location_ids',
          'contents' => $item
        ];
      }
    }

    if ($this->trackQuantity !== null) {
      $parts[] = [
        'name' => 'track_quantity',
        'contents' => $this->trackQuantity ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->intakeQuestions ?? [] as $item) {
      $item->validate();
    }
    Validator::validateArray($this->intakeQuestions, 'intake_questions', maxItems: 10);
    foreach ($this->groups ?? [] as $item) {
      $item->validate();
    }
    Validator::validateArray($this->groups, 'groups', maxItems: 20);
    Validator::validateNumber($this->ungroupedRank, 'ungrouped_rank', min: 0);
    Validator::validateNumber($this->price, 'price', min: 0);
  }
}
