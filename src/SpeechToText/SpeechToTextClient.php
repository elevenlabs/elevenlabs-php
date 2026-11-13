<?php

declare(strict_types=1);

namespace ElevenLabs\SpeechToText;

use ElevenLabs\Services\BaseService;
use ElevenLabs\Utils\Serializer;

use ElevenLabs\SpeechToText\Transcripts\TranscriptsClient;

/**
 * Service class containing API endpoint methods.
 *
 * This class extends the base service to provide typed methods for specific API operations.
 * Each method corresponds to an API endpoint and handles request serialization,
 * execution, and response deserialization.
 */
class SpeechToTextClient extends BaseService
{
  public TranscriptsClient $transcripts;

  public function __construct(\ElevenLabs\Core\Client\RawClient $client, ?array $options = null)
  {
    parent::__construct($client, $options);
    $this->transcripts = new TranscriptsClient($client, $options);
  }

  /** @var array|null Method-level configuration for convert */
  protected ?array $convertConfig = null;

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
   * Transcribe an audio or video file. If webhook is set to true, the request will be processed asynchronously and results sent to configured webhooks. When use_multi_channel is true and the provided audio has multiple channels, a 'transcripts' object with separate transcripts for each channel is returned; set multichannel_output_style='combined' to instead receive a single transcript with all channels merged and sorted by time. Otherwise, returns a single transcript. The optional webhook_metadata parameter allows you to attach custom data that will be included in webhook responses for request correlation and tracking.
   *
   * @param \ElevenLabs\SpeechToText\Requests\BodySpeechToTextV1SpeechToTextPost $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return \ElevenLabs\Types\SpeechToTextChunkResponseModel|\ElevenLabs\Types\MultichannelSpeechToTextResponseModel|\ElevenLabs\Types\SpeechToTextWebhookResponseModel|null
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function convert(
    \ElevenLabs\SpeechToText\Requests\BodySpeechToTextV1SpeechToTextPost $request,
    ?array $options = null
  ): \ElevenLabs\Types\SpeechToTextChunkResponseModel|\ElevenLabs\Types\MultichannelSpeechToTextResponseModel|\ElevenLabs\Types\SpeechToTextWebhookResponseModel|null {
    $token = $request->token;
    $enableLogging = $request->enableLogging;

    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->convertConfig, $options);
    $response = $this->sendRequest(
      'post',
      '/v1/speech-to-text',
      [
        'multipart' => $request->toMultipart(),
        'query' => [
          'token' => $token,
          'enable_logging' => $enableLogging
        ]
      ],
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = \ElevenLabs\Core\Json\JsonDeserializer::deserializeUnion(
        $this->decodeJson($data),
        new \ElevenLabs\Core\Types\Union(
          \ElevenLabs\Types\SpeechToTextChunkResponseModel::class,
          \ElevenLabs\Types\MultichannelSpeechToTextResponseModel::class,
          \ElevenLabs\Types\SpeechToTextWebhookResponseModel::class
        )
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
   * Opens a WebSocket connection to `/v1/speech-to-text/realtime`.
   *
   * Iterating the socket blocks until the server closes it, so call this from a CLI worker or
   * queue job rather than a web request.
   */
  public function realtime(
    \ElevenLabs\SpeechToText\Requests\V1SpeechToTextRealtimeRequest $request,
    ?array $options = null
  ): V1SpeechToTextRealtimeSocket {
    $modelId = $request->modelId;
    $token = $request->token;
    $audioFormat = $request->audioFormat;
    $languageCode = $request->languageCode;
    $secondaryLanguages = $request->secondaryLanguages;
    $commitStrategy = $request->commitStrategy;
    $vadThreshold = $request->vadThreshold;
    $vadSilenceThresholdSecs = $request->vadSilenceThresholdSecs;
    $minSpeechDurationMs = $request->minSpeechDurationMs;
    $minSilenceDurationMs = $request->minSilenceDurationMs;
    $includeTimestamps = $request->includeTimestamps;
    $includeLanguageDetection = $request->includeLanguageDetection;
    $keyterms = $request->keyterms;
    $noVerbatim = $request->noVerbatim;
    $multilangMode = $request->multilangMode;
    $diarize = $request->diarize;
    $entityDetection = $request->entityDetection;
    $entityRedaction = $request->entityRedaction;
    $entityRedactionMode = $request->entityRedactionMode;
    $transcriptEdit = $request->transcriptEdit;
    $filterBackgroundAudio = $request->filterBackgroundAudio;
    $keepaliveIntervalMs = $request->keepaliveIntervalMs;
    $enableLogging = $request->enableLogging;
    $resolvedConfig = $this->getResolvedConfig(null, $options);
    return new V1SpeechToTextRealtimeSocket(
      \ElevenLabs\Core\WebSocket\WebSocketConnector::connect(
        $this->getBaseUrl($resolvedConfig) . '/v1/speech-to-text/realtime',
        $this->withHandshakeHeaders(
          [
            'query' => [
              'model_id' => $modelId,
              'token' => $token,
              'audio_format' => $audioFormat,
              'language_code' => $languageCode,
              'secondary_languages' => $secondaryLanguages,
              'commit_strategy' => $commitStrategy,
              'vad_threshold' => $vadThreshold,
              'vad_silence_threshold_secs' => $vadSilenceThresholdSecs,
              'min_speech_duration_ms' => $minSpeechDurationMs,
              'min_silence_duration_ms' => $minSilenceDurationMs,
              'include_timestamps' => $includeTimestamps,
              'include_language_detection' => $includeLanguageDetection,
              'keyterms' => $keyterms,
              'no_verbatim' => $noVerbatim,
              'multilang_mode' => $multilangMode,
              'diarize' => $diarize,
              'entity_detection' => $entityDetection,
              'entity_redaction' => $entityRedaction,
              'entity_redaction_mode' => $entityRedactionMode,
              'transcript_edit' => $transcriptEdit,
              'filter_background_audio' => $filterBackgroundAudio,
              'keepalive_interval_ms' => $keepaliveIntervalMs,
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
