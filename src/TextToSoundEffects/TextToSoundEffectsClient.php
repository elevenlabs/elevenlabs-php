<?php

declare(strict_types=1);

namespace ElevenLabs\TextToSoundEffects;

use ElevenLabs\Services\BaseService;
use ElevenLabs\Core\Json\JsonApiRequest;
use ElevenLabs\Core\Client\HttpMethod;
use ElevenLabs\Utils\Serializer;

/**
 * Service class containing API endpoint methods.
 *
 * This class extends the base service to provide typed methods for specific API operations.
 * Each method corresponds to an API endpoint and handles request serialization,
 * execution, and response deserialization.
 */
class TextToSoundEffectsClient extends BaseService
{
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
   * Turn text into sound effects for your videos, voice-overs or video games using the most advanced sound effects models in the world.
   *
   * @param \ElevenLabs\TextToSoundEffects\Requests\CreateSoundEffectRequest $request Request parameters
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
    \ElevenLabs\TextToSoundEffects\Requests\CreateSoundEffectRequest $request,
    ?array $options = null
  ): \Psr\Http\Message\StreamInterface {
    $outputFormat = $request->outputFormat;
    $enableLogging = $request->enableLogging;

    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->convertConfig, $options);
    $response = $this->sendBinaryStreamJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/sound-generation',
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
}
