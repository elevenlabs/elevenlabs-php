<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\KnowledgeBase\Documents\Chunk;

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
class ChunkClient extends BaseService
{
  /** @var array|null Method-level configuration for get */
  protected ?array $getConfig = null;

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
   * Get details about a specific documentation part used by RAG.
   *
   * @param string $documentationId The id of a document from the knowledge base. This is returned on document addition.
   * @param string $chunkId The id of a document RAG chunk from the knowledge base.
   * @param \ElevenLabs\Agents\KnowledgeBase\Documents\Chunk\Requests\GetChunkRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\KnowledgeBaseDocumentChunkResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function get(
    string $documentationId,
    string $chunkId,
    \ElevenLabs\Agents\KnowledgeBase\Documents\Chunk\Requests\GetChunkRequest $request = new \ElevenLabs\Agents\KnowledgeBase\Documents\Chunk\Requests\GetChunkRequest(),
    ?array $options = null
  ): ?\ElevenLabs\Types\KnowledgeBaseDocumentChunkResponseModel {
    $embeddingModel = $request->embeddingModel;

    $resolvedConfig = $this->getResolvedConfig($this->getConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/knowledge-base/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($documentationId) .
          '/chunk/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($chunkId),
        method: HttpMethod::GET,
        query: [
          'embedding_model' => $embeddingModel
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\KnowledgeBaseDocumentChunkResponseModel::class
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
