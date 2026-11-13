<?php

declare(strict_types=1);

namespace ElevenLabs\Workspace\Resources;

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
class ResourcesClient extends BaseService
{
  /** @var array|null Method-level configuration for get */
  protected ?array $getConfig = null;

  /** @var array|null Method-level configuration for share */
  protected ?array $shareConfig = null;

  /** @var array|null Method-level configuration for unshare */
  protected ?array $unshareConfig = null;

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
   * Set method-level configuration for share.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setShareConfig(array $config): static
  {
    $this->shareConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for unshare.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setUnshareConfig(array $config): static
  {
    $this->unshareConfig = $config;
    return $this;
  }

  /**
   * Gets the metadata of a resource by ID.
   *
   * @param string $resourceId The ID of the target resource.
   * @param \ElevenLabs\Workspace\Resources\Requests\GetResourcesRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\ResourceMetadataResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function get(
    string $resourceId,
    \ElevenLabs\Workspace\Resources\Requests\GetResourcesRequest $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\ResourceMetadataResponseModel {
    $resourceType = $request->resourceType;

    $resolvedConfig = $this->getResolvedConfig($this->getConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/workspace/resources/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($resourceId),
        method: HttpMethod::GET,
        query: [
          'resource_type' => $resourceType
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\ResourceMetadataResponseModel::class
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
   * Grants a role (one of 'admin', 'editor', 'commenter', or 'viewer') on a workspace resource to a user, group, or workspace (service account) API key. This overrides any existing role the target has on the resource. To target a user or service account, pass only the user email; the user must be in your workspace. To target a group, pass only the group id. To target a workspace (service account) API key, pass the api key id; the resource will be shared with the service account associated with that key. You must have admin access to the resource to share it.
   *
   * @param string $resourceId The ID of the target resource.
   * @param \ElevenLabs\Workspace\Resources\Requests\BodyShareWorkspaceResourceV1WorkspaceResourcesResourceIdSharePost $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return mixed
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function share(
    string $resourceId,
    \ElevenLabs\Workspace\Resources\Requests\BodyShareWorkspaceResourceV1WorkspaceResourcesResourceIdSharePost $request,
    ?array $options = null
  ): mixed {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->shareConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/workspace/resources/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($resourceId) .
          '/share',
        method: HttpMethod::POST,
        body: $request
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

  /**
   * Removes any existing role on a workspace resource from a user, group, or workspace (service account) API key. To target a user or service account, pass only the user email; the user must be in your workspace. To target a group, pass only the group id. To target a workspace (service account) API key, pass the api key id; the resource will be unshared from the service account associated with that key. You must have admin access to the resource to unshare it. You cannot remove permissions from the user who created the resource.
   *
   * @param string $resourceId The ID of the target resource.
   * @param \ElevenLabs\Workspace\Resources\Requests\BodyUnshareWorkspaceResourceV1WorkspaceResourcesResourceIdUnsharePost $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return mixed
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function unshare(
    string $resourceId,
    \ElevenLabs\Workspace\Resources\Requests\BodyUnshareWorkspaceResourceV1WorkspaceResourcesResourceIdUnsharePost $request,
    ?array $options = null
  ): mixed {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->unshareConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/workspace/resources/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($resourceId) .
          '/unshare',
        method: HttpMethod::POST,
        body: $request
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
