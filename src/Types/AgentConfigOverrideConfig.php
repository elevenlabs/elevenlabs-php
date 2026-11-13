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
class AgentConfigOverrideConfig extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Whether to allow overriding the first_message field.
   */
  #[JsonProperty('first_message')]
  public ?bool $firstMessage;

  /**
   * Whether to allow overriding the language field.
   */
  #[JsonProperty('language')]
  public ?bool $language;

  /**
   * Whether to allow overriding the max_conversation_duration_message field.
   */
  #[JsonProperty('max_conversation_duration_message')]
  public ?bool $maxConversationDurationMessage;

  #[JsonProperty('prompt')]
  public ?\ElevenLabs\Types\PromptAgentApiModelOverrideConfig $prompt;

  /**
   * @param array{
   *   firstMessage?: ?bool,
   *   language?: ?bool,
   *   maxConversationDurationMessage?: ?bool,
   *   prompt?: ?\ElevenLabs\Types\PromptAgentApiModelOverrideConfig,
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
        'contents' => $this->firstMessage ? 'true' : 'false'
      ];
    }

    if ($this->language !== null) {
      $parts[] = [
        'name' => 'language',
        'contents' => $this->language ? 'true' : 'false'
      ];
    }

    if ($this->maxConversationDurationMessage !== null) {
      $parts[] = [
        'name' => 'max_conversation_duration_message',
        'contents' => $this->maxConversationDurationMessage ? 'true' : 'false'
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
