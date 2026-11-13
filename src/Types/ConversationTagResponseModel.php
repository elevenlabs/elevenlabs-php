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
class ConversationTagResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('tag_id', required: true)]
  public string $tagId;

  #[JsonProperty('workspace_id', required: true)]
  public string $workspaceId;

  #[JsonProperty('owner_user_id', required: true)]
  public string $ownerUserId;

  #[JsonProperty('title', required: true)]
  public string $title;

  #[JsonProperty('description', required: true)]
  public ?string $description;

  #[JsonProperty('created_at_unix_secs', required: true)]
  public int $createdAtUnixSecs;

  /**
   * @param array{
   *   tagId: string,
   *   workspaceId: string,
   *   ownerUserId: string,
   *   title: string,
   *   description: ?string,
   *   createdAtUnixSecs: int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->tagId = $values['tagId'];
    $this->workspaceId = $values['workspaceId'];
    $this->ownerUserId = $values['ownerUserId'];
    $this->title = $values['title'];
    $this->description = $values['description'];
    $this->createdAtUnixSecs = $values['createdAtUnixSecs'];

    $this->_dirtyFields = [
      'tag_id' => true,
      'workspace_id' => true,
      'owner_user_id' => true,
      'title' => true,
      'description' => true,
      'created_at_unix_secs' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'tag_id',
      'contents' => $this->tagId
    ];

    $parts[] = [
      'name' => 'workspace_id',
      'contents' => $this->workspaceId
    ];

    $parts[] = [
      'name' => 'owner_user_id',
      'contents' => $this->ownerUserId
    ];

    $parts[] = [
      'name' => 'title',
      'contents' => $this->title
    ];

    $parts[] = [
      'name' => 'description',
      'contents' => $this->description
    ];

    $parts[] = [
      'name' => 'created_at_unix_secs',
      'contents' => (string) $this->createdAtUnixSecs
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
