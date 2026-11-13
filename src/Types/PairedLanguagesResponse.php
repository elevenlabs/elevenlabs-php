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
class PairedLanguagesResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\PairedLanguagesResponseKind>
   * Indicates this response contains source-to-destination language pairs.
   */
  #[JsonProperty('kind')]
  public ?string $kind;

  /**
   * @var \ElevenLabs\Types\LanguagePairInfo[]
   * The list of available source-to-destination language mappings.
   */
  #[
    JsonProperty('language_pairs', required: true),
    ArrayType([\ElevenLabs\Types\LanguagePairInfo::class])
  ]
  public array $languagePairs;

  /**
   * @param array{
   *   languagePairs: \ElevenLabs\Types\LanguagePairInfo[],
   *   kind?: ?value-of<\ElevenLabs\Types\PairedLanguagesResponseKind>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->kind = $values['kind'] ?? 'pair';
    $this->languagePairs = $values['languagePairs'];

    $this->_dirtyFields = [
      'language_pairs' => true
    ];
    if (array_key_exists('kind', $values)) {
      $this->_dirtyFields['kind'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->kind !== null) {
      $parts[] = [
        'name' => 'kind',
        'contents' => $this->kind
      ];
    }

    $parts[] = [
      'name' => 'language_pairs',
      'contents' => json_encode($this->languagePairs),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->languagePairs as $item) {
      $item->validate();
    }
  }
}
