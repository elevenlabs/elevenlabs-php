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
class VoiceAccentResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The accent value used for filtering shared voices via the `accent` query parameter on `GET /v1/shared-voices`.
   */
  #[JsonProperty('accent', required: true)]
  public string $accent;

  /**
   * The language code this accent belongs to, e.g. `en`.
   */
  #[JsonProperty('language', required: true)]
  public string $language;

  /**
   * The full accent code, e.g. `en-american`.
   */
  #[JsonProperty('code', required: true)]
  public string $code;

  /**
   * The human-readable accent name, e.g. `American`.
   */
  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * @param array{
   *   accent: string,
   *   language: string,
   *   code: string,
   *   name: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->accent = $values['accent'];
    $this->language = $values['language'];
    $this->code = $values['code'];
    $this->name = $values['name'];

    $this->_dirtyFields = [
      'accent' => true,
      'language' => true,
      'code' => true,
      'name' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'accent',
      'contents' => $this->accent
    ];

    $parts[] = [
      'name' => 'language',
      'contents' => $this->language
    ];

    $parts[] = [
      'name' => 'code',
      'contents' => $this->code
    ];

    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
