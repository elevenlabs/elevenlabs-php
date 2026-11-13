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
class SrtExportOptions extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('max_characters_per_line')]
  public ?int $maxCharactersPerLine;

  #[JsonProperty('include_speakers')]
  public ?bool $includeSpeakers;

  #[JsonProperty('include_timestamps')]
  public ?bool $includeTimestamps;

  /**
   * @var value-of<\ElevenLabs\Types\SrtExportOptionsFormat>
   */
  #[JsonProperty('format', required: true)]
  public string $format;

  #[JsonProperty('segment_on_silence_longer_than_s')]
  public ?float $segmentOnSilenceLongerThanS;

  #[JsonProperty('max_segment_duration_s')]
  public ?float $maxSegmentDurationS;

  #[JsonProperty('max_segment_chars')]
  public ?int $maxSegmentChars;

  /**
   * @param array{
   *   format: value-of<\ElevenLabs\Types\SrtExportOptionsFormat>,
   *   maxCharactersPerLine?: ?int,
   *   includeSpeakers?: ?bool,
   *   includeTimestamps?: ?bool,
   *   segmentOnSilenceLongerThanS?: ?float,
   *   maxSegmentDurationS?: ?float,
   *   maxSegmentChars?: ?int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->maxCharactersPerLine = $values['maxCharactersPerLine'] ?? null;
    $this->includeSpeakers = $values['includeSpeakers'] ?? null;
    $this->includeTimestamps = $values['includeTimestamps'] ?? null;
    $this->format = $values['format'];
    $this->segmentOnSilenceLongerThanS = $values['segmentOnSilenceLongerThanS'] ?? null;
    $this->maxSegmentDurationS = $values['maxSegmentDurationS'] ?? null;
    $this->maxSegmentChars = $values['maxSegmentChars'] ?? null;

    $this->_dirtyFields = [
      'format' => true
    ];
    if (array_key_exists('maxCharactersPerLine', $values)) {
      $this->_dirtyFields['max_characters_per_line'] = true;
    }
    if (array_key_exists('includeSpeakers', $values)) {
      $this->_dirtyFields['include_speakers'] = true;
    }
    if (array_key_exists('includeTimestamps', $values)) {
      $this->_dirtyFields['include_timestamps'] = true;
    }
    if (array_key_exists('segmentOnSilenceLongerThanS', $values)) {
      $this->_dirtyFields['segment_on_silence_longer_than_s'] = true;
    }
    if (array_key_exists('maxSegmentDurationS', $values)) {
      $this->_dirtyFields['max_segment_duration_s'] = true;
    }
    if (array_key_exists('maxSegmentChars', $values)) {
      $this->_dirtyFields['max_segment_chars'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->maxCharactersPerLine !== null) {
      $parts[] = [
        'name' => 'max_characters_per_line',
        'contents' => (string) $this->maxCharactersPerLine
      ];
    }

    if ($this->includeSpeakers !== null) {
      $parts[] = [
        'name' => 'include_speakers',
        'contents' => $this->includeSpeakers ? 'true' : 'false'
      ];
    }

    if ($this->includeTimestamps !== null) {
      $parts[] = [
        'name' => 'include_timestamps',
        'contents' => $this->includeTimestamps ? 'true' : 'false'
      ];
    }

    $parts[] = [
      'name' => 'format',
      'contents' => $this->format
    ];

    if ($this->segmentOnSilenceLongerThanS !== null) {
      $parts[] = [
        'name' => 'segment_on_silence_longer_than_s',
        'contents' => (string) $this->segmentOnSilenceLongerThanS
      ];
    }

    if ($this->maxSegmentDurationS !== null) {
      $parts[] = [
        'name' => 'max_segment_duration_s',
        'contents' => (string) $this->maxSegmentDurationS
      ];
    }

    if ($this->maxSegmentChars !== null) {
      $parts[] = [
        'name' => 'max_segment_chars',
        'contents' => (string) $this->maxSegmentChars
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
