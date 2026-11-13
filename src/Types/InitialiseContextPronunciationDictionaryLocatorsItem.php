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
class InitialiseContextPronunciationDictionaryLocatorsItem extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('pronunciation_dictionary_id', required: true)]
  public string $pronunciationDictionaryId;

  #[JsonProperty('version_id', required: true)]
  public string $versionId;

  /**
   * @param array{
   *   pronunciationDictionaryId: string,
   *   versionId: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->pronunciationDictionaryId = $values['pronunciationDictionaryId'];
    $this->versionId = $values['versionId'];

    $this->_dirtyFields = [
      'pronunciation_dictionary_id' => true,
      'version_id' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'pronunciation_dictionary_id',
      'contents' => $this->pronunciationDictionaryId
    ];

    $parts[] = [
      'name' => 'version_id',
      'contents' => $this->versionId
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
