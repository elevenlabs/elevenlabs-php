<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * Response model for a list of MCP Server configurations.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class McpServersResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\McpServerResponseModel[]
   */
  #[
    JsonProperty('mcp_servers', required: true),
    ArrayType([\ElevenLabs\Types\McpServerResponseModel::class])
  ]
  public array $mcpServers;

  /**
   * @param array{
   *   mcpServers: \ElevenLabs\Types\McpServerResponseModel[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->mcpServers = $values['mcpServers'];

    $this->_dirtyFields = [
      'mcp_servers' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'mcp_servers',
      'contents' => json_encode($this->mcpServers),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->mcpServers as $item) {
      $item->validate();
    }
  }
}
