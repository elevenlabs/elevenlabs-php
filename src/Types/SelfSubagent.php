<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * The agent itself, run on the same branch with none of the conversation.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class SelfSubagent extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\SelfSubagentExecutionMode>
   * Whether to wait for the reply, or keep going and get it later in the conversation.
   */
  #[JsonProperty('execution_mode')]
  public ?string $executionMode;

  /**
   * How long the agent may run before it's stopped.
   */
  #[JsonProperty('timeout_secs')]
  public ?int $timeoutSecs;

  /**
   * When the agent should hand work to itself. Defaults to a built-in description.
   */
  #[JsonProperty('description')]
  public ?string $description;

  /**
   * @param array{
   *   executionMode?: ?value-of<\ElevenLabs\Types\SelfSubagentExecutionMode>,
   *   timeoutSecs?: ?int,
   *   description?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->executionMode = $values['executionMode'] ?? null;
    $this->timeoutSecs = $values['timeoutSecs'] ?? null;
    $this->description = $values['description'] ?? null;

    if (array_key_exists('executionMode', $values)) {
      $this->_dirtyFields['execution_mode'] = true;
    }
    if (array_key_exists('timeoutSecs', $values)) {
      $this->_dirtyFields['timeout_secs'] = true;
    }
    if (array_key_exists('description', $values)) {
      $this->_dirtyFields['description'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->executionMode !== null) {
      $parts[] = [
        'name' => 'execution_mode',
        'contents' => $this->executionMode
      ];
    }

    if ($this->timeoutSecs !== null) {
      $parts[] = [
        'name' => 'timeout_secs',
        'contents' => (string) $this->timeoutSecs
      ];
    }

    if ($this->description !== null) {
      $parts[] = [
        'name' => 'description',
        'contents' => $this->description
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateNumber($this->timeoutSecs, 'timeout_secs', min: 10, max: 3600);
  }
}
