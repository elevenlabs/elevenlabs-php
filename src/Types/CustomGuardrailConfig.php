<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * Single custom guardrail configuration
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class CustomGuardrailConfig extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('is_enabled')]
  public ?bool $isEnabled;

  /**
   * User-facing name for this guardrail
   */
  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * Instruction describing what to block, e.g. 'don't talk about politics'
   */
  #[JsonProperty('prompt', required: true)]
  public string $prompt;

  /**
   * @var ?value-of<\ElevenLabs\Types\GuardrailExecutionMode>
   */
  #[JsonProperty('execution_mode')]
  public ?string $executionMode;

  /**
   * @var ?value-of<\ElevenLabs\Types\CustomGuardrailConfigModel>
   * LLM model to use for custom guardrail evaluation
   */
  #[JsonProperty('model')]
  public ?string $model;

  /**
   * How much recent history the guardrail sees before the reply it evaluates, counted in user messages (the agent replies between them are included too). The guardrail always gets a single <conversation_history> transcript ending in the evaluated reply, marked 'AGENT [current reply]:'. 0 (default) adds no prior history (just that line); 1 adds the latest user message onward.
   */
  #[JsonProperty('history_message_count')]
  public ?int $historyMessageCount;

  #[JsonProperty('trigger_action')]
  public ?\ElevenLabs\Types\CustomGuardrailConfigTriggerAction $triggerAction;

  /**
   * Evaluate once against the complete non-TTS response instead of cumulative partials. Requires blocking mode.
   */
  #[JsonProperty('evaluate_full_response_only')]
  public ?bool $evaluateFullResponseOnly;

  /**
   * @param array{
   *   name: string,
   *   prompt: string,
   *   isEnabled?: ?bool,
   *   executionMode?: ?value-of<\ElevenLabs\Types\GuardrailExecutionMode>,
   *   model?: ?value-of<\ElevenLabs\Types\CustomGuardrailConfigModel>,
   *   historyMessageCount?: ?int,
   *   triggerAction?: ?\ElevenLabs\Types\CustomGuardrailConfigTriggerAction,
   *   evaluateFullResponseOnly?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->isEnabled = $values['isEnabled'] ?? null;
    $this->name = $values['name'];
    $this->prompt = $values['prompt'];
    $this->executionMode = $values['executionMode'] ?? null;
    $this->model = $values['model'] ?? null;
    $this->historyMessageCount = $values['historyMessageCount'] ?? null;
    $this->triggerAction = $values['triggerAction'] ?? null;
    $this->evaluateFullResponseOnly = $values['evaluateFullResponseOnly'] ?? null;

    $this->_dirtyFields = [
      'name' => true,
      'prompt' => true
    ];
    if (array_key_exists('isEnabled', $values)) {
      $this->_dirtyFields['is_enabled'] = true;
    }
    if (array_key_exists('executionMode', $values)) {
      $this->_dirtyFields['execution_mode'] = true;
    }
    if (array_key_exists('model', $values)) {
      $this->_dirtyFields['model'] = true;
    }
    if (array_key_exists('historyMessageCount', $values)) {
      $this->_dirtyFields['history_message_count'] = true;
    }
    if (array_key_exists('triggerAction', $values)) {
      $this->_dirtyFields['trigger_action'] = true;
    }
    if (array_key_exists('evaluateFullResponseOnly', $values)) {
      $this->_dirtyFields['evaluate_full_response_only'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->isEnabled !== null) {
      $parts[] = [
        'name' => 'is_enabled',
        'contents' => $this->isEnabled ? 'true' : 'false'
      ];
    }

    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    $parts[] = [
      'name' => 'prompt',
      'contents' => $this->prompt
    ];

    if ($this->executionMode !== null) {
      $parts[] = [
        'name' => 'execution_mode',
        'contents' => $this->executionMode
      ];
    }

    if ($this->model !== null) {
      $parts[] = [
        'name' => 'model',
        'contents' => $this->model
      ];
    }

    if ($this->historyMessageCount !== null) {
      $parts[] = [
        'name' => 'history_message_count',
        'contents' => (string) $this->historyMessageCount
      ];
    }

    if ($this->triggerAction !== null) {
      $parts[] = [
        'name' => 'trigger_action',
        'contents' => json_encode($this->triggerAction),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->evaluateFullResponseOnly !== null) {
      $parts[] = [
        'name' => 'evaluate_full_response_only',
        'contents' => $this->evaluateFullResponseOnly ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->name, 'name', minLength: 1, maxLength: 500);
    Validator::validateString($this->prompt, 'prompt', minLength: 1, maxLength: 10000);
    Validator::validateNumber(
      $this->historyMessageCount,
      'history_message_count',
      min: 0,
      max: 100
    );
  }
}
