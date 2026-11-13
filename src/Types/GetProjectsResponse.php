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
class GetProjectsResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\ProjectResponse[]
   * A list of projects with their metadata.
   */
  #[JsonProperty('projects', required: true), ArrayType([\ElevenLabs\Types\ProjectResponse::class])]
  public array $projects;

  /**
   * @param array{
   *   projects: \ElevenLabs\Types\ProjectResponse[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->projects = $values['projects'];

    $this->_dirtyFields = [
      'projects' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'projects',
      'contents' => json_encode($this->projects),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->projects as $item) {
      $item->validate();
    }
  }
}
