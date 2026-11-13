<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Core\Types\Union;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class WorkflowToolNestedToolsStepModelOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('step_latency_secs', required: true)]
  public float $stepLatencySecs;

  /**
   * @var ?value-of<\ElevenLabs\Types\WorkflowToolNestedToolsStepModelOutputType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  #[JsonProperty('node_id', required: true)]
  public string $nodeId;

  /**
   * @var \ElevenLabs\Types\ConversationHistoryTranscriptToolCallCommonModelOutput[]
   */
  #[
    JsonProperty('requests', required: true),
    ArrayType([\ElevenLabs\Types\ConversationHistoryTranscriptToolCallCommonModelOutput::class])
  ]
  public array $requests;

  /**
   * @var (\ElevenLabs\Types\ConversationHistoryTranscriptOtherToolsResultCommonModel|\ElevenLabs\Types\ConversationHistoryTranscriptSystemToolResultCommonModelOutput|\ElevenLabs\Types\ConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelOutput|\ElevenLabs\Types\ConversationHistoryTranscriptWorkflowToolsResultCommonModelOutput)[]
   */
  #[
    JsonProperty('results', required: true),
    ArrayType([
      new Union(
        \ElevenLabs\Types\ConversationHistoryTranscriptOtherToolsResultCommonModel::class,
        \ElevenLabs\Types\ConversationHistoryTranscriptSystemToolResultCommonModelOutput::class,
        \ElevenLabs\Types\ConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelOutput::class,
        \ElevenLabs\Types\ConversationHistoryTranscriptWorkflowToolsResultCommonModelOutput::class
      )
    ])
  ]
  public array $results;

  #[JsonProperty('is_successful', required: true)]
  public bool $isSuccessful;

  /**
   * @param array{
   *   stepLatencySecs: float,
   *   nodeId: string,
   *   requests: \ElevenLabs\Types\ConversationHistoryTranscriptToolCallCommonModelOutput[],
   *   results: (\ElevenLabs\Types\ConversationHistoryTranscriptOtherToolsResultCommonModel|\ElevenLabs\Types\ConversationHistoryTranscriptSystemToolResultCommonModelOutput|\ElevenLabs\Types\ConversationHistoryTranscriptApiIntegrationWebhookToolsResultCommonModelOutput|\ElevenLabs\Types\ConversationHistoryTranscriptWorkflowToolsResultCommonModelOutput)[],
   *   isSuccessful: bool,
   *   type?: ?value-of<\ElevenLabs\Types\WorkflowToolNestedToolsStepModelOutputType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->stepLatencySecs = $values['stepLatencySecs'];
    $this->type = $values['type'] ?? 'nested_tools';
    $this->nodeId = $values['nodeId'];
    $this->requests = $values['requests'];
    $this->results = $values['results'];
    $this->isSuccessful = $values['isSuccessful'];

    $this->_dirtyFields = [
      'step_latency_secs' => true,
      'node_id' => true,
      'requests' => true,
      'results' => true,
      'is_successful' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'step_latency_secs',
      'contents' => (string) $this->stepLatencySecs
    ];

    if ($this->type !== null) {
      $parts[] = [
        'name' => 'type',
        'contents' => $this->type
      ];
    }

    $parts[] = [
      'name' => 'node_id',
      'contents' => $this->nodeId
    ];

    $parts[] = [
      'name' => 'requests',
      'contents' => json_encode($this->requests),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'results',
      'contents' => json_encode($this->results),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'is_successful',
      'contents' => $this->isSuccessful ? 'true' : 'false'
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->requests as $item) {
      $item->validate();
    }
  }
}
