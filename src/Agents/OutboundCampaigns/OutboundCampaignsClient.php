<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\OutboundCampaigns;

use ElevenLabs\Services\BaseService;
use ElevenLabs\Core\Json\JsonApiRequest;
use ElevenLabs\Core\Client\HttpMethod;
use ElevenLabs\Utils\Serializer;
use ElevenLabs\Utils\Validator;

use ElevenLabs\Agents\OutboundCampaigns\Config\ConfigClient;
use ElevenLabs\Agents\OutboundCampaigns\Leads\LeadsClient;
use ElevenLabs\Agents\OutboundCampaigns\Calls\CallsClient;
use ElevenLabs\Agents\OutboundCampaigns\Attention\AttentionClient;

/**
 * Service class containing API endpoint methods.
 *
 * This class extends the base service to provide typed methods for specific API operations.
 * Each method corresponds to an API endpoint and handles request serialization,
 * execution, and response deserialization.
 */
class OutboundCampaignsClient extends BaseService
{
  public ConfigClient $config;
  public LeadsClient $leads;
  public CallsClient $calls;
  public AttentionClient $attention;

  public function __construct(\ElevenLabs\Core\Client\RawClient $client, ?array $options = null)
  {
    parent::__construct($client, $options);
    $this->config = new ConfigClient($client, $options);
    $this->leads = new LeadsClient($client, $options);
    $this->calls = new CallsClient($client, $options);
    $this->attention = new AttentionClient($client, $options);
  }

  /** @var array|null Method-level configuration for list */
  protected ?array $listConfig = null;

  /** @var array|null Method-level configuration for pauseAll */
  protected ?array $pauseAllConfig = null;

  /** @var array|null Method-level configuration for stopAll */
  protected ?array $stopAllConfig = null;

  /** @var array|null Method-level configuration for create */
  protected ?array $createConfig = null;

  /** @var array|null Method-level configuration for get */
  protected ?array $getConfig = null;

  /** @var array|null Method-level configuration for getProgress */
  protected ?array $getProgressConfig = null;

  /** @var array|null Method-level configuration for getFollowUpRequests */
  protected ?array $getFollowUpRequestsConfig = null;

  /** @var array|null Method-level configuration for pause */
  protected ?array $pauseConfig = null;

  /** @var array|null Method-level configuration for resume */
  protected ?array $resumeConfig = null;

  /** @var array|null Method-level configuration for stop */
  protected ?array $stopConfig = null;

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
   * Set method-level configuration for pauseAll.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setPauseAllConfig(array $config): static
  {
    $this->pauseAllConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for stopAll.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setStopAllConfig(array $config): static
  {
    $this->stopAllConfig = $config;
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
   * Set method-level configuration for getProgress.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setGetProgressConfig(array $config): static
  {
    $this->getProgressConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for getFollowUpRequests.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setGetFollowUpRequestsConfig(array $config): static
  {
    $this->getFollowUpRequestsConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for pause.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setPauseConfig(array $config): static
  {
    $this->pauseConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for resume.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setResumeConfig(array $config): static
  {
    $this->resumeConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for stop.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setStopConfig(array $config): static
  {
    $this->stopConfig = $config;
    return $this;
  }

  /**
   * List the workspace's outbound campaigns, newest first.
   *
   * @param \ElevenLabs\Agents\OutboundCampaigns\Requests\ListOutboundCampaignsRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\CampaignPageResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function list(
    \ElevenLabs\Agents\OutboundCampaigns\Requests\ListOutboundCampaignsRequest $request = new \ElevenLabs\Agents\OutboundCampaigns\Requests\ListOutboundCampaignsRequest(),
    ?array $options = null
  ): ?\ElevenLabs\Types\CampaignPageResponse {
    $pageSize = $request->pageSize;
    $status = $request->status;
    $agentId = $request->agentId;
    $channel = $request->channel;
    $mode = $request->mode;
    $search = $request->search;
    $cursor = $request->cursor;

    Validator::validateNumber($pageSize, 'page_size', min: 1, max: 500);
    Validator::validateString($search, 'search', maxLength: 256);

    $resolvedConfig = $this->getResolvedConfig($this->listConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/outbound-campaigns/campaigns',
        method: HttpMethod::GET,
        query: [
          'page_size' => $pageSize,
          'status' => $status,
          'agent_id' => $agentId,
          'channel' => $channel,
          'mode' => $mode,
          'search' => $search,
          'cursor' => $cursor
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\CampaignPageResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Pause every running outbound campaign in the workspace. Paused campaigns place no new calls until resumed.
   *
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\PauseAllCampaignsResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function pauseAll(?array $options = null): ?\ElevenLabs\Types\PauseAllCampaignsResponse
  {
    $resolvedConfig = $this->getResolvedConfig($this->pauseAllConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/outbound-campaigns/campaigns/pause-all',
        method: HttpMethod::POST
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\PauseAllCampaignsResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Stop every outbound campaign in the workspace that hasn't finished. Returns `202` while calls already placed are still finishing.
   *
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\StopAllCampaignsResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function stopAll(?array $options = null): ?\ElevenLabs\Types\StopAllCampaignsResponse
  {
    $resolvedConfig = $this->getResolvedConfig($this->stopAllConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/outbound-campaigns/campaigns/stop-all',
        method: HttpMethod::POST
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\StopAllCampaignsResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Create an outbound campaign that calls or messages each recipient with the agent, within the policy's calling windows, retrying and following up as it allows. Returns `201` for a new campaign. A repeated request, matched by `idempotency_key` or else by its body, returns the existing campaign with `created` false.
   *
   * @param \ElevenLabs\Agents\OutboundCampaigns\Requests\SubmitCampaignRequest $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\SubmitCampaignResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function create(
    \ElevenLabs\Agents\OutboundCampaigns\Requests\SubmitCampaignRequest $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\SubmitCampaignResponse {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->createConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/outbound-campaigns/campaigns/submit',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\SubmitCampaignResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Get an outbound campaign and its lead counts.
   *
   * @param string $campaignId
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\CampaignResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function get(
    string $campaignId,
    ?array $options = null
  ): ?\ElevenLabs\Types\CampaignResponse {
    $resolvedConfig = $this->getResolvedConfig($this->getConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/outbound-campaigns/campaigns/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($campaignId),
        method: HttpMethod::GET
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\CampaignResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Get where an outbound campaign's leads and calls stand, and when its next call is due.
   *
   * @param string $campaignId
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\CampaignProgressResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function getProgress(
    string $campaignId,
    ?array $options = null
  ): ?\ElevenLabs\Types\CampaignProgressResponse {
    $resolvedConfig = $this->getResolvedConfig($this->getProgressConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/outbound-campaigns/campaigns/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($campaignId) .
          '/progress',
        method: HttpMethod::GET
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\CampaignProgressResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Count the callbacks and redirects contacts asked for during an outbound campaign's calls.
   *
   * @param string $campaignId
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\CampaignFollowUpRequestsResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function getFollowUpRequests(
    string $campaignId,
    ?array $options = null
  ): ?\ElevenLabs\Types\CampaignFollowUpRequestsResponse {
    $resolvedConfig = $this->getResolvedConfig($this->getFollowUpRequestsConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/outbound-campaigns/campaigns/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($campaignId) .
          '/follow-up-requests',
        method: HttpMethod::GET
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\CampaignFollowUpRequestsResponse::class
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
   * Pause an outbound campaign. It places no new calls until resumed; calls already placed carry on.
   *
   * @param string $campaignId
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\CampaignResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function pause(
    string $campaignId,
    ?array $options = null
  ): ?\ElevenLabs\Types\CampaignResponse {
    $resolvedConfig = $this->getResolvedConfig($this->pauseConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/outbound-campaigns/campaigns/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($campaignId) .
          '/pause',
        method: HttpMethod::POST
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\CampaignResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Resume a paused outbound campaign, including calls an attention item held back.
   *
   * @param string $campaignId
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\CampaignResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function resume(
    string $campaignId,
    ?array $options = null
  ): ?\ElevenLabs\Types\CampaignResponse {
    $resolvedConfig = $this->getResolvedConfig($this->resumeConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/outbound-campaigns/campaigns/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($campaignId) .
          '/resume',
        method: HttpMethod::POST
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\CampaignResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Stop an outbound campaign for good: queued calls are cancelled and no lead is called again. Returns `202` with the campaign `stopping` while calls already placed are still finishing.
   *
   * @param string $campaignId
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\CampaignResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function stop(
    string $campaignId,
    ?array $options = null
  ): ?\ElevenLabs\Types\CampaignResponse {
    $resolvedConfig = $this->getResolvedConfig($this->stopConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/outbound-campaigns/campaigns/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($campaignId) .
          '/stop',
        method: HttpMethod::POST
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\CampaignResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }
}
