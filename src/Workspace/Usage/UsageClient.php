<?php

declare(strict_types=1);

namespace ElevenLabs\Workspace\Usage;

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
class UsageClient extends BaseService
{
  /** @var array|null Method-level configuration for getUsageByProductOverTime */
  protected ?array $getUsageByProductOverTimeConfig = null;

  /** @var array|null Method-level configuration for getUsage */
  protected ?array $getUsageConfig = null;

  /**
   * Set method-level configuration for getUsageByProductOverTime.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setGetUsageByProductOverTimeConfig(array $config): static
  {
    $this->getUsageByProductOverTimeConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for getUsage.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setGetUsageConfig(array $config): static
  {
    $this->getUsageConfig = $config;
    return $this;
  }

  /**
   * Returns credit usage broken down by product type over time, for workspaces billed in credits. The response is a tabular structure with columns, column_types, column_units, and rows. Some id columns also get a display-name column, such as user_label or voice_name, appended after the existing columns. For workspaces billed by cost, ranges that reach the date the workspace moved to cost billing return an error; use /v1/workspace/analytics/usage instead.
   *
   * @param \ElevenLabs\Workspace\Usage\Requests\BodyGetWorkspaceUsageV1WorkspaceAnalyticsQueryUsageByProductOverTimePost $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\WorkspaceAnalyticsQueryResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function getUsageByProductOverTime(
    \ElevenLabs\Workspace\Usage\Requests\BodyGetWorkspaceUsageV1WorkspaceAnalyticsQueryUsageByProductOverTimePost $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\WorkspaceAnalyticsQueryResponseModel {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->getUsageByProductOverTimeConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/workspace/analytics/query/usage-by-product-over-time',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\WorkspaceAnalyticsQueryResponseModel::class
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
   * Returns the cost of the workspace's usage over time, for workspaces billed by cost. Usage is bucketed by UTC day. The response is a tabular structure with columns, column_types, column_units, and rows, with one row per group and bucket. `total_cost` is the cost in the workspace's currency and `total_charge_count` the billed quantity. Usage can be grouped or filtered by at most two of `user_id`, `hashed_xi_api_key`, `region`, `reporting_workspace_id`, `billing_group_id`, `product_type`, `surface` and `actor`, and grouping by two of them requires an `eq` or `in` filter on one. `model`, `request_source`, `fiat_charge_type` and `fiat_currency` can always be added. Some id columns also get a display-name column, such as user_label, appended after the existing columns. Workspaces billed in credits should use /v1/workspace/analytics/query/usage-by-product-over-time.
   *
   * @param \ElevenLabs\Workspace\Usage\Requests\BodyGetWorkspaceCostUsageV1WorkspaceAnalyticsUsagePost $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\WorkspaceAnalyticsQueryResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function getUsage(
    \ElevenLabs\Workspace\Usage\Requests\BodyGetWorkspaceCostUsageV1WorkspaceAnalyticsUsagePost $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\WorkspaceAnalyticsQueryResponseModel {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->getUsageConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/workspace/analytics/usage',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\WorkspaceAnalyticsQueryResponseModel::class
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
