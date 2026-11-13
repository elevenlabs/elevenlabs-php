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
class WorkspaceApiKeyResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('name', required: true)]
  public string $name;

  #[JsonProperty('hint', required: true)]
  public string $hint;

  #[JsonProperty('key_id', required: true)]
  public string $keyId;

  #[JsonProperty('service_account_user_id', required: true)]
  public string $serviceAccountUserId;

  #[JsonProperty('created_at_unix')]
  public ?int $createdAtUnix;

  #[JsonProperty('is_disabled')]
  public ?bool $isDisabled;

  /**
   * @var array<value-of<\ElevenLabs\Types\PermissionType>>|null
   */
  #[JsonProperty('permissions'), ArrayType(['string'])]
  public ?array $permissions;

  /**
   * @var ?value-of<\ElevenLabs\Types\LockReason>
   */
  #[JsonProperty('disable_reason')]
  public ?string $disableReason;

  /**
   * Maximum number of credits allowed in the current billing period.
   */
  #[JsonProperty('character_limit')]
  public ?int $characterLimit;

  /**
   * Credits already used in the current billing period.
   */
  #[JsonProperty('character_count')]
  public ?int $characterCount;

  #[JsonProperty('hashed_xi_api_key', required: true)]
  public string $hashedXiApiKey;

  /**
   * @var string[]|null
   */
  #[JsonProperty('allowed_ips'), ArrayType(['string'])]
  public ?array $allowedIps;

  #[JsonProperty('third_party_disable_allowed')]
  public ?bool $thirdPartyDisableAllowed;

  /**
   * Per-API-key concurrency limits (TTS/dubbing/music). Enterprise-only.
   */
  #[JsonProperty('platform_limits')]
  public ?\ElevenLabs\Types\PlatformLimits $platformLimits;

  /**
   * Unix timestamp (seconds) after which this API key stops working. Null means the key never expires.
   */
  #[JsonProperty('expires_at_unix')]
  public ?int $expiresAtUnix;

  /**
   * @param array{
   *   name: string,
   *   hint: string,
   *   keyId: string,
   *   serviceAccountUserId: string,
   *   hashedXiApiKey: string,
   *   createdAtUnix?: ?int,
   *   isDisabled?: ?bool,
   *   permissions?: array<value-of<\ElevenLabs\Types\PermissionType>>|null,
   *   disableReason?: ?value-of<\ElevenLabs\Types\LockReason>,
   *   characterLimit?: ?int,
   *   characterCount?: ?int,
   *   allowedIps?: string[]|null,
   *   thirdPartyDisableAllowed?: ?bool,
   *   platformLimits?: ?\ElevenLabs\Types\PlatformLimits,
   *   expiresAtUnix?: ?int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->name = $values['name'];
    $this->hint = $values['hint'];
    $this->keyId = $values['keyId'];
    $this->serviceAccountUserId = $values['serviceAccountUserId'];
    $this->createdAtUnix = $values['createdAtUnix'] ?? null;
    $this->isDisabled = $values['isDisabled'] ?? null;
    $this->permissions = $values['permissions'] ?? null;
    $this->disableReason = $values['disableReason'] ?? null;
    $this->characterLimit = $values['characterLimit'] ?? null;
    $this->characterCount = $values['characterCount'] ?? null;
    $this->hashedXiApiKey = $values['hashedXiApiKey'];
    $this->allowedIps = $values['allowedIps'] ?? null;
    $this->thirdPartyDisableAllowed = $values['thirdPartyDisableAllowed'] ?? null;
    $this->platformLimits = $values['platformLimits'] ?? null;
    $this->expiresAtUnix = $values['expiresAtUnix'] ?? null;

    $this->_dirtyFields = [
      'name' => true,
      'hint' => true,
      'key_id' => true,
      'service_account_user_id' => true,
      'hashed_xi_api_key' => true
    ];
    if (array_key_exists('createdAtUnix', $values)) {
      $this->_dirtyFields['created_at_unix'] = true;
    }
    if (array_key_exists('isDisabled', $values)) {
      $this->_dirtyFields['is_disabled'] = true;
    }
    if (array_key_exists('permissions', $values)) {
      $this->_dirtyFields['permissions'] = true;
    }
    if (array_key_exists('disableReason', $values)) {
      $this->_dirtyFields['disable_reason'] = true;
    }
    if (array_key_exists('characterLimit', $values)) {
      $this->_dirtyFields['character_limit'] = true;
    }
    if (array_key_exists('characterCount', $values)) {
      $this->_dirtyFields['character_count'] = true;
    }
    if (array_key_exists('allowedIps', $values)) {
      $this->_dirtyFields['allowed_ips'] = true;
    }
    if (array_key_exists('thirdPartyDisableAllowed', $values)) {
      $this->_dirtyFields['third_party_disable_allowed'] = true;
    }
    if (array_key_exists('platformLimits', $values)) {
      $this->_dirtyFields['platform_limits'] = true;
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
      'name' => 'hint',
      'contents' => $this->hint
    ];

    $parts[] = [
      'name' => 'key_id',
      'contents' => $this->keyId
    ];

    $parts[] = [
      'name' => 'service_account_user_id',
      'contents' => $this->serviceAccountUserId
    ];

    if ($this->createdAtUnix !== null) {
      $parts[] = [
        'name' => 'created_at_unix',
        'contents' => (string) $this->createdAtUnix
      ];
    }

    if ($this->isDisabled !== null) {
      $parts[] = [
        'name' => 'is_disabled',
        'contents' => $this->isDisabled ? 'true' : 'false'
      ];
    }

    if ($this->permissions !== null) {
      foreach ($this->permissions ?? [] as $item) {
        $parts[] = [
          'name' => 'permissions',
          'contents' => $item
        ];
      }
    }

    if ($this->disableReason !== null) {
      $parts[] = [
        'name' => 'disable_reason',
        'contents' => $this->disableReason
      ];
    }

    if ($this->characterLimit !== null) {
      $parts[] = [
        'name' => 'character_limit',
        'contents' => (string) $this->characterLimit
      ];
    }

    if ($this->characterCount !== null) {
      $parts[] = [
        'name' => 'character_count',
        'contents' => (string) $this->characterCount
      ];
    }

    $parts[] = [
      'name' => 'hashed_xi_api_key',
      'contents' => $this->hashedXiApiKey
    ];

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

    if ($this->platformLimits !== null) {
      $parts[] = [
        'name' => 'platform_limits',
        'contents' => json_encode($this->platformLimits),
        'headers' => ['Content-Type' => 'application/json']
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
    $this->platformLimits?->validate();
  }
}
