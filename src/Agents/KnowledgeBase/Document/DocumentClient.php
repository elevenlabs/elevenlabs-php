<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\KnowledgeBase\Document;

use ElevenLabs\Services\BaseService;
use ElevenLabs\Core\Json\JsonApiRequest;
use ElevenLabs\Core\Client\HttpMethod;
use ElevenLabs\Utils\Serializer;

/**
 * Service class containing API endpoint methods.
 *
 * This class extends the base service to provide typed methods for specific API operations.
 * Each method corresponds to an API endpoint and handles request serialization,
 * execution, and response deserialization.
 */
class DocumentClient extends BaseService
{
  /** @var array|null Method-level configuration for updateFile */
  protected ?array $updateFileConfig = null;

  /** @var array|null Method-level configuration for refresh */
  protected ?array $refreshConfig = null;

  /** @var array|null Method-level configuration for computeRagIndex */
  protected ?array $computeRagIndexConfig = null;

  /**
   * Set method-level configuration for updateFile.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setUpdateFileConfig(array $config): static
  {
    $this->updateFileConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for refresh.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setRefreshConfig(array $config): static
  {
    $this->refreshConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for computeRagIndex.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setComputeRagIndexConfig(array $config): static
  {
    $this->computeRagIndexConfig = $config;
    return $this;
  }

  /**
   * Update the source file of a file document. The document name, content, and metadata are updated to reflect the new file. Any manual content edits will be overwritten.
   *
   * @param string $documentationId The id of a document from the knowledge base. This is returned on document addition.
   * @param \ElevenLabs\Agents\KnowledgeBase\Document\Requests\BodyUpdateFileDocumentV1ConvaiKnowledgeBaseDocumentationIdUpdateFilePatch $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Agents\KnowledgeBase\Document\Types\UpdateFileDocumentResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function updateFile(
    string $documentationId,
    \ElevenLabs\Agents\KnowledgeBase\Document\Requests\BodyUpdateFileDocumentV1ConvaiKnowledgeBaseDocumentationIdUpdateFilePatch $request,
    ?array $options = null
  ): ?\ElevenLabs\Agents\KnowledgeBase\Document\Types\UpdateFileDocumentResponse {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->updateFileConfig, $options);
    $response = $this->sendRequest(
      'patch',
      '/v1/convai/knowledge-base/' .
        \ElevenLabs\Core\Client\RawClient::encodePathParam($documentationId) .
        '/update-file',
      ['multipart' => $request->toMultipart()],
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = \ElevenLabs\Agents\KnowledgeBase\Document\Types\UpdateFileDocumentResponse::fromArray(
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
   * Manually refresh a URL document by re-fetching its content from the source URL.
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
   * @return ?\ElevenLabs\Agents\KnowledgeBase\Document\Types\RefreshDocumentResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function refresh(
    string $documentationId,
    ?array $options = null
  ): ?\ElevenLabs\Agents\KnowledgeBase\Document\Types\RefreshDocumentResponse {
    $resolvedConfig = $this->getResolvedConfig($this->refreshConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/knowledge-base/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($documentationId) .
          '/refresh',
        method: HttpMethod::POST
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = \ElevenLabs\Agents\KnowledgeBase\Document\Types\RefreshDocumentResponse::fromArray(
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
   * In case the document is not RAG indexed, it triggers rag indexing task, otherwise it just returns the current status.
   *
   * @param string $documentationId The id of a document from the knowledge base. This is returned on document addition.
   * @param \ElevenLabs\Agents\KnowledgeBase\Document\Requests\RagIndexRequestModel $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\RagDocumentIndexResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function computeRagIndex(
    string $documentationId,
    \ElevenLabs\Agents\KnowledgeBase\Document\Requests\RagIndexRequestModel $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\RagDocumentIndexResponseModel {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->computeRagIndexConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/knowledge-base/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($documentationId) .
          '/rag-index',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\RagDocumentIndexResponseModel::class
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
