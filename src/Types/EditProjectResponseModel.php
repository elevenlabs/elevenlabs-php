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
class EditProjectResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('project', required: true)]
  public \ElevenLabs\Types\ProjectResponse $project;

  /**
   * @param array{
   *   project: \ElevenLabs\Types\ProjectResponse,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->project = $values['project'];

    $this->_dirtyFields = [
      'project' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'project',
      'contents' => json_encode($this->project),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->project->validate();
  }
}
