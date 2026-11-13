<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * Device information.
 *
 * Spec: https://schema.ocsf.io/1.6.0/objects/device
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class DeviceModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * IP address
   */
  #[JsonProperty('ip')]
  public ?string $ip;

  /**
   * Device hostname
   */
  #[JsonProperty('hostname')]
  public ?string $hostname;

  /**
   * Device type ID (99 = Unknown)
   */
  #[JsonProperty('type_id')]
  public ?int $typeId;

  /**
   * @param array{
   *   ip?: ?string,
   *   hostname?: ?string,
   *   typeId?: ?int,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->ip = $values['ip'] ?? null;
    $this->hostname = $values['hostname'] ?? null;
    $this->typeId = $values['typeId'] ?? null;

    if (array_key_exists('ip', $values)) {
      $this->_dirtyFields['ip'] = true;
    }
    if (array_key_exists('hostname', $values)) {
      $this->_dirtyFields['hostname'] = true;
    }
    if (array_key_exists('typeId', $values)) {
      $this->_dirtyFields['type_id'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->ip !== null) {
      $parts[] = [
        'name' => 'ip',
        'contents' => $this->ip
      ];
    }

    if ($this->hostname !== null) {
      $parts[] = [
        'name' => 'hostname',
        'contents' => $this->hostname
      ];
    }

    if ($this->typeId !== null) {
      $parts[] = [
        'name' => 'type_id',
        'contents' => (string) $this->typeId
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
