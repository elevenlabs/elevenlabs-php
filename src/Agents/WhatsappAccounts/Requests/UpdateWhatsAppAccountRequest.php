<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\WhatsappAccounts\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class UpdateWhatsAppAccountRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('assigned_agent_id')]
  public ?string $assignedAgentId;

  #[JsonProperty('enable_messaging')]
  public ?bool $enableMessaging;

  #[JsonProperty('enable_audio_message_response')]
  public ?bool $enableAudioMessageResponse;

  #[JsonProperty('enable_typing_indicator')]
  public ?bool $enableTypingIndicator;

  /**
   * @param array{
   *   assignedAgentId?: ?string,
   *   enableMessaging?: ?bool,
   *   enableAudioMessageResponse?: ?bool,
   *   enableTypingIndicator?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->assignedAgentId = $values['assignedAgentId'] ?? null;
    $this->enableMessaging = $values['enableMessaging'] ?? null;
    $this->enableAudioMessageResponse = $values['enableAudioMessageResponse'] ?? null;
    $this->enableTypingIndicator = $values['enableTypingIndicator'] ?? null;

    if (array_key_exists('assignedAgentId', $values)) {
      $this->_dirtyFields['assigned_agent_id'] = true;
    }
    if (array_key_exists('enableMessaging', $values)) {
      $this->_dirtyFields['enable_messaging'] = true;
    }
    if (array_key_exists('enableAudioMessageResponse', $values)) {
      $this->_dirtyFields['enable_audio_message_response'] = true;
    }
    if (array_key_exists('enableTypingIndicator', $values)) {
      $this->_dirtyFields['enable_typing_indicator'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->assignedAgentId !== null) {
      $parts[] = [
        'name' => 'assigned_agent_id',
        'contents' => $this->assignedAgentId
      ];
    }

    if ($this->enableMessaging !== null) {
      $parts[] = [
        'name' => 'enable_messaging',
        'contents' => $this->enableMessaging ? 'true' : 'false'
      ];
    }

    if ($this->enableAudioMessageResponse !== null) {
      $parts[] = [
        'name' => 'enable_audio_message_response',
        'contents' => $this->enableAudioMessageResponse ? 'true' : 'false'
      ];
    }

    if ($this->enableTypingIndicator !== null) {
      $parts[] = [
        'name' => 'enable_typing_indicator',
        'contents' => $this->enableTypingIndicator ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
