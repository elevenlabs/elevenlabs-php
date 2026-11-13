<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\PhoneNumbers;

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
class PhoneNumbersClient extends BaseService
{
  /** @var array|null Method-level configuration for list */
  protected ?array $listConfig = null;

  /** @var array|null Method-level configuration for create */
  protected ?array $createConfig = null;

  /** @var array|null Method-level configuration for get */
  protected ?array $getConfig = null;

  /** @var array|null Method-level configuration for update */
  protected ?array $updateConfig = null;

  /** @var array|null Method-level configuration for delete */
  protected ?array $deleteConfig = null;

  /** @var array|null Method-level configuration for listV2 */
  protected ?array $listV2Config = null;

  /** @var array|null Method-level configuration for getSipMessages */
  protected ?array $getSipMessagesConfig = null;

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
   * Set method-level configuration for delete.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setDeleteConfig(array $config): static
  {
    $this->deleteConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for listV2.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setListV2Config(array $config): static
  {
    $this->listV2Config = $config;
    return $this;
  }

  /**
   * Set method-level configuration for getSipMessages.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setGetSipMessagesConfig(array $config): static
  {
    $this->getSipMessagesConfig = $config;
    return $this;
  }

  /**
   * Retrieve all Phone Numbers
   *
   * @param \ElevenLabs\Agents\PhoneNumbers\Requests\ListPhoneNumbersRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?array<\ElevenLabs\Agents\PhoneNumbers\Types\ListPhoneNumbersResponseItem>
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function list(
    \ElevenLabs\Agents\PhoneNumbers\Requests\ListPhoneNumbersRequest $request = new \ElevenLabs\Agents\PhoneNumbers\Requests\ListPhoneNumbersRequest(),
    ?array $options = null
  ): ?array {
    $provider = $request->provider;
    $agentId = $request->agentId;
    $branchId = $request->branchId;

    $resolvedConfig = $this->getResolvedConfig($this->listConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/phone-numbers',
        method: HttpMethod::GET,
        query: [
          'provider' => $provider,
          'agent_id' => $agentId,
          'branch_id' => $branchId
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Agents\PhoneNumbers\Types\ListPhoneNumbersResponseItem::class . '[]'
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
   * Import Phone Number from provider configuration (Twilio, Exotel, or SIP trunk)
   *
   * @param \ElevenLabs\Agents\PhoneNumbers\Types\CreatePhoneNumbersRequestBody $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\CreatePhoneNumberResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function create(
    \ElevenLabs\Agents\PhoneNumbers\Types\CreatePhoneNumbersRequestBody $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\CreatePhoneNumberResponseModel {
    $resolvedConfig = $this->getResolvedConfig($this->createConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/phone-numbers',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\CreatePhoneNumberResponseModel::class
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
   * Retrieve Phone Number details by ID
   *
   * @param string $phoneNumberId The phone number ID. This is returned when a phone number is imported.
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Agents\PhoneNumbers\Types\GetPhoneNumbersResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function get(
    string $phoneNumberId,
    ?array $options = null
  ): ?\ElevenLabs\Agents\PhoneNumbers\Types\GetPhoneNumbersResponse {
    $resolvedConfig = $this->getResolvedConfig($this->getConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/phone-numbers/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($phoneNumberId),
        method: HttpMethod::GET
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = \ElevenLabs\Agents\PhoneNumbers\Types\GetPhoneNumbersResponse::fromArray(
        $this->decodeJson($data)
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
   * Update assigned agent of a phone number
   *
   * @param string $phoneNumberId The phone number ID. This is returned when a phone number is imported.
   * @param \ElevenLabs\Agents\PhoneNumbers\Requests\UpdatePhoneNumberRequest $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Agents\PhoneNumbers\Types\UpdatePhoneNumbersResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function update(
    string $phoneNumberId,
    \ElevenLabs\Agents\PhoneNumbers\Requests\UpdatePhoneNumberRequest $request = new \ElevenLabs\Agents\PhoneNumbers\Requests\UpdatePhoneNumberRequest(),
    ?array $options = null
  ): ?\ElevenLabs\Agents\PhoneNumbers\Types\UpdatePhoneNumbersResponse {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->updateConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/phone-numbers/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($phoneNumberId),
        method: HttpMethod::PATCH,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = \ElevenLabs\Agents\PhoneNumbers\Types\UpdatePhoneNumbersResponse::fromArray(
        $this->decodeJson($data)
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
   * Delete Phone Number by ID
   *
   * @param string $phoneNumberId The phone number ID. This is returned when a phone number is imported.
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return mixed
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function delete(string $phoneNumberId, ?array $options = null): mixed
  {
    $resolvedConfig = $this->getResolvedConfig($this->deleteConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/phone-numbers/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($phoneNumberId),
        method: HttpMethod::DELETE
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = $this->decodeJson($data);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Retrieve a page of Phone Numbers
   *
   * @param \ElevenLabs\Agents\PhoneNumbers\Requests\ListV2PhoneNumbersRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\GetPhoneNumbersPageResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function listV2(
    \ElevenLabs\Agents\PhoneNumbers\Requests\ListV2PhoneNumbersRequest $request = new \ElevenLabs\Agents\PhoneNumbers\Requests\ListV2PhoneNumbersRequest(),
    ?array $options = null
  ): ?\ElevenLabs\Types\GetPhoneNumbersPageResponseModel {
    $pageSize = $request->pageSize;
    $search = $request->search;
    $label = $request->label;
    $phoneNumber = $request->phoneNumber;
    $provider = $request->provider;
    $supportsOutbound = $request->supportsOutbound;
    $agentId = $request->agentId;
    $branchId = $request->branchId;
    $sortBy = $request->sortBy;
    $sortDirection = $request->sortDirection;
    $cursor = $request->cursor;

    Validator::validateNumber($pageSize, 'page_size', min: 1, max: 1000);
    Validator::validateString($search, 'search', maxLength: 100);
    Validator::validateString($label, 'label', maxLength: 100);
    Validator::validateString($phoneNumber, 'phone_number', maxLength: 100);

    $resolvedConfig = $this->getResolvedConfig($this->listV2Config, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/v2/phone-numbers',
        method: HttpMethod::GET,
        query: [
          'page_size' => $pageSize,
          'search' => $search,
          'label' => $label,
          'phone_number' => $phoneNumber,
          'provider' => $provider,
          'supports_outbound' => $supportsOutbound,
          'agent_id' => $agentId,
          'branch_id' => $branchId,
          'sort_by' => $sortBy,
          'sort_direction' => $sortDirection,
          'cursor' => $cursor
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\GetPhoneNumbersPageResponseModel::class
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
   * Get SIP messages for a phone number
   *
   * @param string $phoneNumberId The phone number ID. This is returned when a phone number is imported.
   * @param \ElevenLabs\Agents\PhoneNumbers\Requests\GetSipMessagesPhoneNumbersRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\GetSipLogMessagesResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function getSipMessages(
    string $phoneNumberId,
    \ElevenLabs\Agents\PhoneNumbers\Requests\GetSipMessagesPhoneNumbersRequest $request = new \ElevenLabs\Agents\PhoneNumbers\Requests\GetSipMessagesPhoneNumbersRequest(),
    ?array $options = null
  ): ?\ElevenLabs\Types\GetSipLogMessagesResponse {
    $pageSize = $request->pageSize;
    $cursor = $request->cursor;

    Validator::validateNumber($pageSize, 'page_size', min: 1, max: 20);

    $resolvedConfig = $this->getResolvedConfig($this->getSipMessagesConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/phone-numbers/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($phoneNumberId) .
          '/sip-messages',
        method: HttpMethod::GET,
        query: [
          'page_size' => $pageSize,
          'cursor' => $cursor
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\GetSipLogMessagesResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }
}
