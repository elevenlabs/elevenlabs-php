<?php

declare(strict_types=1);

namespace ElevenLabs\TextToDialogueMultiContext;

use ElevenLabs\Services\BaseService;
use ElevenLabs\Utils\Serializer;

/**
 * Service class containing API endpoint methods.
 *
 * This class extends the base service to provide typed methods for specific API operations.
 * Each method corresponds to an API endpoint and handles request serialization,
 * execution, and response deserialization.
 */
class TextToDialogueMultiContextClient extends BaseService
{
  /**
   * Opens a WebSocket connection to `/v1/text-to-dialogue/multi-stream-input`.
   *
   * Iterating the socket blocks until the server closes it, so call this from a CLI worker or
   * queue job rather than a web request.
   */
  public function realtime(
    \ElevenLabs\TextToDialogueMultiContext\Requests\V1TextToDialogueMultiStreamInputRequest $request = new \ElevenLabs\TextToDialogueMultiContext\Requests\V1TextToDialogueMultiStreamInputRequest(),
    ?array $options = null
  ): V1TextToDialogueMultiStreamInputSocket {
    $modelId = $request->modelId;
    $outputFormat = $request->outputFormat;
    $languageCode = $request->languageCode;
    $syncAlignment = $request->syncAlignment;
    $applyTextNormalization = $request->applyTextNormalization;
    $seed = $request->seed;
    $enableLogging = $request->enableLogging;
    $resolvedConfig = $this->getResolvedConfig(null, $options);
    return new V1TextToDialogueMultiStreamInputSocket(
      \ElevenLabs\Core\WebSocket\WebSocketConnector::connect(
        $this->getBaseUrl($resolvedConfig) . '/v1/text-to-dialogue/multi-stream-input',
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
