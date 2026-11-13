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
class UnitTestRunResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('test_run_id', required: true)]
  public string $testRunId;

  #[JsonProperty('test_info')]
  public ?\ElevenLabs\Types\UnitTestRunResponseModelTestInfo $testInfo;

  #[JsonProperty('test_invocation_id', required: true)]
  public string $testInvocationId;

  #[JsonProperty('agent_id', required: true)]
  public string $agentId;

  #[JsonProperty('branch_id')]
  public ?string $branchId;

  #[JsonProperty('version_id')]
  public ?string $versionId;

  #[JsonProperty('ran_against_draft')]
  public ?bool $ranAgainstDraft;

  #[JsonProperty('workflow_node_id')]
  public ?string $workflowNodeId;

  /**
   * @var value-of<\ElevenLabs\Types\TestRunStatus>
   */
  #[JsonProperty('status', required: true)]
  public string $status;

  /**
   * @var \ElevenLabs\Types\ConversationHistoryTranscriptCommonModelOutput[]|null
   */
  #[
    JsonProperty('agent_responses'),
    ArrayType([\ElevenLabs\Types\ConversationHistoryTranscriptCommonModelOutput::class])
  ]
  public ?array $agentResponses;

  /**
   * @var \ElevenLabs\Types\TriggeredGuardrailCommonModel[]|null
   * Guardrails observed during this run, including blocks before an agent response.
   */
  #[
    JsonProperty('triggered_guardrails'),
    ArrayType([\ElevenLabs\Types\TriggeredGuardrailCommonModel::class])
  ]
  public ?array $triggeredGuardrails;

  #[JsonProperty('test_id', required: true)]
  public string $testId;

  #[JsonProperty('test_name')]
  public ?string $testName;

  #[JsonProperty('condition_result')]
  public ?\ElevenLabs\Types\TestConditionResultCommonModel $conditionResult;

  #[JsonProperty('last_updated_at_unix')]
  public ?int $lastUpdatedAtUnix;

  #[JsonProperty('metadata')]
  public ?\ElevenLabs\Types\TestRunMetadata $metadata;

  #[JsonProperty('root_folder_id')]
  public ?string $rootFolderId;

  #[JsonProperty('root_folder_name')]
  public ?string $rootFolderName;

  #[JsonProperty('environment')]
  public ?string $environment;

  /**
   * Credits billed for this test run. None for runs created before cost tracking.
   */
  #[JsonProperty('credits_used')]
  public ?int $creditsUsed;

  /**
   * Finalized billing and provider-usage breakdown for this test run.
   */
  #[JsonProperty('charging')]
  public ?\ElevenLabs\Types\ConversationChargingCommonModel $charging;

  /**
   * @param array{
   *   testRunId: string,
   *   testInvocationId: string,
   *   agentId: string,
   *   status: value-of<\ElevenLabs\Types\TestRunStatus>,
   *   testId: string,
   *   testInfo?: ?\ElevenLabs\Types\UnitTestRunResponseModelTestInfo,
   *   branchId?: ?string,
   *   versionId?: ?string,
   *   ranAgainstDraft?: ?bool,
   *   workflowNodeId?: ?string,
   *   agentResponses?: \ElevenLabs\Types\ConversationHistoryTranscriptCommonModelOutput[]|null,
   *   triggeredGuardrails?: \ElevenLabs\Types\TriggeredGuardrailCommonModel[]|null,
   *   testName?: ?string,
   *   conditionResult?: ?\ElevenLabs\Types\TestConditionResultCommonModel,
   *   lastUpdatedAtUnix?: ?int,
   *   metadata?: ?\ElevenLabs\Types\TestRunMetadata,
   *   rootFolderId?: ?string,
   *   rootFolderName?: ?string,
   *   environment?: ?string,
   *   creditsUsed?: ?int,
   *   charging?: ?\ElevenLabs\Types\ConversationChargingCommonModel,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->testRunId = $values['testRunId'];
    $this->testInfo = $values['testInfo'] ?? null;
    $this->testInvocationId = $values['testInvocationId'];
    $this->agentId = $values['agentId'];
    $this->branchId = $values['branchId'] ?? null;
    $this->versionId = $values['versionId'] ?? null;
    $this->ranAgainstDraft = $values['ranAgainstDraft'] ?? null;
    $this->workflowNodeId = $values['workflowNodeId'] ?? null;
    $this->status = $values['status'];
    $this->agentResponses = $values['agentResponses'] ?? null;
    $this->triggeredGuardrails = $values['triggeredGuardrails'] ?? null;
    $this->testId = $values['testId'];
    $this->testName = $values['testName'] ?? null;
    $this->conditionResult = $values['conditionResult'] ?? null;
    $this->lastUpdatedAtUnix = $values['lastUpdatedAtUnix'] ?? null;
    $this->metadata = $values['metadata'] ?? null;
    $this->rootFolderId = $values['rootFolderId'] ?? null;
    $this->rootFolderName = $values['rootFolderName'] ?? null;
    $this->environment = $values['environment'] ?? null;
    $this->creditsUsed = $values['creditsUsed'] ?? null;
    $this->charging = $values['charging'] ?? null;

    $this->_dirtyFields = [
      'test_run_id' => true,
      'test_invocation_id' => true,
      'agent_id' => true,
      'status' => true,
      'test_id' => true
    ];
    if (array_key_exists('testInfo', $values)) {
      $this->_dirtyFields['test_info'] = true;
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
    if (array_key_exists('workflowNodeId', $values)) {
      $this->_dirtyFields['workflow_node_id'] = true;
    }
    if (array_key_exists('agentResponses', $values)) {
      $this->_dirtyFields['agent_responses'] = true;
    }
    if (array_key_exists('triggeredGuardrails', $values)) {
      $this->_dirtyFields['triggered_guardrails'] = true;
    }
    if (array_key_exists('testName', $values)) {
      $this->_dirtyFields['test_name'] = true;
    }
    if (array_key_exists('conditionResult', $values)) {
      $this->_dirtyFields['condition_result'] = true;
    }
    if (array_key_exists('lastUpdatedAtUnix', $values)) {
      $this->_dirtyFields['last_updated_at_unix'] = true;
    }
    if (array_key_exists('metadata', $values)) {
      $this->_dirtyFields['metadata'] = true;
    }
    if (array_key_exists('rootFolderId', $values)) {
      $this->_dirtyFields['root_folder_id'] = true;
    }
    if (array_key_exists('rootFolderName', $values)) {
      $this->_dirtyFields['root_folder_name'] = true;
    }
    if (array_key_exists('environment', $values)) {
      $this->_dirtyFields['environment'] = true;
    }
    if (array_key_exists('creditsUsed', $values)) {
      $this->_dirtyFields['credits_used'] = true;
    }
    if (array_key_exists('charging', $values)) {
      $this->_dirtyFields['charging'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'test_run_id',
      'contents' => $this->testRunId
    ];

    if ($this->testInfo !== null) {
      $parts[] = [
        'name' => 'test_info',
        'contents' => json_encode($this->testInfo),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    $parts[] = [
      'name' => 'test_invocation_id',
      'contents' => $this->testInvocationId
    ];

    $parts[] = [
      'name' => 'agent_id',
      'contents' => $this->agentId
    ];

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

    if ($this->workflowNodeId !== null) {
      $parts[] = [
        'name' => 'workflow_node_id',
        'contents' => $this->workflowNodeId
      ];
    }

    $parts[] = [
      'name' => 'status',
      'contents' => $this->status
    ];

    if ($this->agentResponses !== null) {
      $parts[] = [
        'name' => 'agent_responses',
        'contents' => json_encode($this->agentResponses),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->triggeredGuardrails !== null) {
      $parts[] = [
        'name' => 'triggered_guardrails',
        'contents' => json_encode($this->triggeredGuardrails),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    $parts[] = [
      'name' => 'test_id',
      'contents' => $this->testId
    ];

    if ($this->testName !== null) {
      $parts[] = [
        'name' => 'test_name',
        'contents' => $this->testName
      ];
    }

    if ($this->conditionResult !== null) {
      $parts[] = [
        'name' => 'condition_result',
        'contents' => json_encode($this->conditionResult),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->lastUpdatedAtUnix !== null) {
      $parts[] = [
        'name' => 'last_updated_at_unix',
        'contents' => (string) $this->lastUpdatedAtUnix
      ];
    }

    if ($this->metadata !== null) {
      $parts[] = [
        'name' => 'metadata',
        'contents' => json_encode($this->metadata),
        'headers' => ['Content-Type' => 'application/json']
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

    if ($this->environment !== null) {
      $parts[] = [
        'name' => 'environment',
        'contents' => $this->environment
      ];
    }

    if ($this->creditsUsed !== null) {
      $parts[] = [
        'name' => 'credits_used',
        'contents' => (string) $this->creditsUsed
      ];
    }

    if ($this->charging !== null) {
      $parts[] = [
        'name' => 'charging',
        'contents' => json_encode($this->charging),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->agentResponses ?? [] as $item) {
      $item->validate();
    }
    foreach ($this->triggeredGuardrails ?? [] as $item) {
      $item->validate();
    }
    $this->conditionResult?->validate();
    $this->metadata?->validate();
    $this->charging?->validate();
  }
}
