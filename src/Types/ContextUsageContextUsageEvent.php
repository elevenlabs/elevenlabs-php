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
class ContextUsageContextUsageEvent extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('event_id', required: true)]
  public int $eventId;

  /**
   * Identifier of the LLM whose context window is reported.
   */
  #[JsonProperty('model', required: true)]
  public string $model;

  /**
   * Prompt size of the turn's last LLM generation in provider tokens (uncached input plus cache reads and writes).
   */
  #[JsonProperty('context_tokens', required: true)]
  public int $contextTokens;

  /**
   * The model's maximum context window size in tokens.
   */
  #[JsonProperty('context_limit_tokens', required: true)]
  public int $contextLimitTokens;

  /**
   * @param array{
   *   eventId: int,
   *   model: string,
   *   contextTokens: int,
   *   contextLimitTokens: int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->eventId = $values['eventId'];
    $this->model = $values['model'];
    $this->contextTokens = $values['contextTokens'];
    $this->contextLimitTokens = $values['contextLimitTokens'];

    $this->_dirtyFields = [
      'event_id' => true,
      'model' => true,
      'context_tokens' => true,
      'context_limit_tokens' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'event_id',
      'contents' => (string) $this->eventId
    ];

    $parts[] = [
      'name' => 'model',
      'contents' => $this->model
    ];

    $parts[] = [
      'name' => 'context_tokens',
      'contents' => (string) $this->contextTokens
    ];

    $parts[] = [
      'name' => 'context_limit_tokens',
      'contents' => (string) $this->contextLimitTokens
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
