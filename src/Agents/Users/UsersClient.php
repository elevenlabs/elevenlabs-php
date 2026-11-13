<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Users;

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
class UsersClient extends BaseService
{
  /** @var array|null Method-level configuration for list */
  protected ?array $listConfig = null;

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
   * Get distinct users from conversations with pagination.
   *
   * @param \ElevenLabs\Agents\Users\Requests\ListUsersRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\GetConversationUsersPageResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function list(
    \ElevenLabs\Agents\Users\Requests\ListUsersRequest $request = new \ElevenLabs\Agents\Users\Requests\ListUsersRequest(),
    ?array $options = null
  ): ?\ElevenLabs\Types\GetConversationUsersPageResponseModel {
    $agentId = $request->agentId;
    $branchId = $request->branchId;
    $callStartBeforeUnix = $request->callStartBeforeUnix;
    $callStartAfterUnix = $request->callStartAfterUnix;
    $search = $request->search;
    $pageSize = $request->pageSize;
    $sortBy = $request->sortBy;
    $sortDirection = $request->sortDirection;
    $cursor = $request->cursor;

    Validator::validateNumber($pageSize, 'page_size', min: 1, max: 100);

    $resolvedConfig = $this->getResolvedConfig($this->listConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/users',
        method: HttpMethod::GET,
        query: [
          'agent_id' => $agentId,
          'branch_id' => $branchId,
          'call_start_before_unix' => $callStartBeforeUnix,
          'call_start_after_unix' => $callStartAfterUnix,
          'search' => $search,
          'page_size' => $pageSize,
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
        \ElevenLabs\Types\GetConversationUsersPageResponseModel::class
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
