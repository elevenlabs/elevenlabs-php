<?php

declare(strict_types=1);

namespace ElevenLabs\SpeechEngine;

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
class SpeechEngineClient extends BaseService
{
  /** @var array|null Method-level configuration for list */
  protected ?array $listConfig = null;

  /** @var array|null Method-level configuration for create */
  protected ?array $createConfig = null;

  /** @var array|null Method-level configuration for get */
  protected ?array $getConfig = null;

  /** @var array|null Method-level configuration for update */
  protected ?array $updateConfig = null;

  /** @var array|null Method-level configuration for delete */
  protected ?array $deleteConfig = null;

  /** @var array|null Method-level configuration for duplicate */
  protected ?array $duplicateConfig = null;

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
   * Set method-level configuration for duplicate.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setDuplicateConfig(array $config): static
  {
    $this->duplicateConfig = $config;
    return $this;
  }

  /**
   * Returns a paginated list of Speech Engine resources.
   *
   * @param \ElevenLabs\SpeechEngine\Requests\ListSpeechEngineRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\ListSpeechEnginesResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function list(
    \ElevenLabs\SpeechEngine\Requests\ListSpeechEngineRequest $request = new \ElevenLabs\SpeechEngine\Requests\ListSpeechEngineRequest(),
    ?array $options = null
  ): ?\ElevenLabs\Types\ListSpeechEnginesResponse {
    $pageSize = $request->pageSize;
    $search = $request->search;
    $sortDirection = $request->sortDirection;
    $sortBy = $request->sortBy;
    $cursor = $request->cursor;

    Validator::validateNumber($pageSize, 'page_size', max: 100);

    $resolvedConfig = $this->getResolvedConfig($this->listConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/speech-engine',
        method: HttpMethod::GET,
        query: [
          'page_size' => $pageSize,
          'search' => $search,
          'sort_direction' => $sortDirection,
          'sort_by' => $sortBy,
          'cursor' => $cursor
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\ListSpeechEnginesResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Create a new Speech Engine resource
   *
   * @param \ElevenLabs\SpeechEngine\Requests\CreateSpeechEngineRequest $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\SpeechEngineResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function create(
    \ElevenLabs\SpeechEngine\Requests\CreateSpeechEngineRequest $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\SpeechEngineResponse {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->createConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/speech-engine',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\SpeechEngineResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Retrieve a Speech Engine resource
   *
   * @param string $speechEngineId The speech engine ID (accepts seng_ or agent_ prefix)
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\SpeechEngineResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function get(
    string $speechEngineId,
    ?array $options = null
  ): ?\ElevenLabs\Types\SpeechEngineResponse {
    $resolvedConfig = $this->getResolvedConfig($this->getConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/speech-engine/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($speechEngineId),
        method: HttpMethod::GET
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\SpeechEngineResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Update a Speech Engine resource (partial update)
   *
   * @param string $speechEngineId The speech engine ID (accepts seng_ or agent_ prefix)
   * @param \ElevenLabs\SpeechEngine\Requests\UpdateSpeechEngineRequest $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\SpeechEngineResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function update(
    string $speechEngineId,
    \ElevenLabs\SpeechEngine\Requests\UpdateSpeechEngineRequest $request = new \ElevenLabs\SpeechEngine\Requests\UpdateSpeechEngineRequest(),
    ?array $options = null
  ): ?\ElevenLabs\Types\SpeechEngineResponse {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->updateConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/speech-engine/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($speechEngineId),
        method: HttpMethod::PATCH,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\SpeechEngineResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Delete a Speech Engine resource
   *
   * @param string $speechEngineId The speech engine ID (accepts seng_ or agent_ prefix)
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
  public function delete(string $speechEngineId, ?array $options = null): void
  {
    $resolvedConfig = $this->getResolvedConfig($this->deleteConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/speech-engine/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($speechEngineId),
        method: HttpMethod::DELETE
      ),
      $resolvedConfig
    );
  }

  /**
   * Create a new Speech Engine resource by duplicating an existing one
   *
   * @param string $speechEngineId The speech engine ID (accepts seng_ or agent_ prefix)
   * @param ?\ElevenLabs\Types\DuplicateSpeechEngineRequest $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\SpeechEngineResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function duplicate(
    string $speechEngineId,
    ?\ElevenLabs\Types\DuplicateSpeechEngineRequest $request = null,
    ?array $options = null
  ): ?\ElevenLabs\Types\SpeechEngineResponse {
    $request?->validate();

    $resolvedConfig = $this->getResolvedConfig($this->duplicateConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/speech-engine/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($speechEngineId) .
          '/duplicate',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\SpeechEngineResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Opens a WebSocket connection to `/speech-engine/upstream`.
   *
   * Iterating the socket blocks until the server closes it, so call this from a CLI worker or
   * queue job rather than a web request.
   */
  public function upstream(
    \ElevenLabs\SpeechEngine\Requests\SpeechEngineUpstreamRequest $request,
    ?array $options = null
  ): SpeechEngineUpstreamSocket {
    $elevenLabsSpeechEngineAuthorization = $request->elevenLabsSpeechEngineAuthorization;
    $resolvedConfig = $this->getResolvedConfig(null, $options);
    return new SpeechEngineUpstreamSocket(
      \ElevenLabs\Core\WebSocket\WebSocketConnector::connect(
        $this->getBaseUrl($resolvedConfig) . '/speech-engine/upstream',
        $this->withHandshakeHeaders(
          [
            'headers' => [
              'X-ElevenLabs-Speech-Engine-Authorization' => $elevenLabsSpeechEngineAuthorization
            ]
          ],
          $resolvedConfig
        ),
        $this->options,
        $resolvedConfig
      )
    );
  }
}
