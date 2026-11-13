<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\LlmUsage;

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
class LlmUsageClient extends BaseService
{
  /** @var array|null Method-level configuration for calculateForAgent */
  protected ?array $calculateForAgentConfig = null;

  /** @var array|null Method-level configuration for calculate */
  protected ?array $calculateConfig = null;

  /**
   * Set method-level configuration for calculateForAgent.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setCalculateForAgentConfig(array $config): static
  {
    $this->calculateForAgentConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for calculate.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setCalculateConfig(array $config): static
  {
    $this->calculateConfig = $config;
    return $this;
  }

  /**
   * Calculates expected number of LLM tokens needed for the specified agent.
   *
   * @param string $agentId
   * @param \ElevenLabs\Agents\LlmUsage\Requests\LlmUsageCalculatorRequestModel $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\LlmUsageCalculatorResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function calculateForAgent(
    string $agentId,
    \ElevenLabs\Agents\LlmUsage\Requests\LlmUsageCalculatorRequestModel $request = new \ElevenLabs\Agents\LlmUsage\Requests\LlmUsageCalculatorRequestModel(),
    ?array $options = null
  ): ?\ElevenLabs\Types\LlmUsageCalculatorResponseModel {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->calculateForAgentConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/agent/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($agentId) .
          '/llm-usage/calculate',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\LlmUsageCalculatorResponseModel::class
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
   * Returns a list of LLM models and the expected cost for using them based on the provided values.
   *
   * @param \ElevenLabs\Agents\LlmUsage\Requests\LlmUsageCalculatorPublicRequestModel $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\LlmUsageCalculatorResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function calculate(
    \ElevenLabs\Agents\LlmUsage\Requests\LlmUsageCalculatorPublicRequestModel $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\LlmUsageCalculatorResponseModel {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->calculateConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/llm-usage/calculate',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\LlmUsageCalculatorResponseModel::class
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
