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
class AudioKeyMoment extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('timestamp_ms', required: true)]
  public int $timestampMs;

  #[JsonProperty('type', required: true)]
  public string $type;

  #[JsonProperty('description', required: true)]
  public string $description;

  /**
   * @param array{
   *   timestampMs: int,
   *   type: string,
   *   description: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->timestampMs = $values['timestampMs'];
    $this->type = $values['type'];
    $this->description = $values['description'];

    $this->_dirtyFields = [
      'timestamp_ms' => true,
      'type' => true,
      'description' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'timestamp_ms',
      'contents' => (string) $this->timestampMs
    ];

    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
    ];

    $parts[] = [
      'name' => 'description',
      'contents' => $this->description
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
