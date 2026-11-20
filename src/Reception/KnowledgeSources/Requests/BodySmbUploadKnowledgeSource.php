<?php

declare(strict_types=1);

namespace ElevenLabs\Reception\KnowledgeSources\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodySmbUploadKnowledgeSource extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The customer workspace a reseller's API key acts on.
   */
  public string $xiWorkspaceId;

  /**
   * @var \ElevenLabs\Utils\File
   * The document the receptionist should learn from.
   */
  #[JsonProperty('file', required: true)]
  public \ElevenLabs\Utils\File $file;

  /**
   * @param array{
   *   xiWorkspaceId: string,
   *   file: \ElevenLabs\Utils\File,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->xiWorkspaceId = $values['xiWorkspaceId'];
    $this->file = $values['file'];

    $this->_dirtyFields = [
      'file' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = $this->file->toMultipartFormDataPart('file')->toGuzzlePart();

    return $parts;
  }

  public function validate(): void
  {
  }
}
