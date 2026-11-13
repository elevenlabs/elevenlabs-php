<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

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
class LanguagePairInfo extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('source_language', required: true)]
  public \ElevenLabs\Types\LanguageInfo $sourceLanguage;

  /**
   * @var \ElevenLabs\Types\LanguageInfo[]
   * The available destination languages for this source language.
   */
  #[
    JsonProperty('destination_languages', required: true),
    ArrayType([\ElevenLabs\Types\LanguageInfo::class])
  ]
  public array $destinationLanguages;

  /**
   * @param array{
   *   sourceLanguage: \ElevenLabs\Types\LanguageInfo,
   *   destinationLanguages: \ElevenLabs\Types\LanguageInfo[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->sourceLanguage = $values['sourceLanguage'];
    $this->destinationLanguages = $values['destinationLanguages'];

    $this->_dirtyFields = [
      'source_language' => true,
      'destination_languages' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'source_language',
      'contents' => json_encode($this->sourceLanguage),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'destination_languages',
      'contents' => json_encode($this->destinationLanguages),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->sourceLanguage->validate();
    foreach ($this->destinationLanguages as $item) {
      $item->validate();
    }
  }
}
