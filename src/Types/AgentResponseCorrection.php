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
class AgentResponseCorrection extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('agent_response_correction_event', required: true)]
  public \ElevenLabs\Types\AgentResponseCorrectionAgentResponseCorrectionEvent $agentResponseCorrectionEvent;

  /**
   * @var ?value-of<\ElevenLabs\Types\AgentResponseCorrectionType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * @param array{
   *   agentResponseCorrectionEvent: \ElevenLabs\Types\AgentResponseCorrectionAgentResponseCorrectionEvent,
   *   type?: ?value-of<\ElevenLabs\Types\AgentResponseCorrectionType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->agentResponseCorrectionEvent = $values['agentResponseCorrectionEvent'];
    $this->type = $values['type'] ?? 'agent_response_correction';

    $this->_dirtyFields = [
      'agent_response_correction_event' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'agent_response_correction_event',
      'contents' => json_encode($this->agentResponseCorrectionEvent),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->type !== null) {
      $parts[] = [
        'name' => 'type',
        'contents' => $this->type
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->agentResponseCorrectionEvent->validate();
  }
}
