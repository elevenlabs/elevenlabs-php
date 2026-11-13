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
class EnvironmentVariableAuthConnectionValueRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('auth_connection_id', required: true)]
  public string $authConnectionId;

  /**
   * @param array{
   *   authConnectionId: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->authConnectionId = $values['authConnectionId'];

    $this->_dirtyFields = [
      'auth_connection_id' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'auth_connection_id',
      'contents' => $this->authConnectionId
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
