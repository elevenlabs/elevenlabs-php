<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * Customer-facing view of alerting settings. Unlike AdminAlertingSettingsResponse,
 * it has no internal_notifiers field: those are ElevenLabs-internal delivery
 * channels whose URLs must never be returned outside the admin API.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class AlertingSettingsResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var array<string, \ElevenLabs\Types\AlertingMonitorConfig>|null
   */
  #[
    JsonProperty('monitor_configs'),
    ArrayType(['string' => \ElevenLabs\Types\AlertingMonitorConfig::class])
  ]
  public ?array $monitorConfigs;

  #[JsonProperty('auto_resolve_after_inactive_minutes')]
  public ?int $autoResolveAfterInactiveMinutes;

  /**
   * @var string[]|null
   */
  #[JsonProperty('environments'), ArrayType(['string'])]
  public ?array $environments;

  /**
   * @var \ElevenLabs\Types\AlertingSettingsResponseNotifiersItem[]|null
   */
  #[
    JsonProperty('notifiers'),
    ArrayType([\ElevenLabs\Types\AlertingSettingsResponseNotifiersItem::class])
  ]
  public ?array $notifiers;

  /**
   * @param array{
   *   monitorConfigs?: array<string, \ElevenLabs\Types\AlertingMonitorConfig>|null,
   *   autoResolveAfterInactiveMinutes?: ?int,
   *   environments?: string[]|null,
   *   notifiers?: \ElevenLabs\Types\AlertingSettingsResponseNotifiersItem[]|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->monitorConfigs = $values['monitorConfigs'] ?? null;
    $this->autoResolveAfterInactiveMinutes = $values['autoResolveAfterInactiveMinutes'] ?? null;
    $this->environments = $values['environments'] ?? null;
    $this->notifiers = $values['notifiers'] ?? null;

    if (array_key_exists('monitorConfigs', $values)) {
      $this->_dirtyFields['monitor_configs'] = true;
    }
    if (array_key_exists('autoResolveAfterInactiveMinutes', $values)) {
      $this->_dirtyFields['auto_resolve_after_inactive_minutes'] = true;
    }
    if (array_key_exists('environments', $values)) {
      $this->_dirtyFields['environments'] = true;
    }
    if (array_key_exists('notifiers', $values)) {
      $this->_dirtyFields['notifiers'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->monitorConfigs !== null) {
      $parts[] = [
        'name' => 'monitor_configs',
        'contents' => json_encode($this->monitorConfigs),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->autoResolveAfterInactiveMinutes !== null) {
      $parts[] = [
        'name' => 'auto_resolve_after_inactive_minutes',
        'contents' => (string) $this->autoResolveAfterInactiveMinutes
      ];
    }

    if ($this->environments !== null) {
      foreach ($this->environments ?? [] as $item) {
        $parts[] = [
          'name' => 'environments',
          'contents' => $item
        ];
      }
    }

    if ($this->notifiers !== null) {
      $parts[] = [
        'name' => 'notifiers',
        'contents' => json_encode($this->notifiers),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
