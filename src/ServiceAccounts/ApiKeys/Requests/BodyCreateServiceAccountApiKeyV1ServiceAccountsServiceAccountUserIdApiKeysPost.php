<?php

declare(strict_types=1);

namespace ElevenLabs\ServiceAccounts\ApiKeys\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Core\Types\Union;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyCreateServiceAccountApiKeyV1ServiceAccountsServiceAccountUserIdApiKeysPost extends
  JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * The permissions of the XI API.
   */
  #[JsonProperty('permissions', required: true), Union('string', ['string'])]
  public array|string $permissions;

  /**
   * The character limit of the XI API key. If provided this will limit the usage of this api key to n characters per month where n is the chosen value. Requests that incur charges will fail after reaching this monthly limit.
   */
  #[JsonProperty('character_limit')]
  public ?int $characterLimit;

  /**
   * @var string[]|null
   * List of IP addresses or CIDR ranges allowed to use this API key. Each entry may be a CIDR range (e.g. '10.0.0.0/24') or a bare IP address (normalized to /32 or /128). On create, omit or pass null to allow all IPs. On update, omit to leave the allowlist unchanged, or pass "clear" to remove it.
   */
  #[JsonProperty('allowed_ips'), ArrayType(['string'])]
  public ?array $allowedIps;

  /**
   * Whether the holder of this key may disable it via the self-disable endpoint. On create, omit or pass null to use the workspace's default (enabled for non-Enterprise plans, disabled for Enterprise plans). On update, omit to leave it unchanged, or pass "clear" to reset it to the workspace default. Only honored for workspaces with self-disable access enabled.
   */
  #[JsonProperty('third_party_disable_allowed')]
  public ?bool $thirdPartyDisableAllowed;

  /**
   * Maximum concurrent text-to-speech/speech-to-speech requests for this API key. Only available for enterprise customers.
   */
  #[JsonProperty('tts_concurrency_limit')]
  public ?int $ttsConcurrencyLimit;

  /**
   * Maximum concurrent dubbing requests for this API key. Only available for enterprise customers.
   */
  #[JsonProperty('dubbing_concurrency_limit')]
  public ?int $dubbingConcurrencyLimit;

  /**
   * Maximum concurrent music generation requests for this API key. Only available for enterprise customers.
   */
  #[JsonProperty('music_concurrency_limit')]
  public ?int $musicConcurrencyLimit;

  /**
   * Unix timestamp (in seconds) after which this API key stops working. When set, it must be at least 15 minutes and at most 90 days in the future. On create, omit or pass null for a key that never expires. On update, omit to leave it unchanged, or pass "clear" to remove the expiry (never expires). A workspace may disallow never-expiring keys, or allow them only on service account API keys; creating one or clearing an expiry then fails.
   */
  #[JsonProperty('expires_at_unix')]
  public ?int $expiresAtUnix;

  /**
   * @param array{
   *   name: string,
   *   permissions: array|string,
   *   characterLimit?: ?int,
   *   allowedIps?: string[]|null,
   *   thirdPartyDisableAllowed?: ?bool,
   *   ttsConcurrencyLimit?: ?int,
   *   dubbingConcurrencyLimit?: ?int,
   *   musicConcurrencyLimit?: ?int,
   *   expiresAtUnix?: ?int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->name = $values['name'];
    $this->permissions = $values['permissions'];
    $this->characterLimit = $values['characterLimit'] ?? null;
    $this->allowedIps = $values['allowedIps'] ?? null;
    $this->thirdPartyDisableAllowed = $values['thirdPartyDisableAllowed'] ?? null;
    $this->ttsConcurrencyLimit = $values['ttsConcurrencyLimit'] ?? null;
    $this->dubbingConcurrencyLimit = $values['dubbingConcurrencyLimit'] ?? null;
    $this->musicConcurrencyLimit = $values['musicConcurrencyLimit'] ?? null;
    $this->expiresAtUnix = $values['expiresAtUnix'] ?? null;

    $this->_dirtyFields = [
      'name' => true,
      'permissions' => true
    ];
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
    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    $parts[] = [
      'name' => 'permissions',
      'contents' => json_encode($this->permissions),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->characterLimit !== null) {
      $parts[] = [
        'name' => 'character_limit',
        'contents' => (string) $this->characterLimit
      ];
    }

    if ($this->allowedIps !== null) {
      foreach ($this->allowedIps ?? [] as $item) {
        $parts[] = [
          'name' => 'allowed_ips',
          'contents' => $item
        ];
      }
    }

    if ($this->thirdPartyDisableAllowed !== null) {
      $parts[] = [
        'name' => 'third_party_disable_allowed',
        'contents' => $this->thirdPartyDisableAllowed ? 'true' : 'false'
      ];
    }

    if ($this->ttsConcurrencyLimit !== null) {
      $parts[] = [
        'name' => 'tts_concurrency_limit',
        'contents' => (string) $this->ttsConcurrencyLimit
      ];
    }

    if ($this->dubbingConcurrencyLimit !== null) {
      $parts[] = [
        'name' => 'dubbing_concurrency_limit',
        'contents' => (string) $this->dubbingConcurrencyLimit
      ];
    }

    if ($this->musicConcurrencyLimit !== null) {
      $parts[] = [
        'name' => 'music_concurrency_limit',
        'contents' => (string) $this->musicConcurrencyLimit
      ];
    }

    if ($this->expiresAtUnix !== null) {
      $parts[] = [
        'name' => 'expires_at_unix',
        'contents' => (string) $this->expiresAtUnix
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateArray($this->allowedIps, 'allowed_ips', minItems: 1, maxItems: 100);
  }
}
