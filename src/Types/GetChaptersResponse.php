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
class GetChaptersResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\ChapterResponse[]
   */
  #[JsonProperty('chapters', required: true), ArrayType([\ElevenLabs\Types\ChapterResponse::class])]
  public array $chapters;

  /**
   * @param array{
   *   chapters: \ElevenLabs\Types\ChapterResponse[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->chapters = $values['chapters'];

    $this->_dirtyFields = [
      'chapters' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'chapters',
      'contents' => json_encode($this->chapters),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->chapters as $item) {
      $item->validate();
    }
  }
}
