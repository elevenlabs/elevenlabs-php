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
class UpdateBasicAuthRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\UpdateBasicAuthRequestAuthType>
   */
  #[JsonProperty('auth_type')]
  public ?string $authType;

  #[JsonProperty('provider')]
  public ?string $provider;

  #[JsonProperty('username')]
  public ?string $username;

  #[JsonProperty('password')]
  public ?string $password;

  /**
   * @param array{
   *   authType?: ?value-of<\ElevenLabs\Types\UpdateBasicAuthRequestAuthType>,
   *   provider?: ?string,
   *   username?: ?string,
   *   password?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->authType = $values['authType'] ?? 'basic_auth';
    $this->provider = $values['provider'] ?? null;
    $this->username = $values['username'] ?? null;
    $this->password = $values['password'] ?? null;

    if (array_key_exists('authType', $values)) {
      $this->_dirtyFields['auth_type'] = true;
    }
    if (array_key_exists('provider', $values)) {
      $this->_dirtyFields['provider'] = true;
    }
    if (array_key_exists('username', $values)) {
      $this->_dirtyFields['username'] = true;
    }
    if (array_key_exists('password', $values)) {
      $this->_dirtyFields['password'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->authType !== null) {
      $parts[] = [
        'name' => 'auth_type',
        'contents' => $this->authType
      ];
    }

    if ($this->provider !== null) {
      $parts[] = [
        'name' => 'provider',
        'contents' => $this->provider
      ];
    }

    if ($this->username !== null) {
      $parts[] = [
        'name' => 'username',
        'contents' => $this->username
      ];
    }

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
