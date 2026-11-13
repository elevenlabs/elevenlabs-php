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
class RealtimeConversationGroupsResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\RealtimeConversationGroupResponseModel[]
   */
  #[
    JsonProperty('conversation_groups', required: true),
    ArrayType([\ElevenLabs\Types\RealtimeConversationGroupResponseModel::class])
  ]
  public array $conversationGroups;

  /**
   * Cursor to pass to the next request to fetch the following page.
   */
  #[JsonProperty('next_cursor')]
  public ?string $nextCursor;

  /**
   * Whether more conversation groups are available beyond this page.
   */
  #[JsonProperty('has_more')]
  public ?bool $hasMore;

  /**
   * @param array{
   *   conversationGroups: \ElevenLabs\Types\RealtimeConversationGroupResponseModel[],
   *   nextCursor?: ?string,
   *   hasMore?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->conversationGroups = $values['conversationGroups'];
    $this->nextCursor = $values['nextCursor'] ?? null;
    $this->hasMore = $values['hasMore'] ?? null;

    $this->_dirtyFields = [
      'conversation_groups' => true
    ];
    if (array_key_exists('nextCursor', $values)) {
      $this->_dirtyFields['next_cursor'] = true;
    }
    if (array_key_exists('hasMore', $values)) {
      $this->_dirtyFields['has_more'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'conversation_groups',
      'contents' => json_encode($this->conversationGroups),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->nextCursor !== null) {
      $parts[] = [
        'name' => 'next_cursor',
        'contents' => $this->nextCursor
      ];
    }

    if ($this->hasMore !== null) {
      $parts[] = [
        'name' => 'has_more',
        'contents' => $this->hasMore ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->conversationGroups as $item) {
      $item->validate();
    }
  }
}
