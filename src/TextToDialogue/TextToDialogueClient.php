<?php

declare(strict_types=1);

namespace ElevenLabs\TextToDialogue;

use ElevenLabs\Services\BaseService;
use ElevenLabs\Core\Json\JsonApiRequest;
use ElevenLabs\Core\Client\HttpMethod;
use ElevenLabs\Utils\Serializer;

use ElevenLabs\Core\Client\JsonStream;

/**
 * Service class containing API endpoint methods.
 *
 * This class extends the base service to provide typed methods for specific API operations.
 * Each method corresponds to an API endpoint and handles request serialization,
 * execution, and response deserialization.
 */
class TextToDialogueClient extends BaseService
{
  /** @var array|null Method-level configuration for convert */
  protected ?array $convertConfig = null;

  /** @var array|null Method-level configuration for stream */
  protected ?array $streamConfig = null;

  /** @var array|null Method-level configuration for streamWithTimestamps */
  protected ?array $streamWithTimestampsConfig = null;

  /** @var array|null Method-level configuration for convertWithTimestamps */
  protected ?array $convertWithTimestampsConfig = null;

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
   * Set method-level configuration for streamWithTimestamps.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setStreamWithTimestampsConfig(array $config): static
  {
    $this->streamWithTimestampsConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for convertWithTimestamps.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setConvertWithTimestampsConfig(array $config): static
  {
    $this->convertWithTimestampsConfig = $config;
    return $this;
  }

  /**
   * Converts a list of text and voice ID pairs into speech (dialogue) and returns audio.
   *
   * @param \ElevenLabs\TextToDialogue\Requests\BodyTextToDialogueMultiVoiceV1TextToDialoguePost $request Request parameters
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
    \ElevenLabs\TextToDialogue\Requests\BodyTextToDialogueMultiVoiceV1TextToDialoguePost $request,
    ?array $options = null
  ): \Psr\Http\Message\StreamInterface {
    $outputFormat = $request->outputFormat;
    $enableLogging = $request->enableLogging;

    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->convertConfig, $options);
    $response = $this->sendBinaryStreamJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/text-to-dialogue',
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
   * Converts a list of text and voice ID pairs into speech (dialogue) and returns an audio stream.
   *
   * @param \ElevenLabs\TextToDialogue\Requests\BodyTextToDialogueMultiVoiceStreamingV1TextToDialogueStreamPost $request Request parameters
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
    \ElevenLabs\TextToDialogue\Requests\BodyTextToDialogueMultiVoiceStreamingV1TextToDialogueStreamPost $request,
    ?array $options = null
  ): \Psr\Http\Message\StreamInterface {
    $outputFormat = $request->outputFormat;
    $enableLogging = $request->enableLogging;

    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->streamConfig, $options);
    $response = $this->sendBinaryStreamJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/text-to-dialogue/stream',
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
   * Converts a list of text and voice ID pairs into speech (dialogue) and returns a stream of JSON blobs containing audio as a base64 encoded string and timestamps
   *
   * @param \ElevenLabs\TextToDialogue\Requests\BodyTextToDialogueStreamWithTimestamps $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return JsonStream<\ElevenLabs\Types\StreamingAudioChunkWithTimestampsAndVoiceSegmentsResponseModel>
   */
  public function streamWithTimestamps(
    \ElevenLabs\TextToDialogue\Requests\BodyTextToDialogueStreamWithTimestamps $request,
    ?array $options = null
  ): JsonStream {
    $outputFormat = $request->outputFormat;
    $enableLogging = $request->enableLogging;

    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->streamWithTimestampsConfig, $options);
    return new JsonStream(
      $this->sendStreamingRequest(
        'post',
        '/v1/text-to-dialogue/stream/with-timestamps',
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
        return Serializer::deserialize(
          $data,
          \ElevenLabs\Types\StreamingAudioChunkWithTimestampsAndVoiceSegmentsResponseModel::class
        );
      }
    );
  }

  /**
   * Generate dialogue from text with precise character-level timing information for audio-text synchronization.
   *
   * @param \ElevenLabs\TextToDialogue\Requests\BodyTextToDialogueFullWithTimestamps $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\AudioWithTimestampsAndVoiceSegmentsResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function convertWithTimestamps(
    \ElevenLabs\TextToDialogue\Requests\BodyTextToDialogueFullWithTimestamps $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\AudioWithTimestampsAndVoiceSegmentsResponseModel {
    $outputFormat = $request->outputFormat;
    $enableLogging = $request->enableLogging;

    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->convertWithTimestampsConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/text-to-dialogue/with-timestamps',
        method: HttpMethod::POST,
        query: [
          'output_format' => $outputFormat,
          'enable_logging' => $enableLogging
        ],
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\AudioWithTimestampsAndVoiceSegmentsResponseModel::class
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
   * Opens a WebSocket connection to `/v1/text-to-dialogue/stream-input`.
   *
   * Iterating the socket blocks until the server closes it, so call this from a CLI worker or
   * queue job rather than a web request.
   */
  public function realtime(
    \ElevenLabs\TextToDialogue\Requests\V1TextToDialogueStreamInputRequest $request = new \ElevenLabs\TextToDialogue\Requests\V1TextToDialogueStreamInputRequest(),
    ?array $options = null
  ): V1TextToDialogueStreamInputSocket {
    $modelId = $request->modelId;
    $outputFormat = $request->outputFormat;
    $languageCode = $request->languageCode;
    $syncAlignment = $request->syncAlignment;
    $applyTextNormalization = $request->applyTextNormalization;
    $seed = $request->seed;
    $enableLogging = $request->enableLogging;
    $resolvedConfig = $this->getResolvedConfig(null, $options);
    return new V1TextToDialogueStreamInputSocket(
      \ElevenLabs\Core\WebSocket\WebSocketConnector::connect(
        $this->getBaseUrl($resolvedConfig) . '/v1/text-to-dialogue/stream-input',
        $this->withHandshakeHeaders(
          [
            'query' => [
              'model_id' => $modelId,
              'output_format' => $outputFormat,
              'language_code' => $languageCode,
              'sync_alignment' => $syncAlignment,
              'apply_text_normalization' => $applyTextNormalization,
              'seed' => $seed,
              'enable_logging' => $enableLogging
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
