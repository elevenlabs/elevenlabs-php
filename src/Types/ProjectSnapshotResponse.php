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
class ProjectSnapshotResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The ID of the project snapshot.
   */
  #[JsonProperty('project_snapshot_id', required: true)]
  public string $projectSnapshotId;

  /**
   * The ID of the project.
   */
  #[JsonProperty('project_id', required: true)]
  public string $projectId;

  /**
   * The creation date of the project snapshot.
   */
  #[JsonProperty('created_at_unix', required: true)]
  public int $createdAtUnix;

  /**
   * The name of the project snapshot.
   */
  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * @var array<string, mixed>|null
   * (Deprecated)
   */
  #[JsonProperty('audio_upload'), ArrayType(['string' => 'mixed'])]
  public ?array $audioUpload;

  /**
   * @var array<string, mixed>|null
   * (Deprecated)
   */
  #[JsonProperty('zip_upload'), ArrayType(['string' => 'mixed'])]
  public ?array $zipUpload;

  /**
   * @param array{
   *   projectSnapshotId: string,
   *   projectId: string,
   *   createdAtUnix: int,
   *   name: string,
   *   audioUpload?: array<string, mixed>|null,
   *   zipUpload?: array<string, mixed>|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->projectSnapshotId = $values['projectSnapshotId'];
    $this->projectId = $values['projectId'];
    $this->createdAtUnix = $values['createdAtUnix'];
    $this->name = $values['name'];
    $this->audioUpload = $values['audioUpload'] ?? null;
    $this->zipUpload = $values['zipUpload'] ?? null;

    $this->_dirtyFields = [
      'project_snapshot_id' => true,
      'project_id' => true,
      'created_at_unix' => true,
      'name' => true
    ];
    if (array_key_exists('audioUpload', $values)) {
      $this->_dirtyFields['audio_upload'] = true;
    }
    if (array_key_exists('zipUpload', $values)) {
      $this->_dirtyFields['zip_upload'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'project_snapshot_id',
      'contents' => $this->projectSnapshotId
    ];

    $parts[] = [
      'name' => 'project_id',
      'contents' => $this->projectId
    ];

    $parts[] = [
      'name' => 'created_at_unix',
      'contents' => (string) $this->createdAtUnix
    ];

    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    if ($this->audioUpload !== null) {
      $parts[] = [
        'name' => 'audio_upload',
        'contents' => json_encode($this->audioUpload),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->zipUpload !== null) {
      $parts[] = [
        'name' => 'zip_upload',
        'contents' => json_encode($this->zipUpload),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
