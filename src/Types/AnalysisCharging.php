<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * Cost of running post-call analysis on this conversation.
 * Present once an analysis pass has run, billed or not.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class AnalysisCharging extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Cumulative LLM cost of running post-call analysis on this conversation.
   */
  #[JsonProperty('total', required: true)]
  public \ElevenLabs\Types\AnalysisRunningTotal $total;

  /**
   * LLM cost of the most recent post-call analysis pass on this conversation.
   */
  #[JsonProperty('last_run', required: true)]
  public \ElevenLabs\Types\AnalysisRunSnapshot $lastRun;

  /**
   * @param array{
   *   total: \ElevenLabs\Types\AnalysisRunningTotal,
   *   lastRun: \ElevenLabs\Types\AnalysisRunSnapshot,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->total = $values['total'];
    $this->lastRun = $values['lastRun'];

    $this->_dirtyFields = [
      'total' => true,
      'last_run' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'total',
      'contents' => json_encode($this->total),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'last_run',
      'contents' => json_encode($this->lastRun),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->total->validate();
    $this->lastRun->validate();
  }
}
