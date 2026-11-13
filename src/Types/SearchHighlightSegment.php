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
class SearchHighlightSegment extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('value', required: true)]
  public string $value;

  #[JsonProperty('is_hit', required: true)]
  public bool $isHit;

  /**
   * @param array{
   *   value: string,
   *   isHit: bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->value = $values['value'];
    $this->isHit = $values['isHit'];

    $this->_dirtyFields = [
      'value' => true,
      'is_hit' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'value',
      'contents' => $this->value
    ];

    $parts[] = [
      'name' => 'is_hit',
      'contents' => $this->isHit ? 'true' : 'false'
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
