<?php

declare(strict_types=1);

namespace ElevenLabs\Reception\Receptionists;

use ElevenLabs\Services\BaseService;
use ElevenLabs\Core\Json\JsonApiRequest;
use ElevenLabs\Core\Client\HttpMethod;
use ElevenLabs\Utils\Serializer;

use ElevenLabs\Reception\Receptionists\Rules\RulesClient;
use ElevenLabs\Reception\Receptionists\Procedures\ProceduresClient;
use ElevenLabs\Reception\Receptionists\TransferRules\TransferRulesClient;

/**
 * Service class containing API endpoint methods.
 *
 * This class extends the base service to provide typed methods for specific API operations.
 * Each method corresponds to an API endpoint and handles request serialization,
 * execution, and response deserialization.
 */
class ReceptionistsClient extends BaseService
{
  public RulesClient $rules;
  public ProceduresClient $procedures;
  public TransferRulesClient $transferRules;

  public function __construct(\ElevenLabs\Core\Client\RawClient $client, ?array $options = null)
  {
    parent::__construct($client, $options);
    $this->rules = new RulesClient($client, $options);
    $this->procedures = new ProceduresClient($client, $options);
    $this->transferRules = new TransferRulesClient($client, $options);
  }

  /** @var array|null Method-level configuration for list */
  protected ?array $listConfig = null;

  /** @var array|null Method-level configuration for update */
  protected ?array $updateConfig = null;

  /** @var array|null Method-level configuration for activate */
  protected ?array $activateConfig = null;

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
   * Set method-level configuration for activate.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setActivateConfig(array $config): static
  {
    $this->activateConfig = $config;
    return $this;
  }

  /**
   * List every customer-facing receptionist for the workspace.
   *
   * @param \ElevenLabs\Reception\Receptionists\Requests\ListReceptionistsRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?array<\ElevenLabs\Types\ReceptionCustomerFacingAgentResponse>
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function list(
    \ElevenLabs\Reception\Receptionists\Requests\ListReceptionistsRequest $request,
    ?array $options = null
  ): ?array {
    $xiWorkspaceId = $request->xiWorkspaceId;

    $resolvedConfig = $this->getResolvedConfig($this->listConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/reception/customer-facing-agents',
        method: HttpMethod::GET,
        headers: [
          'xi-workspace-id' => $xiWorkspaceId
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\ReceptionCustomerFacingAgentResponse::class . '[]'
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
   * Update a receptionist's display name, config and/or widget appearance.
   *
   * @param string $agentId ID of the receptionist. List them with `GET /v1/reception/customer-facing-agents`.
   * @param \ElevenLabs\Reception\Receptionists\Requests\ReceptionUpdateCustomerFacingAgentRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\ReceptionCustomerFacingAgentResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function update(
    string $agentId,
    \ElevenLabs\Reception\Receptionists\Requests\ReceptionUpdateCustomerFacingAgentRequest $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\ReceptionCustomerFacingAgentResponse {
    $xiWorkspaceId = $request->xiWorkspaceId;

    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->updateConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/reception/customer-facing-agents/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($agentId),
        method: HttpMethod::PATCH,
        headers: [
          'xi-workspace-id' => $xiWorkspaceId
        ],
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\ReceptionCustomerFacingAgentResponse::class
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
   * Re-activate a deactivated receptionist. Fails with `quota_exceeded` when the plan has no free receptionist slot.
   *
   * @param string $agentId ID of the receptionist. List them with `GET /v1/reception/customer-facing-agents`.
   * @param \ElevenLabs\Reception\Receptionists\Requests\ActivateReceptionistsRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\ReceptionCustomerFacingAgentResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function activate(
    string $agentId,
    \ElevenLabs\Reception\Receptionists\Requests\ActivateReceptionistsRequest $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\ReceptionCustomerFacingAgentResponse {
    $xiWorkspaceId = $request->xiWorkspaceId;

    $resolvedConfig = $this->getResolvedConfig($this->activateConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/reception/customer-facing-agents/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($agentId) .
          '/activate',
        method: HttpMethod::POST,
        headers: [
          'xi-workspace-id' => $xiWorkspaceId
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\ReceptionCustomerFacingAgentResponse::class
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
