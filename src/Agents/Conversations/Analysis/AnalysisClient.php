<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Conversations\Analysis;

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
class AnalysisClient extends BaseService
{
  /** @var array|null Method-level configuration for run */
  protected ?array $runConfig = null;

  /** @var array|null Method-level configuration for runEvaluation */
  protected ?array $runEvaluationConfig = null;

  /**
   * Set method-level configuration for run.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setRunConfig(array $config): static
  {
    $this->runConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for runEvaluation.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setRunEvaluationConfig(array $config): static
  {
    $this->runEvaluationConfig = $config;
    return $this;
  }

  /**
   * Run the analysis for a conversation using the agent's current evaluation criteria and data collection settings.
   *
   * @param string $conversationId ID of the conversation
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\GetConversationResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function run(
    string $conversationId,
    ?array $options = null
  ): ?\ElevenLabs\Types\GetConversationResponseModel {
    $resolvedConfig = $this->getResolvedConfig($this->runConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/conversations/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($conversationId) .
          '/analysis/run',
        method: HttpMethod::POST
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\GetConversationResponseModel::class
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
   * Rerun a specific evaluation for a conversation.
   *
   * @param string $conversationId ID of the conversation
   * @param \ElevenLabs\Agents\Conversations\Analysis\Requests\RunConversationEvaluationsRequest $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\GetConversationResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function runEvaluation(
    string $conversationId,
    \ElevenLabs\Agents\Conversations\Analysis\Requests\RunConversationEvaluationsRequest $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\GetConversationResponseModel {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->runEvaluationConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/conversations/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($conversationId) .
          '/analysis/evaluations/run',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\GetConversationResponseModel::class
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
