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
class ProjectCreationMetaResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The progress of the project creation.
   */
  #[JsonProperty('creation_progress', required: true)]
  public float $creationProgress;

  /**
   * @var value-of<\ElevenLabs\Types\ProjectCreationMetaResponseModelStatus>
   * The status of the project creation action.
   */
  #[JsonProperty('status', required: true)]
  public string $status;

  /**
   * @var value-of<\ElevenLabs\Types\ProjectCreationMetaType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  /**
   * @param array{
   *   creationProgress: float,
   *   status: value-of<\ElevenLabs\Types\ProjectCreationMetaResponseModelStatus>,
   *   type: value-of<\ElevenLabs\Types\ProjectCreationMetaType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->creationProgress = $values['creationProgress'];
    $this->status = $values['status'];
    $this->type = $values['type'];

    $this->_dirtyFields = [
      'creation_progress' => true,
      'status' => true,
      'type' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'creation_progress',
      'contents' => (string) $this->creationProgress
    ];

    $parts[] = [
      'name' => 'status',
      'contents' => $this->status
    ];

    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
