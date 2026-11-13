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
class AttachedTestModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('test_id', required: true)]
  public string $testId;

  #[JsonProperty('workflow_node_id')]
  public ?string $workflowNodeId;

  /**
   * @param array{
   *   testId: string,
   *   workflowNodeId?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->testId = $values['testId'];
    $this->workflowNodeId = $values['workflowNodeId'] ?? null;

    $this->_dirtyFields = [
      'test_id' => true
    ];
    if (array_key_exists('workflowNodeId', $values)) {
      $this->_dirtyFields['workflow_node_id'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'test_id',
      'contents' => $this->testId
    ];

    if ($this->workflowNodeId !== null) {
      $parts[] = [
        'name' => 'workflow_node_id',
        'contents' => $this->workflowNodeId
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
