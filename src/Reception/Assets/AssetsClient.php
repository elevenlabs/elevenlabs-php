<?php

declare(strict_types=1);

namespace ElevenLabs\Reception\Assets;

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
class AssetsClient extends BaseService
{
  /** @var array|null Method-level configuration for list */
  protected ?array $listConfig = null;

  /** @var array|null Method-level configuration for create */
  protected ?array $createConfig = null;

  /** @var array|null Method-level configuration for get */
  protected ?array $getConfig = null;

  /** @var array|null Method-level configuration for update */
  protected ?array $updateConfig = null;

  /** @var array|null Method-level configuration for delete */
  protected ?array $deleteConfig = null;

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
   * List the workspace's bookable assets, such as rooms or equipment.
   *
   * @param \ElevenLabs\Reception\Assets\Requests\ListAssetsRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?array<\ElevenLabs\Types\ReceptionAssetResource>
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function list(
    \ElevenLabs\Reception\Assets\Requests\ListAssetsRequest $request,
    ?array $options = null
  ): ?array {
    $xiWorkspaceId = $request->xiWorkspaceId;

    $resolvedConfig = $this->getResolvedConfig($this->listConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/reception/assets',
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
        \ElevenLabs\Types\ReceptionAssetResource::class . '[]'
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
   * Create a bookable asset, such as a room or a piece of equipment.
   *
   * @param \ElevenLabs\Reception\Assets\Requests\ReceptionCreateAssetRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\ReceptionAssetResource
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function create(
    \ElevenLabs\Reception\Assets\Requests\ReceptionCreateAssetRequest $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\ReceptionAssetResource {
    $xiWorkspaceId = $request->xiWorkspaceId;

    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->createConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/reception/assets',
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
      $result = Serializer::deserialize($data, \ElevenLabs\Types\ReceptionAssetResource::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Get an asset by ID.
   *
   * @param string $assetId ID of the asset. Returned when you create one; list them with `GET /v1/reception/assets`.
   * @param \ElevenLabs\Reception\Assets\Requests\GetAssetsRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\ReceptionAssetResource
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function get(
    string $assetId,
    \ElevenLabs\Reception\Assets\Requests\GetAssetsRequest $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\ReceptionAssetResource {
    $xiWorkspaceId = $request->xiWorkspaceId;

    $resolvedConfig = $this->getResolvedConfig($this->getConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/reception/assets/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($assetId),
        method: HttpMethod::GET,
        headers: [
          'xi-workspace-id' => $xiWorkspaceId
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\ReceptionAssetResource::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Update an asset. Only the fields sent are changed.
   *
   * @param string $assetId ID of the asset. Returned when you create one; list them with `GET /v1/reception/assets`.
   * @param \ElevenLabs\Reception\Assets\Requests\ReceptionUpdateAssetRequestPatch $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\ReceptionAssetResource
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function update(
    string $assetId,
    \ElevenLabs\Reception\Assets\Requests\ReceptionUpdateAssetRequestPatch $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\ReceptionAssetResource {
    $xiWorkspaceId = $request->xiWorkspaceId;

    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->updateConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/reception/assets/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($assetId),
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
      $result = Serializer::deserialize($data, \ElevenLabs\Types\ReceptionAssetResource::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Delete an asset.
   *
   * @param string $assetId ID of the asset. Returned when you create one; list them with `GET /v1/reception/assets`.
   * @param \ElevenLabs\Reception\Assets\Requests\DeleteAssetsRequest $request Request parameters
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
    string $assetId,
    \ElevenLabs\Reception\Assets\Requests\DeleteAssetsRequest $request,
    ?array $options = null
  ): ?array {
    $xiWorkspaceId = $request->xiWorkspaceId;

    $resolvedConfig = $this->getResolvedConfig($this->deleteConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/reception/assets/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($assetId),
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
