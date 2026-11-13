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
class TestRunResultSummary extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('test_id', required: true)]
  public string $testId;

  #[JsonProperty('test_name', required: true)]
  public string $testName;

  #[JsonProperty('workflow_node_id')]
  public ?string $workflowNodeId;

  /**
   * @var \ElevenLabs\Types\TestRunResultBucket[]
   */
  #[
    JsonProperty('buckets', required: true),
    ArrayType([\ElevenLabs\Types\TestRunResultBucket::class])
  ]
  public array $buckets;

  /**
   * @param array{
   *   testId: string,
   *   testName: string,
   *   buckets: \ElevenLabs\Types\TestRunResultBucket[],
   *   workflowNodeId?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->testId = $values['testId'];
    $this->testName = $values['testName'];
    $this->workflowNodeId = $values['workflowNodeId'] ?? null;
    $this->buckets = $values['buckets'];

    $this->_dirtyFields = [
      'test_id' => true,
      'test_name' => true,
      'buckets' => true
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

    $parts[] = [
      'name' => 'test_name',
      'contents' => $this->testName
    ];

    if ($this->workflowNodeId !== null) {
      $parts[] = [
        'name' => 'workflow_node_id',
        'contents' => $this->workflowNodeId
      ];
    }

    $parts[] = [
      'name' => 'buckets',
      'contents' => json_encode($this->buckets),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->buckets as $item) {
      $item->validate();
    }
  }
}
