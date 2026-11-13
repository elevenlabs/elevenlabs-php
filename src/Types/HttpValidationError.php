<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class HttpValidationError extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\ValidationError[]|null
   */
  #[JsonProperty('detail'), ArrayType([\ElevenLabs\Types\ValidationError::class])]
  public ?array $detail;

  /**
   * @param array{
   *   detail?: \ElevenLabs\Types\ValidationError[]|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->detail = $values['detail'] ?? null;

    if (array_key_exists('detail', $values)) {
      $this->_dirtyFields['detail'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->detail !== null) {
      $parts[] = [
        'name' => 'detail',
        'contents' => json_encode($this->detail),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->detail ?? [] as $item) {
      $item->validate();
    }
  }
}
