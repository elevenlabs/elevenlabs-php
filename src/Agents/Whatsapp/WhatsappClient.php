<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Whatsapp;

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
class WhatsappClient extends BaseService
{
  /** @var array|null Method-level configuration for outboundCall */
  protected ?array $outboundCallConfig = null;

  /** @var array|null Method-level configuration for outboundMessage */
  protected ?array $outboundMessageConfig = null;

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
   * Set method-level configuration for outboundMessage.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setOutboundMessageConfig(array $config): static
  {
    $this->outboundMessageConfig = $config;
    return $this;
  }

  /**
   * Make an outbound call via WhatsApp
   *
   * @param \ElevenLabs\Agents\Whatsapp\Requests\BodyMakeAnOutboundCallViaWhatsAppV1ConvaiWhatsappOutboundCallPost $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\WhatsAppOutboundCallResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function outboundCall(
    \ElevenLabs\Agents\Whatsapp\Requests\BodyMakeAnOutboundCallViaWhatsAppV1ConvaiWhatsappOutboundCallPost $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\WhatsAppOutboundCallResponse {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->outboundCallConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/whatsapp/outbound-call',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\WhatsAppOutboundCallResponse::class
      );
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Send an outbound message via WhatsApp
   *
   * @param \ElevenLabs\Agents\Whatsapp\Requests\BodySendAnOutboundMessageViaWhatsAppV1ConvaiWhatsappOutboundMessagePost $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\WhatsAppOutboundMessageResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function outboundMessage(
    \ElevenLabs\Agents\Whatsapp\Requests\BodySendAnOutboundMessageViaWhatsAppV1ConvaiWhatsappOutboundMessagePost $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\WhatsAppOutboundMessageResponse {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->outboundMessageConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/whatsapp/outbound-message',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\WhatsAppOutboundMessageResponse::class
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
