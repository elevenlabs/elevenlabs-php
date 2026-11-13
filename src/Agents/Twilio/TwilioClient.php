<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Twilio;

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
class TwilioClient extends BaseService
{
  /** @var array|null Method-level configuration for outboundCall */
  protected ?array $outboundCallConfig = null;

  /** @var array|null Method-level configuration for registerCall */
  protected ?array $registerCallConfig = null;

  /**
   * Set method-level configuration for outboundCall.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setOutboundCallConfig(array $config): static
  {
    $this->outboundCallConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for registerCall.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setRegisterCallConfig(array $config): static
  {
    $this->registerCallConfig = $config;
    return $this;
  }

  /**
   * Handle an outbound call via Twilio
   *
   * @param \ElevenLabs\Agents\Twilio\Requests\BodyHandleAnOutboundCallViaTwilioV1ConvaiTwilioOutboundCallPost $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\TwilioOutboundCallResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function outboundCall(
    \ElevenLabs\Agents\Twilio\Requests\BodyHandleAnOutboundCallViaTwilioV1ConvaiTwilioOutboundCallPost $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\TwilioOutboundCallResponse {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->outboundCallConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/twilio/outbound-call',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\TwilioOutboundCallResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Register a Twilio call and return TwiML to connect the call
   *
   * @param \ElevenLabs\Agents\Twilio\Requests\BodyRegisterATwilioCallAndReturnTwiMlV1ConvaiTwilioRegisterCallPost $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return string
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function registerCall(
    \ElevenLabs\Agents\Twilio\Requests\BodyRegisterATwilioCallAndReturnTwiMlV1ConvaiTwilioRegisterCallPost $request,
    ?array $options = null
  ): string {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->registerCallConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/twilio/register-call',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    return $data;
  }
}
