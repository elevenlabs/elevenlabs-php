<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The new revision after a source edit that returns no segment, such as a delete.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class DubbingTranscriptRevisionResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The project's source-transcript revision after this edit.
   */
  #[JsonProperty('revision', required: true)]
  public int $revision;

  /**
   * @param array{
   *   revision: int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->revision = $values['revision'];

    $this->_dirtyFields = [
      'revision' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'revision',
      'contents' => (string) $this->revision
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
