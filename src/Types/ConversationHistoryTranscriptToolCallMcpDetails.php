<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ConversationHistoryTranscriptToolCallMcpDetails extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\ConversationHistoryTranscriptToolCallMcpDetailsType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  #[JsonProperty('mcp_server_id', required: true)]
  public string $mcpServerId;

  #[JsonProperty('mcp_server_name', required: true)]
  public string $mcpServerName;

  #[JsonProperty('integration_type', required: true)]
  public string $integrationType;

  /**
   * @var array<string, string>|null
   */
  #[JsonProperty('parameters'), ArrayType(['string' => 'string'])]
  public ?array $parameters;

  #[JsonProperty('approval_policy', required: true)]
  public string $approvalPolicy;

  #[JsonProperty('requires_approval')]
  public ?bool $requiresApproval;

  #[JsonProperty('mcp_tool_name')]
  public ?string $mcpToolName;

  #[JsonProperty('mcp_tool_description')]
  public ?string $mcpToolDescription;

  /**
   * @param array{
   *   mcpServerId: string,
   *   mcpServerName: string,
   *   integrationType: string,
   *   approvalPolicy: string,
   *   type?: ?value-of<\ElevenLabs\Types\ConversationHistoryTranscriptToolCallMcpDetailsType>,
   *   parameters?: array<string, string>|null,
   *   requiresApproval?: ?bool,
   *   mcpToolName?: ?string,
   *   mcpToolDescription?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'mcp';
    $this->mcpServerId = $values['mcpServerId'];
    $this->mcpServerName = $values['mcpServerName'];
    $this->integrationType = $values['integrationType'];
    $this->parameters = $values['parameters'] ?? null;
    $this->approvalPolicy = $values['approvalPolicy'];
    $this->requiresApproval = $values['requiresApproval'] ?? null;
    $this->mcpToolName = $values['mcpToolName'] ?? null;
    $this->mcpToolDescription = $values['mcpToolDescription'] ?? null;

    $this->_dirtyFields = [
      'mcp_server_id' => true,
      'mcp_server_name' => true,
      'integration_type' => true,
      'approval_policy' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
    if (array_key_exists('parameters', $values)) {
      $this->_dirtyFields['parameters'] = true;
    }
    if (array_key_exists('requiresApproval', $values)) {
      $this->_dirtyFields['requires_approval'] = true;
    }
    if (array_key_exists('mcpToolName', $values)) {
      $this->_dirtyFields['mcp_tool_name'] = true;
    }
    if (array_key_exists('mcpToolDescription', $values)) {
      $this->_dirtyFields['mcp_tool_description'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->type !== null) {
      $parts[] = [
        'name' => 'type',
        'contents' => $this->type
      ];
    }

    $parts[] = [
      'name' => 'mcp_server_id',
      'contents' => $this->mcpServerId
    ];

    $parts[] = [
      'name' => 'mcp_server_name',
      'contents' => $this->mcpServerName
    ];

    $parts[] = [
      'name' => 'integration_type',
      'contents' => $this->integrationType
    ];

    if ($this->parameters !== null) {
      $parts[] = [
        'name' => 'parameters',
        'contents' => json_encode($this->parameters),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    $parts[] = [
      'name' => 'approval_policy',
      'contents' => $this->approvalPolicy
    ];

    if ($this->requiresApproval !== null) {
      $parts[] = [
        'name' => 'requires_approval',
        'contents' => $this->requiresApproval ? 'true' : 'false'
      ];
    }

    if ($this->mcpToolName !== null) {
      $parts[] = [
        'name' => 'mcp_tool_name',
        'contents' => $this->mcpToolName
      ];
    }

    if ($this->mcpToolDescription !== null) {
      $parts[] = [
        'name' => 'mcp_tool_description',
        'contents' => $this->mcpToolDescription
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
