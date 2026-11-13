<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\OutboundCampaigns\Calls;

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
class CallsClient extends BaseService
{
  /** @var array|null Method-level configuration for list */
  protected ?array $listConfig = null;

  /** @var array|null Method-level configuration for export */
  protected ?array $exportConfig = null;

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
   * List the calls of an outbound campaign, newest first: first contacts, retries, callbacks and redirects, whether queued, under way or done.
   *
   * @param string $campaignId
   * @param \ElevenLabs\Agents\OutboundCampaigns\Calls\Requests\ListCallsRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\CampaignCallsResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function list(
    string $campaignId,
    \ElevenLabs\Agents\OutboundCampaigns\Calls\Requests\ListCallsRequest $request = new \ElevenLabs\Agents\OutboundCampaigns\Calls\Requests\ListCallsRequest(),
    ?array $options = null
  ): ?\ElevenLabs\Types\CampaignCallsResponse {
    $pageSize = $request->pageSize;
    $leadId = $request->leadId;
    $status = $request->status;
    $callResult = $request->callResult;
    $stage = $request->stage;
    $cursor = $request->cursor;

    Validator::validateNumber($pageSize, 'page_size', min: 1, max: 500);

    $resolvedConfig = $this->getResolvedConfig($this->listConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/outbound-campaigns/campaigns/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($campaignId) .
          '/calls',
        method: HttpMethod::GET,
        query: [
          'page_size' => $pageSize,
          'lead_id' => $leadId,
          'status' => $status,
          'call_result' => $callResult,
          'stage' => $stage,
          'cursor' => $cursor
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\CampaignCallsResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Download every call of a campaign, with its lead and conversation results, as CSV.
   *
   * @param string $campaignId
   * @param \ElevenLabs\Agents\OutboundCampaigns\Calls\Requests\ExportCallsRequest $request Request parameters
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
    string $campaignId,
    \ElevenLabs\Agents\OutboundCampaigns\Calls\Requests\ExportCallsRequest $request = new \ElevenLabs\Agents\OutboundCampaigns\Calls\Requests\ExportCallsRequest(),
    ?array $options = null
  ): \Psr\Http\Message\StreamInterface {
    $limit = $request->limit;

    Validator::validateNumber($limit, 'limit', min: 1);

    $resolvedConfig = $this->getResolvedConfig($this->exportConfig, $options);
    $response = $this->sendBinaryStreamJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/outbound-campaigns/campaigns/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($campaignId) .
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
