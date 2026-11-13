<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * Request model for creating auth connections - inherits common settings and includes sensitive fields
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class CreateOAuth2ClientCredsRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * @var ?value-of<\ElevenLabs\Types\CreateOAuth2ClientCredsRequestAuthType>
   */
  #[JsonProperty('auth_type')]
  public ?string $authType;

  #[JsonProperty('provider', required: true)]
  public string $provider;

  #[JsonProperty('client_id', required: true)]
  public string $clientId;

  #[JsonProperty('token_url', required: true)]
  public string $tokenUrl;

  /**
   * @var string[]|null
   */
  #[JsonProperty('scopes'), ArrayType(['string'])]
  public ?array $scopes;

  /**
   * @var array<string, string>|null
   */
  #[JsonProperty('extra_params'), ArrayType(['string' => 'string'])]
  public ?array $extraParams;

  /**
   * If True, send client credentials in Authorization header as Basic Auth instead of request body
   */
  #[JsonProperty('basic_auth_in_header')]
  public ?bool $basicAuthInHeader;

  #[JsonProperty('client_secret', required: true)]
  public string $clientSecret;

  /**
   * @var array<string, string>|null
   */
  #[JsonProperty('custom_headers'), ArrayType(['string' => 'string'])]
  public ?array $customHeaders;

  /**
   * @param array{
   *   name: string,
   *   provider: string,
   *   clientId: string,
   *   tokenUrl: string,
   *   clientSecret: string,
   *   authType?: ?value-of<\ElevenLabs\Types\CreateOAuth2ClientCredsRequestAuthType>,
   *   scopes?: string[]|null,
   *   extraParams?: array<string, string>|null,
   *   basicAuthInHeader?: ?bool,
   *   customHeaders?: array<string, string>|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->name = $values['name'];
    $this->authType = $values['authType'] ?? 'oauth2_client_credentials';
    $this->provider = $values['provider'];
    $this->clientId = $values['clientId'];
    $this->tokenUrl = $values['tokenUrl'];
    $this->scopes = $values['scopes'] ?? null;
    $this->extraParams = $values['extraParams'] ?? null;
    $this->basicAuthInHeader = $values['basicAuthInHeader'] ?? null;
    $this->clientSecret = $values['clientSecret'];
    $this->customHeaders = $values['customHeaders'] ?? null;

    $this->_dirtyFields = [
      'name' => true,
      'provider' => true,
      'client_id' => true,
      'token_url' => true,
      'client_secret' => true
    ];
    if (array_key_exists('authType', $values)) {
      $this->_dirtyFields['auth_type'] = true;
    }
    if (array_key_exists('scopes', $values)) {
      $this->_dirtyFields['scopes'] = true;
    }
    if (array_key_exists('extraParams', $values)) {
      $this->_dirtyFields['extra_params'] = true;
    }
    if (array_key_exists('basicAuthInHeader', $values)) {
      $this->_dirtyFields['basic_auth_in_header'] = true;
    }
    if (array_key_exists('customHeaders', $values)) {
      $this->_dirtyFields['custom_headers'] = true;
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
      'name' => 'client_id',
      'contents' => $this->clientId
    ];

    $parts[] = [
      'name' => 'token_url',
      'contents' => $this->tokenUrl
    ];

    if ($this->scopes !== null) {
      foreach ($this->scopes ?? [] as $item) {
        $parts[] = [
          'name' => 'scopes',
          'contents' => $item
        ];
      }
    }

    if ($this->extraParams !== null) {
      $parts[] = [
        'name' => 'extra_params',
        'contents' => json_encode($this->extraParams),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->basicAuthInHeader !== null) {
      $parts[] = [
        'name' => 'basic_auth_in_header',
        'contents' => $this->basicAuthInHeader ? 'true' : 'false'
      ];
    }

    $parts[] = [
      'name' => 'client_secret',
      'contents' => $this->clientSecret
    ];

    if ($this->customHeaders !== null) {
      $parts[] = [
        'name' => 'custom_headers',
        'contents' => json_encode($this->customHeaders),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
