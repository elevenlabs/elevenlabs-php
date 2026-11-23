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
class ConversationInitiationMetadata extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('conversation_initiation_metadata_event', required: true)]
  public \ElevenLabs\Types\ConversationInitiationMetadataConversationInitiationMetadataEvent $conversationInitiationMetadataEvent;

  /**
   * @var ?value-of<\ElevenLabs\Types\ConversationInitiationMetadataType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * @param array{
   *   conversationInitiationMetadataEvent: \ElevenLabs\Types\ConversationInitiationMetadataConversationInitiationMetadataEvent,
   *   type?: ?value-of<\ElevenLabs\Types\ConversationInitiationMetadataType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->conversationInitiationMetadataEvent = $values['conversationInitiationMetadataEvent'];
    $this->type = $values['type'] ?? 'conversation_initiation_metadata';

    $this->_dirtyFields = [
      'conversation_initiation_metadata_event' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'conversation_initiation_metadata_event',
      'contents' => json_encode($this->conversationInitiationMetadataEvent),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->type !== null) {
      $parts[] = [
        'name' => 'type',
        'contents' => $this->type
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->conversationInitiationMetadataEvent->validate();
  }
}
