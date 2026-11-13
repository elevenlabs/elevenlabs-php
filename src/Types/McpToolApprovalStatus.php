<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * Derived approval state for a currently discovered MCP tool.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class McpToolApprovalStatus extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Canonical MCP tool identifier in the form mcp:<server_id>:<tool_name>
   */
  #[JsonProperty('tool_id', required: true)]
  public string $toolId;

  /**
   * @var value-of<\ElevenLabs\Types\McpToolApprovalState>
   * Whether a discovered MCP tool has an approval and whether it still matches.
   */
  #[JsonProperty('state', required: true)]
  public string $state;

  /**
   * @var ?value-of<\ElevenLabs\Types\McpToolApprovalPolicy>
   * Stored execution policy. Set when the tool has an approval.
   */
  #[JsonProperty('approval_policy')]
  public ?string $approvalPolicy;

  /**
   * Previously approved definition, included when the tool needs review and a snapshot exists.
   */
  #[JsonProperty('approved_definition')]
  public ?\ElevenLabs\Types\McpApprovedToolDefinition $approvedDefinition;

  /**
   * @param array{
   *   toolId: string,
   *   state: value-of<\ElevenLabs\Types\McpToolApprovalState>,
   *   approvalPolicy?: ?value-of<\ElevenLabs\Types\McpToolApprovalPolicy>,
   *   approvedDefinition?: ?\ElevenLabs\Types\McpApprovedToolDefinition,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->toolId = $values['toolId'];
    $this->state = $values['state'];
    $this->approvalPolicy = $values['approvalPolicy'] ?? null;
    $this->approvedDefinition = $values['approvedDefinition'] ?? null;

    $this->_dirtyFields = [
      'tool_id' => true,
      'state' => true
    ];
    if (array_key_exists('approvalPolicy', $values)) {
      $this->_dirtyFields['approval_policy'] = true;
    }
    if (array_key_exists('approvedDefinition', $values)) {
      $this->_dirtyFields['approved_definition'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'tool_id',
      'contents' => $this->toolId
    ];

    $parts[] = [
      'name' => 'state',
      'contents' => $this->state
    ];

    if ($this->approvalPolicy !== null) {
      $parts[] = [
        'name' => 'approval_policy',
        'contents' => $this->approvalPolicy
      ];
    }

    if ($this->approvedDefinition !== null) {
      $parts[] = [
        'name' => 'approved_definition',
        'contents' => json_encode($this->approvedDefinition),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->approvedDefinition?->validate();
  }
}
