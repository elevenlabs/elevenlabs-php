<?php

declare(strict_types=1);

namespace ElevenLabs\History;

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
class HistoryClient extends BaseService
{
  /** @var array|null Method-level configuration for list */
  protected ?array $listConfig = null;

  /** @var array|null Method-level configuration for get */
  protected ?array $getConfig = null;

  /** @var array|null Method-level configuration for delete */
  protected ?array $deleteConfig = null;

  /** @var array|null Method-level configuration for getAudio */
  protected ?array $getAudioConfig = null;

  /** @var array|null Method-level configuration for download */
  protected ?array $downloadConfig = null;

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
   * Set method-level configuration for getAudio.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setGetAudioConfig(array $config): static
  {
    $this->getAudioConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for download.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setDownloadConfig(array $config): static
  {
    $this->downloadConfig = $config;
    return $this;
  }

  /**
   * Returns a list of your generated audio (e.g. text to speech, speech to speech, Studio, dubbing). Music and SFX generations are not included and cannot currently be retrieved via the API.
   *
   * @param \ElevenLabs\History\Requests\ListHistoryRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\GetSpeechHistoryResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function list(
    \ElevenLabs\History\Requests\ListHistoryRequest $request = new \ElevenLabs\History\Requests\ListHistoryRequest(),
    ?array $options = null
  ): ?\ElevenLabs\Types\GetSpeechHistoryResponse {
    $pageSize = $request->pageSize;
    $startAfterHistoryItemId = $request->startAfterHistoryItemId;
    $voiceId = $request->voiceId;
    $modelId = $request->modelId;
    $dateBeforeUnix = $request->dateBeforeUnix;
    $dateAfterUnix = $request->dateAfterUnix;
    $sortDirection = $request->sortDirection;
    $search = $request->search;
    $source = $request->source;

    $resolvedConfig = $this->getResolvedConfig($this->listConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/history',
        method: HttpMethod::GET,
        query: [
          'page_size' => $pageSize,
          'start_after_history_item_id' => $startAfterHistoryItemId,
          'voice_id' => $voiceId,
          'model_id' => $modelId,
          'date_before_unix' => $dateBeforeUnix,
          'date_after_unix' => $dateAfterUnix,
          'sort_direction' => $sortDirection,
          'search' => $search,
          'source' => $source
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\GetSpeechHistoryResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Retrieves a history item.
   *
   * @param string $historyItemId ID of the history item to be used. You can use the [Get generated items](/docs/api-reference/history/list) endpoint to retrieve a list of history items.
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\SpeechHistoryItemResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function get(
    string $historyItemId,
    ?array $options = null
  ): ?\ElevenLabs\Types\SpeechHistoryItemResponse {
    $resolvedConfig = $this->getResolvedConfig($this->getConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/history/' . \ElevenLabs\Core\Client\RawClient::encodePathParam($historyItemId),
        method: HttpMethod::GET
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\SpeechHistoryItemResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Delete a history item by its ID
   *
   * @param string $historyItemId ID of the history item to be used. You can use the [Get generated items](/docs/api-reference/history/list) endpoint to retrieve a list of history items.
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\DeleteHistoryItemResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function delete(
    string $historyItemId,
    ?array $options = null
  ): ?\ElevenLabs\Types\DeleteHistoryItemResponse {
    $resolvedConfig = $this->getResolvedConfig($this->deleteConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/history/' . \ElevenLabs\Core\Client\RawClient::encodePathParam($historyItemId),
        method: HttpMethod::DELETE
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\DeleteHistoryItemResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Returns the audio of an history item.
   *
   * @param string $historyItemId ID of the history item to be used. You can use the [Get generated items](/docs/api-reference/history/list) endpoint to retrieve a list of history items.
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
  public function getAudio(
    string $historyItemId,
    ?array $options = null
  ): \Psr\Http\Message\StreamInterface {
    $resolvedConfig = $this->getResolvedConfig($this->getAudioConfig, $options);
    $response = $this->sendBinaryStreamJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/history/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($historyItemId) .
          '/audio',
        method: HttpMethod::GET
      ),
      $resolvedConfig
    );
    $data = $response->getBody();

    return $data;
  }

  /**
   * Download one or more history items. If one history item ID is provided, we will return a single audio file. If more than one history item IDs are provided, we will provide the history items packed into a .zip file.
   *
   * @param \ElevenLabs\History\Requests\DownloadHistoryRequest $request Request body
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
  public function download(
    \ElevenLabs\History\Requests\DownloadHistoryRequest $request,
    ?array $options = null
  ): \Psr\Http\Message\StreamInterface {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->downloadConfig, $options);
    $response = $this->sendBinaryStreamJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/history/download',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody();

    return $data;
  }
}
