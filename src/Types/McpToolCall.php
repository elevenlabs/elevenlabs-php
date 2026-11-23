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
class McpToolCall extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('mcp_tool_call', required: true)]
  public \ElevenLabs\Types\McpToolCallMcpToolCall $mcpToolCall;

  /**
   * @var ?value-of<\ElevenLabs\Types\McpToolCallType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * @param array{
   *   mcpToolCall: \ElevenLabs\Types\McpToolCallMcpToolCall,
   *   type?: ?value-of<\ElevenLabs\Types\McpToolCallType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->mcpToolCall = $values['mcpToolCall'];
    $this->type = $values['type'] ?? 'mcp_tool_call';

    $this->_dirtyFields = [
      'mcp_tool_call' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'mcp_tool_call',
      'contents' => json_encode($this->mcpToolCall),
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
  }
}
