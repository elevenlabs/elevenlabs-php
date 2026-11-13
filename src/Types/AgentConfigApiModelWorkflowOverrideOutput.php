<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class AgentConfigApiModelWorkflowOverrideOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * If non-empty, the first message the agent will say. If empty, the agent waits for the user to start the discussion.
   */
  #[JsonProperty('first_message')]
  public ?string $firstMessage;

  /**
   * Language of the agent - used for ASR and TTS
   */
  #[JsonProperty('language')]
  public ?string $language;

  /**
   * When enabled, the agent mixes English words and phrases into responses in Hindi, Malayalam, Telugu, or Kannada.
   */
  #[JsonProperty('hinglish_mode')]
  public ?bool $hinglishMode;

  /**
   * Configuration for dynamic variables
   */
  #[JsonProperty('dynamic_variables')]
  public ?\ElevenLabs\Types\DynamicVariablesConfigWorkflowOverride $dynamicVariables;

  /**
   * If true, the user will not be able to interrupt the agent while the first message is being delivered.
   */
  #[JsonProperty('disable_first_message_interruptions')]
  public ?bool $disableFirstMessageInterruptions;

  /**
   * If non-empty, the message the agent will send when max conversation duration is reached.
   */
  #[JsonProperty('max_conversation_duration_message')]
  public ?string $maxConversationDurationMessage;

  /**
   * @var array<string, \ElevenLabs\Types\BehaviorOverride>|null
   * Per-channel response behavior overrides for text conversations. Built-in channel defaults apply when unset.
   */
  #[
    JsonProperty('text_behavior_overrides'),
    ArrayType(['string' => \ElevenLabs\Types\BehaviorOverride::class])
  ]
  public ?array $textBehaviorOverrides;

  /**
   * The prompt for the agent
   */
  #[JsonProperty('prompt')]
  public ?\ElevenLabs\Types\PromptAgentApiModelWorkflowOverrideOutput $prompt;

  /**
   * @param array{
   *   firstMessage?: ?string,
   *   language?: ?string,
   *   hinglishMode?: ?bool,
   *   dynamicVariables?: ?\ElevenLabs\Types\DynamicVariablesConfigWorkflowOverride,
   *   disableFirstMessageInterruptions?: ?bool,
   *   maxConversationDurationMessage?: ?string,
   *   textBehaviorOverrides?: array<string, \ElevenLabs\Types\BehaviorOverride>|null,
   *   prompt?: ?\ElevenLabs\Types\PromptAgentApiModelWorkflowOverrideOutput,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->firstMessage = $values['firstMessage'] ?? null;
    $this->language = $values['language'] ?? null;
    $this->hinglishMode = $values['hinglishMode'] ?? null;
    $this->dynamicVariables = $values['dynamicVariables'] ?? null;
    $this->disableFirstMessageInterruptions = $values['disableFirstMessageInterruptions'] ?? null;
    $this->maxConversationDurationMessage = $values['maxConversationDurationMessage'] ?? null;
    $this->textBehaviorOverrides = $values['textBehaviorOverrides'] ?? null;
    $this->prompt = $values['prompt'] ?? null;

    if (array_key_exists('firstMessage', $values)) {
      $this->_dirtyFields['first_message'] = true;
    }
    if (array_key_exists('language', $values)) {
      $this->_dirtyFields['language'] = true;
    }
    if (array_key_exists('hinglishMode', $values)) {
      $this->_dirtyFields['hinglish_mode'] = true;
    }
    if (array_key_exists('dynamicVariables', $values)) {
      $this->_dirtyFields['dynamic_variables'] = true;
    }
    if (array_key_exists('disableFirstMessageInterruptions', $values)) {
      $this->_dirtyFields['disable_first_message_interruptions'] = true;
    }
    if (array_key_exists('maxConversationDurationMessage', $values)) {
      $this->_dirtyFields['max_conversation_duration_message'] = true;
    }
    if (array_key_exists('textBehaviorOverrides', $values)) {
      $this->_dirtyFields['text_behavior_overrides'] = true;
    }
    if (array_key_exists('prompt', $values)) {
      $this->_dirtyFields['prompt'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->firstMessage !== null) {
      $parts[] = [
        'name' => 'first_message',
        'contents' => $this->firstMessage
      ];
    }

    if ($this->language !== null) {
      $parts[] = [
        'name' => 'language',
        'contents' => $this->language
      ];
    }

    if ($this->hinglishMode !== null) {
      $parts[] = [
        'name' => 'hinglish_mode',
        'contents' => $this->hinglishMode ? 'true' : 'false'
      ];
    }

    if ($this->dynamicVariables !== null) {
      $parts[] = [
        'name' => 'dynamic_variables',
        'contents' => json_encode($this->dynamicVariables),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->disableFirstMessageInterruptions !== null) {
      $parts[] = [
        'name' => 'disable_first_message_interruptions',
        'contents' => $this->disableFirstMessageInterruptions ? 'true' : 'false'
      ];
    }

    if ($this->maxConversationDurationMessage !== null) {
      $parts[] = [
        'name' => 'max_conversation_duration_message',
        'contents' => $this->maxConversationDurationMessage
      ];
    }

    if ($this->textBehaviorOverrides !== null) {
      $parts[] = [
        'name' => 'text_behavior_overrides',
        'contents' => json_encode($this->textBehaviorOverrides),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->prompt !== null) {
      $parts[] = [
        'name' => 'prompt',
        'contents' => json_encode($this->prompt),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->dynamicVariables?->validate();
    $this->prompt?->validate();
  }
}
