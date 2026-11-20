<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * `ClientToolCallClientEvent` as a stream event, because its custom `__init__` can't parse its own JSON.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ClientToolCallEvent extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\ClientToolCallEventType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  #[JsonProperty('client_tool_call', required: true)]
  public \ElevenLabs\Types\ClientToolCallClientEventData $clientToolCall;

  /**
   * @param array{
   *   clientToolCall: \ElevenLabs\Types\ClientToolCallClientEventData,
   *   type?: ?value-of<\ElevenLabs\Types\ClientToolCallEventType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'client_tool_call';
    $this->clientToolCall = $values['clientToolCall'];

    $this->_dirtyFields = [
      'client_tool_call' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->type !== null) {
      $parts[] = [
        'name' => 'type',
        'contents' => $this->type
      ];
    }

    $parts[] = [
      'name' => 'client_tool_call',
      'contents' => json_encode($this->clientToolCall),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->clientToolCall->validate();
  }
}
