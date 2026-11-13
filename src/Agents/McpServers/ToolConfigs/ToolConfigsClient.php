<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\McpServers\ToolConfigs;

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
class ToolConfigsClient extends BaseService
{
  /** @var array|null Method-level configuration for create */
  protected ?array $createConfig = null;

  /** @var array|null Method-level configuration for get */
  protected ?array $getConfig = null;

  /** @var array|null Method-level configuration for update */
  protected ?array $updateConfig = null;

  /** @var array|null Method-level configuration for delete */
  protected ?array $deleteConfig = null;

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
   * Create configuration overrides for a specific MCP tool.
   *
   * @param string $mcpServerId ID of the MCP Server.
   * @param \ElevenLabs\Agents\McpServers\ToolConfigs\Requests\McpToolConfigOverrideCreateRequestModel $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\McpServerResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function create(
    string $mcpServerId,
    \ElevenLabs\Agents\McpServers\ToolConfigs\Requests\McpToolConfigOverrideCreateRequestModel $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\McpServerResponseModel {
    $environment = $request->environment;

    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->createConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/mcp-servers/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($mcpServerId) .
          '/tool-configs',
        method: HttpMethod::POST,
        query: [
          'environment' => $environment
        ],
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\McpServerResponseModel::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Retrieve configuration overrides for a specific MCP tool.
   *
   * @param string $mcpServerId ID of the MCP Server.
   * @param string $toolName Name of the MCP tool to retrieve config overrides for.
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\McpToolConfigOverrideOutput
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function get(
    string $mcpServerId,
    string $toolName,
    ?array $options = null
  ): ?\ElevenLabs\Types\McpToolConfigOverrideOutput {
    $resolvedConfig = $this->getResolvedConfig($this->getConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/mcp-servers/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($mcpServerId) .
          '/tool-configs/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($toolName),
        method: HttpMethod::GET
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\McpToolConfigOverrideOutput::class
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
   * Update configuration overrides for a specific MCP tool.
   *
   * @param string $mcpServerId ID of the MCP Server.
   * @param string $toolName Name of the MCP tool to update config overrides for.
   * @param \ElevenLabs\Agents\McpServers\ToolConfigs\Requests\McpToolConfigOverrideUpdateRequestModel $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\McpServerResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function update(
    string $mcpServerId,
    string $toolName,
    \ElevenLabs\Agents\McpServers\ToolConfigs\Requests\McpToolConfigOverrideUpdateRequestModel $request = new \ElevenLabs\Agents\McpServers\ToolConfigs\Requests\McpToolConfigOverrideUpdateRequestModel(),
    ?array $options = null
  ): ?\ElevenLabs\Types\McpServerResponseModel {
    $environment = $request->environment;

    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->updateConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/mcp-servers/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($mcpServerId) .
          '/tool-configs/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($toolName),
        method: HttpMethod::PATCH,
        query: [
          'environment' => $environment
        ],
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\McpServerResponseModel::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Remove configuration overrides for a specific MCP tool.
   *
   * @param string $mcpServerId ID of the MCP Server.
   * @param string $toolName Name of the MCP tool to remove config overrides for.
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\McpServerResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function delete(
    string $mcpServerId,
    string $toolName,
    ?array $options = null
  ): ?\ElevenLabs\Types\McpServerResponseModel {
    $resolvedConfig = $this->getResolvedConfig($this->deleteConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/mcp-servers/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($mcpServerId) .
          '/tool-configs/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($toolName),
        method: HttpMethod::DELETE
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\McpServerResponseModel::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }
}
