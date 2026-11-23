<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * MCP connection status with array of integration statuses.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class McpConnectionStatusMcpConnectionStatus extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\McpConnectionStatusMcpConnectionStatusIntegrationsItem[]|null
   */
  #[
    JsonProperty('integrations'),
    ArrayType([\ElevenLabs\Types\McpConnectionStatusMcpConnectionStatusIntegrationsItem::class])
  ]
  public ?array $integrations;

  /**
   * @param array{
   *   integrations?: \ElevenLabs\Types\McpConnectionStatusMcpConnectionStatusIntegrationsItem[]|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->integrations = $values['integrations'] ?? null;

    if (array_key_exists('integrations', $values)) {
      $this->_dirtyFields['integrations'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->integrations !== null) {
      $parts[] = [
        'name' => 'integrations',
        'contents' => json_encode($this->integrations),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->integrations ?? [] as $item) {
      $item->validate();
    }
  }
}
