<?php

declare(strict_types=1);

namespace ElevenLabs\PronunciationDictionaries\Rules\Requests;

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
class PronunciationDictionary extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\PronunciationDictionaries\Rules\Types\PronunciationDictionaryRule[]
   * List of pronunciation rules. Rule can be either:
   *     an alias rule: {'string_to_replace': 'a', 'type': 'alias', 'alias': 'b', }
   *     or a phoneme rule: {'string_to_replace': 'a', 'type': 'phoneme', 'phoneme': 'b', 'alphabet': 'ipa' }
   */
  #[
    JsonProperty('rules', required: true),
    ArrayType([
      \ElevenLabs\PronunciationDictionaries\Rules\Types\PronunciationDictionaryRule::class
    ])
  ]
  public array $rules;

  /**
   * @param array{
   *   rules: \ElevenLabs\PronunciationDictionaries\Rules\Types\PronunciationDictionaryRule[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->rules = $values['rules'];

    $this->_dirtyFields = [
      'rules' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'rules',
      'contents' => json_encode($this->rules),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
