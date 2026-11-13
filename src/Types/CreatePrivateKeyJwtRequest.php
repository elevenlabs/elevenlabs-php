<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * Request model for creating Private Key JWT auth connections - inherits common settings and includes sensitive fields
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class CreatePrivateKeyJwtRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * @var ?value-of<\ElevenLabs\Types\CreatePrivateKeyJwtRequestAuthType>
   */
  #[JsonProperty('auth_type')]
  public ?string $authType;

  #[JsonProperty('provider', required: true)]
  public string $provider;

  /**
   * @var ?value-of<\ElevenLabs\Types\CreatePrivateKeyJwtRequestAlgorithm>
   * JWT signing algorithm
   */
  #[JsonProperty('algorithm')]
  public ?string $algorithm;

  /**
   * Key ID (kid) for JWT header - useful for key rotation
   */
  #[JsonProperty('key_id')]
  public ?string $keyId;

  /**
   * JWT issuer (iss claim)
   */
  #[JsonProperty('issuer', required: true)]
  public string $issuer;

  /**
   * JWT audience (aud claim)
   */
  #[JsonProperty('audience', required: true)]
  public string $audience;

  /**
   * JWT subject (sub claim)
   */
  #[JsonProperty('subject', required: true)]
  public string $subject;

  /**
   * Token expiration time in seconds
   */
  #[JsonProperty('expiration_seconds')]
  public ?int $expirationSeconds;

  /**
   * @var array<string, string>|null
   * Additional custom claims to include in the JWT
   */
  #[JsonProperty('extra_params'), ArrayType(['string' => 'string'])]
  public ?array $extraParams;

  /**
   * @var array<string, string>|null
   * Additional JWT header parameters (e.g. x5t). 'alg' and 'kid' are set from algorithm and key_id.
   */
  #[JsonProperty('extra_headers'), ArrayType(['string' => 'string'])]
  public ?array $extraHeaders;

  #[JsonProperty('secret_key', required: true)]
  public string $secretKey;

  /**
   * @param array{
   *   name: string,
   *   provider: string,
   *   issuer: string,
   *   audience: string,
   *   subject: string,
   *   secretKey: string,
   *   authType?: ?value-of<\ElevenLabs\Types\CreatePrivateKeyJwtRequestAuthType>,
   *   algorithm?: ?value-of<\ElevenLabs\Types\CreatePrivateKeyJwtRequestAlgorithm>,
   *   keyId?: ?string,
   *   expirationSeconds?: ?int,
   *   extraParams?: array<string, string>|null,
   *   extraHeaders?: array<string, string>|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->name = $values['name'];
    $this->authType = $values['authType'] ?? 'private_key_jwt';
    $this->provider = $values['provider'];
    $this->algorithm = $values['algorithm'] ?? null;
    $this->keyId = $values['keyId'] ?? null;
    $this->issuer = $values['issuer'];
    $this->audience = $values['audience'];
    $this->subject = $values['subject'];
    $this->expirationSeconds = $values['expirationSeconds'] ?? null;
    $this->extraParams = $values['extraParams'] ?? null;
    $this->extraHeaders = $values['extraHeaders'] ?? null;
    $this->secretKey = $values['secretKey'];

    $this->_dirtyFields = [
      'name' => true,
      'provider' => true,
      'issuer' => true,
      'audience' => true,
      'subject' => true,
      'secret_key' => true
    ];
    if (array_key_exists('authType', $values)) {
      $this->_dirtyFields['auth_type'] = true;
    }
    if (array_key_exists('algorithm', $values)) {
      $this->_dirtyFields['algorithm'] = true;
    }
    if (array_key_exists('keyId', $values)) {
      $this->_dirtyFields['key_id'] = true;
    }
    if (array_key_exists('expirationSeconds', $values)) {
      $this->_dirtyFields['expiration_seconds'] = true;
    }
    if (array_key_exists('extraParams', $values)) {
      $this->_dirtyFields['extra_params'] = true;
    }
    if (array_key_exists('extraHeaders', $values)) {
      $this->_dirtyFields['extra_headers'] = true;
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

    if ($this->algorithm !== null) {
      $parts[] = [
        'name' => 'algorithm',
        'contents' => $this->algorithm
      ];
    }

    if ($this->keyId !== null) {
      $parts[] = [
        'name' => 'key_id',
        'contents' => $this->keyId
      ];
    }

    $parts[] = [
      'name' => 'issuer',
      'contents' => $this->issuer
    ];

    $parts[] = [
      'name' => 'audience',
      'contents' => $this->audience
    ];

    $parts[] = [
      'name' => 'subject',
      'contents' => $this->subject
    ];

    if ($this->expirationSeconds !== null) {
      $parts[] = [
        'name' => 'expiration_seconds',
        'contents' => (string) $this->expirationSeconds
      ];
    }

    if ($this->extraParams !== null) {
      $parts[] = [
        'name' => 'extra_params',
        'contents' => json_encode($this->extraParams),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->extraHeaders !== null) {
      $parts[] = [
        'name' => 'extra_headers',
        'contents' => json_encode($this->extraHeaders),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    $parts[] = [
      'name' => 'secret_key',
      'contents' => $this->secretKey
    ];

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateNumber($this->expirationSeconds, 'expiration_seconds', min: 60, max: 86400);
  }
}
