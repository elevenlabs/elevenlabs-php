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
class SingleUseTokenResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * A time bound single use token that expires after 15 minutes. Will be consumed on use.
   */
  #[JsonProperty('token', required: true)]
  public string $token;

  /**
   * @param array{
   *   token: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->token = $values['token'];

    $this->_dirtyFields = [
      'token' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'token',
      'contents' => $this->token
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
