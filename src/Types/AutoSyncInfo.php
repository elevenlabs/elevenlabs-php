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
class AutoSyncInfo extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Minimum frequency (in days) at which the document is refreshed. The actual interval may be shorter, never longer.
   */
  #[JsonProperty('minimum_frequency_days')]
  public ?int $minimumFrequencyDays;

  /**
   * Whether to remove the document if the URL becomes unavailable
   */
  #[JsonProperty('auto_remove')]
  public ?bool $autoRemove;

  /**
   * Number of consecutive sync failures
   */
  #[JsonProperty('consec_failures')]
  public ?int $consecFailures;

  /**
   * Unix timestamp for the next scheduled sync or None (in case of folders)
   */
  #[JsonProperty('next_refresh_by')]
  public ?int $nextRefreshBy;

  /**
   * @param array{
   *   minimumFrequencyDays?: ?int,
   *   autoRemove?: ?bool,
   *   consecFailures?: ?int,
   *   nextRefreshBy?: ?int,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->minimumFrequencyDays = $values['minimumFrequencyDays'] ?? null;
    $this->autoRemove = $values['autoRemove'] ?? null;
    $this->consecFailures = $values['consecFailures'] ?? null;
    $this->nextRefreshBy = $values['nextRefreshBy'] ?? null;

    if (array_key_exists('minimumFrequencyDays', $values)) {
      $this->_dirtyFields['minimum_frequency_days'] = true;
    }
    if (array_key_exists('autoRemove', $values)) {
      $this->_dirtyFields['auto_remove'] = true;
    }
    if (array_key_exists('consecFailures', $values)) {
      $this->_dirtyFields['consec_failures'] = true;
    }
    if (array_key_exists('nextRefreshBy', $values)) {
      $this->_dirtyFields['next_refresh_by'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->minimumFrequencyDays !== null) {
      $parts[] = [
        'name' => 'minimum_frequency_days',
        'contents' => (string) $this->minimumFrequencyDays
      ];
    }

    if ($this->autoRemove !== null) {
      $parts[] = [
        'name' => 'auto_remove',
        'contents' => $this->autoRemove ? 'true' : 'false'
      ];
    }

    if ($this->consecFailures !== null) {
      $parts[] = [
        'name' => 'consec_failures',
        'contents' => (string) $this->consecFailures
      ];
    }

    if ($this->nextRefreshBy !== null) {
      $parts[] = [
        'name' => 'next_refresh_by',
        'contents' => (string) $this->nextRefreshBy
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateNumber(
      $this->minimumFrequencyDays,
      'minimum_frequency_days',
      min: 1,
      max: 180
    );
    Validator::validateNumber($this->consecFailures, 'consec_failures', min: 0);
  }
}
