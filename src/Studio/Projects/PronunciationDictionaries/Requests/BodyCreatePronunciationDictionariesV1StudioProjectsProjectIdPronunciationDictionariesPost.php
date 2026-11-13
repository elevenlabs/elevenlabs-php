<?php

declare(strict_types=1);

namespace ElevenLabs\Studio\Projects\PronunciationDictionaries\Requests;

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
class BodyCreatePronunciationDictionariesV1StudioProjectsProjectIdPronunciationDictionariesPost
  extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\PronunciationDictionaryVersionLocator[]
   * A list of pronunciation dictionary locators (pronunciation_dictionary_id, version_id) encoded as a list of JSON strings for pronunciation dictionaries to be applied to the text. A list of json encoded strings is required as adding projects may occur through formData as opposed to jsonBody. To specify multiple dictionaries use multiple --form lines in your curl, such as --form 'pronunciation_dictionary_locators="{\"pronunciation_dictionary_id\":\"Vmd4Zor6fplcA7WrINey\",\"version_id\":\"hRPaxjlTdR7wFMhV4w0b\"}"' --form 'pronunciation_dictionary_locators="{\"pronunciation_dictionary_id\":\"JzWtcGQMJ6bnlWwyMo7e\",\"version_id\":\"lbmwxiLu4q6txYxgdZqn\"}"'.
   */
  #[
    JsonProperty('pronunciation_dictionary_locators', required: true),
    ArrayType([\ElevenLabs\Types\PronunciationDictionaryVersionLocator::class])
  ]
  public array $pronunciationDictionaryLocators;

  /**
   * This will automatically mark text in this project for reconversion when the new dictionary applies or the old one no longer does.
   */
  #[JsonProperty('invalidate_affected_text')]
  public ?bool $invalidateAffectedText;

  /**
   * @param array{
   *   pronunciationDictionaryLocators: \ElevenLabs\Types\PronunciationDictionaryVersionLocator[],
   *   invalidateAffectedText?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->pronunciationDictionaryLocators = $values['pronunciationDictionaryLocators'];
    $this->invalidateAffectedText = $values['invalidateAffectedText'] ?? null;

    $this->_dirtyFields = [
      'pronunciation_dictionary_locators' => true
    ];
    if (array_key_exists('invalidateAffectedText', $values)) {
      $this->_dirtyFields['invalidate_affected_text'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'pronunciation_dictionary_locators',
      'contents' => json_encode($this->pronunciationDictionaryLocators),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->invalidateAffectedText !== null) {
      $parts[] = [
        'name' => 'invalidate_affected_text',
        'contents' => $this->invalidateAffectedText ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->pronunciationDictionaryLocators as $item) {
      $item->validate();
    }
  }
}
