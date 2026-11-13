<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Conversations\Messages\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Types\ConversationInitiationSource;
use ElevenLabs\Types\ConversationProduct;
use ElevenLabs\Types\EvaluationResultFilter;
use ElevenLabs\Types\MessageSearchSortBy;
use ElevenLabs\Agents\Conversations\Messages\Types\TextSearchMessagesRequestSummaryMode;

class TextSearchMessagesRequest extends JsonSerializableType
{
  /**
   * @var string $textQuery The search query text for full-text and fuzzy matching
   */
  public string $textQuery;

  /**
   * @var ?string $agentId Agent id (agent_…) or speech engine external id (seng_), resolved to the same underlying resource.
   */
  public ?string $agentId;

  /**
   * @var ?array $visitedAgentIds Filter conversations where any of these agents participated. Can not exceed 50 values.
   */
  public ?array $visitedAgentIds;

  /**
   * @var ?array $visitedAgentBranchIds Filter conversations where any of these agent branches participated. Can not exceed 50 values.
   */
  public ?array $visitedAgentBranchIds;

  /**
   * @var ?array $triggeredProcedureIds Filter conversations where any of these procedures were triggered. Can not exceed 50 values.
   */
  public ?array $triggeredProcedureIds;

  /**
   * @var ?value-of<EvaluationResultFilter> $callSuccessful The result of the success evaluation
   */
  public ?string $callSuccessful;

  /**
   * @var ?int $callStartBeforeUnix Unix timestamp (in seconds) to filter conversations up to this start date.
   */
  public ?int $callStartBeforeUnix;

  /**
   * @var ?int $callStartAfterUnix Unix timestamp (in seconds) to filter conversations after to this start date.
   */
  public ?int $callStartAfterUnix;

  /**
   * @var ?int $callDurationMinSecs Minimum call duration in seconds.
   */
  public ?int $callDurationMinSecs;

  /**
   * @var ?int $callDurationMaxSecs Maximum call duration in seconds.
   */
  public ?int $callDurationMaxSecs;

  /**
   * @var ?int $ratingMax Maximum overall rating (1-5).
   */
  public ?int $ratingMax;

  /**
   * @var ?int $ratingMin Minimum overall rating (1-5).
   */
  public ?int $ratingMin;

  /**
   * @var ?bool $hasFeedbackComment Filter conversations with user feedback comments.
   */
  public ?bool $hasFeedbackComment;

  /**
   * @var ?string $userId Filter conversations by the user ID who initiated them.
   */
  public ?string $userId;

  /**
   * @var ?array $evaluationParams Evaluation filters. Repeat param. Format: criteria_id:result where result is one of success|failure|unknown. Example: eval=value_framing:success
   */
  public ?array $evaluationParams;

  /**
   * @var ?array $dataCollectionParams Data collection filters. Repeat param. Format: id:op:value where op is one of eq|neq|gt|gte|lt|lte|in. For in, pipe-delimit values. An empty value matches conversations where the field was not collected (id:eq:), and neq with an empty value matches where it was (id:neq:). eq is exact equality. gt|gte|lt|lte require a numeric value.
   */
  public ?array $dataCollectionParams;

  /**
   * @var ?array $dynamicVariableParams Dynamic variable filters. Repeat param. Format: name:op:value where op is one of eq|neq|gt|gte|lt|lte|in. For in, pipe-delimit values. An empty value matches conversations where the variable was not set (name:eq:), and neq with an empty value matches where it was (name:neq:). eq is exact equality. gt|gte|lt|lte require a numeric value. Names containing ':' cannot be expressed.
   */
  public ?array $dynamicVariableParams;

  /**
   * @var ?array $toolNames Filter conversations by tool names used during the call.
   */
  public ?array $toolNames;

  /**
   * @var ?array $toolNamesSuccessful Filter conversations by tool names that had successful calls.
   */
  public ?array $toolNamesSuccessful;

  /**
   * @var ?array $toolNamesErrored Filter conversations by tool names that had errored calls.
   */
  public ?array $toolNamesErrored;

  /**
   * @var ?array $toolIds Filter conversations by IDs of tools used during the call. Use '__system_<tool_name>' for system tools. Unlike tool_names, distinguishes between tools that share a name.
   */
  public ?array $toolIds;

  /**
   * @var ?array $toolIdsSuccessful Filter conversations by IDs of tools that had successful calls.
   */
  public ?array $toolIdsSuccessful;

  /**
   * @var ?array $toolIdsErrored Filter conversations by IDs of tools that had errored calls.
   */
  public ?array $toolIdsErrored;

  /**
   * @var ?bool $includeInvalidToolCalls Also match tool calls that never ran.
   */
  public ?bool $includeInvalidToolCalls;

  /**
   * @var ?array $mainLanguages Filter conversations by detected main language (language code).
   */
  public ?array $mainLanguages;

  /**
   * @var ?array $phoneNumberIds Filter conversations by agent phone number IDs.
   */
  public ?array $phoneNumberIds;

  /**
   * @var ?array $whatsappPhoneNumberIds Filter conversations by agent WhatsApp number IDs.
   */
  public ?array $whatsappPhoneNumberIds;

  /**
   * @var ?array $excludeStatuses Exclude conversations with the given statuses. Useful for hiding in-progress / processing conversations from list views.
   */
  public ?array $excludeStatuses;

  /**
   * @var ?array $terminationReasons Filter conversations by their stored termination_reason (metadata.termination_reason). Repeat param to match any of several.
   */
  public ?array $terminationReasons;

  /**
   * @var ?int $pageSize Number of results per page. Max 50.
   */
  public ?int $pageSize;

  /**
   * @var ?value-of<TextSearchMessagesRequestSummaryMode> $summaryMode Whether to include transcript summaries in the response.
   */
  public ?string $summaryMode;

  /**
   * @var ?value-of<ConversationInitiationSource> $conversationInitiationSource
   */
  public ?string $conversationInitiationSource;

  /**
   * @var ?bool $textOnly
   */
  public ?bool $textOnly;

  /**
   * @var ?value-of<ConversationProduct> $conversationProductType Restrict results to a single conversation product surface.
   */
  public ?string $conversationProductType;

  /**
   * @var ?string $branchId Filter conversations by branch ID.
   */
  public ?string $branchId;

  /**
   * @var ?string $versionId Filter conversations by version ID.
   */
  public ?string $versionId;

  /**
   * @var ?array $topicIds Filter conversations by topic IDs assigned during topic discovery.
   */
  public ?array $topicIds;

  /**
   * @var ?value-of<MessageSearchSortBy> $sortBy Sort order for search results. 'search_score' sorts by search score, 'created_at' sorts by conversation start time.
   */
  public ?string $sortBy;

  /**
   * @var ?string $cursor Used for fetching next page. Cursor is returned in the response.
   */
  public ?string $cursor;

  /**
   * @param array{
   *   textQuery: string,
   *   agentId?: ?string,
   *   visitedAgentIds?: ?array,
   *   visitedAgentBranchIds?: ?array,
   *   triggeredProcedureIds?: ?array,
   *   callSuccessful?: ?value-of<EvaluationResultFilter>,
   *   callStartBeforeUnix?: ?int,
   *   callStartAfterUnix?: ?int,
   *   callDurationMinSecs?: ?int,
   *   callDurationMaxSecs?: ?int,
   *   ratingMax?: ?int,
   *   ratingMin?: ?int,
   *   hasFeedbackComment?: ?bool,
   *   userId?: ?string,
   *   evaluationParams?: ?array,
   *   dataCollectionParams?: ?array,
   *   dynamicVariableParams?: ?array,
   *   toolNames?: ?array,
   *   toolNamesSuccessful?: ?array,
   *   toolNamesErrored?: ?array,
   *   toolIds?: ?array,
   *   toolIdsSuccessful?: ?array,
   *   toolIdsErrored?: ?array,
   *   includeInvalidToolCalls?: ?bool,
   *   mainLanguages?: ?array,
   *   phoneNumberIds?: ?array,
   *   whatsappPhoneNumberIds?: ?array,
   *   excludeStatuses?: ?array,
   *   terminationReasons?: ?array,
   *   pageSize?: ?int,
   *   summaryMode?: ?value-of<TextSearchMessagesRequestSummaryMode>,
   *   conversationInitiationSource?: ?value-of<ConversationInitiationSource>,
   *   textOnly?: ?bool,
   *   conversationProductType?: ?value-of<ConversationProduct>,
   *   branchId?: ?string,
   *   versionId?: ?string,
   *   topicIds?: ?array,
   *   sortBy?: ?value-of<MessageSearchSortBy>,
   *   cursor?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->textQuery = $values['textQuery'];
    $this->agentId = $values['agentId'] ?? null;
    $this->visitedAgentIds = $values['visitedAgentIds'] ?? null;
    $this->visitedAgentBranchIds = $values['visitedAgentBranchIds'] ?? null;
    $this->triggeredProcedureIds = $values['triggeredProcedureIds'] ?? null;
    $this->callSuccessful = $values['callSuccessful'] ?? null;
    $this->callStartBeforeUnix = $values['callStartBeforeUnix'] ?? null;
    $this->callStartAfterUnix = $values['callStartAfterUnix'] ?? null;
    $this->callDurationMinSecs = $values['callDurationMinSecs'] ?? null;
    $this->callDurationMaxSecs = $values['callDurationMaxSecs'] ?? null;
    $this->ratingMax = $values['ratingMax'] ?? null;
    $this->ratingMin = $values['ratingMin'] ?? null;
    $this->hasFeedbackComment = $values['hasFeedbackComment'] ?? null;
    $this->userId = $values['userId'] ?? null;
    $this->evaluationParams = $values['evaluationParams'] ?? null;
    $this->dataCollectionParams = $values['dataCollectionParams'] ?? null;
    $this->dynamicVariableParams = $values['dynamicVariableParams'] ?? null;
    $this->toolNames = $values['toolNames'] ?? null;
    $this->toolNamesSuccessful = $values['toolNamesSuccessful'] ?? null;
    $this->toolNamesErrored = $values['toolNamesErrored'] ?? null;
    $this->toolIds = $values['toolIds'] ?? null;
    $this->toolIdsSuccessful = $values['toolIdsSuccessful'] ?? null;
    $this->toolIdsErrored = $values['toolIdsErrored'] ?? null;
    $this->includeInvalidToolCalls = $values['includeInvalidToolCalls'] ?? null;
    $this->mainLanguages = $values['mainLanguages'] ?? null;
    $this->phoneNumberIds = $values['phoneNumberIds'] ?? null;
    $this->whatsappPhoneNumberIds = $values['whatsappPhoneNumberIds'] ?? null;
    $this->excludeStatuses = $values['excludeStatuses'] ?? null;
    $this->terminationReasons = $values['terminationReasons'] ?? null;
    $this->pageSize = $values['pageSize'] ?? null;
    $this->summaryMode = $values['summaryMode'] ?? null;
    $this->conversationInitiationSource = $values['conversationInitiationSource'] ?? null;
    $this->textOnly = $values['textOnly'] ?? null;
    $this->conversationProductType = $values['conversationProductType'] ?? null;
    $this->branchId = $values['branchId'] ?? null;
    $this->versionId = $values['versionId'] ?? null;
    $this->topicIds = $values['topicIds'] ?? null;
    $this->sortBy = $values['sortBy'] ?? null;
    $this->cursor = $values['cursor'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'textQuery' => $data['text_query'],
      'agentId' => $data['agent_id'] ?? null,
      'visitedAgentIds' => $data['visited_agent_ids'] ?? null,
      'visitedAgentBranchIds' => $data['visited_agent_branch_ids'] ?? null,
      'triggeredProcedureIds' => $data['triggered_procedure_ids'] ?? null,
      'callSuccessful' => $data['call_successful'] ?? null,
      'callStartBeforeUnix' => $data['call_start_before_unix'] ?? null,
      'callStartAfterUnix' => $data['call_start_after_unix'] ?? null,
      'callDurationMinSecs' => $data['call_duration_min_secs'] ?? null,
      'callDurationMaxSecs' => $data['call_duration_max_secs'] ?? null,
      'ratingMax' => $data['rating_max'] ?? null,
      'ratingMin' => $data['rating_min'] ?? null,
      'hasFeedbackComment' => $data['has_feedback_comment'] ?? null,
      'userId' => $data['user_id'] ?? null,
      'evaluationParams' => $data['evaluation_params'] ?? null,
      'dataCollectionParams' => $data['data_collection_params'] ?? null,
      'dynamicVariableParams' => $data['dynamic_variable_params'] ?? null,
      'toolNames' => $data['tool_names'] ?? null,
      'toolNamesSuccessful' => $data['tool_names_successful'] ?? null,
      'toolNamesErrored' => $data['tool_names_errored'] ?? null,
      'toolIds' => $data['tool_ids'] ?? null,
      'toolIdsSuccessful' => $data['tool_ids_successful'] ?? null,
      'toolIdsErrored' => $data['tool_ids_errored'] ?? null,
      'includeInvalidToolCalls' => $data['include_invalid_tool_calls'] ?? null,
      'mainLanguages' => $data['main_languages'] ?? null,
      'phoneNumberIds' => $data['phone_number_ids'] ?? null,
      'whatsappPhoneNumberIds' => $data['whatsapp_phone_number_ids'] ?? null,
      'excludeStatuses' => $data['exclude_statuses'] ?? null,
      'terminationReasons' => $data['termination_reasons'] ?? null,
      'pageSize' => $data['page_size'] ?? null,
      'summaryMode' => $data['summary_mode'] ?? null,
      'conversationInitiationSource' => $data['conversation_initiation_source'] ?? null,
      'textOnly' => $data['text_only'] ?? null,
      'conversationProductType' => $data['conversation_product_type'] ?? null,
      'branchId' => $data['branch_id'] ?? null,
      'versionId' => $data['version_id'] ?? null,
      'topicIds' => $data['topic_ids'] ?? null,
      'sortBy' => $data['sort_by'] ?? null,
      'cursor' => $data['cursor'] ?? null
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    $result['text_query'] = $this->textQuery;
    if ($this->agentId !== null) {
      $result['agent_id'] = $this->agentId;
    }
    if ($this->visitedAgentIds !== null) {
      $result['visited_agent_ids'] = $this->visitedAgentIds;
    }
    if ($this->visitedAgentBranchIds !== null) {
      $result['visited_agent_branch_ids'] = $this->visitedAgentBranchIds;
    }
    if ($this->triggeredProcedureIds !== null) {
      $result['triggered_procedure_ids'] = $this->triggeredProcedureIds;
    }
    if ($this->callSuccessful !== null) {
      $result['call_successful'] = $this->callSuccessful;
    }
    if ($this->callStartBeforeUnix !== null) {
      $result['call_start_before_unix'] = $this->callStartBeforeUnix;
    }
    if ($this->callStartAfterUnix !== null) {
      $result['call_start_after_unix'] = $this->callStartAfterUnix;
    }
    if ($this->callDurationMinSecs !== null) {
      $result['call_duration_min_secs'] = $this->callDurationMinSecs;
    }
    if ($this->callDurationMaxSecs !== null) {
      $result['call_duration_max_secs'] = $this->callDurationMaxSecs;
    }
    if ($this->ratingMax !== null) {
      $result['rating_max'] = $this->ratingMax;
    }
    if ($this->ratingMin !== null) {
      $result['rating_min'] = $this->ratingMin;
    }
    if ($this->hasFeedbackComment !== null) {
      $result['has_feedback_comment'] = $this->hasFeedbackComment;
    }
    if ($this->userId !== null) {
      $result['user_id'] = $this->userId;
    }
    if ($this->evaluationParams !== null) {
      $result['evaluation_params'] = $this->evaluationParams;
    }
    if ($this->dataCollectionParams !== null) {
      $result['data_collection_params'] = $this->dataCollectionParams;
    }
    if ($this->dynamicVariableParams !== null) {
      $result['dynamic_variable_params'] = $this->dynamicVariableParams;
    }
    if ($this->toolNames !== null) {
      $result['tool_names'] = $this->toolNames;
    }
    if ($this->toolNamesSuccessful !== null) {
      $result['tool_names_successful'] = $this->toolNamesSuccessful;
    }
    if ($this->toolNamesErrored !== null) {
      $result['tool_names_errored'] = $this->toolNamesErrored;
    }
    if ($this->toolIds !== null) {
      $result['tool_ids'] = $this->toolIds;
    }
    if ($this->toolIdsSuccessful !== null) {
      $result['tool_ids_successful'] = $this->toolIdsSuccessful;
    }
    if ($this->toolIdsErrored !== null) {
      $result['tool_ids_errored'] = $this->toolIdsErrored;
    }
    if ($this->includeInvalidToolCalls !== null) {
      $result['include_invalid_tool_calls'] = $this->includeInvalidToolCalls;
    }
    if ($this->mainLanguages !== null) {
      $result['main_languages'] = $this->mainLanguages;
    }
    if ($this->phoneNumberIds !== null) {
      $result['phone_number_ids'] = $this->phoneNumberIds;
    }
    if ($this->whatsappPhoneNumberIds !== null) {
      $result['whatsapp_phone_number_ids'] = $this->whatsappPhoneNumberIds;
    }
    if ($this->excludeStatuses !== null) {
      $result['exclude_statuses'] = $this->excludeStatuses;
    }
    if ($this->terminationReasons !== null) {
      $result['termination_reasons'] = $this->terminationReasons;
    }
    if ($this->pageSize !== null) {
      $result['page_size'] = $this->pageSize;
    }
    if ($this->summaryMode !== null) {
      $result['summary_mode'] = $this->summaryMode;
    }
    if ($this->conversationInitiationSource !== null) {
      $result['conversation_initiation_source'] = $this->conversationInitiationSource;
    }
    if ($this->textOnly !== null) {
      $result['text_only'] = $this->textOnly;
    }
    if ($this->conversationProductType !== null) {
      $result['conversation_product_type'] = $this->conversationProductType;
    }
    if ($this->branchId !== null) {
      $result['branch_id'] = $this->branchId;
    }
    if ($this->versionId !== null) {
      $result['version_id'] = $this->versionId;
    }
    if ($this->topicIds !== null) {
      $result['topic_ids'] = $this->topicIds;
    }
    if ($this->sortBy !== null) {
      $result['sort_by'] = $this->sortBy;
    }
    if ($this->cursor !== null) {
      $result['cursor'] = $this->cursor;
    }
    return $result;
  }
}
