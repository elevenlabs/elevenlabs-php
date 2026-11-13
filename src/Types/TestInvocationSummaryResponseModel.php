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
class TestInvocationSummaryResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The ID of the test invocation
   */
  #[JsonProperty('id', required: true)]
  public string $id;

  /**
   * The user-provided name of the test invocation, if one was set.
   */
  #[JsonProperty('name')]
  public ?string $name;

  /**
   * The ID of the agent this test invocation belongs to
   */
  #[JsonProperty('agent_id')]
  public ?string $agentId;

  /**
   * The ID of the branch this test invocation was run on
   */
  #[JsonProperty('branch_id')]
  public ?string $branchId;

  /**
   * The ID of the agent version this test invocation ran against. For draft or config-override runs this is the version those uncommitted changes were applied on top of. None only for runs recorded before this field existed.
   */
  #[JsonProperty('version_id')]
  public ?string $versionId;

  /**
   * Whether the run included uncommitted changes (a saved draft or an ad-hoc config override) layered on top of version_id.
   */
  #[JsonProperty('ran_against_draft')]
  public ?bool $ranAgainstDraft;

  /**
   * Whether the test runs in this invocation did not all execute against the same version, which happens when a subset of runs was resubmitted after the original run. When true, version_id describes the most recent resubmit rather than every run.
   */
  #[JsonProperty('runs_diverged_from_version')]
  public ?bool $runsDivergedFromVersion;

  /**
   * Creation time of the test invocation in unix seconds
   */
  #[JsonProperty('created_at_unix_secs', required: true)]
  public int $createdAtUnixSecs;

  /**
   * Number of test runs in this invocation
   */
  #[JsonProperty('test_run_count', required: true)]
  public int $testRunCount;

  /**
   * Number of test runs that passed
   */
  #[JsonProperty('passed_count', required: true)]
  public int $passedCount;

  /**
   * Number of test runs that failed
   */
  #[JsonProperty('failed_count', required: true)]
  public int $failedCount;

  /**
   * Number of test runs that are pending
   */
  #[JsonProperty('pending_count', required: true)]
  public int $pendingCount;

  /**
   * Number of test runs that were cancelled
   */
  #[JsonProperty('cancelled_count', required: true)]
  public int $cancelledCount;

  /**
   * Display title of the test invocation: the user-provided name when set, otherwise the folder name, single test name, or test count.
   */
  #[JsonProperty('title', required: true)]
  public string $title;

  /**
   * The access information of the test invocation
   */
  #[JsonProperty('access_info')]
  public ?\ElevenLabs\Types\ResourceAccessInfo $accessInfo;

  /**
   * Number of times each test was repeated in this invocation
   */
  #[JsonProperty('repeat_count')]
  public ?int $repeatCount;

  /**
   * Whether this test invocation was cancelled
   */
  #[JsonProperty('cancelled')]
  public ?bool $cancelled;

  /**
   * Total credits billed across test runs in this invocation. None when no run has cost data.
   */
  #[JsonProperty('credits_used')]
  public ?int $creditsUsed;

  /**
   * Total USD price across test runs in this invocation. None when no run has price data.
   */
  #[JsonProperty('total_price')]
  public ?float $totalPrice;

  /**
   * @param array{
   *   id: string,
   *   createdAtUnixSecs: int,
   *   testRunCount: int,
   *   passedCount: int,
   *   failedCount: int,
   *   pendingCount: int,
   *   cancelledCount: int,
   *   title: string,
   *   name?: ?string,
   *   agentId?: ?string,
   *   branchId?: ?string,
   *   versionId?: ?string,
   *   ranAgainstDraft?: ?bool,
   *   runsDivergedFromVersion?: ?bool,
   *   accessInfo?: ?\ElevenLabs\Types\ResourceAccessInfo,
   *   repeatCount?: ?int,
   *   cancelled?: ?bool,
   *   creditsUsed?: ?int,
   *   totalPrice?: ?float,
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
    $this->runsDivergedFromVersion = $values['runsDivergedFromVersion'] ?? null;
    $this->createdAtUnixSecs = $values['createdAtUnixSecs'];
    $this->testRunCount = $values['testRunCount'];
    $this->passedCount = $values['passedCount'];
    $this->failedCount = $values['failedCount'];
    $this->pendingCount = $values['pendingCount'];
    $this->cancelledCount = $values['cancelledCount'];
    $this->title = $values['title'];
    $this->accessInfo = $values['accessInfo'] ?? null;
    $this->repeatCount = $values['repeatCount'] ?? null;
    $this->cancelled = $values['cancelled'] ?? null;
    $this->creditsUsed = $values['creditsUsed'] ?? null;
    $this->totalPrice = $values['totalPrice'] ?? null;

    $this->_dirtyFields = [
      'id' => true,
      'created_at_unix_secs' => true,
      'test_run_count' => true,
      'passed_count' => true,
      'failed_count' => true,
      'pending_count' => true,
      'cancelled_count' => true,
      'title' => true
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
    if (array_key_exists('runsDivergedFromVersion', $values)) {
      $this->_dirtyFields['runs_diverged_from_version'] = true;
    }
    if (array_key_exists('accessInfo', $values)) {
      $this->_dirtyFields['access_info'] = true;
    }
    if (array_key_exists('repeatCount', $values)) {
      $this->_dirtyFields['repeat_count'] = true;
    }
    if (array_key_exists('cancelled', $values)) {
      $this->_dirtyFields['cancelled'] = true;
    }
    if (array_key_exists('creditsUsed', $values)) {
      $this->_dirtyFields['credits_used'] = true;
    }
    if (array_key_exists('totalPrice', $values)) {
      $this->_dirtyFields['total_price'] = true;
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

    if ($this->runsDivergedFromVersion !== null) {
      $parts[] = [
        'name' => 'runs_diverged_from_version',
        'contents' => $this->runsDivergedFromVersion ? 'true' : 'false'
      ];
    }

    $parts[] = [
      'name' => 'created_at_unix_secs',
      'contents' => (string) $this->createdAtUnixSecs
    ];

    $parts[] = [
      'name' => 'test_run_count',
      'contents' => (string) $this->testRunCount
    ];

    $parts[] = [
      'name' => 'passed_count',
      'contents' => (string) $this->passedCount
    ];

    $parts[] = [
      'name' => 'failed_count',
      'contents' => (string) $this->failedCount
    ];

    $parts[] = [
      'name' => 'pending_count',
      'contents' => (string) $this->pendingCount
    ];

    $parts[] = [
      'name' => 'cancelled_count',
      'contents' => (string) $this->cancelledCount
    ];

    $parts[] = [
      'name' => 'title',
      'contents' => $this->title
    ];

    if ($this->accessInfo !== null) {
      $parts[] = [
        'name' => 'access_info',
        'contents' => json_encode($this->accessInfo),
        'headers' => ['Content-Type' => 'application/json']
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

    if ($this->creditsUsed !== null) {
      $parts[] = [
        'name' => 'credits_used',
        'contents' => (string) $this->creditsUsed
      ];
    }

    if ($this->totalPrice !== null) {
      $parts[] = [
        'name' => 'total_price',
        'contents' => (string) $this->totalPrice
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->accessInfo?->validate();
  }
}
