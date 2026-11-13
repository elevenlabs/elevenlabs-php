<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * Response model for testing tools available on an MCP server.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ListMcpToolsResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Indicates if the operation was successful.
   */
  #[JsonProperty('success', required: true)]
  public bool $success;

  /**
   * @var \ElevenLabs\Types\Tool[]
   * A list of tools available on the MCP server.
   */
  #[JsonProperty('tools', required: true), ArrayType([\ElevenLabs\Types\Tool::class])]
  public array $tools;

  /**
   * @var \ElevenLabs\Types\McpToolApprovalStatus[]|null
   * Derived approval states for currently discovered tools. Populated only for persisted MCP servers using per-tool approval; otherwise empty.
   */
  #[
    JsonProperty('tool_approval_statuses'),
    ArrayType([\ElevenLabs\Types\McpToolApprovalStatus::class])
  ]
  public ?array $toolApprovalStatuses;

  /**
   * Error message if the operation was not successful.
   */
  #[JsonProperty('error_message')]
  public ?string $errorMessage;

  /**
   * @param array{
   *   success: bool,
   *   tools: \ElevenLabs\Types\Tool[],
   *   toolApprovalStatuses?: \ElevenLabs\Types\McpToolApprovalStatus[]|null,
   *   errorMessage?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->success = $values['success'];
    $this->tools = $values['tools'];
    $this->toolApprovalStatuses = $values['toolApprovalStatuses'] ?? null;
    $this->errorMessage = $values['errorMessage'] ?? null;

    $this->_dirtyFields = [
      'success' => true,
      'tools' => true
    ];
    if (array_key_exists('toolApprovalStatuses', $values)) {
      $this->_dirtyFields['tool_approval_statuses'] = true;
    }
    if (array_key_exists('errorMessage', $values)) {
      $this->_dirtyFields['error_message'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'success',
      'contents' => $this->success ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'tools',
      'contents' => json_encode($this->tools),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->toolApprovalStatuses !== null) {
      $parts[] = [
        'name' => 'tool_approval_statuses',
        'contents' => json_encode($this->toolApprovalStatuses),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->errorMessage !== null) {
      $parts[] = [
        'name' => 'error_message',
        'contents' => $this->errorMessage
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->tools as $item) {
      $item->validate();
    }
    foreach ($this->toolApprovalStatuses ?? [] as $item) {
      $item->validate();
    }
  }
}
