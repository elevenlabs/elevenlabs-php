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
class RealtimeConversationGroupResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('id', required: true)]
  public string $id;

  #[JsonProperty('title', required: true)]
  public string $title;

  #[JsonProperty('description', required: true)]
  public ?string $description;

  #[JsonProperty('access_info', required: true)]
  public \ElevenLabs\Types\ResourceAccessInfo $accessInfo;

  /**
   * How widely a group is shared, besides its owner and workspace admins (who always have access).
   */
  #[JsonProperty('sharing', required: true)]
  public \ElevenLabs\Types\RealtimeConversationGroupSharingSummary $sharing;

  #[JsonProperty('created_at_unix_secs', required: true)]
  public int $createdAtUnixSecs;

  /**
   * @param array{
   *   id: string,
   *   title: string,
   *   description: ?string,
   *   accessInfo: \ElevenLabs\Types\ResourceAccessInfo,
   *   sharing: \ElevenLabs\Types\RealtimeConversationGroupSharingSummary,
   *   createdAtUnixSecs: int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->id = $values['id'];
    $this->title = $values['title'];
    $this->description = $values['description'];
    $this->accessInfo = $values['accessInfo'];
    $this->sharing = $values['sharing'];
    $this->createdAtUnixSecs = $values['createdAtUnixSecs'];

    $this->_dirtyFields = [
      'id' => true,
      'title' => true,
      'description' => true,
      'access_info' => true,
      'sharing' => true,
      'created_at_unix_secs' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'id',
      'contents' => $this->id
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
      'name' => 'access_info',
      'contents' => json_encode($this->accessInfo),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'sharing',
      'contents' => json_encode($this->sharing),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'created_at_unix_secs',
      'contents' => (string) $this->createdAtUnixSecs
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->accessInfo->validate();
    $this->sharing->validate();
  }
}
