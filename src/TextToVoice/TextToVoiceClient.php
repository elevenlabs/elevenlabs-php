<?php

declare(strict_types=1);

namespace ElevenLabs\TextToVoice;

use ElevenLabs\Services\BaseService;
use ElevenLabs\Core\Json\JsonApiRequest;
use ElevenLabs\Core\Client\HttpMethod;
use ElevenLabs\Utils\Serializer;

use ElevenLabs\TextToVoice\Preview\PreviewClient;

/**
 * Service class containing API endpoint methods.
 *
 * This class extends the base service to provide typed methods for specific API operations.
 * Each method corresponds to an API endpoint and handles request serialization,
 * execution, and response deserialization.
 */
class TextToVoiceClient extends BaseService
{
  public PreviewClient $preview;

  public function __construct(\ElevenLabs\Core\Client\RawClient $client, ?array $options = null)
  {
    parent::__construct($client, $options);
    $this->preview = new PreviewClient($client, $options);
  }

  /** @var array|null Method-level configuration for create */
  protected ?array $createConfig = null;

  /** @var array|null Method-level configuration for design */
  protected ?array $designConfig = null;

  /** @var array|null Method-level configuration for remix */
  protected ?array $remixConfig = null;

  /**
   * Set method-level configuration for create.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setCreateConfig(array $config): static
  {
    $this->createConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for design.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setDesignConfig(array $config): static
  {
    $this->designConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for remix.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setRemixConfig(array $config): static
  {
    $this->remixConfig = $config;
    return $this;
  }

  /**
   * Create a voice from previously generated voice preview. This endpoint should be called after you fetched a generated_voice_id using POST /v1/text-to-voice/design or POST /v1/text-to-voice/:voice_id/remix.
   *
   * @param \ElevenLabs\TextToVoice\Requests\BodyCreateANewVoiceFromVoicePreviewV1TextToVoicePost $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\Voice
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function create(
    \ElevenLabs\TextToVoice\Requests\BodyCreateANewVoiceFromVoicePreviewV1TextToVoicePost $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\Voice {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->createConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/text-to-voice',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\Voice::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Design a voice via a prompt. This method returns a list of voice previews. Each preview has a generated_voice_id and a sample of the voice as base64 encoded mp3 audio. To create a voice use the generated_voice_id of the preferred preview with the /v1/text-to-voice endpoint.
   *
   * @param \ElevenLabs\TextToVoice\Requests\VoiceDesignRequestModel $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\VoiceDesignPreviewResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function design(
    \ElevenLabs\TextToVoice\Requests\VoiceDesignRequestModel $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\VoiceDesignPreviewResponse {
    $outputFormat = $request->outputFormat;

    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->designConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/text-to-voice/design',
        method: HttpMethod::POST,
        query: [
          'output_format' => $outputFormat
        ],
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\VoiceDesignPreviewResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Remix an existing voice via a prompt. This method returns a list of voice previews. Each preview has a generated_voice_id and a sample of the voice as base64 encoded mp3 audio. To create a voice use the generated_voice_id of the preferred preview with the /v1/text-to-voice endpoint.
   *
   * @param string $voiceId Voice ID to be used, you can use https://api.elevenlabs.io/v1/voices to list all the available voices.
   * @param \ElevenLabs\TextToVoice\Requests\VoiceRemixRequestModel $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\VoiceDesignPreviewResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function remix(
    string $voiceId,
    \ElevenLabs\TextToVoice\Requests\VoiceRemixRequestModel $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\VoiceDesignPreviewResponse {
    $outputFormat = $request->outputFormat;

    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->remixConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/text-to-voice/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($voiceId) .
          '/remix',
        method: HttpMethod::POST,
        query: [
          'output_format' => $outputFormat
        ],
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\VoiceDesignPreviewResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }
}
