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
class ReadMetadataChapterDbModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('chapter_name', required: true)]
  public string $chapterName;

  #[JsonProperty('word_count', required: true)]
  public int $wordCount;

  #[JsonProperty('char_count', required: true)]
  public int $charCount;

  #[JsonProperty('starting_char_offset', required: true)]
  public int $startingCharOffset;

  #[JsonProperty('has_parsed_html')]
  public ?bool $hasParsedHtml;

  #[JsonProperty('has_summary')]
  public ?bool $hasSummary;

  #[JsonProperty('duration_seconds')]
  public ?float $durationSeconds;

  #[JsonProperty('file_number')]
  public ?string $fileNumber;

  #[JsonProperty('is_fallback_name')]
  public ?bool $isFallbackName;

  #[JsonProperty('chapter_id')]
  public ?string $chapterId;

  /**
   * @param array{
   *   chapterName: string,
   *   wordCount: int,
   *   charCount: int,
   *   startingCharOffset: int,
   *   hasParsedHtml?: ?bool,
   *   hasSummary?: ?bool,
   *   durationSeconds?: ?float,
   *   fileNumber?: ?string,
   *   isFallbackName?: ?bool,
   *   chapterId?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->chapterName = $values['chapterName'];
    $this->wordCount = $values['wordCount'];
    $this->charCount = $values['charCount'];
    $this->startingCharOffset = $values['startingCharOffset'];
    $this->hasParsedHtml = $values['hasParsedHtml'] ?? null;
    $this->hasSummary = $values['hasSummary'] ?? null;
    $this->durationSeconds = $values['durationSeconds'] ?? null;
    $this->fileNumber = $values['fileNumber'] ?? null;
    $this->isFallbackName = $values['isFallbackName'] ?? null;
    $this->chapterId = $values['chapterId'] ?? null;

    $this->_dirtyFields = [
      'chapter_name' => true,
      'word_count' => true,
      'char_count' => true,
      'starting_char_offset' => true
    ];
    if (array_key_exists('hasParsedHtml', $values)) {
      $this->_dirtyFields['has_parsed_html'] = true;
    }
    if (array_key_exists('hasSummary', $values)) {
      $this->_dirtyFields['has_summary'] = true;
    }
    if (array_key_exists('durationSeconds', $values)) {
      $this->_dirtyFields['duration_seconds'] = true;
    }
    if (array_key_exists('fileNumber', $values)) {
      $this->_dirtyFields['file_number'] = true;
    }
    if (array_key_exists('isFallbackName', $values)) {
      $this->_dirtyFields['is_fallback_name'] = true;
    }
    if (array_key_exists('chapterId', $values)) {
      $this->_dirtyFields['chapter_id'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'chapter_name',
      'contents' => $this->chapterName
    ];

    $parts[] = [
      'name' => 'word_count',
      'contents' => (string) $this->wordCount
    ];

    $parts[] = [
      'name' => 'char_count',
      'contents' => (string) $this->charCount
    ];

    $parts[] = [
      'name' => 'starting_char_offset',
      'contents' => (string) $this->startingCharOffset
    ];

    if ($this->hasParsedHtml !== null) {
      $parts[] = [
        'name' => 'has_parsed_html',
        'contents' => $this->hasParsedHtml ? 'true' : 'false'
      ];
    }

    if ($this->hasSummary !== null) {
      $parts[] = [
        'name' => 'has_summary',
        'contents' => $this->hasSummary ? 'true' : 'false'
      ];
    }

    if ($this->durationSeconds !== null) {
      $parts[] = [
        'name' => 'duration_seconds',
        'contents' => (string) $this->durationSeconds
      ];
    }

    if ($this->fileNumber !== null) {
      $parts[] = [
        'name' => 'file_number',
        'contents' => $this->fileNumber
      ];
    }

    if ($this->isFallbackName !== null) {
      $parts[] = [
        'name' => 'is_fallback_name',
        'contents' => $this->isFallbackName ? 'true' : 'false'
      ];
    }

    if ($this->chapterId !== null) {
      $parts[] = [
        'name' => 'chapter_id',
        'contents' => $this->chapterId
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
