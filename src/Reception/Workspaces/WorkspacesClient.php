<?php

declare(strict_types=1);

namespace ElevenLabs\Reception\Workspaces;

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
class WorkspacesClient extends BaseService
{
  /** @var array|null Method-level configuration for list */
  protected ?array $listConfig = null;

  /** @var array|null Method-level configuration for create */
  protected ?array $createConfig = null;

  /** @var array|null Method-level configuration for completeOnboarding */
  protected ?array $completeOnboardingConfig = null;

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
   * Set method-level configuration for completeOnboarding.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setCompleteOnboardingConfig(array $config): static
  {
    $this->completeOnboardingConfig = $config;
    return $this;
  }

  /**
   * List workspaces attributed to the caller's reseller, with cursor-based pagination
   *
   * @param \ElevenLabs\Reception\Workspaces\Requests\ListWorkspacesRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\ResellerWorkspacesResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function list(
    \ElevenLabs\Reception\Workspaces\Requests\ListWorkspacesRequest $request = new \ElevenLabs\Reception\Workspaces\Requests\ListWorkspacesRequest(),
    ?array $options = null
  ): ?\ElevenLabs\Types\ResellerWorkspacesResponse {
    $cursor = $request->cursor;
    $pageSize = $request->pageSize;

    Validator::validateNumber($pageSize, 'page_size', min: 1, max: 100);

    $resolvedConfig = $this->getResolvedConfig($this->listConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/reception/reseller/workspaces',
        method: HttpMethod::GET,
        query: [
          'cursor' => $cursor,
          'page_size' => $pageSize
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\ResellerWorkspacesResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Create a workspace for one of your customers, optionally with a tier, a phone number and team invites.
   *
   * @param \ElevenLabs\Reception\Workspaces\Requests\ReceptionProvisionResellerWorkspaceRequest $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\ProvisionResellerWorkspaceResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function create(
    \ElevenLabs\Reception\Workspaces\Requests\ReceptionProvisionResellerWorkspaceRequest $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\ProvisionResellerWorkspaceResponse {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->createConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/reception/reseller/workspaces',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\ProvisionResellerWorkspaceResponse::class
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
   * Finish setting up the workspace: create its receptionist and assistant from the business profile, reusing a receptionist from a setup already started, and connect your phone number, if you supply one. Safe to retry.
   *
   * @param string $workspaceId ID of the customer workspace. Returned when you provision one; list them with `GET /v1/reception/reseller/workspaces`.
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\ResellerWorkspaceOnboardingResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function completeOnboarding(
    string $workspaceId,
    ?array $options = null
  ): ?\ElevenLabs\Types\ResellerWorkspaceOnboardingResponse {
    $resolvedConfig = $this->getResolvedConfig($this->completeOnboardingConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/reception/reseller/workspaces/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($workspaceId) .
          '/complete-onboarding',
        method: HttpMethod::POST
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\ResellerWorkspaceOnboardingResponse::class
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
