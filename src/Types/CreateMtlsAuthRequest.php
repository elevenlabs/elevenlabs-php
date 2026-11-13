<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * Request model for creating mTLS auth connections.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class CreateMtlsAuthRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * @var ?value-of<\ElevenLabs\Types\CreateMtlsAuthRequestAuthType>
   */
  #[JsonProperty('auth_type')]
  public ?string $authType;

  #[JsonProperty('provider', required: true)]
  public string $provider;

  #[JsonProperty('client_certificate', required: true)]
  public string $clientCertificate;

  #[JsonProperty('client_key', required: true)]
  public string $clientKey;

  #[JsonProperty('ca_certificate')]
  public ?string $caCertificate;

  #[JsonProperty('key_passphrase')]
  public ?string $keyPassphrase;

  /**
   * @param array{
   *   name: string,
   *   provider: string,
   *   clientCertificate: string,
   *   clientKey: string,
   *   authType?: ?value-of<\ElevenLabs\Types\CreateMtlsAuthRequestAuthType>,
   *   caCertificate?: ?string,
   *   keyPassphrase?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->name = $values['name'];
    $this->authType = $values['authType'] ?? 'mtls';
    $this->provider = $values['provider'];
    $this->clientCertificate = $values['clientCertificate'];
    $this->clientKey = $values['clientKey'];
    $this->caCertificate = $values['caCertificate'] ?? null;
    $this->keyPassphrase = $values['keyPassphrase'] ?? null;

    $this->_dirtyFields = [
      'name' => true,
      'provider' => true,
      'client_certificate' => true,
      'client_key' => true
    ];
    if (array_key_exists('authType', $values)) {
      $this->_dirtyFields['auth_type'] = true;
    }
    if (array_key_exists('caCertificate', $values)) {
      $this->_dirtyFields['ca_certificate'] = true;
    }
    if (array_key_exists('keyPassphrase', $values)) {
      $this->_dirtyFields['key_passphrase'] = true;
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
      'name' => 'client_certificate',
      'contents' => $this->clientCertificate
    ];

    $parts[] = [
      'name' => 'client_key',
      'contents' => $this->clientKey
    ];

    if ($this->caCertificate !== null) {
      $parts[] = [
        'name' => 'ca_certificate',
        'contents' => $this->caCertificate
      ];
    }

    if ($this->keyPassphrase !== null) {
      $parts[] = [
        'name' => 'key_passphrase',
        'contents' => $this->keyPassphrase
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
