<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * Request model for creating Basic Auth connections - inherits common settings and includes sensitive fields
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class CreateBasicAuthRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * @var ?value-of<\ElevenLabs\Types\CreateBasicAuthRequestAuthType>
   */
  #[JsonProperty('auth_type')]
  public ?string $authType;

  #[JsonProperty('provider', required: true)]
  public string $provider;

  #[JsonProperty('username', required: true)]
  public string $username;

  #[JsonProperty('password', required: true)]
  public string $password;

  /**
   * @param array{
   *   name: string,
   *   provider: string,
   *   username: string,
   *   password: string,
   *   authType?: ?value-of<\ElevenLabs\Types\CreateBasicAuthRequestAuthType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->name = $values['name'];
    $this->authType = $values['authType'] ?? 'basic_auth';
    $this->provider = $values['provider'];
    $this->username = $values['username'];
    $this->password = $values['password'];

    $this->_dirtyFields = [
      'name' => true,
      'provider' => true,
      'username' => true,
      'password' => true
    ];
    if (array_key_exists('authType', $values)) {
      $this->_dirtyFields['auth_type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    if ($this->authType !== null) {
      $parts[] = [
        'name' => 'auth_type',
        'contents' => $this->authType
      ];
    }

    $parts[] = [
      'name' => 'provider',
      'contents' => $this->provider
    ];

    $parts[] = [
      'name' => 'username',
      'contents' => $this->username
    ];

    $parts[] = [
      'name' => 'password',
      'contents' => $this->password
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
