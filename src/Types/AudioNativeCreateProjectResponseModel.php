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
class AudioNativeCreateProjectResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The ID of the created Audio Native project.
   */
  #[JsonProperty('project_id', required: true)]
  public string $projectId;

  /**
   * Whether the project is currently being converted.
   */
  #[JsonProperty('converting', required: true)]
  public bool $converting;

  /**
   * The HTML snippet to embed the Audio Native player.
   */
  #[JsonProperty('html_snippet', required: true)]
  public string $htmlSnippet;

  /**
   * @param array{
   *   projectId: string,
   *   converting: bool,
   *   htmlSnippet: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->projectId = $values['projectId'];
    $this->converting = $values['converting'];
    $this->htmlSnippet = $values['htmlSnippet'];

    $this->_dirtyFields = [
      'project_id' => true,
      'converting' => true,
      'html_snippet' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'project_id',
      'contents' => $this->projectId
    ];

    $parts[] = [
      'name' => 'converting',
      'contents' => $this->converting ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'html_snippet',
      'contents' => $this->htmlSnippet
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
