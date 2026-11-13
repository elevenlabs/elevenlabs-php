<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\KnowledgeBase\Documents\Summaries;

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
class SummariesClient extends BaseService
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
   * Gets multiple knowledge base document summaries by their IDs.
   *
   * @param \ElevenLabs\Agents\KnowledgeBase\Documents\Summaries\Requests\GetSummariesRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?array<string, \ElevenLabs\Agents\KnowledgeBase\Documents\Summaries\Types\GetSummariesResponseValue>
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function get(
    \ElevenLabs\Agents\KnowledgeBase\Documents\Summaries\Requests\GetSummariesRequest $request = new \ElevenLabs\Agents\KnowledgeBase\Documents\Summaries\Requests\GetSummariesRequest(),
    ?array $options = null
  ): ?array {
    $documentIds = $request->documentIds;

    Validator::validateArray($documentIds, 'document_ids', minItems: 1, maxItems: 100);

    $resolvedConfig = $this->getResolvedConfig($this->getConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/knowledge-base/summaries',
        method: HttpMethod::GET,
        query: [
          'document_ids' => $documentIds
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
}
