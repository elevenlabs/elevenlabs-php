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
class ProjectSnapshotsResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\ProjectSnapshotResponse[]
   * List of project snapshots.
   */
  #[
    JsonProperty('snapshots', required: true),
    ArrayType([\ElevenLabs\Types\ProjectSnapshotResponse::class])
  ]
  public array $snapshots;

  /**
   * @param array{
   *   snapshots: \ElevenLabs\Types\ProjectSnapshotResponse[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->snapshots = $values['snapshots'];

    $this->_dirtyFields = [
      'snapshots' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'snapshots',
      'contents' => json_encode($this->snapshots),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->snapshots as $item) {
      $item->validate();
    }
  }
}
