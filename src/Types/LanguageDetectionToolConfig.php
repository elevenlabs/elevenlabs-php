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
class LanguageDetectionToolConfig extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\LanguageDetectionToolConfigSystemToolType>
   */
  #[JsonProperty('system_tool_type')]
  public ?string $systemToolType;

  /**
   * If no language switch happens in the first 2 user turns, later attempts fail and the conversation stays in the current language. If the language switches during those turns, later switching stays available. Enable to reduce the possibility of false switching.
   */
  #[JsonProperty('only_at_conversation_start')]
  public ?bool $onlyAtConversationStart;

  /**
   * @param array{
   *   systemToolType?: ?value-of<\ElevenLabs\Types\LanguageDetectionToolConfigSystemToolType>,
   *   onlyAtConversationStart?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->systemToolType = $values['systemToolType'] ?? 'language_detection';
    $this->onlyAtConversationStart = $values['onlyAtConversationStart'] ?? null;

    if (array_key_exists('systemToolType', $values)) {
      $this->_dirtyFields['system_tool_type'] = true;
    }
    if (array_key_exists('onlyAtConversationStart', $values)) {
      $this->_dirtyFields['only_at_conversation_start'] = true;
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

    if ($this->onlyAtConversationStart !== null) {
      $parts[] = [
        'name' => 'only_at_conversation_start',
        'contents' => $this->onlyAtConversationStart ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
