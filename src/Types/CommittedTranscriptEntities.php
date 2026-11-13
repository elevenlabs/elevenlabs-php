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
class CommittedTranscriptEntities extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\CommittedTranscriptEntitiesMessageType>
   */
  #[JsonProperty('message_type')]
  public ?string $messageType;

  #[JsonProperty('text', required: true)]
  public string $text;

  /**
   * @var \ElevenLabs\Types\CommittedTranscriptEntitiesEntitiesItem[]|null
   */
  #[
    JsonProperty('entities'),
    ArrayType([\ElevenLabs\Types\CommittedTranscriptEntitiesEntitiesItem::class])
  ]
  public ?array $entities;

  /**
   * @param array{
   *   text: string,
   *   messageType?: ?value-of<\ElevenLabs\Types\CommittedTranscriptEntitiesMessageType>,
   *   entities?: \ElevenLabs\Types\CommittedTranscriptEntitiesEntitiesItem[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->messageType = $values['messageType'] ?? 'committed_transcript_entities';
    $this->text = $values['text'];
    $this->entities = $values['entities'] ?? null;

    $this->_dirtyFields = [
      'text' => true
    ];
    if (array_key_exists('messageType', $values)) {
      $this->_dirtyFields['message_type'] = true;
    }
    if (array_key_exists('entities', $values)) {
      $this->_dirtyFields['entities'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->messageType !== null) {
      $parts[] = [
        'name' => 'message_type',
        'contents' => $this->messageType
      ];
    }

    $parts[] = [
      'name' => 'text',
      'contents' => $this->text
    ];

    if ($this->entities !== null) {
      $parts[] = [
        'name' => 'entities',
        'contents' => json_encode($this->entities),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->entities ?? [] as $item) {
      $item->validate();
    }
  }
}
