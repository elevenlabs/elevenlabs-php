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
class GuardrailsResult extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('triggered')]
  public ?bool $triggered;

  /**
   * @param array{
   *   triggered?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->triggered = $values['triggered'] ?? null;

    if (array_key_exists('triggered', $values)) {
      $this->_dirtyFields['triggered'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->triggered !== null) {
      $parts[] = [
        'name' => 'triggered',
        'contents' => $this->triggered ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
