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
class AgentReasoningResponsePartClientEvent extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('reasoning_response_part', required: true)]
  public \ElevenLabs\Types\AgentReasoningResponsePartClientEventData $reasoningResponsePart;

  /**
   * @var ?value-of<\ElevenLabs\Types\AgentReasoningResponsePartClientEventType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * @param array{
   *   reasoningResponsePart: \ElevenLabs\Types\AgentReasoningResponsePartClientEventData,
   *   type?: ?value-of<\ElevenLabs\Types\AgentReasoningResponsePartClientEventType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->reasoningResponsePart = $values['reasoningResponsePart'];
    $this->type = $values['type'] ?? 'agent_reasoning_response_part';

    $this->_dirtyFields = [
      'reasoning_response_part' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'reasoning_response_part',
      'contents' => json_encode($this->reasoningResponsePart),
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
    $this->reasoningResponsePart->validate();
  }
}
