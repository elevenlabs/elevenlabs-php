<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * Response model for oauth2 client creds
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class OAuth2ClientCredsResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * @var ?value-of<\ElevenLabs\Types\OAuth2ClientCredsResponseAuthType>
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

  #[JsonProperty('id', required: true)]
  public string $id;

  #[JsonProperty('used_by')]
  public ?\ElevenLabs\Types\AuthConnectionDependencies $usedBy;

  /**
   * @var ?value-of<\ElevenLabs\Types\AuthConnectionStatus>
   * Single status field shared by every auth type's stored credential.
   *
   * OAuth values (``REFRESH_FAILED``, ``REVOKED``) are written by the OAuth
   * token-manager refresh path. ``CREDENTIAL_INVALID`` is written by the
   * tool execution path when an upstream response matches a credential's
   * ``failure_signatures`` entry (Bearer, Basic auth, etc.).
   */
  #[JsonProperty('status')]
  public ?string $status;

  #[JsonProperty('status_detail')]
  public ?string $statusDetail;

  #[JsonProperty('status_updated_at')]
  public ?string $statusUpdatedAt;

  /**
   * @var array<string, string>|null
   * Custom headers configured for OAuth2 token requests
   */
  #[JsonProperty('custom_headers'), ArrayType(['string' => 'string'])]
  public ?array $customHeaders;

  /**
   * @param array{
   *   name: string,
   *   provider: string,
   *   clientId: string,
   *   tokenUrl: string,
   *   id: string,
   *   authType?: ?value-of<\ElevenLabs\Types\OAuth2ClientCredsResponseAuthType>,
   *   scopes?: string[]|null,
   *   extraParams?: array<string, string>|null,
   *   basicAuthInHeader?: ?bool,
   *   usedBy?: ?\ElevenLabs\Types\AuthConnectionDependencies,
   *   status?: ?value-of<\ElevenLabs\Types\AuthConnectionStatus>,
   *   statusDetail?: ?string,
   *   statusUpdatedAt?: ?string,
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
    $this->id = $values['id'];
    $this->usedBy = $values['usedBy'] ?? null;
    $this->status = $values['status'] ?? null;
    $this->statusDetail = $values['statusDetail'] ?? null;
    $this->statusUpdatedAt = $values['statusUpdatedAt'] ?? null;
    $this->customHeaders = $values['customHeaders'] ?? null;

    $this->_dirtyFields = [
      'name' => true,
      'provider' => true,
      'client_id' => true,
      'token_url' => true,
      'id' => true
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
    if (array_key_exists('usedBy', $values)) {
      $this->_dirtyFields['used_by'] = true;
    }
    if (array_key_exists('status', $values)) {
      $this->_dirtyFields['status'] = true;
    }
    if (array_key_exists('statusDetail', $values)) {
      $this->_dirtyFields['status_detail'] = true;
    }
    if (array_key_exists('statusUpdatedAt', $values)) {
      $this->_dirtyFields['status_updated_at'] = true;
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
      'name' => 'id',
      'contents' => $this->id
    ];

    if ($this->usedBy !== null) {
      $parts[] = [
        'name' => 'used_by',
        'contents' => json_encode($this->usedBy),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->status !== null) {
      $parts[] = [
        'name' => 'status',
        'contents' => $this->status
      ];
    }

    if ($this->statusDetail !== null) {
      $parts[] = [
        'name' => 'status_detail',
        'contents' => $this->statusDetail
      ];
    }

    if ($this->statusUpdatedAt !== null) {
      $parts[] = [
        'name' => 'status_updated_at',
        'contents' => $this->statusUpdatedAt
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
    $this->usedBy?->validate();
  }
}
