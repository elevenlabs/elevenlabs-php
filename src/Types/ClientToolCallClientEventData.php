<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ClientToolCallClientEventData extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('tool_name', required: true)]
  public string $toolName;

  #[JsonProperty('tool_call_id', required: true)]
  public string $toolCallId;

  /**
   * @var array<string, mixed>
   */
  #[JsonProperty('parameters', required: true), ArrayType(['string' => 'mixed'])]
  public array $parameters;

  #[JsonProperty('event_id', required: true)]
  public int $eventId;

  /**
   * Whether the server expects a ClientToolResult response.
   */
  #[JsonProperty('expects_response', required: true)]
  public bool $expectsResponse;

  /**
   * @param array{
   *   toolName: string,
   *   toolCallId: string,
   *   parameters: array<string, mixed>,
   *   eventId: int,
   *   expectsResponse: bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->toolName = $values['toolName'];
    $this->toolCallId = $values['toolCallId'];
    $this->parameters = $values['parameters'];
    $this->eventId = $values['eventId'];
    $this->expectsResponse = $values['expectsResponse'];

    $this->_dirtyFields = [
      'tool_name' => true,
      'tool_call_id' => true,
      'parameters' => true,
      'event_id' => true,
      'expects_response' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'tool_name',
      'contents' => $this->toolName
    ];

    $parts[] = [
      'name' => 'tool_call_id',
      'contents' => $this->toolCallId
    ];

    $parts[] = [
      'name' => 'parameters',
      'contents' => json_encode($this->parameters),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'event_id',
      'contents' => (string) $this->eventId
    ];

    $parts[] = [
      'name' => 'expects_response',
      'contents' => $this->expectsResponse ? 'true' : 'false'
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
