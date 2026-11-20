<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * A standalone add-on that can be tacked onto a service or rental booking.
 *
 * An add-on is a small, free-form extra (e.g. "Hot towel", "Valet parking")
 * that extends the parent booking's duration and total price without
 * creating a separate calendar event.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ReceptionAddOn extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Stable identifier used by booking requests and calendar snapshots. Survives name/price edits, so rebooking and reporting stay consistent.
   */
  #[JsonProperty('id')]
  public ?string $id;

  #[JsonProperty('name', required: true)]
  public string $name;

  #[JsonProperty('description')]
  public ?string $description;

  /**
   * Minutes added to the parent booking when this add-on is selected.
   */
  #[JsonProperty('add_duration_minutes')]
  public ?int $addDurationMinutes;

  /**
   * Amount added to the parent booking's total when this add-on is selected.
   */
  #[JsonProperty('add_price')]
  public ?float $addPrice;

  /**
   * @param array{
   *   name: string,
   *   id?: ?string,
   *   description?: ?string,
   *   addDurationMinutes?: ?int,
   *   addPrice?: ?float,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->id = $values['id'] ?? null;
    $this->name = $values['name'];
    $this->description = $values['description'] ?? null;
    $this->addDurationMinutes = $values['addDurationMinutes'] ?? null;
    $this->addPrice = $values['addPrice'] ?? null;

    $this->_dirtyFields = [
      'name' => true
    ];
    if (array_key_exists('id', $values)) {
      $this->_dirtyFields['id'] = true;
    }
    if (array_key_exists('description', $values)) {
      $this->_dirtyFields['description'] = true;
    }
    if (array_key_exists('addDurationMinutes', $values)) {
      $this->_dirtyFields['add_duration_minutes'] = true;
    }
    if (array_key_exists('addPrice', $values)) {
      $this->_dirtyFields['add_price'] = true;
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

    if ($this->description !== null) {
      $parts[] = [
        'name' => 'description',
        'contents' => $this->description
      ];
    }

    if ($this->addDurationMinutes !== null) {
      $parts[] = [
        'name' => 'add_duration_minutes',
        'contents' => (string) $this->addDurationMinutes
      ];
    }

    if ($this->addPrice !== null) {
      $parts[] = [
        'name' => 'add_price',
        'contents' => (string) $this->addPrice
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateNumber(
      $this->addDurationMinutes,
      'add_duration_minutes',
      min: 0,
      max: 43200
    );
    Validator::validateNumber($this->addPrice, 'add_price', min: 0);
  }
}
