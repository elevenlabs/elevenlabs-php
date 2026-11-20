<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * A variant of a service identified by its duration, with optional price override.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ReceptionServiceVariant extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Stable ID of this option; keep it when editing so bookings and promotions still match.
   */
  #[JsonProperty('id')]
  public ?string $id;

  /**
   * How long this option takes, in minutes.
   */
  #[JsonProperty('duration_minutes', required: true)]
  public int $durationMinutes;

  /**
   * Price of this option in the workspace's currency; null means no listed price.
   */
  #[JsonProperty('price')]
  public ?float $price;

  /**
   * Whether customers can book this option.
   */
  #[JsonProperty('is_active')]
  public ?bool $isActive;

  /**
   * @param array{
   *   durationMinutes: int,
   *   id?: ?string,
   *   price?: ?float,
   *   isActive?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->id = $values['id'] ?? null;
    $this->durationMinutes = $values['durationMinutes'];
    $this->price = $values['price'] ?? null;
    $this->isActive = $values['isActive'] ?? null;

    $this->_dirtyFields = [
      'duration_minutes' => true
    ];
    if (array_key_exists('id', $values)) {
      $this->_dirtyFields['id'] = true;
    }
    if (array_key_exists('price', $values)) {
      $this->_dirtyFields['price'] = true;
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
      'name' => 'duration_minutes',
      'contents' => (string) $this->durationMinutes
    ];

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

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateNumber($this->durationMinutes, 'duration_minutes', max: 43200);
    Validator::validateNumber($this->price, 'price', min: 0);
  }
}
