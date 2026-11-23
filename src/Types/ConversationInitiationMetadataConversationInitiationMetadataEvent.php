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
class ConversationInitiationMetadataConversationInitiationMetadataEvent extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('conversation_id', required: true)]
  public string $conversationId;

  /**
   * @var value-of<\ElevenLabs\Types\ConversationInitiationMetadataConversationInitiationMetadataEventAgentOutputAudioFormat>
   * Audio format specification for agent's speech output.
   */
  #[JsonProperty('agent_output_audio_format', required: true)]
  public string $agentOutputAudioFormat;

  /**
   * @var value-of<\ElevenLabs\Types\ConversationInitiationMetadataConversationInitiationMetadataEventUserInputAudioFormat>
   * Audio format specification for user's speech input.
   */
  #[JsonProperty('user_input_audio_format', required: true)]
  public string $userInputAudioFormat;

  /**
   * @param array{
   *   conversationId: string,
   *   agentOutputAudioFormat: value-of<\ElevenLabs\Types\ConversationInitiationMetadataConversationInitiationMetadataEventAgentOutputAudioFormat>,
   *   userInputAudioFormat: value-of<\ElevenLabs\Types\ConversationInitiationMetadataConversationInitiationMetadataEventUserInputAudioFormat>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->conversationId = $values['conversationId'];
    $this->agentOutputAudioFormat = $values['agentOutputAudioFormat'];
    $this->userInputAudioFormat = $values['userInputAudioFormat'];

    $this->_dirtyFields = [
      'conversation_id' => true,
      'agent_output_audio_format' => true,
      'user_input_audio_format' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'conversation_id',
      'contents' => $this->conversationId
    ];

    $parts[] = [
      'name' => 'agent_output_audio_format',
      'contents' => $this->agentOutputAudioFormat
    ];

    $parts[] = [
      'name' => 'user_input_audio_format',
      'contents' => $this->userInputAudioFormat
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
