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
class SingleTestRunRequestModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * ID of the test to run
   */
  #[JsonProperty('test_id', required: true)]
  public string $testId;

  /**
   * ID of the workflow node to run the test on. If not provided, the test will be run on the agent's default workflow node.
   */
  #[JsonProperty('workflow_node_id')]
  public ?string $workflowNodeId;

  /**
   * ID of the root folder to run the test on. If not provided, the test will be run on the agent's default folder.
   */
  #[JsonProperty('root_folder_id')]
  public ?string $rootFolderId;

  /**
   * Name of the root folder to run the test on. If not provided, the test will be run on the agent's default folder.
   */
  #[JsonProperty('root_folder_name')]
  public ?string $rootFolderName;

  /**
   * @param array{
   *   testId: string,
   *   workflowNodeId?: ?string,
   *   rootFolderId?: ?string,
   *   rootFolderName?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->testId = $values['testId'];
    $this->workflowNodeId = $values['workflowNodeId'] ?? null;
    $this->rootFolderId = $values['rootFolderId'] ?? null;
    $this->rootFolderName = $values['rootFolderName'] ?? null;

    $this->_dirtyFields = [
      'test_id' => true
    ];
    if (array_key_exists('workflowNodeId', $values)) {
      $this->_dirtyFields['workflow_node_id'] = true;
    }
    if (array_key_exists('rootFolderId', $values)) {
      $this->_dirtyFields['root_folder_id'] = true;
    }
    if (array_key_exists('rootFolderName', $values)) {
      $this->_dirtyFields['root_folder_name'] = true;
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

    if ($this->rootFolderId !== null) {
      $parts[] = [
        'name' => 'root_folder_id',
        'contents' => $this->rootFolderId
      ];
    }

    if ($this->rootFolderName !== null) {
      $parts[] = [
        'name' => 'root_folder_name',
        'contents' => $this->rootFolderName
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
