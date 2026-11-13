<?php

declare(strict_types=1);

namespace ElevenLabs\Agents;

use ElevenLabs\Services\BaseService;
use ElevenLabs\Core\Json\JsonApiRequest;
use ElevenLabs\Core\Client\HttpMethod;
use ElevenLabs\Utils\Serializer;
use ElevenLabs\Utils\Validator;

use ElevenLabs\Agents\Conversations\ConversationsClient;
use ElevenLabs\Agents\Settings\SettingsClient;
use ElevenLabs\Agents\Dashboard\DashboardClient;
use ElevenLabs\Agents\Twilio\TwilioClient;
use ElevenLabs\Agents\Exotel\ExotelClient;
use ElevenLabs\Agents\Whatsapp\WhatsappClient;
use ElevenLabs\Agents\Summaries\SummariesClient;
use ElevenLabs\Agents\KnowledgeBase\KnowledgeBaseClient;
use ElevenLabs\Agents\Widget\WidgetClient;
use ElevenLabs\Agents\Link\LinkClient;
use ElevenLabs\Agents\HoldAudio\HoldAudioClient;
use ElevenLabs\Agents\LlmUsage\LlmUsageClient;
use ElevenLabs\Agents\Tests\TestsClient;
use ElevenLabs\Agents\Users\UsersClient;
use ElevenLabs\Agents\TriageTickets\TriageTicketsClient;
use ElevenLabs\Agents\PhoneNumbers\PhoneNumbersClient;
use ElevenLabs\Agents\Llm\LlmClient;
use ElevenLabs\Agents\Analytics\AnalyticsClient;
use ElevenLabs\Agents\Tools\ToolsClient;
use ElevenLabs\Agents\McpServers\McpServersClient;
use ElevenLabs\Agents\AnalysisItems\AnalysisItemsClient;
use ElevenLabs\Agents\Secrets\SecretsClient;
use ElevenLabs\Agents\BatchCalls\BatchCallsClient;
use ElevenLabs\Agents\SipTrunk\SipTrunkClient;
use ElevenLabs\Agents\WhatsappAccounts\WhatsappAccountsClient;
use ElevenLabs\Agents\Branches\BranchesClient;
use ElevenLabs\Agents\Versions\VersionsClient;
use ElevenLabs\Agents\Deployments\DeploymentsClient;
use ElevenLabs\Agents\Drafts\DraftsClient;
use ElevenLabs\Agents\Procedures\ProceduresClient;
use ElevenLabs\Agents\MergeProposals\MergeProposalsClient;
use ElevenLabs\Agents\OutboundCampaigns\OutboundCampaignsClient;
use ElevenLabs\Agents\Realtime\RealtimeClient;

/**
 * Service class containing API endpoint methods.
 *
 * This class extends the base service to provide typed methods for specific API operations.
 * Each method corresponds to an API endpoint and handles request serialization,
 * execution, and response deserialization.
 */
class AgentsClient extends BaseService
{
  public ConversationsClient $conversations;
  public SettingsClient $settings;
  public DashboardClient $dashboard;
  public TwilioClient $twilio;
  public ExotelClient $exotel;
  public WhatsappClient $whatsapp;
  public SummariesClient $summaries;
  public KnowledgeBaseClient $knowledgeBase;
  public WidgetClient $widget;
  public LinkClient $link;
  public HoldAudioClient $holdAudio;
  public LlmUsageClient $llmUsage;
  public TestsClient $tests;
  public UsersClient $users;
  public TriageTicketsClient $triageTickets;
  public PhoneNumbersClient $phoneNumbers;
  public LlmClient $llm;
  public AnalyticsClient $analytics;
  public ToolsClient $tools;
  public McpServersClient $mcpServers;
  public AnalysisItemsClient $analysisItems;
  public SecretsClient $secrets;
  public BatchCallsClient $batchCalls;
  public SipTrunkClient $sipTrunk;
  public WhatsappAccountsClient $whatsappAccounts;
  public BranchesClient $branches;
  public VersionsClient $versions;
  public DeploymentsClient $deployments;
  public DraftsClient $drafts;
  public ProceduresClient $procedures;
  public MergeProposalsClient $mergeProposals;
  public OutboundCampaignsClient $outboundCampaigns;
  public RealtimeClient $realtime;

  public function __construct(\ElevenLabs\Core\Client\RawClient $client, ?array $options = null)
  {
    parent::__construct($client, $options);
    $this->conversations = new ConversationsClient($client, $options);
    $this->settings = new SettingsClient($client, $options);
    $this->dashboard = new DashboardClient($client, $options);
    $this->twilio = new TwilioClient($client, $options);
    $this->exotel = new ExotelClient($client, $options);
    $this->whatsapp = new WhatsappClient($client, $options);
    $this->summaries = new SummariesClient($client, $options);
    $this->knowledgeBase = new KnowledgeBaseClient($client, $options);
    $this->widget = new WidgetClient($client, $options);
    $this->link = new LinkClient($client, $options);
    $this->holdAudio = new HoldAudioClient($client, $options);
    $this->llmUsage = new LlmUsageClient($client, $options);
    $this->tests = new TestsClient($client, $options);
    $this->users = new UsersClient($client, $options);
    $this->triageTickets = new TriageTicketsClient($client, $options);
    $this->phoneNumbers = new PhoneNumbersClient($client, $options);
    $this->llm = new LlmClient($client, $options);
    $this->analytics = new AnalyticsClient($client, $options);
    $this->tools = new ToolsClient($client, $options);
    $this->mcpServers = new McpServersClient($client, $options);
    $this->analysisItems = new AnalysisItemsClient($client, $options);
    $this->secrets = new SecretsClient($client, $options);
    $this->batchCalls = new BatchCallsClient($client, $options);
    $this->sipTrunk = new SipTrunkClient($client, $options);
    $this->whatsappAccounts = new WhatsappAccountsClient($client, $options);
    $this->branches = new BranchesClient($client, $options);
    $this->versions = new VersionsClient($client, $options);
    $this->deployments = new DeploymentsClient($client, $options);
    $this->drafts = new DraftsClient($client, $options);
    $this->procedures = new ProceduresClient($client, $options);
    $this->mergeProposals = new MergeProposalsClient($client, $options);
    $this->outboundCampaigns = new OutboundCampaignsClient($client, $options);
    $this->realtime = new RealtimeClient($client, $options);
  }

  /** @var array|null Method-level configuration for create */
  protected ?array $createConfig = null;

  /** @var array|null Method-level configuration for get */
  protected ?array $getConfig = null;

  /** @var array|null Method-level configuration for update */
  protected ?array $updateConfig = null;

  /** @var array|null Method-level configuration for delete */
  protected ?array $deleteConfig = null;

  /** @var array|null Method-level configuration for list */
  protected ?array $listConfig = null;

  /** @var array|null Method-level configuration for duplicate */
  protected ?array $duplicateConfig = null;

  /** @var array|null Method-level configuration for runTests */
  protected ?array $runTestsConfig = null;

  /** @var array|null Method-level configuration for ragIndexOverview */
  protected ?array $ragIndexOverviewConfig = null;

  /** @var array|null Method-level configuration for getDocumentRagIndexes */
  protected ?array $getDocumentRagIndexesConfig = null;

  /** @var array|null Method-level configuration for deleteDocumentRagIndex */
  protected ?array $deleteDocumentRagIndexConfig = null;

  /**
   * Set method-level configuration for create.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setCreateConfig(array $config): static
  {
    $this->createConfig = $config;
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
   * Set method-level configuration for update.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setUpdateConfig(array $config): static
  {
    $this->updateConfig = $config;
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
   * Set method-level configuration for duplicate.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setDuplicateConfig(array $config): static
  {
    $this->duplicateConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for runTests.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setRunTestsConfig(array $config): static
  {
    $this->runTestsConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for ragIndexOverview.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setRagIndexOverviewConfig(array $config): static
  {
    $this->ragIndexOverviewConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for getDocumentRagIndexes.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setGetDocumentRagIndexesConfig(array $config): static
  {
    $this->getDocumentRagIndexesConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for deleteDocumentRagIndex.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setDeleteDocumentRagIndexConfig(array $config): static
  {
    $this->deleteDocumentRagIndexConfig = $config;
    return $this;
  }

  /**
   * Create an agent from a config object
   *
   * @param \ElevenLabs\Agents\Requests\BodyCreateAgentV1ConvaiAgentsCreatePost $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\CreateAgentResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function create(
    \ElevenLabs\Agents\Requests\BodyCreateAgentV1ConvaiAgentsCreatePost $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\CreateAgentResponseModel {
    $enableVersioning = $request->enableVersioning;

    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->createConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/agents/create',
        method: HttpMethod::POST,
        query: [
          'enable_versioning' => $enableVersioning
        ],
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\CreateAgentResponseModel::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Retrieve config for an agent
   *
   * @param string $agentId The id of an agent. This is returned on agent creation.
   * @param \ElevenLabs\Agents\Requests\GetAgentsRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\GetAgentResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function get(
    string $agentId,
    \ElevenLabs\Agents\Requests\GetAgentsRequest $request = new \ElevenLabs\Agents\Requests\GetAgentsRequest(),
    ?array $options = null
  ): ?\ElevenLabs\Types\GetAgentResponseModel {
    $versionId = $request->versionId;
    $branchId = $request->branchId;
    $includeProcedureGeneratedWorkflowElements =
      $request->includeProcedureGeneratedWorkflowElements;

    $resolvedConfig = $this->getResolvedConfig($this->getConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/agents/' . \ElevenLabs\Core\Client\RawClient::encodePathParam($agentId),
        method: HttpMethod::GET,
        query: [
          'version_id' => $versionId,
          'branch_id' => $branchId,
          'include_procedure_generated_workflow_elements' => $includeProcedureGeneratedWorkflowElements
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\GetAgentResponseModel::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Patches an Agent settings
   *
   * @param string $agentId The id of an agent. This is returned on agent creation.
   * @param \ElevenLabs\Agents\Requests\UpdateAgentRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\GetAgentResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function update(
    string $agentId,
    \ElevenLabs\Agents\Requests\UpdateAgentRequest $request = new \ElevenLabs\Agents\Requests\UpdateAgentRequest(),
    ?array $options = null
  ): ?\ElevenLabs\Types\GetAgentResponseModel {
    $enableVersioningIfNotEnabled = $request->enableVersioningIfNotEnabled;
    $branchId = $request->branchId;
    $includeProcedureGeneratedWorkflowElements =
      $request->includeProcedureGeneratedWorkflowElements;

    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->updateConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/agents/' . \ElevenLabs\Core\Client\RawClient::encodePathParam($agentId),
        method: HttpMethod::PATCH,
        query: [
          'enable_versioning_if_not_enabled' => $enableVersioningIfNotEnabled,
          'branch_id' => $branchId,
          'include_procedure_generated_workflow_elements' => $includeProcedureGeneratedWorkflowElements
        ],
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\GetAgentResponseModel::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Delete an agent
   *
   * @param string $agentId The id of an agent. This is returned on agent creation.
   * @param \ElevenLabs\Agents\Requests\DeleteAgentsRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return void
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function delete(
    string $agentId,
    \ElevenLabs\Agents\Requests\DeleteAgentsRequest $request = new \ElevenLabs\Agents\Requests\DeleteAgentsRequest(),
    ?array $options = null
  ): void {
    $force = $request->force;

    $resolvedConfig = $this->getResolvedConfig($this->deleteConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/agents/' . \ElevenLabs\Core\Client\RawClient::encodePathParam($agentId),
        method: HttpMethod::DELETE,
        query: [
          'force' => $force
        ]
      ),
      $resolvedConfig
    );
  }

  /**
   * Returns a list of your agents and their metadata.
   *
   * @param \ElevenLabs\Agents\Requests\ListAgentsRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\GetAgentsPageResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function list(
    \ElevenLabs\Agents\Requests\ListAgentsRequest $request = new \ElevenLabs\Agents\Requests\ListAgentsRequest(),
    ?array $options = null
  ): ?\ElevenLabs\Types\GetAgentsPageResponseModel {
    $pageSize = $request->pageSize;
    $search = $request->search;
    $archived = $request->archived;
    $showOnlyOwnedAgents = $request->showOnlyOwnedAgents;
    $createdByUserId = $request->createdByUserId;
    $tags = $request->tags;
    $sortDirection = $request->sortDirection;
    $sortBy = $request->sortBy;
    $cursor = $request->cursor;

    Validator::validateNumber($pageSize, 'page_size', min: 1, max: 100);

    $resolvedConfig = $this->getResolvedConfig($this->listConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/agents',
        method: HttpMethod::GET,
        query: [
          'page_size' => $pageSize,
          'search' => $search,
          'archived' => $archived,
          'show_only_owned_agents' => $showOnlyOwnedAgents,
          'created_by_user_id' => $createdByUserId,
          'tags' => $tags,
          'sort_direction' => $sortDirection,
          'sort_by' => $sortBy,
          'cursor' => $cursor
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\GetAgentsPageResponseModel::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Create a new agent by duplicating an existing one. The new agent gets a copy of every unarchived branch of the source agent, each with the same name and description and starting from the latest version on that branch. The live traffic split is copied onto the new branches, with any share held by a branch that was not copied moved to main. Version history, drafts, archived branches, past traffic splits and experiments are not copied.
   *
   * @param string $agentId The id of an agent. This is returned on agent creation.
   * @param \ElevenLabs\Agents\Requests\BodyDuplicateAgentV1ConvaiAgentsAgentIdDuplicatePost $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\CreateAgentResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function duplicate(
    string $agentId,
    \ElevenLabs\Agents\Requests\BodyDuplicateAgentV1ConvaiAgentsAgentIdDuplicatePost $request = new \ElevenLabs\Agents\Requests\BodyDuplicateAgentV1ConvaiAgentsAgentIdDuplicatePost(),
    ?array $options = null
  ): ?\ElevenLabs\Types\CreateAgentResponseModel {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->duplicateConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/agents/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($agentId) .
          '/duplicate',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\CreateAgentResponseModel::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Run selected tests on the agent with provided configuration. If the agent configuration is provided, it will be used to override default agent configuration.
   *
   * @param string $agentId The id of an agent. This is returned on agent creation.
   * @param \ElevenLabs\Agents\Requests\RunAgentTestsRequestModel $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\GetTestSuiteInvocationResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function runTests(
    string $agentId,
    \ElevenLabs\Agents\Requests\RunAgentTestsRequestModel $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\GetTestSuiteInvocationResponseModel {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->runTestsConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/agents/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($agentId) .
          '/run-tests',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\GetTestSuiteInvocationResponseModel::class
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
   * Provides total size and other information of RAG indexes used by knowledgebase documents
   *
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\RagIndexOverviewResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function ragIndexOverview(
    ?array $options = null
  ): ?\ElevenLabs\Types\RagIndexOverviewResponseModel {
    $resolvedConfig = $this->getResolvedConfig($this->ragIndexOverviewConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/knowledge-base/rag-index',
        method: HttpMethod::GET
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\RagIndexOverviewResponseModel::class
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
   * Provides information about all RAG indexes of the specified knowledgebase document.
   *
   * @param string $documentationId The id of a document from the knowledge base. This is returned on document addition.
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\RagDocumentIndexesResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function getDocumentRagIndexes(
    string $documentationId,
    ?array $options = null
  ): ?\ElevenLabs\Types\RagDocumentIndexesResponseModel {
    $resolvedConfig = $this->getResolvedConfig($this->getDocumentRagIndexesConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/knowledge-base/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($documentationId) .
          '/rag-index',
        method: HttpMethod::GET
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\RagDocumentIndexesResponseModel::class
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
   * Delete RAG index for the knowledgebase document.
   *
   * @param string $documentationId The id of a document from the knowledge base. This is returned on document addition.
   * @param string $ragIndexId The id of RAG index of document from the knowledge base.
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\RagDocumentIndexResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function deleteDocumentRagIndex(
    string $documentationId,
    string $ragIndexId,
    ?array $options = null
  ): ?\ElevenLabs\Types\RagDocumentIndexResponseModel {
    $resolvedConfig = $this->getResolvedConfig($this->deleteDocumentRagIndexConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/convai/knowledge-base/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($documentationId) .
          '/rag-index/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($ragIndexId),
        method: HttpMethod::DELETE
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\RagDocumentIndexResponseModel::class
      );
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }
}
