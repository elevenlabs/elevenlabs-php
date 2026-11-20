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
class AgentToolResponseClientEventData extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('tool_name', required: true)]
  public string $toolName;

  #[JsonProperty('tool_call_id', required: true)]
  public string $toolCallId;

  #[JsonProperty('tool_type', required: true)]
  public string $toolType;

  #[JsonProperty('is_error', required: true)]
  public bool $isError;

  #[JsonProperty('is_blocked')]
  public ?bool $isBlocked;

  #[JsonProperty('event_id', required: true)]
  public int $eventId;

  #[JsonProperty('is_called', required: true)]
  public bool $isCalled;

  /**
   * @var ?value-of<\ElevenLabs\Types\AgentToolResponseStatus>
   */
  #[JsonProperty('status')]
  public ?string $status;

  /**
   * @param array{
   *   toolName: string,
   *   toolCallId: string,
   *   toolType: string,
   *   isError: bool,
   *   eventId: int,
   *   isCalled: bool,
   *   isBlocked?: ?bool,
   *   status?: ?value-of<\ElevenLabs\Types\AgentToolResponseStatus>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->toolName = $values['toolName'];
    $this->toolCallId = $values['toolCallId'];
    $this->toolType = $values['toolType'];
    $this->isError = $values['isError'];
    $this->isBlocked = $values['isBlocked'] ?? null;
    $this->eventId = $values['eventId'];
    $this->isCalled = $values['isCalled'];
    $this->status = $values['status'] ?? null;

    $this->_dirtyFields = [
      'tool_name' => true,
      'tool_call_id' => true,
      'tool_type' => true,
      'is_error' => true,
      'event_id' => true,
      'is_called' => true
    ];
    if (array_key_exists('isBlocked', $values)) {
      $this->_dirtyFields['is_blocked'] = true;
    }
    if (array_key_exists('status', $values)) {
      $this->_dirtyFields['status'] = true;
    }
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
      'name' => 'is_error',
      'contents' => $this->isError ? 'true' : 'false'
    ];

    if ($this->isBlocked !== null) {
      $parts[] = [
        'name' => 'is_blocked',
        'contents' => $this->isBlocked ? 'true' : 'false'
      ];
    }

    $parts[] = [
      'name' => 'event_id',
      'contents' => (string) $this->eventId
    ];

    $parts[] = [
      'name' => 'is_called',
      'contents' => $this->isCalled ? 'true' : 'false'
    ];

    if ($this->status !== null) {
      $parts[] = [
        'name' => 'status',
        'contents' => $this->status
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
