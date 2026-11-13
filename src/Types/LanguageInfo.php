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
class LanguageInfo extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The language code (e.g. 'en', 'fr', 'es-ES').
   */
  #[JsonProperty('code', required: true)]
  public string $code;

  /**
   * The human-readable language name (e.g. 'English', 'French', 'Spanish (Spain)').
   */
  #[JsonProperty('label', required: true)]
  public string $label;

  /**
   * @param array{
   *   code: string,
   *   label: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->code = $values['code'];
    $this->label = $values['label'];

    $this->_dirtyFields = [
      'code' => true,
      'label' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'code',
      'contents' => $this->code
    ];

    $parts[] = [
      'name' => 'label',
      'contents' => $this->label
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
