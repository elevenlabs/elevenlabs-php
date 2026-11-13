<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\KnowledgeBase;

use ElevenLabs\Services\BaseService;
use ElevenLabs\Core\Json\JsonApiRequest;
use ElevenLabs\Core\Client\HttpMethod;
use ElevenLabs\Utils\Serializer;
use ElevenLabs\Utils\Validator;

use ElevenLabs\Agents\KnowledgeBase\Documents\DocumentsClient;
use ElevenLabs\Agents\KnowledgeBase\CrawlJobs\CrawlJobsClient;
use ElevenLabs\Agents\KnowledgeBase\Document\DocumentClient;

/**
 * Service class containing API endpoint methods.
 *
 * This class extends the base service to provide typed methods for specific API operations.
 * Each method corresponds to an API endpoint and handles request serialization,
 * execution, and response deserialization.
 */
class KnowledgeBaseClient extends BaseService
{
  public DocumentsClient $documents;
  public CrawlJobsClient $crawlJobs;
  public DocumentClient $document;

  public function __construct(\ElevenLabs\Core\Client\RawClient $client, ?array $options = null)
  {
    parent::__construct($client, $options);
    $this->documents = new DocumentsClient($client, $options);
    $this->crawlJobs = new CrawlJobsClient($client, $options);
    $this->document = new DocumentClient($client, $options);
  }

  /** @var array|null Method-level configuration for size */
  protected ?array $sizeConfig = null;

  /** @var array|null Method-level configuration for list */
  protected ?array $listConfig = null;

  /** @var array|null Method-level configuration for getOrCreateRagIndexes */
  protected ?array $getOrCreateRagIndexesConfig = null;

  /** @var array|null Method-level configuration for search */
  protected ?array $searchConfig = null;

  /**
   * Set method-level configuration for size.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setSizeConfig(array $config): static
  {
    $this->sizeConfig = $config;
    return $this;
  }

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
   * Set method-level configuration for getOrCreateRagIndexes.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setGetOrCreateRagIndexesConfig(array $config): static
  {
    $this->getOrCreateRagIndexesConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for search.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setSearchConfig(array $config): static
  {
    $this->searchConfig = $config;
    return $this;
  }

  /**
   * Returns the number of pages in the agent's knowledge base.
   *
   * @param string $agentId
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\GetAgentKnowledgebaseSizeResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function size(
    string $agentId,
    ?array $options = null
  ): ?\ElevenLabs\Types\GetAgentKnowledgebaseSizeResponseModel {
    $resolvedConfig = $this->getResolvedConfig($this->sizeConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/agent/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($agentId) .
          '/knowledge-base/size',
        method: HttpMethod::GET
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\GetAgentKnowledgebaseSizeResponseModel::class
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
   * Get a list of available knowledge base documents
   *
   * @param \ElevenLabs\Agents\KnowledgeBase\Requests\ListKnowledgeBaseRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\GetKnowledgeBaseListResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function list(
    \ElevenLabs\Agents\KnowledgeBase\Requests\ListKnowledgeBaseRequest $request = new \ElevenLabs\Agents\KnowledgeBase\Requests\ListKnowledgeBaseRequest(),
    ?array $options = null
  ): ?\ElevenLabs\Types\GetKnowledgeBaseListResponseModel {
    $pageSize = $request->pageSize;
    $search = $request->search;
    $showOnlyOwnedDocuments = $request->showOnlyOwnedDocuments;
    $createdByUserId = $request->createdByUserId;
    $types = $request->types;
    $parentFolderId = $request->parentFolderId;
    $ancestorFolderId = $request->ancestorFolderId;
    $foldersFirst = $request->foldersFirst;
    $sortDirection = $request->sortDirection;
    $sortBy = $request->sortBy;
    $cursor = $request->cursor;

    Validator::validateNumber($pageSize, 'page_size', min: 1, max: 100);

    $resolvedConfig = $this->getResolvedConfig($this->listConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/knowledge-base',
        method: HttpMethod::GET,
        query: [
          'page_size' => $pageSize,
          'search' => $search,
          'show_only_owned_documents' => $showOnlyOwnedDocuments,
          'created_by_user_id' => $createdByUserId,
          'types' => $types,
          'parent_folder_id' => $parentFolderId,
          'ancestor_folder_id' => $ancestorFolderId,
          'folders_first' => $foldersFirst,
          'sort_direction' => $sortDirection,
          'sort_by' => $sortBy,
          'cursor' => $cursor
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\GetKnowledgeBaseListResponseModel::class
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
   * Retrieves and/or creates RAG indexes for multiple knowledge base documents in a single request. Maximum 100 items per request.
   *
   * @param \ElevenLabs\Agents\KnowledgeBase\Requests\BodyComputeRagIndexesInBatchV1ConvaiKnowledgeBaseRagIndexPost $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?array<string, \ElevenLabs\Agents\KnowledgeBase\Types\GetOrCreateRagIndexesKnowledgeBaseResponseValue>
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function getOrCreateRagIndexes(
    \ElevenLabs\Agents\KnowledgeBase\Requests\BodyComputeRagIndexesInBatchV1ConvaiKnowledgeBaseRagIndexPost $request,
    ?array $options = null
  ): ?array {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->getOrCreateRagIndexesConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/knowledge-base/rag-index',
        method: HttpMethod::POST,
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
   * Fuzzy text search over knowledge base document content
   *
   * @param \ElevenLabs\Agents\KnowledgeBase\Requests\SearchKnowledgeBaseRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\KnowledgeBaseContentSearchResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function search(
    \ElevenLabs\Agents\KnowledgeBase\Requests\SearchKnowledgeBaseRequest $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\KnowledgeBaseContentSearchResponseModel {
    $query = $request->query;
    $pageSize = $request->pageSize;
    $types = $request->types;
    $cursor = $request->cursor;

    Validator::validateNumber($pageSize, 'page_size', min: 1, max: 100);

    $resolvedConfig = $this->getResolvedConfig($this->searchConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/knowledge-base/search',
        method: HttpMethod::GET,
        query: [
          'query' => $query,
          'page_size' => $pageSize,
          'types' => $types,
          'cursor' => $cursor
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\KnowledgeBaseContentSearchResponseModel::class
      );
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }
}
