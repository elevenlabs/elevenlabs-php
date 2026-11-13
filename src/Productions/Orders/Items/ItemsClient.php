<?php

declare(strict_types=1);

namespace ElevenLabs\Productions\Orders\Items;

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
class ItemsClient extends BaseService
{
  /** @var array|null Method-level configuration for upsert */
  protected ?array $upsertConfig = null;

  /** @var array|null Method-level configuration for remove */
  protected ?array $removeConfig = null;

  /**
   * Set method-level configuration for upsert.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setUpsertConfig(array $config): static
  {
    $this->upsertConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for remove.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setRemoveConfig(array $config): static
  {
    $this->removeConfig = $config;
    return $this;
  }

  /**
   * Adds or updates an order item on an open order. Returns the item ID and the quoted price.
   *
   * @param string $orderId The ID of the order.
   * @param \ElevenLabs\Productions\Orders\Items\Requests\BodyUpsertOrderItemV1ProductionsOrdersOrderIdItemsPost $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\UpsertOrderItemResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function upsert(
    string $orderId,
    \ElevenLabs\Productions\Orders\Items\Requests\BodyUpsertOrderItemV1ProductionsOrdersOrderIdItemsPost $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\UpsertOrderItemResponse {
    Validator::validateString($orderId, 'order_id', pattern: '^prodorder_[a-z0-9]{26}$');
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->upsertConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/productions/orders/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($orderId) .
          '/items',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\UpsertOrderItemResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Removes an order item from an open order.
   *
   * @param string $orderId The ID of the order.
   * @param string $itemId The ID of the order item.
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\RemoveOrderItemResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function remove(
    string $orderId,
    string $itemId,
    ?array $options = null
  ): ?\ElevenLabs\Types\RemoveOrderItemResponse {
    Validator::validateString($orderId, 'order_id', pattern: '^prodorder_[a-z0-9]{26}$');
    Validator::validateString($itemId, 'item_id', pattern: '^proditem_[a-z0-9]{26}$');

    $resolvedConfig = $this->getResolvedConfig($this->removeConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/productions/orders/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($orderId) .
          '/items/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($itemId),
        method: HttpMethod::DELETE
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\RemoveOrderItemResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }
}
