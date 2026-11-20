<?php

declare(strict_types=1);

namespace ElevenLabs\Webhooks;

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
class WebhooksClient extends BaseService
{
  /** @var array|null Method-level configuration for list */
  protected ?array $listConfig = null;

  /** @var array|null Method-level configuration for create */
  protected ?array $createConfig = null;

  /** @var array|null Method-level configuration for update */
  protected ?array $updateConfig = null;

  /** @var array|null Method-level configuration for delete */
  protected ?array $deleteConfig = null;

  /** @var array|null Method-level configuration for test */
  protected ?array $testConfig = null;

  /** @var array|null Method-level configuration for redeliver */
  protected ?array $redeliverConfig = null;

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
   * Set method-level configuration for test.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setTestConfig(array $config): static
  {
    $this->testConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for redeliver.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setRedeliverConfig(array $config): static
  {
    $this->redeliverConfig = $config;
    return $this;
  }

  /**
   * List all webhooks for a workspace
   *
   * @param \ElevenLabs\Webhooks\Requests\ListWebhooksRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\WorkspaceWebhookListResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function list(
    \ElevenLabs\Webhooks\Requests\ListWebhooksRequest $request = new \ElevenLabs\Webhooks\Requests\ListWebhooksRequest(),
    ?array $options = null
  ): ?\ElevenLabs\Types\WorkspaceWebhookListResponseModel {
    $includeUsages = $request->includeUsages;

    $resolvedConfig = $this->getResolvedConfig($this->listConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/workspace/webhooks',
        method: HttpMethod::GET,
        query: [
          'include_usages' => $includeUsages
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\WorkspaceWebhookListResponseModel::class
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
   * Create a new webhook for the workspace with the specified authentication type.
   *
   * @param \ElevenLabs\Webhooks\Requests\BodyCreateWorkspaceWebhookV1WorkspaceWebhooksPost $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\WorkspaceCreateWebhookResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function create(
    \ElevenLabs\Webhooks\Requests\BodyCreateWorkspaceWebhookV1WorkspaceWebhooksPost $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\WorkspaceCreateWebhookResponseModel {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->createConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/workspace/webhooks',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\WorkspaceCreateWebhookResponseModel::class
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
   * Update the specified workspace webhook
   *
   * @param string $webhookId The unique ID for the webhook
   * @param \ElevenLabs\Webhooks\Requests\BodyUpdateWorkspaceWebhookV1WorkspaceWebhooksWebhookIdPatch $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\PatchWorkspaceWebhookResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function update(
    string $webhookId,
    \ElevenLabs\Webhooks\Requests\BodyUpdateWorkspaceWebhookV1WorkspaceWebhooksWebhookIdPatch $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\PatchWorkspaceWebhookResponseModel {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->updateConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/workspace/webhooks/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($webhookId),
        method: HttpMethod::PATCH,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\PatchWorkspaceWebhookResponseModel::class
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
   * Delete the specified workspace webhook
   *
   * @param string $webhookId The unique ID for the webhook
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\DeleteWorkspaceWebhookResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function delete(
    string $webhookId,
    ?array $options = null
  ): ?\ElevenLabs\Types\DeleteWorkspaceWebhookResponseModel {
    $resolvedConfig = $this->getResolvedConfig($this->deleteConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/workspace/webhooks/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($webhookId),
        method: HttpMethod::DELETE
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\DeleteWorkspaceWebhookResponseModel::class
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
   * Sends a sample event of the given type to the webhook once and returns the endpoint's status code, response time, content type and response size. Test events are signed like real ones, are never retried, and share a limit of 10 per webhook per minute with redeliveries.
   *
   * @param string $webhookId The ID of the webhook.
   * @param \ElevenLabs\Webhooks\Requests\BodySendTestWebhookEventV1WorkspaceWebhooksWebhookIdTestPost $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\WebhookSendResultResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function test(
    string $webhookId,
    \ElevenLabs\Webhooks\Requests\BodySendTestWebhookEventV1WorkspaceWebhooksWebhookIdTestPost $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\WebhookSendResultResponseModel {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->testConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/workspace/webhooks/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($webhookId) .
          '/test',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\WebhookSendResultResponseModel::class
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
   * Sends a stored delivery again, once, with the same delivery ID, a new signature and an ElevenLabs-Webhook-Redelivery header. A retry that is already scheduled is still sent. Redelivering needs permission to manage webhooks and a web session, and the delivery's payload must be stored. Redeliveries and test events share a limit of 10 per webhook per minute.
   *
   * @param string $webhookId The ID of the webhook.
   * @param string $deliveryId The ID of the delivery to send again.
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\WebhookSendResultResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function redeliver(
    string $webhookId,
    string $deliveryId,
    ?array $options = null
  ): ?\ElevenLabs\Types\WebhookSendResultResponseModel {
    $resolvedConfig = $this->getResolvedConfig($this->redeliverConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/workspace/webhooks/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($webhookId) .
          '/deliveries/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($deliveryId) .
          '/redeliver',
        method: HttpMethod::POST
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\WebhookSendResultResponseModel::class
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
