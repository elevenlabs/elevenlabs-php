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
class SipTrunkCredentialsRequestModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * SIP trunk username
   */
  #[JsonProperty('username', required: true)]
  public string $username;

  /**
   * SIP trunk password - if not specified, then remain unchanged
   */
  #[JsonProperty('password')]
  public ?string $password;

  /**
   * @param array{
   *   username: string,
   *   password?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->username = $values['username'];
    $this->password = $values['password'] ?? null;

    $this->_dirtyFields = [
      'username' => true
    ];
    if (array_key_exists('password', $values)) {
      $this->_dirtyFields['password'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'username',
      'contents' => $this->username
    ];

    if ($this->password !== null) {
      $parts[] = [
        'name' => 'password',
        'contents' => $this->password
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
