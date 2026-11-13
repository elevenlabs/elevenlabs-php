<?php

declare(strict_types=1);

namespace ElevenLabs\AudioNative;

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
class AudioNativeClient extends BaseService
{
  /** @var array|null Method-level configuration for create */
  protected ?array $createConfig = null;

  /** @var array|null Method-level configuration for getSettings */
  protected ?array $getSettingsConfig = null;

  /** @var array|null Method-level configuration for update */
  protected ?array $updateConfig = null;

  /** @var array|null Method-level configuration for updateContentFromUrl */
  protected ?array $updateContentFromUrlConfig = null;

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
   * Set method-level configuration for getSettings.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setGetSettingsConfig(array $config): static
  {
    $this->getSettingsConfig = $config;
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
   * Set method-level configuration for updateContentFromUrl.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setUpdateContentFromUrlConfig(array $config): static
  {
    $this->updateContentFromUrlConfig = $config;
    return $this;
  }

  /**
   * Creates Audio Native enabled project, optionally starts conversion and returns project ID and embeddable HTML snippet.
   *
   * @param \ElevenLabs\AudioNative\Requests\BodyCreatesAudioNativeEnabledProjectV1AudioNativePost $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\AudioNativeCreateProjectResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function create(
    \ElevenLabs\AudioNative\Requests\BodyCreatesAudioNativeEnabledProjectV1AudioNativePost $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\AudioNativeCreateProjectResponseModel {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->createConfig, $options);
    $response = $this->sendRequest(
      'post',
      '/v1/audio-native',
      ['multipart' => $request->toMultipart()],
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\AudioNativeCreateProjectResponseModel::class
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
   * Get player settings for the specific project.
   *
   * @param string $projectId The ID of the Studio project.
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\GetAudioNativeProjectSettingsResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function getSettings(
    string $projectId,
    ?array $options = null
  ): ?\ElevenLabs\Types\GetAudioNativeProjectSettingsResponseModel {
    $resolvedConfig = $this->getResolvedConfig($this->getSettingsConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/audio-native/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($projectId) .
          '/settings',
        method: HttpMethod::GET
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\GetAudioNativeProjectSettingsResponseModel::class
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
   * Updates content for the specific AudioNative Project.
   *
   * @param string $projectId The ID of the project to be used. You can use the [List projects](/docs/api-reference/studio/get-projects) endpoint to list all the available projects.
   * @param \ElevenLabs\AudioNative\Requests\BodyUpdateAudioNativeProjectContentV1AudioNativeProjectIdContentPost $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\AudioNativeEditContentResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function update(
    string $projectId,
    \ElevenLabs\AudioNative\Requests\BodyUpdateAudioNativeProjectContentV1AudioNativeProjectIdContentPost $request = new \ElevenLabs\AudioNative\Requests\BodyUpdateAudioNativeProjectContentV1AudioNativeProjectIdContentPost(),
    ?array $options = null
  ): ?\ElevenLabs\Types\AudioNativeEditContentResponseModel {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->updateConfig, $options);
    $response = $this->sendRequest(
      'post',
      '/v1/audio-native/' .
        \ElevenLabs\Core\Client\RawClient::encodePathParam($projectId) .
        '/content',
      ['multipart' => $request?->toMultipart()],
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\AudioNativeEditContentResponseModel::class
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
   * Finds an AudioNative project matching the provided URL, extracts content from the URL, updates the project content, and queues it for conversion and auto-publishing.
   *
   * @param \ElevenLabs\AudioNative\Requests\BodyUpdateAudioNativeContentFromUrlV1AudioNativeContentPost $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\AudioNativeEditContentResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function updateContentFromUrl(
    \ElevenLabs\AudioNative\Requests\BodyUpdateAudioNativeContentFromUrlV1AudioNativeContentPost $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\AudioNativeEditContentResponseModel {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->updateContentFromUrlConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/audio-native/content',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\AudioNativeEditContentResponseModel::class
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
