<?php

declare(strict_types=1);

namespace ElevenLabs\Workspace\AuthConnections\Types;

use ElevenLabs\Core\Json\JsonSerializableType;

/**
 * The type of auth connection config
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
class CreateAuthConnectionsResponse extends JsonSerializableType
{
  /**
   * @var string The discriminator value identifying which variant is stored
   */
  public readonly string $authType;

  /**
   * @var \ElevenLabs\Types\OAuth2ClientCredsResponse|\ElevenLabs\Types\RefreshTokenAuthResponse|\ElevenLabs\Types\BasicAuthResponse|\ElevenLabs\Types\BearerAuthResponse|\ElevenLabs\Types\OAuth2JwtResponse|\ElevenLabs\Types\PrivateKeyJwtResponse|\ElevenLabs\Types\MtlsAuthResponse|\ElevenLabs\Types\CustomHeaderAuthResponse|\ElevenLabs\Types\ApiIntegrationOAuth2AuthCodeResponse|\ElevenLabs\Types\ApiIntegrationOAuth2CustomAppResponse|\ElevenLabs\Types\WhatsAppAuthResponse|\ElevenLabs\Types\SlackBotAuthResponse|\ElevenLabs\Types\UrlSecretAuthResponse|array<string, mixed> The value, exactly one of the variant types
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
   * @throws \RuntimeException if this CreateAuthConnectionsResponse holds a known variant
   */
  public function _asUnknown(): array
  {
    if (!$this->_isUnknown()) {
      throw new \RuntimeException(
        'CreateAuthConnectionsResponse does not contain an unknown variant'
      );
    }
    /** @var array<string, mixed> $value */
    $value = $this->value;
    return $value;
  }

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\OAuth2ClientCredsResponse|\ElevenLabs\Types\RefreshTokenAuthResponse|\ElevenLabs\Types\BasicAuthResponse|\ElevenLabs\Types\BearerAuthResponse|\ElevenLabs\Types\OAuth2JwtResponse|\ElevenLabs\Types\PrivateKeyJwtResponse|\ElevenLabs\Types\MtlsAuthResponse|\ElevenLabs\Types\CustomHeaderAuthResponse|\ElevenLabs\Types\ApiIntegrationOAuth2AuthCodeResponse|\ElevenLabs\Types\ApiIntegrationOAuth2CustomAppResponse|\ElevenLabs\Types\WhatsAppAuthResponse|\ElevenLabs\Types\SlackBotAuthResponse|\ElevenLabs\Types\UrlSecretAuthResponse|array<string, mixed> $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
    $this->authType = match ($typeIndex) {
      0 => 'oauth2_client_credentials',
      1 => 'refresh_token_auth',
      2 => 'basic_auth',
      3 => 'bearer_auth',
      4 => 'oauth2_jwt',
      5 => 'private_key_jwt',
      6 => 'mtls',
      7 => 'custom_header_auth',
      8 => 'api_integration_oauth2_auth_code',
      9 => 'api_integration_oauth2_custom_app',
      10 => 'whatsapp_auth',
      11 => 'slack_bot_auth',
      12 => 'url_secret',
      self::UNKNOWN => '_unknown',
      default => throw new \UnexpectedValueException("Unknown type index: $typeIndex")
    };
  }

  // Factory methods
  /**
   * Create a CreateAuthConnectionsResponse instance containing a \ElevenLabs\Types\OAuth2ClientCredsResponse
   */
  public static function oauth2ClientCredentials(
    \ElevenLabs\Types\OAuth2ClientCredsResponse $oauth2ClientCredentials
  ): self {
    return new self($oauth2ClientCredentials, 0);
  }

  /**
   * Create a CreateAuthConnectionsResponse instance containing a \ElevenLabs\Types\RefreshTokenAuthResponse
   */
  public static function refreshTokenAuth(
    \ElevenLabs\Types\RefreshTokenAuthResponse $refreshTokenAuth
  ): self {
    return new self($refreshTokenAuth, 1);
  }

  /**
   * Create a CreateAuthConnectionsResponse instance containing a \ElevenLabs\Types\BasicAuthResponse
   */
  public static function basicAuth(\ElevenLabs\Types\BasicAuthResponse $basicAuth): self
  {
    return new self($basicAuth, 2);
  }

  /**
   * Create a CreateAuthConnectionsResponse instance containing a \ElevenLabs\Types\BearerAuthResponse
   */
  public static function bearerAuth(\ElevenLabs\Types\BearerAuthResponse $bearerAuth): self
  {
    return new self($bearerAuth, 3);
  }

  /**
   * Create a CreateAuthConnectionsResponse instance containing a \ElevenLabs\Types\OAuth2JwtResponse
   */
  public static function oauth2Jwt(\ElevenLabs\Types\OAuth2JwtResponse $oauth2Jwt): self
  {
    return new self($oauth2Jwt, 4);
  }

  /**
   * Create a CreateAuthConnectionsResponse instance containing a \ElevenLabs\Types\PrivateKeyJwtResponse
   */
  public static function privateKeyJwt(\ElevenLabs\Types\PrivateKeyJwtResponse $privateKeyJwt): self
  {
    return new self($privateKeyJwt, 5);
  }

  /**
   * Create a CreateAuthConnectionsResponse instance containing a \ElevenLabs\Types\MtlsAuthResponse
   */
  public static function mtls(\ElevenLabs\Types\MtlsAuthResponse $mtls): self
  {
    return new self($mtls, 6);
  }

  /**
   * Create a CreateAuthConnectionsResponse instance containing a \ElevenLabs\Types\CustomHeaderAuthResponse
   */
  public static function customHeaderAuth(
    \ElevenLabs\Types\CustomHeaderAuthResponse $customHeaderAuth
  ): self {
    return new self($customHeaderAuth, 7);
  }

  /**
   * Create a CreateAuthConnectionsResponse instance containing a \ElevenLabs\Types\ApiIntegrationOAuth2AuthCodeResponse
   */
  public static function apiIntegrationOauth2AuthCode(
    \ElevenLabs\Types\ApiIntegrationOAuth2AuthCodeResponse $apiIntegrationOauth2AuthCode
  ): self {
    return new self($apiIntegrationOauth2AuthCode, 8);
  }

  /**
   * Create a CreateAuthConnectionsResponse instance containing a \ElevenLabs\Types\ApiIntegrationOAuth2CustomAppResponse
   */
  public static function apiIntegrationOauth2CustomApp(
    \ElevenLabs\Types\ApiIntegrationOAuth2CustomAppResponse $apiIntegrationOauth2CustomApp
  ): self {
    return new self($apiIntegrationOauth2CustomApp, 9);
  }

  /**
   * Create a CreateAuthConnectionsResponse instance containing a \ElevenLabs\Types\WhatsAppAuthResponse
   */
  public static function whatsappAuth(\ElevenLabs\Types\WhatsAppAuthResponse $whatsappAuth): self
  {
    return new self($whatsappAuth, 10);
  }

  /**
   * Create a CreateAuthConnectionsResponse instance containing a \ElevenLabs\Types\SlackBotAuthResponse
   */
  public static function slackBotAuth(\ElevenLabs\Types\SlackBotAuthResponse $slackBotAuth): self
  {
    return new self($slackBotAuth, 11);
  }

  /**
   * Create a CreateAuthConnectionsResponse instance containing a \ElevenLabs\Types\UrlSecretAuthResponse
   */
  public static function urlSecret(\ElevenLabs\Types\UrlSecretAuthResponse $urlSecret): self
  {
    return new self($urlSecret, 12);
  }

  // Type checking methods
  /**
   * Check if this CreateAuthConnectionsResponse contains a \ElevenLabs\Types\OAuth2ClientCredsResponse
   */
  public function isOauth2ClientCredentials(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this CreateAuthConnectionsResponse contains a \ElevenLabs\Types\RefreshTokenAuthResponse
   */
  public function isRefreshTokenAuth(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this CreateAuthConnectionsResponse contains a \ElevenLabs\Types\BasicAuthResponse
   */
  public function isBasicAuth(): bool
  {
    return $this->typeIndex === 2;
  }

  /**
   * Check if this CreateAuthConnectionsResponse contains a \ElevenLabs\Types\BearerAuthResponse
   */
  public function isBearerAuth(): bool
  {
    return $this->typeIndex === 3;
  }

  /**
   * Check if this CreateAuthConnectionsResponse contains a \ElevenLabs\Types\OAuth2JwtResponse
   */
  public function isOauth2Jwt(): bool
  {
    return $this->typeIndex === 4;
  }

  /**
   * Check if this CreateAuthConnectionsResponse contains a \ElevenLabs\Types\PrivateKeyJwtResponse
   */
  public function isPrivateKeyJwt(): bool
  {
    return $this->typeIndex === 5;
  }

  /**
   * Check if this CreateAuthConnectionsResponse contains a \ElevenLabs\Types\MtlsAuthResponse
   */
  public function isMtls(): bool
  {
    return $this->typeIndex === 6;
  }

  /**
   * Check if this CreateAuthConnectionsResponse contains a \ElevenLabs\Types\CustomHeaderAuthResponse
   */
  public function isCustomHeaderAuth(): bool
  {
    return $this->typeIndex === 7;
  }

  /**
   * Check if this CreateAuthConnectionsResponse contains a \ElevenLabs\Types\ApiIntegrationOAuth2AuthCodeResponse
   */
  public function isApiIntegrationOauth2AuthCode(): bool
  {
    return $this->typeIndex === 8;
  }

  /**
   * Check if this CreateAuthConnectionsResponse contains a \ElevenLabs\Types\ApiIntegrationOAuth2CustomAppResponse
   */
  public function isApiIntegrationOauth2CustomApp(): bool
  {
    return $this->typeIndex === 9;
  }

  /**
   * Check if this CreateAuthConnectionsResponse contains a \ElevenLabs\Types\WhatsAppAuthResponse
   */
  public function isWhatsappAuth(): bool
  {
    return $this->typeIndex === 10;
  }

  /**
   * Check if this CreateAuthConnectionsResponse contains a \ElevenLabs\Types\SlackBotAuthResponse
   */
  public function isSlackBotAuth(): bool
  {
    return $this->typeIndex === 11;
  }

  /**
   * Check if this CreateAuthConnectionsResponse contains a \ElevenLabs\Types\UrlSecretAuthResponse
   */
  public function isUrlSecret(): bool
  {
    return $this->typeIndex === 12;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\OAuth2ClientCredsResponse value
   * @throws \RuntimeException if this CreateAuthConnectionsResponse does not contain a \ElevenLabs\Types\OAuth2ClientCredsResponse
   */
  public function asOauth2ClientCredentials(): \ElevenLabs\Types\OAuth2ClientCredsResponse
  {
    if (!$this->isOauth2ClientCredentials()) {
      throw new \RuntimeException(
        'CreateAuthConnectionsResponse does not contain \ElevenLabs\Types\OAuth2ClientCredsResponse'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\RefreshTokenAuthResponse value
   * @throws \RuntimeException if this CreateAuthConnectionsResponse does not contain a \ElevenLabs\Types\RefreshTokenAuthResponse
   */
  public function asRefreshTokenAuth(): \ElevenLabs\Types\RefreshTokenAuthResponse
  {
    if (!$this->isRefreshTokenAuth()) {
      throw new \RuntimeException(
        'CreateAuthConnectionsResponse does not contain \ElevenLabs\Types\RefreshTokenAuthResponse'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\BasicAuthResponse value
   * @throws \RuntimeException if this CreateAuthConnectionsResponse does not contain a \ElevenLabs\Types\BasicAuthResponse
   */
  public function asBasicAuth(): \ElevenLabs\Types\BasicAuthResponse
  {
    if (!$this->isBasicAuth()) {
      throw new \RuntimeException(
        'CreateAuthConnectionsResponse does not contain \ElevenLabs\Types\BasicAuthResponse'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\BearerAuthResponse value
   * @throws \RuntimeException if this CreateAuthConnectionsResponse does not contain a \ElevenLabs\Types\BearerAuthResponse
   */
  public function asBearerAuth(): \ElevenLabs\Types\BearerAuthResponse
  {
    if (!$this->isBearerAuth()) {
      throw new \RuntimeException(
        'CreateAuthConnectionsResponse does not contain \ElevenLabs\Types\BearerAuthResponse'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\OAuth2JwtResponse value
   * @throws \RuntimeException if this CreateAuthConnectionsResponse does not contain a \ElevenLabs\Types\OAuth2JwtResponse
   */
  public function asOauth2Jwt(): \ElevenLabs\Types\OAuth2JwtResponse
  {
    if (!$this->isOauth2Jwt()) {
      throw new \RuntimeException(
        'CreateAuthConnectionsResponse does not contain \ElevenLabs\Types\OAuth2JwtResponse'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\PrivateKeyJwtResponse value
   * @throws \RuntimeException if this CreateAuthConnectionsResponse does not contain a \ElevenLabs\Types\PrivateKeyJwtResponse
   */
  public function asPrivateKeyJwt(): \ElevenLabs\Types\PrivateKeyJwtResponse
  {
    if (!$this->isPrivateKeyJwt()) {
      throw new \RuntimeException(
        'CreateAuthConnectionsResponse does not contain \ElevenLabs\Types\PrivateKeyJwtResponse'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\MtlsAuthResponse value
   * @throws \RuntimeException if this CreateAuthConnectionsResponse does not contain a \ElevenLabs\Types\MtlsAuthResponse
   */
  public function asMtls(): \ElevenLabs\Types\MtlsAuthResponse
  {
    if (!$this->isMtls()) {
      throw new \RuntimeException(
        'CreateAuthConnectionsResponse does not contain \ElevenLabs\Types\MtlsAuthResponse'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\CustomHeaderAuthResponse value
   * @throws \RuntimeException if this CreateAuthConnectionsResponse does not contain a \ElevenLabs\Types\CustomHeaderAuthResponse
   */
  public function asCustomHeaderAuth(): \ElevenLabs\Types\CustomHeaderAuthResponse
  {
    if (!$this->isCustomHeaderAuth()) {
      throw new \RuntimeException(
        'CreateAuthConnectionsResponse does not contain \ElevenLabs\Types\CustomHeaderAuthResponse'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ApiIntegrationOAuth2AuthCodeResponse value
   * @throws \RuntimeException if this CreateAuthConnectionsResponse does not contain a \ElevenLabs\Types\ApiIntegrationOAuth2AuthCodeResponse
   */
  public function asApiIntegrationOauth2AuthCode(): \ElevenLabs\Types\ApiIntegrationOAuth2AuthCodeResponse
  {
    if (!$this->isApiIntegrationOauth2AuthCode()) {
      throw new \RuntimeException(
        'CreateAuthConnectionsResponse does not contain \ElevenLabs\Types\ApiIntegrationOAuth2AuthCodeResponse'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ApiIntegrationOAuth2CustomAppResponse value
   * @throws \RuntimeException if this CreateAuthConnectionsResponse does not contain a \ElevenLabs\Types\ApiIntegrationOAuth2CustomAppResponse
   */
  public function asApiIntegrationOauth2CustomApp(): \ElevenLabs\Types\ApiIntegrationOAuth2CustomAppResponse
  {
    if (!$this->isApiIntegrationOauth2CustomApp()) {
      throw new \RuntimeException(
        'CreateAuthConnectionsResponse does not contain \ElevenLabs\Types\ApiIntegrationOAuth2CustomAppResponse'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\WhatsAppAuthResponse value
   * @throws \RuntimeException if this CreateAuthConnectionsResponse does not contain a \ElevenLabs\Types\WhatsAppAuthResponse
   */
  public function asWhatsappAuth(): \ElevenLabs\Types\WhatsAppAuthResponse
  {
    if (!$this->isWhatsappAuth()) {
      throw new \RuntimeException(
        'CreateAuthConnectionsResponse does not contain \ElevenLabs\Types\WhatsAppAuthResponse'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\SlackBotAuthResponse value
   * @throws \RuntimeException if this CreateAuthConnectionsResponse does not contain a \ElevenLabs\Types\SlackBotAuthResponse
   */
  public function asSlackBotAuth(): \ElevenLabs\Types\SlackBotAuthResponse
  {
    if (!$this->isSlackBotAuth()) {
      throw new \RuntimeException(
        'CreateAuthConnectionsResponse does not contain \ElevenLabs\Types\SlackBotAuthResponse'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\UrlSecretAuthResponse value
   * @throws \RuntimeException if this CreateAuthConnectionsResponse does not contain a \ElevenLabs\Types\UrlSecretAuthResponse
   */
  public function asUrlSecret(): \ElevenLabs\Types\UrlSecretAuthResponse
  {
    if (!$this->isUrlSecret()) {
      throw new \RuntimeException(
        'CreateAuthConnectionsResponse does not contain \ElevenLabs\Types\UrlSecretAuthResponse'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\OAuth2ClientCredsResponse value
   * @return \ElevenLabs\Types\OAuth2ClientCredsResponse|null Returns the value if this CreateAuthConnectionsResponse contains a \ElevenLabs\Types\OAuth2ClientCredsResponse, null otherwise
   */
  public function tryAsOauth2ClientCredentials(): ?\ElevenLabs\Types\OAuth2ClientCredsResponse
  {
    return $this->isOauth2ClientCredentials() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\RefreshTokenAuthResponse value
   * @return \ElevenLabs\Types\RefreshTokenAuthResponse|null Returns the value if this CreateAuthConnectionsResponse contains a \ElevenLabs\Types\RefreshTokenAuthResponse, null otherwise
   */
  public function tryAsRefreshTokenAuth(): ?\ElevenLabs\Types\RefreshTokenAuthResponse
  {
    return $this->isRefreshTokenAuth() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\BasicAuthResponse value
   * @return \ElevenLabs\Types\BasicAuthResponse|null Returns the value if this CreateAuthConnectionsResponse contains a \ElevenLabs\Types\BasicAuthResponse, null otherwise
   */
  public function tryAsBasicAuth(): ?\ElevenLabs\Types\BasicAuthResponse
  {
    return $this->isBasicAuth() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\BearerAuthResponse value
   * @return \ElevenLabs\Types\BearerAuthResponse|null Returns the value if this CreateAuthConnectionsResponse contains a \ElevenLabs\Types\BearerAuthResponse, null otherwise
   */
  public function tryAsBearerAuth(): ?\ElevenLabs\Types\BearerAuthResponse
  {
    return $this->isBearerAuth() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\OAuth2JwtResponse value
   * @return \ElevenLabs\Types\OAuth2JwtResponse|null Returns the value if this CreateAuthConnectionsResponse contains a \ElevenLabs\Types\OAuth2JwtResponse, null otherwise
   */
  public function tryAsOauth2Jwt(): ?\ElevenLabs\Types\OAuth2JwtResponse
  {
    return $this->isOauth2Jwt() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\PrivateKeyJwtResponse value
   * @return \ElevenLabs\Types\PrivateKeyJwtResponse|null Returns the value if this CreateAuthConnectionsResponse contains a \ElevenLabs\Types\PrivateKeyJwtResponse, null otherwise
   */
  public function tryAsPrivateKeyJwt(): ?\ElevenLabs\Types\PrivateKeyJwtResponse
  {
    return $this->isPrivateKeyJwt() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\MtlsAuthResponse value
   * @return \ElevenLabs\Types\MtlsAuthResponse|null Returns the value if this CreateAuthConnectionsResponse contains a \ElevenLabs\Types\MtlsAuthResponse, null otherwise
   */
  public function tryAsMtls(): ?\ElevenLabs\Types\MtlsAuthResponse
  {
    return $this->isMtls() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\CustomHeaderAuthResponse value
   * @return \ElevenLabs\Types\CustomHeaderAuthResponse|null Returns the value if this CreateAuthConnectionsResponse contains a \ElevenLabs\Types\CustomHeaderAuthResponse, null otherwise
   */
  public function tryAsCustomHeaderAuth(): ?\ElevenLabs\Types\CustomHeaderAuthResponse
  {
    return $this->isCustomHeaderAuth() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ApiIntegrationOAuth2AuthCodeResponse value
   * @return \ElevenLabs\Types\ApiIntegrationOAuth2AuthCodeResponse|null Returns the value if this CreateAuthConnectionsResponse contains a \ElevenLabs\Types\ApiIntegrationOAuth2AuthCodeResponse, null otherwise
   */
  public function tryAsApiIntegrationOauth2AuthCode(): ?\ElevenLabs\Types\ApiIntegrationOAuth2AuthCodeResponse
  {
    return $this->isApiIntegrationOauth2AuthCode() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ApiIntegrationOAuth2CustomAppResponse value
   * @return \ElevenLabs\Types\ApiIntegrationOAuth2CustomAppResponse|null Returns the value if this CreateAuthConnectionsResponse contains a \ElevenLabs\Types\ApiIntegrationOAuth2CustomAppResponse, null otherwise
   */
  public function tryAsApiIntegrationOauth2CustomApp(): ?\ElevenLabs\Types\ApiIntegrationOAuth2CustomAppResponse
  {
    return $this->isApiIntegrationOauth2CustomApp() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\WhatsAppAuthResponse value
   * @return \ElevenLabs\Types\WhatsAppAuthResponse|null Returns the value if this CreateAuthConnectionsResponse contains a \ElevenLabs\Types\WhatsAppAuthResponse, null otherwise
   */
  public function tryAsWhatsappAuth(): ?\ElevenLabs\Types\WhatsAppAuthResponse
  {
    return $this->isWhatsappAuth() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\SlackBotAuthResponse value
   * @return \ElevenLabs\Types\SlackBotAuthResponse|null Returns the value if this CreateAuthConnectionsResponse contains a \ElevenLabs\Types\SlackBotAuthResponse, null otherwise
   */
  public function tryAsSlackBotAuth(): ?\ElevenLabs\Types\SlackBotAuthResponse
  {
    return $this->isSlackBotAuth() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\UrlSecretAuthResponse value
   * @return \ElevenLabs\Types\UrlSecretAuthResponse|null Returns the value if this CreateAuthConnectionsResponse contains a \ElevenLabs\Types\UrlSecretAuthResponse, null otherwise
   */
  public function tryAsUrlSecret(): ?\ElevenLabs\Types\UrlSecretAuthResponse
  {
    return $this->isUrlSecret() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\OAuth2ClientCredsResponse): T $onOauth2ClientCredentials
   * @param callable(\ElevenLabs\Types\RefreshTokenAuthResponse): T $onRefreshTokenAuth
   * @param callable(\ElevenLabs\Types\BasicAuthResponse): T $onBasicAuth
   * @param callable(\ElevenLabs\Types\BearerAuthResponse): T $onBearerAuth
   * @param callable(\ElevenLabs\Types\OAuth2JwtResponse): T $onOauth2Jwt
   * @param callable(\ElevenLabs\Types\PrivateKeyJwtResponse): T $onPrivateKeyJwt
   * @param callable(\ElevenLabs\Types\MtlsAuthResponse): T $onMtls
   * @param callable(\ElevenLabs\Types\CustomHeaderAuthResponse): T $onCustomHeaderAuth
   * @param callable(\ElevenLabs\Types\ApiIntegrationOAuth2AuthCodeResponse): T $onApiIntegrationOauth2AuthCode
   * @param callable(\ElevenLabs\Types\ApiIntegrationOAuth2CustomAppResponse): T $onApiIntegrationOauth2CustomApp
   * @param callable(\ElevenLabs\Types\WhatsAppAuthResponse): T $onWhatsappAuth
   * @param callable(\ElevenLabs\Types\SlackBotAuthResponse): T $onSlackBotAuth
   * @param callable(\ElevenLabs\Types\UrlSecretAuthResponse): T $onUrlSecret
   * @return T
   */
  public function match(
    callable $onOauth2ClientCredentials,
    callable $onRefreshTokenAuth,
    callable $onBasicAuth,
    callable $onBearerAuth,
    callable $onOauth2Jwt,
    callable $onPrivateKeyJwt,
    callable $onMtls,
    callable $onCustomHeaderAuth,
    callable $onApiIntegrationOauth2AuthCode,
    callable $onApiIntegrationOauth2CustomApp,
    callable $onWhatsappAuth,
    callable $onSlackBotAuth,
    callable $onUrlSecret
  ): mixed {
    return match ($this->typeIndex) {
      0 => $onOauth2ClientCredentials($this->value),
      1 => $onRefreshTokenAuth($this->value),
      2 => $onBasicAuth($this->value),
      3 => $onBearerAuth($this->value),
      4 => $onOauth2Jwt($this->value),
      5 => $onPrivateKeyJwt($this->value),
      6 => $onMtls($this->value),
      7 => $onCustomHeaderAuth($this->value),
      8 => $onApiIntegrationOauth2AuthCode($this->value),
      9 => $onApiIntegrationOauth2CustomApp($this->value),
      10 => $onWhatsappAuth($this->value),
      11 => $onSlackBotAuth($this->value),
      12 => $onUrlSecret($this->value),
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
          return new self(\ElevenLabs\Types\OAuth2ClientCredsResponse::fromArray($data), 0);
        case 'refresh_token_auth':
          return new self(\ElevenLabs\Types\RefreshTokenAuthResponse::fromArray($data), 1);
        case 'basic_auth':
          return new self(\ElevenLabs\Types\BasicAuthResponse::fromArray($data), 2);
        case 'bearer_auth':
          return new self(\ElevenLabs\Types\BearerAuthResponse::fromArray($data), 3);
        case 'oauth2_jwt':
          return new self(\ElevenLabs\Types\OAuth2JwtResponse::fromArray($data), 4);
        case 'private_key_jwt':
          return new self(\ElevenLabs\Types\PrivateKeyJwtResponse::fromArray($data), 5);
        case 'mtls':
          return new self(\ElevenLabs\Types\MtlsAuthResponse::fromArray($data), 6);
        case 'custom_header_auth':
          return new self(\ElevenLabs\Types\CustomHeaderAuthResponse::fromArray($data), 7);
        case 'api_integration_oauth2_auth_code':
          return new self(
            \ElevenLabs\Types\ApiIntegrationOAuth2AuthCodeResponse::fromArray($data),
            8
          );
        case 'api_integration_oauth2_custom_app':
          return new self(
            \ElevenLabs\Types\ApiIntegrationOAuth2CustomAppResponse::fromArray($data),
            9
          );
        case 'whatsapp_auth':
          return new self(\ElevenLabs\Types\WhatsAppAuthResponse::fromArray($data), 10);
        case 'slack_bot_auth':
          return new self(\ElevenLabs\Types\SlackBotAuthResponse::fromArray($data), 11);
        case 'url_secret':
          return new self(\ElevenLabs\Types\UrlSecretAuthResponse::fromArray($data), 12);
        default:
          // A variant the API added after this SDK was generated: kept, not rejected.
          return new self($data, self::UNKNOWN);
      }
    }

    /** @var list<array{instance: mixed, idx: int, score: int}> */
    $candidates = [];
    try {
      $candidate = \ElevenLabs\Types\OAuth2ClientCredsResponse::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\OAuth2ClientCredsResponse didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\RefreshTokenAuthResponse::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\RefreshTokenAuthResponse didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\BasicAuthResponse::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\BasicAuthResponse didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\BearerAuthResponse::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 3, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\BearerAuthResponse didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\OAuth2JwtResponse::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 4, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\OAuth2JwtResponse didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\PrivateKeyJwtResponse::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 5, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\PrivateKeyJwtResponse didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\MtlsAuthResponse::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 6, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\MtlsAuthResponse didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\CustomHeaderAuthResponse::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 7, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\CustomHeaderAuthResponse didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ApiIntegrationOAuth2AuthCodeResponse::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 8, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ApiIntegrationOAuth2AuthCodeResponse didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ApiIntegrationOAuth2CustomAppResponse::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 9, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ApiIntegrationOAuth2CustomAppResponse didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\WhatsAppAuthResponse::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 10, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\WhatsAppAuthResponse didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\SlackBotAuthResponse::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 11, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\SlackBotAuthResponse didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\UrlSecretAuthResponse::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 12, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\UrlSecretAuthResponse didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException(
        'Data does not match any CreateAuthConnectionsResponse type'
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
