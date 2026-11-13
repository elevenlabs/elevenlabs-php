<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Branches;

use ElevenLabs\Services\BaseService;
use ElevenLabs\Core\Json\JsonApiRequest;
use ElevenLabs\Core\Client\HttpMethod;
use ElevenLabs\Utils\Serializer;
use ElevenLabs\Utils\Validator;

/**
 * Service class containing API endpoint methods.
 *
 * This class extends the base service to provide typed methods for specific API operations.
 * Each method corresponds to an API endpoint and handles request serialization,
 * execution, and response deserialization.
 */
class BranchesClient extends BaseService
{
  /** @var array|null Method-level configuration for list */
  protected ?array $listConfig = null;

  /** @var array|null Method-level configuration for create */
  protected ?array $createConfig = null;

  /** @var array|null Method-level configuration for get */
  protected ?array $getConfig = null;

  /** @var array|null Method-level configuration for update */
  protected ?array $updateConfig = null;

  /** @var array|null Method-level configuration for previewMerge */
  protected ?array $previewMergeConfig = null;

  /** @var array|null Method-level configuration for merge */
  protected ?array $mergeConfig = null;

  /** @var array|null Method-level configuration for previewRebase */
  protected ?array $previewRebaseConfig = null;

  /** @var array|null Method-level configuration for rebase */
  protected ?array $rebaseConfig = null;

  /**
   * Set method-level configuration for list.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setListConfig(array $config): static
  {
    $this->listConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for create.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setCreateConfig(array $config): static
  {
    $this->createConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for get.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setGetConfig(array $config): static
  {
    $this->getConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for update.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setUpdateConfig(array $config): static
  {
    $this->updateConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for previewMerge.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setPreviewMergeConfig(array $config): static
  {
    $this->previewMergeConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for merge.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setMergeConfig(array $config): static
  {
    $this->mergeConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for previewRebase.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setPreviewRebaseConfig(array $config): static
  {
    $this->previewRebaseConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for rebase.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setRebaseConfig(array $config): static
  {
    $this->rebaseConfig = $config;
    return $this;
  }

  /**
   * Returns a list of branches an agent has
   *
   * @param string $agentId The id of an agent. This is returned on agent creation.
   * @param \ElevenLabs\Agents\Branches\Requests\ListBranchesRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\ListResponseAgentBranchSummary
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function list(
    string $agentId,
    \ElevenLabs\Agents\Branches\Requests\ListBranchesRequest $request = new \ElevenLabs\Agents\Branches\Requests\ListBranchesRequest(),
    ?array $options = null
  ): ?\ElevenLabs\Types\ListResponseAgentBranchSummary {
    $includeArchived = $request->includeArchived;
    $limit = $request->limit;
    $includeCommitStatus = $request->includeCommitStatus;

    Validator::validateNumber($limit, 'limit', max: 100);

    $resolvedConfig = $this->getResolvedConfig($this->listConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/agents/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($agentId) .
          '/branches',
        method: HttpMethod::GET,
        query: [
          'include_archived' => $includeArchived,
          'limit' => $limit,
          'include_commit_status' => $includeCommitStatus
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\ListResponseAgentBranchSummary::class
      );
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Create a new branch from a given version of any branch
   *
   * @param string $agentId The id of an agent. This is returned on agent creation.
   * @param \ElevenLabs\Agents\Branches\Requests\BodyCreateANewBranchV1ConvaiAgentsAgentIdBranchesPost $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\CreateAgentBranchResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function create(
    string $agentId,
    \ElevenLabs\Agents\Branches\Requests\BodyCreateANewBranchV1ConvaiAgentsAgentIdBranchesPost $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\CreateAgentBranchResponseModel {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->createConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/agents/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($agentId) .
          '/branches',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\CreateAgentBranchResponseModel::class
      );
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Get information about a single agent branch
   *
   * @param string $agentId The id of an agent. This is returned on agent creation.
   * @param string $branchId Unique identifier for the branch.
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\AgentBranchResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function get(
    string $agentId,
    string $branchId,
    ?array $options = null
  ): ?\ElevenLabs\Types\AgentBranchResponse {
    $resolvedConfig = $this->getResolvedConfig($this->getConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/agents/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($agentId) .
          '/branches/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($branchId),
        method: HttpMethod::GET
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\AgentBranchResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Update agent branch properties such as name, description, archiving status, protection level, and auto-rebase onto main
   *
   * @param string $agentId The id of an agent. This is returned on agent creation.
   * @param string $branchId Unique identifier for the branch.
   * @param \ElevenLabs\Agents\Branches\Requests\BodyUpdateAgentBranchV1ConvaiAgentsAgentIdBranchesBranchIdPatch $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\AgentBranchResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function update(
    string $agentId,
    string $branchId,
    \ElevenLabs\Agents\Branches\Requests\BodyUpdateAgentBranchV1ConvaiAgentsAgentIdBranchesBranchIdPatch $request = new \ElevenLabs\Agents\Branches\Requests\BodyUpdateAgentBranchV1ConvaiAgentsAgentIdBranchesBranchIdPatch(),
    ?array $options = null
  ): ?\ElevenLabs\Types\AgentBranchResponse {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->updateConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/agents/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($agentId) .
          '/branches/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($branchId),
        method: HttpMethod::PATCH,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\AgentBranchResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Returns the result of merging the source branch into the target branch without performing the merge. Useful for showing an accurate diff before confirming.
   *
   * @param string $agentId The id of an agent. This is returned on agent creation.
   * @param string $sourceBranchId Unique identifier for the source branch to merge from.
   * @param \ElevenLabs\Agents\Branches\Requests\PreviewMergeBranchesRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\MergePreviewResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function previewMerge(
    string $agentId,
    string $sourceBranchId,
    \ElevenLabs\Agents\Branches\Requests\PreviewMergeBranchesRequest $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\MergePreviewResponseModel {
    $targetBranchId = $request->targetBranchId;
    $force = $request->force;
    $includeProcedureGeneratedWorkflowElements =
      $request->includeProcedureGeneratedWorkflowElements;

    $resolvedConfig = $this->getResolvedConfig($this->previewMergeConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/agents/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($agentId) .
          '/branches/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($sourceBranchId) .
          '/merge-preview',
        method: HttpMethod::GET,
        query: [
          'target_branch_id' => $targetBranchId,
          'force' => $force,
          'include_procedure_generated_workflow_elements' => $includeProcedureGeneratedWorkflowElements
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\MergePreviewResponseModel::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Merge a branch into a target branch
   *
   * @param string $agentId The id of an agent. This is returned on agent creation.
   * @param string $sourceBranchId Unique identifier for the source branch to merge from.
   * @param \ElevenLabs\Agents\Branches\Requests\BodyMergeABranchIntoATargetBranchV1ConvaiAgentsAgentIdBranchesSourceBranchIdMergePost $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return mixed
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function merge(
    string $agentId,
    string $sourceBranchId,
    \ElevenLabs\Agents\Branches\Requests\BodyMergeABranchIntoATargetBranchV1ConvaiAgentsAgentIdBranchesSourceBranchIdMergePost $request,
    ?array $options = null
  ): mixed {
    $targetBranchId = $request->targetBranchId;

    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->mergeConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/agents/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($agentId) .
          '/branches/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($sourceBranchId) .
          '/merge',
        method: HttpMethod::POST,
        query: [
          'target_branch_id' => $targetBranchId
        ],
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = $this->decodeJson($data);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Returns the result of pulling changes from a source branch (defaults to main) into the given branch without performing it, preserving the given branch's own changes. Useful for showing an accurate diff before confirming.
   *
   * @param string $agentId The id of an agent. This is returned on agent creation.
   * @param string $branchId Unique identifier for the source branch to merge from.
   * @param \ElevenLabs\Agents\Branches\Requests\PreviewRebaseBranchesRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\MergePreviewResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function previewRebase(
    string $agentId,
    string $branchId,
    \ElevenLabs\Agents\Branches\Requests\PreviewRebaseBranchesRequest $request = new \ElevenLabs\Agents\Branches\Requests\PreviewRebaseBranchesRequest(),
    ?array $options = null
  ): ?\ElevenLabs\Types\MergePreviewResponseModel {
    $sourceBranchId = $request->sourceBranchId;
    $includeProcedureGeneratedWorkflowElements =
      $request->includeProcedureGeneratedWorkflowElements;

    $resolvedConfig = $this->getResolvedConfig($this->previewRebaseConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/agents/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($agentId) .
          '/branches/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($branchId) .
          '/rebase-preview',
        method: HttpMethod::GET,
        query: [
          'source_branch_id' => $sourceBranchId,
          'include_procedure_generated_workflow_elements' => $includeProcedureGeneratedWorkflowElements
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\MergePreviewResponseModel::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Pull changes from a source branch (defaults to main) into this branch as a new version, preserving this branch's own changes on conflicts.
   *
   * @param string $agentId The id of an agent. This is returned on agent creation.
   * @param string $branchId Unique identifier for the source branch to merge from.
   * @param \ElevenLabs\Agents\Branches\Requests\BodyRebaseABranchOntoMainV1ConvaiAgentsAgentIdBranchesBranchIdRebasePost $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return mixed
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function rebase(
    string $agentId,
    string $branchId,
    \ElevenLabs\Agents\Branches\Requests\BodyRebaseABranchOntoMainV1ConvaiAgentsAgentIdBranchesBranchIdRebasePost $request = new \ElevenLabs\Agents\Branches\Requests\BodyRebaseABranchOntoMainV1ConvaiAgentsAgentIdBranchesBranchIdRebasePost(),
    ?array $options = null
  ): mixed {
    $sourceBranchId = $request->sourceBranchId;

    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->rebaseConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/agents/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($agentId) .
          '/branches/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($branchId) .
          '/rebase',
        method: HttpMethod::POST,
        query: [
          'source_branch_id' => $sourceBranchId
        ],
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = $this->decodeJson($data);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }
}
