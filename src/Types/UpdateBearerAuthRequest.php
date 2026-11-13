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
class UpdateBearerAuthRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\UpdateBearerAuthRequestAuthType>
   */
  #[JsonProperty('auth_type')]
  public ?string $authType;

  #[JsonProperty('provider')]
  public ?string $provider;

  #[JsonProperty('token')]
  public ?string $token;

  /**
   * @param array{
   *   authType?: ?value-of<\ElevenLabs\Types\UpdateBearerAuthRequestAuthType>,
   *   provider?: ?string,
   *   token?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->authType = $values['authType'] ?? 'bearer_auth';
    $this->provider = $values['provider'] ?? null;
    $this->token = $values['token'] ?? null;

    if (array_key_exists('authType', $values)) {
      $this->_dirtyFields['auth_type'] = true;
    }
    if (array_key_exists('provider', $values)) {
      $this->_dirtyFields['provider'] = true;
    }
    if (array_key_exists('token', $values)) {
      $this->_dirtyFields['token'] = true;
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

    if ($this->token !== null) {
      $parts[] = [
        'name' => 'token',
        'contents' => $this->token
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
