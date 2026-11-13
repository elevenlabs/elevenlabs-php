<?php

declare(strict_types=1);

namespace ElevenLabs\Workspace\AuthConnections\Types;

use ElevenLabs\Core\Json\JsonSerializableType;

/**
 * Updated auth connection fields
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
class UpdateAuthConnectionsRequestBody extends JsonSerializableType
{
  /**
   * @var string The discriminator value identifying which variant is stored
   */
  public readonly string $authType;

  /**
   * @var \ElevenLabs\Types\UpdateOAuth2ClientCredsRequest|\ElevenLabs\Types\UpdateBasicAuthRequest|\ElevenLabs\Types\UpdateBearerAuthRequest|\ElevenLabs\Types\UpdateOAuth2JwtRequest|array<string, mixed> The value, exactly one of the variant types
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
   * @throws \RuntimeException if this UpdateAuthConnectionsRequestBody holds a known variant
   */
  public function _asUnknown(): array
  {
    if (!$this->_isUnknown()) {
      throw new \RuntimeException(
        'UpdateAuthConnectionsRequestBody does not contain an unknown variant'
      );
    }
    /** @var array<string, mixed> $value */
    $value = $this->value;
    return $value;
  }

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\UpdateOAuth2ClientCredsRequest|\ElevenLabs\Types\UpdateBasicAuthRequest|\ElevenLabs\Types\UpdateBearerAuthRequest|\ElevenLabs\Types\UpdateOAuth2JwtRequest|array<string, mixed> $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
    $this->authType = match ($typeIndex) {
      0 => 'oauth2_client_credentials',
      1 => 'basic_auth',
      2 => 'bearer_auth',
      3 => 'oauth2_jwt',
      self::UNKNOWN => '_unknown',
      default => throw new \UnexpectedValueException("Unknown type index: $typeIndex")
    };
  }

  // Factory methods
  /**
   * Create a UpdateAuthConnectionsRequestBody instance containing a \ElevenLabs\Types\UpdateOAuth2ClientCredsRequest
   */
  public static function oauth2ClientCredentials(
    \ElevenLabs\Types\UpdateOAuth2ClientCredsRequest $oauth2ClientCredentials
  ): self {
    return new self($oauth2ClientCredentials, 0);
  }

  /**
   * Create a UpdateAuthConnectionsRequestBody instance containing a \ElevenLabs\Types\UpdateBasicAuthRequest
   */
  public static function basicAuth(\ElevenLabs\Types\UpdateBasicAuthRequest $basicAuth): self
  {
    return new self($basicAuth, 1);
  }

  /**
   * Create a UpdateAuthConnectionsRequestBody instance containing a \ElevenLabs\Types\UpdateBearerAuthRequest
   */
  public static function bearerAuth(\ElevenLabs\Types\UpdateBearerAuthRequest $bearerAuth): self
  {
    return new self($bearerAuth, 2);
  }

  /**
   * Create a UpdateAuthConnectionsRequestBody instance containing a \ElevenLabs\Types\UpdateOAuth2JwtRequest
   */
  public static function oauth2Jwt(\ElevenLabs\Types\UpdateOAuth2JwtRequest $oauth2Jwt): self
  {
    return new self($oauth2Jwt, 3);
  }

  // Type checking methods
  /**
   * Check if this UpdateAuthConnectionsRequestBody contains a \ElevenLabs\Types\UpdateOAuth2ClientCredsRequest
   */
  public function isOauth2ClientCredentials(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this UpdateAuthConnectionsRequestBody contains a \ElevenLabs\Types\UpdateBasicAuthRequest
   */
  public function isBasicAuth(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this UpdateAuthConnectionsRequestBody contains a \ElevenLabs\Types\UpdateBearerAuthRequest
   */
  public function isBearerAuth(): bool
  {
    return $this->typeIndex === 2;
  }

  /**
   * Check if this UpdateAuthConnectionsRequestBody contains a \ElevenLabs\Types\UpdateOAuth2JwtRequest
   */
  public function isOauth2Jwt(): bool
  {
    return $this->typeIndex === 3;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\UpdateOAuth2ClientCredsRequest value
   * @throws \RuntimeException if this UpdateAuthConnectionsRequestBody does not contain a \ElevenLabs\Types\UpdateOAuth2ClientCredsRequest
   */
  public function asOauth2ClientCredentials(): \ElevenLabs\Types\UpdateOAuth2ClientCredsRequest
  {
    if (!$this->isOauth2ClientCredentials()) {
      throw new \RuntimeException(
        'UpdateAuthConnectionsRequestBody does not contain \ElevenLabs\Types\UpdateOAuth2ClientCredsRequest'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\UpdateBasicAuthRequest value
   * @throws \RuntimeException if this UpdateAuthConnectionsRequestBody does not contain a \ElevenLabs\Types\UpdateBasicAuthRequest
   */
  public function asBasicAuth(): \ElevenLabs\Types\UpdateBasicAuthRequest
  {
    if (!$this->isBasicAuth()) {
      throw new \RuntimeException(
        'UpdateAuthConnectionsRequestBody does not contain \ElevenLabs\Types\UpdateBasicAuthRequest'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\UpdateBearerAuthRequest value
   * @throws \RuntimeException if this UpdateAuthConnectionsRequestBody does not contain a \ElevenLabs\Types\UpdateBearerAuthRequest
   */
  public function asBearerAuth(): \ElevenLabs\Types\UpdateBearerAuthRequest
  {
    if (!$this->isBearerAuth()) {
      throw new \RuntimeException(
        'UpdateAuthConnectionsRequestBody does not contain \ElevenLabs\Types\UpdateBearerAuthRequest'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\UpdateOAuth2JwtRequest value
   * @throws \RuntimeException if this UpdateAuthConnectionsRequestBody does not contain a \ElevenLabs\Types\UpdateOAuth2JwtRequest
   */
  public function asOauth2Jwt(): \ElevenLabs\Types\UpdateOAuth2JwtRequest
  {
    if (!$this->isOauth2Jwt()) {
      throw new \RuntimeException(
        'UpdateAuthConnectionsRequestBody does not contain \ElevenLabs\Types\UpdateOAuth2JwtRequest'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\UpdateOAuth2ClientCredsRequest value
   * @return \ElevenLabs\Types\UpdateOAuth2ClientCredsRequest|null Returns the value if this UpdateAuthConnectionsRequestBody contains a \ElevenLabs\Types\UpdateOAuth2ClientCredsRequest, null otherwise
   */
  public function tryAsOauth2ClientCredentials(): ?\ElevenLabs\Types\UpdateOAuth2ClientCredsRequest
  {
    return $this->isOauth2ClientCredentials() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\UpdateBasicAuthRequest value
   * @return \ElevenLabs\Types\UpdateBasicAuthRequest|null Returns the value if this UpdateAuthConnectionsRequestBody contains a \ElevenLabs\Types\UpdateBasicAuthRequest, null otherwise
   */
  public function tryAsBasicAuth(): ?\ElevenLabs\Types\UpdateBasicAuthRequest
  {
    return $this->isBasicAuth() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\UpdateBearerAuthRequest value
   * @return \ElevenLabs\Types\UpdateBearerAuthRequest|null Returns the value if this UpdateAuthConnectionsRequestBody contains a \ElevenLabs\Types\UpdateBearerAuthRequest, null otherwise
   */
  public function tryAsBearerAuth(): ?\ElevenLabs\Types\UpdateBearerAuthRequest
  {
    return $this->isBearerAuth() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\UpdateOAuth2JwtRequest value
   * @return \ElevenLabs\Types\UpdateOAuth2JwtRequest|null Returns the value if this UpdateAuthConnectionsRequestBody contains a \ElevenLabs\Types\UpdateOAuth2JwtRequest, null otherwise
   */
  public function tryAsOauth2Jwt(): ?\ElevenLabs\Types\UpdateOAuth2JwtRequest
  {
    return $this->isOauth2Jwt() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\UpdateOAuth2ClientCredsRequest): T $onOauth2ClientCredentials
   * @param callable(\ElevenLabs\Types\UpdateBasicAuthRequest): T $onBasicAuth
   * @param callable(\ElevenLabs\Types\UpdateBearerAuthRequest): T $onBearerAuth
   * @param callable(\ElevenLabs\Types\UpdateOAuth2JwtRequest): T $onOauth2Jwt
   * @return T
   */
  public function match(
    callable $onOauth2ClientCredentials,
    callable $onBasicAuth,
    callable $onBearerAuth,
    callable $onOauth2Jwt
  ): mixed {
    return match ($this->typeIndex) {
      0 => $onOauth2ClientCredentials($this->value),
      1 => $onBasicAuth($this->value),
      2 => $onBearerAuth($this->value),
      3 => $onOauth2Jwt($this->value),
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
          return new self(\ElevenLabs\Types\UpdateOAuth2ClientCredsRequest::fromArray($data), 0);
        case 'basic_auth':
          return new self(\ElevenLabs\Types\UpdateBasicAuthRequest::fromArray($data), 1);
        case 'bearer_auth':
          return new self(\ElevenLabs\Types\UpdateBearerAuthRequest::fromArray($data), 2);
        case 'oauth2_jwt':
          return new self(\ElevenLabs\Types\UpdateOAuth2JwtRequest::fromArray($data), 3);
        default:
          // A variant the API added after this SDK was generated: kept, not rejected.
          return new self($data, self::UNKNOWN);
      }
    }

    /** @var list<array{instance: mixed, idx: int, score: int}> */
    $candidates = [];
    try {
      $candidate = \ElevenLabs\Types\UpdateOAuth2ClientCredsRequest::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\UpdateOAuth2ClientCredsRequest didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\UpdateBasicAuthRequest::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\UpdateBasicAuthRequest didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\UpdateBearerAuthRequest::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\UpdateBearerAuthRequest didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\UpdateOAuth2JwtRequest::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 3, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\UpdateOAuth2JwtRequest didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException(
        'Data does not match any UpdateAuthConnectionsRequestBody type'
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
