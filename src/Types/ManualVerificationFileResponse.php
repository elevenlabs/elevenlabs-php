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
class ManualVerificationFileResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The ID of the file.
   */
  #[JsonProperty('file_id', required: true)]
  public string $fileId;

  /**
   * The name of the file.
   */
  #[JsonProperty('file_name', required: true)]
  public string $fileName;

  /**
   * The MIME type of the file.
   */
  #[JsonProperty('mime_type', required: true)]
  public string $mimeType;

  /**
   * The size of the file in bytes.
   */
  #[JsonProperty('size_bytes', required: true)]
  public int $sizeBytes;

  /**
   * The date of the file in Unix time.
   */
  #[JsonProperty('upload_date_unix', required: true)]
  public int $uploadDateUnix;

  /**
   * @param array{
   *   fileId: string,
   *   fileName: string,
   *   mimeType: string,
   *   sizeBytes: int,
   *   uploadDateUnix: int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->fileId = $values['fileId'];
    $this->fileName = $values['fileName'];
    $this->mimeType = $values['mimeType'];
    $this->sizeBytes = $values['sizeBytes'];
    $this->uploadDateUnix = $values['uploadDateUnix'];

    $this->_dirtyFields = [
      'file_id' => true,
      'file_name' => true,
      'mime_type' => true,
      'size_bytes' => true,
      'upload_date_unix' => true
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
      'name' => 'file_name',
      'contents' => $this->fileName
    ];

    $parts[] = [
      'name' => 'mime_type',
      'contents' => $this->mimeType
    ];

    $parts[] = [
      'name' => 'size_bytes',
      'contents' => (string) $this->sizeBytes
    ];

    $parts[] = [
      'name' => 'upload_date_unix',
      'contents' => (string) $this->uploadDateUnix
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
