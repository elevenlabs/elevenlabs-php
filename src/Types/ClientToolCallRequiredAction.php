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
class ClientToolCallRequiredAction extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\ClientToolCallRequiredActionType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  #[JsonProperty('tool_call_id', required: true)]
  public string $toolCallId;

  #[JsonProperty('tool_name', required: true)]
  public string $toolName;

  /**
   * @var array<string, mixed>
   */
  #[JsonProperty('parameters', required: true), ArrayType(['string' => 'mixed'])]
  public array $parameters;

  /**
   * @param array{
   *   toolCallId: string,
   *   toolName: string,
   *   parameters: array<string, mixed>,
   *   type?: ?value-of<\ElevenLabs\Types\ClientToolCallRequiredActionType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'client_tool_call';
    $this->toolCallId = $values['toolCallId'];
    $this->toolName = $values['toolName'];
    $this->parameters = $values['parameters'];

    $this->_dirtyFields = [
      'tool_call_id' => true,
      'tool_name' => true,
      'parameters' => true
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
      'name' => 'tool_call_id',
      'contents' => $this->toolCallId
    ];

    $parts[] = [
      'name' => 'tool_name',
      'contents' => $this->toolName
    ];

    $parts[] = [
      'name' => 'parameters',
      'contents' => json_encode($this->parameters),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
