<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * Request model for updating MCP Server approval mode.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class McpApprovalPolicyUpdateRequestModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\McpApprovalPolicy>
   * Defines the MCP server-level approval policy for tool execution.
   */
  #[JsonProperty('approval_policy', required: true)]
  public string $approvalPolicy;

  /**
   * @param array{
   *   approvalPolicy: value-of<\ElevenLabs\Types\McpApprovalPolicy>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->approvalPolicy = $values['approvalPolicy'];

    $this->_dirtyFields = [
      'approval_policy' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'approval_policy',
      'contents' => $this->approvalPolicy
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
