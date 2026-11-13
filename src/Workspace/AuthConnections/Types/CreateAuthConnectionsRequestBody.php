<?php

declare(strict_types=1);

namespace ElevenLabs\Workspace\AuthConnections\Types;

use ElevenLabs\Core\Json\JsonSerializableType;

/**
 * Auth connection to create
 */
/**
 * Discriminated union type (oneOf) representing exactly one of multiple possible types.
 *
 * This class implements a type-safe union where the value can be exactly one of the
 * defined variant types. It provides factory methods for construction, type-checking
 * methods, safe and throwing getters, and pattern matching for exhaustive handling.
 *
 * The oneOf pattern enforces that only one type can be present at a time, unlike anyOf
 * which allows multiple types simultaneously.
 */
class CreateAuthConnectionsRequestBody extends JsonSerializableType
{
  /**
   * @var string The discriminator value identifying which variant is stored
   */
  public readonly string $authType;

  /**
   * @var \ElevenLabs\Types\CreateOAuth2ClientCredsRequest|\ElevenLabs\Types\CreateCustomHeaderAuthRequest|\ElevenLabs\Types\CreateBasicAuthRequest|\ElevenLabs\Types\CreateBearerAuthRequest|\ElevenLabs\Types\CreateOAuth2JwtRequest|\ElevenLabs\Types\CreatePrivateKeyJwtRequest|\ElevenLabs\Types\CreateMtlsAuthRequest|array<string, mixed> The value, exactly one of the variant types
   */
  public readonly mixed $value;

  /**
   * @var int The type index identifying which variant type is stored
   */
  private int $typeIndex;

  /** The type index of a payload whose discriminator names no variant this SDK knows. */
  private const UNKNOWN = -1;

  /**
   * Whether the payload's discriminator named a variant this SDK does not know (a variant added to
   * the API after this SDK was generated). Its raw payload is kept, as Fern's `_unknown` variant does.
   *
   * Underscore-prefixed because a union may legitimately have a variant NAMED `unknown`, whose own
   * accessors are `isUnknown()`/`asUnknown()`. Declaring both is a fatal `Cannot redeclare` and the
   * class cannot load at all. The prefix matches Fern's `_unknown` sentinel and Java's
   * `_isUnknown()`/`_getUnknown()`, and a variant accessor is always `isX`/`asX`, never `_isX` --
   * so the two can never collide whatever a spec calls its variants.
   */
  public function _isUnknown(): bool
  {
    return $this->typeIndex === self::UNKNOWN;
  }

  /**
   * @return array<string, mixed> The raw payload of an unknown variant
   * @throws \RuntimeException if this CreateAuthConnectionsRequestBody holds a known variant
   */
  public function _asUnknown(): array
  {
    if (!$this->_isUnknown()) {
      throw new \RuntimeException(
        'CreateAuthConnectionsRequestBody does not contain an unknown variant'
      );
    }
    /** @var array<string, mixed> $value */
    $value = $this->value;
    return $value;
  }

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\CreateOAuth2ClientCredsRequest|\ElevenLabs\Types\CreateCustomHeaderAuthRequest|\ElevenLabs\Types\CreateBasicAuthRequest|\ElevenLabs\Types\CreateBearerAuthRequest|\ElevenLabs\Types\CreateOAuth2JwtRequest|\ElevenLabs\Types\CreatePrivateKeyJwtRequest|\ElevenLabs\Types\CreateMtlsAuthRequest|array<string, mixed> $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
    $this->authType = match ($typeIndex) {
      0 => 'oauth2_client_credentials',
      1 => 'custom_header_auth',
      2 => 'basic_auth',
      3 => 'bearer_auth',
      4 => 'oauth2_jwt',
      5 => 'private_key_jwt',
      6 => 'mtls',
      self::UNKNOWN => '_unknown',
      default => throw new \UnexpectedValueException("Unknown type index: $typeIndex")
    };
  }

  // Factory methods
  /**
   * Create a CreateAuthConnectionsRequestBody instance containing a \ElevenLabs\Types\CreateOAuth2ClientCredsRequest
   */
  public static function oauth2ClientCredentials(
    \ElevenLabs\Types\CreateOAuth2ClientCredsRequest $oauth2ClientCredentials
  ): self {
    return new self($oauth2ClientCredentials, 0);
  }

  /**
   * Create a CreateAuthConnectionsRequestBody instance containing a \ElevenLabs\Types\CreateCustomHeaderAuthRequest
   */
  public static function customHeaderAuth(
    \ElevenLabs\Types\CreateCustomHeaderAuthRequest $customHeaderAuth
  ): self {
    return new self($customHeaderAuth, 1);
  }

  /**
   * Create a CreateAuthConnectionsRequestBody instance containing a \ElevenLabs\Types\CreateBasicAuthRequest
   */
  public static function basicAuth(\ElevenLabs\Types\CreateBasicAuthRequest $basicAuth): self
  {
    return new self($basicAuth, 2);
  }

  /**
   * Create a CreateAuthConnectionsRequestBody instance containing a \ElevenLabs\Types\CreateBearerAuthRequest
   */
  public static function bearerAuth(\ElevenLabs\Types\CreateBearerAuthRequest $bearerAuth): self
  {
    return new self($bearerAuth, 3);
  }

  /**
   * Create a CreateAuthConnectionsRequestBody instance containing a \ElevenLabs\Types\CreateOAuth2JwtRequest
   */
  public static function oauth2Jwt(\ElevenLabs\Types\CreateOAuth2JwtRequest $oauth2Jwt): self
  {
    return new self($oauth2Jwt, 4);
  }

  /**
   * Create a CreateAuthConnectionsRequestBody instance containing a \ElevenLabs\Types\CreatePrivateKeyJwtRequest
   */
  public static function privateKeyJwt(
    \ElevenLabs\Types\CreatePrivateKeyJwtRequest $privateKeyJwt
  ): self {
    return new self($privateKeyJwt, 5);
  }

  /**
   * Create a CreateAuthConnectionsRequestBody instance containing a \ElevenLabs\Types\CreateMtlsAuthRequest
   */
  public static function mtls(\ElevenLabs\Types\CreateMtlsAuthRequest $mtls): self
  {
    return new self($mtls, 6);
  }

  // Type checking methods
  /**
   * Check if this CreateAuthConnectionsRequestBody contains a \ElevenLabs\Types\CreateOAuth2ClientCredsRequest
   */
  public function isOauth2ClientCredentials(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this CreateAuthConnectionsRequestBody contains a \ElevenLabs\Types\CreateCustomHeaderAuthRequest
   */
  public function isCustomHeaderAuth(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this CreateAuthConnectionsRequestBody contains a \ElevenLabs\Types\CreateBasicAuthRequest
   */
  public function isBasicAuth(): bool
  {
    return $this->typeIndex === 2;
  }

  /**
   * Check if this CreateAuthConnectionsRequestBody contains a \ElevenLabs\Types\CreateBearerAuthRequest
   */
  public function isBearerAuth(): bool
  {
    return $this->typeIndex === 3;
  }

  /**
   * Check if this CreateAuthConnectionsRequestBody contains a \ElevenLabs\Types\CreateOAuth2JwtRequest
   */
  public function isOauth2Jwt(): bool
  {
    return $this->typeIndex === 4;
  }

  /**
   * Check if this CreateAuthConnectionsRequestBody contains a \ElevenLabs\Types\CreatePrivateKeyJwtRequest
   */
  public function isPrivateKeyJwt(): bool
  {
    return $this->typeIndex === 5;
  }

  /**
   * Check if this CreateAuthConnectionsRequestBody contains a \ElevenLabs\Types\CreateMtlsAuthRequest
   */
  public function isMtls(): bool
  {
    return $this->typeIndex === 6;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\CreateOAuth2ClientCredsRequest value
   * @throws \RuntimeException if this CreateAuthConnectionsRequestBody does not contain a \ElevenLabs\Types\CreateOAuth2ClientCredsRequest
   */
  public function asOauth2ClientCredentials(): \ElevenLabs\Types\CreateOAuth2ClientCredsRequest
  {
    if (!$this->isOauth2ClientCredentials()) {
      throw new \RuntimeException(
        'CreateAuthConnectionsRequestBody does not contain \ElevenLabs\Types\CreateOAuth2ClientCredsRequest'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\CreateCustomHeaderAuthRequest value
   * @throws \RuntimeException if this CreateAuthConnectionsRequestBody does not contain a \ElevenLabs\Types\CreateCustomHeaderAuthRequest
   */
  public function asCustomHeaderAuth(): \ElevenLabs\Types\CreateCustomHeaderAuthRequest
  {
    if (!$this->isCustomHeaderAuth()) {
      throw new \RuntimeException(
        'CreateAuthConnectionsRequestBody does not contain \ElevenLabs\Types\CreateCustomHeaderAuthRequest'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\CreateBasicAuthRequest value
   * @throws \RuntimeException if this CreateAuthConnectionsRequestBody does not contain a \ElevenLabs\Types\CreateBasicAuthRequest
   */
  public function asBasicAuth(): \ElevenLabs\Types\CreateBasicAuthRequest
  {
    if (!$this->isBasicAuth()) {
      throw new \RuntimeException(
        'CreateAuthConnectionsRequestBody does not contain \ElevenLabs\Types\CreateBasicAuthRequest'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\CreateBearerAuthRequest value
   * @throws \RuntimeException if this CreateAuthConnectionsRequestBody does not contain a \ElevenLabs\Types\CreateBearerAuthRequest
   */
  public function asBearerAuth(): \ElevenLabs\Types\CreateBearerAuthRequest
  {
    if (!$this->isBearerAuth()) {
      throw new \RuntimeException(
        'CreateAuthConnectionsRequestBody does not contain \ElevenLabs\Types\CreateBearerAuthRequest'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\CreateOAuth2JwtRequest value
   * @throws \RuntimeException if this CreateAuthConnectionsRequestBody does not contain a \ElevenLabs\Types\CreateOAuth2JwtRequest
   */
  public function asOauth2Jwt(): \ElevenLabs\Types\CreateOAuth2JwtRequest
  {
    if (!$this->isOauth2Jwt()) {
      throw new \RuntimeException(
        'CreateAuthConnectionsRequestBody does not contain \ElevenLabs\Types\CreateOAuth2JwtRequest'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\CreatePrivateKeyJwtRequest value
   * @throws \RuntimeException if this CreateAuthConnectionsRequestBody does not contain a \ElevenLabs\Types\CreatePrivateKeyJwtRequest
   */
  public function asPrivateKeyJwt(): \ElevenLabs\Types\CreatePrivateKeyJwtRequest
  {
    if (!$this->isPrivateKeyJwt()) {
      throw new \RuntimeException(
        'CreateAuthConnectionsRequestBody does not contain \ElevenLabs\Types\CreatePrivateKeyJwtRequest'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\CreateMtlsAuthRequest value
   * @throws \RuntimeException if this CreateAuthConnectionsRequestBody does not contain a \ElevenLabs\Types\CreateMtlsAuthRequest
   */
  public function asMtls(): \ElevenLabs\Types\CreateMtlsAuthRequest
  {
    if (!$this->isMtls()) {
      throw new \RuntimeException(
        'CreateAuthConnectionsRequestBody does not contain \ElevenLabs\Types\CreateMtlsAuthRequest'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\CreateOAuth2ClientCredsRequest value
   * @return \ElevenLabs\Types\CreateOAuth2ClientCredsRequest|null Returns the value if this CreateAuthConnectionsRequestBody contains a \ElevenLabs\Types\CreateOAuth2ClientCredsRequest, null otherwise
   */
  public function tryAsOauth2ClientCredentials(): ?\ElevenLabs\Types\CreateOAuth2ClientCredsRequest
  {
    return $this->isOauth2ClientCredentials() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\CreateCustomHeaderAuthRequest value
   * @return \ElevenLabs\Types\CreateCustomHeaderAuthRequest|null Returns the value if this CreateAuthConnectionsRequestBody contains a \ElevenLabs\Types\CreateCustomHeaderAuthRequest, null otherwise
   */
  public function tryAsCustomHeaderAuth(): ?\ElevenLabs\Types\CreateCustomHeaderAuthRequest
  {
    return $this->isCustomHeaderAuth() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\CreateBasicAuthRequest value
   * @return \ElevenLabs\Types\CreateBasicAuthRequest|null Returns the value if this CreateAuthConnectionsRequestBody contains a \ElevenLabs\Types\CreateBasicAuthRequest, null otherwise
   */
  public function tryAsBasicAuth(): ?\ElevenLabs\Types\CreateBasicAuthRequest
  {
    return $this->isBasicAuth() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\CreateBearerAuthRequest value
   * @return \ElevenLabs\Types\CreateBearerAuthRequest|null Returns the value if this CreateAuthConnectionsRequestBody contains a \ElevenLabs\Types\CreateBearerAuthRequest, null otherwise
   */
  public function tryAsBearerAuth(): ?\ElevenLabs\Types\CreateBearerAuthRequest
  {
    return $this->isBearerAuth() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\CreateOAuth2JwtRequest value
   * @return \ElevenLabs\Types\CreateOAuth2JwtRequest|null Returns the value if this CreateAuthConnectionsRequestBody contains a \ElevenLabs\Types\CreateOAuth2JwtRequest, null otherwise
   */
  public function tryAsOauth2Jwt(): ?\ElevenLabs\Types\CreateOAuth2JwtRequest
  {
    return $this->isOauth2Jwt() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\CreatePrivateKeyJwtRequest value
   * @return \ElevenLabs\Types\CreatePrivateKeyJwtRequest|null Returns the value if this CreateAuthConnectionsRequestBody contains a \ElevenLabs\Types\CreatePrivateKeyJwtRequest, null otherwise
   */
  public function tryAsPrivateKeyJwt(): ?\ElevenLabs\Types\CreatePrivateKeyJwtRequest
  {
    return $this->isPrivateKeyJwt() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\CreateMtlsAuthRequest value
   * @return \ElevenLabs\Types\CreateMtlsAuthRequest|null Returns the value if this CreateAuthConnectionsRequestBody contains a \ElevenLabs\Types\CreateMtlsAuthRequest, null otherwise
   */
  public function tryAsMtls(): ?\ElevenLabs\Types\CreateMtlsAuthRequest
  {
    return $this->isMtls() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\CreateOAuth2ClientCredsRequest): T $onOauth2ClientCredentials
   * @param callable(\ElevenLabs\Types\CreateCustomHeaderAuthRequest): T $onCustomHeaderAuth
   * @param callable(\ElevenLabs\Types\CreateBasicAuthRequest): T $onBasicAuth
   * @param callable(\ElevenLabs\Types\CreateBearerAuthRequest): T $onBearerAuth
   * @param callable(\ElevenLabs\Types\CreateOAuth2JwtRequest): T $onOauth2Jwt
   * @param callable(\ElevenLabs\Types\CreatePrivateKeyJwtRequest): T $onPrivateKeyJwt
   * @param callable(\ElevenLabs\Types\CreateMtlsAuthRequest): T $onMtls
   * @return T
   */
  public function match(
    callable $onOauth2ClientCredentials,
    callable $onCustomHeaderAuth,
    callable $onBasicAuth,
    callable $onBearerAuth,
    callable $onOauth2Jwt,
    callable $onPrivateKeyJwt,
    callable $onMtls
  ): mixed {
    return match ($this->typeIndex) {
      0 => $onOauth2ClientCredentials($this->value),
      1 => $onCustomHeaderAuth($this->value),
      2 => $onBasicAuth($this->value),
      3 => $onBearerAuth($this->value),
      4 => $onOauth2Jwt($this->value),
      5 => $onPrivateKeyJwt($this->value),
      6 => $onMtls($this->value),
      default => throw new \UnexpectedValueException("Unknown type index: $this->typeIndex")
    };
  }

  /**
   * Deserialize from data - try each type in order
   * @param array<string, mixed> $data
   * @return self
   * @throws \InvalidArgumentException if data doesn't match any type
   */
  public static function fromArray(array $data): self
  {
    // Best-match-wins: collect every variant that fromArray() accepted,
    // score each by how many of the input keys it actually consumed
    // (looked up via the per-instance _dirtyFields populated by the
    // variant's own fromArray), then keep the highest-scoring one. Ties
    // break to the first-declared variant because PHP's usort is stable
    // when compared values are equal and we visit variants in order.
    // This is what makes oneOf with overlapping schemas (e.g. Cat & Dog
    // both have `name`, only Cat has `color`) pick the right variant
    // when discriminating fields are present.
    // The payload's own discriminator value picks the variant. Scoring alone ties whenever two
    // members have the same shape and differ only in that constant, and the first would win.
    if (is_array($data) && isset($data['auth_type']) && is_string($data['auth_type'])) {
      switch ($data['auth_type']) {
        case 'oauth2_client_credentials':
          return new self(\ElevenLabs\Types\CreateOAuth2ClientCredsRequest::fromArray($data), 0);
        case 'custom_header_auth':
          return new self(\ElevenLabs\Types\CreateCustomHeaderAuthRequest::fromArray($data), 1);
        case 'basic_auth':
          return new self(\ElevenLabs\Types\CreateBasicAuthRequest::fromArray($data), 2);
        case 'bearer_auth':
          return new self(\ElevenLabs\Types\CreateBearerAuthRequest::fromArray($data), 3);
        case 'oauth2_jwt':
          return new self(\ElevenLabs\Types\CreateOAuth2JwtRequest::fromArray($data), 4);
        case 'private_key_jwt':
          return new self(\ElevenLabs\Types\CreatePrivateKeyJwtRequest::fromArray($data), 5);
        case 'mtls':
          return new self(\ElevenLabs\Types\CreateMtlsAuthRequest::fromArray($data), 6);
        default:
          // A variant the API added after this SDK was generated: kept, not rejected.
          return new self($data, self::UNKNOWN);
      }
    }

    /** @var list<array{instance: mixed, idx: int, score: int}> */
    $candidates = [];
    try {
      $candidate = \ElevenLabs\Types\CreateOAuth2ClientCredsRequest::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\CreateOAuth2ClientCredsRequest didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\CreateCustomHeaderAuthRequest::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\CreateCustomHeaderAuthRequest didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\CreateBasicAuthRequest::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\CreateBasicAuthRequest didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\CreateBearerAuthRequest::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 3, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\CreateBearerAuthRequest didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\CreateOAuth2JwtRequest::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 4, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\CreateOAuth2JwtRequest didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\CreatePrivateKeyJwtRequest::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 5, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\CreatePrivateKeyJwtRequest didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\CreateMtlsAuthRequest::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 6, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\CreateMtlsAuthRequest didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException(
        'Data does not match any CreateAuthConnectionsRequestBody type'
      );
    }
    $best = $candidates[0];
    foreach ($candidates as $candidate) {
      if ($candidate['score'] > $best['score']) {
        $best = $candidate;
      }
    }
    return new self($best['instance'], $best['idx']);
  }

  /**
   * Serialize to JSON - returns the serialized inner value
   *
   * @return array<mixed>
   */
  public function jsonSerialize(): array
  {
    if ($this->_isUnknown()) {
      return $this->_asUnknown();
    }
    return $this->value->jsonSerialize();
  }
}
