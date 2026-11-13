<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\McpServers\ToolApprovals\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * Request model for adding approval for a single MCP tool.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class McpToolAddApprovalRequestModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The name of the MCP tool
   */
  #[JsonProperty('tool_name', required: true)]
  public string $toolName;

  /**
   * The description of the MCP tool
   */
  #[JsonProperty('tool_description', required: true)]
  public string $toolDescription;

  /**
   * @var array<string, mixed>|null
   * The input schema of the MCP tool (the schema defined on the MCP server before ElevenLabs does any extra processing)
   */
  #[JsonProperty('input_schema'), ArrayType(['string' => 'mixed'])]
  public ?array $inputSchema;

  /**
   * @var ?value-of<\ElevenLabs\Types\McpToolApprovalPolicy>
   * Defines the tool-level approval policy.
   */
  #[JsonProperty('approval_policy')]
  public ?string $approvalPolicy;

  /**
   * @param array{
   *   toolName: string,
   *   toolDescription: string,
   *   inputSchema?: array<string, mixed>|null,
   *   approvalPolicy?: ?value-of<\ElevenLabs\Types\McpToolApprovalPolicy>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->toolName = $values['toolName'];
    $this->toolDescription = $values['toolDescription'];
    $this->inputSchema = $values['inputSchema'] ?? null;
    $this->approvalPolicy = $values['approvalPolicy'] ?? null;

    $this->_dirtyFields = [
      'tool_name' => true,
      'tool_description' => true
    ];
    if (array_key_exists('inputSchema', $values)) {
      $this->_dirtyFields['input_schema'] = true;
    }
    if (array_key_exists('approvalPolicy', $values)) {
      $this->_dirtyFields['approval_policy'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'tool_name',
      'contents' => $this->toolName
    ];

    $parts[] = [
      'name' => 'tool_description',
      'contents' => $this->toolDescription
    ];

    if ($this->inputSchema !== null) {
      $parts[] = [
        'name' => 'input_schema',
        'contents' => json_encode($this->inputSchema),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->approvalPolicy !== null) {
      $parts[] = [
        'name' => 'approval_policy',
        'contents' => $this->approvalPolicy
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
