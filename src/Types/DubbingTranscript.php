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
class DubbingTranscript extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('language', required: true)]
  public string $language;

  /**
   * @var \ElevenLabs\Types\DubbingTranscriptUtterance[]
   */
  #[
    JsonProperty('utterances', required: true),
    ArrayType([\ElevenLabs\Types\DubbingTranscriptUtterance::class])
  ]
  public array $utterances;

  /**
   * @param array{
   *   language: string,
   *   utterances: \ElevenLabs\Types\DubbingTranscriptUtterance[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->language = $values['language'];
    $this->utterances = $values['utterances'];

    $this->_dirtyFields = [
      'language' => true,
      'utterances' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'language',
      'contents' => $this->language
    ];

    $parts[] = [
      'name' => 'utterances',
      'contents' => json_encode($this->utterances),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->utterances as $item) {
      $item->validate();
    }
  }
}
