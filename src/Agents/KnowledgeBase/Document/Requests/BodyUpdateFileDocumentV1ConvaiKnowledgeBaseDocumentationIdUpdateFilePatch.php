<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\KnowledgeBase\Document\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyUpdateFileDocumentV1ConvaiKnowledgeBaseDocumentationIdUpdateFilePatch extends
  JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Utils\File
   * Documentation that the agent will have access to in order to interact with users.
   */
  #[JsonProperty('file', required: true)]
  public \ElevenLabs\Utils\File $file;

  /**
   * @param array{
   *   file: \ElevenLabs\Utils\File,
   * } $values
   */
  public function __construct(array $values)
  {
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
