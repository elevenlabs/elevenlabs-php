<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Conversations\Requests;

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
class CreateAgentConversationRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('agent', required: true)]
  public \ElevenLabs\Types\AgentMessagesPersistedAgent $agent;

  /**
   * The environment to use for resolving environment variables (e.g. 'production', 'staging'). Defaults to the branch's environment, then 'production'.
   */
  #[JsonProperty('environment')]
  public ?string $environment;

  /**
   * ID of the end user participating in this conversation (for agent owner's user identification)
   */
  #[JsonProperty('user_id')]
  public ?string $userId;

  /**
   * @var array<string, mixed>|null
   */
  #[JsonProperty('dynamic_variables'), ArrayType(['string' => 'mixed'])]
  public ?array $dynamicVariables;

  /**
   * @param array{
   *   agent: \ElevenLabs\Types\AgentMessagesPersistedAgent,
   *   environment?: ?string,
   *   userId?: ?string,
   *   dynamicVariables?: array<string, mixed>|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->agent = $values['agent'];
    $this->environment = $values['environment'] ?? null;
    $this->userId = $values['userId'] ?? null;
    $this->dynamicVariables = $values['dynamicVariables'] ?? null;

    $this->_dirtyFields = [
      'agent' => true
    ];
    if (array_key_exists('environment', $values)) {
      $this->_dirtyFields['environment'] = true;
    }
    if (array_key_exists('userId', $values)) {
      $this->_dirtyFields['user_id'] = true;
    }
    if (array_key_exists('dynamicVariables', $values)) {
      $this->_dirtyFields['dynamic_variables'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'agent',
      'contents' => json_encode($this->agent),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->environment !== null) {
      $parts[] = [
        'name' => 'environment',
        'contents' => $this->environment
      ];
    }

    if ($this->userId !== null) {
      $parts[] = [
        'name' => 'user_id',
        'contents' => $this->userId
      ];
    }

    if ($this->dynamicVariables !== null) {
      $parts[] = [
        'name' => 'dynamic_variables',
        'contents' => json_encode($this->dynamicVariables),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->agent->validate();
  }
}
