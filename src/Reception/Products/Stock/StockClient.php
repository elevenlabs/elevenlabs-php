<?php

declare(strict_types=1);

namespace ElevenLabs\Reception\Products\Stock;

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
class StockClient extends BaseService
{
  /** @var array|null Method-level configuration for set */
  protected ?array $setConfig = null;

  /** @var array|null Method-level configuration for adjust */
  protected ?array $adjustConfig = null;

  /**
   * Set method-level configuration for set.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setSetConfig(array $config): static
  {
    $this->setConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for adjust.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setAdjustConfig(array $config): static
  {
    $this->adjustConfig = $config;
    return $this;
  }

  /**
   * Set the on-hand quantity of a counted product at one location. Rejected with a 409 if it changed since `expected_on_hand` was read.
   *
   * @param string $productId ID of the product. Returned when you create one; list them with `GET /v1/reception/products`.
   * @param \ElevenLabs\Reception\Products\Stock\Requests\ReceptionUpdateProductStockRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\ReceptionProduct
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function set(
    string $productId,
    \ElevenLabs\Reception\Products\Stock\Requests\ReceptionUpdateProductStockRequest $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\ReceptionProduct {
    $xiWorkspaceId = $request->xiWorkspaceId;

    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->setConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/reception/products/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($productId) .
          '/stock',
        method: HttpMethod::PATCH,
        headers: [
          'xi-workspace-id' => $xiWorkspaceId
        ],
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\ReceptionProduct::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Add to or subtract from the on-hand quantity of a counted product at one location, without overwriting orders taken at the same time.
   *
   * @param string $productId ID of the product. Returned when you create one; list them with `GET /v1/reception/products`.
   * @param \ElevenLabs\Reception\Products\Stock\Requests\ReceptionAdjustProductStockRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\ReceptionProduct
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function adjust(
    string $productId,
    \ElevenLabs\Reception\Products\Stock\Requests\ReceptionAdjustProductStockRequest $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\ReceptionProduct {
    $xiWorkspaceId = $request->xiWorkspaceId;

    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->adjustConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/reception/products/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($productId) .
          '/stock/adjust',
        method: HttpMethod::POST,
        headers: [
          'xi-workspace-id' => $xiWorkspaceId
        ],
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\ReceptionProduct::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }
}
