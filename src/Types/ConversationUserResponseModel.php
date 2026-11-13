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
class ConversationUserResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('user_id', required: true)]
  public string $userId;

  #[JsonProperty('last_contact_unix_secs', required: true)]
  public int $lastContactUnixSecs;

  #[JsonProperty('first_contact_unix_secs', required: true)]
  public int $firstContactUnixSecs;

  #[JsonProperty('conversation_count', required: true)]
  public int $conversationCount;

  #[JsonProperty('last_contact_agent_id')]
  public ?string $lastContactAgentId;

  #[JsonProperty('last_contact_conversation_id', required: true)]
  public string $lastContactConversationId;

  #[JsonProperty('last_contact_agent_name')]
  public ?string $lastContactAgentName;

  #[JsonProperty('sentiment', required: true)]
  public \ElevenLabs\Types\SentimentAggregate $sentiment;

  /**
   * @var \ElevenLabs\Types\FrustratedConversationRef[]|null
   */
  #[
    JsonProperty('most_frustrated_conversations'),
    ArrayType([\ElevenLabs\Types\FrustratedConversationRef::class])
  ]
  public ?array $mostFrustratedConversations;

  /**
   * @param array{
   *   userId: string,
   *   lastContactUnixSecs: int,
   *   firstContactUnixSecs: int,
   *   conversationCount: int,
   *   lastContactConversationId: string,
   *   sentiment: \ElevenLabs\Types\SentimentAggregate,
   *   lastContactAgentId?: ?string,
   *   lastContactAgentName?: ?string,
   *   mostFrustratedConversations?: \ElevenLabs\Types\FrustratedConversationRef[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->userId = $values['userId'];
    $this->lastContactUnixSecs = $values['lastContactUnixSecs'];
    $this->firstContactUnixSecs = $values['firstContactUnixSecs'];
    $this->conversationCount = $values['conversationCount'];
    $this->lastContactAgentId = $values['lastContactAgentId'] ?? null;
    $this->lastContactConversationId = $values['lastContactConversationId'];
    $this->lastContactAgentName = $values['lastContactAgentName'] ?? null;
    $this->sentiment = $values['sentiment'];
    $this->mostFrustratedConversations = $values['mostFrustratedConversations'] ?? null;

    $this->_dirtyFields = [
      'user_id' => true,
      'last_contact_unix_secs' => true,
      'first_contact_unix_secs' => true,
      'conversation_count' => true,
      'last_contact_conversation_id' => true,
      'sentiment' => true
    ];
    if (array_key_exists('lastContactAgentId', $values)) {
      $this->_dirtyFields['last_contact_agent_id'] = true;
    }
    if (array_key_exists('lastContactAgentName', $values)) {
      $this->_dirtyFields['last_contact_agent_name'] = true;
    }
    if (array_key_exists('mostFrustratedConversations', $values)) {
      $this->_dirtyFields['most_frustrated_conversations'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'user_id',
      'contents' => $this->userId
    ];

    $parts[] = [
      'name' => 'last_contact_unix_secs',
      'contents' => (string) $this->lastContactUnixSecs
    ];

    $parts[] = [
      'name' => 'first_contact_unix_secs',
      'contents' => (string) $this->firstContactUnixSecs
    ];

    $parts[] = [
      'name' => 'conversation_count',
      'contents' => (string) $this->conversationCount
    ];

    if ($this->lastContactAgentId !== null) {
      $parts[] = [
        'name' => 'last_contact_agent_id',
        'contents' => $this->lastContactAgentId
      ];
    }

    $parts[] = [
      'name' => 'last_contact_conversation_id',
      'contents' => $this->lastContactConversationId
    ];

    if ($this->lastContactAgentName !== null) {
      $parts[] = [
        'name' => 'last_contact_agent_name',
        'contents' => $this->lastContactAgentName
      ];
    }

    $parts[] = [
      'name' => 'sentiment',
      'contents' => json_encode($this->sentiment),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->mostFrustratedConversations !== null) {
      $parts[] = [
        'name' => 'most_frustrated_conversations',
        'contents' => json_encode($this->mostFrustratedConversations),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->sentiment->validate();
    foreach ($this->mostFrustratedConversations ?? [] as $item) {
      $item->validate();
    }
  }
}
