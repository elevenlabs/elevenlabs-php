<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * Status of a single MCP integration/server.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class McpConnectionStatusMcpConnectionStatusIntegrationsItem extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('integration_id', required: true)]
  public string $integrationId;

  /**
   * @var value-of<\ElevenLabs\Types\McpConnectionStatusMcpConnectionStatusIntegrationsItemIntegrationType>
   */
  #[JsonProperty('integration_type', required: true)]
  public string $integrationType;

  #[JsonProperty('is_connected', required: true)]
  public bool $isConnected;

  #[JsonProperty('tool_count')]
  public ?int $toolCount;

  /**
   * @param array{
   *   integrationId: string,
   *   integrationType: value-of<\ElevenLabs\Types\McpConnectionStatusMcpConnectionStatusIntegrationsItemIntegrationType>,
   *   isConnected: bool,
   *   toolCount?: ?int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->integrationId = $values['integrationId'];
    $this->integrationType = $values['integrationType'];
    $this->isConnected = $values['isConnected'];
    $this->toolCount = $values['toolCount'] ?? null;

    $this->_dirtyFields = [
      'integration_id' => true,
      'integration_type' => true,
      'is_connected' => true
    ];
    if (array_key_exists('toolCount', $values)) {
      $this->_dirtyFields['tool_count'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'integration_id',
      'contents' => $this->integrationId
    ];

    $parts[] = [
      'name' => 'integration_type',
      'contents' => $this->integrationType
    ];

    $parts[] = [
      'name' => 'is_connected',
      'contents' => $this->isConnected ? 'true' : 'false'
    ];

    if ($this->toolCount !== null) {
      $parts[] = [
        'name' => 'tool_count',
        'contents' => (string) $this->toolCount
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
