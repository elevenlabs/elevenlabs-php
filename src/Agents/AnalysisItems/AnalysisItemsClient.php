<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\AnalysisItems;

use ElevenLabs\Services\BaseService;
use ElevenLabs\Core\Json\JsonApiRequest;
use ElevenLabs\Core\Client\HttpMethod;
use ElevenLabs\Utils\Serializer;
use ElevenLabs\Utils\Validator;

use ElevenLabs\Agents\AnalysisItems\DependentAgents\DependentAgentsClient;

/**
 * Service class containing API endpoint methods.
 *
 * This class extends the base service to provide typed methods for specific API operations.
 * Each method corresponds to an API endpoint and handles request serialization,
 * execution, and response deserialization.
 */
class AnalysisItemsClient extends BaseService
{
  public DependentAgentsClient $dependentAgents;

  public function __construct(\ElevenLabs\Core\Client\RawClient $client, ?array $options = null)
  {
    parent::__construct($client, $options);
    $this->dependentAgents = new DependentAgentsClient($client, $options);
  }

  /** @var array|null Method-level configuration for list */
  protected ?array $listConfig = null;

  /** @var array|null Method-level configuration for create */
  protected ?array $createConfig = null;

  /** @var array|null Method-level configuration for updateAttachments */
  protected ?array $updateAttachmentsConfig = null;

  /** @var array|null Method-level configuration for get */
  protected ?array $getConfig = null;

  /** @var array|null Method-level configuration for update */
  protected ?array $updateConfig = null;

  /** @var array|null Method-level configuration for delete */
  protected ?array $deleteConfig = null;

  /** @var array|null Method-level configuration for listVersions */
  protected ?array $listVersionsConfig = null;

  /** @var array|null Method-level configuration for copy */
  protected ?array $copyConfig = null;

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
   * Set method-level configuration for updateAttachments.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setUpdateAttachmentsConfig(array $config): static
  {
    $this->updateAttachmentsConfig = $config;
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
   * Set method-level configuration for delete.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setDeleteConfig(array $config): static
  {
    $this->deleteConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for listVersions.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setListVersionsConfig(array $config): static
  {
    $this->listVersionsConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for copy.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setCopyConfig(array $config): static
  {
    $this->copyConfig = $config;
    return $this;
  }

  /**
   * List analysis items available in the workspace.
   *
   * @param \ElevenLabs\Agents\AnalysisItems\Requests\ListAnalysisItemsRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\AnalysisItemsResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function list(
    \ElevenLabs\Agents\AnalysisItems\Requests\ListAnalysisItemsRequest $request = new \ElevenLabs\Agents\AnalysisItems\Requests\ListAnalysisItemsRequest(),
    ?array $options = null
  ): ?\ElevenLabs\Types\AnalysisItemsResponseModel {
    $search = $request->search;
    $pageSize = $request->pageSize;
    $kind = $request->kind;
    $analysisItemIds = $request->analysisItemIds;
    $createdByUserId = $request->createdByUserId;
    $sortDirection = $request->sortDirection;
    $cursor = $request->cursor;

    Validator::validateString($search, 'search', maxLength: 100);
    Validator::validateNumber($pageSize, 'page_size', min: 1, max: 100);
    Validator::validateArray($analysisItemIds, 'analysis_item_ids', minItems: 1, maxItems: 100);

    $resolvedConfig = $this->getResolvedConfig($this->listConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/analysis-items',
        method: HttpMethod::GET,
        query: [
          'search' => $search,
          'page_size' => $pageSize,
          'kind' => $kind,
          'analysis_item_ids' => $analysisItemIds,
          'created_by_user_id' => $createdByUserId,
          'sort_direction' => $sortDirection,
          'cursor' => $cursor
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\AnalysisItemsResponseModel::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Create a new analysis item (evaluation criterion or data collection) in the workspace.
   *
   * @param \ElevenLabs\Types\UserEvaluationAnalysisItem|\ElevenLabs\Types\UserDataCollectionAnalysisItemInput $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\AnalysisItemResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function create(
    \ElevenLabs\Types\UserEvaluationAnalysisItem|\ElevenLabs\Types\UserDataCollectionAnalysisItemInput $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\AnalysisItemResponseModel {
    $resolvedConfig = $this->getResolvedConfig($this->createConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/analysis-items',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\AnalysisItemResponseModel::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Attach or detach one analysis item on multiple agent branches.
   *
   * @param string $analysisItemId ID of the requested analysis item.
   * @param \ElevenLabs\Agents\AnalysisItems\Requests\UpdateAnalysisItemAttachmentsRequestModel $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\UpdateAnalysisItemAttachmentsResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function updateAttachments(
    string $analysisItemId,
    \ElevenLabs\Agents\AnalysisItems\Requests\UpdateAnalysisItemAttachmentsRequestModel $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\UpdateAnalysisItemAttachmentsResponseModel {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->updateAttachmentsConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/analysis-items/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($analysisItemId) .
          '/attachments',
        method: HttpMethod::PATCH,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\UpdateAnalysisItemAttachmentsResponseModel::class
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
   * Get an analysis item available in the workspace.
   *
   * @param string $analysisItemId ID of the requested analysis item.
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\AnalysisItemResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function get(
    string $analysisItemId,
    ?array $options = null
  ): ?\ElevenLabs\Types\AnalysisItemResponseModel {
    $resolvedConfig = $this->getResolvedConfig($this->getConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/analysis-items/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($analysisItemId),
        method: HttpMethod::GET
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\AnalysisItemResponseModel::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Update an analysis item. Publishes a new version when the content changes.
   *
   * @param string $analysisItemId ID of the requested analysis item.
   * @param \ElevenLabs\Types\UserEvaluationAnalysisItem|\ElevenLabs\Types\UserDataCollectionAnalysisItemInput $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\AnalysisItemResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function update(
    string $analysisItemId,
    \ElevenLabs\Types\UserEvaluationAnalysisItem|\ElevenLabs\Types\UserDataCollectionAnalysisItemInput $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\AnalysisItemResponseModel {
    $resolvedConfig = $this->getResolvedConfig($this->updateConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/analysis-items/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($analysisItemId),
        method: HttpMethod::PATCH,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\AnalysisItemResponseModel::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Delete an analysis item and all of its versions from the workspace.
   *
   * @param string $analysisItemId ID of the requested analysis item.
   * @param \ElevenLabs\Agents\AnalysisItems\Requests\DeleteAnalysisItemsRequest $request Request parameters
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
  public function delete(
    string $analysisItemId,
    \ElevenLabs\Agents\AnalysisItems\Requests\DeleteAnalysisItemsRequest $request = new \ElevenLabs\Agents\AnalysisItems\Requests\DeleteAnalysisItemsRequest(),
    ?array $options = null
  ): mixed {
    $force = $request->force;

    $resolvedConfig = $this->getResolvedConfig($this->deleteConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/analysis-items/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($analysisItemId),
        method: HttpMethod::DELETE,
        query: [
          'force' => $force
        ]
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
   * List the published versions of an analysis item, newest first.
   *
   * @param string $analysisItemId ID of the requested analysis item.
   * @param \ElevenLabs\Agents\AnalysisItems\Requests\ListVersionsAnalysisItemsRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\AnalysisItemVersionsResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function listVersions(
    string $analysisItemId,
    \ElevenLabs\Agents\AnalysisItems\Requests\ListVersionsAnalysisItemsRequest $request = new \ElevenLabs\Agents\AnalysisItems\Requests\ListVersionsAnalysisItemsRequest(),
    ?array $options = null
  ): ?\ElevenLabs\Types\AnalysisItemVersionsResponseModel {
    $pageSize = $request->pageSize;
    $cursor = $request->cursor;

    Validator::validateNumber($pageSize, 'page_size', min: 1, max: 100);

    $resolvedConfig = $this->getResolvedConfig($this->listVersionsConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/analysis-items/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($analysisItemId) .
          '/versions',
        method: HttpMethod::GET,
        query: [
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
        \ElevenLabs\Types\AnalysisItemVersionsResponseModel::class
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
   * Create a new analysis item from this item's current definition.
   *
   * @param string $analysisItemId ID of the requested analysis item.
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\AnalysisItemResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function copy(
    string $analysisItemId,
    ?array $options = null
  ): ?\ElevenLabs\Types\AnalysisItemResponseModel {
    $resolvedConfig = $this->getResolvedConfig($this->copyConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/analysis-items/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($analysisItemId) .
          '/copy',
        method: HttpMethod::POST
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\AnalysisItemResponseModel::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }
}
