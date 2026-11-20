<?php

declare(strict_types=1);

namespace ElevenLabs\Reception\Billing;

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
class BillingClient extends BaseService
{
  /** @var array|null Method-level configuration for listInvoices */
  protected ?array $listInvoicesConfig = null;

  /** @var array|null Method-level configuration for getInvoice */
  protected ?array $getInvoiceConfig = null;

  /** @var array|null Method-level configuration for listUpcomingPayments */
  protected ?array $listUpcomingPaymentsConfig = null;

  /**
   * Set method-level configuration for listInvoices.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setListInvoicesConfig(array $config): static
  {
    $this->listInvoicesConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for getInvoice.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setGetInvoiceConfig(array $config): static
  {
    $this->getInvoiceConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for listUpcomingPayments.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setListUpcomingPaymentsConfig(array $config): static
  {
    $this->listUpcomingPaymentsConfig = $config;
    return $this;
  }

  /**
   * List the invoices charged to the reseller's card, newest first, one per workspace invoice
   *
   * @param \ElevenLabs\Reception\Billing\Requests\ListInvoicesBillingRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\ResellerInvoicesResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function listInvoices(
    \ElevenLabs\Reception\Billing\Requests\ListInvoicesBillingRequest $request = new \ElevenLabs\Reception\Billing\Requests\ListInvoicesBillingRequest(),
    ?array $options = null
  ): ?\ElevenLabs\Types\ResellerInvoicesResponse {
    $cursor = $request->cursor;
    $pageSize = $request->pageSize;

    Validator::validateNumber($pageSize, 'page_size', min: 1, max: 100);

    $resolvedConfig = $this->getResolvedConfig($this->listInvoicesConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/reception/reseller/billing/invoices',
        method: HttpMethod::GET,
        query: [
          'cursor' => $cursor,
          'page_size' => $pageSize
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\ResellerInvoicesResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Get one invoice charged to the reseller's card, broken down into the workspace invoice's lines
   *
   * @param string $invoiceId ID of the invoice. List them with `GET /v1/reception/reseller/billing/invoices`.
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\ResellerInvoiceDetail
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function getInvoice(
    string $invoiceId,
    ?array $options = null
  ): ?\ElevenLabs\Types\ResellerInvoiceDetail {
    $resolvedConfig = $this->getResolvedConfig($this->getInvoiceConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/reception/reseller/billing/invoices/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($invoiceId),
        method: HttpMethod::GET
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\ResellerInvoiceDetail::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * List the next workspace renewals the reseller's card will be charged for, soonest first
   *
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\ResellerUpcomingPaymentsResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function listUpcomingPayments(
    ?array $options = null
  ): ?\ElevenLabs\Types\ResellerUpcomingPaymentsResponse {
    $resolvedConfig = $this->getResolvedConfig($this->listUpcomingPaymentsConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/reception/reseller/billing/upcoming',
        method: HttpMethod::GET
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\ResellerUpcomingPaymentsResponse::class
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
