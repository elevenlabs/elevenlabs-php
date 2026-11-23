<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class McpToolApprovalResult extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\McpToolApprovalResultType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * The ID of the tool call this approval responds to.
   */
  #[JsonProperty('tool_call_id', required: true)]
  public string $toolCallId;

  /**
   * Whether the user approved the tool call.
   */
  #[JsonProperty('is_approved', required: true)]
  public bool $isApproved;

  /**
   * @param array{
   *   toolCallId: string,
   *   isApproved: bool,
   *   type?: ?value-of<\ElevenLabs\Types\McpToolApprovalResultType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'mcp_tool_approval_result';
    $this->toolCallId = $values['toolCallId'];
    $this->isApproved = $values['isApproved'];

    $this->_dirtyFields = [
      'tool_call_id' => true,
      'is_approved' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
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
      'name' => 'tool_call_id',
      'contents' => $this->toolCallId
    ];

    $parts[] = [
      'name' => 'is_approved',
      'contents' => $this->isApproved ? 'true' : 'false'
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
