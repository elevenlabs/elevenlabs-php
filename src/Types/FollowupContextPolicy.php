<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * Which `campaign__` dynamic variables follow-up calls get.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class FollowupContextPolicy extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Pass the call type as `campaign__call_type`.
   */
  #[JsonProperty('call_type')]
  public ?bool $callType;

  /**
   * Pass the last conversation's ID as `campaign__previous_conversation_id`.
   */
  #[JsonProperty('previous_conversation_id')]
  public ?bool $previousConversationId;

  /**
   * Pass the last conversation's summary as `campaign__previous_summary`.
   */
  #[JsonProperty('previous_summary')]
  public ?bool $previousSummary;

  /**
   * Pass the last conversation's transcript as `campaign__previous_transcript`.
   */
  #[JsonProperty('previous_transcript')]
  public ?bool $previousTranscript;

  /**
   * @param array{
   *   callType?: ?bool,
   *   previousConversationId?: ?bool,
   *   previousSummary?: ?bool,
   *   previousTranscript?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->callType = $values['callType'] ?? null;
    $this->previousConversationId = $values['previousConversationId'] ?? null;
    $this->previousSummary = $values['previousSummary'] ?? null;
    $this->previousTranscript = $values['previousTranscript'] ?? null;

    if (array_key_exists('callType', $values)) {
      $this->_dirtyFields['call_type'] = true;
    }
    if (array_key_exists('previousConversationId', $values)) {
      $this->_dirtyFields['previous_conversation_id'] = true;
    }
    if (array_key_exists('previousSummary', $values)) {
      $this->_dirtyFields['previous_summary'] = true;
    }
    if (array_key_exists('previousTranscript', $values)) {
      $this->_dirtyFields['previous_transcript'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->callType !== null) {
      $parts[] = [
        'name' => 'call_type',
        'contents' => $this->callType ? 'true' : 'false'
      ];
    }

    if ($this->previousConversationId !== null) {
      $parts[] = [
        'name' => 'previous_conversation_id',
        'contents' => $this->previousConversationId ? 'true' : 'false'
      ];
    }

    if ($this->previousSummary !== null) {
      $parts[] = [
        'name' => 'previous_summary',
        'contents' => $this->previousSummary ? 'true' : 'false'
      ];
    }

    if ($this->previousTranscript !== null) {
      $parts[] = [
        'name' => 'previous_transcript',
        'contents' => $this->previousTranscript ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
