<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\McpServers\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * Request model for creating/updating an MCP Server configuration.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class McpServerRequestModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('config', required: true)]
  public \ElevenLabs\Types\McpServerConfigInput $config;

  /**
   * @param array{
   *   config: \ElevenLabs\Types\McpServerConfigInput,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->config = $values['config'];

    $this->_dirtyFields = [
      'config' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'config',
      'contents' => json_encode($this->config),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->config->validate();
  }
}
