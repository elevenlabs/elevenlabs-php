<?php

declare(strict_types=1);

namespace ElevenLabs\Reception\Receptionists\TransferRules;

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
class TransferRulesClient extends BaseService
{
  /** @var array|null Method-level configuration for create */
  protected ?array $createConfig = null;

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
   * Add a phone forwarding rule to the named receptionist.
   *
   * @param string $agentId ID of the receptionist. List them with `GET /v1/reception/customer-facing-agents`.
   * @param \ElevenLabs\Reception\Receptionists\TransferRules\Requests\ReceptionCreateTransferRuleRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\ReceptionTransferRule
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function create(
    string $agentId,
    \ElevenLabs\Reception\Receptionists\TransferRules\Requests\ReceptionCreateTransferRuleRequest $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\ReceptionTransferRule {
    $xiWorkspaceId = $request->xiWorkspaceId;

    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->createConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/reception/customer-facing-agents/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($agentId) .
          '/transfer-rules',
        method: HttpMethod::POST,
        headers: [
          'xi-workspace-id' => $xiWorkspaceId
        ],
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\ReceptionTransferRule::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Replace an existing transfer rule on the named receptionist. Send every field: an omitted `post_dial_digits` clears it.
   *
   * @param string $agentId ID of the receptionist. List them with `GET /v1/reception/customer-facing-agents`.
   * @param string $ruleId ID of the transfer rule. Returned when you add one, and listed in the receptionist's `config.transfer_rules`.
   * @param \ElevenLabs\Reception\Receptionists\TransferRules\Requests\ReceptionUpdateTransferRuleRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\ReceptionTransferRule
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function update(
    string $agentId,
    string $ruleId,
    \ElevenLabs\Reception\Receptionists\TransferRules\Requests\ReceptionUpdateTransferRuleRequest $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\ReceptionTransferRule {
    $xiWorkspaceId = $request->xiWorkspaceId;

    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->updateConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/reception/customer-facing-agents/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($agentId) .
          '/transfer-rules/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($ruleId),
        method: HttpMethod::PUT,
        headers: [
          'xi-workspace-id' => $xiWorkspaceId
        ],
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\ReceptionTransferRule::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Delete a transfer rule from the named receptionist.
   *
   * @param string $agentId ID of the receptionist. List them with `GET /v1/reception/customer-facing-agents`.
   * @param string $ruleId ID of the transfer rule. Returned when you add one, and listed in the receptionist's `config.transfer_rules`.
   * @param \ElevenLabs\Reception\Receptionists\TransferRules\Requests\DeleteTransferRulesRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?array<string, string>
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function delete(
    string $agentId,
    string $ruleId,
    \ElevenLabs\Reception\Receptionists\TransferRules\Requests\DeleteTransferRulesRequest $request,
    ?array $options = null
  ): ?array {
    $xiWorkspaceId = $request->xiWorkspaceId;

    $resolvedConfig = $this->getResolvedConfig($this->deleteConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/reception/customer-facing-agents/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($agentId) .
          '/transfer-rules/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($ruleId),
        method: HttpMethod::DELETE,
        headers: [
          'xi-workspace-id' => $xiWorkspaceId
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = $this->decodeJson($data);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }
}
