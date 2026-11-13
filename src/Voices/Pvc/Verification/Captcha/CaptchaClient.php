<?php

declare(strict_types=1);

namespace ElevenLabs\Voices\Pvc\Verification\Captcha;

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
class CaptchaClient extends BaseService
{
  /** @var array|null Method-level configuration for get */
  protected ?array $getConfig = null;

  /** @var array|null Method-level configuration for verify */
  protected ?array $verifyConfig = null;

  /**
   * Set method-level configuration for get.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setGetConfig(array $config): static
  {
    $this->getConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for verify.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setVerifyConfig(array $config): static
  {
    $this->verifyConfig = $config;
    return $this;
  }

  /**
   * Get captcha for PVC voice verification.
   *
   * @param string $voiceId Voice ID to be used, you can use https://api.elevenlabs.io/v1/voices to list all the available voices.
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return void
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function get(string $voiceId, ?array $options = null): void
  {
    $resolvedConfig = $this->getResolvedConfig($this->getConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/voices/pvc/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($voiceId) .
          '/captcha',
        method: HttpMethod::GET
      ),
      $resolvedConfig
    );
  }

  /**
   * Submit captcha verification for PVC voice.
   *
   * @param string $voiceId Voice ID to be used, you can use https://api.elevenlabs.io/v1/voices to list all the available voices.
   * @param \ElevenLabs\Voices\Pvc\Verification\Captcha\Requests\BodyVerifyPvcVoiceCaptchaV1VoicesPvcVoiceIdCaptchaPost $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\VerifyPvcVoiceCaptchaResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function verify(
    string $voiceId,
    \ElevenLabs\Voices\Pvc\Verification\Captcha\Requests\BodyVerifyPvcVoiceCaptchaV1VoicesPvcVoiceIdCaptchaPost $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\VerifyPvcVoiceCaptchaResponseModel {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->verifyConfig, $options);
    $response = $this->sendRequest(
      'post',
      '/v1/voices/pvc/' . \ElevenLabs\Core\Client\RawClient::encodePathParam($voiceId) . '/captcha',
      ['multipart' => $request->toMultipart()],
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\VerifyPvcVoiceCaptchaResponseModel::class
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
