<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Core\Types\Union;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ConversationHistoryTranscriptCommonModelOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\ConversationHistoryTranscriptCommonModelOutputRole>
   */
  #[JsonProperty('role', required: true)]
  public string $role;

  #[JsonProperty('agent_metadata')]
  public ?\ElevenLabs\Types\AgentMetadata $agentMetadata;

  #[JsonProperty('message')]
  public ?string $message;

  #[JsonProperty('multivoice_message')]
  public ?\ElevenLabs\Types\ConversationHistoryMultivoiceMessageModel $multivoiceMessage;

  /**
   * @var \ElevenLabs\Types\ConversationHistoryTranscriptToolCallCommonModelOutput[]|null
   */
  #[
    JsonProperty('tool_calls'),
    ArrayType([\ElevenLabs\Types\ConversationHistoryTranscriptToolCallCommonModelOutput::class])
  ]
  public ?array $toolCalls;

  /**
   * @var (\ElevenLabs\Types\ConversationHistoryTranscriptOtherToolsResultCommonModel|\ElevenLabs\Types\ConversationHistoryTranscriptSystemToolResultCommonModelOutput|\ElevenLabs\Types\ConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelOutput|\ElevenLabs\Types\ConversationHistoryTranscriptWorkflowToolsResultCommonModelOutput)[]|null
   */
  #[
    JsonProperty('tool_results'),
    ArrayType([
      new Union(
        \ElevenLabs\Types\ConversationHistoryTranscriptOtherToolsResultCommonModel::class,
        \ElevenLabs\Types\ConversationHistoryTranscriptSystemToolResultCommonModelOutput::class,
        \ElevenLabs\Types\ConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelOutput::class,
        \ElevenLabs\Types\ConversationHistoryTranscriptWorkflowToolsResultCommonModelOutput::class
      )
    ])
  ]
  public ?array $toolResults;

  #[JsonProperty('feedback')]
  public ?\ElevenLabs\Types\UserFeedback $feedback;

  #[JsonProperty('llm_override')]
  public ?string $llmOverride;

  #[JsonProperty('producing_llm')]
  public ?string $producingLlm;

  #[JsonProperty('time_in_call_secs', required: true)]
  public int $timeInCallSecs;

  #[JsonProperty('conversation_turn_metrics')]
  public ?\ElevenLabs\Types\ConversationTurnMetrics $conversationTurnMetrics;

  #[JsonProperty('rag_retrieval_info')]
  public ?\ElevenLabs\Types\RagRetrievalInfo $ragRetrievalInfo;

  #[JsonProperty('llm_usage')]
  public ?\ElevenLabs\Types\LlmUsageOutput $llmUsage;

  #[JsonProperty('interrupted')]
  public ?bool $interrupted;

  #[JsonProperty('ignored_as_backchannel')]
  public ?bool $ignoredAsBackchannel;

  /**
   * @var ?value-of<\ElevenLabs\Types\TranscriptPlatformEvent>
   */
  #[JsonProperty('platform_event')]
  public ?string $platformEvent;

  #[JsonProperty('original_message')]
  public ?string $originalMessage;

  /**
   * @var \ElevenLabs\Types\ConversationReasoningModel[]|null
   */
  #[JsonProperty('reasoning'), ArrayType([\ElevenLabs\Types\ConversationReasoningModel::class])]
  public ?array $reasoning;

  /**
   * @var ?value-of<\ElevenLabs\Types\ChatSourceMedium>
   */
  #[JsonProperty('source_medium')]
  public ?string $sourceMedium;

  #[JsonProperty('source_event_id')]
  public ?int $sourceEventId;

  /**
   * @var string[]|null
   */
  #[JsonProperty('used_static_kb_document_ids'), ArrayType(['string'])]
  public ?array $usedStaticKbDocumentIds;

  #[JsonProperty('user_identifier')]
  public ?string $userIdentifier;

  #[JsonProperty('id')]
  public ?string $id;

  #[JsonProperty('created_at_unix_ms')]
  public ?int $createdAtUnixMs;

  /**
   * @var \ElevenLabs\Types\TriggeredGuardrailCommonModel[]|null
   */
  #[
    JsonProperty('triggered_guardrails'),
    ArrayType([\ElevenLabs\Types\TriggeredGuardrailCommonModel::class])
  ]
  public ?array $triggeredGuardrails;

  /**
   * @param array{
   *   role: value-of<\ElevenLabs\Types\ConversationHistoryTranscriptCommonModelOutputRole>,
   *   timeInCallSecs: int,
   *   agentMetadata?: ?\ElevenLabs\Types\AgentMetadata,
   *   message?: ?string,
   *   multivoiceMessage?: ?\ElevenLabs\Types\ConversationHistoryMultivoiceMessageModel,
   *   toolCalls?: \ElevenLabs\Types\ConversationHistoryTranscriptToolCallCommonModelOutput[]|null,
   *   toolResults?: (\ElevenLabs\Types\ConversationHistoryTranscriptOtherToolsResultCommonModel|\ElevenLabs\Types\ConversationHistoryTranscriptSystemToolResultCommonModelOutput|\ElevenLabs\Types\ConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelOutput|\ElevenLabs\Types\ConversationHistoryTranscriptWorkflowToolsResultCommonModelOutput)[]|null,
   *   feedback?: ?\ElevenLabs\Types\UserFeedback,
   *   llmOverride?: ?string,
   *   producingLlm?: ?string,
   *   conversationTurnMetrics?: ?\ElevenLabs\Types\ConversationTurnMetrics,
   *   ragRetrievalInfo?: ?\ElevenLabs\Types\RagRetrievalInfo,
   *   llmUsage?: ?\ElevenLabs\Types\LlmUsageOutput,
   *   interrupted?: ?bool,
   *   ignoredAsBackchannel?: ?bool,
   *   platformEvent?: ?value-of<\ElevenLabs\Types\TranscriptPlatformEvent>,
   *   originalMessage?: ?string,
   *   reasoning?: \ElevenLabs\Types\ConversationReasoningModel[]|null,
   *   sourceMedium?: ?value-of<\ElevenLabs\Types\ChatSourceMedium>,
   *   sourceEventId?: ?int,
   *   usedStaticKbDocumentIds?: string[]|null,
   *   userIdentifier?: ?string,
   *   id?: ?string,
   *   createdAtUnixMs?: ?int,
   *   triggeredGuardrails?: \ElevenLabs\Types\TriggeredGuardrailCommonModel[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->role = $values['role'];
    $this->agentMetadata = $values['agentMetadata'] ?? null;
    $this->message = $values['message'] ?? null;
    $this->multivoiceMessage = $values['multivoiceMessage'] ?? null;
    $this->toolCalls = $values['toolCalls'] ?? null;
    $this->toolResults = $values['toolResults'] ?? null;
    $this->feedback = $values['feedback'] ?? null;
    $this->llmOverride = $values['llmOverride'] ?? null;
    $this->producingLlm = $values['producingLlm'] ?? null;
    $this->timeInCallSecs = $values['timeInCallSecs'];
    $this->conversationTurnMetrics = $values['conversationTurnMetrics'] ?? null;
    $this->ragRetrievalInfo = $values['ragRetrievalInfo'] ?? null;
    $this->llmUsage = $values['llmUsage'] ?? null;
    $this->interrupted = $values['interrupted'] ?? null;
    $this->ignoredAsBackchannel = $values['ignoredAsBackchannel'] ?? null;
    $this->platformEvent = $values['platformEvent'] ?? null;
    $this->originalMessage = $values['originalMessage'] ?? null;
    $this->reasoning = $values['reasoning'] ?? null;
    $this->sourceMedium = $values['sourceMedium'] ?? null;
    $this->sourceEventId = $values['sourceEventId'] ?? null;
    $this->usedStaticKbDocumentIds = $values['usedStaticKbDocumentIds'] ?? null;
    $this->userIdentifier = $values['userIdentifier'] ?? null;
    $this->id = $values['id'] ?? null;
    $this->createdAtUnixMs = $values['createdAtUnixMs'] ?? null;
    $this->triggeredGuardrails = $values['triggeredGuardrails'] ?? null;

    $this->_dirtyFields = [
      'role' => true,
      'time_in_call_secs' => true
    ];
    if (array_key_exists('agentMetadata', $values)) {
      $this->_dirtyFields['agent_metadata'] = true;
    }
    if (array_key_exists('message', $values)) {
      $this->_dirtyFields['message'] = true;
    }
    if (array_key_exists('multivoiceMessage', $values)) {
      $this->_dirtyFields['multivoice_message'] = true;
    }
    if (array_key_exists('toolCalls', $values)) {
      $this->_dirtyFields['tool_calls'] = true;
    }
    if (array_key_exists('toolResults', $values)) {
      $this->_dirtyFields['tool_results'] = true;
    }
    if (array_key_exists('feedback', $values)) {
      $this->_dirtyFields['feedback'] = true;
    }
    if (array_key_exists('llmOverride', $values)) {
      $this->_dirtyFields['llm_override'] = true;
    }
    if (array_key_exists('producingLlm', $values)) {
      $this->_dirtyFields['producing_llm'] = true;
    }
    if (array_key_exists('conversationTurnMetrics', $values)) {
      $this->_dirtyFields['conversation_turn_metrics'] = true;
    }
    if (array_key_exists('ragRetrievalInfo', $values)) {
      $this->_dirtyFields['rag_retrieval_info'] = true;
    }
    if (array_key_exists('llmUsage', $values)) {
      $this->_dirtyFields['llm_usage'] = true;
    }
    if (array_key_exists('interrupted', $values)) {
      $this->_dirtyFields['interrupted'] = true;
    }
    if (array_key_exists('ignoredAsBackchannel', $values)) {
      $this->_dirtyFields['ignored_as_backchannel'] = true;
    }
    if (array_key_exists('platformEvent', $values)) {
      $this->_dirtyFields['platform_event'] = true;
    }
    if (array_key_exists('originalMessage', $values)) {
      $this->_dirtyFields['original_message'] = true;
    }
    if (array_key_exists('reasoning', $values)) {
      $this->_dirtyFields['reasoning'] = true;
    }
    if (array_key_exists('sourceMedium', $values)) {
      $this->_dirtyFields['source_medium'] = true;
    }
    if (array_key_exists('sourceEventId', $values)) {
      $this->_dirtyFields['source_event_id'] = true;
    }
    if (array_key_exists('usedStaticKbDocumentIds', $values)) {
      $this->_dirtyFields['used_static_kb_document_ids'] = true;
    }
    if (array_key_exists('userIdentifier', $values)) {
      $this->_dirtyFields['user_identifier'] = true;
    }
    if (array_key_exists('id', $values)) {
      $this->_dirtyFields['id'] = true;
    }
    if (array_key_exists('createdAtUnixMs', $values)) {
      $this->_dirtyFields['created_at_unix_ms'] = true;
    }
    if (array_key_exists('triggeredGuardrails', $values)) {
      $this->_dirtyFields['triggered_guardrails'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'role',
      'contents' => $this->role
    ];

    if ($this->agentMetadata !== null) {
      $parts[] = [
        'name' => 'agent_metadata',
        'contents' => json_encode($this->agentMetadata),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->message !== null) {
      $parts[] = [
        'name' => 'message',
        'contents' => $this->message
      ];
    }

    if ($this->multivoiceMessage !== null) {
      $parts[] = [
        'name' => 'multivoice_message',
        'contents' => json_encode($this->multivoiceMessage),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->toolCalls !== null) {
      $parts[] = [
        'name' => 'tool_calls',
        'contents' => json_encode($this->toolCalls),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->toolResults !== null) {
      $parts[] = [
        'name' => 'tool_results',
        'contents' => json_encode($this->toolResults),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->feedback !== null) {
      $parts[] = [
        'name' => 'feedback',
        'contents' => json_encode($this->feedback),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->llmOverride !== null) {
      $parts[] = [
        'name' => 'llm_override',
        'contents' => $this->llmOverride
      ];
    }

    if ($this->producingLlm !== null) {
      $parts[] = [
        'name' => 'producing_llm',
        'contents' => $this->producingLlm
      ];
    }

    $parts[] = [
      'name' => 'time_in_call_secs',
      'contents' => (string) $this->timeInCallSecs
    ];

    if ($this->conversationTurnMetrics !== null) {
      $parts[] = [
        'name' => 'conversation_turn_metrics',
        'contents' => json_encode($this->conversationTurnMetrics),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->ragRetrievalInfo !== null) {
      $parts[] = [
        'name' => 'rag_retrieval_info',
        'contents' => json_encode($this->ragRetrievalInfo),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->llmUsage !== null) {
      $parts[] = [
        'name' => 'llm_usage',
        'contents' => json_encode($this->llmUsage),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->interrupted !== null) {
      $parts[] = [
        'name' => 'interrupted',
        'contents' => $this->interrupted ? 'true' : 'false'
      ];
    }

    if ($this->ignoredAsBackchannel !== null) {
      $parts[] = [
        'name' => 'ignored_as_backchannel',
        'contents' => $this->ignoredAsBackchannel ? 'true' : 'false'
      ];
    }

    if ($this->platformEvent !== null) {
      $parts[] = [
        'name' => 'platform_event',
        'contents' => $this->platformEvent
      ];
    }

    if ($this->originalMessage !== null) {
      $parts[] = [
        'name' => 'original_message',
        'contents' => $this->originalMessage
      ];
    }

    if ($this->reasoning !== null) {
      $parts[] = [
        'name' => 'reasoning',
        'contents' => json_encode($this->reasoning),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->sourceMedium !== null) {
      $parts[] = [
        'name' => 'source_medium',
        'contents' => $this->sourceMedium
      ];
    }

    if ($this->sourceEventId !== null) {
      $parts[] = [
        'name' => 'source_event_id',
        'contents' => (string) $this->sourceEventId
      ];
    }

    if ($this->usedStaticKbDocumentIds !== null) {
      foreach ($this->usedStaticKbDocumentIds ?? [] as $item) {
        $parts[] = [
          'name' => 'used_static_kb_document_ids',
          'contents' => $item
        ];
      }
    }

    if ($this->userIdentifier !== null) {
      $parts[] = [
        'name' => 'user_identifier',
        'contents' => $this->userIdentifier
      ];
    }

    if ($this->id !== null) {
      $parts[] = [
        'name' => 'id',
        'contents' => $this->id
      ];
    }

    if ($this->createdAtUnixMs !== null) {
      $parts[] = [
        'name' => 'created_at_unix_ms',
        'contents' => (string) $this->createdAtUnixMs
      ];
    }

    if ($this->triggeredGuardrails !== null) {
      $parts[] = [
        'name' => 'triggered_guardrails',
        'contents' => json_encode($this->triggeredGuardrails),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->agentMetadata?->validate();
    $this->multivoiceMessage?->validate();
    foreach ($this->toolCalls ?? [] as $item) {
      $item->validate();
    }
    $this->feedback?->validate();
    $this->conversationTurnMetrics?->validate();
    $this->ragRetrievalInfo?->validate();
    $this->llmUsage?->validate();
    foreach ($this->reasoning ?? [] as $item) {
      $item->validate();
    }
    foreach ($this->triggeredGuardrails ?? [] as $item) {
      $item->validate();
    }
  }
}
