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
class UpdateOAuth2ClientCredsRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\UpdateOAuth2ClientCredsRequestAuthType>
   */
  #[JsonProperty('auth_type')]
  public ?string $authType;

  #[JsonProperty('provider')]
  public ?string $provider;

  #[JsonProperty('client_id')]
  public ?string $clientId;

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

  #[JsonProperty('basic_auth_in_header')]
  public ?bool $basicAuthInHeader;

  #[JsonProperty('client_secret')]
  public ?string $clientSecret;

  /**
   * @var array<string, string>|null
   */
  #[JsonProperty('custom_headers'), ArrayType(['string' => 'string'])]
  public ?array $customHeaders;

  /**
   * @param array{
   *   authType?: ?value-of<\ElevenLabs\Types\UpdateOAuth2ClientCredsRequestAuthType>,
   *   provider?: ?string,
   *   clientId?: ?string,
   *   scopes?: string[]|null,
   *   extraParams?: array<string, string>|null,
   *   basicAuthInHeader?: ?bool,
   *   clientSecret?: ?string,
   *   customHeaders?: array<string, string>|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->authType = $values['authType'] ?? 'oauth2_client_credentials';
    $this->provider = $values['provider'] ?? null;
    $this->clientId = $values['clientId'] ?? null;
    $this->scopes = $values['scopes'] ?? null;
    $this->extraParams = $values['extraParams'] ?? null;
    $this->basicAuthInHeader = $values['basicAuthInHeader'] ?? null;
    $this->clientSecret = $values['clientSecret'] ?? null;
    $this->customHeaders = $values['customHeaders'] ?? null;

    if (array_key_exists('authType', $values)) {
      $this->_dirtyFields['auth_type'] = true;
    }
    if (array_key_exists('provider', $values)) {
      $this->_dirtyFields['provider'] = true;
    }
    if (array_key_exists('clientId', $values)) {
      $this->_dirtyFields['client_id'] = true;
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
    if (array_key_exists('clientSecret', $values)) {
      $this->_dirtyFields['client_secret'] = true;
    }
    if (array_key_exists('customHeaders', $values)) {
      $this->_dirtyFields['custom_headers'] = true;
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

    if ($this->clientId !== null) {
      $parts[] = [
        'name' => 'client_id',
        'contents' => $this->clientId
      ];
    }

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

    if ($this->clientSecret !== null) {
      $parts[] = [
        'name' => 'client_secret',
        'contents' => $this->clientSecret
      ];
    }

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
