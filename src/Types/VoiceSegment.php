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
class VoiceSegment extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The voice ID used for this segment
   */
  #[JsonProperty('voice_id', required: true)]
  public string $voiceId;

  /**
   * Start time of this voice segment
   */
  #[JsonProperty('start_time_seconds', required: true)]
  public float $startTimeSeconds;

  /**
   * End time of this voice segment
   */
  #[JsonProperty('end_time_seconds', required: true)]
  public float $endTimeSeconds;

  /**
   * Start index in the characters array
   */
  #[JsonProperty('character_start_index', required: true)]
  public int $characterStartIndex;

  /**
   * End index in the characters array (exclusive)
   */
  #[JsonProperty('character_end_index', required: true)]
  public int $characterEndIndex;

  /**
   * Line of the dialogue (script) that this segment is a part of.
   */
  #[JsonProperty('dialogue_input_index', required: true)]
  public int $dialogueInputIndex;

  /**
   * @param array{
   *   voiceId: string,
   *   startTimeSeconds: float,
   *   endTimeSeconds: float,
   *   characterStartIndex: int,
   *   characterEndIndex: int,
   *   dialogueInputIndex: int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->voiceId = $values['voiceId'];
    $this->startTimeSeconds = $values['startTimeSeconds'];
    $this->endTimeSeconds = $values['endTimeSeconds'];
    $this->characterStartIndex = $values['characterStartIndex'];
    $this->characterEndIndex = $values['characterEndIndex'];
    $this->dialogueInputIndex = $values['dialogueInputIndex'];

    $this->_dirtyFields = [
      'voice_id' => true,
      'start_time_seconds' => true,
      'end_time_seconds' => true,
      'character_start_index' => true,
      'character_end_index' => true,
      'dialogue_input_index' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'voice_id',
      'contents' => $this->voiceId
    ];

    $parts[] = [
      'name' => 'start_time_seconds',
      'contents' => (string) $this->startTimeSeconds
    ];

    $parts[] = [
      'name' => 'end_time_seconds',
      'contents' => (string) $this->endTimeSeconds
    ];

    $parts[] = [
      'name' => 'character_start_index',
      'contents' => (string) $this->characterStartIndex
    ];

    $parts[] = [
      'name' => 'character_end_index',
      'contents' => (string) $this->characterEndIndex
    ];

    $parts[] = [
      'name' => 'dialogue_input_index',
      'contents' => (string) $this->dialogueInputIndex
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
