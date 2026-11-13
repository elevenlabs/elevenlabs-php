<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class AlertingMonitorConfig extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Whether this monitor is enabled and can notify
   */
  #[JsonProperty('enabled')]
  public ?bool $enabled;

  /**
   * Failure rate threshold at which this monitor can notify.
   */
  #[JsonProperty('threshold')]
  public ?float $threshold;

  /**
   * Relative increase over the trailing baseline at which this monitor can notify (0.2 = 20% above baseline, 0 = any failure). For conversation_volume_drop it is the share of the usual volume that must be missing, between 0.1 and 0.9 (0.5 = half).
   */
  #[JsonProperty('relative_increase_threshold')]
  public ?float $relativeIncreaseThreshold;

  /**
   * Minimum failures in the window before this monitor can fire.
   */
  #[JsonProperty('min_failure_count')]
  public ?int $minFailureCount;

  /**
   * Minimum trailing buckets with traffic before spike detection can fire.
   */
  #[JsonProperty('min_history_bucket_count')]
  public ?int $minHistoryBucketCount;

  /**
   * Minimum samples in the window before this monitor can fire.
   */
  #[JsonProperty('min_sample_count')]
  public ?int $minSampleCount;

  /**
   * How many suspect buckets within the lookback window are required to promote a suspect to an alert.
   */
  #[JsonProperty('suspect_trigger_threshold')]
  public ?int $suspectTriggerThreshold;

  /**
   * How many minutes an alert can stay inactive before it is auto-resolved.
   */
  #[JsonProperty('auto_resolve_after_inactive_minutes')]
  public ?int $autoResolveAfterInactiveMinutes;

  /**
   * @param array{
   *   enabled?: ?bool,
   *   threshold?: ?float,
   *   relativeIncreaseThreshold?: ?float,
   *   minFailureCount?: ?int,
   *   minHistoryBucketCount?: ?int,
   *   minSampleCount?: ?int,
   *   suspectTriggerThreshold?: ?int,
   *   autoResolveAfterInactiveMinutes?: ?int,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->enabled = $values['enabled'] ?? null;
    $this->threshold = $values['threshold'] ?? null;
    $this->relativeIncreaseThreshold = $values['relativeIncreaseThreshold'] ?? null;
    $this->minFailureCount = $values['minFailureCount'] ?? null;
    $this->minHistoryBucketCount = $values['minHistoryBucketCount'] ?? null;
    $this->minSampleCount = $values['minSampleCount'] ?? null;
    $this->suspectTriggerThreshold = $values['suspectTriggerThreshold'] ?? null;
    $this->autoResolveAfterInactiveMinutes = $values['autoResolveAfterInactiveMinutes'] ?? null;

    if (array_key_exists('enabled', $values)) {
      $this->_dirtyFields['enabled'] = true;
    }
    if (array_key_exists('threshold', $values)) {
      $this->_dirtyFields['threshold'] = true;
    }
    if (array_key_exists('relativeIncreaseThreshold', $values)) {
      $this->_dirtyFields['relative_increase_threshold'] = true;
    }
    if (array_key_exists('minFailureCount', $values)) {
      $this->_dirtyFields['min_failure_count'] = true;
    }
    if (array_key_exists('minHistoryBucketCount', $values)) {
      $this->_dirtyFields['min_history_bucket_count'] = true;
    }
    if (array_key_exists('minSampleCount', $values)) {
      $this->_dirtyFields['min_sample_count'] = true;
    }
    if (array_key_exists('suspectTriggerThreshold', $values)) {
      $this->_dirtyFields['suspect_trigger_threshold'] = true;
    }
    if (array_key_exists('autoResolveAfterInactiveMinutes', $values)) {
      $this->_dirtyFields['auto_resolve_after_inactive_minutes'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->enabled !== null) {
      $parts[] = [
        'name' => 'enabled',
        'contents' => $this->enabled ? 'true' : 'false'
      ];
    }

    if ($this->threshold !== null) {
      $parts[] = [
        'name' => 'threshold',
        'contents' => (string) $this->threshold
      ];
    }

    if ($this->relativeIncreaseThreshold !== null) {
      $parts[] = [
        'name' => 'relative_increase_threshold',
        'contents' => (string) $this->relativeIncreaseThreshold
      ];
    }

    if ($this->minFailureCount !== null) {
      $parts[] = [
        'name' => 'min_failure_count',
        'contents' => (string) $this->minFailureCount
      ];
    }

    if ($this->minHistoryBucketCount !== null) {
      $parts[] = [
        'name' => 'min_history_bucket_count',
        'contents' => (string) $this->minHistoryBucketCount
      ];
    }

    if ($this->minSampleCount !== null) {
      $parts[] = [
        'name' => 'min_sample_count',
        'contents' => (string) $this->minSampleCount
      ];
    }

    if ($this->suspectTriggerThreshold !== null) {
      $parts[] = [
        'name' => 'suspect_trigger_threshold',
        'contents' => (string) $this->suspectTriggerThreshold
      ];
    }

    if ($this->autoResolveAfterInactiveMinutes !== null) {
      $parts[] = [
        'name' => 'auto_resolve_after_inactive_minutes',
        'contents' => (string) $this->autoResolveAfterInactiveMinutes
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateNumber($this->threshold, 'threshold', min: 0, max: 1);
    Validator::validateNumber(
      $this->relativeIncreaseThreshold,
      'relative_increase_threshold',
      min: 0,
      max: 10
    );
    Validator::validateNumber($this->minFailureCount, 'min_failure_count', min: 1);
    Validator::validateNumber($this->minHistoryBucketCount, 'min_history_bucket_count', min: 1);
    Validator::validateNumber($this->minSampleCount, 'min_sample_count', min: 1);
    Validator::validateNumber(
      $this->suspectTriggerThreshold,
      'suspect_trigger_threshold',
      min: 1,
      max: 10
    );
    Validator::validateNumber(
      $this->autoResolveAfterInactiveMinutes,
      'auto_resolve_after_inactive_minutes',
      min: 1
    );
  }
}
