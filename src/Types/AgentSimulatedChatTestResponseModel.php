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
class AgentSimulatedChatTestResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\ConversationHistoryTranscriptResponseModel[]
   */
  #[
    JsonProperty('simulated_conversation', required: true),
    ArrayType([\ElevenLabs\Types\ConversationHistoryTranscriptResponseModel::class])
  ]
  public array $simulatedConversation;

  #[JsonProperty('analysis', required: true)]
  public \ElevenLabs\Types\ConversationHistoryAnalysisCommonModel $analysis;

  /**
   * @param array{
   *   simulatedConversation: \ElevenLabs\Types\ConversationHistoryTranscriptResponseModel[],
   *   analysis: \ElevenLabs\Types\ConversationHistoryAnalysisCommonModel,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->simulatedConversation = $values['simulatedConversation'];
    $this->analysis = $values['analysis'];

    $this->_dirtyFields = [
      'simulated_conversation' => true,
      'analysis' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'simulated_conversation',
      'contents' => json_encode($this->simulatedConversation),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'analysis',
      'contents' => json_encode($this->analysis),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->simulatedConversation as $item) {
      $item->validate();
    }
    $this->analysis->validate();
  }
}
