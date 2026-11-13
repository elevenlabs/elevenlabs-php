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
class PodcastConversationMode extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\PodcastConversationModeType>
   * The type of podcast to create.
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  #[JsonProperty('conversation', required: true)]
  public \ElevenLabs\Types\PodcastConversationModeData $conversation;

  /**
   * @param array{
   *   type: value-of<\ElevenLabs\Types\PodcastConversationModeType>,
   *   conversation: \ElevenLabs\Types\PodcastConversationModeData,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];
    $this->conversation = $values['conversation'];

    $this->_dirtyFields = [
      'type' => true,
      'conversation' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
    ];

    $parts[] = [
      'name' => 'conversation',
      'contents' => json_encode($this->conversation),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->conversation->validate();
  }
}
