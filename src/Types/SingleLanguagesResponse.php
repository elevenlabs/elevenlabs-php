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
class SingleLanguagesResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\SingleLanguagesResponseKind>
   * Indicates this response contains single languages (not source-to-destination pairs).
   */
  #[JsonProperty('kind')]
  public ?string $kind;

  /**
   * @var \ElevenLabs\Types\LanguageInfo[]
   * The list of available languages.
   */
  #[JsonProperty('languages', required: true), ArrayType([\ElevenLabs\Types\LanguageInfo::class])]
  public array $languages;

  /**
   * @param array{
   *   languages: \ElevenLabs\Types\LanguageInfo[],
   *   kind?: ?value-of<\ElevenLabs\Types\SingleLanguagesResponseKind>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->kind = $values['kind'] ?? 'single';
    $this->languages = $values['languages'];

    $this->_dirtyFields = [
      'languages' => true
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
      'name' => 'languages',
      'contents' => json_encode($this->languages),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->languages as $item) {
      $item->validate();
    }
  }
}
