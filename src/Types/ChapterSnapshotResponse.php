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
class ChapterSnapshotResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The ID of the chapter snapshot.
   */
  #[JsonProperty('chapter_snapshot_id', required: true)]
  public string $chapterSnapshotId;

  /**
   * The ID of the project.
   */
  #[JsonProperty('project_id', required: true)]
  public string $projectId;

  /**
   * The ID of the chapter.
   */
  #[JsonProperty('chapter_id', required: true)]
  public string $chapterId;

  /**
   * The creation date of the chapter snapshot.
   */
  #[JsonProperty('created_at_unix', required: true)]
  public int $createdAtUnix;

  /**
   * The name of the chapter snapshot.
   */
  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * @param array{
   *   chapterSnapshotId: string,
   *   projectId: string,
   *   chapterId: string,
   *   createdAtUnix: int,
   *   name: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->chapterSnapshotId = $values['chapterSnapshotId'];
    $this->projectId = $values['projectId'];
    $this->chapterId = $values['chapterId'];
    $this->createdAtUnix = $values['createdAtUnix'];
    $this->name = $values['name'];

    $this->_dirtyFields = [
      'chapter_snapshot_id' => true,
      'project_id' => true,
      'chapter_id' => true,
      'created_at_unix' => true,
      'name' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'chapter_snapshot_id',
      'contents' => $this->chapterSnapshotId
    ];

    $parts[] = [
      'name' => 'project_id',
      'contents' => $this->projectId
    ];

    $parts[] = [
      'name' => 'chapter_id',
      'contents' => $this->chapterId
    ];

    $parts[] = [
      'name' => 'created_at_unix',
      'contents' => (string) $this->createdAtUnix
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
