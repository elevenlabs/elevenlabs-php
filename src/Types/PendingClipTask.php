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
class PendingClipTask extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\PendingClipTaskType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  #[JsonProperty('progress')]
  public ?float $progress;

  #[JsonProperty('started_at_ms')]
  public ?int $startedAtMs;

  #[JsonProperty('updated_at_ms')]
  public ?int $updatedAtMs;

  /**
   * @var array<string, mixed>|null
   */
  #[JsonProperty('metadata'), ArrayType(['string' => 'mixed'])]
  public ?array $metadata;

  /**
   * @param array{
   *   type: value-of<\ElevenLabs\Types\PendingClipTaskType>,
   *   progress?: ?float,
   *   startedAtMs?: ?int,
   *   updatedAtMs?: ?int,
   *   metadata?: array<string, mixed>|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];
    $this->progress = $values['progress'] ?? null;
    $this->startedAtMs = $values['startedAtMs'] ?? null;
    $this->updatedAtMs = $values['updatedAtMs'] ?? null;
    $this->metadata = $values['metadata'] ?? null;

    $this->_dirtyFields = [
      'type' => true
    ];
    if (array_key_exists('progress', $values)) {
      $this->_dirtyFields['progress'] = true;
    }
    if (array_key_exists('startedAtMs', $values)) {
      $this->_dirtyFields['started_at_ms'] = true;
    }
    if (array_key_exists('updatedAtMs', $values)) {
      $this->_dirtyFields['updated_at_ms'] = true;
    }
    if (array_key_exists('metadata', $values)) {
      $this->_dirtyFields['metadata'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
    ];

    if ($this->progress !== null) {
      $parts[] = [
        'name' => 'progress',
        'contents' => (string) $this->progress
      ];
    }

    if ($this->startedAtMs !== null) {
      $parts[] = [
        'name' => 'started_at_ms',
        'contents' => (string) $this->startedAtMs
      ];
    }

    if ($this->updatedAtMs !== null) {
      $parts[] = [
        'name' => 'updated_at_ms',
        'contents' => (string) $this->updatedAtMs
      ];
    }

    if ($this->metadata !== null) {
      $parts[] = [
        'name' => 'metadata',
        'contents' => json_encode($this->metadata),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
