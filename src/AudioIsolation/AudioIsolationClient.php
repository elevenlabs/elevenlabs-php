<?php

declare(strict_types=1);

namespace ElevenLabs\AudioIsolation;

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
class AudioIsolationClient extends BaseService
{
  /** @var array|null Method-level configuration for convert */
  protected ?array $convertConfig = null;

  /** @var array|null Method-level configuration for list */
  protected ?array $listConfig = null;

  /** @var array|null Method-level configuration for delete */
  protected ?array $deleteConfig = null;

  /** @var array|null Method-level configuration for stream */
  protected ?array $streamConfig = null;

  /**
   * Set method-level configuration for convert.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setConvertConfig(array $config): static
  {
    $this->convertConfig = $config;
    return $this;
  }

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
   * Set method-level configuration for stream.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setStreamConfig(array $config): static
  {
    $this->streamConfig = $config;
    return $this;
  }

  /**
   * Removes background noise from audio.
   *
   * @param \ElevenLabs\AudioIsolation\Requests\BodyAudioIsolationV1AudioIsolationPost $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return \Psr\Http\Message\StreamInterface The response body, read as it arrives. getContents() or (string) returns the whole body. Call close() if you stop reading early.
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function convert(
    \ElevenLabs\AudioIsolation\Requests\BodyAudioIsolationV1AudioIsolationPost $request,
    ?array $options = null
  ): \Psr\Http\Message\StreamInterface {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->convertConfig, $options);
    $response = $this->sendBinaryStreamRequest(
      'post',
      '/v1/audio-isolation',
      ['multipart' => $request->toMultipart()],
      $resolvedConfig
    );
    $data = $response->getBody();

    return $data;
  }

  /**
   * Returns a list of all your audio isolation generations.
   *
   * @param \ElevenLabs\AudioIsolation\Requests\ListAudioIsolationRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\GetAudioIsolationHistoryResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function list(
    \ElevenLabs\AudioIsolation\Requests\ListAudioIsolationRequest $request = new \ElevenLabs\AudioIsolation\Requests\ListAudioIsolationRequest(),
    ?array $options = null
  ): ?\ElevenLabs\Types\GetAudioIsolationHistoryResponseModel {
    $pageSize = $request->pageSize;
    $page = $request->page;
    $search = $request->search;

    Validator::validateNumber($pageSize, 'page_size', min: 1, max: 1000);
    Validator::validateNumber($page, 'page', min: 1);

    $resolvedConfig = $this->getResolvedConfig($this->listConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/audio-isolation/history',
        method: HttpMethod::GET,
        query: [
          'page_size' => $pageSize,
          'page' => $page,
          'search' => $search
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\GetAudioIsolationHistoryResponseModel::class
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
   * Deletes a specific audio isolation history item and the associated media files.
   *
   * @param string $historyItemId Identifier of the audio isolation history item.
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return void
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function delete(string $historyItemId, ?array $options = null): void
  {
    $resolvedConfig = $this->getResolvedConfig($this->deleteConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/audio-isolation/history/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($historyItemId),
        method: HttpMethod::DELETE
      ),
      $resolvedConfig
    );
  }

  /**
   * Removes background noise from audio.
   *
   * @param \ElevenLabs\AudioIsolation\Requests\BodyAudioIsolationStreamV1AudioIsolationStreamPost $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return \Psr\Http\Message\StreamInterface The response body, read as it arrives. getContents() or (string) returns the whole body. Call close() if you stop reading early.
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function stream(
    \ElevenLabs\AudioIsolation\Requests\BodyAudioIsolationStreamV1AudioIsolationStreamPost $request,
    ?array $options = null
  ): \Psr\Http\Message\StreamInterface {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->streamConfig, $options);
    $response = $this->sendBinaryStreamRequest(
      'post',
      '/v1/audio-isolation/stream',
      ['multipart' => $request->toMultipart()],
      $resolvedConfig
    );
    $data = $response->getBody();

    return $data;
  }
}
