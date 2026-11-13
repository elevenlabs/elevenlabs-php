<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * Coordinates of a clip inside a Studio project: the payload of a studio_clip reference.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class StudioClipLocator extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('project_id', required: true)]
  public string $projectId;

  #[JsonProperty('chapter_id', required: true)]
  public string $chapterId;

  /**
   * @var value-of<\ElevenLabs\Types\StudioClipLocatorClipType>
   */
  #[JsonProperty('clip_type', required: true)]
  public string $clipType;

  #[JsonProperty('clip_id', required: true)]
  public string $clipId;

  #[JsonProperty('block_id')]
  public ?string $blockId;

  #[JsonProperty('preview_url')]
  public ?string $previewUrl;

  /**
   * @param array{
   *   projectId: string,
   *   chapterId: string,
   *   clipType: value-of<\ElevenLabs\Types\StudioClipLocatorClipType>,
   *   clipId: string,
   *   blockId?: ?string,
   *   previewUrl?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->projectId = $values['projectId'];
    $this->chapterId = $values['chapterId'];
    $this->clipType = $values['clipType'];
    $this->clipId = $values['clipId'];
    $this->blockId = $values['blockId'] ?? null;
    $this->previewUrl = $values['previewUrl'] ?? null;

    $this->_dirtyFields = [
      'project_id' => true,
      'chapter_id' => true,
      'clip_type' => true,
      'clip_id' => true
    ];
    if (array_key_exists('blockId', $values)) {
      $this->_dirtyFields['block_id'] = true;
    }
    if (array_key_exists('previewUrl', $values)) {
      $this->_dirtyFields['preview_url'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'project_id',
      'contents' => $this->projectId
    ];

    $parts[] = [
      'name' => 'chapter_id',
      'contents' => $this->chapterId
    ];

    $parts[] = [
      'name' => 'clip_type',
      'contents' => $this->clipType
    ];

    $parts[] = [
      'name' => 'clip_id',
      'contents' => $this->clipId
    ];

    if ($this->blockId !== null) {
      $parts[] = [
        'name' => 'block_id',
        'contents' => $this->blockId
      ];
    }

    if ($this->previewUrl !== null) {
      $parts[] = [
        'name' => 'preview_url',
        'contents' => $this->previewUrl
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
