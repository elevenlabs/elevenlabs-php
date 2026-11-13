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
class AgentSummaryResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The ID of the agent
   */
  #[JsonProperty('agent_id', required: true)]
  public string $agentId;

  /**
   * The name of the agent
   */
  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * Voice ID assigned to this agent
   */
  #[JsonProperty('voice_id', required: true)]
  public string $voiceId;

  /**
   * @var string[]
   * Agent tags used to categorize the agent
   */
  #[JsonProperty('tags', required: true), ArrayType(['string'])]
  public array $tags;

  /**
   * The creation time of the agent in unix seconds
   */
  #[JsonProperty('created_at_unix_secs', required: true)]
  public int $createdAtUnixSecs;

  /**
   * The last time the agent's main branch or agent-level settings were updated, in unix seconds
   */
  #[JsonProperty('updated_at_unix_secs', required: true)]
  public int $updatedAtUnixSecs;

  #[JsonProperty('access_info', required: true)]
  public \ElevenLabs\Types\ResourceAccessInfo $accessInfo;

  /**
   * The time of the most recent call in unix seconds, null if no calls have been made
   */
  #[JsonProperty('last_call_time_unix_secs')]
  public ?int $lastCallTimeUnixSecs;

  /**
   * Whether the agent is archived
   */
  #[JsonProperty('archived')]
  public ?bool $archived;

  /**
   * @param array{
   *   agentId: string,
   *   name: string,
   *   voiceId: string,
   *   tags: string[],
   *   createdAtUnixSecs: int,
   *   updatedAtUnixSecs: int,
   *   accessInfo: \ElevenLabs\Types\ResourceAccessInfo,
   *   lastCallTimeUnixSecs?: ?int,
   *   archived?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->agentId = $values['agentId'];
    $this->name = $values['name'];
    $this->voiceId = $values['voiceId'];
    $this->tags = $values['tags'];
    $this->createdAtUnixSecs = $values['createdAtUnixSecs'];
    $this->updatedAtUnixSecs = $values['updatedAtUnixSecs'];
    $this->accessInfo = $values['accessInfo'];
    $this->lastCallTimeUnixSecs = $values['lastCallTimeUnixSecs'] ?? null;
    $this->archived = $values['archived'] ?? null;

    $this->_dirtyFields = [
      'agent_id' => true,
      'name' => true,
      'voice_id' => true,
      'tags' => true,
      'created_at_unix_secs' => true,
      'updated_at_unix_secs' => true,
      'access_info' => true
    ];
    if (array_key_exists('lastCallTimeUnixSecs', $values)) {
      $this->_dirtyFields['last_call_time_unix_secs'] = true;
    }
    if (array_key_exists('archived', $values)) {
      $this->_dirtyFields['archived'] = true;
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
      'name' => 'name',
      'contents' => $this->name
    ];

    $parts[] = [
      'name' => 'voice_id',
      'contents' => $this->voiceId
    ];

    foreach ($this->tags as $item) {
      $parts[] = [
        'name' => 'tags',
        'contents' => $item
      ];
    }

    $parts[] = [
      'name' => 'created_at_unix_secs',
      'contents' => (string) $this->createdAtUnixSecs
    ];

    $parts[] = [
      'name' => 'updated_at_unix_secs',
      'contents' => (string) $this->updatedAtUnixSecs
    ];

    $parts[] = [
      'name' => 'access_info',
      'contents' => json_encode($this->accessInfo),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->lastCallTimeUnixSecs !== null) {
      $parts[] = [
        'name' => 'last_call_time_unix_secs',
        'contents' => (string) $this->lastCallTimeUnixSecs
      ];
    }

    if ($this->archived !== null) {
      $parts[] = [
        'name' => 'archived',
        'contents' => $this->archived ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->accessInfo->validate();
  }
}
