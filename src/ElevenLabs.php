<?php

declare(strict_types=1);

namespace ElevenLabs;

use ElevenLabs\History\HistoryClient;
use ElevenLabs\TextToSoundEffects\TextToSoundEffectsClient;
use ElevenLabs\AudioIsolation\AudioIsolationClient;
use ElevenLabs\AudioEffects\AudioEffectsClient;
use ElevenLabs\Samples\SamplesClient;
use ElevenLabs\Voices\VoicesClient;
use ElevenLabs\Dubbing\DubbingClient;
use ElevenLabs\Agents\AgentsClient;
use ElevenLabs\TextToSpeech\TextToSpeechClient;
use ElevenLabs\Flows\FlowsClient;
use ElevenLabs\TextToDialogue\TextToDialogueClient;
use ElevenLabs\SpeechToSpeech\SpeechToSpeechClient;
use ElevenLabs\TextToVoice\TextToVoiceClient;
use ElevenLabs\User\UserClient;
use ElevenLabs\Studio\StudioClient;
use ElevenLabs\PronunciationDictionaries\PronunciationDictionariesClient;
use ElevenLabs\SpeechToText\SpeechToTextClient;
use ElevenLabs\Models\ModelsClient;
use ElevenLabs\AudioNative\AudioNativeClient;
use ElevenLabs\Workspaces\WorkspacesClient;
use ElevenLabs\ServiceAccounts\ServiceAccountsClient;
use ElevenLabs\Workspace\WorkspaceClient;
use ElevenLabs\Webhooks\WebhooksClient;
use ElevenLabs\Music\MusicClient;
use ElevenLabs\Tokens\TokensClient;
use ElevenLabs\ForcedAlignment\ForcedAlignmentClient;
use ElevenLabs\SpeechEngine\SpeechEngineClient;
use ElevenLabs\EnvironmentVariables\EnvironmentVariablesClient;
use ElevenLabs\Environments\EnvironmentsClient;
use ElevenLabs\Productions\ProductionsClient;
use ElevenLabs\Assets\AssetsClient;
use ElevenLabs\TextToDialogueMultiContext\TextToDialogueMultiContextClient;
use ElevenLabs\TextToSpeechMultiContext\TextToSpeechMultiContextClient;
use ElevenLabs\Translation\TranslationClient;

use ElevenLabs\Core\Client\RawClient;

/**
 * Main SDK client providing access to all API service endpoints.
 *
 * This client acts as the central entry point for interacting with the API,
 * managing service instances, authentication, and base URL configuration.
 * Each service property provides access to a specific group of API endpoints.
 */
class ElevenLabs
{
  public HistoryClient $history;
  public TextToSoundEffectsClient $textToSoundEffects;
  public AudioIsolationClient $audioIsolation;
  public AudioEffectsClient $audioEffects;
  public SamplesClient $samples;
  public VoicesClient $voices;
  public DubbingClient $dubbing;
  public AgentsClient $agents;
  public TextToSpeechClient $textToSpeech;
  public FlowsClient $flows;
  public TextToDialogueClient $textToDialogue;
  public SpeechToSpeechClient $speechToSpeech;
  public TextToVoiceClient $textToVoice;
  public UserClient $user;
  public StudioClient $studio;
  public PronunciationDictionariesClient $pronunciationDictionaries;
  public SpeechToTextClient $speechToText;
  public ModelsClient $models;
  public AudioNativeClient $audioNative;
  public WorkspacesClient $workspaces;
  public ServiceAccountsClient $serviceAccounts;
  public WorkspaceClient $workspace;
  public WebhooksClient $webhooks;
  public MusicClient $music;
  public TokensClient $tokens;
  public ForcedAlignmentClient $forcedAlignment;
  public SpeechEngineClient $speechEngine;
  public EnvironmentVariablesClient $environmentVariables;
  public EnvironmentsClient $environments;
  public ProductionsClient $productions;
  public AssetsClient $assets;
  public TextToDialogueMultiContextClient $textToDialogueMultiContext;
  public TextToSpeechMultiContextClient $textToSpeechMultiContext;
  public TranslationClient $translation;
  private array $options;
  /** @var RawClient $client */
  private RawClient $client;

  public function __construct(?string $apiKey = null, ?array $options = null)
  {
    $apiKey ??= getenv('ELEVENLABS_API_KEY') ?: null;
    $defaultHeaders = [
      'X-Fern-Language' => 'PHP',
      'X-Fern-SDK-Name' => 'ElevenLabs'
    ];
    if ($apiKey != null) {
      $defaultHeaders['xi-api-key'] = $apiKey;
    }

    $this->options = $options ?? [];
    $this->options['headers'] = array_merge($defaultHeaders, $this->options['headers'] ?? []);
    $this->options['staticAuthorization'] = null;

    $this->client = new RawClient(options: $this->options);

    $this->history = new HistoryClient($this->client, $this->options);
    $this->textToSoundEffects = new TextToSoundEffectsClient($this->client, $this->options);
    $this->audioIsolation = new AudioIsolationClient($this->client, $this->options);
    $this->audioEffects = new AudioEffectsClient($this->client, $this->options);
    $this->samples = new SamplesClient($this->client, $this->options);
    $this->voices = new VoicesClient($this->client, $this->options);
    $this->dubbing = new DubbingClient($this->client, $this->options);
    $this->agents = new AgentsClient($this->client, $this->options);
    $this->textToSpeech = new TextToSpeechClient($this->client, $this->options);
    $this->flows = new FlowsClient($this->client, $this->options);
    $this->textToDialogue = new TextToDialogueClient($this->client, $this->options);
    $this->speechToSpeech = new SpeechToSpeechClient($this->client, $this->options);
    $this->textToVoice = new TextToVoiceClient($this->client, $this->options);
    $this->user = new UserClient($this->client, $this->options);
    $this->studio = new StudioClient($this->client, $this->options);
    $this->pronunciationDictionaries = new PronunciationDictionariesClient(
      $this->client,
      $this->options
    );
    $this->speechToText = new SpeechToTextClient($this->client, $this->options);
    $this->models = new ModelsClient($this->client, $this->options);
    $this->audioNative = new AudioNativeClient($this->client, $this->options);
    $this->workspaces = new WorkspacesClient($this->client, $this->options);
    $this->serviceAccounts = new ServiceAccountsClient($this->client, $this->options);
    $this->workspace = new WorkspaceClient($this->client, $this->options);
    $this->webhooks = new WebhooksClient($this->client, $this->options);
    $this->music = new MusicClient($this->client, $this->options);
    $this->tokens = new TokensClient($this->client, $this->options);
    $this->forcedAlignment = new ForcedAlignmentClient($this->client, $this->options);
    $this->speechEngine = new SpeechEngineClient($this->client, $this->options);
    $this->environmentVariables = new EnvironmentVariablesClient($this->client, $this->options);
    $this->environments = new EnvironmentsClient($this->client, $this->options);
    $this->productions = new ProductionsClient($this->client, $this->options);
    $this->assets = new AssetsClient($this->client, $this->options);
    $this->textToDialogueMultiContext = new TextToDialogueMultiContextClient(
      $this->client,
      $this->options
    );
    $this->textToSpeechMultiContext = new TextToSpeechMultiContextClient(
      $this->client,
      $this->options
    );
    $this->translation = new TranslationClient($this->client, $this->options);
  }

  /**
   * Set the base URL for all API requests.
   *
   * This method updates the base URL for all service instances managed by this client.
   * Useful for switching between different environments or API versions at runtime.
   *
   * @param string $url The new base URL (e.g., 'https://api.example.com/v2')
   * @return void
   */
  public function setBaseUrl(string $url): void
  {
    $this->history->setBaseUrl($url);
    $this->textToSoundEffects->setBaseUrl($url);
    $this->audioIsolation->setBaseUrl($url);
    $this->audioEffects->setBaseUrl($url);
    $this->samples->setBaseUrl($url);
    $this->voices->setBaseUrl($url);
    $this->voices->pvc->setBaseUrl($url);
    $this->voices->pvc->samples->setBaseUrl($url);
    $this->voices->pvc->samples->audio->setBaseUrl($url);
    $this->voices->pvc->samples->speakers->setBaseUrl($url);
    $this->voices->pvc->samples->speakers->audio->setBaseUrl($url);
    $this->voices->pvc->samples->waveform->setBaseUrl($url);
    $this->voices->pvc->verification->setBaseUrl($url);
    $this->voices->pvc->verification->captcha->setBaseUrl($url);
    $this->voices->samples->audio->setBaseUrl($url);
    $this->voices->collections->setBaseUrl($url);
    $this->voices->settings->setBaseUrl($url);
    $this->voices->accents->setBaseUrl($url);
    $this->voices->ivc->setBaseUrl($url);
    $this->dubbing->setBaseUrl($url);
    $this->dubbing->audio->setBaseUrl($url);
    $this->dubbing->project->setBaseUrl($url);
    $this->dubbing->project->language->setBaseUrl($url);
    $this->dubbing->project->language->transcript->setBaseUrl($url);
    $this->dubbing->project->transcript->setBaseUrl($url);
    $this->dubbing->transcripts->setBaseUrl($url);
    $this->agents->setBaseUrl($url);
    $this->agents->conversations->setBaseUrl($url);
    $this->agents->conversations->audio->setBaseUrl($url);
    $this->agents->conversations->files->setBaseUrl($url);
    $this->agents->conversations->feedback->setBaseUrl($url);
    $this->agents->conversations->messages->setBaseUrl($url);
    $this->agents->conversations->tags->setBaseUrl($url);
    $this->agents->conversations->topics->setBaseUrl($url);
    $this->agents->conversations->analysis->setBaseUrl($url);
    $this->agents->settings->setBaseUrl($url);
    $this->agents->dashboard->settings->setBaseUrl($url);
    $this->agents->twilio->setBaseUrl($url);
    $this->agents->exotel->setBaseUrl($url);
    $this->agents->whatsapp->setBaseUrl($url);
    $this->agents->summaries->setBaseUrl($url);
    $this->agents->knowledgeBase->setBaseUrl($url);
    $this->agents->knowledgeBase->documents->setBaseUrl($url);
    $this->agents->knowledgeBase->documents->summaries->setBaseUrl($url);
    $this->agents->knowledgeBase->documents->chunk->setBaseUrl($url);
    $this->agents->knowledgeBase->documents->chunks->setBaseUrl($url);
    $this->agents->knowledgeBase->crawlJobs->setBaseUrl($url);
    $this->agents->knowledgeBase->document->setBaseUrl($url);
    $this->agents->widget->setBaseUrl($url);
    $this->agents->widget->avatar->setBaseUrl($url);
    $this->agents->link->setBaseUrl($url);
    $this->agents->holdAudio->setBaseUrl($url);
    $this->agents->llmUsage->setBaseUrl($url);
    $this->agents->tests->setBaseUrl($url);
    $this->agents->tests->folders->setBaseUrl($url);
    $this->agents->tests->invocations->setBaseUrl($url);
    $this->agents->users->setBaseUrl($url);
    $this->agents->triageTickets->setBaseUrl($url);
    $this->agents->phoneNumbers->setBaseUrl($url);
    $this->agents->llm->setBaseUrl($url);
    $this->agents->analytics->liveCount->setBaseUrl($url);
    $this->agents->tools->setBaseUrl($url);
    $this->agents->tools->executions->setBaseUrl($url);
    $this->agents->mcpServers->setBaseUrl($url);
    $this->agents->mcpServers->tools->setBaseUrl($url);
    $this->agents->mcpServers->toolApprovals->setBaseUrl($url);
    $this->agents->mcpServers->toolConfigs->setBaseUrl($url);
    $this->agents->analysisItems->setBaseUrl($url);
    $this->agents->analysisItems->dependentAgents->setBaseUrl($url);
    $this->agents->secrets->setBaseUrl($url);
    $this->agents->batchCalls->setBaseUrl($url);
    $this->agents->sipTrunk->setBaseUrl($url);
    $this->agents->whatsappAccounts->setBaseUrl($url);
    $this->agents->branches->setBaseUrl($url);
    $this->agents->versions->setBaseUrl($url);
    $this->agents->deployments->setBaseUrl($url);
    $this->agents->drafts->setBaseUrl($url);
    $this->agents->procedures->setBaseUrl($url);
    $this->agents->procedures->drafts->setBaseUrl($url);
    $this->agents->mergeProposals->setBaseUrl($url);
    $this->agents->outboundCampaigns->setBaseUrl($url);
    $this->agents->outboundCampaigns->config->setBaseUrl($url);
    $this->agents->outboundCampaigns->leads->setBaseUrl($url);
    $this->agents->outboundCampaigns->calls->setBaseUrl($url);
    $this->agents->outboundCampaigns->attention->setBaseUrl($url);
    $this->agents->realtime->setBaseUrl($url);
    $this->textToSpeech->setBaseUrl($url);
    $this->flows->textToSpeech->setBaseUrl($url);
    $this->flows->video->setBaseUrl($url);
    $this->flows->image->setBaseUrl($url);
    $this->flows->templates->setBaseUrl($url);
    $this->flows->templates->runs->setBaseUrl($url);
    $this->textToDialogue->setBaseUrl($url);
    $this->speechToSpeech->setBaseUrl($url);
    $this->textToVoice->setBaseUrl($url);
    $this->textToVoice->preview->setBaseUrl($url);
    $this->user->setBaseUrl($url);
    $this->user->subscription->setBaseUrl($url);
    $this->studio->setBaseUrl($url);
    $this->studio->projects->setBaseUrl($url);
    $this->studio->projects->pronunciationDictionaries->setBaseUrl($url);
    $this->studio->projects->content->setBaseUrl($url);
    $this->studio->projects->snapshots->setBaseUrl($url);
    $this->studio->projects->chapters->setBaseUrl($url);
    $this->studio->projects->chapters->snapshots->setBaseUrl($url);
    $this->pronunciationDictionaries->setBaseUrl($url);
    $this->pronunciationDictionaries->rules->setBaseUrl($url);
    $this->speechToText->setBaseUrl($url);
    $this->speechToText->transcripts->setBaseUrl($url);
    $this->models->setBaseUrl($url);
    $this->audioNative->setBaseUrl($url);
    $this->workspaces->apiKeys->setBaseUrl($url);
    $this->serviceAccounts->setBaseUrl($url);
    $this->serviceAccounts->apiKeys->setBaseUrl($url);
    $this->workspace->setBaseUrl($url);
    $this->workspace->auditLogs->setBaseUrl($url);
    $this->workspace->authConnections->setBaseUrl($url);
    $this->workspace->groups->setBaseUrl($url);
    $this->workspace->groups->members->setBaseUrl($url);
    $this->workspace->members->setBaseUrl($url);
    $this->workspace->invites->setBaseUrl($url);
    $this->workspace->resources->setBaseUrl($url);
    $this->workspace->usage->setBaseUrl($url);
    $this->workspace->analytics->requests->setBaseUrl($url);
    $this->webhooks->setBaseUrl($url);
    $this->music->setBaseUrl($url);
    $this->music->compositionPlan->setBaseUrl($url);
    $this->music->finetunes->setBaseUrl($url);
    $this->tokens->singleUse->setBaseUrl($url);
    $this->forcedAlignment->setBaseUrl($url);
    $this->speechEngine->setBaseUrl($url);
    $this->environmentVariables->setBaseUrl($url);
    $this->environments->setBaseUrl($url);
    $this->productions->orders->setBaseUrl($url);
    $this->productions->orders->media->setBaseUrl($url);
    $this->productions->orders->items->setBaseUrl($url);
    $this->productions->orders->deliverables->setBaseUrl($url);
    $this->productions->orders->languages->setBaseUrl($url);
    $this->assets->setBaseUrl($url);
    $this->textToDialogueMultiContext->setBaseUrl($url);
    $this->textToSpeechMultiContext->setBaseUrl($url);
    $this->translation->setBaseUrl($url);
  }
}

// c029837e0e474b76bc487506e8799df5e3335891efe4fb02bda7a1441840310c
