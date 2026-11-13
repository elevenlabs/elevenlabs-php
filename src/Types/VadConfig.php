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
class VadConfig extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var array<string, mixed>
   */
  public array $additionalProperties = [];

  public function toMultipart(): array
  {
    $parts = [];

    return $parts;
  }

  public function validate(): void
  {
  }
}
