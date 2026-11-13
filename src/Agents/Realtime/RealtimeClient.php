<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Realtime;

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
class RealtimeClient extends BaseService
{
  /** @var array|null Method-level configuration for listConversationGroups */
  protected ?array $listConversationGroupsConfig = null;

  /** @var array|null Method-level configuration for createConversationGroup */
  protected ?array $createConversationGroupConfig = null;

  /** @var array|null Method-level configuration for getConversationGroup */
  protected ?array $getConversationGroupConfig = null;

  /** @var array|null Method-level configuration for updateConversationGroup */
  protected ?array $updateConversationGroupConfig = null;

  /** @var array|null Method-level configuration for deleteConversationGroup */
  protected ?array $deleteConversationGroupConfig = null;

  /** @var array|null Method-level configuration for setConversationGroup */
  protected ?array $setConversationGroupConfig = null;

  /** @var array|null Method-level configuration for clearConversationGroup */
  protected ?array $clearConversationGroupConfig = null;

  /** @var array|null Method-level configuration for createClientSecret */
  protected ?array $createClientSecretConfig = null;

  /**
   * Set method-level configuration for listConversationGroups.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setListConversationGroupsConfig(array $config): static
  {
    $this->listConversationGroupsConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for createConversationGroup.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setCreateConversationGroupConfig(array $config): static
  {
    $this->createConversationGroupConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for getConversationGroup.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setGetConversationGroupConfig(array $config): static
  {
    $this->getConversationGroupConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for updateConversationGroup.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setUpdateConversationGroupConfig(array $config): static
  {
    $this->updateConversationGroupConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for deleteConversationGroup.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setDeleteConversationGroupConfig(array $config): static
  {
    $this->deleteConversationGroupConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for setConversationGroup.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setSetConversationGroupConfig(array $config): static
  {
    $this->setConversationGroupConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for clearConversationGroup.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setClearConversationGroupConfig(array $config): static
  {
    $this->clearConversationGroupConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for createClientSecret.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setCreateClientSecretConfig(array $config): static
  {
    $this->createClientSecretConfig = $config;
    return $this;
  }

  /**
   * List the realtime conversation groups the current user can view.
   *
   * @param \ElevenLabs\Agents\Realtime\Requests\ListConversationGroupsRealtimeRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\RealtimeConversationGroupsResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function listConversationGroups(
    \ElevenLabs\Agents\Realtime\Requests\ListConversationGroupsRealtimeRequest $request = new \ElevenLabs\Agents\Realtime\Requests\ListConversationGroupsRealtimeRequest(),
    ?array $options = null
  ): ?\ElevenLabs\Types\RealtimeConversationGroupsResponseModel {
    $pageSize = $request->pageSize;
    $search = $request->search;
    $cursor = $request->cursor;

    Validator::validateNumber($pageSize, 'page_size', min: 1, max: 100);
    Validator::validateString($search, 'search', maxLength: 64);

    $resolvedConfig = $this->getResolvedConfig($this->listConversationGroupsConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/realtime/conversation-groups',
        method: HttpMethod::GET,
        query: [
          'page_size' => $pageSize,
          'search' => $search,
          'cursor' => $cursor
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\RealtimeConversationGroupsResponseModel::class
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
   * Create a realtime conversation group owned by the current user.
   *
   * @param \ElevenLabs\Agents\Realtime\Requests\CreateRealtimeConversationGroupRequestModel $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\RealtimeConversationGroupResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function createConversationGroup(
    \ElevenLabs\Agents\Realtime\Requests\CreateRealtimeConversationGroupRequestModel $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\RealtimeConversationGroupResponseModel {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->createConversationGroupConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/realtime/conversation-groups',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\RealtimeConversationGroupResponseModel::class
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
   * Get a realtime conversation group by id.
   *
   * @param string $conversationGroupId The id of a realtime conversation group.
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\RealtimeConversationGroupResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function getConversationGroup(
    string $conversationGroupId,
    ?array $options = null
  ): ?\ElevenLabs\Types\RealtimeConversationGroupResponseModel {
    $resolvedConfig = $this->getResolvedConfig($this->getConversationGroupConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/realtime/conversation-groups/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($conversationGroupId),
        method: HttpMethod::GET
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\RealtimeConversationGroupResponseModel::class
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
   * Rename or re-describe a realtime conversation group.
   *
   * @param string $conversationGroupId The id of a realtime conversation group.
   * @param \ElevenLabs\Agents\Realtime\Requests\UpdateRealtimeConversationGroupRequestModel $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\RealtimeConversationGroupResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function updateConversationGroup(
    string $conversationGroupId,
    \ElevenLabs\Agents\Realtime\Requests\UpdateRealtimeConversationGroupRequestModel $request = new \ElevenLabs\Agents\Realtime\Requests\UpdateRealtimeConversationGroupRequestModel(),
    ?array $options = null
  ): ?\ElevenLabs\Types\RealtimeConversationGroupResponseModel {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->updateConversationGroupConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/realtime/conversation-groups/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($conversationGroupId),
        method: HttpMethod::PATCH,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\RealtimeConversationGroupResponseModel::class
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
   * Delete a realtime conversation group. Every conversation in it becomes ungrouped, so access granted through the group is revoked.
   *
   * @param string $conversationGroupId The id of a realtime conversation group.
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
  public function deleteConversationGroup(
    string $conversationGroupId,
    ?array $options = null
  ): mixed {
    $resolvedConfig = $this->getResolvedConfig($this->deleteConversationGroupConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/realtime/conversation-groups/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($conversationGroupId),
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
   * Place a realtime conversation in a conversation group, moving it out of its current group if it has one.
   *
   * @param string $conversationId The id of a realtime conversation.
   * @param \ElevenLabs\Agents\Realtime\Requests\SetConversationGroupRequestModel $request Request body
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
  public function setConversationGroup(
    string $conversationId,
    \ElevenLabs\Agents\Realtime\Requests\SetConversationGroupRequestModel $request,
    ?array $options = null
  ): mixed {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->setConversationGroupConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/realtime/conversations/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($conversationId) .
          '/conversation-group',
        method: HttpMethod::PUT,
        body: $request
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
   * Remove a realtime conversation from its conversation group.
   *
   * @param string $conversationId The id of a realtime conversation.
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
  public function clearConversationGroup(string $conversationId, ?array $options = null): mixed
  {
    $resolvedConfig = $this->getResolvedConfig($this->clearConversationGroupConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/realtime/conversations/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($conversationId) .
          '/conversation-group',
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
   * Create an ephemeral client secret for authenticating browser-based Realtime API sessions.
   *
   * @param ?\ElevenLabs\Types\CreateClientSecretRequest $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\ClientSecretResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function createClientSecret(
    ?\ElevenLabs\Types\CreateClientSecretRequest $request = null,
    ?array $options = null
  ): ?\ElevenLabs\Types\ClientSecretResponse {
    $request?->validate();

    $resolvedConfig = $this->getResolvedConfig($this->createClientSecretConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/realtime/client_secrets',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\ClientSecretResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }
}
