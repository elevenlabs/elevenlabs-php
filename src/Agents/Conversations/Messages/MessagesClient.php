<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Conversations\Messages;

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
class MessagesClient extends BaseService
{
  /** @var array|null Method-level configuration for textSearch */
  protected ?array $textSearchConfig = null;

  /** @var array|null Method-level configuration for search */
  protected ?array $searchConfig = null;

  /**
   * Set method-level configuration for textSearch.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setTextSearchConfig(array $config): static
  {
    $this->textSearchConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for search.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setSearchConfig(array $config): static
  {
    $this->searchConfig = $config;
    return $this;
  }

  /**
   * Search through conversation transcript messages by full-text and fuzzy search
   *
   * @param \ElevenLabs\Agents\Conversations\Messages\Requests\TextSearchMessagesRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\MessagesSearchResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function textSearch(
    \ElevenLabs\Agents\Conversations\Messages\Requests\TextSearchMessagesRequest $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\MessagesSearchResponse {
    $textQuery = $request->textQuery;
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
    $excludeStatuses = $request->excludeStatuses;
    $terminationReasons = $request->terminationReasons;
    $pageSize = $request->pageSize;
    $summaryMode = $request->summaryMode;
    $conversationInitiationSource = $request->conversationInitiationSource;
    $textOnly = $request->textOnly;
    $conversationProductType = $request->conversationProductType;
    $branchId = $request->branchId;
    $versionId = $request->versionId;
    $topicIds = $request->topicIds;
    $sortBy = $request->sortBy;
    $cursor = $request->cursor;

    Validator::validateArray($visitedAgentIds, 'visited_agent_ids', maxItems: 50);
    Validator::validateArray($visitedAgentBranchIds, 'visited_agent_branch_ids', maxItems: 50);
    Validator::validateArray($triggeredProcedureIds, 'triggered_procedure_ids', maxItems: 50);
    Validator::validateNumber($ratingMax, 'rating_max', min: 1, max: 5);
    Validator::validateNumber($ratingMin, 'rating_min', min: 1, max: 5);
    Validator::validateNumber($pageSize, 'page_size', min: 1, max: 50);

    $resolvedConfig = $this->getResolvedConfig($this->textSearchConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/conversations/messages/text-search',
        method: HttpMethod::GET,
        query: [
          'text_query' => $textQuery,
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
          'exclude_statuses' => $excludeStatuses,
          'termination_reasons' => $terminationReasons,
          'page_size' => $pageSize,
          'summary_mode' => $summaryMode,
          'conversation_initiation_source' => $conversationInitiationSource,
          'text_only' => $textOnly,
          'conversation_product_type' => $conversationProductType,
          'branch_id' => $branchId,
          'version_id' => $versionId,
          'topic_ids' => $topicIds,
          'sort_by' => $sortBy,
          'cursor' => $cursor
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\MessagesSearchResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Search conversation transcripts by semantic similarity to surface relevant messages based on meaning and intent, rather than exact keyword matches
   *
   * @param \ElevenLabs\Agents\Conversations\Messages\Requests\SearchMessagesRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\MessagesSearchResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function search(
    \ElevenLabs\Agents\Conversations\Messages\Requests\SearchMessagesRequest $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\MessagesSearchResponse {
    $textQuery = $request->textQuery;
    $agentId = $request->agentId;
    $branchId = $request->branchId;
    $pageSize = $request->pageSize;
    $cursor = $request->cursor;

    Validator::validateNumber($pageSize, 'page_size', min: 1, max: 50);

    $resolvedConfig = $this->getResolvedConfig($this->searchConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/conversations/messages/smart-search',
        method: HttpMethod::GET,
        query: [
          'text_query' => $textQuery,
          'agent_id' => $agentId,
          'branch_id' => $branchId,
          'page_size' => $pageSize,
          'cursor' => $cursor
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\MessagesSearchResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }
}
