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
class RecordingResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The ID of the recording.
   */
  #[JsonProperty('recording_id', required: true)]
  public string $recordingId;

  /**
   * The MIME type of the recording.
   */
  #[JsonProperty('mime_type', required: true)]
  public string $mimeType;

  /**
   * The size of the recording in bytes.
   */
  #[JsonProperty('size_bytes', required: true)]
  public int $sizeBytes;

  /**
   * The date of the recording in Unix time.
   */
  #[JsonProperty('upload_date_unix', required: true)]
  public int $uploadDateUnix;

  /**
   * The transcription of the recording.
   */
  #[JsonProperty('transcription', required: true)]
  public string $transcription;

  /**
   * @param array{
   *   recordingId: string,
   *   mimeType: string,
   *   sizeBytes: int,
   *   uploadDateUnix: int,
   *   transcription: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->recordingId = $values['recordingId'];
    $this->mimeType = $values['mimeType'];
    $this->sizeBytes = $values['sizeBytes'];
    $this->uploadDateUnix = $values['uploadDateUnix'];
    $this->transcription = $values['transcription'];

    $this->_dirtyFields = [
      'recording_id' => true,
      'mime_type' => true,
      'size_bytes' => true,
      'upload_date_unix' => true,
      'transcription' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'recording_id',
      'contents' => $this->recordingId
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

    $parts[] = [
      'name' => 'transcription',
      'contents' => $this->transcription
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
