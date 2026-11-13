<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * Model for storing tool approval hashes for per-tool approval.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class McpToolApprovalHash extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The name of the MCP tool
   */
  #[JsonProperty('tool_name', required: true)]
  public string $toolName;

  /**
   * SHA256 hash of the tool's parameters and description
   */
  #[JsonProperty('tool_hash', required: true)]
  public string $toolHash;

  /**
   * @var ?value-of<\ElevenLabs\Types\McpToolApprovalPolicy>
   * Defines the tool-level approval policy.
   */
  #[JsonProperty('approval_policy')]
  public ?string $approvalPolicy;

  /**
   * @param array{
   *   toolName: string,
   *   toolHash: string,
   *   approvalPolicy?: ?value-of<\ElevenLabs\Types\McpToolApprovalPolicy>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->toolName = $values['toolName'];
    $this->toolHash = $values['toolHash'];
    $this->approvalPolicy = $values['approvalPolicy'] ?? null;

    $this->_dirtyFields = [
      'tool_name' => true,
      'tool_hash' => true
    ];
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
      'name' => 'tool_hash',
      'contents' => $this->toolHash
    ];

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
