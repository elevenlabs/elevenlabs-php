<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * Allows the agent to explicitly skip its turn.
 *
 * This tool should be invoked by the LLM when the user indicates they would like
 * to think or take a short pause before continuing the conversation—e.g. when
 * they say: "Give me a second", "Let me think", or "One moment please".  After
 * calling this tool, the assistant should not speak until the user speaks
 * again, or if wait_timeout_secs is set, until that wait elapses and the
 * agent generates a check-in.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class SkipTurnToolConfig extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\SkipTurnToolConfigSystemToolType>
   */
  #[JsonProperty('system_tool_type')]
  public ?string $systemToolType;

  /**
   * Seconds to wait after skip_turn before the agent generates a contextual check-in. The "End conversation after silence" timer is paused during the wait. -1 disables the wait: after skip_turn the agent stays silent until the caller speaks, and that timer keeps running. Applies to voice conversations only.
   */
  #[JsonProperty('wait_timeout_secs')]
  public ?float $waitTimeoutSecs;

  /**
   * @param array{
   *   systemToolType?: ?value-of<\ElevenLabs\Types\SkipTurnToolConfigSystemToolType>,
   *   waitTimeoutSecs?: ?float,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->systemToolType = $values['systemToolType'] ?? 'skip_turn';
    $this->waitTimeoutSecs = $values['waitTimeoutSecs'] ?? null;

    if (array_key_exists('systemToolType', $values)) {
      $this->_dirtyFields['system_tool_type'] = true;
    }
    if (array_key_exists('waitTimeoutSecs', $values)) {
      $this->_dirtyFields['wait_timeout_secs'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->systemToolType !== null) {
      $parts[] = [
        'name' => 'system_tool_type',
        'contents' => $this->systemToolType
      ];
    }

    if ($this->waitTimeoutSecs !== null) {
      $parts[] = [
        'name' => 'wait_timeout_secs',
        'contents' => (string) $this->waitTimeoutSecs
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
