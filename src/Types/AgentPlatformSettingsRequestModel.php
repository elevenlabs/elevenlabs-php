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
class AgentPlatformSettingsRequestModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Settings to evaluate an agent's performance.
   * Agents are evaluated against a set of criteria, with success being defined as meeting some combination of those criteria.
   */
  #[JsonProperty('evaluation')]
  public ?\ElevenLabs\Types\EvaluationSettingsInput $evaluation;

  #[JsonProperty('widget')]
  public ?\ElevenLabs\Types\WidgetConfig $widget;

  /**
   * @var array<string, \ElevenLabs\Types\AnalysisProperty>|null
   * Data collection fields, keyed by ID. Each field is stored as an analysis item attached to the agent (see analysis_items).
   */
  #[
    JsonProperty('data_collection'),
    ArrayType(['string' => \ElevenLabs\Types\AnalysisProperty::class])
  ]
  public ?array $dataCollection;

  /**
   * @var array<string, value-of<\ElevenLabs\Types\AnalysisScope>>|null
   * Scope per data collection item ID. Missing keys default to conversation scope.
   */
  #[JsonProperty('data_collection_scopes'), ArrayType(['string' => 'string'])]
  public ?array $dataCollectionScopes;

  /**
   * Analysis items (evaluation criteria and data collection fields) attached to the agent by reference. They are the source of truth for the agent's analysis. Writing evaluation.criteria or data_collection inline is still supported: a new entry creates an item, and changing an entry publishes a new version of its attached item, which every agent using that item picks up. To attach or detach an existing item, use the analysis item attachments endpoint. None means the agent has no attached items yet, and its inline fields are used as they are.
   */
  #[JsonProperty('analysis_items')]
  public ?\ElevenLabs\Types\AgentAnalysisItemsInput $analysisItems;

  #[JsonProperty('overrides')]
  public ?\ElevenLabs\Types\ConversationInitiationClientDataConfigInput $overrides;

  #[JsonProperty('workspace_overrides')]
  public ?\ElevenLabs\Types\AgentWorkspaceOverridesInput $workspaceOverrides;

  /**
   * Settings for agent testing configuration.
   */
  #[JsonProperty('testing')]
  public ?\ElevenLabs\Types\AgentTestingSettings $testing;

  /**
   * Whether the agent is archived
   */
  #[JsonProperty('archived')]
  public ?bool $archived;

  #[JsonProperty('guardrails')]
  public ?\ElevenLabs\Types\GuardrailsV1Input $guardrails;

  /**
   * Language for all conversation analysis outputs (summaries, titles, evaluation rationales, data collection rationales). If not set, the language will be inferred from the conversation. Must be one of the supported conversation languages.
   */
  #[JsonProperty('summary_language')]
  public ?string $summaryLanguage;

  /**
   * When enabled, a conversation transcript is automatically translated to the viewer's application language when they open the transcript page. If not set or false, transcripts are shown in their original language unless the viewer manually selects a translation.
   */
  #[JsonProperty('auto_translate_transcript_to_app_language')]
  public ?bool $autoTranslateTranscriptToAppLanguage;

  #[JsonProperty('auth')]
  public ?\ElevenLabs\Types\AuthSettings $auth;

  #[JsonProperty('call_limits')]
  public ?\ElevenLabs\Types\AgentCallLimits $callLimits;

  #[JsonProperty('queueing_config')]
  public ?\ElevenLabs\Types\AgentQueueingConfig $queueingConfig;

  #[JsonProperty('privacy')]
  public ?\ElevenLabs\Types\PrivacyConfigInput $privacy;

  /**
   * @var ?value-of<\ElevenLabs\Types\AgentTrustContext>
   * The trust context in which the agent operates.
   *
   * UNKNOWN: not yet classified (existing agents created before this feature).
   * LOW: serves untrusted external participants (e.g. customer support, sales) —
   *      outputs should be vetted and tool access scoped.
   * HIGH: serves the owner (e.g. personal assistant) — full tool access is appropriate.
   */
  #[JsonProperty('trust_context')]
  public ?string $trustContext;

  /**
   * @var ?value-of<\ElevenLabs\Types\Llm>
   */
  #[JsonProperty('analysis_llm')]
  public ?string $analysisLlm;

  /**
   * Per-agent topic-discovery configuration. Cadence and analysis window are
   * managed internally; this only exposes the customer-facing on/off toggle.
   */
  #[JsonProperty('topic_discovery')]
  public ?\ElevenLabs\Types\TopicDiscoverySettings $topicDiscovery;

  #[JsonProperty('sentiment_analysis')]
  public ?\ElevenLabs\Types\SentimentAnalysisSettings $sentimentAnalysis;

  /**
   * Agent-level alerting configuration overriding workspace settings.
   */
  #[JsonProperty('alerting')]
  public ?\ElevenLabs\Types\AlertingSettings $alerting;

  /**
   * @param array{
   *   evaluation?: ?\ElevenLabs\Types\EvaluationSettingsInput,
   *   widget?: ?\ElevenLabs\Types\WidgetConfig,
   *   dataCollection?: array<string, \ElevenLabs\Types\AnalysisProperty>|null,
   *   dataCollectionScopes?: array<string, value-of<\ElevenLabs\Types\AnalysisScope>>|null,
   *   analysisItems?: ?\ElevenLabs\Types\AgentAnalysisItemsInput,
   *   overrides?: ?\ElevenLabs\Types\ConversationInitiationClientDataConfigInput,
   *   workspaceOverrides?: ?\ElevenLabs\Types\AgentWorkspaceOverridesInput,
   *   testing?: ?\ElevenLabs\Types\AgentTestingSettings,
   *   archived?: ?bool,
   *   guardrails?: ?\ElevenLabs\Types\GuardrailsV1Input,
   *   summaryLanguage?: ?string,
   *   autoTranslateTranscriptToAppLanguage?: ?bool,
   *   auth?: ?\ElevenLabs\Types\AuthSettings,
   *   callLimits?: ?\ElevenLabs\Types\AgentCallLimits,
   *   queueingConfig?: ?\ElevenLabs\Types\AgentQueueingConfig,
   *   privacy?: ?\ElevenLabs\Types\PrivacyConfigInput,
   *   trustContext?: ?value-of<\ElevenLabs\Types\AgentTrustContext>,
   *   analysisLlm?: ?value-of<\ElevenLabs\Types\Llm>,
   *   topicDiscovery?: ?\ElevenLabs\Types\TopicDiscoverySettings,
   *   sentimentAnalysis?: ?\ElevenLabs\Types\SentimentAnalysisSettings,
   *   alerting?: ?\ElevenLabs\Types\AlertingSettings,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->evaluation = $values['evaluation'] ?? null;
    $this->widget = $values['widget'] ?? null;
    $this->dataCollection = $values['dataCollection'] ?? null;
    $this->dataCollectionScopes = $values['dataCollectionScopes'] ?? null;
    $this->analysisItems = $values['analysisItems'] ?? null;
    $this->overrides = $values['overrides'] ?? null;
    $this->workspaceOverrides = $values['workspaceOverrides'] ?? null;
    $this->testing = $values['testing'] ?? null;
    $this->archived = $values['archived'] ?? null;
    $this->guardrails = $values['guardrails'] ?? null;
    $this->summaryLanguage = $values['summaryLanguage'] ?? null;
    $this->autoTranslateTranscriptToAppLanguage =
      $values['autoTranslateTranscriptToAppLanguage'] ?? null;
    $this->auth = $values['auth'] ?? null;
    $this->callLimits = $values['callLimits'] ?? null;
    $this->queueingConfig = $values['queueingConfig'] ?? null;
    $this->privacy = $values['privacy'] ?? null;
    $this->trustContext = $values['trustContext'] ?? null;
    $this->analysisLlm = $values['analysisLlm'] ?? null;
    $this->topicDiscovery = $values['topicDiscovery'] ?? null;
    $this->sentimentAnalysis = $values['sentimentAnalysis'] ?? null;
    $this->alerting = $values['alerting'] ?? null;

    if (array_key_exists('evaluation', $values)) {
      $this->_dirtyFields['evaluation'] = true;
    }
    if (array_key_exists('widget', $values)) {
      $this->_dirtyFields['widget'] = true;
    }
    if (array_key_exists('dataCollection', $values)) {
      $this->_dirtyFields['data_collection'] = true;
    }
    if (array_key_exists('dataCollectionScopes', $values)) {
      $this->_dirtyFields['data_collection_scopes'] = true;
    }
    if (array_key_exists('analysisItems', $values)) {
      $this->_dirtyFields['analysis_items'] = true;
    }
    if (array_key_exists('overrides', $values)) {
      $this->_dirtyFields['overrides'] = true;
    }
    if (array_key_exists('workspaceOverrides', $values)) {
      $this->_dirtyFields['workspace_overrides'] = true;
    }
    if (array_key_exists('testing', $values)) {
      $this->_dirtyFields['testing'] = true;
    }
    if (array_key_exists('archived', $values)) {
      $this->_dirtyFields['archived'] = true;
    }
    if (array_key_exists('guardrails', $values)) {
      $this->_dirtyFields['guardrails'] = true;
    }
    if (array_key_exists('summaryLanguage', $values)) {
      $this->_dirtyFields['summary_language'] = true;
    }
    if (array_key_exists('autoTranslateTranscriptToAppLanguage', $values)) {
      $this->_dirtyFields['auto_translate_transcript_to_app_language'] = true;
    }
    if (array_key_exists('auth', $values)) {
      $this->_dirtyFields['auth'] = true;
    }
    if (array_key_exists('callLimits', $values)) {
      $this->_dirtyFields['call_limits'] = true;
    }
    if (array_key_exists('queueingConfig', $values)) {
      $this->_dirtyFields['queueing_config'] = true;
    }
    if (array_key_exists('privacy', $values)) {
      $this->_dirtyFields['privacy'] = true;
    }
    if (array_key_exists('trustContext', $values)) {
      $this->_dirtyFields['trust_context'] = true;
    }
    if (array_key_exists('analysisLlm', $values)) {
      $this->_dirtyFields['analysis_llm'] = true;
    }
    if (array_key_exists('topicDiscovery', $values)) {
      $this->_dirtyFields['topic_discovery'] = true;
    }
    if (array_key_exists('sentimentAnalysis', $values)) {
      $this->_dirtyFields['sentiment_analysis'] = true;
    }
    if (array_key_exists('alerting', $values)) {
      $this->_dirtyFields['alerting'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->evaluation !== null) {
      $parts[] = [
        'name' => 'evaluation',
        'contents' => json_encode($this->evaluation),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->widget !== null) {
      $parts[] = [
        'name' => 'widget',
        'contents' => json_encode($this->widget),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->dataCollection !== null) {
      $parts[] = [
        'name' => 'data_collection',
        'contents' => json_encode($this->dataCollection),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->dataCollectionScopes !== null) {
      $parts[] = [
        'name' => 'data_collection_scopes',
        'contents' => json_encode($this->dataCollectionScopes),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->analysisItems !== null) {
      $parts[] = [
        'name' => 'analysis_items',
        'contents' => json_encode($this->analysisItems),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->overrides !== null) {
      $parts[] = [
        'name' => 'overrides',
        'contents' => json_encode($this->overrides),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->workspaceOverrides !== null) {
      $parts[] = [
        'name' => 'workspace_overrides',
        'contents' => json_encode($this->workspaceOverrides),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->testing !== null) {
      $parts[] = [
        'name' => 'testing',
        'contents' => json_encode($this->testing),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->archived !== null) {
      $parts[] = [
        'name' => 'archived',
        'contents' => $this->archived ? 'true' : 'false'
      ];
    }

    if ($this->guardrails !== null) {
      $parts[] = [
        'name' => 'guardrails',
        'contents' => json_encode($this->guardrails),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->summaryLanguage !== null) {
      $parts[] = [
        'name' => 'summary_language',
        'contents' => $this->summaryLanguage
      ];
    }

    if ($this->autoTranslateTranscriptToAppLanguage !== null) {
      $parts[] = [
        'name' => 'auto_translate_transcript_to_app_language',
        'contents' => $this->autoTranslateTranscriptToAppLanguage ? 'true' : 'false'
      ];
    }

    if ($this->auth !== null) {
      $parts[] = [
        'name' => 'auth',
        'contents' => json_encode($this->auth),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->callLimits !== null) {
      $parts[] = [
        'name' => 'call_limits',
        'contents' => json_encode($this->callLimits),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->queueingConfig !== null) {
      $parts[] = [
        'name' => 'queueing_config',
        'contents' => json_encode($this->queueingConfig),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->privacy !== null) {
      $parts[] = [
        'name' => 'privacy',
        'contents' => json_encode($this->privacy),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->trustContext !== null) {
      $parts[] = [
        'name' => 'trust_context',
        'contents' => $this->trustContext
      ];
    }

    if ($this->analysisLlm !== null) {
      $parts[] = [
        'name' => 'analysis_llm',
        'contents' => $this->analysisLlm
      ];
    }

    if ($this->topicDiscovery !== null) {
      $parts[] = [
        'name' => 'topic_discovery',
        'contents' => json_encode($this->topicDiscovery),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->sentimentAnalysis !== null) {
      $parts[] = [
        'name' => 'sentiment_analysis',
        'contents' => json_encode($this->sentimentAnalysis),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->alerting !== null) {
      $parts[] = [
        'name' => 'alerting',
        'contents' => json_encode($this->alerting),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->evaluation?->validate();
    $this->widget?->validate();
    $this->analysisItems?->validate();
    $this->overrides?->validate();
    $this->workspaceOverrides?->validate();
    $this->testing?->validate();
    $this->guardrails?->validate();
    $this->auth?->validate();
    $this->callLimits?->validate();
    $this->queueingConfig?->validate();
    $this->privacy?->validate();
    $this->topicDiscovery?->validate();
    $this->sentimentAnalysis?->validate();
    $this->alerting?->validate();
  }
}
