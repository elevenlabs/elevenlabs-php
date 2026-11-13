<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * Configuration for soft timeout functionality during LLM response generation.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class SoftTimeoutConfig extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Time in seconds before showing the predefined message while waiting for LLM response. Set to -1 to disable.
   */
  #[JsonProperty('timeout_seconds')]
  public ?float $timeoutSeconds;

  /**
   * Message to show when the first soft timeout is reached while waiting for LLM response. Supports dynamic variables (e.g., {{system__time}}, {{custom_variable}}).
   */
  #[JsonProperty('message')]
  public ?string $message;

  /**
   * @var string[]|null
   * Extra static filler messages for subsequent soft timeouts in the same LLM generation. The first timeout uses `message`. If fewer messages are configured than `max_soft_timeouts_per_generation`, the last configured message is repeated; otherwise a built-in filler is used.
   */
  #[JsonProperty('additional_soft_timeout_messages'), ArrayType(['string'])]
  public ?array $additionalSoftTimeoutMessages;

  /**
   * If enabled, the soft timeout message will be generated dynamically instead of using the static message.
   */
  #[JsonProperty('use_llm_generated_message')]
  public ?bool $useLlmGeneratedMessage;

  /**
   * If enabled, shuffle the order of static soft timeout messages once at the start of each turn. Only applies when use_llm_generated_message is false.
   */
  #[JsonProperty('randomize_fillers')]
  public ?bool $randomizeFillers;

  /**
   * Maximum filler messages while waiting for a single LLM response. Fires every timeout_seconds until the LLM streams content or this limit is reached.
   */
  #[JsonProperty('max_soft_timeouts_per_generation')]
  public ?int $maxSoftTimeoutsPerGeneration;

  /**
   * Custom prompt for generating the soft timeout filler message when use_llm_generated_message is enabled. Recent conversation context is provided as a separate user message. If not set, the default prompt will be used. Supports dynamic variables (e.g., {{system__time}}, {{custom_variable}}).
   */
  #[JsonProperty('llm_generated_message_prompt_override')]
  public ?string $llmGeneratedMessagePromptOverride;

  /**
   * When true, soft timeout fillers are suppressed until the conversation has at least one real user message. Prevents fillers during the agent's opening turn (e.g. workflow generate-immediately / tool calls before the user speaks).
   */
  #[JsonProperty('disable_until_first_user_message')]
  public ?bool $disableUntilFirstUserMessage;

  /**
   * @param array{
   *   timeoutSeconds?: ?float,
   *   message?: ?string,
   *   additionalSoftTimeoutMessages?: string[]|null,
   *   useLlmGeneratedMessage?: ?bool,
   *   randomizeFillers?: ?bool,
   *   maxSoftTimeoutsPerGeneration?: ?int,
   *   llmGeneratedMessagePromptOverride?: ?string,
   *   disableUntilFirstUserMessage?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->timeoutSeconds = $values['timeoutSeconds'] ?? null;
    $this->message = $values['message'] ?? null;
    $this->additionalSoftTimeoutMessages = $values['additionalSoftTimeoutMessages'] ?? null;
    $this->useLlmGeneratedMessage = $values['useLlmGeneratedMessage'] ?? null;
    $this->randomizeFillers = $values['randomizeFillers'] ?? null;
    $this->maxSoftTimeoutsPerGeneration = $values['maxSoftTimeoutsPerGeneration'] ?? null;
    $this->llmGeneratedMessagePromptOverride = $values['llmGeneratedMessagePromptOverride'] ?? null;
    $this->disableUntilFirstUserMessage = $values['disableUntilFirstUserMessage'] ?? null;

    if (array_key_exists('timeoutSeconds', $values)) {
      $this->_dirtyFields['timeout_seconds'] = true;
    }
    if (array_key_exists('message', $values)) {
      $this->_dirtyFields['message'] = true;
    }
    if (array_key_exists('additionalSoftTimeoutMessages', $values)) {
      $this->_dirtyFields['additional_soft_timeout_messages'] = true;
    }
    if (array_key_exists('useLlmGeneratedMessage', $values)) {
      $this->_dirtyFields['use_llm_generated_message'] = true;
    }
    if (array_key_exists('randomizeFillers', $values)) {
      $this->_dirtyFields['randomize_fillers'] = true;
    }
    if (array_key_exists('maxSoftTimeoutsPerGeneration', $values)) {
      $this->_dirtyFields['max_soft_timeouts_per_generation'] = true;
    }
    if (array_key_exists('llmGeneratedMessagePromptOverride', $values)) {
      $this->_dirtyFields['llm_generated_message_prompt_override'] = true;
    }
    if (array_key_exists('disableUntilFirstUserMessage', $values)) {
      $this->_dirtyFields['disable_until_first_user_message'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->timeoutSeconds !== null) {
      $parts[] = [
        'name' => 'timeout_seconds',
        'contents' => (string) $this->timeoutSeconds
      ];
    }

    if ($this->message !== null) {
      $parts[] = [
        'name' => 'message',
        'contents' => $this->message
      ];
    }

    if ($this->additionalSoftTimeoutMessages !== null) {
      foreach ($this->additionalSoftTimeoutMessages ?? [] as $item) {
        $parts[] = [
          'name' => 'additional_soft_timeout_messages',
          'contents' => $item
        ];
      }
    }

    if ($this->useLlmGeneratedMessage !== null) {
      $parts[] = [
        'name' => 'use_llm_generated_message',
        'contents' => $this->useLlmGeneratedMessage ? 'true' : 'false'
      ];
    }

    if ($this->randomizeFillers !== null) {
      $parts[] = [
        'name' => 'randomize_fillers',
        'contents' => $this->randomizeFillers ? 'true' : 'false'
      ];
    }

    if ($this->maxSoftTimeoutsPerGeneration !== null) {
      $parts[] = [
        'name' => 'max_soft_timeouts_per_generation',
        'contents' => (string) $this->maxSoftTimeoutsPerGeneration
      ];
    }

    if ($this->llmGeneratedMessagePromptOverride !== null) {
      $parts[] = [
        'name' => 'llm_generated_message_prompt_override',
        'contents' => $this->llmGeneratedMessagePromptOverride
      ];
    }

    if ($this->disableUntilFirstUserMessage !== null) {
      $parts[] = [
        'name' => 'disable_until_first_user_message',
        'contents' => $this->disableUntilFirstUserMessage ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->message, 'message', minLength: 1, maxLength: 200);
    Validator::validateArray(
      $this->additionalSoftTimeoutMessages,
      'additional_soft_timeout_messages',
      maxItems: 7
    );
    Validator::validateNumber(
      $this->maxSoftTimeoutsPerGeneration,
      'max_soft_timeouts_per_generation',
      min: 1,
      max: 8
    );
    Validator::validateString(
      $this->llmGeneratedMessagePromptOverride,
      'llm_generated_message_prompt_override',
      minLength: 1,
      maxLength: 1000
    );
  }
}
