<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\OutboundCampaigns\Attention;

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
class AttentionClient extends BaseService
{
  /** @var array|null Method-level configuration for list */
  protected ?array $listConfig = null;

  /** @var array|null Method-level configuration for retry */
  protected ?array $retryConfig = null;

  /** @var array|null Method-level configuration for resolve */
  protected ?array $resolveConfig = null;

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
   * Set method-level configuration for resolve.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setResolveConfig(array $config): static
  {
    $this->resolveConfig = $config;
    return $this;
  }

  /**
   * List problems in the workspace's outbound campaigns that need you to act, such as an agent or phone number that can no longer be used, newest first. A campaign with an open item holds back the calls it affects.
   *
   * @param \ElevenLabs\Agents\OutboundCampaigns\Attention\Requests\ListAttentionRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\AttentionPageResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function list(
    \ElevenLabs\Agents\OutboundCampaigns\Attention\Requests\ListAttentionRequest $request = new \ElevenLabs\Agents\OutboundCampaigns\Attention\Requests\ListAttentionRequest(),
    ?array $options = null
  ): ?\ElevenLabs\Types\AttentionPageResponse {
    $campaignId = $request->campaignId;
    $includeResolved = $request->includeResolved;
    $pageSize = $request->pageSize;
    $cursor = $request->cursor;

    Validator::validateNumber($pageSize, 'page_size', min: 1, max: 500);

    $resolvedConfig = $this->getResolvedConfig($this->listConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/outbound-campaigns/attention',
        method: HttpMethod::GET,
        query: [
          'campaign_id' => $campaignId,
          'include_resolved' => $includeResolved,
          'page_size' => $pageSize,
          'cursor' => $cursor
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\AttentionPageResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Place the calls a retryable attention item holds back, once its cause is fixed. Resumes the campaign.
   *
   * @param string $attentionId
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\AttentionView
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function retry(
    string $attentionId,
    ?array $options = null
  ): ?\ElevenLabs\Types\AttentionView {
    $resolvedConfig = $this->getResolvedConfig($this->retryConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/outbound-campaigns/attention/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($attentionId) .
          '/retry',
        method: HttpMethod::POST
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\AttentionView::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Close an attention item that can't be retried, recording how it was handled.
   *
   * @param string $attentionId
   * @param \ElevenLabs\Agents\OutboundCampaigns\Attention\Requests\AttentionResolutionRequest $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\AttentionView
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function resolve(
    string $attentionId,
    \ElevenLabs\Agents\OutboundCampaigns\Attention\Requests\AttentionResolutionRequest $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\AttentionView {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->resolveConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/outbound-campaigns/attention/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($attentionId) .
          '/resolve',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\AttentionView::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }
}
