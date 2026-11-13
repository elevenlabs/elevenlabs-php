<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ConversationSummaryResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('agent_id', required: true)]
  public string $agentId;

  #[JsonProperty('branch_id')]
  public ?string $branchId;

  #[JsonProperty('version_id')]
  public ?string $versionId;

  #[JsonProperty('agent_name')]
  public ?string $agentName;

  #[JsonProperty('conversation_id', required: true)]
  public string $conversationId;

  #[JsonProperty('start_time_unix_secs', required: true)]
  public int $startTimeUnixSecs;

  #[JsonProperty('call_duration_secs', required: true)]
  public int $callDurationSecs;

  /**
   * Total cost of the conversation in credits.
   */
  #[JsonProperty('cost')]
  public ?int $cost;

  /**
   * Total fiat cost of the conversation in USD. `None` for conversations that predate fiat cost tracking.
   */
  #[JsonProperty('cost_fiat')]
  public ?float $costFiat;

  /**
   * Number of transcript turns with text; tool-only turns are not counted.
   */
  #[JsonProperty('message_count', required: true)]
  public int $messageCount;

  /**
   * Number of user transcript turns with text; tool-only turns are not counted. `null` for older conversations before this field whose transcript was deleted.
   */
  #[JsonProperty('user_message_count')]
  public ?int $userMessageCount;

  /**
   * Number of agent transcript turns with text; tool-only turns are not counted. `null` for older conversations before this field whose transcript was deleted.
   */
  #[JsonProperty('agent_message_count')]
  public ?int $agentMessageCount;

  /**
   * @var value-of<\ElevenLabs\Types\ConversationSummaryResponseModelStatus>
   */
  #[JsonProperty('status', required: true)]
  public string $status;

  #[JsonProperty('termination_reason')]
  public ?string $terminationReason;

  /**
   * @var value-of<\ElevenLabs\Types\EvaluationSuccessResult>
   */
  #[JsonProperty('call_successful', required: true)]
  public string $callSuccessful;

  #[JsonProperty('call_success_score')]
  public ?float $callSuccessScore;

  #[JsonProperty('transcript_summary')]
  public ?string $transcriptSummary;

  #[JsonProperty('call_summary_title')]
  public ?string $callSummaryTitle;

  #[JsonProperty('main_language')]
  public ?string $mainLanguage;

  /**
   * @var ?value-of<\ElevenLabs\Types\ConversationInitiationSource>
   */
  #[JsonProperty('conversation_initiation_source')]
  public ?string $conversationInitiationSource;

  /**
   * @var string[]|null
   */
  #[JsonProperty('tool_names'), ArrayType(['string'])]
  public ?array $toolNames;

  /**
   * @var ?value-of<\ElevenLabs\Types\TelephonyDirection>
   */
  #[JsonProperty('direction')]
  public ?string $direction;

  #[JsonProperty('rating')]
  public ?float $rating;

  #[JsonProperty('sentiment_analysis')]
  public ?\ElevenLabs\Types\ConversationSentimentAnalysis $sentimentAnalysis;

  /**
   * @var array<string, mixed>|null
   */
  #[JsonProperty('data_collection_results'), ArrayType(['string' => 'mixed'])]
  public ?array $dataCollectionResults;

  /**
   * @var array<string, \ElevenLabs\Types\EvaluationCriteriaSummaryResult>|null
   */
  #[
    JsonProperty('evaluation_criteria_results'),
    ArrayType(['string' => \ElevenLabs\Types\EvaluationCriteriaSummaryResult::class])
  ]
  public ?array $evaluationCriteriaResults;

  /**
   * @var string[]|null
   * Conversation tag ids assigned to this conversation.
   */
  #[JsonProperty('tag_ids'), ArrayType(['string'])]
  public ?array $tagIds;

  /**
   * @param array{
   *   agentId: string,
   *   conversationId: string,
   *   startTimeUnixSecs: int,
   *   callDurationSecs: int,
   *   messageCount: int,
   *   status: value-of<\ElevenLabs\Types\ConversationSummaryResponseModelStatus>,
   *   callSuccessful: value-of<\ElevenLabs\Types\EvaluationSuccessResult>,
   *   branchId?: ?string,
   *   versionId?: ?string,
   *   agentName?: ?string,
   *   cost?: ?int,
   *   costFiat?: ?float,
   *   userMessageCount?: ?int,
   *   agentMessageCount?: ?int,
   *   terminationReason?: ?string,
   *   callSuccessScore?: ?float,
   *   transcriptSummary?: ?string,
   *   callSummaryTitle?: ?string,
   *   mainLanguage?: ?string,
   *   conversationInitiationSource?: ?value-of<\ElevenLabs\Types\ConversationInitiationSource>,
   *   toolNames?: string[]|null,
   *   direction?: ?value-of<\ElevenLabs\Types\TelephonyDirection>,
   *   rating?: ?float,
   *   sentimentAnalysis?: ?\ElevenLabs\Types\ConversationSentimentAnalysis,
   *   dataCollectionResults?: array<string, mixed>|null,
   *   evaluationCriteriaResults?: array<string, \ElevenLabs\Types\EvaluationCriteriaSummaryResult>|null,
   *   tagIds?: string[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->agentId = $values['agentId'];
    $this->branchId = $values['branchId'] ?? null;
    $this->versionId = $values['versionId'] ?? null;
    $this->agentName = $values['agentName'] ?? null;
    $this->conversationId = $values['conversationId'];
    $this->startTimeUnixSecs = $values['startTimeUnixSecs'];
    $this->callDurationSecs = $values['callDurationSecs'];
    $this->cost = $values['cost'] ?? null;
    $this->costFiat = $values['costFiat'] ?? null;
    $this->messageCount = $values['messageCount'];
    $this->userMessageCount = $values['userMessageCount'] ?? null;
    $this->agentMessageCount = $values['agentMessageCount'] ?? null;
    $this->status = $values['status'];
    $this->terminationReason = $values['terminationReason'] ?? null;
    $this->callSuccessful = $values['callSuccessful'];
    $this->callSuccessScore = $values['callSuccessScore'] ?? null;
    $this->transcriptSummary = $values['transcriptSummary'] ?? null;
    $this->callSummaryTitle = $values['callSummaryTitle'] ?? null;
    $this->mainLanguage = $values['mainLanguage'] ?? null;
    $this->conversationInitiationSource = $values['conversationInitiationSource'] ?? null;
    $this->toolNames = $values['toolNames'] ?? null;
    $this->direction = $values['direction'] ?? null;
    $this->rating = $values['rating'] ?? null;
    $this->sentimentAnalysis = $values['sentimentAnalysis'] ?? null;
    $this->dataCollectionResults = $values['dataCollectionResults'] ?? null;
    $this->evaluationCriteriaResults = $values['evaluationCriteriaResults'] ?? null;
    $this->tagIds = $values['tagIds'] ?? null;

    $this->_dirtyFields = [
      'agent_id' => true,
      'conversation_id' => true,
      'start_time_unix_secs' => true,
      'call_duration_secs' => true,
      'message_count' => true,
      'status' => true,
      'call_successful' => true
    ];
    if (array_key_exists('branchId', $values)) {
      $this->_dirtyFields['branch_id'] = true;
    }
    if (array_key_exists('versionId', $values)) {
      $this->_dirtyFields['version_id'] = true;
    }
    if (array_key_exists('agentName', $values)) {
      $this->_dirtyFields['agent_name'] = true;
    }
    if (array_key_exists('cost', $values)) {
      $this->_dirtyFields['cost'] = true;
    }
    if (array_key_exists('costFiat', $values)) {
      $this->_dirtyFields['cost_fiat'] = true;
    }
    if (array_key_exists('userMessageCount', $values)) {
      $this->_dirtyFields['user_message_count'] = true;
    }
    if (array_key_exists('agentMessageCount', $values)) {
      $this->_dirtyFields['agent_message_count'] = true;
    }
    if (array_key_exists('terminationReason', $values)) {
      $this->_dirtyFields['termination_reason'] = true;
    }
    if (array_key_exists('callSuccessScore', $values)) {
      $this->_dirtyFields['call_success_score'] = true;
    }
    if (array_key_exists('transcriptSummary', $values)) {
      $this->_dirtyFields['transcript_summary'] = true;
    }
    if (array_key_exists('callSummaryTitle', $values)) {
      $this->_dirtyFields['call_summary_title'] = true;
    }
    if (array_key_exists('mainLanguage', $values)) {
      $this->_dirtyFields['main_language'] = true;
    }
    if (array_key_exists('conversationInitiationSource', $values)) {
      $this->_dirtyFields['conversation_initiation_source'] = true;
    }
    if (array_key_exists('toolNames', $values)) {
      $this->_dirtyFields['tool_names'] = true;
    }
    if (array_key_exists('direction', $values)) {
      $this->_dirtyFields['direction'] = true;
    }
    if (array_key_exists('rating', $values)) {
      $this->_dirtyFields['rating'] = true;
    }
    if (array_key_exists('sentimentAnalysis', $values)) {
      $this->_dirtyFields['sentiment_analysis'] = true;
    }
    if (array_key_exists('dataCollectionResults', $values)) {
      $this->_dirtyFields['data_collection_results'] = true;
    }
    if (array_key_exists('evaluationCriteriaResults', $values)) {
      $this->_dirtyFields['evaluation_criteria_results'] = true;
    }
    if (array_key_exists('tagIds', $values)) {
      $this->_dirtyFields['tag_ids'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'agent_id',
      'contents' => $this->agentId
    ];

    if ($this->branchId !== null) {
      $parts[] = [
        'name' => 'branch_id',
        'contents' => $this->branchId
      ];
    }

    if ($this->versionId !== null) {
      $parts[] = [
        'name' => 'version_id',
        'contents' => $this->versionId
      ];
    }

    if ($this->agentName !== null) {
      $parts[] = [
        'name' => 'agent_name',
        'contents' => $this->agentName
      ];
    }

    $parts[] = [
      'name' => 'conversation_id',
      'contents' => $this->conversationId
    ];

    $parts[] = [
      'name' => 'start_time_unix_secs',
      'contents' => (string) $this->startTimeUnixSecs
    ];

    $parts[] = [
      'name' => 'call_duration_secs',
      'contents' => (string) $this->callDurationSecs
    ];

    if ($this->cost !== null) {
      $parts[] = [
        'name' => 'cost',
        'contents' => (string) $this->cost
      ];
    }

    if ($this->costFiat !== null) {
      $parts[] = [
        'name' => 'cost_fiat',
        'contents' => (string) $this->costFiat
      ];
    }

    $parts[] = [
      'name' => 'message_count',
      'contents' => (string) $this->messageCount
    ];

    if ($this->userMessageCount !== null) {
      $parts[] = [
        'name' => 'user_message_count',
        'contents' => (string) $this->userMessageCount
      ];
    }

    if ($this->agentMessageCount !== null) {
      $parts[] = [
        'name' => 'agent_message_count',
        'contents' => (string) $this->agentMessageCount
      ];
    }

    $parts[] = [
      'name' => 'status',
      'contents' => $this->status
    ];

    if ($this->terminationReason !== null) {
      $parts[] = [
        'name' => 'termination_reason',
        'contents' => $this->terminationReason
      ];
    }

    $parts[] = [
      'name' => 'call_successful',
      'contents' => $this->callSuccessful
    ];

    if ($this->callSuccessScore !== null) {
      $parts[] = [
        'name' => 'call_success_score',
        'contents' => (string) $this->callSuccessScore
      ];
    }

    if ($this->transcriptSummary !== null) {
      $parts[] = [
        'name' => 'transcript_summary',
        'contents' => $this->transcriptSummary
      ];
    }

    if ($this->callSummaryTitle !== null) {
      $parts[] = [
        'name' => 'call_summary_title',
        'contents' => $this->callSummaryTitle
      ];
    }

    if ($this->mainLanguage !== null) {
      $parts[] = [
        'name' => 'main_language',
        'contents' => $this->mainLanguage
      ];
    }

    if ($this->conversationInitiationSource !== null) {
      $parts[] = [
        'name' => 'conversation_initiation_source',
        'contents' => $this->conversationInitiationSource
      ];
    }

    if ($this->toolNames !== null) {
      foreach ($this->toolNames ?? [] as $item) {
        $parts[] = [
          'name' => 'tool_names',
          'contents' => $item
        ];
      }
    }

    if ($this->direction !== null) {
      $parts[] = [
        'name' => 'direction',
        'contents' => $this->direction
      ];
    }

    if ($this->rating !== null) {
      $parts[] = [
        'name' => 'rating',
        'contents' => (string) $this->rating
      ];
    }

    if ($this->sentimentAnalysis !== null) {
      $parts[] = [
        'name' => 'sentiment_analysis',
        'contents' => json_encode($this->sentimentAnalysis),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->dataCollectionResults !== null) {
      $parts[] = [
        'name' => 'data_collection_results',
        'contents' => json_encode($this->dataCollectionResults),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->evaluationCriteriaResults !== null) {
      $parts[] = [
        'name' => 'evaluation_criteria_results',
        'contents' => json_encode($this->evaluationCriteriaResults),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->tagIds !== null) {
      foreach ($this->tagIds ?? [] as $item) {
        $parts[] = [
          'name' => 'tag_ids',
          'contents' => $item
        ];
      }
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->sentimentAnalysis?->validate();
  }
}
