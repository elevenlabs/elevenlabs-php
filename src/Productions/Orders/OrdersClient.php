<?php

declare(strict_types=1);

namespace ElevenLabs\Productions\Orders;

use ElevenLabs\Services\BaseService;
use ElevenLabs\Core\Json\JsonApiRequest;
use ElevenLabs\Core\Client\HttpMethod;
use ElevenLabs\Utils\Serializer;
use ElevenLabs\Utils\Validator;

use ElevenLabs\Productions\Orders\Media\MediaClient;
use ElevenLabs\Productions\Orders\Items\ItemsClient;
use ElevenLabs\Productions\Orders\Deliverables\DeliverablesClient;
use ElevenLabs\Productions\Orders\Languages\LanguagesClient;

/**
 * Service class containing API endpoint methods.
 *
 * This class extends the base service to provide typed methods for specific API operations.
 * Each method corresponds to an API endpoint and handles request serialization,
 * execution, and response deserialization.
 */
class OrdersClient extends BaseService
{
  public MediaClient $media;
  public ItemsClient $items;
  public DeliverablesClient $deliverables;
  public LanguagesClient $languages;

  public function __construct(\ElevenLabs\Core\Client\RawClient $client, ?array $options = null)
  {
    parent::__construct($client, $options);
    $this->media = new MediaClient($client, $options);
    $this->items = new ItemsClient($client, $options);
    $this->deliverables = new DeliverablesClient($client, $options);
    $this->languages = new LanguagesClient($client, $options);
  }

  /** @var array|null Method-level configuration for list */
  protected ?array $listConfig = null;

  /** @var array|null Method-level configuration for create */
  protected ?array $createConfig = null;

  /** @var array|null Method-level configuration for get */
  protected ?array $getConfig = null;

  /** @var array|null Method-level configuration for update */
  protected ?array $updateConfig = null;

  /** @var array|null Method-level configuration for submit */
  protected ?array $submitConfig = null;

  /**
   * Set method-level configuration for list.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setListConfig(array $config): static
  {
    $this->listConfig = $config;
    return $this;
  }

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
   * Set method-level configuration for submit.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setSubmitConfig(array $config): static
  {
    $this->submitConfig = $config;
    return $this;
  }

  /**
   * Lists Productions orders in the workspace. Supports filtering by status and date range, with pagination.
   *
   * @param \ElevenLabs\Productions\Orders\Requests\ListOrdersRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\ListOrdersResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function list(
    \ElevenLabs\Productions\Orders\Requests\ListOrdersRequest $request = new \ElevenLabs\Productions\Orders\Requests\ListOrdersRequest(),
    ?array $options = null
  ): ?\ElevenLabs\Types\ListOrdersResponse {
    $pageSize = $request->pageSize;
    $offset = $request->offset;
    $status = $request->status;
    $startDate = $request->startDate;
    $startDate = $startDate !== null ? Serializer::serializeDateTime($startDate) : null;
    $endDate = $request->endDate;
    $endDate = $endDate !== null ? Serializer::serializeDateTime($endDate) : null;

    Validator::validateNumber($pageSize, 'page_size', max: 100);
    Validator::validateNumber($offset, 'offset', min: 0);

    $resolvedConfig = $this->getResolvedConfig($this->listConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/productions/orders',
        method: HttpMethod::GET,
        query: [
          'page_size' => $pageSize,
          'offset' => $offset,
          'status' => $status,
          'start_date' => $startDate,
          'end_date' => $endDate
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\ListOrdersResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Creates a new Productions order in the workspace. The order starts in the open state and can be configured with items before submission.
   *
   * @param ?\ElevenLabs\Types\CreateOrderRequest $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\CreateOrderResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function create(
    ?\ElevenLabs\Types\CreateOrderRequest $request = null,
    ?array $options = null
  ): ?\ElevenLabs\Types\CreateOrderResponse {
    $request?->validate();

    $resolvedConfig = $this->getResolvedConfig($this->createConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/productions/orders',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\CreateOrderResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Retrieves full details for a Productions order.
   *
   * Quote and pricing information may not be available immediately; if you wish to see the quote before submission, you may need to poll the order details until it is ready.
   *
   * @param string $orderId The ID of the order.
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\OrderResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function get(string $orderId, ?array $options = null): ?\ElevenLabs\Types\OrderResponse
  {
    Validator::validateString($orderId, 'order_id', pattern: '^prodorder_[a-z0-9]{26}$');

    $resolvedConfig = $this->getResolvedConfig($this->getConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/productions/orders/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($orderId),
        method: HttpMethod::GET
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\OrderResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Updates an open order.
   *
   * @param string $orderId The ID of the order.
   * @param \ElevenLabs\Productions\Orders\Requests\BodyUpdateOrderV1ProductionsOrdersOrderIdPatch $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\UpdateOrderResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function update(
    string $orderId,
    \ElevenLabs\Productions\Orders\Requests\BodyUpdateOrderV1ProductionsOrdersOrderIdPatch $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\UpdateOrderResponse {
    Validator::validateString($orderId, 'order_id', pattern: '^prodorder_[a-z0-9]{26}$');
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->updateConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/productions/orders/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($orderId),
        method: HttpMethod::PATCH,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\UpdateOrderResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Submits an open order for processing. The order must have at least one item. Once submitted, items can no longer be modified.
   *
   * Upon submission, the workspace will be charged for the order. The quote is based on information extracted from the uploaded media, such as its duration. The quote may not be available immediately; if you wish to see the quote before submission, you may need to poll the order details until the quote is ready.
   *
   * @param string $orderId The ID of the order.
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\SubmitOrderResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function submit(
    string $orderId,
    ?array $options = null
  ): ?\ElevenLabs\Types\SubmitOrderResponse {
    Validator::validateString($orderId, 'order_id', pattern: '^prodorder_[a-z0-9]{26}$');

    $resolvedConfig = $this->getResolvedConfig($this->submitConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/productions/orders/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($orderId) .
          '/submit',
        method: HttpMethod::POST
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\SubmitOrderResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }
}
