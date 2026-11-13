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
class UrlSecretAuthResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * @var ?value-of<\ElevenLabs\Types\UrlSecretAuthResponseAuthType>
   */
  #[JsonProperty('auth_type')]
  public ?string $authType;

  #[JsonProperty('provider', required: true)]
  public string $provider;

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
   *   id: string,
   *   authType?: ?value-of<\ElevenLabs\Types\UrlSecretAuthResponseAuthType>,
   *   usedBy?: ?\ElevenLabs\Types\AuthConnectionDependencies,
   *   status?: ?value-of<\ElevenLabs\Types\AuthConnectionStatus>,
   *   statusDetail?: ?string,
   *   statusUpdatedAt?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->name = $values['name'];
    $this->authType = $values['authType'] ?? 'url_secret';
    $this->provider = $values['provider'];
    $this->id = $values['id'];
    $this->usedBy = $values['usedBy'] ?? null;
    $this->status = $values['status'] ?? null;
    $this->statusDetail = $values['statusDetail'] ?? null;
    $this->statusUpdatedAt = $values['statusUpdatedAt'] ?? null;

    $this->_dirtyFields = [
      'name' => true,
      'provider' => true,
      'id' => true
    ];
    if (array_key_exists('authType', $values)) {
      $this->_dirtyFields['auth_type'] = true;
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
