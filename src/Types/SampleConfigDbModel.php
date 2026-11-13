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
class SampleConfigDbModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('is_sample')]
  public ?bool $isSample;

  #[JsonProperty('parent_id')]
  public ?string $parentId;

  /**
   * @var ?value-of<\ElevenLabs\Types\SampleConfigDbModelParentType>
   */
  #[JsonProperty('parent_type')]
  public ?string $parentType;

  /**
   * @var string[]|null
   */
  #[JsonProperty('chapter_ids'), ArrayType(['string'])]
  public ?array $chapterIds;

  /**
   * @param array{
   *   isSample?: ?bool,
   *   parentId?: ?string,
   *   parentType?: ?value-of<\ElevenLabs\Types\SampleConfigDbModelParentType>,
   *   chapterIds?: string[]|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->isSample = $values['isSample'] ?? null;
    $this->parentId = $values['parentId'] ?? null;
    $this->parentType = $values['parentType'] ?? null;
    $this->chapterIds = $values['chapterIds'] ?? null;

    if (array_key_exists('isSample', $values)) {
      $this->_dirtyFields['is_sample'] = true;
    }
    if (array_key_exists('parentId', $values)) {
      $this->_dirtyFields['parent_id'] = true;
    }
    if (array_key_exists('parentType', $values)) {
      $this->_dirtyFields['parent_type'] = true;
    }
    if (array_key_exists('chapterIds', $values)) {
      $this->_dirtyFields['chapter_ids'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->isSample !== null) {
      $parts[] = [
        'name' => 'is_sample',
        'contents' => $this->isSample ? 'true' : 'false'
      ];
    }

    if ($this->parentId !== null) {
      $parts[] = [
        'name' => 'parent_id',
        'contents' => $this->parentId
      ];
    }

    if ($this->parentType !== null) {
      $parts[] = [
        'name' => 'parent_type',
        'contents' => $this->parentType
      ];
    }

    if ($this->chapterIds !== null) {
      foreach ($this->chapterIds ?? [] as $item) {
        $parts[] = [
          'name' => 'chapter_ids',
          'contents' => $item
        ];
      }
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
