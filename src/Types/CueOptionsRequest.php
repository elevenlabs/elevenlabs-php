<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class CueOptionsRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Minimum duration of each cue in milliseconds.
   */
  #[JsonProperty('min_duration_ms')]
  public ?int $minDurationMs;

  /**
   * Maximum duration of each cue in milliseconds.
   */
  #[JsonProperty('max_duration_ms')]
  public ?int $maxDurationMs;

  /**
   * Maximum number of lines per cue.
   */
  #[JsonProperty('max_lines_per_cue')]
  public ?int $maxLinesPerCue;

  /**
   * Maximum number of characters per line in a cue.
   */
  #[JsonProperty('max_chars_per_line')]
  public ?int $maxCharsPerLine;

  /**
   * Maximum characters per second reading speed. If not set, no reading speed limit is applied.
   */
  #[JsonProperty('max_chars_per_s')]
  public ?int $maxCharsPerS;

  /**
   * Minimum gap between consecutive cues in frames. If not set, no minimum gap is enforced.
   */
  #[JsonProperty('min_gap_between_cues_frames')]
  public ?int $minGapBetweenCuesFrames;

  /**
   * @param array{
   *   minDurationMs?: ?int,
   *   maxDurationMs?: ?int,
   *   maxLinesPerCue?: ?int,
   *   maxCharsPerLine?: ?int,
   *   maxCharsPerS?: ?int,
   *   minGapBetweenCuesFrames?: ?int,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->minDurationMs = $values['minDurationMs'] ?? null;
    $this->maxDurationMs = $values['maxDurationMs'] ?? null;
    $this->maxLinesPerCue = $values['maxLinesPerCue'] ?? null;
    $this->maxCharsPerLine = $values['maxCharsPerLine'] ?? null;
    $this->maxCharsPerS = $values['maxCharsPerS'] ?? null;
    $this->minGapBetweenCuesFrames = $values['minGapBetweenCuesFrames'] ?? null;

    if (array_key_exists('minDurationMs', $values)) {
      $this->_dirtyFields['min_duration_ms'] = true;
    }
    if (array_key_exists('maxDurationMs', $values)) {
      $this->_dirtyFields['max_duration_ms'] = true;
    }
    if (array_key_exists('maxLinesPerCue', $values)) {
      $this->_dirtyFields['max_lines_per_cue'] = true;
    }
    if (array_key_exists('maxCharsPerLine', $values)) {
      $this->_dirtyFields['max_chars_per_line'] = true;
    }
    if (array_key_exists('maxCharsPerS', $values)) {
      $this->_dirtyFields['max_chars_per_s'] = true;
    }
    if (array_key_exists('minGapBetweenCuesFrames', $values)) {
      $this->_dirtyFields['min_gap_between_cues_frames'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->minDurationMs !== null) {
      $parts[] = [
        'name' => 'min_duration_ms',
        'contents' => (string) $this->minDurationMs
      ];
    }

    if ($this->maxDurationMs !== null) {
      $parts[] = [
        'name' => 'max_duration_ms',
        'contents' => (string) $this->maxDurationMs
      ];
    }

    if ($this->maxLinesPerCue !== null) {
      $parts[] = [
        'name' => 'max_lines_per_cue',
        'contents' => (string) $this->maxLinesPerCue
      ];
    }

    if ($this->maxCharsPerLine !== null) {
      $parts[] = [
        'name' => 'max_chars_per_line',
        'contents' => (string) $this->maxCharsPerLine
      ];
    }

    if ($this->maxCharsPerS !== null) {
      $parts[] = [
        'name' => 'max_chars_per_s',
        'contents' => (string) $this->maxCharsPerS
      ];
    }

    if ($this->minGapBetweenCuesFrames !== null) {
      $parts[] = [
        'name' => 'min_gap_between_cues_frames',
        'contents' => (string) $this->minGapBetweenCuesFrames
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateNumber($this->minDurationMs, 'min_duration_ms', max: 2000);
    Validator::validateNumber($this->maxDurationMs, 'max_duration_ms', min: 4000);
    Validator::validateNumber($this->maxLinesPerCue, 'max_lines_per_cue', min: 1, max: 3);
    Validator::validateNumber($this->maxCharsPerLine, 'max_chars_per_line', min: 16, max: 50);
    Validator::validateNumber($this->maxCharsPerS, 'max_chars_per_s', min: 15, max: 30);
    Validator::validateNumber(
      $this->minGapBetweenCuesFrames,
      'min_gap_between_cues_frames',
      min: 0,
      max: 6
    );
  }
}
