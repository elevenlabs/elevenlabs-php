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
class AudioResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('audio_event', required: true)]
  public \ElevenLabs\Types\AudioResponseAudioEvent $audioEvent;

  /**
   * @var ?value-of<\ElevenLabs\Types\AudioResponseType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * @param array{
   *   audioEvent: \ElevenLabs\Types\AudioResponseAudioEvent,
   *   type?: ?value-of<\ElevenLabs\Types\AudioResponseType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->audioEvent = $values['audioEvent'];
    $this->type = $values['type'] ?? 'audio';

    $this->_dirtyFields = [
      'audio_event' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'audio_event',
      'contents' => json_encode($this->audioEvent),
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
    $this->audioEvent->validate();
  }
}
