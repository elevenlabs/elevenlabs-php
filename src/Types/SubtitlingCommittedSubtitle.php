<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * A finished cue, and the last message with its `cue_index`. Each cue is committed
 * before any message for the next, so at most one cue is open at a time, and a session
 * that ends normally commits every cue.
 *
 * The cue keeps the text its partials showed, except that its last word can move to
 * the next cue: when the text after it starts with punctuation, such as ",", that has
 * no room in this cue, the word moves with it so the next cue doesn't start with it.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class SubtitlingCommittedSubtitle extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\SubtitlingCommittedSubtitleMessageType>
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
   * When to hide the cue, in milliseconds since the session_started message.
   */
  #[JsonProperty('end_ms', required: true)]
  public int $endMs;

  /**
   * @param array{
   *   messageType: value-of<\ElevenLabs\Types\SubtitlingCommittedSubtitleMessageType>,
   *   cueIndex: int,
   *   lines: string[],
   *   startMs: int,
   *   endMs: int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->messageType = $values['messageType'];
    $this->cueIndex = $values['cueIndex'];
    $this->lines = $values['lines'];
    $this->startMs = $values['startMs'];
    $this->endMs = $values['endMs'];

    $this->_dirtyFields = [
      'message_type' => true,
      'cue_index' => true,
      'lines' => true,
      'start_ms' => true,
      'end_ms' => true
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

    $parts[] = [
      'name' => 'end_ms',
      'contents' => (string) $this->endMs
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
