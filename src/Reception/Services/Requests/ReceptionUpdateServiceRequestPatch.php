<?php

declare(strict_types=1);

namespace ElevenLabs\Reception\Services\Requests;

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
class ReceptionUpdateServiceRequestPatch extends JsonSerializableType
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

  #[JsonProperty('name')]
  public ?string $name;

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
   * Not used to limit bookings; set `max_participants` on group services instead.
   */
  #[JsonProperty('capacity')]
  public ?int $capacity;

  /**
   * Whether the service is offered; inactive services can't be booked.
   */
  #[JsonProperty('is_active')]
  public ?bool $isActive;

  /**
   * Whether any staff member can deliver the service. When false, only the staff in `staff_ids` can. Ignored for rentals.
   */
  #[JsonProperty('any_staff_member')]
  public ?bool $anyStaffMember;

  /**
   * @var string[]|null
   * Staff assigned to this service; must be empty for kind='rental'.
   */
  #[JsonProperty('staff_ids'), ArrayType(['string'])]
  public ?array $staffIds;

  /**
   * @var string[]|null
   * Assets, such as rooms or equipment, this service can be booked on.
   */
  #[JsonProperty('asset_ids'), ArrayType(['string'])]
  public ?array $assetIds;

  /**
   * How far into the future customer-facing channels (public booking page, voice agent) may book this service. Applies to every kind.
   */
  #[JsonProperty('advance_booking_minutes')]
  public ?int $advanceBookingMinutes;

  /**
   * @var string[]|null
   * Locations where this service is offered; empty list means all locations.
   */
  #[JsonProperty('location_ids'), ArrayType(['string'])]
  public ?array $locationIds;

  /**
   * Whether the service is listed on the public booking page.
   */
  #[JsonProperty('display_on_booking_page')]
  public ?bool $displayOnBookingPage;

  /**
   * Travel time in minutes added before/after appointments for customer-location services. Blocks the staff member's calendar but is not visible to the customer. Ignored when `service_location='business'`.
   */
  #[JsonProperty('travel_minutes')]
  public ?int $travelMinutes;

  /**
   * Add travel time before the appointment (outbound trip).
   */
  #[JsonProperty('travel_before')]
  public ?bool $travelBefore;

  /**
   * Add travel time after the appointment (return trip).
   */
  #[JsonProperty('travel_after')]
  public ?bool $travelAfter;

  /**
   * @var \ElevenLabs\Types\ReceptionServicePromotion[]|null
   * Time-bound discounts applicable to this service or specific variants.
   */
  #[JsonProperty('promotions'), ArrayType([\ElevenLabs\Types\ReceptionServicePromotion::class])]
  public ?array $promotions;

  /**
   * Sets the first variant's duration. Ignored when `variants` is sent.
   */
  #[JsonProperty('duration_minutes')]
  public ?int $durationMinutes;

  /**
   * Sets the first variant's price. Ignored when `variants` is sent.
   */
  #[JsonProperty('price')]
  public ?float $price;

  /**
   * @param array{
   *   xiWorkspaceId: string,
   *   pricingMode?: ?value-of<\ElevenLabs\Types\PricingMode>,
   *   intakeQuestions?: \ElevenLabs\Types\ReceptionIntakeQuestion[]|null,
   *   groups?: \ElevenLabs\Types\ReceptionGroupMembership[]|null,
   *   ungroupedRank?: ?int,
   *   name?: ?string,
   *   description?: ?string,
   *   variants?: \ElevenLabs\Types\ReceptionServiceVariant[]|null,
   *   kind?: ?value-of<\ElevenLabs\Types\ReceptionServiceKind>,
   *   bufferMinutes?: ?int,
   *   serviceLocation?: ?value-of<\ElevenLabs\Types\ServiceLocationType>,
   *   addOns?: \ElevenLabs\Types\ReceptionAddOn[]|null,
   *   maxParticipants?: ?int,
   *   capacity?: ?int,
   *   isActive?: ?bool,
   *   anyStaffMember?: ?bool,
   *   staffIds?: string[]|null,
   *   assetIds?: string[]|null,
   *   advanceBookingMinutes?: ?int,
   *   locationIds?: string[]|null,
   *   displayOnBookingPage?: ?bool,
   *   travelMinutes?: ?int,
   *   travelBefore?: ?bool,
   *   travelAfter?: ?bool,
   *   promotions?: \ElevenLabs\Types\ReceptionServicePromotion[]|null,
   *   durationMinutes?: ?int,
   *   price?: ?float,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->xiWorkspaceId = $values['xiWorkspaceId'];
    $this->pricingMode = $values['pricingMode'] ?? null;
    $this->intakeQuestions = $values['intakeQuestions'] ?? null;
    $this->groups = $values['groups'] ?? null;
    $this->ungroupedRank = $values['ungroupedRank'] ?? null;
    $this->name = $values['name'] ?? null;
    $this->description = $values['description'] ?? null;
    $this->variants = $values['variants'] ?? null;
    $this->kind = $values['kind'] ?? null;
    $this->bufferMinutes = $values['bufferMinutes'] ?? null;
    $this->serviceLocation = $values['serviceLocation'] ?? null;
    $this->addOns = $values['addOns'] ?? null;
    $this->maxParticipants = $values['maxParticipants'] ?? null;
    $this->capacity = $values['capacity'] ?? null;
    $this->isActive = $values['isActive'] ?? null;
    $this->anyStaffMember = $values['anyStaffMember'] ?? null;
    $this->staffIds = $values['staffIds'] ?? null;
    $this->assetIds = $values['assetIds'] ?? null;
    $this->advanceBookingMinutes = $values['advanceBookingMinutes'] ?? null;
    $this->locationIds = $values['locationIds'] ?? null;
    $this->displayOnBookingPage = $values['displayOnBookingPage'] ?? null;
    $this->travelMinutes = $values['travelMinutes'] ?? null;
    $this->travelBefore = $values['travelBefore'] ?? null;
    $this->travelAfter = $values['travelAfter'] ?? null;
    $this->promotions = $values['promotions'] ?? null;
    $this->durationMinutes = $values['durationMinutes'] ?? null;
    $this->price = $values['price'] ?? null;

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
    if (array_key_exists('name', $values)) {
      $this->_dirtyFields['name'] = true;
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
    if (array_key_exists('capacity', $values)) {
      $this->_dirtyFields['capacity'] = true;
    }
    if (array_key_exists('isActive', $values)) {
      $this->_dirtyFields['is_active'] = true;
    }
    if (array_key_exists('anyStaffMember', $values)) {
      $this->_dirtyFields['any_staff_member'] = true;
    }
    if (array_key_exists('staffIds', $values)) {
      $this->_dirtyFields['staff_ids'] = true;
    }
    if (array_key_exists('assetIds', $values)) {
      $this->_dirtyFields['asset_ids'] = true;
    }
    if (array_key_exists('advanceBookingMinutes', $values)) {
      $this->_dirtyFields['advance_booking_minutes'] = true;
    }
    if (array_key_exists('locationIds', $values)) {
      $this->_dirtyFields['location_ids'] = true;
    }
    if (array_key_exists('displayOnBookingPage', $values)) {
      $this->_dirtyFields['display_on_booking_page'] = true;
    }
    if (array_key_exists('travelMinutes', $values)) {
      $this->_dirtyFields['travel_minutes'] = true;
    }
    if (array_key_exists('travelBefore', $values)) {
      $this->_dirtyFields['travel_before'] = true;
    }
    if (array_key_exists('travelAfter', $values)) {
      $this->_dirtyFields['travel_after'] = true;
    }
    if (array_key_exists('promotions', $values)) {
      $this->_dirtyFields['promotions'] = true;
    }
    if (array_key_exists('durationMinutes', $values)) {
      $this->_dirtyFields['duration_minutes'] = true;
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

    if ($this->name !== null) {
      $parts[] = [
        'name' => 'name',
        'contents' => $this->name
      ];
    }

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

    if ($this->capacity !== null) {
      $parts[] = [
        'name' => 'capacity',
        'contents' => (string) $this->capacity
      ];
    }

    if ($this->isActive !== null) {
      $parts[] = [
        'name' => 'is_active',
        'contents' => $this->isActive ? 'true' : 'false'
      ];
    }

    if ($this->anyStaffMember !== null) {
      $parts[] = [
        'name' => 'any_staff_member',
        'contents' => $this->anyStaffMember ? 'true' : 'false'
      ];
    }

    if ($this->staffIds !== null) {
      foreach ($this->staffIds ?? [] as $item) {
        $parts[] = [
          'name' => 'staff_ids',
          'contents' => $item
        ];
      }
    }

    if ($this->assetIds !== null) {
      foreach ($this->assetIds ?? [] as $item) {
        $parts[] = [
          'name' => 'asset_ids',
          'contents' => $item
        ];
      }
    }

    if ($this->advanceBookingMinutes !== null) {
      $parts[] = [
        'name' => 'advance_booking_minutes',
        'contents' => (string) $this->advanceBookingMinutes
      ];
    }

    if ($this->locationIds !== null) {
      foreach ($this->locationIds ?? [] as $item) {
        $parts[] = [
          'name' => 'location_ids',
          'contents' => $item
        ];
      }
    }

    if ($this->displayOnBookingPage !== null) {
      $parts[] = [
        'name' => 'display_on_booking_page',
        'contents' => $this->displayOnBookingPage ? 'true' : 'false'
      ];
    }

    if ($this->travelMinutes !== null) {
      $parts[] = [
        'name' => 'travel_minutes',
        'contents' => (string) $this->travelMinutes
      ];
    }

    if ($this->travelBefore !== null) {
      $parts[] = [
        'name' => 'travel_before',
        'contents' => $this->travelBefore ? 'true' : 'false'
      ];
    }

    if ($this->travelAfter !== null) {
      $parts[] = [
        'name' => 'travel_after',
        'contents' => $this->travelAfter ? 'true' : 'false'
      ];
    }

    if ($this->promotions !== null) {
      $parts[] = [
        'name' => 'promotions',
        'contents' => json_encode($this->promotions),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->durationMinutes !== null) {
      $parts[] = [
        'name' => 'duration_minutes',
        'contents' => (string) $this->durationMinutes
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
    foreach ($this->intakeQuestions ?? [] as $item) {
      $item->validate();
    }
    foreach ($this->groups ?? [] as $item) {
      $item->validate();
    }
    foreach ($this->variants ?? [] as $item) {
      $item->validate();
    }
    foreach ($this->addOns ?? [] as $item) {
      $item->validate();
    }
    Validator::validateNumber($this->maxParticipants, 'max_participants', min: 2, max: 200);
    foreach ($this->promotions ?? [] as $item) {
      $item->validate();
    }
    Validator::validateNumber($this->durationMinutes, 'duration_minutes', max: 43200);
    Validator::validateNumber($this->price, 'price', min: 0);
  }
}
