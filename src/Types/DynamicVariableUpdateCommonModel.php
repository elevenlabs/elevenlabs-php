<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * Tracks a dynamic variable update that occurred during tool execution.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class DynamicVariableUpdateCommonModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('variable_name', required: true)]
  public string $variableName;

  #[JsonProperty('old_value', required: true)]
  public ?string $oldValue;

  #[JsonProperty('new_value', required: true)]
  public string $newValue;

  #[JsonProperty('updated_at', required: true)]
  public float $updatedAt;

  #[JsonProperty('tool_name', required: true)]
  public string $toolName;

  #[JsonProperty('tool_request_id', required: true)]
  public string $toolRequestId;

  /**
   * @param array{
   *   variableName: string,
   *   oldValue: ?string,
   *   newValue: string,
   *   updatedAt: float,
   *   toolName: string,
   *   toolRequestId: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->variableName = $values['variableName'];
    $this->oldValue = $values['oldValue'];
    $this->newValue = $values['newValue'];
    $this->updatedAt = $values['updatedAt'];
    $this->toolName = $values['toolName'];
    $this->toolRequestId = $values['toolRequestId'];

    $this->_dirtyFields = [
      'variable_name' => true,
      'old_value' => true,
      'new_value' => true,
      'updated_at' => true,
      'tool_name' => true,
      'tool_request_id' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'variable_name',
      'contents' => $this->variableName
    ];

    $parts[] = [
      'name' => 'old_value',
      'contents' => $this->oldValue
    ];

    $parts[] = [
      'name' => 'new_value',
      'contents' => $this->newValue
    ];

    $parts[] = [
      'name' => 'updated_at',
      'contents' => (string) $this->updatedAt
    ];

    $parts[] = [
      'name' => 'tool_name',
      'contents' => $this->toolName
    ];

    $parts[] = [
      'name' => 'tool_request_id',
      'contents' => $this->toolRequestId
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
