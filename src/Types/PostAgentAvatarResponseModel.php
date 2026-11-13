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
class PostAgentAvatarResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('agent_id', required: true)]
  public string $agentId;

  #[JsonProperty('avatar_url')]
  public ?string $avatarUrl;

  /**
   * @param array{
   *   agentId: string,
   *   avatarUrl?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->agentId = $values['agentId'];
    $this->avatarUrl = $values['avatarUrl'] ?? null;

    $this->_dirtyFields = [
      'agent_id' => true
    ];
    if (array_key_exists('avatarUrl', $values)) {
      $this->_dirtyFields['avatar_url'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'agent_id',
      'contents' => $this->agentId
    ];

    if ($this->avatarUrl !== null) {
      $parts[] = [
        'name' => 'avatar_url',
        'contents' => $this->avatarUrl
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
