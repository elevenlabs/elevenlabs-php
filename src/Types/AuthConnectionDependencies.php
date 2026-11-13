<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * Dependencies that use an auth connection
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class AuthConnectionDependencies extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\AuthConnectionDependenciesToolsItem[]|null
   */
  #[
    JsonProperty('tools'),
    ArrayType([\ElevenLabs\Types\AuthConnectionDependenciesToolsItem::class])
  ]
  public ?array $tools;

  /**
   * @var \ElevenLabs\Types\AuthConnectionDependenciesMcpServersItem[]|null
   */
  #[
    JsonProperty('mcp_servers'),
    ArrayType([\ElevenLabs\Types\AuthConnectionDependenciesMcpServersItem::class])
  ]
  public ?array $mcpServers;

  /**
   * @var \ElevenLabs\Types\DependentIntegrationConnectionIdentifier[]|null
   */
  #[
    JsonProperty('integration_connections'),
    ArrayType([\ElevenLabs\Types\DependentIntegrationConnectionIdentifier::class])
  ]
  public ?array $integrationConnections;

  /**
   * @param array{
   *   tools?: \ElevenLabs\Types\AuthConnectionDependenciesToolsItem[]|null,
   *   mcpServers?: \ElevenLabs\Types\AuthConnectionDependenciesMcpServersItem[]|null,
   *   integrationConnections?: \ElevenLabs\Types\DependentIntegrationConnectionIdentifier[]|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->tools = $values['tools'] ?? null;
    $this->mcpServers = $values['mcpServers'] ?? null;
    $this->integrationConnections = $values['integrationConnections'] ?? null;

    if (array_key_exists('tools', $values)) {
      $this->_dirtyFields['tools'] = true;
    }
    if (array_key_exists('mcpServers', $values)) {
      $this->_dirtyFields['mcp_servers'] = true;
    }
    if (array_key_exists('integrationConnections', $values)) {
      $this->_dirtyFields['integration_connections'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->tools !== null) {
      $parts[] = [
        'name' => 'tools',
        'contents' => json_encode($this->tools),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->mcpServers !== null) {
      $parts[] = [
        'name' => 'mcp_servers',
        'contents' => json_encode($this->mcpServers),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->integrationConnections !== null) {
      $parts[] = [
        'name' => 'integration_connections',
        'contents' => json_encode($this->integrationConnections),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->integrationConnections ?? [] as $item) {
      $item->validate();
    }
  }
}
