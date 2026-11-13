<?php

declare(strict_types=1);

namespace ElevenLabs\Voices\Pvc;

use ElevenLabs\Services\BaseService;
use ElevenLabs\Core\Json\JsonApiRequest;
use ElevenLabs\Core\Client\HttpMethod;
use ElevenLabs\Utils\Serializer;

use ElevenLabs\Voices\Pvc\Samples\SamplesClient;
use ElevenLabs\Voices\Pvc\Verification\VerificationClient;

/**
 * Service class containing API endpoint methods.
 *
 * This class extends the base service to provide typed methods for specific API operations.
 * Each method corresponds to an API endpoint and handles request serialization,
 * execution, and response deserialization.
 */
class PvcClient extends BaseService
{
  public SamplesClient $samples;
  public VerificationClient $verification;

  public function __construct(\ElevenLabs\Core\Client\RawClient $client, ?array $options = null)
  {
    parent::__construct($client, $options);
    $this->samples = new SamplesClient($client, $options);
    $this->verification = new VerificationClient($client, $options);
  }

  /** @var array|null Method-level configuration for create */
  protected ?array $createConfig = null;

  /** @var array|null Method-level configuration for update */
  protected ?array $updateConfig = null;

  /** @var array|null Method-level configuration for train */
  protected ?array $trainConfig = null;

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
   * Set method-level configuration for train.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setTrainConfig(array $config): static
  {
    $this->trainConfig = $config;
    return $this;
  }

  /**
   * Creates a new PVC voice with metadata but no samples
   *
   * @param \ElevenLabs\Voices\Pvc\Requests\CreatePvcVoiceRequest $request Request body
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
  public function create(
    \ElevenLabs\Voices\Pvc\Requests\CreatePvcVoiceRequest $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\AddVoiceResponseModel {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->createConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/voices/pvc',
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
   * Edit PVC voice metadata
   *
   * @param string $voiceId Voice ID to be used, you can use https://api.elevenlabs.io/v1/voices to list all the available voices.
   * @param \ElevenLabs\Voices\Pvc\Requests\BodyEditPvcVoiceV1VoicesPvcVoiceIdPost $request Request body
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
    \ElevenLabs\Voices\Pvc\Requests\BodyEditPvcVoiceV1VoicesPvcVoiceIdPost $request = new \ElevenLabs\Voices\Pvc\Requests\BodyEditPvcVoiceV1VoicesPvcVoiceIdPost(),
    ?array $options = null
  ): ?\ElevenLabs\Types\AddVoiceResponseModel {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->updateConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/voices/pvc/' . \ElevenLabs\Core\Client\RawClient::encodePathParam($voiceId),
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
   * Start PVC training process for a voice.
   *
   * @param string $voiceId Voice ID to be used, you can use https://api.elevenlabs.io/v1/voices to list all the available voices.
   * @param \ElevenLabs\Voices\Pvc\Requests\BodyRunPvcTrainingV1VoicesPvcVoiceIdTrainPost $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\StartPvcVoiceTrainingResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function train(
    string $voiceId,
    \ElevenLabs\Voices\Pvc\Requests\BodyRunPvcTrainingV1VoicesPvcVoiceIdTrainPost $request = new \ElevenLabs\Voices\Pvc\Requests\BodyRunPvcTrainingV1VoicesPvcVoiceIdTrainPost(),
    ?array $options = null
  ): ?\ElevenLabs\Types\StartPvcVoiceTrainingResponseModel {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->trainConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/voices/pvc/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($voiceId) .
          '/train',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\StartPvcVoiceTrainingResponseModel::class
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
