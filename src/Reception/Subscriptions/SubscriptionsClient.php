<?php

declare(strict_types=1);

namespace ElevenLabs\Reception\Subscriptions;

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
class SubscriptionsClient extends BaseService
{
  /** @var array|null Method-level configuration for assign */
  protected ?array $assignConfig = null;

  /** @var array|null Method-level configuration for change */
  protected ?array $changeConfig = null;

  /** @var array|null Method-level configuration for unassign */
  protected ?array $unassignConfig = null;

  /** @var array|null Method-level configuration for restore */
  protected ?array $restoreConfig = null;

  /** @var array|null Method-level configuration for cancelPendingDowngrade */
  protected ?array $cancelPendingDowngradeConfig = null;

  /**
   * Set method-level configuration for assign.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setAssignConfig(array $config): static
  {
    $this->assignConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for change.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setChangeConfig(array $config): static
  {
    $this->changeConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for unassign.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setUnassignConfig(array $config): static
  {
    $this->unassignConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for restore.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setRestoreConfig(array $config): static
  {
    $this->restoreConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for cancelPendingDowngrade.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setCancelPendingDowngradeConfig(array $config): static
  {
    $this->cancelPendingDowngradeConfig = $config;
    return $this;
  }

  /**
   * Subscribe a reseller-attributed workspace to one of the reseller's tiers
   *
   * @param string $workspaceId ID of the customer workspace. Returned when you provision one; list them with `GET /v1/reception/reseller/workspaces`.
   * @param \ElevenLabs\Reception\Subscriptions\Requests\AssignResellerTierRequest $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?array<string, string>
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function assign(
    string $workspaceId,
    \ElevenLabs\Reception\Subscriptions\Requests\AssignResellerTierRequest $request,
    ?array $options = null
  ): ?array {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->assignConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/reception/reseller/workspaces/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($workspaceId) .
          '/subscription',
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
   * Move a reseller-attributed workspace between the reseller's tiers. Upgrades apply immediately; downgrades and lateral moves take effect at the end of the billing period.
   *
   * @param string $workspaceId ID of the customer workspace. Returned when you provision one; list them with `GET /v1/reception/reseller/workspaces`.
   * @param \ElevenLabs\Reception\Subscriptions\Requests\ChangeResellerTierRequest $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?array<string, string>
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function change(
    string $workspaceId,
    \ElevenLabs\Reception\Subscriptions\Requests\ChangeResellerTierRequest $request,
    ?array $options = null
  ): ?array {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->changeConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/reception/reseller/workspaces/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($workspaceId) .
          '/subscription',
        method: HttpMethod::PATCH,
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
   * End a reseller-attributed workspace's subscription at the end of the current billing period
   *
   * @param string $workspaceId ID of the customer workspace. Returned when you provision one; list them with `GET /v1/reception/reseller/workspaces`.
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?array<string, string>
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function unassign(string $workspaceId, ?array $options = null): ?array
  {
    $resolvedConfig = $this->getResolvedConfig($this->unassignConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/reception/reseller/workspaces/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($workspaceId) .
          '/subscription',
        method: HttpMethod::DELETE
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
   * Undo a pending unassignment so the subscription renews normally
   *
   * @param string $workspaceId ID of the customer workspace. Returned when you provision one; list them with `GET /v1/reception/reseller/workspaces`.
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?array<string, string>
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function restore(string $workspaceId, ?array $options = null): ?array
  {
    $resolvedConfig = $this->getResolvedConfig($this->restoreConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/reception/reseller/workspaces/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($workspaceId) .
          '/subscription/restore',
        method: HttpMethod::POST
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
   * Drop a scheduled downgrade, leaving the workspace on its current tier
   *
   * @param string $workspaceId ID of the customer workspace. Returned when you provision one; list them with `GET /v1/reception/reseller/workspaces`.
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?array<string, string>
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function cancelPendingDowngrade(string $workspaceId, ?array $options = null): ?array
  {
    $resolvedConfig = $this->getResolvedConfig($this->cancelPendingDowngradeConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/reception/reseller/workspaces/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($workspaceId) .
          '/subscription/cancel-downgrade',
        method: HttpMethod::POST
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
