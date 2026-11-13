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
class GetAgentConversationTicketsPageResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\AgentConversationTicketResponseModel[]
   */
  #[
    JsonProperty('agent_conversation_tickets', required: true),
    ArrayType([\ElevenLabs\Types\AgentConversationTicketResponseModel::class])
  ]
  public array $agentConversationTickets;

  #[JsonProperty('next_cursor')]
  public ?string $nextCursor;

  #[JsonProperty('has_more', required: true)]
  public bool $hasMore;

  /**
   * @param array{
   *   agentConversationTickets: \ElevenLabs\Types\AgentConversationTicketResponseModel[],
   *   hasMore: bool,
   *   nextCursor?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->agentConversationTickets = $values['agentConversationTickets'];
    $this->nextCursor = $values['nextCursor'] ?? null;
    $this->hasMore = $values['hasMore'];

    $this->_dirtyFields = [
      'agent_conversation_tickets' => true,
      'has_more' => true
    ];
    if (array_key_exists('nextCursor', $values)) {
      $this->_dirtyFields['next_cursor'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'agent_conversation_tickets',
      'contents' => json_encode($this->agentConversationTickets),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->nextCursor !== null) {
      $parts[] = [
        'name' => 'next_cursor',
        'contents' => $this->nextCursor
      ];
    }

    $parts[] = [
      'name' => 'has_more',
      'contents' => $this->hasMore ? 'true' : 'false'
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->agentConversationTickets as $item) {
      $item->validate();
    }
  }
}
