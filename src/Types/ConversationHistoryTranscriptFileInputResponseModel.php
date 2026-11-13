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
class ConversationHistoryTranscriptFileInputResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('file_id', required: true)]
  public string $fileId;

  #[JsonProperty('original_filename', required: true)]
  public string $originalFilename;

  #[JsonProperty('mime_type', required: true)]
  public string $mimeType;

  #[JsonProperty('file_url', required: true)]
  public string $fileUrl;

  /**
   * @param array{
   *   fileId: string,
   *   originalFilename: string,
   *   mimeType: string,
   *   fileUrl: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->fileId = $values['fileId'];
    $this->originalFilename = $values['originalFilename'];
    $this->mimeType = $values['mimeType'];
    $this->fileUrl = $values['fileUrl'];

    $this->_dirtyFields = [
      'file_id' => true,
      'original_filename' => true,
      'mime_type' => true,
      'file_url' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'file_id',
      'contents' => $this->fileId
    ];

    $parts[] = [
      'name' => 'original_filename',
      'contents' => $this->originalFilename
    ];

    $parts[] = [
      'name' => 'mime_type',
      'contents' => $this->mimeType
    ];

    $parts[] = [
      'name' => 'file_url',
      'contents' => $this->fileUrl
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
