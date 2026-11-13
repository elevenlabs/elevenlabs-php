<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\MergeProposals;

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
class MergeProposalsClient extends BaseService
{
  /** @var array|null Method-level configuration for list */
  protected ?array $listConfig = null;

  /** @var array|null Method-level configuration for create */
  protected ?array $createConfig = null;

  /** @var array|null Method-level configuration for get */
  protected ?array $getConfig = null;

  /** @var array|null Method-level configuration for update */
  protected ?array $updateConfig = null;

  /** @var array|null Method-level configuration for submitReview */
  protected ?array $submitReviewConfig = null;

  /** @var array|null Method-level configuration for addComment */
  protected ?array $addCommentConfig = null;

  /** @var array|null Method-level configuration for merge */
  protected ?array $mergeConfig = null;

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
   * Set method-level configuration for submitReview.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setSubmitReviewConfig(array $config): static
  {
    $this->submitReviewConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for addComment.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setAddCommentConfig(array $config): static
  {
    $this->addCommentConfig = $config;
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
   * List the proposals for an agent, newest first.
   *
   * @param string $agentId The id of an agent. This is returned on agent creation.
   * @param \ElevenLabs\Agents\MergeProposals\Requests\ListMergeProposalsRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\PaginatedResultAgentMergeProposalResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function list(
    string $agentId,
    \ElevenLabs\Agents\MergeProposals\Requests\ListMergeProposalsRequest $request = new \ElevenLabs\Agents\MergeProposals\Requests\ListMergeProposalsRequest(),
    ?array $options = null
  ): ?\ElevenLabs\Types\PaginatedResultAgentMergeProposalResponse {
    $status = $request->status;
    $sourceBranchId = $request->sourceBranchId;
    $targetBranchId = $request->targetBranchId;
    $search = $request->search;
    $pageSize = $request->pageSize;
    $cursor = $request->cursor;

    Validator::validateString($search, 'search', maxLength: 140);
    Validator::validateNumber($pageSize, 'page_size', min: 1, max: 100);

    $resolvedConfig = $this->getResolvedConfig($this->listConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/agents/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($agentId) .
          '/merge-proposals',
        method: HttpMethod::GET,
        query: [
          'status' => $status,
          'source_branch_id' => $sourceBranchId,
          'target_branch_id' => $targetBranchId,
          'search' => $search,
          'page_size' => $pageSize,
          'cursor' => $cursor
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\PaginatedResultAgentMergeProposalResponse::class
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
   * Record a request to merge a source branch into a target branch. Anyone with edit access can open one; merging it later is gated on write access to the target branch, so this is how a change reaches a protected branch the author cannot merge into themselves.
   *
   * @param string $agentId The id of an agent. This is returned on agent creation.
   * @param \ElevenLabs\Agents\MergeProposals\Requests\BodyCreateAMergeProposalV1ConvaiAgentsAgentIdMergeProposalsPost $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\CreateAgentMergeProposalResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function create(
    string $agentId,
    \ElevenLabs\Agents\MergeProposals\Requests\BodyCreateAMergeProposalV1ConvaiAgentsAgentIdMergeProposalsPost $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\CreateAgentMergeProposalResponseModel {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->createConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/agents/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($agentId) .
          '/merge-proposals',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\CreateAgentMergeProposalResponseModel::class
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
   * Get a single merge_proposal.
   *
   * @param string $agentId The id of an agent. This is returned on agent creation.
   * @param string $mergeProposalId Unique identifier for the merge_proposal.
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\AgentMergeProposalResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function get(
    string $agentId,
    string $mergeProposalId,
    ?array $options = null
  ): ?\ElevenLabs\Types\AgentMergeProposalResponse {
    $resolvedConfig = $this->getResolvedConfig($this->getConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/agents/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($agentId) .
          '/merge-proposals/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($mergeProposalId),
        method: HttpMethod::GET
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\AgentMergeProposalResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Edit an open merge_proposal's title or description, or close it. The author closing it is recorded as withdrawn; anyone else as rejected.
   *
   * @param string $agentId The id of an agent. This is returned on agent creation.
   * @param string $mergeProposalId Unique identifier for the merge_proposal.
   * @param \ElevenLabs\Agents\MergeProposals\Requests\BodyUpdateAMergeProposalV1ConvaiAgentsAgentIdMergeProposalsMergeProposalIdPatch $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\AgentMergeProposalResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function update(
    string $agentId,
    string $mergeProposalId,
    \ElevenLabs\Agents\MergeProposals\Requests\BodyUpdateAMergeProposalV1ConvaiAgentsAgentIdMergeProposalsMergeProposalIdPatch $request = new \ElevenLabs\Agents\MergeProposals\Requests\BodyUpdateAMergeProposalV1ConvaiAgentsAgentIdMergeProposalsMergeProposalIdPatch(),
    ?array $options = null
  ): ?\ElevenLabs\Types\AgentMergeProposalResponse {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->updateConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/agents/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($agentId) .
          '/merge-proposals/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($mergeProposalId),
        method: HttpMethod::PATCH,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\AgentMergeProposalResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Approve a merge_proposal or request changes on it. A user's latest review replaces their previous one. Non-admins need an approval from another user before the merge is allowed.
   *
   * @param string $agentId The id of an agent. This is returned on agent creation.
   * @param string $mergeProposalId Unique identifier for the merge_proposal.
   * @param \ElevenLabs\Agents\MergeProposals\Requests\BodyReviewAMergeProposalV1ConvaiAgentsAgentIdMergeProposalsMergeProposalIdReviewsPost $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\AgentMergeProposalResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function submitReview(
    string $agentId,
    string $mergeProposalId,
    \ElevenLabs\Agents\MergeProposals\Requests\BodyReviewAMergeProposalV1ConvaiAgentsAgentIdMergeProposalsMergeProposalIdReviewsPost $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\AgentMergeProposalResponse {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->submitReviewConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/agents/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($agentId) .
          '/merge-proposals/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($mergeProposalId) .
          '/reviews',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\AgentMergeProposalResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Leave a comment on a merge_proposal without recording a review verdict. Unlike reviews, comments accumulate and can still be added once the merge_proposal is merged or closed.
   *
   * @param string $agentId The id of an agent. This is returned on agent creation.
   * @param string $mergeProposalId Unique identifier for the merge_proposal.
   * @param \ElevenLabs\Agents\MergeProposals\Requests\BodyCommentOnAMergeProposalV1ConvaiAgentsAgentIdMergeProposalsMergeProposalIdCommentsPost $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\AgentMergeProposalResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function addComment(
    string $agentId,
    string $mergeProposalId,
    \ElevenLabs\Agents\MergeProposals\Requests\BodyCommentOnAMergeProposalV1ConvaiAgentsAgentIdMergeProposalsMergeProposalIdCommentsPost $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\AgentMergeProposalResponse {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->addCommentConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/agents/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($agentId) .
          '/merge-proposals/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($mergeProposalId) .
          '/comments',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\AgentMergeProposalResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Execute the merge. The caller must have write access to the target branch (admins only, for a protected branch), so this is where a reviewer approves and merges a request opened by someone who could not.
   *
   * @param string $agentId The id of an agent. This is returned on agent creation.
   * @param string $mergeProposalId Unique identifier for the merge_proposal.
   * @param \ElevenLabs\Agents\MergeProposals\Requests\BodyMergeAMergeProposalV1ConvaiAgentsAgentIdMergeProposalsMergeProposalIdMergePost $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\AgentMergeProposalResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function merge(
    string $agentId,
    string $mergeProposalId,
    \ElevenLabs\Agents\MergeProposals\Requests\BodyMergeAMergeProposalV1ConvaiAgentsAgentIdMergeProposalsMergeProposalIdMergePost $request = new \ElevenLabs\Agents\MergeProposals\Requests\BodyMergeAMergeProposalV1ConvaiAgentsAgentIdMergeProposalsMergeProposalIdMergePost(),
    ?array $options = null
  ): ?\ElevenLabs\Types\AgentMergeProposalResponse {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->mergeConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/agents/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($agentId) .
          '/merge-proposals/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($mergeProposalId) .
          '/merge',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\AgentMergeProposalResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }
}
