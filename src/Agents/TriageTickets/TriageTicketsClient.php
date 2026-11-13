<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\TriageTickets;

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
class TriageTicketsClient extends BaseService
{
  /** @var array|null Method-level configuration for list */
  protected ?array $listConfig = null;

  /** @var array|null Method-level configuration for createManual */
  protected ?array $createManualConfig = null;

  /** @var array|null Method-level configuration for listForWorkspace */
  protected ?array $listForWorkspaceConfig = null;

  /** @var array|null Method-level configuration for create */
  protected ?array $createConfig = null;

  /** @var array|null Method-level configuration for listAssignableUsers */
  protected ?array $listAssignableUsersConfig = null;

  /** @var array|null Method-level configuration for get */
  protected ?array $getConfig = null;

  /** @var array|null Method-level configuration for update */
  protected ?array $updateConfig = null;

  /** @var array|null Method-level configuration for delete */
  protected ?array $deleteConfig = null;

  /** @var array|null Method-level configuration for addComment */
  protected ?array $addCommentConfig = null;

  /** @var array|null Method-level configuration for merge */
  protected ?array $mergeConfig = null;

  /** @var array|null Method-level configuration for addTurnComment */
  protected ?array $addTurnCommentConfig = null;

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
   * Set method-level configuration for createManual.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setCreateManualConfig(array $config): static
  {
    $this->createManualConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for listForWorkspace.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setListForWorkspaceConfig(array $config): static
  {
    $this->listForWorkspaceConfig = $config;
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
   * Set method-level configuration for listAssignableUsers.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setListAssignableUsersConfig(array $config): static
  {
    $this->listAssignableUsersConfig = $config;
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
   * Set method-level configuration for addComment.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setAddCommentConfig(array $config): static
  {
    $this->addCommentConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for merge.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setMergeConfig(array $config): static
  {
    $this->mergeConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for addTurnComment.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setAddTurnCommentConfig(array $config): static
  {
    $this->addTurnCommentConfig = $config;
    return $this;
  }

  /**
   * List an agent's conversation triage tickets, ordered by most recently created first unless sorted by priority. These are tickets about the agent's own performance on a conversation (for triage with Architect), not tickets an agent opens for end users.
   *
   * @param string $agentId
   * @param \ElevenLabs\Agents\TriageTickets\Requests\ListTriageTicketsRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\GetAgentConversationTicketsPageResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function list(
    string $agentId,
    \ElevenLabs\Agents\TriageTickets\Requests\ListTriageTicketsRequest $request = new \ElevenLabs\Agents\TriageTickets\Requests\ListTriageTicketsRequest(),
    ?array $options = null
  ): ?\ElevenLabs\Types\GetAgentConversationTicketsPageResponseModel {
    $pageSize = $request->pageSize;
    $conversationId = $request->conversationId;
    $status = $request->status;
    $sources = $request->sources;
    $priorities = $request->priorities;
    $sortBy = $request->sortBy;
    $ownerUserId = $request->ownerUserId;
    $assigneeUserId = $request->assigneeUserId;
    $issueType = $request->issueType;
    $label = $request->label;
    $mergedIntoTicketId = $request->mergedIntoTicketId;
    $search = $request->search;
    $cursor = $request->cursor;

    Validator::validateNumber($pageSize, 'page_size', min: 1, max: 100);
    Validator::validateString($search, 'search', maxLength: 200);

    $resolvedConfig = $this->getResolvedConfig($this->listConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/agents/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($agentId) .
          '/triage-tickets',
        method: HttpMethod::GET,
        query: [
          'page_size' => $pageSize,
          'conversation_id' => $conversationId,
          'status' => $status,
          'sources' => $sources,
          'priorities' => $priorities,
          'sort_by' => $sortBy,
          'owner_user_id' => $ownerUserId,
          'assignee_user_id' => $assigneeUserId,
          'issue_type' => $issueType,
          'label' => $label,
          'merged_into_ticket_id' => $mergedIntoTicketId,
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
        \ElevenLabs\Types\GetAgentConversationTicketsPageResponseModel::class
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
   * Manually raise a follow-up ticket against an agent, not tied to any conversation (for example a task like 'add the KB about X'). Without a title, one is derived from the comment. Requires viewer access to the agent.
   *
   * @param string $agentId
   * @param \ElevenLabs\Agents\TriageTickets\Requests\CreateManualTicketRequestModel $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\AgentConversationTicketResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function createManual(
    string $agentId,
    \ElevenLabs\Agents\TriageTickets\Requests\CreateManualTicketRequestModel $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\AgentConversationTicketResponseModel {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->createManualConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/agents/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($agentId) .
          '/triage-tickets',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\AgentConversationTicketResponseModel::class
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
   * List conversation triage tickets across every agent in the workspace, ordered by most recently created first. Use this to build a workspace-wide view (for example, tickets assigned to the caller). Supports the same filters, sorting and search as the per-agent endpoint. Tickets for agents the caller cannot access are omitted.
   *
   * @param \ElevenLabs\Agents\TriageTickets\Requests\ListForWorkspaceTriageTicketsRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\GetAgentConversationTicketsPageResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function listForWorkspace(
    \ElevenLabs\Agents\TriageTickets\Requests\ListForWorkspaceTriageTicketsRequest $request = new \ElevenLabs\Agents\TriageTickets\Requests\ListForWorkspaceTriageTicketsRequest(),
    ?array $options = null
  ): ?\ElevenLabs\Types\GetAgentConversationTicketsPageResponseModel {
    $pageSize = $request->pageSize;
    $agentId = $request->agentId;
    $status = $request->status;
    $sources = $request->sources;
    $priorities = $request->priorities;
    $sortBy = $request->sortBy;
    $ownerUserId = $request->ownerUserId;
    $assigneeUserId = $request->assigneeUserId;
    $issueType = $request->issueType;
    $label = $request->label;
    $mergedIntoTicketId = $request->mergedIntoTicketId;
    $search = $request->search;
    $cursor = $request->cursor;

    Validator::validateNumber($pageSize, 'page_size', min: 1, max: 100);
    Validator::validateString($search, 'search', maxLength: 200);

    $resolvedConfig = $this->getResolvedConfig($this->listForWorkspaceConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/triage-tickets',
        method: HttpMethod::GET,
        query: [
          'page_size' => $pageSize,
          'agent_id' => $agentId,
          'status' => $status,
          'sources' => $sources,
          'priorities' => $priorities,
          'sort_by' => $sortBy,
          'owner_user_id' => $ownerUserId,
          'assignee_user_id' => $assigneeUserId,
          'issue_type' => $issueType,
          'label' => $label,
          'merged_into_ticket_id' => $mergedIntoTicketId,
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
        \ElevenLabs\Types\GetAgentConversationTicketsPageResponseModel::class
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
   * Raise a ticket about an agent's performance on a conversation, for triage with Architect. Provide an overall comment and/or turn-level comments describing what went wrong.
   *
   * @param \ElevenLabs\Agents\TriageTickets\Requests\CreateAgentConversationTicketRequestModel $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\AgentConversationTicketResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function create(
    \ElevenLabs\Agents\TriageTickets\Requests\CreateAgentConversationTicketRequestModel $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\AgentConversationTicketResponseModel {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->createConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/triage-tickets',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\AgentConversationTicketResponseModel::class
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
   * All non-service-account workspace members, each flagged with whether they currently have at least viewer access to the agent. Members without access are included (not filtered out) so the UI can offer them as an assignee and prompt to grant access first.
   *
   * @param string $agentId
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?array<\ElevenLabs\Types\AssignableUserResponseModel>
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function listAssignableUsers(string $agentId, ?array $options = null): ?array
  {
    $resolvedConfig = $this->getResolvedConfig($this->listAssignableUsersConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/agents/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($agentId) .
          '/triage-tickets/assignable-users',
        method: HttpMethod::GET
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\AssignableUserResponseModel::class . '[]'
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
   * Get an agent conversation ticket by ID.
   *
   * @param string $agentqaTicketId
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\AgentConversationTicketResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function get(
    string $agentqaTicketId,
    ?array $options = null
  ): ?\ElevenLabs\Types\AgentConversationTicketResponseModel {
    $resolvedConfig = $this->getResolvedConfig($this->getConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/triage-tickets/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($agentqaTicketId),
        method: HttpMethod::GET
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\AgentConversationTicketResponseModel::class
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
   * Update a ticket's title, comment, status, priority, and/or assignee. Requires viewer access to the ticket's agent.
   *
   * @param string $agentqaTicketId
   * @param \ElevenLabs\Agents\TriageTickets\Requests\PatchAgentConversationTicketRequestModel $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\AgentConversationTicketResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function update(
    string $agentqaTicketId,
    \ElevenLabs\Agents\TriageTickets\Requests\PatchAgentConversationTicketRequestModel $request = new \ElevenLabs\Agents\TriageTickets\Requests\PatchAgentConversationTicketRequestModel(),
    ?array $options = null
  ): ?\ElevenLabs\Types\AgentConversationTicketResponseModel {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->updateConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/triage-tickets/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($agentqaTicketId),
        method: HttpMethod::PATCH,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\AgentConversationTicketResponseModel::class
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
   * Delete an agent conversation ticket. Restricted to the ticket creator or a workspace admin.
   *
   * @param string $agentqaTicketId
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return void
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function delete(string $agentqaTicketId, ?array $options = null): void
  {
    $resolvedConfig = $this->getResolvedConfig($this->deleteConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/triage-tickets/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($agentqaTicketId),
        method: HttpMethod::DELETE
      ),
      $resolvedConfig
    );
  }

  /**
   * Append a comment discussing how to resolve the ticket. Requires viewer access to the ticket's agent.
   *
   * @param string $agentqaTicketId
   * @param \ElevenLabs\Agents\TriageTickets\Requests\AddTicketCommentRequestModel $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\AgentConversationTicketResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function addComment(
    string $agentqaTicketId,
    \ElevenLabs\Agents\TriageTickets\Requests\AddTicketCommentRequestModel $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\AgentConversationTicketResponseModel {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->addCommentConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/triage-tickets/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($agentqaTicketId) .
          '/comments',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\AgentConversationTicketResponseModel::class
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
   * Merge other open tickets of the same agent into this pending, in-progress, or resolved one. Their conversations move onto this ticket, its priority is raised to the highest among them, and they are kept with status 'merged'. Requires viewer access to the ticket's agent.
   *
   * @param string $agentqaTicketId
   * @param \ElevenLabs\Agents\TriageTickets\Requests\MergeAgentConversationTicketsRequestModel $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\AgentConversationTicketResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function merge(
    string $agentqaTicketId,
    \ElevenLabs\Agents\TriageTickets\Requests\MergeAgentConversationTicketsRequestModel $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\AgentConversationTicketResponseModel {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->mergeConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/triage-tickets/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($agentqaTicketId) .
          '/merge',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\AgentConversationTicketResponseModel::class
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
   * Append a turn-level comment to a ticket. Requires viewer access to the ticket's agent.
   *
   * @param string $agentqaTicketId
   * @param \ElevenLabs\Agents\TriageTickets\Requests\AddTurnCommentRequestModel $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\AgentConversationTicketResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function addTurnComment(
    string $agentqaTicketId,
    \ElevenLabs\Agents\TriageTickets\Requests\AddTurnCommentRequestModel $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\AgentConversationTicketResponseModel {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->addTurnCommentConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/triage-tickets/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($agentqaTicketId) .
          '/turn-comments',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\AgentConversationTicketResponseModel::class
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
