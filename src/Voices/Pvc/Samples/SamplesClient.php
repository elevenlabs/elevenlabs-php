<?php

declare(strict_types=1);

namespace ElevenLabs\Voices\Pvc\Samples;

use ElevenLabs\Services\BaseService;
use ElevenLabs\Core\Json\JsonApiRequest;
use ElevenLabs\Core\Client\HttpMethod;
use ElevenLabs\Utils\Serializer;

use ElevenLabs\Voices\Pvc\Samples\Audio\AudioClient;
use ElevenLabs\Voices\Pvc\Samples\Speakers\SpeakersClient;
use ElevenLabs\Voices\Pvc\Samples\Waveform\WaveformClient;

/**
 * Service class containing API endpoint methods.
 *
 * This class extends the base service to provide typed methods for specific API operations.
 * Each method corresponds to an API endpoint and handles request serialization,
 * execution, and response deserialization.
 */
class SamplesClient extends BaseService
{
  public AudioClient $audio;
  public SpeakersClient $speakers;
  public WaveformClient $waveform;

  public function __construct(\ElevenLabs\Core\Client\RawClient $client, ?array $options = null)
  {
    parent::__construct($client, $options);
    $this->audio = new AudioClient($client, $options);
    $this->speakers = new SpeakersClient($client, $options);
    $this->waveform = new WaveformClient($client, $options);
  }

  /** @var array|null Method-level configuration for create */
  protected ?array $createConfig = null;

  /** @var array|null Method-level configuration for update */
  protected ?array $updateConfig = null;

  /** @var array|null Method-level configuration for delete */
  protected ?array $deleteConfig = null;

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
   * Set method-level configuration for update.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setUpdateConfig(array $config): static
  {
    $this->updateConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for delete.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setDeleteConfig(array $config): static
  {
    $this->deleteConfig = $config;
    return $this;
  }

  /**
   * Add audio samples to a PVC voice
   *
   * @param string $voiceId Voice ID to be used, you can use https://api.elevenlabs.io/v1/voices to list all the available voices.
   * @param \ElevenLabs\Voices\Pvc\Samples\Requests\BodyAddSamplesToPvcVoiceV1VoicesPvcVoiceIdSamplesPost $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?array<\ElevenLabs\Types\VoiceSample>
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function create(
    string $voiceId,
    \ElevenLabs\Voices\Pvc\Samples\Requests\BodyAddSamplesToPvcVoiceV1VoicesPvcVoiceIdSamplesPost $request,
    ?array $options = null
  ): ?array {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->createConfig, $options);
    $response = $this->sendRequest(
      'post',
      '/v1/voices/pvc/' . \ElevenLabs\Core\Client\RawClient::encodePathParam($voiceId) . '/samples',
      ['multipart' => $request->toMultipart()],
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\VoiceSample::class . '[]');
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Update a PVC voice sample - apply noise removal, select speaker, change trim times or file name.
   *
   * @param string $voiceId Voice ID to be used, you can use https://api.elevenlabs.io/v1/voices to list all the available voices.
   * @param string $sampleId Sample ID to be used
   * @param \ElevenLabs\Voices\Pvc\Samples\Requests\BodyUpdatePvcVoiceSampleV1VoicesPvcVoiceIdSamplesSampleIdPost $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\AddVoiceResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function update(
    string $voiceId,
    string $sampleId,
    \ElevenLabs\Voices\Pvc\Samples\Requests\BodyUpdatePvcVoiceSampleV1VoicesPvcVoiceIdSamplesSampleIdPost $request = new \ElevenLabs\Voices\Pvc\Samples\Requests\BodyUpdatePvcVoiceSampleV1VoicesPvcVoiceIdSamplesSampleIdPost(),
    ?array $options = null
  ): ?\ElevenLabs\Types\AddVoiceResponseModel {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->updateConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/voices/pvc/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($voiceId) .
          '/samples/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($sampleId),
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\AddVoiceResponseModel::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Delete a sample from a PVC voice.
   *
   * @param string $voiceId Voice ID to be used, you can use https://api.elevenlabs.io/v1/voices to list all the available voices.
   * @param string $sampleId Sample ID to be used
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\DeleteVoiceSampleResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function delete(
    string $voiceId,
    string $sampleId,
    ?array $options = null
  ): ?\ElevenLabs\Types\DeleteVoiceSampleResponseModel {
    $resolvedConfig = $this->getResolvedConfig($this->deleteConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/voices/pvc/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($voiceId) .
          '/samples/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($sampleId),
        method: HttpMethod::DELETE
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\DeleteVoiceSampleResponseModel::class
      );
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }
}
