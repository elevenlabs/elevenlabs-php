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
class ListAuthConnectionsResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\ListAuthConnectionsResponseAuthConnectionsItem[]
   */
  #[
    JsonProperty('auth_connections', required: true),
    ArrayType([\ElevenLabs\Types\ListAuthConnectionsResponseAuthConnectionsItem::class])
  ]
  public array $authConnections;

  /**
   * @param array{
   *   authConnections: \ElevenLabs\Types\ListAuthConnectionsResponseAuthConnectionsItem[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->authConnections = $values['authConnections'];

    $this->_dirtyFields = [
      'auth_connections' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'auth_connections',
      'contents' => json_encode($this->authConnections),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
