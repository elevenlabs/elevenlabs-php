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
class AgentCallLimits extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The maximum number of concurrent conversations. -1 indicates that there is no maximum
   */
  #[JsonProperty('agent_concurrency_limit')]
  public ?int $agentConcurrencyLimit;

  /**
   * The maximum number of conversations per day
   */
  #[JsonProperty('daily_limit')]
  public ?int $dailyLimit;

  /**
   * Whether to enable bursting. If true, exceeding workspace concurrency limit will be allowed up to 3 times the limit. Calls will be charged at double rate when exceeding the limit.
   */
  #[JsonProperty('bursting_enabled')]
  public ?bool $burstingEnabled;

  /**
   * @param array{
   *   agentConcurrencyLimit?: ?int,
   *   dailyLimit?: ?int,
   *   burstingEnabled?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->agentConcurrencyLimit = $values['agentConcurrencyLimit'] ?? null;
    $this->dailyLimit = $values['dailyLimit'] ?? null;
    $this->burstingEnabled = $values['burstingEnabled'] ?? null;

    if (array_key_exists('agentConcurrencyLimit', $values)) {
      $this->_dirtyFields['agent_concurrency_limit'] = true;
    }
    if (array_key_exists('dailyLimit', $values)) {
      $this->_dirtyFields['daily_limit'] = true;
    }
    if (array_key_exists('burstingEnabled', $values)) {
      $this->_dirtyFields['bursting_enabled'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->agentConcurrencyLimit !== null) {
      $parts[] = [
        'name' => 'agent_concurrency_limit',
        'contents' => (string) $this->agentConcurrencyLimit
      ];
    }

    if ($this->dailyLimit !== null) {
      $parts[] = [
        'name' => 'daily_limit',
        'contents' => (string) $this->dailyLimit
      ];
    }

    if ($this->burstingEnabled !== null) {
      $parts[] = [
        'name' => 'bursting_enabled',
        'contents' => $this->burstingEnabled ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
