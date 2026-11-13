<?php

declare(strict_types=1);

namespace ElevenLabs\Dubbing;

use ElevenLabs\Services\BaseService;
use ElevenLabs\Core\Json\JsonApiRequest;
use ElevenLabs\Core\Client\HttpMethod;
use ElevenLabs\Utils\Serializer;
use ElevenLabs\Utils\Validator;

use ElevenLabs\Dubbing\Audio\AudioClient;
use ElevenLabs\Dubbing\Project\ProjectClient;
use ElevenLabs\Dubbing\Transcripts\TranscriptsClient;

/**
 * Service class containing API endpoint methods.
 *
 * This class extends the base service to provide typed methods for specific API operations.
 * Each method corresponds to an API endpoint and handles request serialization,
 * execution, and response deserialization.
 */
class DubbingClient extends BaseService
{
  public AudioClient $audio;
  public ProjectClient $project;
  public TranscriptsClient $transcripts;

  public function __construct(\ElevenLabs\Core\Client\RawClient $client, ?array $options = null)
  {
    parent::__construct($client, $options);
    $this->audio = new AudioClient($client, $options);
    $this->project = new ProjectClient($client, $options);
    $this->transcripts = new TranscriptsClient($client, $options);
  }

  /** @var array|null Method-level configuration for list */
  protected ?array $listConfig = null;

  /** @var array|null Method-level configuration for create */
  protected ?array $createConfig = null;

  /** @var array|null Method-level configuration for get */
  protected ?array $getConfig = null;

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
   * List the dubs you have access to.
   *
   * @param \ElevenLabs\Dubbing\Requests\ListDubbingRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\DubbingMetadataPageResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function list(
    \ElevenLabs\Dubbing\Requests\ListDubbingRequest $request = new \ElevenLabs\Dubbing\Requests\ListDubbingRequest(),
    ?array $options = null
  ): ?\ElevenLabs\Types\DubbingMetadataPageResponseModel {
    $cursor = $request->cursor;
    $pageSize = $request->pageSize;
    $dubbingStatus = $request->dubbingStatus;
    $dubbingStatuses = $request->dubbingStatuses;
    $dubbingModels = $request->dubbingModels;
    $targetLanguageCodes = $request->targetLanguageCodes;
    $creationSources = $request->creationSources;
    $filterByCreator = $request->filterByCreator;
    $orderBy = $request->orderBy;
    $orderDirection = $request->orderDirection;

    Validator::validateNumber($pageSize, 'page_size', min: 1, max: 200);

    $resolvedConfig = $this->getResolvedConfig($this->listConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/dubbing',
        method: HttpMethod::GET,
        query: [
          'cursor' => $cursor,
          'page_size' => $pageSize,
          'dubbing_status' => $dubbingStatus,
          'dubbing_statuses' => $dubbingStatuses,
          'dubbing_models' => $dubbingModels,
          'target_language_codes' => $targetLanguageCodes,
          'creation_sources' => $creationSources,
          'filter_by_creator' => $filterByCreator,
          'order_by' => $orderBy,
          'order_direction' => $orderDirection
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\DubbingMetadataPageResponseModel::class
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
   * Dubs a provided audio or video file into given language.
   *
   * @param \ElevenLabs\Dubbing\Requests\BodyDubAVideoOrAnAudioFileV1DubbingPost $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\DoDubbingResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function create(
    \ElevenLabs\Dubbing\Requests\BodyDubAVideoOrAnAudioFileV1DubbingPost $request = new \ElevenLabs\Dubbing\Requests\BodyDubAVideoOrAnAudioFileV1DubbingPost(),
    ?array $options = null
  ): ?\ElevenLabs\Types\DoDubbingResponse {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->createConfig, $options);
    $response = $this->sendRequest(
      'post',
      '/v1/dubbing',
      ['multipart' => $request?->toMultipart()],
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\DoDubbingResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Returns metadata about a dubbing project, including whether it's still in progress or not
   *
   * @param string $dubbingId ID of the dubbing project.
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\DubbingMetadataResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function get(
    string $dubbingId,
    ?array $options = null
  ): ?\ElevenLabs\Types\DubbingMetadataResponse {
    $resolvedConfig = $this->getResolvedConfig($this->getConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/dubbing/' . \ElevenLabs\Core\Client\RawClient::encodePathParam($dubbingId),
        method: HttpMethod::GET
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\DubbingMetadataResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Deletes a dubbing project.
   *
   * @param string $dubbingId ID of the dubbing project.
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\DeleteDubbingResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function delete(
    string $dubbingId,
    ?array $options = null
  ): ?\ElevenLabs\Types\DeleteDubbingResponseModel {
    $resolvedConfig = $this->getResolvedConfig($this->deleteConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/dubbing/' . \ElevenLabs\Core\Client\RawClient::encodePathParam($dubbingId),
        method: HttpMethod::DELETE
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\DeleteDubbingResponseModel::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Opens a WebSocket connection to `/v1/dubbing/live`.
   *
   * Iterating the socket blocks until the server closes it, so call this from a CLI worker or
   * queue job rather than a web request.
   */
  public function live(
    \ElevenLabs\Dubbing\Requests\V1DubbingLiveRequest $request,
    ?array $options = null
  ): V1DubbingLiveSocket {
    $authorization = $request->authorization;
    $targetLanguage = $request->targetLanguage;
    $sourceLanguage = $request->sourceLanguage;
    $maxLagS = $request->maxLagS;
    $cloningStrength = $request->cloningStrength;
    $inputFormat = $request->inputFormat;
    $inputNumChannels = $request->inputNumChannels;
    $outputFormat = $request->outputFormat;
    $clientSessionId = $request->clientSessionId;
    $resolvedConfig = $this->getResolvedConfig(null, $options);
    return new V1DubbingLiveSocket(
      \ElevenLabs\Core\WebSocket\WebSocketConnector::connect(
        $this->getBaseUrl($resolvedConfig) . '/v1/dubbing/live',
        $this->withHandshakeHeaders(
          [
            'query' => [
              'target_language' => $targetLanguage,
              'source_language' => $sourceLanguage,
              'authorization' => $authorization,
              'max_lag_s' => $maxLagS,
              'cloning_strength' => $cloningStrength,
              'input_format' => $inputFormat,
              'input_num_channels' => $inputNumChannels,
              'output_format' => $outputFormat,
              'client_session_id' => $clientSessionId
            ]
          ],
          $resolvedConfig
        ),
        $this->options,
        $resolvedConfig
      )
    );
  }
}
