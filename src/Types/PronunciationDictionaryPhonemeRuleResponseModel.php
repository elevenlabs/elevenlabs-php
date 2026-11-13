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
class PronunciationDictionaryPhonemeRuleResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('string_to_replace', required: true)]
  public string $stringToReplace;

  /**
   * Whether the rule matches case-sensitively.
   */
  #[JsonProperty('case_sensitive')]
  public ?bool $caseSensitive;

  /**
   * Whether the rule only matches at word boundaries.
   */
  #[JsonProperty('word_boundaries')]
  public ?bool $wordBoundaries;

  /**
   * @var value-of<\ElevenLabs\Types\PronunciationDictionaryPhonemeRuleResponseModelType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  #[JsonProperty('phoneme', required: true)]
  public string $phoneme;

  #[JsonProperty('alphabet', required: true)]
  public string $alphabet;

  /**
   * @param array{
   *   stringToReplace: string,
   *   type: value-of<\ElevenLabs\Types\PronunciationDictionaryPhonemeRuleResponseModelType>,
   *   phoneme: string,
   *   alphabet: string,
   *   caseSensitive?: ?bool,
   *   wordBoundaries?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->stringToReplace = $values['stringToReplace'];
    $this->caseSensitive = $values['caseSensitive'] ?? null;
    $this->wordBoundaries = $values['wordBoundaries'] ?? null;
    $this->type = $values['type'];
    $this->phoneme = $values['phoneme'];
    $this->alphabet = $values['alphabet'];

    $this->_dirtyFields = [
      'string_to_replace' => true,
      'type' => true,
      'phoneme' => true,
      'alphabet' => true
    ];
    if (array_key_exists('caseSensitive', $values)) {
      $this->_dirtyFields['case_sensitive'] = true;
    }
    if (array_key_exists('wordBoundaries', $values)) {
      $this->_dirtyFields['word_boundaries'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'string_to_replace',
      'contents' => $this->stringToReplace
    ];

    if ($this->caseSensitive !== null) {
      $parts[] = [
        'name' => 'case_sensitive',
        'contents' => $this->caseSensitive ? 'true' : 'false'
      ];
    }

    if ($this->wordBoundaries !== null) {
      $parts[] = [
        'name' => 'word_boundaries',
        'contents' => $this->wordBoundaries ? 'true' : 'false'
      ];
    }

    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
    ];

    $parts[] = [
      'name' => 'phoneme',
      'contents' => $this->phoneme
    ];

    $parts[] = [
      'name' => 'alphabet',
      'contents' => $this->alphabet
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
