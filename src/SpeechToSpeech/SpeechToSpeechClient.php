<?php

declare(strict_types=1);

namespace ElevenLabs\SpeechToSpeech;

use ElevenLabs\Services\BaseService;
use ElevenLabs\Utils\Serializer;

/**
 * Service class containing API endpoint methods.
 *
 * This class extends the base service to provide typed methods for specific API operations.
 * Each method corresponds to an API endpoint and handles request serialization,
 * execution, and response deserialization.
 */
class SpeechToSpeechClient extends BaseService
{
  /** @var array|null Method-level configuration for convert */
  protected ?array $convertConfig = null;

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
   * Transform audio from one voice to another. Maintain full control over emotion, timing and delivery.
   *
   * @param string $voiceId ID of the voice to be used. Use the [Get voices](/docs/api-reference/voices/search) endpoint list all the available voices.
   * @param \ElevenLabs\SpeechToSpeech\Requests\BodyVoiceChangerV1VoiceChangerVoiceIdPost $request Request parameters
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
    \ElevenLabs\SpeechToSpeech\Requests\BodyVoiceChangerV1VoiceChangerVoiceIdPost $request,
    ?array $options = null
  ): \Psr\Http\Message\StreamInterface {
    $enableLogging = $request->enableLogging;
    $optimizeStreamingLatency = $request->optimizeStreamingLatency;
    $outputFormat = $request->outputFormat;

    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->convertConfig, $options);
    $response = $this->sendBinaryStreamRequest(
      'post',
      '/v1/voice-changer/' . \ElevenLabs\Core\Client\RawClient::encodePathParam($voiceId),
      [
        'multipart' => $request?->toMultipart(),
        'query' => [
          'enable_logging' => $enableLogging,
          'optimize_streaming_latency' => $optimizeStreamingLatency,
          'output_format' => $outputFormat
        ]
      ],
      $resolvedConfig
    );
    $data = $response->getBody();

    return $data;
  }

  /**
   * Stream audio from one voice to another. Maintain full control over emotion, timing and delivery.
   *
   * @param string $voiceId ID of the voice to be used. Use the [Get voices](/docs/api-reference/voices/search) endpoint list all the available voices.
   * @param \ElevenLabs\SpeechToSpeech\Requests\BodyVoiceChangerStreamingV1VoiceChangerVoiceIdStreamPost $request Request parameters
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
    \ElevenLabs\SpeechToSpeech\Requests\BodyVoiceChangerStreamingV1VoiceChangerVoiceIdStreamPost $request,
    ?array $options = null
  ): \Psr\Http\Message\StreamInterface {
    $enableLogging = $request->enableLogging;
    $optimizeStreamingLatency = $request->optimizeStreamingLatency;
    $outputFormat = $request->outputFormat;

    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->streamConfig, $options);
    $response = $this->sendBinaryStreamRequest(
      'post',
      '/v1/voice-changer/' .
        \ElevenLabs\Core\Client\RawClient::encodePathParam($voiceId) .
        '/stream',
      [
        'multipart' => $request?->toMultipart(),
        'query' => [
          'enable_logging' => $enableLogging,
          'optimize_streaming_latency' => $optimizeStreamingLatency,
          'output_format' => $outputFormat
        ]
      ],
      $resolvedConfig
    );
    $data = $response->getBody();

    return $data;
  }
}
