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
class GetAgentResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The ID of the agent
   */
  #[JsonProperty('agent_id', required: true)]
  public string $agentId;

  /**
   * The name of the agent
   */
  #[JsonProperty('name', required: true)]
  public string $name;

  #[JsonProperty('conversation_config', required: true)]
  public \ElevenLabs\Types\ConversationalConfig $conversationConfig;

  #[JsonProperty('metadata', required: true)]
  public \ElevenLabs\Types\AgentMetadataResponseModel $metadata;

  #[JsonProperty('platform_settings')]
  public ?\ElevenLabs\Types\AgentPlatformSettingsResponseModel $platformSettings;

  /**
   * @var \ElevenLabs\Types\GetAgentResponseModelPhoneNumbersItem[]|null
   * The phone numbers of the agent
   */
  #[
    JsonProperty('phone_numbers'),
    ArrayType([\ElevenLabs\Types\GetAgentResponseModelPhoneNumbersItem::class])
  ]
  public ?array $phoneNumbers;

  /**
   * @var \ElevenLabs\Types\GetWhatsAppAccountResponse[]|null
   * WhatsApp accounts assigned to the agent
   */
  #[
    JsonProperty('whatsapp_accounts'),
    ArrayType([\ElevenLabs\Types\GetWhatsAppAccountResponse::class])
  ]
  public ?array $whatsappAccounts;

  #[JsonProperty('workflow')]
  public ?\ElevenLabs\Types\AgentWorkflowResponseModel $workflow;

  /**
   * The access information of the agent for the user
   */
  #[JsonProperty('access_info')]
  public ?\ElevenLabs\Types\ResourceAccessInfo $accessInfo;

  /**
   * @var string[]|null
   * Agent tags used to categorize the agent
   */
  #[JsonProperty('tags'), ArrayType(['string'])]
  public ?array $tags;

  /**
   * The ID of the version the agent is on
   */
  #[JsonProperty('version_id')]
  public ?string $versionId;

  /**
   * The ID of the branch the agent is on
   */
  #[JsonProperty('branch_id')]
  public ?string $branchId;

  /**
   * The ID of the main branch for this agent
   */
  #[JsonProperty('main_branch_id')]
  public ?string $mainBranchId;

  /**
   * @var array<string, \ElevenLabs\Types\ProcedureRefResponseModel>|null
   * Procedures keyed by procedure_id.
   */
  #[
    JsonProperty('procedures'),
    ArrayType(['string' => \ElevenLabs\Types\ProcedureRefResponseModel::class])
  ]
  public ?array $procedures;

  /**
   * URL of the default hold tone played to queued callers when no custom hold audio is uploaded, so the dashboard can preview it.
   */
  #[JsonProperty('default_hold_audio_url')]
  public ?string $defaultHoldAudioUrl;

  /**
   * @param array{
   *   agentId: string,
   *   name: string,
   *   conversationConfig: \ElevenLabs\Types\ConversationalConfig,
   *   metadata: \ElevenLabs\Types\AgentMetadataResponseModel,
   *   platformSettings?: ?\ElevenLabs\Types\AgentPlatformSettingsResponseModel,
   *   phoneNumbers?: \ElevenLabs\Types\GetAgentResponseModelPhoneNumbersItem[]|null,
   *   whatsappAccounts?: \ElevenLabs\Types\GetWhatsAppAccountResponse[]|null,
   *   workflow?: ?\ElevenLabs\Types\AgentWorkflowResponseModel,
   *   accessInfo?: ?\ElevenLabs\Types\ResourceAccessInfo,
   *   tags?: string[]|null,
   *   versionId?: ?string,
   *   branchId?: ?string,
   *   mainBranchId?: ?string,
   *   procedures?: array<string, \ElevenLabs\Types\ProcedureRefResponseModel>|null,
   *   defaultHoldAudioUrl?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->agentId = $values['agentId'];
    $this->name = $values['name'];
    $this->conversationConfig = $values['conversationConfig'];
    $this->metadata = $values['metadata'];
    $this->platformSettings = $values['platformSettings'] ?? null;
    $this->phoneNumbers = $values['phoneNumbers'] ?? null;
    $this->whatsappAccounts = $values['whatsappAccounts'] ?? null;
    $this->workflow = $values['workflow'] ?? null;
    $this->accessInfo = $values['accessInfo'] ?? null;
    $this->tags = $values['tags'] ?? null;
    $this->versionId = $values['versionId'] ?? null;
    $this->branchId = $values['branchId'] ?? null;
    $this->mainBranchId = $values['mainBranchId'] ?? null;
    $this->procedures = $values['procedures'] ?? null;
    $this->defaultHoldAudioUrl = $values['defaultHoldAudioUrl'] ?? null;

    $this->_dirtyFields = [
      'agent_id' => true,
      'name' => true,
      'conversation_config' => true,
      'metadata' => true
    ];
    if (array_key_exists('platformSettings', $values)) {
      $this->_dirtyFields['platform_settings'] = true;
    }
    if (array_key_exists('phoneNumbers', $values)) {
      $this->_dirtyFields['phone_numbers'] = true;
    }
    if (array_key_exists('whatsappAccounts', $values)) {
      $this->_dirtyFields['whatsapp_accounts'] = true;
    }
    if (array_key_exists('workflow', $values)) {
      $this->_dirtyFields['workflow'] = true;
    }
    if (array_key_exists('accessInfo', $values)) {
      $this->_dirtyFields['access_info'] = true;
    }
    if (array_key_exists('tags', $values)) {
      $this->_dirtyFields['tags'] = true;
    }
    if (array_key_exists('versionId', $values)) {
      $this->_dirtyFields['version_id'] = true;
    }
    if (array_key_exists('branchId', $values)) {
      $this->_dirtyFields['branch_id'] = true;
    }
    if (array_key_exists('mainBranchId', $values)) {
      $this->_dirtyFields['main_branch_id'] = true;
    }
    if (array_key_exists('procedures', $values)) {
      $this->_dirtyFields['procedures'] = true;
    }
    if (array_key_exists('defaultHoldAudioUrl', $values)) {
      $this->_dirtyFields['default_hold_audio_url'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'agent_id',
      'contents' => $this->agentId
    ];

    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    $parts[] = [
      'name' => 'conversation_config',
      'contents' => json_encode($this->conversationConfig),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'metadata',
      'contents' => json_encode($this->metadata),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->platformSettings !== null) {
      $parts[] = [
        'name' => 'platform_settings',
        'contents' => json_encode($this->platformSettings),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->phoneNumbers !== null) {
      $parts[] = [
        'name' => 'phone_numbers',
        'contents' => json_encode($this->phoneNumbers),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->whatsappAccounts !== null) {
      $parts[] = [
        'name' => 'whatsapp_accounts',
        'contents' => json_encode($this->whatsappAccounts),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->workflow !== null) {
      $parts[] = [
        'name' => 'workflow',
        'contents' => json_encode($this->workflow),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->accessInfo !== null) {
      $parts[] = [
        'name' => 'access_info',
        'contents' => json_encode($this->accessInfo),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->tags !== null) {
      foreach ($this->tags ?? [] as $item) {
        $parts[] = [
          'name' => 'tags',
          'contents' => $item
        ];
      }
    }

    if ($this->versionId !== null) {
      $parts[] = [
        'name' => 'version_id',
        'contents' => $this->versionId
      ];
    }

    if ($this->branchId !== null) {
      $parts[] = [
        'name' => 'branch_id',
        'contents' => $this->branchId
      ];
    }

    if ($this->mainBranchId !== null) {
      $parts[] = [
        'name' => 'main_branch_id',
        'contents' => $this->mainBranchId
      ];
    }

    if ($this->procedures !== null) {
      $parts[] = [
        'name' => 'procedures',
        'contents' => json_encode($this->procedures),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->defaultHoldAudioUrl !== null) {
      $parts[] = [
        'name' => 'default_hold_audio_url',
        'contents' => $this->defaultHoldAudioUrl
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->conversationConfig->validate();
    $this->metadata->validate();
    $this->platformSettings?->validate();
    foreach ($this->whatsappAccounts ?? [] as $item) {
      $item->validate();
    }
    $this->workflow?->validate();
    $this->accessInfo?->validate();
  }
}
