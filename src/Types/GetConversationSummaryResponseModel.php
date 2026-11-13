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
class GetConversationSummaryResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('conversation_id', required: true)]
  public string $conversationId;

  #[JsonProperty('agent_id', required: true)]
  public string $agentId;

  /**
   * @var value-of<\ElevenLabs\Types\GetConversationSummaryResponseModelStatus>
   */
  #[JsonProperty('status', required: true)]
  public string $status;

  /**
   * Short generated title for the conversation.
   */
  #[JsonProperty('call_summary_title')]
  public ?string $callSummaryTitle;

  /**
   * Generated natural-language summary of the call.
   */
  #[JsonProperty('transcript_summary')]
  public ?string $transcriptSummary;

  /**
   * @var ?value-of<\ElevenLabs\Types\EvaluationSuccessResult>
   */
  #[JsonProperty('call_successful')]
  public ?string $callSuccessful;

  /**
   * Number of plain chat message turns in the conversation.
   */
  #[JsonProperty('message_count', required: true)]
  public int $messageCount;

  /**
   * @var \ElevenLabs\Types\ConversationSummaryMessageModel[]|null
   * The plain chat messages (role and text only). Included only when message_count does not exceed the requested max_messages; otherwise null and messages_omitted is true.
   */
  #[JsonProperty('messages'), ArrayType([\ElevenLabs\Types\ConversationSummaryMessageModel::class])]
  public ?array $messages;

  /**
   * True when the chat messages were omitted because the conversation was too long. Fetch the full transcript for the messages.
   */
  #[JsonProperty('messages_omitted')]
  public ?bool $messagesOmitted;

  /**
   * Guidance telling the agent how to get the full transcript.
   */
  #[JsonProperty('note', required: true)]
  public string $note;

  /**
   * @param array{
   *   conversationId: string,
   *   agentId: string,
   *   status: value-of<\ElevenLabs\Types\GetConversationSummaryResponseModelStatus>,
   *   messageCount: int,
   *   note: string,
   *   callSummaryTitle?: ?string,
   *   transcriptSummary?: ?string,
   *   callSuccessful?: ?value-of<\ElevenLabs\Types\EvaluationSuccessResult>,
   *   messages?: \ElevenLabs\Types\ConversationSummaryMessageModel[]|null,
   *   messagesOmitted?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->conversationId = $values['conversationId'];
    $this->agentId = $values['agentId'];
    $this->status = $values['status'];
    $this->callSummaryTitle = $values['callSummaryTitle'] ?? null;
    $this->transcriptSummary = $values['transcriptSummary'] ?? null;
    $this->callSuccessful = $values['callSuccessful'] ?? null;
    $this->messageCount = $values['messageCount'];
    $this->messages = $values['messages'] ?? null;
    $this->messagesOmitted = $values['messagesOmitted'] ?? null;
    $this->note = $values['note'];

    $this->_dirtyFields = [
      'conversation_id' => true,
      'agent_id' => true,
      'status' => true,
      'message_count' => true,
      'note' => true
    ];
    if (array_key_exists('callSummaryTitle', $values)) {
      $this->_dirtyFields['call_summary_title'] = true;
    }
    if (array_key_exists('transcriptSummary', $values)) {
      $this->_dirtyFields['transcript_summary'] = true;
    }
    if (array_key_exists('callSuccessful', $values)) {
      $this->_dirtyFields['call_successful'] = true;
    }
    if (array_key_exists('messages', $values)) {
      $this->_dirtyFields['messages'] = true;
    }
    if (array_key_exists('messagesOmitted', $values)) {
      $this->_dirtyFields['messages_omitted'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'conversation_id',
      'contents' => $this->conversationId
    ];

    $parts[] = [
      'name' => 'agent_id',
      'contents' => $this->agentId
    ];

    $parts[] = [
      'name' => 'status',
      'contents' => $this->status
    ];

    if ($this->callSummaryTitle !== null) {
      $parts[] = [
        'name' => 'call_summary_title',
        'contents' => $this->callSummaryTitle
      ];
    }

    if ($this->transcriptSummary !== null) {
      $parts[] = [
        'name' => 'transcript_summary',
        'contents' => $this->transcriptSummary
      ];
    }

    if ($this->callSuccessful !== null) {
      $parts[] = [
        'name' => 'call_successful',
        'contents' => $this->callSuccessful
      ];
    }

    $parts[] = [
      'name' => 'message_count',
      'contents' => (string) $this->messageCount
    ];

    if ($this->messages !== null) {
      $parts[] = [
        'name' => 'messages',
        'contents' => json_encode($this->messages),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->messagesOmitted !== null) {
      $parts[] = [
        'name' => 'messages_omitted',
        'contents' => $this->messagesOmitted ? 'true' : 'false'
      ];
    }

    $parts[] = [
      'name' => 'note',
      'contents' => $this->note
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->messages ?? [] as $item) {
      $item->validate();
    }
  }
}
