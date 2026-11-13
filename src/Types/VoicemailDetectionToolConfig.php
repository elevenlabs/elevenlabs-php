<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * Allows the agent to detect when a voicemail system is encountered.
 *
 * This tool should be invoked by the LLM when it detects that the call has been
 * answered by a voicemail system rather than a human. If a voicemail message
 * is configured, it will be played; otherwise the call will end immediately.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class VoicemailDetectionToolConfig extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\VoicemailDetectionToolConfigSystemToolType>
   */
  #[JsonProperty('system_tool_type')]
  public ?string $systemToolType;

  /**
   * Optional message to leave on voicemail when detected. If not provided, the call will end immediately when voicemail is detected. Supports dynamic variables (e.g., {{system__time}}, {{system__call_duration_secs}}, {{custom_variable}}).
   */
  #[JsonProperty('voicemail_message')]
  public ?string $voicemailMessage;

  /**
   * @param array{
   *   systemToolType?: ?value-of<\ElevenLabs\Types\VoicemailDetectionToolConfigSystemToolType>,
   *   voicemailMessage?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->systemToolType = $values['systemToolType'] ?? 'voicemail_detection';
    $this->voicemailMessage = $values['voicemailMessage'] ?? null;

    if (array_key_exists('systemToolType', $values)) {
      $this->_dirtyFields['system_tool_type'] = true;
    }
    if (array_key_exists('voicemailMessage', $values)) {
      $this->_dirtyFields['voicemail_message'] = true;
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

    if ($this->voicemailMessage !== null) {
      $parts[] = [
        'name' => 'voicemail_message',
        'contents' => $this->voicemailMessage
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
