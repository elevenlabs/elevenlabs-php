<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\McpServers\Tools;

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
class ToolsClient extends BaseService
{
  /** @var array|null Method-level configuration for list */
  protected ?array $listConfig = null;

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
   * Retrieve all tools available for a specific MCP server configuration.
   *
   * @param string $mcpServerId ID of the MCP Server.
   * @param \ElevenLabs\Agents\McpServers\Tools\Requests\ListToolsRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\ListMcpToolsResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function list(
    string $mcpServerId,
    \ElevenLabs\Agents\McpServers\Tools\Requests\ListToolsRequest $request = new \ElevenLabs\Agents\McpServers\Tools\Requests\ListToolsRequest(),
    ?array $options = null
  ): ?\ElevenLabs\Types\ListMcpToolsResponseModel {
    $environment = $request->environment;

    $resolvedConfig = $this->getResolvedConfig($this->listConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/mcp-servers/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($mcpServerId) .
          '/tools',
        method: HttpMethod::GET,
        query: [
          'environment' => $environment
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\ListMcpToolsResponseModel::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }
}
