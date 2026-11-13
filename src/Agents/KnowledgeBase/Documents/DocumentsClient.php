<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\KnowledgeBase\Documents;

use ElevenLabs\Services\BaseService;
use ElevenLabs\Core\Json\JsonApiRequest;
use ElevenLabs\Core\Client\HttpMethod;
use ElevenLabs\Utils\Serializer;
use ElevenLabs\Utils\Validator;

use ElevenLabs\Agents\KnowledgeBase\Documents\Summaries\SummariesClient;
use ElevenLabs\Agents\KnowledgeBase\Documents\Chunk\ChunkClient;
use ElevenLabs\Agents\KnowledgeBase\Documents\Chunks\ChunksClient;

/**
 * Service class containing API endpoint methods.
 *
 * This class extends the base service to provide typed methods for specific API operations.
 * Each method corresponds to an API endpoint and handles request serialization,
 * execution, and response deserialization.
 */
class DocumentsClient extends BaseService
{
  public SummariesClient $summaries;
  public ChunkClient $chunk;
  public ChunksClient $chunks;

  public function __construct(\ElevenLabs\Core\Client\RawClient $client, ?array $options = null)
  {
    parent::__construct($client, $options);
    $this->summaries = new SummariesClient($client, $options);
    $this->chunk = new ChunkClient($client, $options);
    $this->chunks = new ChunksClient($client, $options);
  }

  /** @var array|null Method-level configuration for createFromUrl */
  protected ?array $createFromUrlConfig = null;

  /** @var array|null Method-level configuration for createFromFile */
  protected ?array $createFromFileConfig = null;

  /** @var array|null Method-level configuration for createFromText */
  protected ?array $createFromTextConfig = null;

  /** @var array|null Method-level configuration for createFolder */
  protected ?array $createFolderConfig = null;

  /** @var array|null Method-level configuration for get */
  protected ?array $getConfig = null;

  /** @var array|null Method-level configuration for update */
  protected ?array $updateConfig = null;

  /** @var array|null Method-level configuration for delete */
  protected ?array $deleteConfig = null;

  /** @var array|null Method-level configuration for getAgents */
  protected ?array $getAgentsConfig = null;

  /** @var array|null Method-level configuration for getBulkAgents */
  protected ?array $getBulkAgentsConfig = null;

  /** @var array|null Method-level configuration for getContent */
  protected ?array $getContentConfig = null;

  /** @var array|null Method-level configuration for getSourceFileUrl */
  protected ?array $getSourceFileUrlConfig = null;

  /** @var array|null Method-level configuration for move */
  protected ?array $moveConfig = null;

  /** @var array|null Method-level configuration for bulkMove */
  protected ?array $bulkMoveConfig = null;

  /** @var array|null Method-level configuration for bulkDelete */
  protected ?array $bulkDeleteConfig = null;

  /**
   * Set method-level configuration for createFromUrl.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setCreateFromUrlConfig(array $config): static
  {
    $this->createFromUrlConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for createFromFile.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setCreateFromFileConfig(array $config): static
  {
    $this->createFromFileConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for createFromText.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setCreateFromTextConfig(array $config): static
  {
    $this->createFromTextConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for createFolder.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setCreateFolderConfig(array $config): static
  {
    $this->createFolderConfig = $config;
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
   * Set method-level configuration for getAgents.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setGetAgentsConfig(array $config): static
  {
    $this->getAgentsConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for getBulkAgents.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setGetBulkAgentsConfig(array $config): static
  {
    $this->getBulkAgentsConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for getContent.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setGetContentConfig(array $config): static
  {
    $this->getContentConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for getSourceFileUrl.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setGetSourceFileUrlConfig(array $config): static
  {
    $this->getSourceFileUrlConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for move.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setMoveConfig(array $config): static
  {
    $this->moveConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for bulkMove.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setBulkMoveConfig(array $config): static
  {
    $this->bulkMoveConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for bulkDelete.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setBulkDeleteConfig(array $config): static
  {
    $this->bulkDeleteConfig = $config;
    return $this;
  }

  /**
   * Create a knowledge base document generated by scraping the given webpage.
   *
   * @param \ElevenLabs\Agents\KnowledgeBase\Documents\Requests\BodyCreateUrlDocumentV1ConvaiKnowledgeBaseUrlPost $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\AddKnowledgeBaseResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function createFromUrl(
    \ElevenLabs\Agents\KnowledgeBase\Documents\Requests\BodyCreateUrlDocumentV1ConvaiKnowledgeBaseUrlPost $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\AddKnowledgeBaseResponseModel {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->createFromUrlConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/knowledge-base/url',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\AddKnowledgeBaseResponseModel::class
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
   * Create a knowledge base document generated form the uploaded file.
   *
   * @param \ElevenLabs\Agents\KnowledgeBase\Documents\Requests\BodyCreateFileDocumentV1ConvaiKnowledgeBaseFilePost $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\AddKnowledgeBaseResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function createFromFile(
    \ElevenLabs\Agents\KnowledgeBase\Documents\Requests\BodyCreateFileDocumentV1ConvaiKnowledgeBaseFilePost $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\AddKnowledgeBaseResponseModel {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->createFromFileConfig, $options);
    $response = $this->sendRequest(
      'post',
      '/v1/convai/knowledge-base/file',
      ['multipart' => $request->toMultipart()],
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\AddKnowledgeBaseResponseModel::class
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
   * Create a knowledge base document containing the provided text.
   *
   * @param \ElevenLabs\Agents\KnowledgeBase\Documents\Requests\BodyCreateTextDocumentV1ConvaiKnowledgeBaseTextPost $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\AddKnowledgeBaseResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function createFromText(
    \ElevenLabs\Agents\KnowledgeBase\Documents\Requests\BodyCreateTextDocumentV1ConvaiKnowledgeBaseTextPost $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\AddKnowledgeBaseResponseModel {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->createFromTextConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/knowledge-base/text',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\AddKnowledgeBaseResponseModel::class
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
   * Create a folder used for grouping documents together.
   *
   * @param \ElevenLabs\Agents\KnowledgeBase\Documents\Requests\BodyCreateFolderV1ConvaiKnowledgeBaseFolderPost $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\AddKnowledgeBaseResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function createFolder(
    \ElevenLabs\Agents\KnowledgeBase\Documents\Requests\BodyCreateFolderV1ConvaiKnowledgeBaseFolderPost $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\AddKnowledgeBaseResponseModel {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->createFolderConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/knowledge-base/folder',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\AddKnowledgeBaseResponseModel::class
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
   * Get details about a specific documentation making up the agent's knowledge base
   *
   * @param string $documentationId The id of a document from the knowledge base. This is returned on document addition.
   * @param \ElevenLabs\Agents\KnowledgeBase\Documents\Requests\GetDocumentsRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Agents\KnowledgeBase\Documents\Types\GetDocumentsResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function get(
    string $documentationId,
    \ElevenLabs\Agents\KnowledgeBase\Documents\Requests\GetDocumentsRequest $request = new \ElevenLabs\Agents\KnowledgeBase\Documents\Requests\GetDocumentsRequest(),
    ?array $options = null
  ): ?\ElevenLabs\Agents\KnowledgeBase\Documents\Types\GetDocumentsResponse {
    $agentId = $request->agentId;

    $resolvedConfig = $this->getResolvedConfig($this->getConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/knowledge-base/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($documentationId),
        method: HttpMethod::GET,
        query: [
          'agent_id' => $agentId
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = \ElevenLabs\Agents\KnowledgeBase\Documents\Types\GetDocumentsResponse::fromArray(
        $this->decodeJson($data)
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
   * Update the name, content and/or auto-sync settings of a document.
   *
   * @param string $documentationId The id of a document from the knowledge base. This is returned on document addition.
   * @param \ElevenLabs\Agents\KnowledgeBase\Documents\Requests\BodyUpdateDocumentV1ConvaiKnowledgeBaseDocumentationIdPatch $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Agents\KnowledgeBase\Documents\Types\UpdateDocumentsResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function update(
    string $documentationId,
    \ElevenLabs\Agents\KnowledgeBase\Documents\Requests\BodyUpdateDocumentV1ConvaiKnowledgeBaseDocumentationIdPatch $request = new \ElevenLabs\Agents\KnowledgeBase\Documents\Requests\BodyUpdateDocumentV1ConvaiKnowledgeBaseDocumentationIdPatch(),
    ?array $options = null
  ): ?\ElevenLabs\Agents\KnowledgeBase\Documents\Types\UpdateDocumentsResponse {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->updateConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/knowledge-base/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($documentationId),
        method: HttpMethod::PATCH,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = \ElevenLabs\Agents\KnowledgeBase\Documents\Types\UpdateDocumentsResponse::fromArray(
        $this->decodeJson($data)
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
   * Delete a document or folder from the knowledge base.
   *
   * @param string $documentationId The id of a document from the knowledge base. This is returned on document addition.
   * @param \ElevenLabs\Agents\KnowledgeBase\Documents\Requests\DeleteDocumentsRequest $request Request parameters
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
    string $documentationId,
    \ElevenLabs\Agents\KnowledgeBase\Documents\Requests\DeleteDocumentsRequest $request = new \ElevenLabs\Agents\KnowledgeBase\Documents\Requests\DeleteDocumentsRequest(),
    ?array $options = null
  ): mixed {
    $force = $request->force;

    $resolvedConfig = $this->getResolvedConfig($this->deleteConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/knowledge-base/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($documentationId),
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
   * Get a list of agents depending on this knowledge base document
   *
   * @param string $documentationId The id of a document from the knowledge base. This is returned on document addition.
   * @param \ElevenLabs\Agents\KnowledgeBase\Documents\Requests\GetAgentsDocumentsRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\GetKnowledgeBaseDependentAgentsResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function getAgents(
    string $documentationId,
    \ElevenLabs\Agents\KnowledgeBase\Documents\Requests\GetAgentsDocumentsRequest $request = new \ElevenLabs\Agents\KnowledgeBase\Documents\Requests\GetAgentsDocumentsRequest(),
    ?array $options = null
  ): ?\ElevenLabs\Types\GetKnowledgeBaseDependentAgentsResponseModel {
    $dependentType = $request->dependentType;
    $pageSize = $request->pageSize;
    $cursor = $request->cursor;

    Validator::validateNumber($pageSize, 'page_size', min: 1, max: 100);

    $resolvedConfig = $this->getResolvedConfig($this->getAgentsConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/knowledge-base/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($documentationId) .
          '/dependent-agents',
        method: HttpMethod::GET,
        query: [
          'dependent_type' => $dependentType,
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
        \ElevenLabs\Types\GetKnowledgeBaseDependentAgentsResponseModel::class
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
   * Get a list of agents depending on any of the given knowledge base documents.
   *
   * @param \ElevenLabs\Agents\KnowledgeBase\Documents\Requests\BodyGetDependentAgentsForMultipleDocumentsV1ConvaiKnowledgeBaseDependentAgentsPost $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\GetKnowledgeBaseDependentAgentsResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function getBulkAgents(
    \ElevenLabs\Agents\KnowledgeBase\Documents\Requests\BodyGetDependentAgentsForMultipleDocumentsV1ConvaiKnowledgeBaseDependentAgentsPost $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\GetKnowledgeBaseDependentAgentsResponseModel {
    $dependentType = $request->dependentType;
    $pageSize = $request->pageSize;
    $cursor = $request->cursor;

    Validator::validateNumber($pageSize, 'page_size', min: 1, max: 100);
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->getBulkAgentsConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/knowledge-base/dependent-agents',
        method: HttpMethod::POST,
        query: [
          'dependent_type' => $dependentType,
          'page_size' => $pageSize,
          'cursor' => $cursor
        ],
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\GetKnowledgeBaseDependentAgentsResponseModel::class
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
   * Get the entire content of a document from the knowledge base
   *
   * @param string $documentationId The id of a document from the knowledge base. This is returned on document addition.
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return string
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function getContent(string $documentationId, ?array $options = null): string
  {
    $resolvedConfig = $this->getResolvedConfig($this->getContentConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/knowledge-base/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($documentationId) .
          '/content',
        method: HttpMethod::GET
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    return $data;
  }

  /**
   * Get a signed URL to download the original source file of a file-type document from the knowledge base
   *
   * @param string $documentationId The id of a document from the knowledge base. This is returned on document addition.
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\KnowledgeBaseSourceFileUrlResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function getSourceFileUrl(
    string $documentationId,
    ?array $options = null
  ): ?\ElevenLabs\Types\KnowledgeBaseSourceFileUrlResponseModel {
    $resolvedConfig = $this->getResolvedConfig($this->getSourceFileUrlConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/knowledge-base/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($documentationId) .
          '/source-file-url',
        method: HttpMethod::GET
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\KnowledgeBaseSourceFileUrlResponseModel::class
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
   * Moves the entity from one folder to another.
   *
   * @param string $documentId The id of a document from the knowledge base. This is returned on document addition.
   * @param \ElevenLabs\Agents\KnowledgeBase\Documents\Requests\BodyMoveEntityToFolderV1ConvaiKnowledgeBaseDocumentIdMovePost $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return void
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function move(
    string $documentId,
    \ElevenLabs\Agents\KnowledgeBase\Documents\Requests\BodyMoveEntityToFolderV1ConvaiKnowledgeBaseDocumentIdMovePost $request = new \ElevenLabs\Agents\KnowledgeBase\Documents\Requests\BodyMoveEntityToFolderV1ConvaiKnowledgeBaseDocumentIdMovePost(),
    ?array $options = null
  ): void {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->moveConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/knowledge-base/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($documentId) .
          '/move',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
  }

  /**
   * Moves multiple entities from one folder to another.
   *
   * @param \ElevenLabs\Agents\KnowledgeBase\Documents\Requests\BodyBulkMoveEntitiesToFolderV1ConvaiKnowledgeBaseBulkMovePost $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return void
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function bulkMove(
    \ElevenLabs\Agents\KnowledgeBase\Documents\Requests\BodyBulkMoveEntitiesToFolderV1ConvaiKnowledgeBaseBulkMovePost $request,
    ?array $options = null
  ): void {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->bulkMoveConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/knowledge-base/bulk-move',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
  }

  /**
   * Delete multiple documents or folders from the knowledge base. Each id succeeds or fails independently.
   *
   * @param \ElevenLabs\Agents\KnowledgeBase\Documents\Requests\BodyBulkDeleteKnowledgeBaseDocumentsV1ConvaiKnowledgeBaseBulkDeletePost $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?array<string, \ElevenLabs\Agents\KnowledgeBase\Documents\Types\BulkDeleteDocumentsResponseValue>
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function bulkDelete(
    \ElevenLabs\Agents\KnowledgeBase\Documents\Requests\BodyBulkDeleteKnowledgeBaseDocumentsV1ConvaiKnowledgeBaseBulkDeletePost $request,
    ?array $options = null
  ): ?array {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->bulkDeleteConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/knowledge-base/bulk-delete',
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
}
