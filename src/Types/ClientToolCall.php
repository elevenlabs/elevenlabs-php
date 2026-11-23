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
class ClientToolCall extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('client_tool_call', required: true)]
  public \ElevenLabs\Types\ClientToolCallClientToolCall $clientToolCall;

  /**
   * @var ?value-of<\ElevenLabs\Types\ClientToolCallType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * @param array{
   *   clientToolCall: \ElevenLabs\Types\ClientToolCallClientToolCall,
   *   type?: ?value-of<\ElevenLabs\Types\ClientToolCallType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->clientToolCall = $values['clientToolCall'];
    $this->type = $values['type'] ?? 'client_tool_call';

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
    $parts[] = [
      'name' => 'client_tool_call',
      'contents' => json_encode($this->clientToolCall),
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
    $this->clientToolCall->validate();
  }
}
