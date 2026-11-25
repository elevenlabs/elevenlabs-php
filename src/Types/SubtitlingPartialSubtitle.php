<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * The cue still being filled. Each one replaces the previous message with the same
 * `cue_index` and only adds text at the end, though line breaks may move as the cue
 * fills. A cue gets zero or more of these before its `committed_subtitle`, so it can
 * arrive already committed.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class SubtitlingPartialSubtitle extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\SubtitlingPartialSubtitleMessageType>
   */
  #[JsonProperty('message_type', required: true)]
  public string $messageType;

  /**
   * The cue's position in the session, counting from 0.
   */
  #[JsonProperty('cue_index', required: true)]
  public int $cueIndex;

  /**
   * @var string[]
   * The cue's text, one entry per line.
   */
  #[JsonProperty('lines', required: true), ArrayType(['string'])]
  public array $lines;

  /**
   * When to show the cue, in milliseconds since the session_started message. It doesn't change after the cue's first message.
   */
  #[JsonProperty('start_ms', required: true)]
  public int $startMs;

  /**
   * @param array{
   *   messageType: value-of<\ElevenLabs\Types\SubtitlingPartialSubtitleMessageType>,
   *   cueIndex: int,
   *   lines: string[],
   *   startMs: int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->messageType = $values['messageType'];
    $this->cueIndex = $values['cueIndex'];
    $this->lines = $values['lines'];
    $this->startMs = $values['startMs'];

    $this->_dirtyFields = [
      'message_type' => true,
      'cue_index' => true,
      'lines' => true,
      'start_ms' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'message_type',
      'contents' => $this->messageType
    ];

    $parts[] = [
      'name' => 'cue_index',
      'contents' => (string) $this->cueIndex
    ];

    foreach ($this->lines as $item) {
      $parts[] = [
        'name' => 'lines',
        'contents' => $item
      ];
    }

    $parts[] = [
      'name' => 'start_ms',
      'contents' => (string) $this->startMs
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
