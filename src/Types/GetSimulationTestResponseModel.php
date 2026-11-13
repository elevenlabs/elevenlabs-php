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
class GetSimulationTestResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The access information for the requesting user on this test.
   */
  #[JsonProperty('access_info')]
  public ?\ElevenLabs\Types\ResourceAccessInfo $accessInfo;

  /**
   * Metadata of a conversation this test was created from (if applicable).
   */
  #[JsonProperty('from_conversation_metadata')]
  public ?\ElevenLabs\Types\TestFromConversationMetadataOutput $fromConversationMetadata;

  /**
   * @var array<string, mixed>|null
   * Dynamic variables to replace in the agent config during testing
   */
  #[JsonProperty('dynamic_variables'), ArrayType(['string' => 'mixed'])]
  public ?array $dynamicVariables;

  /**
   * @var \ElevenLabs\Types\ConversationHistoryTranscriptCommonModelOutput[]|null
   */
  #[
    JsonProperty('chat_history'),
    ArrayType([\ElevenLabs\Types\ConversationHistoryTranscriptCommonModelOutput::class])
  ]
  public ?array $chatHistory;

  /**
   * @var ?value-of<\ElevenLabs\Types\ConversationInitiationSource>
   * Simulate the test as if the conversation originated from this channel.
   */
  #[JsonProperty('conversation_initiation_source')]
  public ?string $conversationInitiationSource;

  /**
   * The environment to resolve environment-specific variable values against when running this test (URL, headers, auth connections). If not provided, defaults to 'production'. For simulation tests, simulation_environment takes precedence when set.
   */
  #[JsonProperty('environment')]
  public ?string $environment;

  /**
   * @var ?value-of<\ElevenLabs\Types\GetSimulationTestResponseModelType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * Deprecated legacy single success criterion. Use success_conditions instead. At least one of success_condition or success_conditions is required.
   */
  #[JsonProperty('success_condition')]
  public ?string $successCondition;

  /**
   * @var string[]|null
   * List of prompts that evaluate whether the simulation was successful. If provided, all criteria are evaluated and merged into a final result. Capped at the maximum number of evaluation criteria.
   */
  #[JsonProperty('success_conditions'), ArrayType(['string'])]
  public ?array $successConditions;

  /**
   * Description of the simulation scenario and user persona for simulation tests.
   */
  #[JsonProperty('simulation_scenario')]
  public ?string $simulationScenario;

  /**
   * Maximum number of conversation turns for simulation tests.
   */
  #[JsonProperty('simulation_max_turns')]
  public ?int $simulationMaxTurns;

  /**
   * The environment to use when running this simulation test. If not provided, defaults to 'production'.
   */
  #[JsonProperty('simulation_environment')]
  public ?string $simulationEnvironment;

  /**
   * Simulation/preview-side config: tools are identified by IDs, resolved to names at runtime.
   */
  #[JsonProperty('tool_mock_config')]
  public ?\ElevenLabs\Types\SimulationToolMockBehaviorConfig $toolMockConfig;

  /**
   * @var array<string, \ElevenLabs\Types\ToolResponseMockConfigOutput[]>|null
   * Test-specific response mocks, keyed by tool ID. Applied ahead of the tool's shared mocks and only within this test. Only take effect for tools that are mocked (see tool_mock_config).
   */
  #[
    JsonProperty('tool_mock_overrides'),
    ArrayType(['string' => [\ElevenLabs\Types\ToolResponseMockConfigOutput::class]])
  ]
  public ?array $toolMockOverrides;

  /**
   * @var ?value-of<\ElevenLabs\Types\Llm>
   * LLM model to use for evaluating simulation results.
   */
  #[JsonProperty('evaluation_model')]
  public ?string $evaluationModel;

  /**
   * @var ?value-of<\ElevenLabs\Types\Llm>
   * LLM model for the simulated user.
   */
  #[JsonProperty('simulated_user_model')]
  public ?string $simulatedUserModel;

  #[JsonProperty('id', required: true)]
  public string $id;

  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * @param array{
   *   id: string,
   *   name: string,
   *   accessInfo?: ?\ElevenLabs\Types\ResourceAccessInfo,
   *   fromConversationMetadata?: ?\ElevenLabs\Types\TestFromConversationMetadataOutput,
   *   dynamicVariables?: array<string, mixed>|null,
   *   chatHistory?: \ElevenLabs\Types\ConversationHistoryTranscriptCommonModelOutput[]|null,
   *   conversationInitiationSource?: ?value-of<\ElevenLabs\Types\ConversationInitiationSource>,
   *   environment?: ?string,
   *   type?: ?value-of<\ElevenLabs\Types\GetSimulationTestResponseModelType>,
   *   successCondition?: ?string,
   *   successConditions?: string[]|null,
   *   simulationScenario?: ?string,
   *   simulationMaxTurns?: ?int,
   *   simulationEnvironment?: ?string,
   *   toolMockConfig?: ?\ElevenLabs\Types\SimulationToolMockBehaviorConfig,
   *   toolMockOverrides?: array<string, \ElevenLabs\Types\ToolResponseMockConfigOutput[]>|null,
   *   evaluationModel?: ?value-of<\ElevenLabs\Types\Llm>,
   *   simulatedUserModel?: ?value-of<\ElevenLabs\Types\Llm>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->accessInfo = $values['accessInfo'] ?? null;
    $this->fromConversationMetadata = $values['fromConversationMetadata'] ?? null;
    $this->dynamicVariables = $values['dynamicVariables'] ?? null;
    $this->chatHistory = $values['chatHistory'] ?? null;
    $this->conversationInitiationSource = $values['conversationInitiationSource'] ?? null;
    $this->environment = $values['environment'] ?? null;
    $this->type = $values['type'] ?? 'simulation';
    $this->successCondition = $values['successCondition'] ?? null;
    $this->successConditions = $values['successConditions'] ?? null;
    $this->simulationScenario = $values['simulationScenario'] ?? null;
    $this->simulationMaxTurns = $values['simulationMaxTurns'] ?? null;
    $this->simulationEnvironment = $values['simulationEnvironment'] ?? null;
    $this->toolMockConfig = $values['toolMockConfig'] ?? null;
    $this->toolMockOverrides = $values['toolMockOverrides'] ?? null;
    $this->evaluationModel = $values['evaluationModel'] ?? null;
    $this->simulatedUserModel = $values['simulatedUserModel'] ?? null;
    $this->id = $values['id'];
    $this->name = $values['name'];

    $this->_dirtyFields = [
      'id' => true,
      'name' => true
    ];
    if (array_key_exists('accessInfo', $values)) {
      $this->_dirtyFields['access_info'] = true;
    }
    if (array_key_exists('fromConversationMetadata', $values)) {
      $this->_dirtyFields['from_conversation_metadata'] = true;
    }
    if (array_key_exists('dynamicVariables', $values)) {
      $this->_dirtyFields['dynamic_variables'] = true;
    }
    if (array_key_exists('chatHistory', $values)) {
      $this->_dirtyFields['chat_history'] = true;
    }
    if (array_key_exists('conversationInitiationSource', $values)) {
      $this->_dirtyFields['conversation_initiation_source'] = true;
    }
    if (array_key_exists('environment', $values)) {
      $this->_dirtyFields['environment'] = true;
    }
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
    if (array_key_exists('successCondition', $values)) {
      $this->_dirtyFields['success_condition'] = true;
    }
    if (array_key_exists('successConditions', $values)) {
      $this->_dirtyFields['success_conditions'] = true;
    }
    if (array_key_exists('simulationScenario', $values)) {
      $this->_dirtyFields['simulation_scenario'] = true;
    }
    if (array_key_exists('simulationMaxTurns', $values)) {
      $this->_dirtyFields['simulation_max_turns'] = true;
    }
    if (array_key_exists('simulationEnvironment', $values)) {
      $this->_dirtyFields['simulation_environment'] = true;
    }
    if (array_key_exists('toolMockConfig', $values)) {
      $this->_dirtyFields['tool_mock_config'] = true;
    }
    if (array_key_exists('toolMockOverrides', $values)) {
      $this->_dirtyFields['tool_mock_overrides'] = true;
    }
    if (array_key_exists('evaluationModel', $values)) {
      $this->_dirtyFields['evaluation_model'] = true;
    }
    if (array_key_exists('simulatedUserModel', $values)) {
      $this->_dirtyFields['simulated_user_model'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->accessInfo !== null) {
      $parts[] = [
        'name' => 'access_info',
        'contents' => json_encode($this->accessInfo),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->fromConversationMetadata !== null) {
      $parts[] = [
        'name' => 'from_conversation_metadata',
        'contents' => json_encode($this->fromConversationMetadata),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->dynamicVariables !== null) {
      $parts[] = [
        'name' => 'dynamic_variables',
        'contents' => json_encode($this->dynamicVariables),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->chatHistory !== null) {
      $parts[] = [
        'name' => 'chat_history',
        'contents' => json_encode($this->chatHistory),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->conversationInitiationSource !== null) {
      $parts[] = [
        'name' => 'conversation_initiation_source',
        'contents' => $this->conversationInitiationSource
      ];
    }

    if ($this->environment !== null) {
      $parts[] = [
        'name' => 'environment',
        'contents' => $this->environment
      ];
    }

    if ($this->type !== null) {
      $parts[] = [
        'name' => 'type',
        'contents' => $this->type
      ];
    }

    if ($this->successCondition !== null) {
      $parts[] = [
        'name' => 'success_condition',
        'contents' => $this->successCondition
      ];
    }

    if ($this->successConditions !== null) {
      foreach ($this->successConditions ?? [] as $item) {
        $parts[] = [
          'name' => 'success_conditions',
          'contents' => $item
        ];
      }
    }

    if ($this->simulationScenario !== null) {
      $parts[] = [
        'name' => 'simulation_scenario',
        'contents' => $this->simulationScenario
      ];
    }

    if ($this->simulationMaxTurns !== null) {
      $parts[] = [
        'name' => 'simulation_max_turns',
        'contents' => (string) $this->simulationMaxTurns
      ];
    }

    if ($this->simulationEnvironment !== null) {
      $parts[] = [
        'name' => 'simulation_environment',
        'contents' => $this->simulationEnvironment
      ];
    }

    if ($this->toolMockConfig !== null) {
      $parts[] = [
        'name' => 'tool_mock_config',
        'contents' => json_encode($this->toolMockConfig),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->toolMockOverrides !== null) {
      $parts[] = [
        'name' => 'tool_mock_overrides',
        'contents' => json_encode($this->toolMockOverrides),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->evaluationModel !== null) {
      $parts[] = [
        'name' => 'evaluation_model',
        'contents' => $this->evaluationModel
      ];
    }

    if ($this->simulatedUserModel !== null) {
      $parts[] = [
        'name' => 'simulated_user_model',
        'contents' => $this->simulatedUserModel
      ];
    }

    $parts[] = [
      'name' => 'id',
      'contents' => $this->id
    ];

    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->accessInfo?->validate();
    $this->fromConversationMetadata?->validate();
    foreach ($this->chatHistory ?? [] as $item) {
      $item->validate();
    }
    Validator::validateArray($this->chatHistory, 'chat_history', maxItems: 200);
    Validator::validateArray($this->successConditions, 'success_conditions', maxItems: 30);
    Validator::validateNumber($this->simulationMaxTurns, 'simulation_max_turns', min: 1, max: 50);
    $this->toolMockConfig?->validate();
  }
}
