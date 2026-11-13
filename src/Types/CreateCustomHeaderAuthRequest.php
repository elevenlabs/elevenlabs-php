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
class CreateCustomHeaderAuthRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * @var ?value-of<\ElevenLabs\Types\CreateCustomHeaderAuthRequestAuthType>
   */
  #[JsonProperty('auth_type')]
  public ?string $authType;

  #[JsonProperty('provider', required: true)]
  public string $provider;

  /**
   * The name of the header to use for authentication (e.g., 'x-api-key')
   */
  #[JsonProperty('header_name', required: true)]
  public string $headerName;

  #[JsonProperty('token', required: true)]
  public string $token;

  /**
   * @param array{
   *   name: string,
   *   provider: string,
   *   headerName: string,
   *   token: string,
   *   authType?: ?value-of<\ElevenLabs\Types\CreateCustomHeaderAuthRequestAuthType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->name = $values['name'];
    $this->authType = $values['authType'] ?? 'custom_header_auth';
    $this->provider = $values['provider'];
    $this->headerName = $values['headerName'];
    $this->token = $values['token'];

    $this->_dirtyFields = [
      'name' => true,
      'provider' => true,
      'header_name' => true,
      'token' => true
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
      'name' => 'header_name',
      'contents' => $this->headerName
    ];

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
