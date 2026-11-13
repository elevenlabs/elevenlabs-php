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
class GetLiveCountResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The number of active ongoing conversations.
   */
  #[JsonProperty('count', required: true)]
  public int $count;

  /**
   * @param array{
   *   count: int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->count = $values['count'];

    $this->_dirtyFields = [
      'count' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'count',
      'contents' => (string) $this->count
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
