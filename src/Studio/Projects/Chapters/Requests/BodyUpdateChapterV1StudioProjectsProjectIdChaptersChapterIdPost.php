<?php

declare(strict_types=1);

namespace ElevenLabs\Studio\Projects\Chapters\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyUpdateChapterV1StudioProjectsProjectIdChaptersChapterIdPost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The name of the chapter, used for identification only.
   */
  #[JsonProperty('name')]
  public ?string $name;

  /**
   * The chapter content to use.
   */
  #[JsonProperty('content')]
  public ?\ElevenLabs\Types\ChapterContentInputModel $content;

  /**
   * @param array{
   *   name?: ?string,
   *   content?: ?\ElevenLabs\Types\ChapterContentInputModel,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->name = $values['name'] ?? null;
    $this->content = $values['content'] ?? null;

    if (array_key_exists('name', $values)) {
      $this->_dirtyFields['name'] = true;
    }
    if (array_key_exists('content', $values)) {
      $this->_dirtyFields['content'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->name !== null) {
      $parts[] = [
        'name' => 'name',
        'contents' => $this->name
      ];
    }

    if ($this->content !== null) {
      $parts[] = [
        'name' => 'content',
        'contents' => json_encode($this->content),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->content?->validate();
  }
}
