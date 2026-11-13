<?php

declare(strict_types=1);

namespace ElevenLabs\Productions\Orders\Media;

use ElevenLabs\Services\BaseService;
use ElevenLabs\Core\Json\JsonApiRequest;
use ElevenLabs\Core\Client\HttpMethod;
use ElevenLabs\Utils\Serializer;
use ElevenLabs\Utils\Validator;

/**
 * Service class containing API endpoint methods.
 *
 * This class extends the base service to provide typed methods for specific API operations.
 * Each method corresponds to an API endpoint and handles request serialization,
 * execution, and response deserialization.
 */
class MediaClient extends BaseService
{
  /** @var array|null Method-level configuration for register */
  protected ?array $registerConfig = null;

  /** @var array|null Method-level configuration for get */
  protected ?array $getConfig = null;

  /**
   * Set method-level configuration for register.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setRegisterConfig(array $config): static
  {
    $this->registerConfig = $config;
    return $this;
  }

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
   * Registers a media file with an order, either by uploading it directly or by providing a URL to fetch it from. Exactly one of `media` or `media_url` must be provided. The registered media can then be referenced when adding order items.
   *
   * @param string $orderId The ID of the order to which this media will be attached.
   * @param \ElevenLabs\Productions\Orders\Media\Requests\BodyRegisterMediaV1ProductionsOrdersOrderIdMediaPost $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\RegisterMediaResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function register(
    string $orderId,
    \ElevenLabs\Productions\Orders\Media\Requests\BodyRegisterMediaV1ProductionsOrdersOrderIdMediaPost $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\RegisterMediaResponse {
    Validator::validateString($orderId, 'order_id', pattern: '^prodorder_[a-z0-9]{26}$');
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->registerConfig, $options);
    $response = $this->sendRequest(
      'post',
      '/v1/productions/orders/' .
        \ElevenLabs\Core\Client\RawClient::encodePathParam($orderId) .
        '/media',
      ['multipart' => $request->toMultipart()],
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\RegisterMediaResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Retrieves metadata and a time-limited download URL for a previously uploaded media file.
   *
   * @param string $orderId The ID of the order.
   * @param string $mediaId The ID of the media file.
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\OrderMediaResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function get(
    string $orderId,
    string $mediaId,
    ?array $options = null
  ): ?\ElevenLabs\Types\OrderMediaResponse {
    Validator::validateString($orderId, 'order_id', pattern: '^prodorder_[a-z0-9]{26}$');
    Validator::validateString($mediaId, 'media_id', pattern: '^prodmedia_[a-z0-9]{26}$');

    $resolvedConfig = $this->getResolvedConfig($this->getConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/productions/orders/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($orderId) .
          '/media/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($mediaId),
        method: HttpMethod::GET
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\OrderMediaResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }
}
