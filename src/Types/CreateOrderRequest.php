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
class CreateOrderRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * When true, creates a sandbox order that auto-progresses without producer intervention.
   */
  #[JsonProperty('sandbox')]
  public ?bool $sandbox;

  /**
   * @param array{
   *   sandbox?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->sandbox = $values['sandbox'] ?? null;

    if (array_key_exists('sandbox', $values)) {
      $this->_dirtyFields['sandbox'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->sandbox !== null) {
      $parts[] = [
        'name' => 'sandbox',
        'contents' => $this->sandbox ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
