<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * Snapshot of the MCP tool definition that was approved.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class McpApprovedToolDefinition extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The MCP server-provided tool description at approval time
   */
  #[JsonProperty('description')]
  public ?string $description;

  /**
   * @var array<string, mixed>|null
   * The MCP server-provided JSON input schema at approval time
   */
  #[JsonProperty('input_schema'), ArrayType(['string' => 'mixed'])]
  public ?array $inputSchema;

  /**
   * @param array{
   *   description?: ?string,
   *   inputSchema?: array<string, mixed>|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->description = $values['description'] ?? null;
    $this->inputSchema = $values['inputSchema'] ?? null;

    if (array_key_exists('description', $values)) {
      $this->_dirtyFields['description'] = true;
    }
    if (array_key_exists('inputSchema', $values)) {
      $this->_dirtyFields['input_schema'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->description !== null) {
      $parts[] = [
        'name' => 'description',
        'contents' => $this->description
      ];
    }

    if ($this->inputSchema !== null) {
      $parts[] = [
        'name' => 'input_schema',
        'contents' => json_encode($this->inputSchema),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
