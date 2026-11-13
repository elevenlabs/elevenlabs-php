<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * Response model for user-owned OAuth2 Custom App auth connections
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ApiIntegrationOAuth2CustomAppResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * @var ?value-of<\ElevenLabs\Types\ApiIntegrationOAuth2CustomAppResponseAuthType>
   */
  #[JsonProperty('auth_type')]
  public ?string $authType;

  #[JsonProperty('provider', required: true)]
  public string $provider;

  #[JsonProperty('token_url', required: true)]
  public string $tokenUrl;

  /**
   * @var string[]|null
   */
  #[JsonProperty('scopes'), ArrayType(['string'])]
  public ?array $scopes;

  /**
   * @var ?value-of<\ElevenLabs\Types\ApiIntegrationOAuth2CustomAppResponseScopeSeparator>
   * Separator for scopes
   */
  #[JsonProperty('scope_separator')]
  public ?string $scopeSeparator;

  /**
   * ISO 8601 timestamp of when the access token expires
   */
  #[JsonProperty('expires_at', required: true)]
  public string $expiresAt;

  #[JsonProperty('integration_id', required: true)]
  public string $integrationId;

  #[JsonProperty('credential_id', required: true)]
  public string $credentialId;

  /**
   * OAuth client ID (rendered from template if credential uses templated credentials, None for legacy connections)
   */
  #[JsonProperty('client_id', required: true)]
  public string $clientId;

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
   * @param array{
   *   name: string,
   *   provider: string,
   *   tokenUrl: string,
   *   expiresAt: string,
   *   integrationId: string,
   *   credentialId: string,
   *   clientId: string,
   *   id: string,
   *   authType?: ?value-of<\ElevenLabs\Types\ApiIntegrationOAuth2CustomAppResponseAuthType>,
   *   scopes?: string[]|null,
   *   scopeSeparator?: ?value-of<\ElevenLabs\Types\ApiIntegrationOAuth2CustomAppResponseScopeSeparator>,
   *   usedBy?: ?\ElevenLabs\Types\AuthConnectionDependencies,
   *   status?: ?value-of<\ElevenLabs\Types\AuthConnectionStatus>,
   *   statusDetail?: ?string,
   *   statusUpdatedAt?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->name = $values['name'];
    $this->authType = $values['authType'] ?? 'api_integration_oauth2_custom_app';
    $this->provider = $values['provider'];
    $this->tokenUrl = $values['tokenUrl'];
    $this->scopes = $values['scopes'] ?? null;
    $this->scopeSeparator = $values['scopeSeparator'] ?? null;
    $this->expiresAt = $values['expiresAt'];
    $this->integrationId = $values['integrationId'];
    $this->credentialId = $values['credentialId'];
    $this->clientId = $values['clientId'];
    $this->id = $values['id'];
    $this->usedBy = $values['usedBy'] ?? null;
    $this->status = $values['status'] ?? null;
    $this->statusDetail = $values['statusDetail'] ?? null;
    $this->statusUpdatedAt = $values['statusUpdatedAt'] ?? null;

    $this->_dirtyFields = [
      'name' => true,
      'provider' => true,
      'token_url' => true,
      'expires_at' => true,
      'integration_id' => true,
      'credential_id' => true,
      'client_id' => true,
      'id' => true
    ];
    if (array_key_exists('authType', $values)) {
      $this->_dirtyFields['auth_type'] = true;
    }
    if (array_key_exists('scopes', $values)) {
      $this->_dirtyFields['scopes'] = true;
    }
    if (array_key_exists('scopeSeparator', $values)) {
      $this->_dirtyFields['scope_separator'] = true;
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

    if ($this->scopeSeparator !== null) {
      $parts[] = [
        'name' => 'scope_separator',
        'contents' => $this->scopeSeparator
      ];
    }

    $parts[] = [
      'name' => 'expires_at',
      'contents' => $this->expiresAt
    ];

    $parts[] = [
      'name' => 'integration_id',
      'contents' => $this->integrationId
    ];

    $parts[] = [
      'name' => 'credential_id',
      'contents' => $this->credentialId
    ];

    $parts[] = [
      'name' => 'client_id',
      'contents' => $this->clientId
    ];

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

    return $parts;
  }

  public function validate(): void
  {
    $this->usedBy?->validate();
  }
}
