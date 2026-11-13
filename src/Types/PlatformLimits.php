<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * Unified container for all platform limits.
 *
 * Can be used by:
 * - Billing groups (WorkspaceGroupDBModel.platform_limits)
 * - Child workspaces (SubscriptionDBModel.platform_limits)
 * - API keys (XiApiKeyMetadataDBModel.platform_limits)
 *
 * All fields are required when platform_limits exists. Use limit=None for unlimited.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class PlatformLimits extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Platform limit with usage stored in Firestore. Example: credit usage tracked in Firestore.
   */
  #[JsonProperty('credits')]
  public ?\ElevenLabs\Types\StoredUsagePlatformLimit $credits;

  /**
   * Platform limit with usage computed externally. Example: PVCs use the count_owned_pro_voices_in_billing_group function to compute the usage.
   */
  #[JsonProperty('pvc')]
  public ?\ElevenLabs\Types\ComputedUsagePlatformLimit $pvc;

  /**
   * Platform limit with usage computed externally. Example: PVCs use the count_owned_pro_voices_in_billing_group function to compute the usage.
   */
  #[JsonProperty('concurrency')]
  public ?\ElevenLabs\Types\ComputedUsagePlatformLimit $concurrency;

  /**
   * Platform limit with usage computed externally. Example: PVCs use the count_owned_pro_voices_in_billing_group function to compute the usage.
   */
  #[JsonProperty('dubbing_concurrency')]
  public ?\ElevenLabs\Types\ComputedUsagePlatformLimit $dubbingConcurrency;

  /**
   * Platform limit with usage computed externally. Example: PVCs use the count_owned_pro_voices_in_billing_group function to compute the usage.
   */
  #[JsonProperty('music_concurrency')]
  public ?\ElevenLabs\Types\ComputedUsagePlatformLimit $musicConcurrency;

  /**
   * @param array{
   *   credits?: ?\ElevenLabs\Types\StoredUsagePlatformLimit,
   *   pvc?: ?\ElevenLabs\Types\ComputedUsagePlatformLimit,
   *   concurrency?: ?\ElevenLabs\Types\ComputedUsagePlatformLimit,
   *   dubbingConcurrency?: ?\ElevenLabs\Types\ComputedUsagePlatformLimit,
   *   musicConcurrency?: ?\ElevenLabs\Types\ComputedUsagePlatformLimit,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->credits = $values['credits'] ?? null;
    $this->pvc = $values['pvc'] ?? null;
    $this->concurrency = $values['concurrency'] ?? null;
    $this->dubbingConcurrency = $values['dubbingConcurrency'] ?? null;
    $this->musicConcurrency = $values['musicConcurrency'] ?? null;

    if (array_key_exists('credits', $values)) {
      $this->_dirtyFields['credits'] = true;
    }
    if (array_key_exists('pvc', $values)) {
      $this->_dirtyFields['pvc'] = true;
    }
    if (array_key_exists('concurrency', $values)) {
      $this->_dirtyFields['concurrency'] = true;
    }
    if (array_key_exists('dubbingConcurrency', $values)) {
      $this->_dirtyFields['dubbing_concurrency'] = true;
    }
    if (array_key_exists('musicConcurrency', $values)) {
      $this->_dirtyFields['music_concurrency'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->credits !== null) {
      $parts[] = [
        'name' => 'credits',
        'contents' => json_encode($this->credits),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->pvc !== null) {
      $parts[] = [
        'name' => 'pvc',
        'contents' => json_encode($this->pvc),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->concurrency !== null) {
      $parts[] = [
        'name' => 'concurrency',
        'contents' => json_encode($this->concurrency),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->dubbingConcurrency !== null) {
      $parts[] = [
        'name' => 'dubbing_concurrency',
        'contents' => json_encode($this->dubbingConcurrency),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->musicConcurrency !== null) {
      $parts[] = [
        'name' => 'music_concurrency',
        'contents' => json_encode($this->musicConcurrency),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->credits?->validate();
    $this->pvc?->validate();
    $this->concurrency?->validate();
    $this->dubbingConcurrency?->validate();
    $this->musicConcurrency?->validate();
  }
}
