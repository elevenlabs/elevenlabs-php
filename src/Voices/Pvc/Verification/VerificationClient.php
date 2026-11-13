<?php

declare(strict_types=1);

namespace ElevenLabs\Voices\Pvc\Verification;

use ElevenLabs\Services\BaseService;
use ElevenLabs\Utils\Serializer;

use ElevenLabs\Voices\Pvc\Verification\Captcha\CaptchaClient;

/**
 * Service class containing API endpoint methods.
 *
 * This class extends the base service to provide typed methods for specific API operations.
 * Each method corresponds to an API endpoint and handles request serialization,
 * execution, and response deserialization.
 */
class VerificationClient extends BaseService
{
  public CaptchaClient $captcha;

  public function __construct(\ElevenLabs\Core\Client\RawClient $client, ?array $options = null)
  {
    parent::__construct($client, $options);
    $this->captcha = new CaptchaClient($client, $options);
  }

  /** @var array|null Method-level configuration for request */
  protected ?array $requestConfig = null;

  /**
   * Set method-level configuration for request.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setRequestConfig(array $config): static
  {
    $this->requestConfig = $config;
    return $this;
  }

  /**
   * Request manual verification for a PVC voice.
   *
   * @param string $voiceId Voice ID to be used, you can use https://api.elevenlabs.io/v1/voices to list all the available voices.
   * @param \ElevenLabs\Voices\Pvc\Verification\Requests\BodyRequestManualVerificationV1VoicesPvcVoiceIdVerificationPost $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\RequestPvcManualVerificationResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function request(
    string $voiceId,
    \ElevenLabs\Voices\Pvc\Verification\Requests\BodyRequestManualVerificationV1VoicesPvcVoiceIdVerificationPost $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\RequestPvcManualVerificationResponseModel {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->requestConfig, $options);
    $response = $this->sendRequest(
      'post',
      '/v1/voices/pvc/' .
        \ElevenLabs\Core\Client\RawClient::encodePathParam($voiceId) .
        '/verification',
      ['multipart' => $request->toMultipart()],
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\RequestPvcManualVerificationResponseModel::class
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
