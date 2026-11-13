<?php

declare(strict_types=1);

namespace ElevenLabs\TextToSpeechMultiContext;

use ElevenLabs\Services\BaseService;
use ElevenLabs\Utils\Serializer;

/**
 * Service class containing API endpoint methods.
 *
 * This class extends the base service to provide typed methods for specific API operations.
 * Each method corresponds to an API endpoint and handles request serialization,
 * execution, and response deserialization.
 */
class TextToSpeechMultiContextClient extends BaseService
{
  /**
   * Opens a WebSocket connection to `/v1/text-to-speech/{voice_id}/multi-stream-input`.
   *
   * Iterating the socket blocks until the server closes it, so call this from a CLI worker or
   * queue job rather than a web request.
   */
  public function realtime(
    string $voiceId,
    \ElevenLabs\TextToSpeechMultiContext\Requests\V1TextToSpeechVoiceIdMultiStreamInputRequest $request = new \ElevenLabs\TextToSpeechMultiContext\Requests\V1TextToSpeechVoiceIdMultiStreamInputRequest(),
    ?array $options = null
  ): V1TextToSpeechVoiceIdMultiStreamInputSocket {
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
    return new V1TextToSpeechVoiceIdMultiStreamInputSocket(
      \ElevenLabs\Core\WebSocket\WebSocketConnector::connect(
        $this->getBaseUrl($resolvedConfig) .
          '/v1/text-to-speech/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($voiceId) .
          '/multi-stream-input',
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
