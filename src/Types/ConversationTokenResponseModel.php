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
class ConversationTokenResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The ID of the agent
   */
  #[JsonProperty('agent_id', required: true)]
  public string $agentId;

  /**
   * The token for the agent
   */
  #[JsonProperty('conversation_token', required: true)]
  public string $conversationToken;

  /**
   * The expiration time of the token in unix seconds
   */
  #[JsonProperty('expiration_time_unix_secs')]
  public ?int $expirationTimeUnixSecs;

  /**
   * The ID of the conversation
   */
  #[JsonProperty('conversation_id')]
  public ?string $conversationId;

  /**
   * @var value-of<\ElevenLabs\Types\ConversationTokenPurpose>
   */
  #[JsonProperty('purpose', required: true)]
  public string $purpose;

  /**
   * The user ID of the entity who requested the token
   */
  #[JsonProperty('token_requester_user_id')]
  public ?string $tokenRequesterUserId;

  /**
   * @param array{
   *   agentId: string,
   *   conversationToken: string,
   *   purpose: value-of<\ElevenLabs\Types\ConversationTokenPurpose>,
   *   expirationTimeUnixSecs?: ?int,
   *   conversationId?: ?string,
   *   tokenRequesterUserId?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->agentId = $values['agentId'];
    $this->conversationToken = $values['conversationToken'];
    $this->expirationTimeUnixSecs = $values['expirationTimeUnixSecs'] ?? null;
    $this->conversationId = $values['conversationId'] ?? null;
    $this->purpose = $values['purpose'];
    $this->tokenRequesterUserId = $values['tokenRequesterUserId'] ?? null;

    $this->_dirtyFields = [
      'agent_id' => true,
      'conversation_token' => true,
      'purpose' => true
    ];
    if (array_key_exists('expirationTimeUnixSecs', $values)) {
      $this->_dirtyFields['expiration_time_unix_secs'] = true;
    }
    if (array_key_exists('conversationId', $values)) {
      $this->_dirtyFields['conversation_id'] = true;
    }
    if (array_key_exists('tokenRequesterUserId', $values)) {
      $this->_dirtyFields['token_requester_user_id'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'agent_id',
      'contents' => $this->agentId
    ];

    $parts[] = [
      'name' => 'conversation_token',
      'contents' => $this->conversationToken
    ];

    if ($this->expirationTimeUnixSecs !== null) {
      $parts[] = [
        'name' => 'expiration_time_unix_secs',
        'contents' => (string) $this->expirationTimeUnixSecs
      ];
    }

    if ($this->conversationId !== null) {
      $parts[] = [
        'name' => 'conversation_id',
        'contents' => $this->conversationId
      ];
    }

    $parts[] = [
      'name' => 'purpose',
      'contents' => $this->purpose
    ];

    if ($this->tokenRequesterUserId !== null) {
      $parts[] = [
        'name' => 'token_requester_user_id',
        'contents' => $this->tokenRequesterUserId
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
