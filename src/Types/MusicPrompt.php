<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * Composition plan for the `music_v1` model. Using this field with any other model will result in an error.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class MusicPrompt extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var string[]
   * The styles and musical directions that should be present in the entire song. Use English language for best result.
   */
  #[JsonProperty('positive_global_styles', required: true), ArrayType(['string'])]
  public array $positiveGlobalStyles;

  /**
   * @var string[]
   * The styles and musical directions that should not be present in the entire song. Use English language for best result.
   */
  #[JsonProperty('negative_global_styles', required: true), ArrayType(['string'])]
  public array $negativeGlobalStyles;

  /**
   * @var \ElevenLabs\Types\SongSection[]
   * The sections of the song.
   */
  #[JsonProperty('sections', required: true), ArrayType([\ElevenLabs\Types\SongSection::class])]
  public array $sections;

  /**
   * @param array{
   *   positiveGlobalStyles: string[],
   *   negativeGlobalStyles: string[],
   *   sections: \ElevenLabs\Types\SongSection[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->positiveGlobalStyles = $values['positiveGlobalStyles'];
    $this->negativeGlobalStyles = $values['negativeGlobalStyles'];
    $this->sections = $values['sections'];

    $this->_dirtyFields = [
      'positive_global_styles' => true,
      'negative_global_styles' => true,
      'sections' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    foreach ($this->positiveGlobalStyles as $item) {
      $parts[] = [
        'name' => 'positive_global_styles',
        'contents' => $item
      ];
    }

    foreach ($this->negativeGlobalStyles as $item) {
      $parts[] = [
        'name' => 'negative_global_styles',
        'contents' => $item
      ];
    }

    $parts[] = [
      'name' => 'sections',
      'contents' => json_encode($this->sections),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateArray($this->positiveGlobalStyles, 'positive_global_styles', maxItems: 50);
    Validator::validateArray($this->negativeGlobalStyles, 'negative_global_styles', maxItems: 50);
    foreach ($this->sections as $item) {
      $item->validate();
    }
    Validator::validateArray($this->sections, 'sections', maxItems: 30);
  }
}
