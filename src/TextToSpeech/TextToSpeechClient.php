<?php

declare(strict_types=1);

namespace ElevenLabs\TextToSpeech;

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
class TextToSpeechClient extends BaseService
{
  /** @var array|null Method-level configuration for convert */
  protected ?array $convertConfig = null;

  /** @var array|null Method-level configuration for convertWithTimestamps */
  protected ?array $convertWithTimestampsConfig = null;

  /** @var array|null Method-level configuration for stream */
  protected ?array $streamConfig = null;

  /** @var array|null Method-level configuration for streamWithTimestamps */
  protected ?array $streamWithTimestampsConfig = null;

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
   * Converts text into speech using a voice of your choice and returns audio.
   *
   * @param string $voiceId ID of the voice to be used. Use the [Get voices](/docs/api-reference/voices/search) endpoint list all the available voices.
   * @param \ElevenLabs\TextToSpeech\Requests\BodyTextToSpeechFull $request Request parameters
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
    string $voiceId,
    \ElevenLabs\TextToSpeech\Requests\BodyTextToSpeechFull $request,
    ?array $options = null
  ): \Psr\Http\Message\StreamInterface {
    $enableLogging = $request->enableLogging;
    $optimizeStreamingLatency = $request->optimizeStreamingLatency;
    $outputFormat = $request->outputFormat;

    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->convertConfig, $options);
    $response = $this->sendBinaryStreamJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/text-to-speech/' . \ElevenLabs\Core\Client\RawClient::encodePathParam($voiceId),
        method: HttpMethod::POST,
        query: [
          'enable_logging' => $enableLogging,
          'optimize_streaming_latency' => $optimizeStreamingLatency,
          'output_format' => $outputFormat
        ],
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody();

    return $data;
  }

  /**
   * Generate speech from text with precise character-level timing information for audio-text synchronization.
   *
   * @param string $voiceId Voice ID to be used, you can use https://api.elevenlabs.io/v1/voices to list all the available voices.
   * @param \ElevenLabs\TextToSpeech\Requests\BodyTextToSpeechFullWithTimestamps $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\AudioWithTimestampsResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function convertWithTimestamps(
    string $voiceId,
    \ElevenLabs\TextToSpeech\Requests\BodyTextToSpeechFullWithTimestamps $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\AudioWithTimestampsResponse {
    $enableLogging = $request->enableLogging;
    $optimizeStreamingLatency = $request->optimizeStreamingLatency;
    $outputFormat = $request->outputFormat;

    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->convertWithTimestampsConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/text-to-speech/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($voiceId) .
          '/with-timestamps',
        method: HttpMethod::POST,
        query: [
          'enable_logging' => $enableLogging,
          'optimize_streaming_latency' => $optimizeStreamingLatency,
          'output_format' => $outputFormat
        ],
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\AudioWithTimestampsResponse::class
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
   * Converts text into speech using a voice of your choice and returns audio as an audio stream.
   *
   * @param string $voiceId ID of the voice to be used. Use the [Get voices](/docs/api-reference/voices/search) endpoint list all the available voices.
   * @param \ElevenLabs\TextToSpeech\Requests\StreamTextToSpeechRequest $request Request parameters
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
    string $voiceId,
    \ElevenLabs\TextToSpeech\Requests\StreamTextToSpeechRequest $request,
    ?array $options = null
  ): \Psr\Http\Message\StreamInterface {
    $enableLogging = $request->enableLogging;
    $optimizeStreamingLatency = $request->optimizeStreamingLatency;
    $outputFormat = $request->outputFormat;

    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->streamConfig, $options);
    $response = $this->sendBinaryStreamJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/text-to-speech/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($voiceId) .
          '/stream',
        method: HttpMethod::POST,
        query: [
          'enable_logging' => $enableLogging,
          'optimize_streaming_latency' => $optimizeStreamingLatency,
          'output_format' => $outputFormat
        ],
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody();

    return $data;
  }

  /**
   * Converts text into speech using a voice of your choice and returns a stream of JSONs containing audio as a base64 encoded string together with information on when which character was spoken.
   *
   * @param string $voiceId ID of the voice to be used. Use the [Get voices](/docs/api-reference/voices/search) endpoint list all the available voices.
   * @param \ElevenLabs\TextToSpeech\Requests\StreamTextToSpeechWithTimestampsRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return JsonStream<\ElevenLabs\Types\StreamingAudioChunkWithTimestampsResponse>
   */
  public function streamWithTimestamps(
    string $voiceId,
    \ElevenLabs\TextToSpeech\Requests\StreamTextToSpeechWithTimestampsRequest $request,
    ?array $options = null
  ): JsonStream {
    $enableLogging = $request->enableLogging;
    $optimizeStreamingLatency = $request->optimizeStreamingLatency;
    $outputFormat = $request->outputFormat;

    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->streamWithTimestampsConfig, $options);
    return new JsonStream(
      $this->sendStreamingRequest(
        'post',
        '/v1/text-to-speech/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($voiceId) .
          '/stream/with-timestamps',
        [
          'json' => $request,
          'query' => [
            'enable_logging' => $enableLogging,
            'optimize_streaming_latency' => $optimizeStreamingLatency,
            'output_format' => $outputFormat
          ]
        ],
        $resolvedConfig,
        false
      ),
      function (string $data) {
        return Serializer::deserialize(
          $data,
          \ElevenLabs\Types\StreamingAudioChunkWithTimestampsResponse::class
        );
      }
    );
  }

  /**
   * Opens a WebSocket connection to `/v1/text-to-speech/{voice_id}/stream-input`.
   *
   * Iterating the socket blocks until the server closes it, so call this from a CLI worker or
   * queue job rather than a web request.
   */
  public function realtime(
    string $voiceId,
    \ElevenLabs\TextToSpeech\Requests\V1TextToSpeechVoiceIdStreamInputRequest $request = new \ElevenLabs\TextToSpeech\Requests\V1TextToSpeechVoiceIdStreamInputRequest(),
    ?array $options = null
  ): V1TextToSpeechVoiceIdStreamInputSocket {
    $authorization = $request->authorization;
    $singleUseToken = $request->singleUseToken;
    $modelId = $request->modelId;
    $languageCode = $request->languageCode;
    $enableLogging = $request->enableLogging;
    $outputFormat = $request->outputFormat;
    $inactivityTimeout = $request->inactivityTimeout;
    $syncAlignment = $request->syncAlignment;
    $autoMode = $request->autoMode;
    $applyTextNormalization = $request->applyTextNormalization;
    $seed = $request->seed;
    $enableSsmlParsing = $request->enableSsmlParsing;
    $resolvedConfig = $this->getResolvedConfig(null, $options);
    return new V1TextToSpeechVoiceIdStreamInputSocket(
      \ElevenLabs\Core\WebSocket\WebSocketConnector::connect(
        $this->getBaseUrl($resolvedConfig) .
          '/v1/text-to-speech/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($voiceId) .
          '/stream-input',
        $this->withHandshakeHeaders(
          [
            'query' => [
              'authorization' => $authorization,
              'single_use_token' => $singleUseToken,
              'model_id' => $modelId,
              'language_code' => $languageCode,
              'enable_logging' => $enableLogging,
              'output_format' => $outputFormat,
              'inactivity_timeout' => $inactivityTimeout,
              'sync_alignment' => $syncAlignment,
              'auto_mode' => $autoMode,
              'apply_text_normalization' => $applyTextNormalization,
              'seed' => $seed,
              'enable_ssml_parsing' => $enableSsmlParsing
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
