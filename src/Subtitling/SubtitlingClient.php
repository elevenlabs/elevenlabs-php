<?php

declare(strict_types=1);

namespace ElevenLabs\Subtitling;

use ElevenLabs\Services\BaseService;
use ElevenLabs\Utils\Serializer;

/**
 * Service class containing API endpoint methods.
 *
 * This class extends the base service to provide typed methods for specific API operations.
 * Each method corresponds to an API endpoint and handles request serialization,
 * execution, and response deserialization.
 */
class SubtitlingClient extends BaseService
{
  /**
   * Opens a WebSocket connection to `/v1/subtitling/realtime`.
   *
   * Iterating the socket blocks until the server closes it, so call this from a CLI worker or
   * queue job rather than a web request.
   */
  public function realtime(
    \ElevenLabs\Subtitling\Requests\V1SubtitlingRealtimeRequest $request,
    ?array $options = null
  ): V1SubtitlingRealtimeSocket {
    $targetLanguage = $request->targetLanguage;
    $sourceLanguage = $request->sourceLanguage;
    $inputFormat = $request->inputFormat;
    $eagerness = $request->eagerness;
    $clientSessionId = $request->clientSessionId;
    $enableLogging = $request->enableLogging;
    $resolvedConfig = $this->getResolvedConfig(null, $options);
    return new V1SubtitlingRealtimeSocket(
      \ElevenLabs\Core\WebSocket\WebSocketConnector::connect(
        $this->getBaseUrl($resolvedConfig) . '/v1/subtitling/realtime',
        $this->withHandshakeHeaders(
          [
            'query' => [
              'target_language' => $targetLanguage,
              'source_language' => $sourceLanguage,
              'input_format' => $inputFormat,
              'eagerness' => $eagerness,
              'client_session_id' => $clientSessionId,
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
