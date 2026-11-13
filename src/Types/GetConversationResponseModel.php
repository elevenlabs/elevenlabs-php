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
class GetConversationResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('agent_id', required: true)]
  public string $agentId;

  #[JsonProperty('agent_name')]
  public ?string $agentName;

  #[JsonProperty('conversation_product')]
  public ?string $conversationProduct;

  /**
   * @var value-of<\ElevenLabs\Types\GetConversationResponseModelStatus>
   */
  #[JsonProperty('status', required: true)]
  public string $status;

  #[JsonProperty('user_id')]
  public ?string $userId;

  #[JsonProperty('branch_id')]
  public ?string $branchId;

  /**
   * The ID of the agent version used for this conversation
   */
  #[JsonProperty('version_id')]
  public ?string $versionId;

  #[JsonProperty('metadata', required: true)]
  public \ElevenLabs\Types\ConversationHistoryMetadataCommonModel $metadata;

  #[JsonProperty('analysis')]
  public ?\ElevenLabs\Types\ConversationHistoryAnalysisCommonModel $analysis;

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
   * @var \ElevenLabs\Types\VisitedAgentRef[]|null
   */
  #[JsonProperty('visited_agents'), ArrayType([\ElevenLabs\Types\VisitedAgentRef::class])]
  public ?array $visitedAgents;

  #[JsonProperty('conversation_initiation_client_data')]
  public ?\ElevenLabs\Types\ConversationInitiationClientDataRequestOutput $conversationInitiationClientData;

  #[JsonProperty('environment')]
  public ?string $environment;

  #[JsonProperty('conversation_id', required: true)]
  public string $conversationId;

  #[JsonProperty('has_audio', required: true)]
  public bool $hasAudio;

  #[JsonProperty('has_user_audio', required: true)]
  public bool $hasUserAudio;

  #[JsonProperty('has_response_audio', required: true)]
  public bool $hasResponseAudio;

  #[JsonProperty('has_auxiliary_audio', required: true)]
  public bool $hasAuxiliaryAudio;

  /**
   * @var \ElevenLabs\Types\ConversationHistoryTranscriptResponseModel[]
   */
  #[
    JsonProperty('transcript', required: true),
    ArrayType([\ElevenLabs\Types\ConversationHistoryTranscriptResponseModel::class])
  ]
  public array $transcript;

  /**
   * @var string[]|null
   * Conversation tag ids assigned to this conversation.
   */
  #[JsonProperty('tag_ids'), ArrayType(['string'])]
  public ?array $tagIds;

  /**
   * @var array<string, mixed>|null
   * OpenTelemetry trace payload when the request uses format=opentelemetry; otherwise omitted.
   */
  #[JsonProperty('otlp_traces'), ArrayType(['string' => 'mixed'])]
  public ?array $otlpTraces;

  /**
   * @param array{
   *   agentId: string,
   *   status: value-of<\ElevenLabs\Types\GetConversationResponseModelStatus>,
   *   metadata: \ElevenLabs\Types\ConversationHistoryMetadataCommonModel,
   *   conversationId: string,
   *   hasAudio: bool,
   *   hasUserAudio: bool,
   *   hasResponseAudio: bool,
   *   hasAuxiliaryAudio: bool,
   *   transcript: \ElevenLabs\Types\ConversationHistoryTranscriptResponseModel[],
   *   agentName?: ?string,
   *   conversationProduct?: ?string,
   *   userId?: ?string,
   *   branchId?: ?string,
   *   versionId?: ?string,
   *   analysis?: ?\ElevenLabs\Types\ConversationHistoryAnalysisCommonModel,
   *   userMessageCount?: ?int,
   *   agentMessageCount?: ?int,
   *   visitedAgents?: \ElevenLabs\Types\VisitedAgentRef[]|null,
   *   conversationInitiationClientData?: ?\ElevenLabs\Types\ConversationInitiationClientDataRequestOutput,
   *   environment?: ?string,
   *   tagIds?: string[]|null,
   *   otlpTraces?: array<string, mixed>|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->agentId = $values['agentId'];
    $this->agentName = $values['agentName'] ?? null;
    $this->conversationProduct = $values['conversationProduct'] ?? null;
    $this->status = $values['status'];
    $this->userId = $values['userId'] ?? null;
    $this->branchId = $values['branchId'] ?? null;
    $this->versionId = $values['versionId'] ?? null;
    $this->metadata = $values['metadata'];
    $this->analysis = $values['analysis'] ?? null;
    $this->userMessageCount = $values['userMessageCount'] ?? null;
    $this->agentMessageCount = $values['agentMessageCount'] ?? null;
    $this->visitedAgents = $values['visitedAgents'] ?? null;
    $this->conversationInitiationClientData = $values['conversationInitiationClientData'] ?? null;
    $this->environment = $values['environment'] ?? null;
    $this->conversationId = $values['conversationId'];
    $this->hasAudio = $values['hasAudio'];
    $this->hasUserAudio = $values['hasUserAudio'];
    $this->hasResponseAudio = $values['hasResponseAudio'];
    $this->hasAuxiliaryAudio = $values['hasAuxiliaryAudio'];
    $this->transcript = $values['transcript'];
    $this->tagIds = $values['tagIds'] ?? null;
    $this->otlpTraces = $values['otlpTraces'] ?? null;

    $this->_dirtyFields = [
      'agent_id' => true,
      'status' => true,
      'metadata' => true,
      'conversation_id' => true,
      'has_audio' => true,
      'has_user_audio' => true,
      'has_response_audio' => true,
      'has_auxiliary_audio' => true,
      'transcript' => true
    ];
    if (array_key_exists('agentName', $values)) {
      $this->_dirtyFields['agent_name'] = true;
    }
    if (array_key_exists('conversationProduct', $values)) {
      $this->_dirtyFields['conversation_product'] = true;
    }
    if (array_key_exists('userId', $values)) {
      $this->_dirtyFields['user_id'] = true;
    }
    if (array_key_exists('branchId', $values)) {
      $this->_dirtyFields['branch_id'] = true;
    }
    if (array_key_exists('versionId', $values)) {
      $this->_dirtyFields['version_id'] = true;
    }
    if (array_key_exists('analysis', $values)) {
      $this->_dirtyFields['analysis'] = true;
    }
    if (array_key_exists('userMessageCount', $values)) {
      $this->_dirtyFields['user_message_count'] = true;
    }
    if (array_key_exists('agentMessageCount', $values)) {
      $this->_dirtyFields['agent_message_count'] = true;
    }
    if (array_key_exists('visitedAgents', $values)) {
      $this->_dirtyFields['visited_agents'] = true;
    }
    if (array_key_exists('conversationInitiationClientData', $values)) {
      $this->_dirtyFields['conversation_initiation_client_data'] = true;
    }
    if (array_key_exists('environment', $values)) {
      $this->_dirtyFields['environment'] = true;
    }
    if (array_key_exists('tagIds', $values)) {
      $this->_dirtyFields['tag_ids'] = true;
    }
    if (array_key_exists('otlpTraces', $values)) {
      $this->_dirtyFields['otlp_traces'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'agent_id',
      'contents' => $this->agentId
    ];

    if ($this->agentName !== null) {
      $parts[] = [
        'name' => 'agent_name',
        'contents' => $this->agentName
      ];
    }

    if ($this->conversationProduct !== null) {
      $parts[] = [
        'name' => 'conversation_product',
        'contents' => $this->conversationProduct
      ];
    }

    $parts[] = [
      'name' => 'status',
      'contents' => $this->status
    ];

    if ($this->userId !== null) {
      $parts[] = [
        'name' => 'user_id',
        'contents' => $this->userId
      ];
    }

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

    $parts[] = [
      'name' => 'metadata',
      'contents' => json_encode($this->metadata),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->analysis !== null) {
      $parts[] = [
        'name' => 'analysis',
        'contents' => json_encode($this->analysis),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

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

    if ($this->visitedAgents !== null) {
      $parts[] = [
        'name' => 'visited_agents',
        'contents' => json_encode($this->visitedAgents),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->conversationInitiationClientData !== null) {
      $parts[] = [
        'name' => 'conversation_initiation_client_data',
        'contents' => json_encode($this->conversationInitiationClientData),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->environment !== null) {
      $parts[] = [
        'name' => 'environment',
        'contents' => $this->environment
      ];
    }

    $parts[] = [
      'name' => 'conversation_id',
      'contents' => $this->conversationId
    ];

    $parts[] = [
      'name' => 'has_audio',
      'contents' => $this->hasAudio ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'has_user_audio',
      'contents' => $this->hasUserAudio ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'has_response_audio',
      'contents' => $this->hasResponseAudio ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'has_auxiliary_audio',
      'contents' => $this->hasAuxiliaryAudio ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'transcript',
      'contents' => json_encode($this->transcript),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->tagIds !== null) {
      foreach ($this->tagIds ?? [] as $item) {
        $parts[] = [
          'name' => 'tag_ids',
          'contents' => $item
        ];
      }
    }

    if ($this->otlpTraces !== null) {
      $parts[] = [
        'name' => 'otlp_traces',
        'contents' => json_encode($this->otlpTraces),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->metadata->validate();
    $this->analysis?->validate();
    foreach ($this->visitedAgents ?? [] as $item) {
      $item->validate();
    }
    $this->conversationInitiationClientData?->validate();
    foreach ($this->transcript as $item) {
      $item->validate();
    }
  }
}
