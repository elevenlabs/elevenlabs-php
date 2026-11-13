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
class CompactionSettingsWorkflowOverride extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Whether context compaction is enabled for this agent.
   */
  #[JsonProperty('enabled')]
  public ?bool $enabled;

  /**
   * Context window fraction at which compaction is triggered.
   */
  #[JsonProperty('soft_trigger_fraction')]
  public ?float $softTriggerFraction;

  /**
   * Number of recent messages kept verbatim after compaction.
   */
  #[JsonProperty('tail_size')]
  public ?int $tailSize;

  /**
   * Minimum number of tokens that compaction must reclaim.
   */
  #[JsonProperty('min_reclaimable_tokens')]
  public ?int $minReclaimableTokens;

  /**
   * @param array{
   *   enabled?: ?bool,
   *   softTriggerFraction?: ?float,
   *   tailSize?: ?int,
   *   minReclaimableTokens?: ?int,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->enabled = $values['enabled'] ?? null;
    $this->softTriggerFraction = $values['softTriggerFraction'] ?? null;
    $this->tailSize = $values['tailSize'] ?? null;
    $this->minReclaimableTokens = $values['minReclaimableTokens'] ?? null;

    if (array_key_exists('enabled', $values)) {
      $this->_dirtyFields['enabled'] = true;
    }
    if (array_key_exists('softTriggerFraction', $values)) {
      $this->_dirtyFields['soft_trigger_fraction'] = true;
    }
    if (array_key_exists('tailSize', $values)) {
      $this->_dirtyFields['tail_size'] = true;
    }
    if (array_key_exists('minReclaimableTokens', $values)) {
      $this->_dirtyFields['min_reclaimable_tokens'] = true;
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

    if ($this->softTriggerFraction !== null) {
      $parts[] = [
        'name' => 'soft_trigger_fraction',
        'contents' => (string) $this->softTriggerFraction
      ];
    }

    if ($this->tailSize !== null) {
      $parts[] = [
        'name' => 'tail_size',
        'contents' => (string) $this->tailSize
      ];
    }

    if ($this->minReclaimableTokens !== null) {
      $parts[] = [
        'name' => 'min_reclaimable_tokens',
        'contents' => (string) $this->minReclaimableTokens
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
