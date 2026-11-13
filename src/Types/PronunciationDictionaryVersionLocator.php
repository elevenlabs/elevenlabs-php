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
class PronunciationDictionaryVersionLocator extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The ID of the pronunciation dictionary.
   */
  #[JsonProperty('pronunciation_dictionary_id', required: true)]
  public string $pronunciationDictionaryId;

  /**
   * The ID of the version of the pronunciation dictionary. If not provided, the latest version will be used.
   */
  #[JsonProperty('version_id')]
  public ?string $versionId;

  /**
   * @param array{
   *   pronunciationDictionaryId: string,
   *   versionId?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->pronunciationDictionaryId = $values['pronunciationDictionaryId'];
    $this->versionId = $values['versionId'] ?? null;

    $this->_dirtyFields = [
      'pronunciation_dictionary_id' => true
    ];
    if (array_key_exists('versionId', $values)) {
      $this->_dirtyFields['version_id'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'pronunciation_dictionary_id',
      'contents' => $this->pronunciationDictionaryId
    ];

    if ($this->versionId !== null) {
      $parts[] = [
        'name' => 'version_id',
        'contents' => $this->versionId
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
