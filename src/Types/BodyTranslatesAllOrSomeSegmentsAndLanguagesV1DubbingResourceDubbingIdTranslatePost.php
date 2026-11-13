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
class BodyTranslatesAllOrSomeSegmentsAndLanguagesV1DubbingResourceDubbingIdTranslatePost extends
  JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var string[]
   * Translate only this list of segments.
   */
  #[JsonProperty('segments', required: true), ArrayType(['string'])]
  public array $segments;

  /**
   * @var string[]|null
   * Translate only these languages for each segment.
   */
  #[JsonProperty('languages', required: true), ArrayType(['string'])]
  public ?array $languages;

  /**
   * @param array{
   *   segments: string[],
   *   languages: string[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->segments = $values['segments'];
    $this->languages = $values['languages'];

    $this->_dirtyFields = [
      'segments' => true,
      'languages' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    foreach ($this->segments as $item) {
      $parts[] = [
        'name' => 'segments',
        'contents' => $item
      ];
    }

    foreach ($this->languages ?? [] as $item) {
      $parts[] = [
        'name' => 'languages',
        'contents' => $item
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
