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
class LanguageResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The unique identifier of the language.
   */
  #[JsonProperty('language_id', required: true)]
  public string $languageId;

  /**
   * The name of the language.
   */
  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * @param array{
   *   languageId: string,
   *   name: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->languageId = $values['languageId'];
    $this->name = $values['name'];

    $this->_dirtyFields = [
      'language_id' => true,
      'name' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'language_id',
      'contents' => $this->languageId
    ];

    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
