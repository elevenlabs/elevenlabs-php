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
class PlainPlatformMetadata extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\PlainPlatformMetadataConversationInitiationSource>
   */
  #[JsonProperty('conversation_initiation_source')]
  public ?string $conversationInitiationSource;

  #[JsonProperty('thread_id', required: true)]
  public string $threadId;

  #[JsonProperty('workspace_id', required: true)]
  public string $workspaceId;

  /**
   * @param array{
   *   threadId: string,
   *   workspaceId: string,
   *   conversationInitiationSource?: ?value-of<\ElevenLabs\Types\PlainPlatformMetadataConversationInitiationSource>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->conversationInitiationSource =
      $values['conversationInitiationSource'] ?? 'plain_integration';
    $this->threadId = $values['threadId'];
    $this->workspaceId = $values['workspaceId'];

    $this->_dirtyFields = [
      'thread_id' => true,
      'workspace_id' => true
    ];
    if (array_key_exists('conversationInitiationSource', $values)) {
      $this->_dirtyFields['conversation_initiation_source'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->conversationInitiationSource !== null) {
      $parts[] = [
        'name' => 'conversation_initiation_source',
        'contents' => $this->conversationInitiationSource
      ];
    }

    $parts[] = [
      'name' => 'thread_id',
      'contents' => $this->threadId
    ];

    $parts[] = [
      'name' => 'workspace_id',
      'contents' => $this->workspaceId
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
