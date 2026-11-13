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
class FeatureStatusCommonModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('enabled')]
  public ?bool $enabled;

  #[JsonProperty('used')]
  public ?bool $used;

  /**
   * @param array{
   *   enabled?: ?bool,
   *   used?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->enabled = $values['enabled'] ?? null;
    $this->used = $values['used'] ?? null;

    if (array_key_exists('enabled', $values)) {
      $this->_dirtyFields['enabled'] = true;
    }
    if (array_key_exists('used', $values)) {
      $this->_dirtyFields['used'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->enabled !== null) {
      $parts[] = [
        'name' => 'enabled',
        'contents' => $this->enabled ? 'true' : 'false'
      ];
    }

    if ($this->used !== null) {
      $parts[] = [
        'name' => 'used',
        'contents' => $this->used ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
