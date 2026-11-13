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
class SegmentCreatePayload extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('start_time', required: true)]
  public float $startTime;

  #[JsonProperty('end_time', required: true)]
  public float $endTime;

  #[JsonProperty('text')]
  public ?string $text;

  /**
   * @var array<string, string>|null
   */
  #[JsonProperty('translations'), ArrayType(['string' => 'string'])]
  public ?array $translations;

  /**
   * @param array{
   *   startTime: float,
   *   endTime: float,
   *   text?: ?string,
   *   translations?: array<string, string>|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->startTime = $values['startTime'];
    $this->endTime = $values['endTime'];
    $this->text = $values['text'] ?? null;
    $this->translations = $values['translations'] ?? null;

    $this->_dirtyFields = [
      'start_time' => true,
      'end_time' => true
    ];
    if (array_key_exists('text', $values)) {
      $this->_dirtyFields['text'] = true;
    }
    if (array_key_exists('translations', $values)) {
      $this->_dirtyFields['translations'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'start_time',
      'contents' => (string) $this->startTime
    ];

    $parts[] = [
      'name' => 'end_time',
      'contents' => (string) $this->endTime
    ];

    if ($this->text !== null) {
      $parts[] = [
        'name' => 'text',
        'contents' => $this->text
      ];
    }

    if ($this->translations !== null) {
      $parts[] = [
        'name' => 'translations',
        'contents' => json_encode($this->translations),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
