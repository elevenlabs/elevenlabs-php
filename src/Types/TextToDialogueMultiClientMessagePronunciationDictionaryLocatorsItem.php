<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * A locator for other documents to be able to reference a specific dictionary and it's version.
 * This is a pydantic version of PronunciationDictionaryVersionLocatorDBModel.
 * Required to ensure compat with the rest of the agent data models.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class TextToDialogueMultiClientMessagePronunciationDictionaryLocatorsItem extends
  JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The ID of the pronunciation dictionary
   */
  #[JsonProperty('pronunciation_dictionary_id', required: true)]
  public string $pronunciationDictionaryId;

  /**
   * The ID of the version of the pronunciation dictionary
   */
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
