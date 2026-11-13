<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class AssetTranscriptionData extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('language_code', required: true)]
  public string $languageCode;

  #[JsonProperty('text', required: true)]
  public string $text;

  /**
   * @var string[]
   */
  #[JsonProperty('words', required: true), ArrayType(['string'])]
  public array $words;

  /**
   * @var int[]
   */
  #[JsonProperty('word_start_times_ms', required: true), ArrayType(['integer'])]
  public array $wordStartTimesMs;

  /**
   * @var int[]
   */
  #[JsonProperty('word_end_times_ms', required: true), ArrayType(['integer'])]
  public array $wordEndTimesMs;

  /**
   * @var string[]
   */
  #[JsonProperty('word_speaker_ids', required: true), ArrayType(['string'])]
  public array $wordSpeakerIds;

  /**
   * @param array{
   *   languageCode: string,
   *   text: string,
   *   words: string[],
   *   wordStartTimesMs: int[],
   *   wordEndTimesMs: int[],
   *   wordSpeakerIds: string[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->languageCode = $values['languageCode'];
    $this->text = $values['text'];
    $this->words = $values['words'];
    $this->wordStartTimesMs = $values['wordStartTimesMs'];
    $this->wordEndTimesMs = $values['wordEndTimesMs'];
    $this->wordSpeakerIds = $values['wordSpeakerIds'];

    $this->_dirtyFields = [
      'language_code' => true,
      'text' => true,
      'words' => true,
      'word_start_times_ms' => true,
      'word_end_times_ms' => true,
      'word_speaker_ids' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'language_code',
      'contents' => $this->languageCode
    ];

    $parts[] = [
      'name' => 'text',
      'contents' => $this->text
    ];

    foreach ($this->words as $item) {
      $parts[] = [
        'name' => 'words',
        'contents' => $item
      ];
    }

    foreach ($this->wordStartTimesMs as $item) {
      $parts[] = [
        'name' => 'word_start_times_ms',
        'contents' => (string) $item
      ];
    }

    foreach ($this->wordEndTimesMs as $item) {
      $parts[] = [
        'name' => 'word_end_times_ms',
        'contents' => (string) $item
      ];
    }

    foreach ($this->wordSpeakerIds as $item) {
      $parts[] = [
        'name' => 'word_speaker_ids',
        'contents' => $item
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
