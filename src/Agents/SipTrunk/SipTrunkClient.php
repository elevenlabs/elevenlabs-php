<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\SipTrunk;

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
class SipTrunkClient extends BaseService
{
  /** @var array|null Method-level configuration for outboundCall */
  protected ?array $outboundCallConfig = null;

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
   * Handle an outbound call via SIP trunk
   *
   * @param \ElevenLabs\Agents\SipTrunk\Requests\BodyHandleAnOutboundCallViaSipTrunkV1ConvaiSipTrunkOutboundCallPost $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\SipTrunkOutboundCallResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function outboundCall(
    \ElevenLabs\Agents\SipTrunk\Requests\BodyHandleAnOutboundCallViaSipTrunkV1ConvaiSipTrunkOutboundCallPost $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\SipTrunkOutboundCallResponse {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->outboundCallConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/sip-trunk/outbound-call',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\SipTrunkOutboundCallResponse::class
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
