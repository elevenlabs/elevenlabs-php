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
class McpConnectionStatus extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * MCP connection status with array of integration statuses.
   */
  #[JsonProperty('mcp_connection_status', required: true)]
  public \ElevenLabs\Types\McpConnectionStatusMcpConnectionStatus $mcpConnectionStatus;

  /**
   * @var ?value-of<\ElevenLabs\Types\McpConnectionStatusType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * @param array{
   *   mcpConnectionStatus: \ElevenLabs\Types\McpConnectionStatusMcpConnectionStatus,
   *   type?: ?value-of<\ElevenLabs\Types\McpConnectionStatusType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->mcpConnectionStatus = $values['mcpConnectionStatus'];
    $this->type = $values['type'] ?? 'mcp_connection_status';

    $this->_dirtyFields = [
      'mcp_connection_status' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'mcp_connection_status',
      'contents' => json_encode($this->mcpConnectionStatus),
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
    $this->mcpConnectionStatus->validate();
  }
}
