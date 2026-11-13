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
class ConversationHistoryTranscriptOtherToolsResultCommonModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('request_id', required: true)]
  public string $requestId;

  #[JsonProperty('tool_name', required: true)]
  public string $toolName;

  /**
   * ID of the tool that produced this result: a workspace tool ID, 'mcp:<server_id>:<tool_name>' for MCP tools, or '__system_<tool_name>' for system tools. Not set for conversations recorded before tool IDs were tracked.
   */
  #[JsonProperty('tool_id')]
  public ?string $toolId;

  #[JsonProperty('result_value', required: true)]
  public string $resultValue;

  #[JsonProperty('is_error', required: true)]
  public bool $isError;

  #[JsonProperty('is_blocked')]
  public ?bool $isBlocked;

  #[JsonProperty('tool_has_been_called', required: true)]
  public bool $toolHasBeenCalled;

  #[JsonProperty('tool_latency_secs')]
  public ?float $toolLatencySecs;

  #[JsonProperty('error_type')]
  public ?string $errorType;

  #[JsonProperty('raw_error_message')]
  public ?string $rawErrorMessage;

  /**
   * @var \ElevenLabs\Types\DynamicVariableUpdateCommonModel[]|null
   */
  #[
    JsonProperty('dynamic_variable_updates'),
    ArrayType([\ElevenLabs\Types\DynamicVariableUpdateCommonModel::class])
  ]
  public ?array $dynamicVariableUpdates;

  /**
   * @var ?value-of<\ElevenLabs\Types\ConversationHistoryTranscriptOtherToolsResultCommonModelType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * @param array{
   *   requestId: string,
   *   toolName: string,
   *   resultValue: string,
   *   isError: bool,
   *   toolHasBeenCalled: bool,
   *   toolId?: ?string,
   *   isBlocked?: ?bool,
   *   toolLatencySecs?: ?float,
   *   errorType?: ?string,
   *   rawErrorMessage?: ?string,
   *   dynamicVariableUpdates?: \ElevenLabs\Types\DynamicVariableUpdateCommonModel[]|null,
   *   type?: ?value-of<\ElevenLabs\Types\ConversationHistoryTranscriptOtherToolsResultCommonModelType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->requestId = $values['requestId'];
    $this->toolName = $values['toolName'];
    $this->toolId = $values['toolId'] ?? null;
    $this->resultValue = $values['resultValue'];
    $this->isError = $values['isError'];
    $this->isBlocked = $values['isBlocked'] ?? null;
    $this->toolHasBeenCalled = $values['toolHasBeenCalled'];
    $this->toolLatencySecs = $values['toolLatencySecs'] ?? null;
    $this->errorType = $values['errorType'] ?? null;
    $this->rawErrorMessage = $values['rawErrorMessage'] ?? null;
    $this->dynamicVariableUpdates = $values['dynamicVariableUpdates'] ?? null;
    $this->type = $values['type'] ?? null;

    $this->_dirtyFields = [
      'request_id' => true,
      'tool_name' => true,
      'result_value' => true,
      'is_error' => true,
      'tool_has_been_called' => true
    ];
    if (array_key_exists('toolId', $values)) {
      $this->_dirtyFields['tool_id'] = true;
    }
    if (array_key_exists('isBlocked', $values)) {
      $this->_dirtyFields['is_blocked'] = true;
    }
    if (array_key_exists('toolLatencySecs', $values)) {
      $this->_dirtyFields['tool_latency_secs'] = true;
    }
    if (array_key_exists('errorType', $values)) {
      $this->_dirtyFields['error_type'] = true;
    }
    if (array_key_exists('rawErrorMessage', $values)) {
      $this->_dirtyFields['raw_error_message'] = true;
    }
    if (array_key_exists('dynamicVariableUpdates', $values)) {
      $this->_dirtyFields['dynamic_variable_updates'] = true;
    }
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
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

    if ($this->toolId !== null) {
      $parts[] = [
        'name' => 'tool_id',
        'contents' => $this->toolId
      ];
    }

    $parts[] = [
      'name' => 'result_value',
      'contents' => $this->resultValue
    ];

    $parts[] = [
      'name' => 'is_error',
      'contents' => $this->isError ? 'true' : 'false'
    ];

    if ($this->isBlocked !== null) {
      $parts[] = [
        'name' => 'is_blocked',
        'contents' => $this->isBlocked ? 'true' : 'false'
      ];
    }

    $parts[] = [
      'name' => 'tool_has_been_called',
      'contents' => $this->toolHasBeenCalled ? 'true' : 'false'
    ];

    if ($this->toolLatencySecs !== null) {
      $parts[] = [
        'name' => 'tool_latency_secs',
        'contents' => (string) $this->toolLatencySecs
      ];
    }

    if ($this->errorType !== null) {
      $parts[] = [
        'name' => 'error_type',
        'contents' => $this->errorType
      ];
    }

    if ($this->rawErrorMessage !== null) {
      $parts[] = [
        'name' => 'raw_error_message',
        'contents' => $this->rawErrorMessage
      ];
    }

    if ($this->dynamicVariableUpdates !== null) {
      $parts[] = [
        'name' => 'dynamic_variable_updates',
        'contents' => json_encode($this->dynamicVariableUpdates),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->type !== null) {
      $parts[] = [
        'name' => 'type',
        'contents' => $this->type
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->dynamicVariableUpdates ?? [] as $item) {
      $item->validate();
    }
  }
}
