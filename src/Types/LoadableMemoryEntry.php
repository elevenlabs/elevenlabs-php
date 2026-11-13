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
class LoadableMemoryEntry extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('entry_id', required: true)]
  public string $entryId;

  #[JsonProperty('summary', required: true)]
  public string $summary;

  #[JsonProperty('text', required: true)]
  public string $text;

  /**
   * @param array{
   *   entryId: string,
   *   summary: string,
   *   text: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->entryId = $values['entryId'];
    $this->summary = $values['summary'];
    $this->text = $values['text'];

    $this->_dirtyFields = [
      'entry_id' => true,
      'summary' => true,
      'text' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'entry_id',
      'contents' => $this->entryId
    ];

    $parts[] = [
      'name' => 'summary',
      'contents' => $this->summary
    ];

    $parts[] = [
      'name' => 'text',
      'contents' => $this->text
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
