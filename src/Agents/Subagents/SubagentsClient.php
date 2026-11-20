<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Subagents;

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
class SubagentsClient extends BaseService
{
  /** @var array|null Method-level configuration for getDependents */
  protected ?array $getDependentsConfig = null;

  /**
   * Set method-level configuration for getDependents.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setGetDependentsConfig(array $config): static
  {
    $this->getDependentsConfig = $config;
    return $this;
  }

  /**
   * Get a list of agents that use this agent as a subagent.
   *
   * @param string $agentId The id of an agent. This is returned on agent creation.
   * @param \ElevenLabs\Agents\Subagents\Requests\GetDependentsSubagentsRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\GetAgentSubagentDependentsResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function getDependents(
    string $agentId,
    \ElevenLabs\Agents\Subagents\Requests\GetDependentsSubagentsRequest $request = new \ElevenLabs\Agents\Subagents\Requests\GetDependentsSubagentsRequest(),
    ?array $options = null
  ): ?\ElevenLabs\Types\GetAgentSubagentDependentsResponseModel {
    $pageSize = $request->pageSize;
    $cursor = $request->cursor;

    Validator::validateNumber($pageSize, 'page_size', min: 1, max: 100);

    $resolvedConfig = $this->getResolvedConfig($this->getDependentsConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/agents/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($agentId) .
          '/subagent-dependents',
        method: HttpMethod::GET,
        query: [
          'page_size' => $pageSize,
          'cursor' => $cursor
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\GetAgentSubagentDependentsResponseModel::class
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
