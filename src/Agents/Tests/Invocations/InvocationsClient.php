<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Tests\Invocations;

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
class InvocationsClient extends BaseService
{
  /** @var array|null Method-level configuration for list */
  protected ?array $listConfig = null;

  /** @var array|null Method-level configuration for get */
  protected ?array $getConfig = null;

  /** @var array|null Method-level configuration for update */
  protected ?array $updateConfig = null;

  /** @var array|null Method-level configuration for cancel */
  protected ?array $cancelConfig = null;

  /** @var array|null Method-level configuration for resubmit */
  protected ?array $resubmitConfig = null;

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
   * Set method-level configuration for resubmit.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setResubmitConfig(array $config): static
  {
    $this->resubmitConfig = $config;
    return $this;
  }

  /**
   * Lists all test invocations with pagination support and optional search filtering.
   *
   * @param \ElevenLabs\Agents\Tests\Invocations\Requests\ListInvocationsRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\GetTestInvocationsPageResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function list(
    \ElevenLabs\Agents\Tests\Invocations\Requests\ListInvocationsRequest $request = new \ElevenLabs\Agents\Tests\Invocations\Requests\ListInvocationsRequest(),
    ?array $options = null
  ): ?\ElevenLabs\Types\GetTestInvocationsPageResponseModel {
    $agentId = $request->agentId;
    $branchId = $request->branchId;
    $createdByUserId = $request->createdByUserId;
    $testId = $request->testId;
    $startTime = $request->startTime;
    $endTime = $request->endTime;
    $versionId = $request->versionId;
    $pageSize = $request->pageSize;
    $search = $request->search;
    $cursor = $request->cursor;

    Validator::validateNumber($pageSize, 'page_size', min: 1, max: 100);

    $resolvedConfig = $this->getResolvedConfig($this->listConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/test-invocations',
        method: HttpMethod::GET,
        query: [
          'agent_id' => $agentId,
          'branch_id' => $branchId,
          'created_by_user_id' => $createdByUserId,
          'test_id' => $testId,
          'start_time' => $startTime,
          'end_time' => $endTime,
          'version_id' => $versionId,
          'page_size' => $pageSize,
          'search' => $search,
          'cursor' => $cursor
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\GetTestInvocationsPageResponseModel::class
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
   * Gets a test invocation by ID.
   *
   * @param string $testInvocationId The id of a test invocation. This is returned when tests are run.
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\GetTestSuiteInvocationResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function get(
    string $testInvocationId,
    ?array $options = null
  ): ?\ElevenLabs\Types\GetTestSuiteInvocationResponseModel {
    $resolvedConfig = $this->getResolvedConfig($this->getConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/test-invocations/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($testInvocationId),
        method: HttpMethod::GET
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\GetTestSuiteInvocationResponseModel::class
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
   * Updates the user-provided name of a test invocation.
   *
   * @param string $testInvocationId The id of a test invocation. This is returned when tests are run.
   * @param \ElevenLabs\Agents\Tests\Invocations\Requests\UpdateTestSuiteInvocationRequestModel $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\GetTestSuiteInvocationResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function update(
    string $testInvocationId,
    \ElevenLabs\Agents\Tests\Invocations\Requests\UpdateTestSuiteInvocationRequestModel $request = new \ElevenLabs\Agents\Tests\Invocations\Requests\UpdateTestSuiteInvocationRequestModel(),
    ?array $options = null
  ): ?\ElevenLabs\Types\GetTestSuiteInvocationResponseModel {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->updateConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/test-invocations/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($testInvocationId),
        method: HttpMethod::PATCH,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\GetTestSuiteInvocationResponseModel::class
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
   * Cancels all pending runs in a test invocation.
   *
   * @param string $testInvocationId The id of a test invocation. This is returned when tests are run.
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
  public function cancel(string $testInvocationId, ?array $options = null): void
  {
    $resolvedConfig = $this->getResolvedConfig($this->cancelConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/test-invocations/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($testInvocationId) .
          '/cancel',
        method: HttpMethod::POST
      ),
      $resolvedConfig
    );
  }

  /**
   * Resubmits specific test runs from a test invocation.
   *
   * @param string $testInvocationId The id of a test invocation. This is returned when tests are run.
   * @param \ElevenLabs\Agents\Tests\Invocations\Requests\ResubmitTestsRequestModel $request Request body
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
  public function resubmit(
    string $testInvocationId,
    \ElevenLabs\Agents\Tests\Invocations\Requests\ResubmitTestsRequestModel $request,
    ?array $options = null
  ): mixed {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->resubmitConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/test-invocations/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($testInvocationId) .
          '/resubmit',
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
