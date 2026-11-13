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
class FocusGuardrail extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('is_enabled')]
  public ?bool $isEnabled;

  /**
   * @param array{
   *   isEnabled?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->isEnabled = $values['isEnabled'] ?? null;

    if (array_key_exists('isEnabled', $values)) {
      $this->_dirtyFields['is_enabled'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->isEnabled !== null) {
      $parts[] = [
        'name' => 'is_enabled',
        'contents' => $this->isEnabled ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
