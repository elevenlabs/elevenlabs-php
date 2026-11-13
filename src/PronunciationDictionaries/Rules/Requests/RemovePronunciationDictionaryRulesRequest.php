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
class RemovePronunciationDictionaryRulesRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var string[]
   * List of strings to remove from the pronunciation dictionary.
   */
  #[JsonProperty('rule_strings', required: true), ArrayType(['string'])]
  public array $ruleStrings;

  /**
   * @param array{
   *   ruleStrings: string[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->ruleStrings = $values['ruleStrings'];

    $this->_dirtyFields = [
      'rule_strings' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    foreach ($this->ruleStrings as $item) {
      $parts[] = [
        'name' => 'rule_strings',
        'contents' => $item
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
