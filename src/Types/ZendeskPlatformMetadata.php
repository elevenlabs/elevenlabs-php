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
class ZendeskPlatformMetadata extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\ZendeskPlatformMetadataConversationInitiationSource>
   */
  #[JsonProperty('conversation_initiation_source')]
  public ?string $conversationInitiationSource;

  #[JsonProperty('ticket_id', required: true)]
  public string $ticketId;

  /**
   * @param array{
   *   ticketId: string,
   *   conversationInitiationSource?: ?value-of<\ElevenLabs\Types\ZendeskPlatformMetadataConversationInitiationSource>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->conversationInitiationSource =
      $values['conversationInitiationSource'] ?? 'zendesk_integration';
    $this->ticketId = $values['ticketId'];

    $this->_dirtyFields = [
      'ticket_id' => true
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
      'name' => 'ticket_id',
      'contents' => $this->ticketId
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
