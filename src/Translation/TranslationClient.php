<?php

declare(strict_types=1);

namespace ElevenLabs\Translation;

use ElevenLabs\Services\BaseService;
use ElevenLabs\Utils\Serializer;

/**
 * Service class containing API endpoint methods.
 *
 * This class extends the base service to provide typed methods for specific API operations.
 * Each method corresponds to an API endpoint and handles request serialization,
 * execution, and response deserialization.
 */
class TranslationClient extends BaseService
{
  /**
   * Opens a WebSocket connection to `/v1/translation/realtime`.
   *
   * Iterating the socket blocks until the server closes it, so call this from a CLI worker or
   * queue job rather than a web request.
   */
  public function realtime(
    \ElevenLabs\Translation\Requests\V1TranslationRealtimeRequest $request,
    ?array $options = null
  ): V1TranslationRealtimeSocket {
    $authorization = $request->authorization;
    $targetLanguage = $request->targetLanguage;
    $sourceLanguage = $request->sourceLanguage;
    $voiceId = $request->voiceId;
    $inputFormat = $request->inputFormat;
    $outputFormat = $request->outputFormat;
    $ttsModelId = $request->ttsModelId;
    $applyTextNormalization = $request->applyTextNormalization;
    $eagerness = $request->eagerness;
    $clientSessionId = $request->clientSessionId;
    $enableZrm = $request->enableZrm;
    $resolvedConfig = $this->getResolvedConfig(null, $options);
    return new V1TranslationRealtimeSocket(
      \ElevenLabs\Core\WebSocket\WebSocketConnector::connect(
        $this->getBaseUrl($resolvedConfig) . '/v1/translation/realtime',
        $this->withHandshakeHeaders(
          [
            'query' => [
              'target_language' => $targetLanguage,
              'voice_id' => $voiceId,
              'authorization' => $authorization,
              'source_language' => $sourceLanguage,
              'input_format' => $inputFormat,
              'output_format' => $outputFormat,
              'tts_model_id' => $ttsModelId,
              'apply_text_normalization' => $applyTextNormalization,
              'eagerness' => $eagerness,
              'client_session_id' => $clientSessionId,
              'enable_zrm' => $enableZrm
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
