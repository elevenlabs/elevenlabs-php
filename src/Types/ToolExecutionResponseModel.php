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
class ToolExecutionResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The ID of the tool that was executed
   */
  #[JsonProperty('tool_id', required: true)]
  public string $toolId;

  /**
   * The request/call ID associated with this tool execution
   */
  #[JsonProperty('tool_request_id', required: true)]
  public string $toolRequestId;

  /**
   * The ID of the conversation where the tool was executed
   */
  #[JsonProperty('conversation_id', required: true)]
  public string $conversationId;

  /**
   * The ID of the agent that ran the tool
   */
  #[JsonProperty('agent_id', required: true)]
  public string $agentId;

  /**
   * The branch ID if the agent has branches
   */
  #[JsonProperty('branch_id')]
  public ?string $branchId;

  /**
   * Unix timestamp when the tool was executed
   */
  #[JsonProperty('timestamp', required: true)]
  public float $timestamp;

  /**
   * How long the tool execution took
   */
  #[JsonProperty('latency_secs', required: true)]
  public float $latencySecs;

  /**
   * Whether the tool execution failed
   */
  #[JsonProperty('is_error')]
  public ?bool $isError;

  /**
   * LLM-extracted parameters sent to the tool (JSON string)
   */
  #[JsonProperty('request_payload')]
  public ?string $requestPayload;

  /**
   * Response returned by the tool
   */
  #[JsonProperty('response_payload')]
  public ?string $responsePayload;

  /**
   * Error message if the tool execution failed
   */
  #[JsonProperty('error_message')]
  public ?string $errorMessage;

  /**
   * Error category (internal, customer_config, customer_auth, external_server, external_client, client_timeout, unknown)
   */
  #[JsonProperty('error_type')]
  public ?string $errorType;

  #[JsonProperty('id', required: true)]
  public string $id;

  #[JsonProperty('tool_call_details')]
  public ?\ElevenLabs\Types\ToolExecutionResponseModelToolCallDetails $toolCallDetails;

  /**
   * @param array{
   *   toolId: string,
   *   toolRequestId: string,
   *   conversationId: string,
   *   agentId: string,
   *   timestamp: float,
   *   latencySecs: float,
   *   id: string,
   *   branchId?: ?string,
   *   isError?: ?bool,
   *   requestPayload?: ?string,
   *   responsePayload?: ?string,
   *   errorMessage?: ?string,
   *   errorType?: ?string,
   *   toolCallDetails?: ?\ElevenLabs\Types\ToolExecutionResponseModelToolCallDetails,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->toolId = $values['toolId'];
    $this->toolRequestId = $values['toolRequestId'];
    $this->conversationId = $values['conversationId'];
    $this->agentId = $values['agentId'];
    $this->branchId = $values['branchId'] ?? null;
    $this->timestamp = $values['timestamp'];
    $this->latencySecs = $values['latencySecs'];
    $this->isError = $values['isError'] ?? null;
    $this->requestPayload = $values['requestPayload'] ?? null;
    $this->responsePayload = $values['responsePayload'] ?? null;
    $this->errorMessage = $values['errorMessage'] ?? null;
    $this->errorType = $values['errorType'] ?? null;
    $this->id = $values['id'];
    $this->toolCallDetails = $values['toolCallDetails'] ?? null;

    $this->_dirtyFields = [
      'tool_id' => true,
      'tool_request_id' => true,
      'conversation_id' => true,
      'agent_id' => true,
      'timestamp' => true,
      'latency_secs' => true,
      'id' => true
    ];
    if (array_key_exists('branchId', $values)) {
      $this->_dirtyFields['branch_id'] = true;
    }
    if (array_key_exists('isError', $values)) {
      $this->_dirtyFields['is_error'] = true;
    }
    if (array_key_exists('requestPayload', $values)) {
      $this->_dirtyFields['request_payload'] = true;
    }
    if (array_key_exists('responsePayload', $values)) {
      $this->_dirtyFields['response_payload'] = true;
    }
    if (array_key_exists('errorMessage', $values)) {
      $this->_dirtyFields['error_message'] = true;
    }
    if (array_key_exists('errorType', $values)) {
      $this->_dirtyFields['error_type'] = true;
    }
    if (array_key_exists('toolCallDetails', $values)) {
      $this->_dirtyFields['tool_call_details'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'tool_id',
      'contents' => $this->toolId
    ];

    $parts[] = [
      'name' => 'tool_request_id',
      'contents' => $this->toolRequestId
    ];

    $parts[] = [
      'name' => 'conversation_id',
      'contents' => $this->conversationId
    ];

    $parts[] = [
      'name' => 'agent_id',
      'contents' => $this->agentId
    ];

    if ($this->branchId !== null) {
      $parts[] = [
        'name' => 'branch_id',
        'contents' => $this->branchId
      ];
    }

    $parts[] = [
      'name' => 'timestamp',
      'contents' => (string) $this->timestamp
    ];

    $parts[] = [
      'name' => 'latency_secs',
      'contents' => (string) $this->latencySecs
    ];

    if ($this->isError !== null) {
      $parts[] = [
        'name' => 'is_error',
        'contents' => $this->isError ? 'true' : 'false'
      ];
    }

    if ($this->requestPayload !== null) {
      $parts[] = [
        'name' => 'request_payload',
        'contents' => $this->requestPayload
      ];
    }

    if ($this->responsePayload !== null) {
      $parts[] = [
        'name' => 'response_payload',
        'contents' => $this->responsePayload
      ];
    }

    if ($this->errorMessage !== null) {
      $parts[] = [
        'name' => 'error_message',
        'contents' => $this->errorMessage
      ];
    }

    if ($this->errorType !== null) {
      $parts[] = [
        'name' => 'error_type',
        'contents' => $this->errorType
      ];
    }

    $parts[] = [
      'name' => 'id',
      'contents' => $this->id
    ];

    if ($this->toolCallDetails !== null) {
      $parts[] = [
        'name' => 'tool_call_details',
        'contents' => json_encode($this->toolCallDetails),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
