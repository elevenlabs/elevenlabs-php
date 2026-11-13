<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Conversations;

use ElevenLabs\Services\BaseService;
use ElevenLabs\Core\Json\JsonApiRequest;
use ElevenLabs\Core\Client\HttpMethod;
use ElevenLabs\Utils\Serializer;
use ElevenLabs\Utils\Validator;

use ElevenLabs\Agents\Conversations\Audio\AudioClient;
use ElevenLabs\Agents\Conversations\Files\FilesClient;
use ElevenLabs\Agents\Conversations\Feedback\FeedbackClient;
use ElevenLabs\Agents\Conversations\Messages\MessagesClient;
use ElevenLabs\Agents\Conversations\Tags\TagsClient;
use ElevenLabs\Agents\Conversations\Topics\TopicsClient;
use ElevenLabs\Agents\Conversations\Analysis\AnalysisClient;

/**
 * Service class containing API endpoint methods.
 *
 * This class extends the base service to provide typed methods for specific API operations.
 * Each method corresponds to an API endpoint and handles request serialization,
 * execution, and response deserialization.
 */
class ConversationsClient extends BaseService
{
  public AudioClient $audio;
  public FilesClient $files;
  public FeedbackClient $feedback;
  public MessagesClient $messages;
  public TagsClient $tags;
  public TopicsClient $topics;
  public AnalysisClient $analysis;

  public function __construct(\ElevenLabs\Core\Client\RawClient $client, ?array $options = null)
  {
    parent::__construct($client, $options);
    $this->audio = new AudioClient($client, $options);
    $this->files = new FilesClient($client, $options);
    $this->feedback = new FeedbackClient($client, $options);
    $this->messages = new MessagesClient($client, $options);
    $this->tags = new TagsClient($client, $options);
    $this->topics = new TopicsClient($client, $options);
    $this->analysis = new AnalysisClient($client, $options);
  }

  /** @var array|null Method-level configuration for getSignedUrl */
  protected ?array $getSignedUrlConfig = null;

  /** @var array|null Method-level configuration for getWebrtcToken */
  protected ?array $getWebrtcTokenConfig = null;

  /** @var array|null Method-level configuration for list */
  protected ?array $listConfig = null;

  /** @var array|null Method-level configuration for resolve */
  protected ?array $resolveConfig = null;

  /** @var array|null Method-level configuration for get */
  protected ?array $getConfig = null;

  /** @var array|null Method-level configuration for delete */
  protected ?array $deleteConfig = null;

  /** @var array|null Method-level configuration for getSummary */
  protected ?array $getSummaryConfig = null;

  /** @var array|null Method-level configuration for getSipMessages */
  protected ?array $getSipMessagesConfig = null;

  /**
   * Set method-level configuration for getSignedUrl.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setGetSignedUrlConfig(array $config): static
  {
    $this->getSignedUrlConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for getWebrtcToken.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setGetWebrtcTokenConfig(array $config): static
  {
    $this->getWebrtcTokenConfig = $config;
    return $this;
  }

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
   * Set method-level configuration for resolve.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setResolveConfig(array $config): static
  {
    $this->resolveConfig = $config;
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
   * Set method-level configuration for getSummary.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setGetSummaryConfig(array $config): static
  {
    $this->getSummaryConfig = $config;
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
   * Get a signed url to start a conversation with an agent with an agent that requires authorization
   *
   * @param \ElevenLabs\Agents\Conversations\Requests\GetSignedUrlConversationsRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\ConversationSignedUrlResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function getSignedUrl(
    \ElevenLabs\Agents\Conversations\Requests\GetSignedUrlConversationsRequest $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\ConversationSignedUrlResponseModel {
    $agentId = $request->agentId;
    $includeConversationId = $request->includeConversationId;
    $branchId = $request->branchId;
    $versionId = $request->versionId;
    $environment = $request->environment;
    $debugEventsRequest = $request->debugEventsRequest;

    $resolvedConfig = $this->getResolvedConfig($this->getSignedUrlConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/conversation/get-signed-url',
        method: HttpMethod::GET,
        query: [
          'agent_id' => $agentId,
          'include_conversation_id' => $includeConversationId,
          'branch_id' => $branchId,
          'version_id' => $versionId,
          'environment' => $environment,
          'debug_events_request' => $debugEventsRequest
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\ConversationSignedUrlResponseModel::class
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
   * Get a WebRTC session token for real-time communication.
   *
   * @param \ElevenLabs\Agents\Conversations\Requests\GetWebrtcTokenConversationsRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\TokenResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function getWebrtcToken(
    \ElevenLabs\Agents\Conversations\Requests\GetWebrtcTokenConversationsRequest $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\TokenResponseModel {
    $agentId = $request->agentId;
    $participantName = $request->participantName;
    $branchId = $request->branchId;
    $versionId = $request->versionId;
    $environment = $request->environment;
    $debugEventsRequest = $request->debugEventsRequest;

    $resolvedConfig = $this->getResolvedConfig($this->getWebrtcTokenConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/conversation/token',
        method: HttpMethod::GET,
        query: [
          'agent_id' => $agentId,
          'participant_name' => $participantName,
          'branch_id' => $branchId,
          'version_id' => $versionId,
          'environment' => $environment,
          'debug_events_request' => $debugEventsRequest
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\TokenResponseModel::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Get all conversations of agents that user owns. With option to restrict to a specific agent.
   *
   * @param \ElevenLabs\Agents\Conversations\Requests\ListConversationsRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\GetConversationsPageResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function list(
    \ElevenLabs\Agents\Conversations\Requests\ListConversationsRequest $request = new \ElevenLabs\Agents\Conversations\Requests\ListConversationsRequest(),
    ?array $options = null
  ): ?\ElevenLabs\Types\GetConversationsPageResponseModel {
    $cursor = $request->cursor;
    $agentId = $request->agentId;
    $visitedAgentIds = $request->visitedAgentIds;
    $visitedAgentBranchIds = $request->visitedAgentBranchIds;
    $triggeredProcedureIds = $request->triggeredProcedureIds;
    $callSuccessful = $request->callSuccessful;
    $callStartBeforeUnix = $request->callStartBeforeUnix;
    $callStartAfterUnix = $request->callStartAfterUnix;
    $callDurationMinSecs = $request->callDurationMinSecs;
    $callDurationMaxSecs = $request->callDurationMaxSecs;
    $ratingMax = $request->ratingMax;
    $ratingMin = $request->ratingMin;
    $hasFeedbackComment = $request->hasFeedbackComment;
    $userId = $request->userId;
    $evaluationParams = $request->evaluationParams;
    $dataCollectionParams = $request->dataCollectionParams;
    $dynamicVariableParams = $request->dynamicVariableParams;
    $dataCollectionFilter = $request->dataCollectionFilter;
    $dynamicVariableFilter = $request->dynamicVariableFilter;
    $dataCollectionIds = $request->dataCollectionIds;
    $evaluationCriteriaIds = $request->evaluationCriteriaIds;
    $toolNames = $request->toolNames;
    $toolNamesSuccessful = $request->toolNamesSuccessful;
    $toolNamesErrored = $request->toolNamesErrored;
    $toolIds = $request->toolIds;
    $toolIdsSuccessful = $request->toolIdsSuccessful;
    $toolIdsErrored = $request->toolIdsErrored;
    $includeInvalidToolCalls = $request->includeInvalidToolCalls;
    $mainLanguages = $request->mainLanguages;
    $phoneNumberIds = $request->phoneNumberIds;
    $whatsappPhoneNumberIds = $request->whatsappPhoneNumberIds;
    $pageSize = $request->pageSize;
    $summaryMode = $request->summaryMode;
    $search = $request->search;
    $conversationInitiationSource = $request->conversationInitiationSource;
    $textOnly = $request->textOnly;
    $conversationProductType = $request->conversationProductType;
    $branchId = $request->branchId;
    $versionId = $request->versionId;
    $parentConversationId = $request->parentConversationId;
    $topicIds = $request->topicIds;
    $excludeStatuses = $request->excludeStatuses;
    $tagIds = $request->tagIds;
    $workflowNodeEnteredId = $request->workflowNodeEnteredId;
    $terminationReasons = $request->terminationReasons;
    $guardrailTypes = $request->guardrailTypes;
    $customGuardrailNames = $request->customGuardrailNames;
    $sortDirection = $request->sortDirection;

    Validator::validateArray($visitedAgentIds, 'visited_agent_ids', maxItems: 50);
    Validator::validateArray($visitedAgentBranchIds, 'visited_agent_branch_ids', maxItems: 50);
    Validator::validateArray($triggeredProcedureIds, 'triggered_procedure_ids', maxItems: 50);
    Validator::validateNumber($ratingMax, 'rating_max', min: 1, max: 5);
    Validator::validateNumber($ratingMin, 'rating_min', min: 1, max: 5);
    Validator::validateNumber($pageSize, 'page_size', min: 1, max: 100);

    $resolvedConfig = $this->getResolvedConfig($this->listConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/conversations',
        method: HttpMethod::GET,
        query: [
          'cursor' => $cursor,
          'agent_id' => $agentId,
          'visited_agent_ids' => $visitedAgentIds,
          'visited_agent_branch_ids' => $visitedAgentBranchIds,
          'triggered_procedure_ids' => $triggeredProcedureIds,
          'call_successful' => $callSuccessful,
          'call_start_before_unix' => $callStartBeforeUnix,
          'call_start_after_unix' => $callStartAfterUnix,
          'call_duration_min_secs' => $callDurationMinSecs,
          'call_duration_max_secs' => $callDurationMaxSecs,
          'rating_max' => $ratingMax,
          'rating_min' => $ratingMin,
          'has_feedback_comment' => $hasFeedbackComment,
          'user_id' => $userId,
          'evaluation_params' => $evaluationParams,
          'data_collection_params' => $dataCollectionParams,
          'dynamic_variable_params' => $dynamicVariableParams,
          'data_collection_filter' => $dataCollectionFilter,
          'dynamic_variable_filter' => $dynamicVariableFilter,
          'data_collection_ids' => $dataCollectionIds,
          'evaluation_criteria_ids' => $evaluationCriteriaIds,
          'tool_names' => $toolNames,
          'tool_names_successful' => $toolNamesSuccessful,
          'tool_names_errored' => $toolNamesErrored,
          'tool_ids' => $toolIds,
          'tool_ids_successful' => $toolIdsSuccessful,
          'tool_ids_errored' => $toolIdsErrored,
          'include_invalid_tool_calls' => $includeInvalidToolCalls,
          'main_languages' => $mainLanguages,
          'phone_number_ids' => $phoneNumberIds,
          'whatsapp_phone_number_ids' => $whatsappPhoneNumberIds,
          'page_size' => $pageSize,
          'summary_mode' => $summaryMode,
          'search' => $search,
          'conversation_initiation_source' => $conversationInitiationSource,
          'text_only' => $textOnly,
          'conversation_product_type' => $conversationProductType,
          'branch_id' => $branchId,
          'version_id' => $versionId,
          'parent_conversation_id' => $parentConversationId,
          'topic_ids' => $topicIds,
          'exclude_statuses' => $excludeStatuses,
          'tag_ids' => $tagIds,
          'workflow_node_entered_id' => $workflowNodeEnteredId,
          'termination_reasons' => $terminationReasons,
          'guardrail_types' => $guardrailTypes,
          'custom_guardrail_names' => $customGuardrailNames,
          'sort_direction' => $sortDirection
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\GetConversationsPageResponseModel::class
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
   * Resolve a conversation URL (a Slack message URL or a Zendesk ticket URL) to the deterministic conversation ID for the given agent, then confirm the conversation exists.
   *
   * @param \ElevenLabs\Agents\Conversations\Requests\ResolveConversationsRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\GetConversationResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function resolve(
    \ElevenLabs\Agents\Conversations\Requests\ResolveConversationsRequest $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\GetConversationResponseModel {
    $agentId = $request->agentId;
    $reference = $request->reference;

    $resolvedConfig = $this->getResolvedConfig($this->resolveConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/conversations/resolve',
        method: HttpMethod::GET,
        query: [
          'agent_id' => $agentId,
          'reference' => $reference
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\GetConversationResponseModel::class
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
   * Get the details of a particular conversation
   *
   * @param string $conversationId The id of the conversation you're taking the action on.
   * @param \ElevenLabs\Agents\Conversations\Requests\GetConversationsRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\GetConversationResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function get(
    string $conversationId,
    \ElevenLabs\Agents\Conversations\Requests\GetConversationsRequest $request = new \ElevenLabs\Agents\Conversations\Requests\GetConversationsRequest(),
    ?array $options = null
  ): ?\ElevenLabs\Types\GetConversationResponseModel {
    $format = $request->format;

    $resolvedConfig = $this->getResolvedConfig($this->getConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/conversations/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($conversationId),
        method: HttpMethod::GET,
        query: [
          'format' => $format
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\GetConversationResponseModel::class
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
   * Delete a particular conversation
   *
   * @param string $conversationId The id of the conversation you're taking the action on.
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
  public function delete(string $conversationId, ?array $options = null): mixed
  {
    $resolvedConfig = $this->getResolvedConfig($this->deleteConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/conversations/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($conversationId),
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
   * Get a lightweight summary of a conversation: its title, the generated transcript summary, whether the call was successful, and — only when the conversation is short — the plain chat messages. Tool calls, tool results, and contextual updates are omitted so the response stays small. Use this instead of the full conversation endpoint when you only need the gist (e.g. an agent reading many conversations); use GET /v1/convai/conversations/{conversation_id} when you need the full transcript with tool calls and contextual updates.
   *
   * @param string $conversationId The id of the conversation you're taking the action on.
   * @param \ElevenLabs\Agents\Conversations\Requests\GetSummaryConversationsRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\GetConversationSummaryResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function getSummary(
    string $conversationId,
    \ElevenLabs\Agents\Conversations\Requests\GetSummaryConversationsRequest $request = new \ElevenLabs\Agents\Conversations\Requests\GetSummaryConversationsRequest(),
    ?array $options = null
  ): ?\ElevenLabs\Types\GetConversationSummaryResponseModel {
    $maxMessages = $request->maxMessages;

    Validator::validateNumber($maxMessages, 'max_messages', min: 1, max: 200);

    $resolvedConfig = $this->getResolvedConfig($this->getSummaryConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/conversations/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($conversationId) .
          '/summary',
        method: HttpMethod::GET,
        query: [
          'max_messages' => $maxMessages
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\GetConversationSummaryResponseModel::class
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
   * Get SIP messages associated with a conversation's phone call
   *
   * @param string $conversationId The id of the conversation you're taking the action on.
   * @param \ElevenLabs\Agents\Conversations\Requests\GetSipMessagesConversationsRequest $request Request parameters
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
    string $conversationId,
    \ElevenLabs\Agents\Conversations\Requests\GetSipMessagesConversationsRequest $request = new \ElevenLabs\Agents\Conversations\Requests\GetSipMessagesConversationsRequest(),
    ?array $options = null
  ): ?\ElevenLabs\Types\GetSipLogMessagesResponse {
    $pageSize = $request->pageSize;
    $cursor = $request->cursor;

    Validator::validateNumber($pageSize, 'page_size', min: 1, max: 20);

    $resolvedConfig = $this->getResolvedConfig($this->getSipMessagesConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/conversations/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($conversationId) .
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
