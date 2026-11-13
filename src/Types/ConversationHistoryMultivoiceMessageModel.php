<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * Represents a message from a multi-voice agent.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ConversationHistoryMultivoiceMessageModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\ConversationHistoryMultivoiceMessagePartModel[]
   */
  #[
    JsonProperty('parts', required: true),
    ArrayType([\ElevenLabs\Types\ConversationHistoryMultivoiceMessagePartModel::class])
  ]
  public array $parts;

  /**
   * @param array{
   *   parts: \ElevenLabs\Types\ConversationHistoryMultivoiceMessagePartModel[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->parts = $values['parts'];

    $this->_dirtyFields = [
      'parts' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'parts',
      'contents' => json_encode($this->parts),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->parts as $item) {
      $item->validate();
    }
  }
}
