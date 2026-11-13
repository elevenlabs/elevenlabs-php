<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ConversationInitiationClientDataConfigOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('conversation_config_override')]
  public ?\ElevenLabs\Types\ConversationConfigClientOverrideConfigOutput $conversationConfigOverride;

  /**
   * Whether to include custom LLM extra body
   */
  #[JsonProperty('custom_llm_extra_body')]
  public ?bool $customLlmExtraBody;

  /**
   * Whether to enable conversation initiation client data from webhooks
   */
  #[JsonProperty('enable_conversation_initiation_client_data_from_webhook')]
  public ?bool $enableConversationInitiationClientDataFromWebhook;

  /**
   * Whether clients may pass starting_workflow_node_id in initiation client data; if false, sending it fails conversation start.
   */
  #[JsonProperty('enable_starting_workflow_node_id_from_client')]
  public ?bool $enableStartingWorkflowNodeIdFromClient;

  /**
   * Whether clients may pass procedure_ids and start_procedure_ids in initiation client data. procedure_ids selects which of the agent's procedures are available. start_procedure_ids starts free-form procedures when the conversation starts. If false, sending either field fails conversation start.
   */
  #[JsonProperty('enable_procedure_ids_from_client')]
  public ?bool $enableProcedureIdsFromClient;

  /**
   * @param array{
   *   conversationConfigOverride?: ?\ElevenLabs\Types\ConversationConfigClientOverrideConfigOutput,
   *   customLlmExtraBody?: ?bool,
   *   enableConversationInitiationClientDataFromWebhook?: ?bool,
   *   enableStartingWorkflowNodeIdFromClient?: ?bool,
   *   enableProcedureIdsFromClient?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->conversationConfigOverride = $values['conversationConfigOverride'] ?? null;
    $this->customLlmExtraBody = $values['customLlmExtraBody'] ?? null;
    $this->enableConversationInitiationClientDataFromWebhook =
      $values['enableConversationInitiationClientDataFromWebhook'] ?? null;
    $this->enableStartingWorkflowNodeIdFromClient =
      $values['enableStartingWorkflowNodeIdFromClient'] ?? null;
    $this->enableProcedureIdsFromClient = $values['enableProcedureIdsFromClient'] ?? null;

    if (array_key_exists('conversationConfigOverride', $values)) {
      $this->_dirtyFields['conversation_config_override'] = true;
    }
    if (array_key_exists('customLlmExtraBody', $values)) {
      $this->_dirtyFields['custom_llm_extra_body'] = true;
    }
    if (array_key_exists('enableConversationInitiationClientDataFromWebhook', $values)) {
      $this->_dirtyFields['enable_conversation_initiation_client_data_from_webhook'] = true;
    }
    if (array_key_exists('enableStartingWorkflowNodeIdFromClient', $values)) {
      $this->_dirtyFields['enable_starting_workflow_node_id_from_client'] = true;
    }
    if (array_key_exists('enableProcedureIdsFromClient', $values)) {
      $this->_dirtyFields['enable_procedure_ids_from_client'] = true;
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
        'contents' => $this->customLlmExtraBody ? 'true' : 'false'
      ];
    }

    if ($this->enableConversationInitiationClientDataFromWebhook !== null) {
      $parts[] = [
        'name' => 'enable_conversation_initiation_client_data_from_webhook',
        'contents' => $this->enableConversationInitiationClientDataFromWebhook ? 'true' : 'false'
      ];
    }

    if ($this->enableStartingWorkflowNodeIdFromClient !== null) {
      $parts[] = [
        'name' => 'enable_starting_workflow_node_id_from_client',
        'contents' => $this->enableStartingWorkflowNodeIdFromClient ? 'true' : 'false'
      ];
    }

    if ($this->enableProcedureIdsFromClient !== null) {
      $parts[] = [
        'name' => 'enable_procedure_ids_from_client',
        'contents' => $this->enableProcedureIdsFromClient ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->conversationConfigOverride?->validate();
  }
}
