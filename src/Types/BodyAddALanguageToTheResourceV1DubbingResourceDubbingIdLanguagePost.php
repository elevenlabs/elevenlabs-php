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
class BodyAddALanguageToTheResourceV1DubbingResourceDubbingIdLanguagePost extends
  JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The Target language.
   */
  #[JsonProperty('language', required: true)]
  public ?string $language;

  /**
   * @param array{
   *   language: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->language = $values['language'];

    $this->_dirtyFields = [
      'language' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'language',
      'contents' => $this->language
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
