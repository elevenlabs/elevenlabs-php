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
class PostAgentHoldAudioResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('agent_id', required: true)]
  public string $agentId;

  /**
   * Custom hold audio played on loop to callers waiting in the agent's queue.
   *
   * Set by uploading a file through the agent hold-audio endpoint. Values sent in
   * agent create or update requests are ignored.
   */
  #[JsonProperty('hold_audio', required: true)]
  public \ElevenLabs\Types\AgentHoldAudioConfig $holdAudio;

  /**
   * @param array{
   *   agentId: string,
   *   holdAudio: \ElevenLabs\Types\AgentHoldAudioConfig,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->agentId = $values['agentId'];
    $this->holdAudio = $values['holdAudio'];

    $this->_dirtyFields = [
      'agent_id' => true,
      'hold_audio' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'agent_id',
      'contents' => $this->agentId
    ];

    $parts[] = [
      'name' => 'hold_audio',
      'contents' => json_encode($this->holdAudio),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->holdAudio->validate();
  }
}
