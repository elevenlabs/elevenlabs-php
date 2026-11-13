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
class GetTestSuiteInvocationResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('id', required: true)]
  public string $id;

  /**
   * The user-provided name of the test invocation, if one was set.
   */
  #[JsonProperty('name')]
  public ?string $name;

  #[JsonProperty('agent_id')]
  public ?string $agentId;

  #[JsonProperty('branch_id')]
  public ?string $branchId;

  #[JsonProperty('version_id')]
  public ?string $versionId;

  #[JsonProperty('ran_against_draft')]
  public ?bool $ranAgainstDraft;

  #[JsonProperty('created_at')]
  public ?int $createdAt;

  #[JsonProperty('folder_id')]
  public ?string $folderId;

  #[JsonProperty('repeat_count')]
  public ?int $repeatCount;

  #[JsonProperty('cancelled')]
  public ?bool $cancelled;

  /**
   * @var ?value-of<\ElevenLabs\Types\BucketingStatus>
   * None when repeat_count==1 (no bucketing). Otherwise tracks bucketing lifecycle.
   */
  #[JsonProperty('bucketing_status')]
  public ?string $bucketingStatus;

  /**
   * @var \ElevenLabs\Types\TestRunResultSummary[]|null
   */
  #[JsonProperty('result_groups'), ArrayType([\ElevenLabs\Types\TestRunResultSummary::class])]
  public ?array $resultGroups;

  /**
   * @var \ElevenLabs\Types\UnitTestRunResponseModel[]
   */
  #[
    JsonProperty('test_runs', required: true),
    ArrayType([\ElevenLabs\Types\UnitTestRunResponseModel::class])
  ]
  public array $testRuns;

  /**
   * @param array{
   *   id: string,
   *   testRuns: \ElevenLabs\Types\UnitTestRunResponseModel[],
   *   name?: ?string,
   *   agentId?: ?string,
   *   branchId?: ?string,
   *   versionId?: ?string,
   *   ranAgainstDraft?: ?bool,
   *   createdAt?: ?int,
   *   folderId?: ?string,
   *   repeatCount?: ?int,
   *   cancelled?: ?bool,
   *   bucketingStatus?: ?value-of<\ElevenLabs\Types\BucketingStatus>,
   *   resultGroups?: \ElevenLabs\Types\TestRunResultSummary[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->id = $values['id'];
    $this->name = $values['name'] ?? null;
    $this->agentId = $values['agentId'] ?? null;
    $this->branchId = $values['branchId'] ?? null;
    $this->versionId = $values['versionId'] ?? null;
    $this->ranAgainstDraft = $values['ranAgainstDraft'] ?? null;
    $this->createdAt = $values['createdAt'] ?? null;
    $this->folderId = $values['folderId'] ?? null;
    $this->repeatCount = $values['repeatCount'] ?? null;
    $this->cancelled = $values['cancelled'] ?? null;
    $this->bucketingStatus = $values['bucketingStatus'] ?? null;
    $this->resultGroups = $values['resultGroups'] ?? null;
    $this->testRuns = $values['testRuns'];

    $this->_dirtyFields = [
      'id' => true,
      'test_runs' => true
    ];
    if (array_key_exists('name', $values)) {
      $this->_dirtyFields['name'] = true;
    }
    if (array_key_exists('agentId', $values)) {
      $this->_dirtyFields['agent_id'] = true;
    }
    if (array_key_exists('branchId', $values)) {
      $this->_dirtyFields['branch_id'] = true;
    }
    if (array_key_exists('versionId', $values)) {
      $this->_dirtyFields['version_id'] = true;
    }
    if (array_key_exists('ranAgainstDraft', $values)) {
      $this->_dirtyFields['ran_against_draft'] = true;
    }
    if (array_key_exists('createdAt', $values)) {
      $this->_dirtyFields['created_at'] = true;
    }
    if (array_key_exists('folderId', $values)) {
      $this->_dirtyFields['folder_id'] = true;
    }
    if (array_key_exists('repeatCount', $values)) {
      $this->_dirtyFields['repeat_count'] = true;
    }
    if (array_key_exists('cancelled', $values)) {
      $this->_dirtyFields['cancelled'] = true;
    }
    if (array_key_exists('bucketingStatus', $values)) {
      $this->_dirtyFields['bucketing_status'] = true;
    }
    if (array_key_exists('resultGroups', $values)) {
      $this->_dirtyFields['result_groups'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'id',
      'contents' => $this->id
    ];

    if ($this->name !== null) {
      $parts[] = [
        'name' => 'name',
        'contents' => $this->name
      ];
    }

    if ($this->agentId !== null) {
      $parts[] = [
        'name' => 'agent_id',
        'contents' => $this->agentId
      ];
    }

    if ($this->branchId !== null) {
      $parts[] = [
        'name' => 'branch_id',
        'contents' => $this->branchId
      ];
    }

    if ($this->versionId !== null) {
      $parts[] = [
        'name' => 'version_id',
        'contents' => $this->versionId
      ];
    }

    if ($this->ranAgainstDraft !== null) {
      $parts[] = [
        'name' => 'ran_against_draft',
        'contents' => $this->ranAgainstDraft ? 'true' : 'false'
      ];
    }

    if ($this->createdAt !== null) {
      $parts[] = [
        'name' => 'created_at',
        'contents' => (string) $this->createdAt
      ];
    }

    if ($this->folderId !== null) {
      $parts[] = [
        'name' => 'folder_id',
        'contents' => $this->folderId
      ];
    }

    if ($this->repeatCount !== null) {
      $parts[] = [
        'name' => 'repeat_count',
        'contents' => (string) $this->repeatCount
      ];
    }

    if ($this->cancelled !== null) {
      $parts[] = [
        'name' => 'cancelled',
        'contents' => $this->cancelled ? 'true' : 'false'
      ];
    }

    if ($this->bucketingStatus !== null) {
      $parts[] = [
        'name' => 'bucketing_status',
        'contents' => $this->bucketingStatus
      ];
    }

    if ($this->resultGroups !== null) {
      $parts[] = [
        'name' => 'result_groups',
        'contents' => json_encode($this->resultGroups),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    $parts[] = [
      'name' => 'test_runs',
      'contents' => json_encode($this->testRuns),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->resultGroups ?? [] as $item) {
      $item->validate();
    }
    foreach ($this->testRuns as $item) {
      $item->validate();
    }
  }
}
