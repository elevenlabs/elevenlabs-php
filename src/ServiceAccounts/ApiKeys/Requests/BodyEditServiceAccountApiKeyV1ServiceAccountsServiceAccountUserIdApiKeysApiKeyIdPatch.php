<?php

declare(strict_types=1);

namespace ElevenLabs\ServiceAccounts\ApiKeys\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\Union;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyEditServiceAccountApiKeyV1ServiceAccountsServiceAccountUserIdApiKeysApiKeyIdPatch extends
  JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Whether to enable or disable the API key.
   */
  #[JsonProperty('is_enabled'), Union('bool', 'string', 'null')]
  public bool|string|null $isEnabled;

  /**
   * The name of the XI API key to use (used for identification purposes only).
   */
  #[JsonProperty('name')]
  public ?string $name;

  /**
   * The permissions of the XI API.
   */
  #[JsonProperty('permissions'), Union('string', ['string'], 'null')]
  public array|string|null $permissions;

  /**
   * The character limit of the XI API key. If provided this will limit the usage of this api key to n characters per month where n is the chosen value. Requests that incur charges will fail after reaching this monthly limit.
   */
  #[JsonProperty('character_limit'), Union('integer', 'string', 'null')]
  public int|string|null $characterLimit;

  /**
   * List of IP addresses or CIDR ranges allowed to use this API key. Each entry may be a CIDR range (e.g. '10.0.0.0/24') or a bare IP address (normalized to /32 or /128). On create, omit or pass null to allow all IPs. On update, omit to leave the allowlist unchanged, or pass "clear" to remove it.
   */
  #[JsonProperty('allowed_ips'), Union('string', ['string'], 'null')]
  public array|string|null $allowedIps;

  /**
   * Whether the holder of this key may disable it via the self-disable endpoint. On create, omit or pass null to use the workspace's default (enabled for non-Enterprise plans, disabled for Enterprise plans). On update, omit to leave it unchanged, or pass "clear" to reset it to the workspace default. Only honored for workspaces with self-disable access enabled.
   */
  #[JsonProperty('third_party_disable_allowed'), Union('bool', 'string', 'null')]
  public bool|string|null $thirdPartyDisableAllowed;

  /**
   * Maximum concurrent text-to-speech/speech-to-speech requests for this API key. Only available for enterprise customers.
   */
  #[JsonProperty('tts_concurrency_limit'), Union('integer', 'string', 'null')]
  public int|string|null $ttsConcurrencyLimit;

  /**
   * Maximum concurrent dubbing requests for this API key. Only available for enterprise customers.
   */
  #[JsonProperty('dubbing_concurrency_limit'), Union('integer', 'string', 'null')]
  public int|string|null $dubbingConcurrencyLimit;

  /**
   * Maximum concurrent music generation requests for this API key. Only available for enterprise customers.
   */
  #[JsonProperty('music_concurrency_limit'), Union('integer', 'string', 'null')]
  public int|string|null $musicConcurrencyLimit;

  /**
   * Unix timestamp (in seconds) after which this API key stops working. When set, it must be at least 15 minutes and at most 90 days in the future. On create, omit or pass null for a key that never expires. On update, omit to leave it unchanged, or pass "clear" to remove the expiry (never expires). A workspace may disallow never-expiring keys, or allow them only on service account API keys; creating one or clearing an expiry then fails.
   */
  #[JsonProperty('expires_at_unix'), Union('integer', 'string', 'null')]
  public int|string|null $expiresAtUnix;

  /**
   * @param array{
   *   isEnabled?: bool|string|null,
   *   name?: ?string,
   *   permissions?: array|string|null,
   *   characterLimit?: int|string|null,
   *   allowedIps?: array|string|null,
   *   thirdPartyDisableAllowed?: bool|string|null,
   *   ttsConcurrencyLimit?: int|string|null,
   *   dubbingConcurrencyLimit?: int|string|null,
   *   musicConcurrencyLimit?: int|string|null,
   *   expiresAtUnix?: int|string|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->isEnabled = $values['isEnabled'] ?? null;
    $this->name = $values['name'] ?? null;
    $this->permissions = $values['permissions'] ?? null;
    $this->characterLimit = $values['characterLimit'] ?? null;
    $this->allowedIps = $values['allowedIps'] ?? null;
    $this->thirdPartyDisableAllowed = $values['thirdPartyDisableAllowed'] ?? null;
    $this->ttsConcurrencyLimit = $values['ttsConcurrencyLimit'] ?? null;
    $this->dubbingConcurrencyLimit = $values['dubbingConcurrencyLimit'] ?? null;
    $this->musicConcurrencyLimit = $values['musicConcurrencyLimit'] ?? null;
    $this->expiresAtUnix = $values['expiresAtUnix'] ?? null;

    if (array_key_exists('isEnabled', $values)) {
      $this->_dirtyFields['is_enabled'] = true;
    }
    if (array_key_exists('name', $values)) {
      $this->_dirtyFields['name'] = true;
    }
    if (array_key_exists('permissions', $values)) {
      $this->_dirtyFields['permissions'] = true;
    }
    if (array_key_exists('characterLimit', $values)) {
      $this->_dirtyFields['character_limit'] = true;
    }
    if (array_key_exists('allowedIps', $values)) {
      $this->_dirtyFields['allowed_ips'] = true;
    }
    if (array_key_exists('thirdPartyDisableAllowed', $values)) {
      $this->_dirtyFields['third_party_disable_allowed'] = true;
    }
    if (array_key_exists('ttsConcurrencyLimit', $values)) {
      $this->_dirtyFields['tts_concurrency_limit'] = true;
    }
    if (array_key_exists('dubbingConcurrencyLimit', $values)) {
      $this->_dirtyFields['dubbing_concurrency_limit'] = true;
    }
    if (array_key_exists('musicConcurrencyLimit', $values)) {
      $this->_dirtyFields['music_concurrency_limit'] = true;
    }
    if (array_key_exists('expiresAtUnix', $values)) {
      $this->_dirtyFields['expires_at_unix'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->isEnabled !== null) {
      $parts[] = [
        'name' => 'is_enabled',
        'contents' => json_encode($this->isEnabled),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->name !== null) {
      $parts[] = [
        'name' => 'name',
        'contents' => $this->name
      ];
    }

    if ($this->permissions !== null) {
      $parts[] = [
        'name' => 'permissions',
        'contents' => json_encode($this->permissions),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->characterLimit !== null) {
      $parts[] = [
        'name' => 'character_limit',
        'contents' => json_encode($this->characterLimit),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->allowedIps !== null) {
      $parts[] = [
        'name' => 'allowed_ips',
        'contents' => json_encode($this->allowedIps),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->thirdPartyDisableAllowed !== null) {
      $parts[] = [
        'name' => 'third_party_disable_allowed',
        'contents' => json_encode($this->thirdPartyDisableAllowed),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->ttsConcurrencyLimit !== null) {
      $parts[] = [
        'name' => 'tts_concurrency_limit',
        'contents' => json_encode($this->ttsConcurrencyLimit),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->dubbingConcurrencyLimit !== null) {
      $parts[] = [
        'name' => 'dubbing_concurrency_limit',
        'contents' => json_encode($this->dubbingConcurrencyLimit),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->musicConcurrencyLimit !== null) {
      $parts[] = [
        'name' => 'music_concurrency_limit',
        'contents' => json_encode($this->musicConcurrencyLimit),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->expiresAtUnix !== null) {
      $parts[] = [
        'name' => 'expires_at_unix',
        'contents' => json_encode($this->expiresAtUnix),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
