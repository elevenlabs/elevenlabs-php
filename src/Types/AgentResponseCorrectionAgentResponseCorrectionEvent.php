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
class AgentResponseCorrectionAgentResponseCorrectionEvent extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('original_agent_response', required: true)]
  public string $originalAgentResponse;

  #[JsonProperty('corrected_agent_response', required: true)]
  public string $correctedAgentResponse;

  #[JsonProperty('event_id', required: true)]
  public int $eventId;

  #[JsonProperty('response_id', required: true)]
  public string $responseId;

  /**
   * @param array{
   *   originalAgentResponse: string,
   *   correctedAgentResponse: string,
   *   eventId: int,
   *   responseId: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->originalAgentResponse = $values['originalAgentResponse'];
    $this->correctedAgentResponse = $values['correctedAgentResponse'];
    $this->eventId = $values['eventId'];
    $this->responseId = $values['responseId'];

    $this->_dirtyFields = [
      'original_agent_response' => true,
      'corrected_agent_response' => true,
      'event_id' => true,
      'response_id' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'original_agent_response',
      'contents' => $this->originalAgentResponse
    ];

    $parts[] = [
      'name' => 'corrected_agent_response',
      'contents' => $this->correctedAgentResponse
    ];

    $parts[] = [
      'name' => 'event_id',
      'contents' => (string) $this->eventId
    ];

    $parts[] = [
      'name' => 'response_id',
      'contents' => $this->responseId
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
