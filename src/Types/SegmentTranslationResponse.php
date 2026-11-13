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
class SegmentTranslationResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('version', required: true)]
  public int $version;

  /**
   * @param array{
   *   version: int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->version = $values['version'];

    $this->_dirtyFields = [
      'version' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'version',
      'contents' => (string) $this->version
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
