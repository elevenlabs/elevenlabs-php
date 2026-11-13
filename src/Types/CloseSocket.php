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
class CloseSocket extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('close_socket')]
  public ?bool $closeSocket;

  /**
   * @param array{
   *   closeSocket?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->closeSocket = $values['closeSocket'] ?? null;

    if (array_key_exists('closeSocket', $values)) {
      $this->_dirtyFields['close_socket'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->closeSocket !== null) {
      $parts[] = [
        'name' => 'close_socket',
        'contents' => $this->closeSocket ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
