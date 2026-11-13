<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class UpdateOAuth2JwtRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\UpdateOAuth2JwtRequestAuthType>
   */
  #[JsonProperty('auth_type')]
  public ?string $authType;

  #[JsonProperty('provider')]
  public ?string $provider;

  /**
   * @var ?value-of<\ElevenLabs\Types\UpdateOAuth2JwtRequestAlgorithm>
   */
  #[JsonProperty('algorithm')]
  public ?string $algorithm;

  #[JsonProperty('key_id')]
  public ?string $keyId;

  #[JsonProperty('issuer')]
  public ?string $issuer;

  #[JsonProperty('audience')]
  public ?string $audience;

  #[JsonProperty('subject')]
  public ?string $subject;

  #[JsonProperty('expiration_seconds')]
  public ?int $expirationSeconds;

  /**
   * @var array<string, string>|null
   */
  #[JsonProperty('extra_params'), ArrayType(['string' => 'string'])]
  public ?array $extraParams;

  /**
   * @var string[]|null
   */
  #[JsonProperty('scopes'), ArrayType(['string'])]
  public ?array $scopes;

  /**
   * @var ?value-of<\ElevenLabs\Types\UpdateOAuth2JwtRequestTokenResponseField>
   */
  #[JsonProperty('token_response_field')]
  public ?string $tokenResponseField;

  /**
   * @var ?value-of<\ElevenLabs\Types\UpdateOAuth2JwtRequestJwtUsage>
   */
  #[JsonProperty('jwt_usage')]
  public ?string $jwtUsage;

  /**
   * @var array<string, string>|null
   */
  #[JsonProperty('extra_headers'), ArrayType(['string' => 'string'])]
  public ?array $extraHeaders;

  #[JsonProperty('secret_key')]
  public ?string $secretKey;

  /**
   * @param array{
   *   authType?: ?value-of<\ElevenLabs\Types\UpdateOAuth2JwtRequestAuthType>,
   *   provider?: ?string,
   *   algorithm?: ?value-of<\ElevenLabs\Types\UpdateOAuth2JwtRequestAlgorithm>,
   *   keyId?: ?string,
   *   issuer?: ?string,
   *   audience?: ?string,
   *   subject?: ?string,
   *   expirationSeconds?: ?int,
   *   extraParams?: array<string, string>|null,
   *   scopes?: string[]|null,
   *   tokenResponseField?: ?value-of<\ElevenLabs\Types\UpdateOAuth2JwtRequestTokenResponseField>,
   *   jwtUsage?: ?value-of<\ElevenLabs\Types\UpdateOAuth2JwtRequestJwtUsage>,
   *   extraHeaders?: array<string, string>|null,
   *   secretKey?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->authType = $values['authType'] ?? 'oauth2_jwt';
    $this->provider = $values['provider'] ?? null;
    $this->algorithm = $values['algorithm'] ?? null;
    $this->keyId = $values['keyId'] ?? null;
    $this->issuer = $values['issuer'] ?? null;
    $this->audience = $values['audience'] ?? null;
    $this->subject = $values['subject'] ?? null;
    $this->expirationSeconds = $values['expirationSeconds'] ?? null;
    $this->extraParams = $values['extraParams'] ?? null;
    $this->scopes = $values['scopes'] ?? null;
    $this->tokenResponseField = $values['tokenResponseField'] ?? null;
    $this->jwtUsage = $values['jwtUsage'] ?? null;
    $this->extraHeaders = $values['extraHeaders'] ?? null;
    $this->secretKey = $values['secretKey'] ?? null;

    if (array_key_exists('authType', $values)) {
      $this->_dirtyFields['auth_type'] = true;
    }
    if (array_key_exists('provider', $values)) {
      $this->_dirtyFields['provider'] = true;
    }
    if (array_key_exists('algorithm', $values)) {
      $this->_dirtyFields['algorithm'] = true;
    }
    if (array_key_exists('keyId', $values)) {
      $this->_dirtyFields['key_id'] = true;
    }
    if (array_key_exists('issuer', $values)) {
      $this->_dirtyFields['issuer'] = true;
    }
    if (array_key_exists('audience', $values)) {
      $this->_dirtyFields['audience'] = true;
    }
    if (array_key_exists('subject', $values)) {
      $this->_dirtyFields['subject'] = true;
    }
    if (array_key_exists('expirationSeconds', $values)) {
      $this->_dirtyFields['expiration_seconds'] = true;
    }
    if (array_key_exists('extraParams', $values)) {
      $this->_dirtyFields['extra_params'] = true;
    }
    if (array_key_exists('scopes', $values)) {
      $this->_dirtyFields['scopes'] = true;
    }
    if (array_key_exists('tokenResponseField', $values)) {
      $this->_dirtyFields['token_response_field'] = true;
    }
    if (array_key_exists('jwtUsage', $values)) {
      $this->_dirtyFields['jwt_usage'] = true;
    }
    if (array_key_exists('extraHeaders', $values)) {
      $this->_dirtyFields['extra_headers'] = true;
    }
    if (array_key_exists('secretKey', $values)) {
      $this->_dirtyFields['secret_key'] = true;
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

    if ($this->issuer !== null) {
      $parts[] = [
        'name' => 'issuer',
        'contents' => $this->issuer
      ];
    }

    if ($this->audience !== null) {
      $parts[] = [
        'name' => 'audience',
        'contents' => $this->audience
      ];
    }

    if ($this->subject !== null) {
      $parts[] = [
        'name' => 'subject',
        'contents' => $this->subject
      ];
    }

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

    if ($this->scopes !== null) {
      foreach ($this->scopes ?? [] as $item) {
        $parts[] = [
          'name' => 'scopes',
          'contents' => $item
        ];
      }
    }

    if ($this->tokenResponseField !== null) {
      $parts[] = [
        'name' => 'token_response_field',
        'contents' => $this->tokenResponseField
      ];
    }

    if ($this->jwtUsage !== null) {
      $parts[] = [
        'name' => 'jwt_usage',
        'contents' => $this->jwtUsage
      ];
    }

    if ($this->extraHeaders !== null) {
      $parts[] = [
        'name' => 'extra_headers',
        'contents' => json_encode($this->extraHeaders),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->secretKey !== null) {
      $parts[] = [
        'name' => 'secret_key',
        'contents' => $this->secretKey
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateNumber($this->expirationSeconds, 'expiration_seconds', min: 60, max: 86400);
  }
}
