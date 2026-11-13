<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\BatchCalls;

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
class BatchCallsClient extends BaseService
{
  /** @var array|null Method-level configuration for create */
  protected ?array $createConfig = null;

  /** @var array|null Method-level configuration for list */
  protected ?array $listConfig = null;

  /** @var array|null Method-level configuration for get */
  protected ?array $getConfig = null;

  /** @var array|null Method-level configuration for delete */
  protected ?array $deleteConfig = null;

  /** @var array|null Method-level configuration for cancel */
  protected ?array $cancelConfig = null;

  /** @var array|null Method-level configuration for retry */
  protected ?array $retryConfig = null;

  /** @var array|null Method-level configuration for export */
  protected ?array $exportConfig = null;

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
   * Set method-level configuration for cancel.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setCancelConfig(array $config): static
  {
    $this->cancelConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for retry.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setRetryConfig(array $config): static
  {
    $this->retryConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for export.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setExportConfig(array $config): static
  {
    $this->exportConfig = $config;
    return $this;
  }

  /**
   * Submit a batch call request to schedule calls for multiple recipients.
   *
   * @param \ElevenLabs\Agents\BatchCalls\Requests\BodySubmitABatchCallRequestV1ConvaiBatchCallingSubmitPost $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\BatchCallResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function create(
    \ElevenLabs\Agents\BatchCalls\Requests\BodySubmitABatchCallRequestV1ConvaiBatchCallingSubmitPost $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\BatchCallResponse {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->createConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/batch-calling/submit',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\BatchCallResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Get all batch calls for the current workspace.
   *
   * @param \ElevenLabs\Agents\BatchCalls\Requests\ListBatchCallsRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\WorkspaceBatchCallsResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function list(
    \ElevenLabs\Agents\BatchCalls\Requests\ListBatchCallsRequest $request = new \ElevenLabs\Agents\BatchCalls\Requests\ListBatchCallsRequest(),
    ?array $options = null
  ): ?\ElevenLabs\Types\WorkspaceBatchCallsResponse {
    $limit = $request->limit;
    $lastDoc = $request->lastDoc;
    $agentId = $request->agentId;

    $resolvedConfig = $this->getResolvedConfig($this->listConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/batch-calling/workspace',
        method: HttpMethod::GET,
        query: [
          'limit' => $limit,
          'last_doc' => $lastDoc,
          'agent_id' => $agentId
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\WorkspaceBatchCallsResponse::class
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
   * Get detailed information about a batch call including all recipients.
   *
   * @param string $batchId
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\BatchCallDetailedResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function get(
    string $batchId,
    ?array $options = null
  ): ?\ElevenLabs\Types\BatchCallDetailedResponse {
    $resolvedConfig = $this->getResolvedConfig($this->getConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/batch-calling/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($batchId),
        method: HttpMethod::GET
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\BatchCallDetailedResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Permanently delete a batch call and all recipient records. Conversations remain in history.
   *
   * @param string $batchId
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
  public function delete(string $batchId, ?array $options = null): void
  {
    $resolvedConfig = $this->getResolvedConfig($this->deleteConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/batch-calling/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($batchId),
        method: HttpMethod::DELETE
      ),
      $resolvedConfig
    );
  }

  /**
   * Cancel a running batch call and set all recipients to cancelled status.
   *
   * @param string $batchId
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\BatchCallResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function cancel(
    string $batchId,
    ?array $options = null
  ): ?\ElevenLabs\Types\BatchCallResponse {
    $resolvedConfig = $this->getResolvedConfig($this->cancelConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/batch-calling/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($batchId) .
          '/cancel',
        method: HttpMethod::POST
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\BatchCallResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Retry a batch call, calling failed and no-response recipients again.
   *
   * @param string $batchId
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\BatchCallResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function retry(
    string $batchId,
    ?array $options = null
  ): ?\ElevenLabs\Types\BatchCallResponse {
    $resolvedConfig = $this->getResolvedConfig($this->retryConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/batch-calling/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($batchId) .
          '/retry',
        method: HttpMethod::POST
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\BatchCallResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Download all recipients and conversation results for a batch call as CSV, including calls that are still in progress.
   *
   * @param string $batchId
   * @param \ElevenLabs\Agents\BatchCalls\Requests\ExportBatchCallsRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return \Psr\Http\Message\StreamInterface The response body, read as it arrives. getContents() or (string) returns the whole body. Call close() if you stop reading early.
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function export(
    string $batchId,
    \ElevenLabs\Agents\BatchCalls\Requests\ExportBatchCallsRequest $request = new \ElevenLabs\Agents\BatchCalls\Requests\ExportBatchCallsRequest(),
    ?array $options = null
  ): \Psr\Http\Message\StreamInterface {
    $limit = $request->limit;

    Validator::validateNumber($limit, 'limit', min: 1);

    $resolvedConfig = $this->getResolvedConfig($this->exportConfig, $options);
    $response = $this->sendBinaryStreamJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/batch-calling/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($batchId) .
          '/export',
        method: HttpMethod::GET,
        query: [
          'limit' => $limit
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody();

    return $data;
  }
}
