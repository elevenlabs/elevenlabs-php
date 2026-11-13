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
class BinaryScoring extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\BinaryScoringMode>
   */
  #[JsonProperty('mode')]
  public ?string $mode;

  /**
   * @param array{
   *   mode?: ?value-of<\ElevenLabs\Types\BinaryScoringMode>,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->mode = $values['mode'] ?? 'binary';

    if (array_key_exists('mode', $values)) {
      $this->_dirtyFields['mode'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->mode !== null) {
      $parts[] = [
        'name' => 'mode',
        'contents' => $this->mode
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
