<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Tools\Executions;

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
class ExecutionsClient extends BaseService
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
   * Get paginated list of tool executions for a specific tool.
   *
   * @param string $toolId ID of the requested tool.
   * @param \ElevenLabs\Agents\Tools\Executions\Requests\GetExecutionsRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\GetToolExecutionsPageResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function get(
    string $toolId,
    \ElevenLabs\Agents\Tools\Executions\Requests\GetExecutionsRequest $request = new \ElevenLabs\Agents\Tools\Executions\Requests\GetExecutionsRequest(),
    ?array $options = null
  ): ?\ElevenLabs\Types\GetToolExecutionsPageResponseModel {
    $cursor = $request->cursor;
    $pageSize = $request->pageSize;
    $isError = $request->isError;
    $agentId = $request->agentId;
    $branchId = $request->branchId;
    $startTime = $request->startTime;
    $endTime = $request->endTime;

    Validator::validateNumber($pageSize, 'page_size', min: 1, max: 100);

    $resolvedConfig = $this->getResolvedConfig($this->getConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/tools/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($toolId) .
          '/executions',
        method: HttpMethod::GET,
        query: [
          'cursor' => $cursor,
          'page_size' => $pageSize,
          'is_error' => $isError,
          'agent_id' => $agentId,
          'branch_id' => $branchId,
          'start_time' => $startTime,
          'end_time' => $endTime
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\GetToolExecutionsPageResponseModel::class
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
