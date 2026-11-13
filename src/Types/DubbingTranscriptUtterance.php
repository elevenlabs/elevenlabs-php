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
class DubbingTranscriptUtterance extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('text')]
  public ?string $text;

  #[JsonProperty('speaker_id')]
  public ?string $speakerId;

  #[JsonProperty('start_s')]
  public ?float $startS;

  #[JsonProperty('end_s')]
  public ?float $endS;

  /**
   * @var \ElevenLabs\Types\DubbingTranscriptWord[]|null
   */
  #[JsonProperty('words'), ArrayType([\ElevenLabs\Types\DubbingTranscriptWord::class])]
  public ?array $words;

  /**
   * @param array{
   *   text?: ?string,
   *   speakerId?: ?string,
   *   startS?: ?float,
   *   endS?: ?float,
   *   words?: \ElevenLabs\Types\DubbingTranscriptWord[]|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->text = $values['text'] ?? null;
    $this->speakerId = $values['speakerId'] ?? null;
    $this->startS = $values['startS'] ?? null;
    $this->endS = $values['endS'] ?? null;
    $this->words = $values['words'] ?? null;

    if (array_key_exists('text', $values)) {
      $this->_dirtyFields['text'] = true;
    }
    if (array_key_exists('speakerId', $values)) {
      $this->_dirtyFields['speaker_id'] = true;
    }
    if (array_key_exists('startS', $values)) {
      $this->_dirtyFields['start_s'] = true;
    }
    if (array_key_exists('endS', $values)) {
      $this->_dirtyFields['end_s'] = true;
    }
    if (array_key_exists('words', $values)) {
      $this->_dirtyFields['words'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->text !== null) {
      $parts[] = [
        'name' => 'text',
        'contents' => $this->text
      ];
    }

    if ($this->speakerId !== null) {
      $parts[] = [
        'name' => 'speaker_id',
        'contents' => $this->speakerId
      ];
    }

    if ($this->startS !== null) {
      $parts[] = [
        'name' => 'start_s',
        'contents' => (string) $this->startS
      ];
    }

    if ($this->endS !== null) {
      $parts[] = [
        'name' => 'end_s',
        'contents' => (string) $this->endS
      ];
    }

    if ($this->words !== null) {
      $parts[] = [
        'name' => 'words',
        'contents' => json_encode($this->words),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->words ?? [] as $item) {
      $item->validate();
    }
  }
}
