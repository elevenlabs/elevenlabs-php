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
class ConversationInitiationClientDataRequestInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('conversation_config_override')]
  public ?\ElevenLabs\Types\ConversationConfigClientOverrideInput $conversationConfigOverride;

  /**
   * @var array<string, mixed>|null
   */
  #[JsonProperty('custom_llm_extra_body'), ArrayType(['string' => 'mixed'])]
  public ?array $customLlmExtraBody;

  /**
   * ID of the end user participating in this conversation (for agent owner's user identification)
   */
  #[JsonProperty('user_id')]
  public ?string $userId;

  /**
   * Information about the source of conversation initiation
   */
  #[JsonProperty('source_info')]
  public ?\ElevenLabs\Types\ConversationInitiationSourceInfo $sourceInfo;

  /**
   * ID of the agent branch to use for this conversation
   */
  #[JsonProperty('branch_id')]
  public ?string $branchId;

  /**
   * Environment to use for resolving environment variables
   */
  #[JsonProperty('environment')]
  public ?string $environment;

  /**
   * If set, start the workflow at this node id instead of the default entry
   */
  #[JsonProperty('starting_workflow_node_id')]
  public ?string $startingWorkflowNodeId;

  /**
   * @var string[]|null
   * If set, only these procedures are available to the starting agent. Each ID must be attached to that agent; unknown IDs fail conversation start. An empty list disables all of that agent's procedures. Not applied after an agent transfer. Requires enable_procedure_ids_from_client.
   */
  #[JsonProperty('procedure_ids'), ArrayType(['string'])]
  public ?array $procedureIds;

  /**
   * @var string[]|null
   * If set, these free-form procedures start when the conversation starts. Accepts at most five IDs. Each ID must be available after procedure_ids is applied. Unknown IDs and structured procedures fail conversation start. Requires enable_procedure_ids_from_client.
   */
  #[JsonProperty('start_procedure_ids'), ArrayType(['string'])]
  public ?array $startProcedureIds;

  /**
   * @var array<string, mixed>|null
   */
  #[JsonProperty('dynamic_variables'), ArrayType(['string' => 'mixed'])]
  public ?array $dynamicVariables;

  /**
   * @param array{
   *   conversationConfigOverride?: ?\ElevenLabs\Types\ConversationConfigClientOverrideInput,
   *   customLlmExtraBody?: array<string, mixed>|null,
   *   userId?: ?string,
   *   sourceInfo?: ?\ElevenLabs\Types\ConversationInitiationSourceInfo,
   *   branchId?: ?string,
   *   environment?: ?string,
   *   startingWorkflowNodeId?: ?string,
   *   procedureIds?: string[]|null,
   *   startProcedureIds?: string[]|null,
   *   dynamicVariables?: array<string, mixed>|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->conversationConfigOverride = $values['conversationConfigOverride'] ?? null;
    $this->customLlmExtraBody = $values['customLlmExtraBody'] ?? null;
    $this->userId = $values['userId'] ?? null;
    $this->sourceInfo = $values['sourceInfo'] ?? null;
    $this->branchId = $values['branchId'] ?? null;
    $this->environment = $values['environment'] ?? null;
    $this->startingWorkflowNodeId = $values['startingWorkflowNodeId'] ?? null;
    $this->procedureIds = $values['procedureIds'] ?? null;
    $this->startProcedureIds = $values['startProcedureIds'] ?? null;
    $this->dynamicVariables = $values['dynamicVariables'] ?? null;

    if (array_key_exists('conversationConfigOverride', $values)) {
      $this->_dirtyFields['conversation_config_override'] = true;
    }
    if (array_key_exists('customLlmExtraBody', $values)) {
      $this->_dirtyFields['custom_llm_extra_body'] = true;
    }
    if (array_key_exists('userId', $values)) {
      $this->_dirtyFields['user_id'] = true;
    }
    if (array_key_exists('sourceInfo', $values)) {
      $this->_dirtyFields['source_info'] = true;
    }
    if (array_key_exists('branchId', $values)) {
      $this->_dirtyFields['branch_id'] = true;
    }
    if (array_key_exists('environment', $values)) {
      $this->_dirtyFields['environment'] = true;
    }
    if (array_key_exists('startingWorkflowNodeId', $values)) {
      $this->_dirtyFields['starting_workflow_node_id'] = true;
    }
    if (array_key_exists('procedureIds', $values)) {
      $this->_dirtyFields['procedure_ids'] = true;
    }
    if (array_key_exists('startProcedureIds', $values)) {
      $this->_dirtyFields['start_procedure_ids'] = true;
    }
    if (array_key_exists('dynamicVariables', $values)) {
      $this->_dirtyFields['dynamic_variables'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->conversationConfigOverride !== null) {
      $parts[] = [
        'name' => 'conversation_config_override',
        'contents' => json_encode($this->conversationConfigOverride),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->customLlmExtraBody !== null) {
      $parts[] = [
        'name' => 'custom_llm_extra_body',
        'contents' => json_encode($this->customLlmExtraBody),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->userId !== null) {
      $parts[] = [
        'name' => 'user_id',
        'contents' => $this->userId
      ];
    }

    if ($this->sourceInfo !== null) {
      $parts[] = [
        'name' => 'source_info',
        'contents' => json_encode($this->sourceInfo),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->branchId !== null) {
      $parts[] = [
        'name' => 'branch_id',
        'contents' => $this->branchId
      ];
    }

    if ($this->environment !== null) {
      $parts[] = [
        'name' => 'environment',
        'contents' => $this->environment
      ];
    }

    if ($this->startingWorkflowNodeId !== null) {
      $parts[] = [
        'name' => 'starting_workflow_node_id',
        'contents' => $this->startingWorkflowNodeId
      ];
    }

    if ($this->procedureIds !== null) {
      foreach ($this->procedureIds ?? [] as $item) {
        $parts[] = [
          'name' => 'procedure_ids',
          'contents' => $item
        ];
      }
    }

    if ($this->startProcedureIds !== null) {
      foreach ($this->startProcedureIds ?? [] as $item) {
        $parts[] = [
          'name' => 'start_procedure_ids',
          'contents' => $item
        ];
      }
    }

    if ($this->dynamicVariables !== null) {
      $parts[] = [
        'name' => 'dynamic_variables',
        'contents' => json_encode($this->dynamicVariables),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->conversationConfigOverride?->validate();
    $this->sourceInfo?->validate();
  }
}
