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
class AgentToolRequestAgentToolRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('tool_name', required: true)]
  public string $toolName;

  #[JsonProperty('tool_call_id', required: true)]
  public string $toolCallId;

  #[JsonProperty('tool_type', required: true)]
  public string $toolType;

  #[JsonProperty('event_id', required: true)]
  public int $eventId;

  #[JsonProperty('expects_response', required: true)]
  public bool $expectsResponse;

  #[JsonProperty('disable_interruptions', required: true)]
  public bool $disableInterruptions;

  #[JsonProperty('response_timeout_secs', required: true)]
  public int $responseTimeoutSecs;

  #[JsonProperty('execution_mode', required: true)]
  public string $executionMode;

  /**
   * @param array{
   *   toolName: string,
   *   toolCallId: string,
   *   toolType: string,
   *   eventId: int,
   *   expectsResponse: bool,
   *   disableInterruptions: bool,
   *   responseTimeoutSecs: int,
   *   executionMode: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->toolName = $values['toolName'];
    $this->toolCallId = $values['toolCallId'];
    $this->toolType = $values['toolType'];
    $this->eventId = $values['eventId'];
    $this->expectsResponse = $values['expectsResponse'];
    $this->disableInterruptions = $values['disableInterruptions'];
    $this->responseTimeoutSecs = $values['responseTimeoutSecs'];
    $this->executionMode = $values['executionMode'];

    $this->_dirtyFields = [
      'tool_name' => true,
      'tool_call_id' => true,
      'tool_type' => true,
      'event_id' => true,
      'expects_response' => true,
      'disable_interruptions' => true,
      'response_timeout_secs' => true,
      'execution_mode' => true
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
      'name' => 'tool_type',
      'contents' => $this->toolType
    ];

    $parts[] = [
      'name' => 'event_id',
      'contents' => (string) $this->eventId
    ];

    $parts[] = [
      'name' => 'expects_response',
      'contents' => $this->expectsResponse ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'disable_interruptions',
      'contents' => $this->disableInterruptions ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'response_timeout_secs',
      'contents' => (string) $this->responseTimeoutSecs
    ];

    $parts[] = [
      'name' => 'execution_mode',
      'contents' => $this->executionMode
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
