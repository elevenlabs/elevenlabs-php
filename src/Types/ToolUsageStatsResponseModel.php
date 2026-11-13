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
class ToolUsageStatsResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The total number of calls to the tool
   */
  #[JsonProperty('total_calls')]
  public ?int $totalCalls;

  #[JsonProperty('avg_latency_secs', required: true)]
  public float $avgLatencySecs;

  /**
   * @param array{
   *   avgLatencySecs: float,
   *   totalCalls?: ?int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->totalCalls = $values['totalCalls'] ?? null;
    $this->avgLatencySecs = $values['avgLatencySecs'];

    $this->_dirtyFields = [
      'avg_latency_secs' => true
    ];
    if (array_key_exists('totalCalls', $values)) {
      $this->_dirtyFields['total_calls'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->totalCalls !== null) {
      $parts[] = [
        'name' => 'total_calls',
        'contents' => (string) $this->totalCalls
      ];
    }

    $parts[] = [
      'name' => 'avg_latency_secs',
      'contents' => (string) $this->avgLatencySecs
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
