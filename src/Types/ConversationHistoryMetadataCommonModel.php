<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ConversationHistoryMetadataCommonModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('start_time_unix_secs', required: true)]
  public int $startTimeUnixSecs;

  #[JsonProperty('accepted_time_unix_secs')]
  public ?int $acceptedTimeUnixSecs;

  #[JsonProperty('call_duration_secs', required: true)]
  public int $callDurationSecs;

  /**
   * Seconds the caller was held in the concurrency wait queue. Excluded from call_duration_secs and from billed time. None when the conversation was never queued.
   */
  #[JsonProperty('queue_wait_secs')]
  public ?float $queueWaitSecs;

  #[JsonProperty('cost')]
  public ?int $cost;

  #[JsonProperty('deletion_settings')]
  public ?\ElevenLabs\Types\ConversationDeletionSettings $deletionSettings;

  #[JsonProperty('feedback')]
  public ?\ElevenLabs\Types\ConversationHistoryFeedbackCommonModel $feedback;

  /**
   * @var ?value-of<\ElevenLabs\Types\AuthorizationMethod>
   */
  #[JsonProperty('authorization_method')]
  public ?string $authorizationMethod;

  #[JsonProperty('charging')]
  public ?\ElevenLabs\Types\ConversationChargingCommonModel $charging;

  #[JsonProperty('phone_call')]
  public ?\ElevenLabs\Types\ConversationHistoryMetadataCommonModelPhoneCall $phoneCall;

  #[JsonProperty('batch_call')]
  public ?\ElevenLabs\Types\ConversationHistoryBatchCallModel $batchCall;

  #[JsonProperty('termination_reason')]
  public ?string $terminationReason;

  #[JsonProperty('error')]
  public ?\ElevenLabs\Types\ConversationHistoryErrorCommonModel $error;

  /**
   * @var string[]|null
   */
  #[JsonProperty('warnings'), ArrayType(['string'])]
  public ?array $warnings;

  #[JsonProperty('main_language')]
  public ?string $mainLanguage;

  #[JsonProperty('rag_usage')]
  public ?\ElevenLabs\Types\ConversationHistoryRagUsageCommonModel $ragUsage;

  #[JsonProperty('text_only')]
  public ?bool $textOnly;

  #[JsonProperty('features_usage')]
  public ?\ElevenLabs\Types\FeaturesUsageCommonModel $featuresUsage;

  #[JsonProperty('eleven_assistant')]
  public ?\ElevenLabs\Types\ConversationHistoryElevenAssistantCommonModel $elevenAssistant;

  #[JsonProperty('initiator_id')]
  public ?string $initiatorId;

  /**
   * @var ?value-of<\ElevenLabs\Types\ConversationInitiationSource>
   * Enum representing the possible sources for conversation initiation.
   */
  #[JsonProperty('conversation_initiation_source')]
  public ?string $conversationInitiationSource;

  #[JsonProperty('conversation_initiation_source_version')]
  public ?string $conversationInitiationSourceVersion;

  #[JsonProperty('timezone')]
  public ?string $timezone;

  #[JsonProperty('async_metadata')]
  public ?\ElevenLabs\Types\AsyncConversationMetadata $asyncMetadata;

  #[JsonProperty('whatsapp')]
  public ?\ElevenLabs\Types\WhatsAppConversationInfo $whatsapp;

  #[JsonProperty('sms')]
  public ?\ElevenLabs\Types\SmsConversationInfo $sms;

  /**
   * @var ?value-of<\ElevenLabs\Types\AgentDefinitionSource>
   */
  #[JsonProperty('agent_created_from')]
  public ?string $agentCreatedFrom;

  /**
   * @var ?value-of<\ElevenLabs\Types\AgentDefinitionSource>
   */
  #[JsonProperty('agent_last_updated_from')]
  public ?string $agentLastUpdatedFrom;

  /**
   * @var \ElevenLabs\Types\ConversationVoiceRewardModel[]|null
   */
  #[
    JsonProperty('voice_rewards'),
    ArrayType([\ElevenLabs\Types\ConversationVoiceRewardModel::class])
  ]
  public ?array $voiceRewards;

  /**
   * Total fiat cost of the conversation in USD, i.e. the sum of the LLM price and the non-LLM platform price (the fiat analogue of ``cost``). ``None`` when neither is set (e.g. conversations that predate fiat cost tracking).
   */
  #[JsonProperty('cost_fiat')]
  public ?float $costFiat;

  /**
   * @param array{
   *   startTimeUnixSecs: int,
   *   callDurationSecs: int,
   *   acceptedTimeUnixSecs?: ?int,
   *   queueWaitSecs?: ?float,
   *   cost?: ?int,
   *   deletionSettings?: ?\ElevenLabs\Types\ConversationDeletionSettings,
   *   feedback?: ?\ElevenLabs\Types\ConversationHistoryFeedbackCommonModel,
   *   authorizationMethod?: ?value-of<\ElevenLabs\Types\AuthorizationMethod>,
   *   charging?: ?\ElevenLabs\Types\ConversationChargingCommonModel,
   *   phoneCall?: ?\ElevenLabs\Types\ConversationHistoryMetadataCommonModelPhoneCall,
   *   batchCall?: ?\ElevenLabs\Types\ConversationHistoryBatchCallModel,
   *   terminationReason?: ?string,
   *   error?: ?\ElevenLabs\Types\ConversationHistoryErrorCommonModel,
   *   warnings?: string[]|null,
   *   mainLanguage?: ?string,
   *   ragUsage?: ?\ElevenLabs\Types\ConversationHistoryRagUsageCommonModel,
   *   textOnly?: ?bool,
   *   featuresUsage?: ?\ElevenLabs\Types\FeaturesUsageCommonModel,
   *   elevenAssistant?: ?\ElevenLabs\Types\ConversationHistoryElevenAssistantCommonModel,
   *   initiatorId?: ?string,
   *   conversationInitiationSource?: ?value-of<\ElevenLabs\Types\ConversationInitiationSource>,
   *   conversationInitiationSourceVersion?: ?string,
   *   timezone?: ?string,
   *   asyncMetadata?: ?\ElevenLabs\Types\AsyncConversationMetadata,
   *   whatsapp?: ?\ElevenLabs\Types\WhatsAppConversationInfo,
   *   sms?: ?\ElevenLabs\Types\SmsConversationInfo,
   *   agentCreatedFrom?: ?value-of<\ElevenLabs\Types\AgentDefinitionSource>,
   *   agentLastUpdatedFrom?: ?value-of<\ElevenLabs\Types\AgentDefinitionSource>,
   *   voiceRewards?: \ElevenLabs\Types\ConversationVoiceRewardModel[]|null,
   *   costFiat?: ?float,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->startTimeUnixSecs = $values['startTimeUnixSecs'];
    $this->acceptedTimeUnixSecs = $values['acceptedTimeUnixSecs'] ?? null;
    $this->callDurationSecs = $values['callDurationSecs'];
    $this->queueWaitSecs = $values['queueWaitSecs'] ?? null;
    $this->cost = $values['cost'] ?? null;
    $this->deletionSettings = $values['deletionSettings'] ?? null;
    $this->feedback = $values['feedback'] ?? null;
    $this->authorizationMethod = $values['authorizationMethod'] ?? null;
    $this->charging = $values['charging'] ?? null;
    $this->phoneCall = $values['phoneCall'] ?? null;
    $this->batchCall = $values['batchCall'] ?? null;
    $this->terminationReason = $values['terminationReason'] ?? null;
    $this->error = $values['error'] ?? null;
    $this->warnings = $values['warnings'] ?? null;
    $this->mainLanguage = $values['mainLanguage'] ?? null;
    $this->ragUsage = $values['ragUsage'] ?? null;
    $this->textOnly = $values['textOnly'] ?? null;
    $this->featuresUsage = $values['featuresUsage'] ?? null;
    $this->elevenAssistant = $values['elevenAssistant'] ?? null;
    $this->initiatorId = $values['initiatorId'] ?? null;
    $this->conversationInitiationSource = $values['conversationInitiationSource'] ?? null;
    $this->conversationInitiationSourceVersion =
      $values['conversationInitiationSourceVersion'] ?? null;
    $this->timezone = $values['timezone'] ?? null;
    $this->asyncMetadata = $values['asyncMetadata'] ?? null;
    $this->whatsapp = $values['whatsapp'] ?? null;
    $this->sms = $values['sms'] ?? null;
    $this->agentCreatedFrom = $values['agentCreatedFrom'] ?? null;
    $this->agentLastUpdatedFrom = $values['agentLastUpdatedFrom'] ?? null;
    $this->voiceRewards = $values['voiceRewards'] ?? null;
    $this->costFiat = $values['costFiat'] ?? null;

    $this->_dirtyFields = [
      'start_time_unix_secs' => true,
      'call_duration_secs' => true
    ];
    if (array_key_exists('acceptedTimeUnixSecs', $values)) {
      $this->_dirtyFields['accepted_time_unix_secs'] = true;
    }
    if (array_key_exists('queueWaitSecs', $values)) {
      $this->_dirtyFields['queue_wait_secs'] = true;
    }
    if (array_key_exists('cost', $values)) {
      $this->_dirtyFields['cost'] = true;
    }
    if (array_key_exists('deletionSettings', $values)) {
      $this->_dirtyFields['deletion_settings'] = true;
    }
    if (array_key_exists('feedback', $values)) {
      $this->_dirtyFields['feedback'] = true;
    }
    if (array_key_exists('authorizationMethod', $values)) {
      $this->_dirtyFields['authorization_method'] = true;
    }
    if (array_key_exists('charging', $values)) {
      $this->_dirtyFields['charging'] = true;
    }
    if (array_key_exists('phoneCall', $values)) {
      $this->_dirtyFields['phone_call'] = true;
    }
    if (array_key_exists('batchCall', $values)) {
      $this->_dirtyFields['batch_call'] = true;
    }
    if (array_key_exists('terminationReason', $values)) {
      $this->_dirtyFields['termination_reason'] = true;
    }
    if (array_key_exists('error', $values)) {
      $this->_dirtyFields['error'] = true;
    }
    if (array_key_exists('warnings', $values)) {
      $this->_dirtyFields['warnings'] = true;
    }
    if (array_key_exists('mainLanguage', $values)) {
      $this->_dirtyFields['main_language'] = true;
    }
    if (array_key_exists('ragUsage', $values)) {
      $this->_dirtyFields['rag_usage'] = true;
    }
    if (array_key_exists('textOnly', $values)) {
      $this->_dirtyFields['text_only'] = true;
    }
    if (array_key_exists('featuresUsage', $values)) {
      $this->_dirtyFields['features_usage'] = true;
    }
    if (array_key_exists('elevenAssistant', $values)) {
      $this->_dirtyFields['eleven_assistant'] = true;
    }
    if (array_key_exists('initiatorId', $values)) {
      $this->_dirtyFields['initiator_id'] = true;
    }
    if (array_key_exists('conversationInitiationSource', $values)) {
      $this->_dirtyFields['conversation_initiation_source'] = true;
    }
    if (array_key_exists('conversationInitiationSourceVersion', $values)) {
      $this->_dirtyFields['conversation_initiation_source_version'] = true;
    }
    if (array_key_exists('timezone', $values)) {
      $this->_dirtyFields['timezone'] = true;
    }
    if (array_key_exists('asyncMetadata', $values)) {
      $this->_dirtyFields['async_metadata'] = true;
    }
    if (array_key_exists('whatsapp', $values)) {
      $this->_dirtyFields['whatsapp'] = true;
    }
    if (array_key_exists('sms', $values)) {
      $this->_dirtyFields['sms'] = true;
    }
    if (array_key_exists('agentCreatedFrom', $values)) {
      $this->_dirtyFields['agent_created_from'] = true;
    }
    if (array_key_exists('agentLastUpdatedFrom', $values)) {
      $this->_dirtyFields['agent_last_updated_from'] = true;
    }
    if (array_key_exists('voiceRewards', $values)) {
      $this->_dirtyFields['voice_rewards'] = true;
    }
    if (array_key_exists('costFiat', $values)) {
      $this->_dirtyFields['cost_fiat'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'start_time_unix_secs',
      'contents' => (string) $this->startTimeUnixSecs
    ];

    if ($this->acceptedTimeUnixSecs !== null) {
      $parts[] = [
        'name' => 'accepted_time_unix_secs',
        'contents' => (string) $this->acceptedTimeUnixSecs
      ];
    }

    $parts[] = [
      'name' => 'call_duration_secs',
      'contents' => (string) $this->callDurationSecs
    ];

    if ($this->queueWaitSecs !== null) {
      $parts[] = [
        'name' => 'queue_wait_secs',
        'contents' => (string) $this->queueWaitSecs
      ];
    }

    if ($this->cost !== null) {
      $parts[] = [
        'name' => 'cost',
        'contents' => (string) $this->cost
      ];
    }

    if ($this->deletionSettings !== null) {
      $parts[] = [
        'name' => 'deletion_settings',
        'contents' => json_encode($this->deletionSettings),
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

    if ($this->authorizationMethod !== null) {
      $parts[] = [
        'name' => 'authorization_method',
        'contents' => $this->authorizationMethod
      ];
    }

    if ($this->charging !== null) {
      $parts[] = [
        'name' => 'charging',
        'contents' => json_encode($this->charging),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->phoneCall !== null) {
      $parts[] = [
        'name' => 'phone_call',
        'contents' => json_encode($this->phoneCall),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->batchCall !== null) {
      $parts[] = [
        'name' => 'batch_call',
        'contents' => json_encode($this->batchCall),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->terminationReason !== null) {
      $parts[] = [
        'name' => 'termination_reason',
        'contents' => $this->terminationReason
      ];
    }

    if ($this->error !== null) {
      $parts[] = [
        'name' => 'error',
        'contents' => json_encode($this->error),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->warnings !== null) {
      foreach ($this->warnings ?? [] as $item) {
        $parts[] = [
          'name' => 'warnings',
          'contents' => $item
        ];
      }
    }

    if ($this->mainLanguage !== null) {
      $parts[] = [
        'name' => 'main_language',
        'contents' => $this->mainLanguage
      ];
    }

    if ($this->ragUsage !== null) {
      $parts[] = [
        'name' => 'rag_usage',
        'contents' => json_encode($this->ragUsage),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->textOnly !== null) {
      $parts[] = [
        'name' => 'text_only',
        'contents' => $this->textOnly ? 'true' : 'false'
      ];
    }

    if ($this->featuresUsage !== null) {
      $parts[] = [
        'name' => 'features_usage',
        'contents' => json_encode($this->featuresUsage),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->elevenAssistant !== null) {
      $parts[] = [
        'name' => 'eleven_assistant',
        'contents' => json_encode($this->elevenAssistant),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->initiatorId !== null) {
      $parts[] = [
        'name' => 'initiator_id',
        'contents' => $this->initiatorId
      ];
    }

    if ($this->conversationInitiationSource !== null) {
      $parts[] = [
        'name' => 'conversation_initiation_source',
        'contents' => $this->conversationInitiationSource
      ];
    }

    if ($this->conversationInitiationSourceVersion !== null) {
      $parts[] = [
        'name' => 'conversation_initiation_source_version',
        'contents' => $this->conversationInitiationSourceVersion
      ];
    }

    if ($this->timezone !== null) {
      $parts[] = [
        'name' => 'timezone',
        'contents' => $this->timezone
      ];
    }

    if ($this->asyncMetadata !== null) {
      $parts[] = [
        'name' => 'async_metadata',
        'contents' => json_encode($this->asyncMetadata),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->whatsapp !== null) {
      $parts[] = [
        'name' => 'whatsapp',
        'contents' => json_encode($this->whatsapp),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->sms !== null) {
      $parts[] = [
        'name' => 'sms',
        'contents' => json_encode($this->sms),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->agentCreatedFrom !== null) {
      $parts[] = [
        'name' => 'agent_created_from',
        'contents' => $this->agentCreatedFrom
      ];
    }

    if ($this->agentLastUpdatedFrom !== null) {
      $parts[] = [
        'name' => 'agent_last_updated_from',
        'contents' => $this->agentLastUpdatedFrom
      ];
    }

    if ($this->voiceRewards !== null) {
      $parts[] = [
        'name' => 'voice_rewards',
        'contents' => json_encode($this->voiceRewards),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->costFiat !== null) {
      $parts[] = [
        'name' => 'cost_fiat',
        'contents' => (string) $this->costFiat
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->deletionSettings?->validate();
    $this->feedback?->validate();
    $this->charging?->validate();
    $this->batchCall?->validate();
    $this->error?->validate();
    $this->ragUsage?->validate();
    $this->featuresUsage?->validate();
    $this->elevenAssistant?->validate();
    Validator::validateString(
      $this->conversationInitiationSourceVersion,
      'conversation_initiation_source_version',
      maxLength: 50
    );
    $this->asyncMetadata?->validate();
    $this->whatsapp?->validate();
    $this->sms?->validate();
    foreach ($this->voiceRewards ?? [] as $item) {
      $item->validate();
    }
  }
}
