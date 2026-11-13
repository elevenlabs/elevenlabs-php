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
class AudioIsolationHistoryItemResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('id', required: true)]
  public string $id;

  #[JsonProperty('title', required: true)]
  public ?string $title;

  #[JsonProperty('created_at_unix', required: true)]
  public int $createdAtUnix;

  #[JsonProperty('format', required: true)]
  public string $format;

  #[JsonProperty('duration_seconds', required: true)]
  public ?float $durationSeconds;

  #[JsonProperty('download_url', required: true)]
  public ?string $downloadUrl;

  #[JsonProperty('icon_url', required: true)]
  public ?string $iconUrl;

  #[JsonProperty('source_video_url', required: true)]
  public ?string $sourceVideoUrl;

  #[JsonProperty('supports_video', required: true)]
  public bool $supportsVideo;

  #[JsonProperty('processing', required: true)]
  public bool $processing;

  #[JsonProperty('video_processing_failed', required: true)]
  public bool $videoProcessingFailed;

  #[JsonProperty('preview_b64', required: true)]
  public ?string $previewB64;

  /**
   * @param array{
   *   id: string,
   *   title: ?string,
   *   createdAtUnix: int,
   *   format: string,
   *   durationSeconds: ?float,
   *   downloadUrl: ?string,
   *   iconUrl: ?string,
   *   sourceVideoUrl: ?string,
   *   supportsVideo: bool,
   *   processing: bool,
   *   videoProcessingFailed: bool,
   *   previewB64: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->id = $values['id'];
    $this->title = $values['title'];
    $this->createdAtUnix = $values['createdAtUnix'];
    $this->format = $values['format'];
    $this->durationSeconds = $values['durationSeconds'];
    $this->downloadUrl = $values['downloadUrl'];
    $this->iconUrl = $values['iconUrl'];
    $this->sourceVideoUrl = $values['sourceVideoUrl'];
    $this->supportsVideo = $values['supportsVideo'];
    $this->processing = $values['processing'];
    $this->videoProcessingFailed = $values['videoProcessingFailed'];
    $this->previewB64 = $values['previewB64'];

    $this->_dirtyFields = [
      'id' => true,
      'title' => true,
      'created_at_unix' => true,
      'format' => true,
      'duration_seconds' => true,
      'download_url' => true,
      'icon_url' => true,
      'source_video_url' => true,
      'supports_video' => true,
      'processing' => true,
      'video_processing_failed' => true,
      'preview_b64' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'id',
      'contents' => $this->id
    ];

    $parts[] = [
      'name' => 'title',
      'contents' => $this->title
    ];

    $parts[] = [
      'name' => 'created_at_unix',
      'contents' => (string) $this->createdAtUnix
    ];

    $parts[] = [
      'name' => 'format',
      'contents' => $this->format
    ];

    $parts[] = [
      'name' => 'duration_seconds',
      'contents' => (string) $this->durationSeconds
    ];

    $parts[] = [
      'name' => 'download_url',
      'contents' => $this->downloadUrl
    ];

    $parts[] = [
      'name' => 'icon_url',
      'contents' => $this->iconUrl
    ];

    $parts[] = [
      'name' => 'source_video_url',
      'contents' => $this->sourceVideoUrl
    ];

    $parts[] = [
      'name' => 'supports_video',
      'contents' => $this->supportsVideo ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'processing',
      'contents' => $this->processing ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'video_processing_failed',
      'contents' => $this->videoProcessingFailed ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'preview_b64',
      'contents' => $this->previewB64
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
