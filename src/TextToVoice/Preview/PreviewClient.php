<?php

declare(strict_types=1);

namespace ElevenLabs\TextToVoice\Preview;

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
class PreviewClient extends BaseService
{
  /** @var array|null Method-level configuration for stream */
  protected ?array $streamConfig = null;

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
   * Stream a voice preview that was created via the /v1/text-to-voice/design endpoint.
   *
   * @param string $generatedVoiceId The generated_voice_id to stream.
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
    string $generatedVoiceId,
    ?array $options = null
  ): \Psr\Http\Message\StreamInterface {
    $resolvedConfig = $this->getResolvedConfig($this->streamConfig, $options);
    $response = $this->sendBinaryStreamJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/text-to-voice/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($generatedVoiceId) .
          '/stream',
        method: HttpMethod::GET
      ),
      $resolvedConfig
    );
    $data = $response->getBody();

    return $data;
  }
}
