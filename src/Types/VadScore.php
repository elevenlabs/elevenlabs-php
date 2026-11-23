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
class VadScore extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('vad_score_event', required: true)]
  public \ElevenLabs\Types\VadScoreVadScoreEvent $vadScoreEvent;

  /**
   * @var ?value-of<\ElevenLabs\Types\VadScoreType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * @param array{
   *   vadScoreEvent: \ElevenLabs\Types\VadScoreVadScoreEvent,
   *   type?: ?value-of<\ElevenLabs\Types\VadScoreType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->vadScoreEvent = $values['vadScoreEvent'];
    $this->type = $values['type'] ?? 'vad_score';

    $this->_dirtyFields = [
      'vad_score_event' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'vad_score_event',
      'contents' => json_encode($this->vadScoreEvent),
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
    $this->vadScoreEvent->validate();
  }
}
