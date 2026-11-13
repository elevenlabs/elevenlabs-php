<?php

declare(strict_types=1);

namespace ElevenLabs\Music;

use ElevenLabs\Services\BaseService;
use ElevenLabs\Core\Json\JsonApiRequest;
use ElevenLabs\Core\Client\HttpMethod;
use ElevenLabs\Utils\Serializer;

use ElevenLabs\Core\Client\JsonStream;

use ElevenLabs\Music\CompositionPlan\CompositionPlanClient;
use ElevenLabs\Music\Finetunes\FinetunesClient;

/**
 * Service class containing API endpoint methods.
 *
 * This class extends the base service to provide typed methods for specific API operations.
 * Each method corresponds to an API endpoint and handles request serialization,
 * execution, and response deserialization.
 */
class MusicClient extends BaseService
{
  public CompositionPlanClient $compositionPlan;
  public FinetunesClient $finetunes;

  public function __construct(\ElevenLabs\Core\Client\RawClient $client, ?array $options = null)
  {
    parent::__construct($client, $options);
    $this->compositionPlan = new CompositionPlanClient($client, $options);
    $this->finetunes = new FinetunesClient($client, $options);
  }

  /** @var array|null Method-level configuration for videoToMusic */
  protected ?array $videoToMusicConfig = null;

  /** @var array|null Method-level configuration for compose */
  protected ?array $composeConfig = null;

  /** @var array|null Method-level configuration for composeDetailed */
  protected ?array $composeDetailedConfig = null;

  /** @var array|null Method-level configuration for composeDetailedStream */
  protected ?array $composeDetailedStreamConfig = null;

  /** @var array|null Method-level configuration for stream */
  protected ?array $streamConfig = null;

  /** @var array|null Method-level configuration for upload */
  protected ?array $uploadConfig = null;

  /** @var array|null Method-level configuration for separateStems */
  protected ?array $separateStemsConfig = null;

  /**
   * Set method-level configuration for videoToMusic.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setVideoToMusicConfig(array $config): static
  {
    $this->videoToMusicConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for compose.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setComposeConfig(array $config): static
  {
    $this->composeConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for composeDetailed.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setComposeDetailedConfig(array $config): static
  {
    $this->composeDetailedConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for composeDetailedStream.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setComposeDetailedStreamConfig(array $config): static
  {
    $this->composeDetailedStreamConfig = $config;
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
   * Set method-level configuration for upload.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setUploadConfig(array $config): static
  {
    $this->uploadConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for separateStems.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setSeparateStemsConfig(array $config): static
  {
    $this->separateStemsConfig = $config;
    return $this;
  }

  /**
   * Generate background music from one or more video files. Videos are combined in order. Optional description and style tags influence the generated music.
   *
   * @param \ElevenLabs\Music\Requests\BodyVideoToMusicV1MusicVideoToMusicPost $request Request parameters
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
  public function videoToMusic(
    \ElevenLabs\Music\Requests\BodyVideoToMusicV1MusicVideoToMusicPost $request,
    ?array $options = null
  ): \Psr\Http\Message\StreamInterface {
    $outputFormat = $request->outputFormat;
    $enableLogging = $request->enableLogging;

    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->videoToMusicConfig, $options);
    $response = $this->sendBinaryStreamRequest(
      'post',
      '/v1/music/video-to-music',
      [
        'multipart' => $request->toMultipart(),
        'query' => [
          'output_format' => $outputFormat,
          'enable_logging' => $enableLogging
        ]
      ],
      $resolvedConfig
    );
    $data = $response->getBody();

    return $data;
  }

  /**
   * Compose a song from a prompt or a composition plan.
   *
   * @param \ElevenLabs\Music\Requests\BodyComposeMusicV1MusicPost $request Request parameters
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
  public function compose(
    \ElevenLabs\Music\Requests\BodyComposeMusicV1MusicPost $request = new \ElevenLabs\Music\Requests\BodyComposeMusicV1MusicPost(),
    ?array $options = null
  ): \Psr\Http\Message\StreamInterface {
    $outputFormat = $request->outputFormat;
    $enableLogging = $request->enableLogging;

    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->composeConfig, $options);
    $response = $this->sendBinaryStreamJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/music',
        method: HttpMethod::POST,
        query: [
          'output_format' => $outputFormat,
          'enable_logging' => $enableLogging
        ],
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody();

    return $data;
  }

  /**
   * Compose a song from a prompt or a composition plan.
   *
   * @param \ElevenLabs\Music\Requests\BodyComposeMusicWithADetailedResponseV1MusicDetailedPost $request Request parameters
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
  public function composeDetailed(
    \ElevenLabs\Music\Requests\BodyComposeMusicWithADetailedResponseV1MusicDetailedPost $request = new \ElevenLabs\Music\Requests\BodyComposeMusicWithADetailedResponseV1MusicDetailedPost(),
    ?array $options = null
  ): \Psr\Http\Message\StreamInterface {
    $outputFormat = $request->outputFormat;
    $enableLogging = $request->enableLogging;

    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->composeDetailedConfig, $options);
    $response = $this->sendBinaryStreamJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/music/detailed',
        method: HttpMethod::POST,
        query: [
          'output_format' => $outputFormat,
          'enable_logging' => $enableLogging
        ],
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody();

    return $data;
  }

  /**
   * Stream a song and its detailed metadata using Server-Sent Events (SSE).
   *
   * @param \ElevenLabs\Music\Requests\BodyStreamComposedMusicWithADetailedResponseV1MusicDetailedStreamPost $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return JsonStream<string>
   */
  public function composeDetailedStream(
    \ElevenLabs\Music\Requests\BodyStreamComposedMusicWithADetailedResponseV1MusicDetailedStreamPost $request = new \ElevenLabs\Music\Requests\BodyStreamComposedMusicWithADetailedResponseV1MusicDetailedStreamPost(),
    ?array $options = null
  ): JsonStream {
    $outputFormat = $request->outputFormat;
    $enableLogging = $request->enableLogging;

    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->composeDetailedStreamConfig, $options);
    return new JsonStream(
      $this->sendStreamingRequest(
        'post',
        '/v1/music/detailed/stream',
        [
          'json' => $request,
          'query' => [
            'output_format' => $outputFormat,
            'enable_logging' => $enableLogging
          ]
        ],
        $resolvedConfig,
        false
      ),
      function (string $data) {
        return $data;
      }
    );
  }

  /**
   * Stream a composed song from a prompt or a composition plan.
   *
   * @param \ElevenLabs\Music\Requests\BodyStreamComposedMusicV1MusicStreamPost $request Request parameters
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
    \ElevenLabs\Music\Requests\BodyStreamComposedMusicV1MusicStreamPost $request = new \ElevenLabs\Music\Requests\BodyStreamComposedMusicV1MusicStreamPost(),
    ?array $options = null
  ): \Psr\Http\Message\StreamInterface {
    $outputFormat = $request->outputFormat;
    $enableLogging = $request->enableLogging;

    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->streamConfig, $options);
    $response = $this->sendBinaryStreamJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/music/stream',
        method: HttpMethod::POST,
        query: [
          'output_format' => $outputFormat,
          'enable_logging' => $enableLogging
        ],
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody();

    return $data;
  }

  /**
   * Upload a music file to be later used for inpainting. Price for uploading is the same as the one for song generation. All uploaded content gets inspected for copyright infringement. If copyrighted content is detected, half of the request cost is still charged.
   *
   * @param \ElevenLabs\Music\Requests\BodyUploadMusicV1MusicUploadPost $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\MusicUploadResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function upload(
    \ElevenLabs\Music\Requests\BodyUploadMusicV1MusicUploadPost $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\MusicUploadResponse {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->uploadConfig, $options);
    $response = $this->sendRequest(
      'post',
      '/v1/music/upload',
      ['multipart' => $request->toMultipart()],
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\MusicUploadResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Separate an audio file into individual stems. This endpoint might have high latency, depending on the length of the audio file.
   *
   * @param \ElevenLabs\Music\Requests\BodyStemSeparationV1MusicStemSeparationPost $request Request parameters
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
  public function separateStems(
    \ElevenLabs\Music\Requests\BodyStemSeparationV1MusicStemSeparationPost $request,
    ?array $options = null
  ): \Psr\Http\Message\StreamInterface {
    $outputFormat = $request->outputFormat;
    $enableLogging = $request->enableLogging;

    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->separateStemsConfig, $options);
    $response = $this->sendBinaryStreamRequest(
      'post',
      '/v1/music/stem-separation',
      [
        'multipart' => $request->toMultipart(),
        'query' => [
          'output_format' => $outputFormat,
          'enable_logging' => $enableLogging
        ]
      ],
      $resolvedConfig
    );
    $data = $response->getBody();

    return $data;
  }
}
