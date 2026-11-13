<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * Alerting configuration used at both per-agent and per-workspace level.
 * Cascade order for per-monitor threshold and auto-resolve: agent → workspace →
 * system default.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class AlertingSettings extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var array<string, \ElevenLabs\Types\AlertingMonitorConfig>|null
   * Alerting configuration keyed by monitor name.
   */
  #[
    JsonProperty('monitor_configs'),
    ArrayType(['string' => \ElevenLabs\Types\AlertingMonitorConfig::class])
  ]
  public ?array $monitorConfigs;

  /**
   * How many minutes an alert can stay inactive before it is auto-resolved. Unset values fall through to the next layer.
   */
  #[JsonProperty('auto_resolve_after_inactive_minutes')]
  public ?int $autoResolveAfterInactiveMinutes;

  /**
   * @var \ElevenLabs\Types\AlertingSettingsNotifiersItem[]|null
   * Delivery channels for alert lifecycle notifications. Stacked with other layers and deduped by ``webhook_id``, PagerDuty ``connection_id``, or Slack ``(connection_id, channel_id)``.
   */
  #[JsonProperty('notifiers'), ArrayType([\ElevenLabs\Types\AlertingSettingsNotifiersItem::class])]
  public ?array $notifiers;

  /**
   * @param array{
   *   monitorConfigs?: array<string, \ElevenLabs\Types\AlertingMonitorConfig>|null,
   *   autoResolveAfterInactiveMinutes?: ?int,
   *   notifiers?: \ElevenLabs\Types\AlertingSettingsNotifiersItem[]|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->monitorConfigs = $values['monitorConfigs'] ?? null;
    $this->autoResolveAfterInactiveMinutes = $values['autoResolveAfterInactiveMinutes'] ?? null;
    $this->notifiers = $values['notifiers'] ?? null;

    if (array_key_exists('monitorConfigs', $values)) {
      $this->_dirtyFields['monitor_configs'] = true;
    }
    if (array_key_exists('autoResolveAfterInactiveMinutes', $values)) {
      $this->_dirtyFields['auto_resolve_after_inactive_minutes'] = true;
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
    Validator::validateNumber(
      $this->autoResolveAfterInactiveMinutes,
      'auto_resolve_after_inactive_minutes',
      min: 1
    );
    Validator::validateArray($this->notifiers, 'notifiers', maxItems: 10);
  }
}
