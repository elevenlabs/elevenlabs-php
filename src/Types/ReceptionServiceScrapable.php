<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * Scrape-reachable subset of a service (classic, rental or group).
 *
 * The extraction pipeline uses one LLM prompt per kind (so the model sees
 * kind-specific guidance), but every code path produces this single shape:
 * onboarding, imports and the unified ``smb_services`` collection all
 * discriminate by the ``kind`` field.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ReceptionServiceScrapable extends JsonSerializableType
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
   * @var \ElevenLabs\Types\ReceptionServiceVariant[]|null
   * Bookable options for this service. Always non-empty; `variants[0]` is the default option shown when callers don't pick a specific variant. Each entry has its own duration and (optional) price, and uniqueness is keyed by duration.
   */
  #[JsonProperty('variants'), ArrayType([\ElevenLabs\Types\ReceptionServiceVariant::class])]
  public ?array $variants;

  /**
   * @var ?value-of<\ElevenLabs\Types\ReceptionServiceKind>
   * What a service books.
   *
   * - `classic`: a staff-delivered service (haircut, consultation, massage, ...).
   * - `rental`: an asset reservation (court, room, equipment).
   * - `group`: seats in a multi-participant session (class, workshop, tour).
   */
  #[JsonProperty('kind')]
  public ?string $kind;

  /**
   * Turnover/cleanup time reserved after each booking. Applies to every service kind; default 0 means no buffer.
   */
  #[JsonProperty('buffer_minutes')]
  public ?int $bufferMinutes;

  /**
   * @var ?value-of<\ElevenLabs\Types\ServiceLocationType>
   * Where a classic service is delivered.
   */
  #[JsonProperty('service_location')]
  public ?string $serviceLocation;

  /**
   * @var \ElevenLabs\Types\ReceptionAddOn[]|null
   * Optional extras that can be added to a booking of this service.
   */
  #[JsonProperty('add_ons'), ArrayType([\ElevenLabs\Types\ReceptionAddOn::class])]
  public ?array $addOns;

  /**
   * Capacity for `kind='group'`: how many seats a single session can sell across all registrations. Must be null for classic and rental services (those are always exclusive to one client per booking).
   */
  #[JsonProperty('max_participants')]
  public ?int $maxParticipants;

  /**
   * @param array{
   *   name: string,
   *   pricingMode?: ?value-of<\ElevenLabs\Types\PricingMode>,
   *   groups?: \ElevenLabs\Types\ReceptionGroupMembership[]|null,
   *   ungroupedRank?: ?int,
   *   description?: ?string,
   *   variants?: \ElevenLabs\Types\ReceptionServiceVariant[]|null,
   *   kind?: ?value-of<\ElevenLabs\Types\ReceptionServiceKind>,
   *   bufferMinutes?: ?int,
   *   serviceLocation?: ?value-of<\ElevenLabs\Types\ServiceLocationType>,
   *   addOns?: \ElevenLabs\Types\ReceptionAddOn[]|null,
   *   maxParticipants?: ?int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->pricingMode = $values['pricingMode'] ?? null;
    $this->groups = $values['groups'] ?? null;
    $this->ungroupedRank = $values['ungroupedRank'] ?? null;
    $this->name = $values['name'];
    $this->description = $values['description'] ?? null;
    $this->variants = $values['variants'] ?? null;
    $this->kind = $values['kind'] ?? null;
    $this->bufferMinutes = $values['bufferMinutes'] ?? null;
    $this->serviceLocation = $values['serviceLocation'] ?? null;
    $this->addOns = $values['addOns'] ?? null;
    $this->maxParticipants = $values['maxParticipants'] ?? null;

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
    if (array_key_exists('variants', $values)) {
      $this->_dirtyFields['variants'] = true;
    }
    if (array_key_exists('kind', $values)) {
      $this->_dirtyFields['kind'] = true;
    }
    if (array_key_exists('bufferMinutes', $values)) {
      $this->_dirtyFields['buffer_minutes'] = true;
    }
    if (array_key_exists('serviceLocation', $values)) {
      $this->_dirtyFields['service_location'] = true;
    }
    if (array_key_exists('addOns', $values)) {
      $this->_dirtyFields['add_ons'] = true;
    }
    if (array_key_exists('maxParticipants', $values)) {
      $this->_dirtyFields['max_participants'] = true;
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

    if ($this->variants !== null) {
      $parts[] = [
        'name' => 'variants',
        'contents' => json_encode($this->variants),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->kind !== null) {
      $parts[] = [
        'name' => 'kind',
        'contents' => $this->kind
      ];
    }

    if ($this->bufferMinutes !== null) {
      $parts[] = [
        'name' => 'buffer_minutes',
        'contents' => (string) $this->bufferMinutes
      ];
    }

    if ($this->serviceLocation !== null) {
      $parts[] = [
        'name' => 'service_location',
        'contents' => $this->serviceLocation
      ];
    }

    if ($this->addOns !== null) {
      $parts[] = [
        'name' => 'add_ons',
        'contents' => json_encode($this->addOns),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->maxParticipants !== null) {
      $parts[] = [
        'name' => 'max_participants',
        'contents' => (string) $this->maxParticipants
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
    foreach ($this->variants ?? [] as $item) {
      $item->validate();
    }
    Validator::validateArray($this->variants, 'variants', minItems: 1, maxItems: 20);
    Validator::validateNumber($this->bufferMinutes, 'buffer_minutes', min: 0, max: 1440);
    foreach ($this->addOns ?? [] as $item) {
      $item->validate();
    }
    Validator::validateArray($this->addOns, 'add_ons', maxItems: 10);
    Validator::validateNumber($this->maxParticipants, 'max_participants', min: 2, max: 200);
  }
}
