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
class ReceptionServiceUpdateResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The updated service, or null when the update was held back because it reprices existing bookings.
   */
  #[JsonProperty('service')]
  public ?\ElevenLabs\Types\ReceptionService $service;

  /**
   * True when the update changes the price of upcoming bookings and was not saved; send it again to the confirm-update endpoint to apply it.
   */
  #[JsonProperty('has_affected_events', required: true)]
  public bool $hasAffectedEvents;

  /**
   * @param array{
   *   hasAffectedEvents: bool,
   *   service?: ?\ElevenLabs\Types\ReceptionService,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->service = $values['service'] ?? null;
    $this->hasAffectedEvents = $values['hasAffectedEvents'];

    $this->_dirtyFields = [
      'has_affected_events' => true
    ];
    if (array_key_exists('service', $values)) {
      $this->_dirtyFields['service'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->service !== null) {
      $parts[] = [
        'name' => 'service',
        'contents' => json_encode($this->service),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    $parts[] = [
      'name' => 'has_affected_events',
      'contents' => $this->hasAffectedEvents ? 'true' : 'false'
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->service?->validate();
  }
}
