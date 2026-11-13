<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * Response model representing an MCP Server configuration.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class McpServerResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('id', required: true)]
  public string $id;

  #[JsonProperty('config', required: true)]
  public \ElevenLabs\Types\McpServerConfigOutput $config;

  /**
   * The access information of the MCP Server
   */
  #[JsonProperty('access_info')]
  public ?\ElevenLabs\Types\ResourceAccessInfo $accessInfo;

  /**
   * @var \ElevenLabs\Types\McpServerResponseModelDependentAgentsItem[]|null
   * List of agents that depend on this MCP Server.
   */
  #[
    JsonProperty('dependent_agents'),
    ArrayType([\ElevenLabs\Types\McpServerResponseModelDependentAgentsItem::class])
  ]
  public ?array $dependentAgents;

  #[JsonProperty('metadata', required: true)]
  public \ElevenLabs\Types\McpServerMetadataResponseModel $metadata;

  /**
   * @param array{
   *   id: string,
   *   config: \ElevenLabs\Types\McpServerConfigOutput,
   *   metadata: \ElevenLabs\Types\McpServerMetadataResponseModel,
   *   accessInfo?: ?\ElevenLabs\Types\ResourceAccessInfo,
   *   dependentAgents?: \ElevenLabs\Types\McpServerResponseModelDependentAgentsItem[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->id = $values['id'];
    $this->config = $values['config'];
    $this->accessInfo = $values['accessInfo'] ?? null;
    $this->dependentAgents = $values['dependentAgents'] ?? null;
    $this->metadata = $values['metadata'];

    $this->_dirtyFields = [
      'id' => true,
      'config' => true,
      'metadata' => true
    ];
    if (array_key_exists('accessInfo', $values)) {
      $this->_dirtyFields['access_info'] = true;
    }
    if (array_key_exists('dependentAgents', $values)) {
      $this->_dirtyFields['dependent_agents'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'id',
      'contents' => $this->id
    ];

    $parts[] = [
      'name' => 'config',
      'contents' => json_encode($this->config),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->accessInfo !== null) {
      $parts[] = [
        'name' => 'access_info',
        'contents' => json_encode($this->accessInfo),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->dependentAgents !== null) {
      $parts[] = [
        'name' => 'dependent_agents',
        'contents' => json_encode($this->dependentAgents),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    $parts[] = [
      'name' => 'metadata',
      'contents' => json_encode($this->metadata),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->config->validate();
    $this->accessInfo?->validate();
    $this->metadata->validate();
  }
}
