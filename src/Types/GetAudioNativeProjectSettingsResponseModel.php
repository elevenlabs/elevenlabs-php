<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class GetAudioNativeProjectSettingsResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Whether the project is enabled.
   */
  #[JsonProperty('enabled', required: true)]
  public bool $enabled;

  /**
   * The ID of the latest snapshot of the project.
   */
  #[JsonProperty('snapshot_id')]
  public ?string $snapshotId;

  /**
   * The settings of the project.
   */
  #[JsonProperty('settings')]
  public ?\ElevenLabs\Types\AudioNativeProjectSettingsResponseModel $settings;

  /**
   * @param array{
   *   enabled: bool,
   *   snapshotId?: ?string,
   *   settings?: ?\ElevenLabs\Types\AudioNativeProjectSettingsResponseModel,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->enabled = $values['enabled'];
    $this->snapshotId = $values['snapshotId'] ?? null;
    $this->settings = $values['settings'] ?? null;

    $this->_dirtyFields = [
      'enabled' => true
    ];
    if (array_key_exists('snapshotId', $values)) {
      $this->_dirtyFields['snapshot_id'] = true;
    }
    if (array_key_exists('settings', $values)) {
      $this->_dirtyFields['settings'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'enabled',
      'contents' => $this->enabled ? 'true' : 'false'
    ];

    if ($this->snapshotId !== null) {
      $parts[] = [
        'name' => 'snapshot_id',
        'contents' => $this->snapshotId
      ];
    }

    if ($this->settings !== null) {
      $parts[] = [
        'name' => 'settings',
        'contents' => json_encode($this->settings),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->settings?->validate();
  }
}
