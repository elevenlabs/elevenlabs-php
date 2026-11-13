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
class ConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelOutput extends
  JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('request_id', required: true)]
  public string $requestId;

  #[JsonProperty('tool_name', required: true)]
  public string $toolName;

  /**
   * ID of the tool that produced this result: a workspace tool ID, 'mcp:<server_id>:<tool_name>' for MCP tools, or '__system_<tool_name>' for system tools. Not set for conversations recorded before tool IDs were tracked.
   */
  #[JsonProperty('tool_id', required: true)]
  public ?string $toolId;

  #[JsonProperty('result_value', required: true)]
  public string $resultValue;

  #[JsonProperty('is_error', required: true)]
  public bool $isError;

  #[JsonProperty('is_blocked', required: true)]
  public bool $isBlocked;

  #[JsonProperty('tool_has_been_called', required: true)]
  public bool $toolHasBeenCalled;

  #[JsonProperty('tool_latency_secs', required: true)]
  public float $toolLatencySecs;

  #[JsonProperty('error_type', required: true)]
  public string $errorType;

  #[JsonProperty('raw_error_message', required: true)]
  public string $rawErrorMessage;

  /**
   * @var \ElevenLabs\Types\DynamicVariableUpdateCommonModel[]
   */
  #[
    JsonProperty('dynamic_variable_updates', required: true),
    ArrayType([\ElevenLabs\Types\DynamicVariableUpdateCommonModel::class])
  ]
  public array $dynamicVariableUpdates;

  /**
   * @var value-of<\ElevenLabs\Types\ConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelOutputType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  #[JsonProperty('integration_id', required: true)]
  public string $integrationId;

  #[JsonProperty('credential_id', required: true)]
  public string $credentialId;

  #[JsonProperty('integration_connection_id', required: true)]
  public string $integrationConnectionId;

  /**
   * @param array{
   *   requestId: string,
   *   toolName: string,
   *   toolId: ?string,
   *   resultValue: string,
   *   isError: bool,
   *   isBlocked: bool,
   *   toolHasBeenCalled: bool,
   *   toolLatencySecs: float,
   *   errorType: string,
   *   rawErrorMessage: string,
   *   dynamicVariableUpdates: \ElevenLabs\Types\DynamicVariableUpdateCommonModel[],
   *   type: value-of<\ElevenLabs\Types\ConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelOutputType>,
   *   integrationId: string,
   *   credentialId: string,
   *   integrationConnectionId: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->requestId = $values['requestId'];
    $this->toolName = $values['toolName'];
    $this->toolId = $values['toolId'];
    $this->resultValue = $values['resultValue'];
    $this->isError = $values['isError'];
    $this->isBlocked = $values['isBlocked'];
    $this->toolHasBeenCalled = $values['toolHasBeenCalled'];
    $this->toolLatencySecs = $values['toolLatencySecs'];
    $this->errorType = $values['errorType'];
    $this->rawErrorMessage = $values['rawErrorMessage'];
    $this->dynamicVariableUpdates = $values['dynamicVariableUpdates'];
    $this->type = $values['type'];
    $this->integrationId = $values['integrationId'];
    $this->credentialId = $values['credentialId'];
    $this->integrationConnectionId = $values['integrationConnectionId'];

    $this->_dirtyFields = [
      'request_id' => true,
      'tool_name' => true,
      'tool_id' => true,
      'result_value' => true,
      'is_error' => true,
      'is_blocked' => true,
      'tool_has_been_called' => true,
      'tool_latency_secs' => true,
      'error_type' => true,
      'raw_error_message' => true,
      'dynamic_variable_updates' => true,
      'type' => true,
      'integration_id' => true,
      'credential_id' => true,
      'integration_connection_id' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'request_id',
      'contents' => $this->requestId
    ];

    $parts[] = [
      'name' => 'tool_name',
      'contents' => $this->toolName
    ];

    $parts[] = [
      'name' => 'tool_id',
      'contents' => $this->toolId
    ];

    $parts[] = [
      'name' => 'result_value',
      'contents' => $this->resultValue
    ];

    $parts[] = [
      'name' => 'is_error',
      'contents' => $this->isError ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'is_blocked',
      'contents' => $this->isBlocked ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'tool_has_been_called',
      'contents' => $this->toolHasBeenCalled ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'tool_latency_secs',
      'contents' => (string) $this->toolLatencySecs
    ];

    $parts[] = [
      'name' => 'error_type',
      'contents' => $this->errorType
    ];

    $parts[] = [
      'name' => 'raw_error_message',
      'contents' => $this->rawErrorMessage
    ];

    $parts[] = [
      'name' => 'dynamic_variable_updates',
      'contents' => json_encode($this->dynamicVariableUpdates),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
    ];

    $parts[] = [
      'name' => 'integration_id',
      'contents' => $this->integrationId
    ];

    $parts[] = [
      'name' => 'credential_id',
      'contents' => $this->credentialId
    ];

    $parts[] = [
      'name' => 'integration_connection_id',
      'contents' => $this->integrationConnectionId
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->dynamicVariableUpdates as $item) {
      $item->validate();
    }
  }
}
