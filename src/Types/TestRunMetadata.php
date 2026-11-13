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
class TestRunMetadata extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('workspace_id', required: true)]
  public string $workspaceId;

  #[JsonProperty('test_name', required: true)]
  public string $testName;

  #[JsonProperty('ran_by_user_email', required: true)]
  public string $ranByUserEmail;

  /**
   * @var ?value-of<\ElevenLabs\Types\TestRunMetadataTestType>
   */
  #[JsonProperty('test_type')]
  public ?string $testType;

  /**
   * @param array{
   *   workspaceId: string,
   *   testName: string,
   *   ranByUserEmail: string,
   *   testType?: ?value-of<\ElevenLabs\Types\TestRunMetadataTestType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->workspaceId = $values['workspaceId'];
    $this->testName = $values['testName'];
    $this->ranByUserEmail = $values['ranByUserEmail'];
    $this->testType = $values['testType'] ?? null;

    $this->_dirtyFields = [
      'workspace_id' => true,
      'test_name' => true,
      'ran_by_user_email' => true
    ];
    if (array_key_exists('testType', $values)) {
      $this->_dirtyFields['test_type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'workspace_id',
      'contents' => $this->workspaceId
    ];

    $parts[] = [
      'name' => 'test_name',
      'contents' => $this->testName
    ];

    $parts[] = [
      'name' => 'ran_by_user_email',
      'contents' => $this->ranByUserEmail
    ];

    if ($this->testType !== null) {
      $parts[] = [
        'name' => 'test_type',
        'contents' => $this->testType
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
