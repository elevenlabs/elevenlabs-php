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
class AgentConfigOverrideInput extends JsonSerializableType
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
   * If non-empty, the message the agent will send when max conversation duration is reached.
   */
  #[JsonProperty('max_conversation_duration_message')]
  public ?string $maxConversationDurationMessage;

  /**
   * The prompt for the agent
   */
  #[JsonProperty('prompt')]
  public ?\ElevenLabs\Types\PromptAgentApiModelOverrideInput $prompt;

  /**
   * @param array{
   *   firstMessage?: ?string,
   *   language?: ?string,
   *   maxConversationDurationMessage?: ?string,
   *   prompt?: ?\ElevenLabs\Types\PromptAgentApiModelOverrideInput,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->firstMessage = $values['firstMessage'] ?? null;
    $this->language = $values['language'] ?? null;
    $this->maxConversationDurationMessage = $values['maxConversationDurationMessage'] ?? null;
    $this->prompt = $values['prompt'] ?? null;

    if (array_key_exists('firstMessage', $values)) {
      $this->_dirtyFields['first_message'] = true;
    }
    if (array_key_exists('language', $values)) {
      $this->_dirtyFields['language'] = true;
    }
    if (array_key_exists('maxConversationDurationMessage', $values)) {
      $this->_dirtyFields['max_conversation_duration_message'] = true;
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

    if ($this->maxConversationDurationMessage !== null) {
      $parts[] = [
        'name' => 'max_conversation_duration_message',
        'contents' => $this->maxConversationDurationMessage
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
    $this->prompt?->validate();
  }
}
