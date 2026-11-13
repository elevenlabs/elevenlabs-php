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
class FinalOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Indicates the generation is complete. When true, audio is null.
   */
  #[JsonProperty('is_final')]
  public ?bool $isFinal;

  /**
   * @param array{
   *   isFinal?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->isFinal = $values['isFinal'] ?? null;

    if (array_key_exists('isFinal', $values)) {
      $this->_dirtyFields['is_final'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->isFinal !== null) {
      $parts[] = [
        'name' => 'is_final',
        'contents' => $this->isFinal ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
