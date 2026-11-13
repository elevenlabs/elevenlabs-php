<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class SongSection extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The name of the section. Must be between 1 and 100 characters.
   */
  #[JsonProperty('section_name', required: true)]
  public string $sectionName;

  /**
   * @var string[]
   * The styles and musical directions that should be present in this section. Use English language for best result.
   */
  #[JsonProperty('positive_local_styles', required: true), ArrayType(['string'])]
  public array $positiveLocalStyles;

  /**
   * @var string[]
   * The styles and musical directions that should not be present in this section. Use English language for best result.
   */
  #[JsonProperty('negative_local_styles', required: true), ArrayType(['string'])]
  public array $negativeLocalStyles;

  /**
   * The duration of the section in milliseconds. Must be between 3000ms and 120000ms.
   */
  #[JsonProperty('duration_ms', required: true)]
  public int $durationMs;

  /**
   * @var string[]
   * The lyrics of the section. Max 30 lines per section and max 200 characters per line.
   */
  #[JsonProperty('lines', required: true), ArrayType(['string'])]
  public array $lines;

  /**
   * Optional source to extract the section from. Used for inpainting.
   */
  #[JsonProperty('source_from')]
  public ?\ElevenLabs\Types\SectionSource $sourceFrom;

  /**
   * @param array{
   *   sectionName: string,
   *   positiveLocalStyles: string[],
   *   negativeLocalStyles: string[],
   *   durationMs: int,
   *   lines: string[],
   *   sourceFrom?: ?\ElevenLabs\Types\SectionSource,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->sectionName = $values['sectionName'];
    $this->positiveLocalStyles = $values['positiveLocalStyles'];
    $this->negativeLocalStyles = $values['negativeLocalStyles'];
    $this->durationMs = $values['durationMs'];
    $this->lines = $values['lines'];
    $this->sourceFrom = $values['sourceFrom'] ?? null;

    $this->_dirtyFields = [
      'section_name' => true,
      'positive_local_styles' => true,
      'negative_local_styles' => true,
      'duration_ms' => true,
      'lines' => true
    ];
    if (array_key_exists('sourceFrom', $values)) {
      $this->_dirtyFields['source_from'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'section_name',
      'contents' => $this->sectionName
    ];

    foreach ($this->positiveLocalStyles as $item) {
      $parts[] = [
        'name' => 'positive_local_styles',
        'contents' => $item
      ];
    }

    foreach ($this->negativeLocalStyles as $item) {
      $parts[] = [
        'name' => 'negative_local_styles',
        'contents' => $item
      ];
    }

    $parts[] = [
      'name' => 'duration_ms',
      'contents' => (string) $this->durationMs
    ];

    foreach ($this->lines as $item) {
      $parts[] = [
        'name' => 'lines',
        'contents' => $item
      ];
    }

    if ($this->sourceFrom !== null) {
      $parts[] = [
        'name' => 'source_from',
        'contents' => json_encode($this->sourceFrom),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->sectionName, 'section_name', minLength: 1, maxLength: 100);
    Validator::validateArray($this->positiveLocalStyles, 'positive_local_styles', maxItems: 50);
    Validator::validateArray($this->negativeLocalStyles, 'negative_local_styles', maxItems: 50);
    Validator::validateNumber($this->durationMs, 'duration_ms', min: 3000, max: 120000);
    Validator::validateArray($this->lines, 'lines', maxItems: 30);
    $this->sourceFrom?->validate();
  }
}
