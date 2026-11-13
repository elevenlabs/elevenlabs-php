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
class RemoveOrderItemResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Whether the item was successfully removed.
   */
  #[JsonProperty('success', required: true)]
  public bool $success;

  /**
   * @param array{
   *   success: bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->success = $values['success'];

    $this->_dirtyFields = [
      'success' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'success',
      'contents' => $this->success ? 'true' : 'false'
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
