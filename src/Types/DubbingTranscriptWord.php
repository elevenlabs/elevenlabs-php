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
class DubbingTranscriptWord extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('text')]
  public ?string $text;

  #[JsonProperty('word_type')]
  public ?string $wordType;

  #[JsonProperty('start_s')]
  public ?float $startS;

  #[JsonProperty('end_s')]
  public ?float $endS;

  /**
   * @var \ElevenLabs\Types\DubbingTranscriptCharacter[]|null
   */
  #[JsonProperty('characters'), ArrayType([\ElevenLabs\Types\DubbingTranscriptCharacter::class])]
  public ?array $characters;

  /**
   * @param array{
   *   text?: ?string,
   *   wordType?: ?string,
   *   startS?: ?float,
   *   endS?: ?float,
   *   characters?: \ElevenLabs\Types\DubbingTranscriptCharacter[]|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->text = $values['text'] ?? null;
    $this->wordType = $values['wordType'] ?? null;
    $this->startS = $values['startS'] ?? null;
    $this->endS = $values['endS'] ?? null;
    $this->characters = $values['characters'] ?? null;

    if (array_key_exists('text', $values)) {
      $this->_dirtyFields['text'] = true;
    }
    if (array_key_exists('wordType', $values)) {
      $this->_dirtyFields['word_type'] = true;
    }
    if (array_key_exists('startS', $values)) {
      $this->_dirtyFields['start_s'] = true;
    }
    if (array_key_exists('endS', $values)) {
      $this->_dirtyFields['end_s'] = true;
    }
    if (array_key_exists('characters', $values)) {
      $this->_dirtyFields['characters'] = true;
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

    if ($this->wordType !== null) {
      $parts[] = [
        'name' => 'word_type',
        'contents' => $this->wordType
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

    if ($this->characters !== null) {
      $parts[] = [
        'name' => 'characters',
        'contents' => json_encode($this->characters),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->characters ?? [] as $item) {
      $item->validate();
    }
  }
}
