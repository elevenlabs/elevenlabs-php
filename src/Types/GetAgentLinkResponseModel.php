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
class GetAgentLinkResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The ID of the agent
   */
  #[JsonProperty('agent_id', required: true)]
  public string $agentId;

  /**
   * The token data for the agent
   */
  #[JsonProperty('token')]
  public ?\ElevenLabs\Types\ConversationTokenResponseModel $token;

  /**
   * @param array{
   *   agentId: string,
   *   token?: ?\ElevenLabs\Types\ConversationTokenResponseModel,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->agentId = $values['agentId'];
    $this->token = $values['token'] ?? null;

    $this->_dirtyFields = [
      'agent_id' => true
    ];
    if (array_key_exists('token', $values)) {
      $this->_dirtyFields['token'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'agent_id',
      'contents' => $this->agentId
    ];

    if ($this->token !== null) {
      $parts[] = [
        'name' => 'token',
        'contents' => json_encode($this->token),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->token?->validate();
  }
}
