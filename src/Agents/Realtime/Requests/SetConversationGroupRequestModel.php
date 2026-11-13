<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Realtime\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class SetConversationGroupRequestModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The conversation group to place the conversation in. A conversation belongs to at most one group, so this moves it out of any current group.
   */
  #[JsonProperty('conversation_group_id', required: true)]
  public string $conversationGroupId;

  /**
   * @param array{
   *   conversationGroupId: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->conversationGroupId = $values['conversationGroupId'];

    $this->_dirtyFields = [
      'conversation_group_id' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'conversation_group_id',
      'contents' => $this->conversationGroupId
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
