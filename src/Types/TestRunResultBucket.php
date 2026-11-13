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
class TestRunResultBucket extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var string[]
   */
  #[JsonProperty('test_run_ids', required: true), ArrayType(['string'])]
  public array $testRunIds;

  /**
   * Short one-line title for this bucket
   */
  #[JsonProperty('title', required: true)]
  public string $title;

  /**
   * Short summary of why the test runs in this bucket passed or failed
   */
  #[JsonProperty('reason', required: true)]
  public string $reason;

  /**
   * @var value-of<\ElevenLabs\Types\TestRunStatus>
   */
  #[JsonProperty('status', required: true)]
  public string $status;

  /**
   * @param array{
   *   testRunIds: string[],
   *   title: string,
   *   reason: string,
   *   status: value-of<\ElevenLabs\Types\TestRunStatus>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->testRunIds = $values['testRunIds'];
    $this->title = $values['title'];
    $this->reason = $values['reason'];
    $this->status = $values['status'];

    $this->_dirtyFields = [
      'test_run_ids' => true,
      'title' => true,
      'reason' => true,
      'status' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    foreach ($this->testRunIds as $item) {
      $parts[] = [
        'name' => 'test_run_ids',
        'contents' => $item
      ];
    }

    $parts[] = [
      'name' => 'title',
      'contents' => $this->title
    ];

    $parts[] = [
      'name' => 'reason',
      'contents' => $this->reason
    ];

    $parts[] = [
      'name' => 'status',
      'contents' => $this->status
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
