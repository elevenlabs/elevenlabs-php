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
class McpToolCallMcpToolCallSuccess extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('service_id', required: true)]
  public string $serviceId;

  #[JsonProperty('tool_call_id', required: true)]
  public string $toolCallId;

  #[JsonProperty('tool_name', required: true)]
  public string $toolName;

  #[JsonProperty('tool_description')]
  public ?string $toolDescription;

  #[JsonProperty('parameters', required: true)]
  public array $parameters;

  #[JsonProperty('timestamp')]
  public ?string $timestamp;

  /**
   * @var value-of<\ElevenLabs\Types\McpToolCallMcpToolCallSuccessState>
   */
  #[JsonProperty('state', required: true)]
  public string $state;

  /**
   * @var array[]
   */
  #[JsonProperty('result', required: true)]
  public array $result;

  /**
   * @param array{
   *   serviceId: string,
   *   toolCallId: string,
   *   toolName: string,
   *   parameters: array,
   *   state: value-of<\ElevenLabs\Types\McpToolCallMcpToolCallSuccessState>,
   *   result: array[],
   *   toolDescription?: ?string,
   *   timestamp?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->serviceId = $values['serviceId'];
    $this->toolCallId = $values['toolCallId'];
    $this->toolName = $values['toolName'];
    $this->toolDescription = $values['toolDescription'] ?? null;
    $this->parameters = $values['parameters'];
    $this->timestamp = $values['timestamp'] ?? null;
    $this->state = $values['state'];
    $this->result = $values['result'];

    $this->_dirtyFields = [
      'service_id' => true,
      'tool_call_id' => true,
      'tool_name' => true,
      'parameters' => true,
      'state' => true,
      'result' => true
    ];
    if (array_key_exists('toolDescription', $values)) {
      $this->_dirtyFields['tool_description'] = true;
    }
    if (array_key_exists('timestamp', $values)) {
      $this->_dirtyFields['timestamp'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'service_id',
      'contents' => $this->serviceId
    ];

    $parts[] = [
      'name' => 'tool_call_id',
      'contents' => $this->toolCallId
    ];

    $parts[] = [
      'name' => 'tool_name',
      'contents' => $this->toolName
    ];

    if ($this->toolDescription !== null) {
      $parts[] = [
        'name' => 'tool_description',
        'contents' => $this->toolDescription
      ];
    }

    $parts[] = [
      'name' => 'parameters',
      'contents' => json_encode($this->parameters),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->timestamp !== null) {
      $parts[] = [
        'name' => 'timestamp',
        'contents' => $this->timestamp
      ];
    }

    $parts[] = [
      'name' => 'state',
      'contents' => $this->state
    ];

    $parts[] = [
      'name' => 'result',
      'contents' => json_encode($this->result),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
