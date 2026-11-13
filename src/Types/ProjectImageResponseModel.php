<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ProjectImageResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('image_id', required: true)]
  public string $imageId;

  #[JsonProperty('filename', required: true)]
  public string $filename;

  #[JsonProperty('signed_url')]
  public ?string $signedUrl;

  #[JsonProperty('thumbnail_signed_url')]
  public ?string $thumbnailSignedUrl;

  /**
   * @var ?value-of<\ElevenLabs\Types\ProjectImageResponseModelType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * @var ?value-of<\ElevenLabs\Types\ProjectImageResponseModelSource>
   */
  #[JsonProperty('source')]
  public ?string $source;

  #[JsonProperty('file_size_bytes', required: true)]
  public int $fileSizeBytes;

  #[JsonProperty('width', required: true)]
  public int $width;

  #[JsonProperty('height', required: true)]
  public int $height;

  #[JsonProperty('track_id')]
  public ?string $trackId;

  #[JsonProperty('offset_ms', required: true)]
  public int $offsetMs;

  #[JsonProperty('duration_ms', required: true)]
  public int $durationMs;

  #[JsonProperty('order', required: true)]
  public string $order;

  /**
   * Defines asset positioning and transformation on canvas.
   */
  #[JsonProperty('canvas_placement', required: true)]
  public \ElevenLabs\Types\CanvasPlacement $canvasPlacement;

  #[JsonProperty('animation')]
  public ?\ElevenLabs\Types\ClipAnimation $animation;

  #[JsonProperty('opacity')]
  public ?float $opacity;

  #[JsonProperty('created_at_ms', required: true)]
  public int $createdAtMs;

  #[JsonProperty('updated_at_ms', required: true)]
  public int $updatedAtMs;

  #[JsonProperty('current_snapshot_id')]
  public ?string $currentSnapshotId;

  #[JsonProperty('source_asset_id')]
  public ?string $sourceAssetId;

  #[JsonProperty('source_platform_asset_id')]
  public ?string $sourcePlatformAssetId;

  #[JsonProperty('error')]
  public ?string $error;

  #[JsonProperty('pending_task')]
  public ?\ElevenLabs\Types\PendingClipTask $pendingTask;

  #[JsonProperty('analysis')]
  public ?\ElevenLabs\Types\ImageAnalysis $analysis;

  /**
   * @param array{
   *   imageId: string,
   *   filename: string,
   *   fileSizeBytes: int,
   *   width: int,
   *   height: int,
   *   offsetMs: int,
   *   durationMs: int,
   *   order: string,
   *   canvasPlacement: \ElevenLabs\Types\CanvasPlacement,
   *   createdAtMs: int,
   *   updatedAtMs: int,
   *   signedUrl?: ?string,
   *   thumbnailSignedUrl?: ?string,
   *   type?: ?value-of<\ElevenLabs\Types\ProjectImageResponseModelType>,
   *   source?: ?value-of<\ElevenLabs\Types\ProjectImageResponseModelSource>,
   *   trackId?: ?string,
   *   animation?: ?\ElevenLabs\Types\ClipAnimation,
   *   opacity?: ?float,
   *   currentSnapshotId?: ?string,
   *   sourceAssetId?: ?string,
   *   sourcePlatformAssetId?: ?string,
   *   error?: ?string,
   *   pendingTask?: ?\ElevenLabs\Types\PendingClipTask,
   *   analysis?: ?\ElevenLabs\Types\ImageAnalysis,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->imageId = $values['imageId'];
    $this->filename = $values['filename'];
    $this->signedUrl = $values['signedUrl'] ?? null;
    $this->thumbnailSignedUrl = $values['thumbnailSignedUrl'] ?? null;
    $this->type = $values['type'] ?? 'image';
    $this->source = $values['source'] ?? 'upload';
    $this->fileSizeBytes = $values['fileSizeBytes'];
    $this->width = $values['width'];
    $this->height = $values['height'];
    $this->trackId = $values['trackId'] ?? null;
    $this->offsetMs = $values['offsetMs'];
    $this->durationMs = $values['durationMs'];
    $this->order = $values['order'];
    $this->canvasPlacement = $values['canvasPlacement'];
    $this->animation = $values['animation'] ?? null;
    $this->opacity = $values['opacity'] ?? null;
    $this->createdAtMs = $values['createdAtMs'];
    $this->updatedAtMs = $values['updatedAtMs'];
    $this->currentSnapshotId = $values['currentSnapshotId'] ?? null;
    $this->sourceAssetId = $values['sourceAssetId'] ?? null;
    $this->sourcePlatformAssetId = $values['sourcePlatformAssetId'] ?? null;
    $this->error = $values['error'] ?? null;
    $this->pendingTask = $values['pendingTask'] ?? null;
    $this->analysis = $values['analysis'] ?? null;

    $this->_dirtyFields = [
      'image_id' => true,
      'filename' => true,
      'file_size_bytes' => true,
      'width' => true,
      'height' => true,
      'offset_ms' => true,
      'duration_ms' => true,
      'order' => true,
      'canvas_placement' => true,
      'created_at_ms' => true,
      'updated_at_ms' => true
    ];
    if (array_key_exists('signedUrl', $values)) {
      $this->_dirtyFields['signed_url'] = true;
    }
    if (array_key_exists('thumbnailSignedUrl', $values)) {
      $this->_dirtyFields['thumbnail_signed_url'] = true;
    }
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
    if (array_key_exists('source', $values)) {
      $this->_dirtyFields['source'] = true;
    }
    if (array_key_exists('trackId', $values)) {
      $this->_dirtyFields['track_id'] = true;
    }
    if (array_key_exists('animation', $values)) {
      $this->_dirtyFields['animation'] = true;
    }
    if (array_key_exists('opacity', $values)) {
      $this->_dirtyFields['opacity'] = true;
    }
    if (array_key_exists('currentSnapshotId', $values)) {
      $this->_dirtyFields['current_snapshot_id'] = true;
    }
    if (array_key_exists('sourceAssetId', $values)) {
      $this->_dirtyFields['source_asset_id'] = true;
    }
    if (array_key_exists('sourcePlatformAssetId', $values)) {
      $this->_dirtyFields['source_platform_asset_id'] = true;
    }
    if (array_key_exists('error', $values)) {
      $this->_dirtyFields['error'] = true;
    }
    if (array_key_exists('pendingTask', $values)) {
      $this->_dirtyFields['pending_task'] = true;
    }
    if (array_key_exists('analysis', $values)) {
      $this->_dirtyFields['analysis'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'image_id',
      'contents' => $this->imageId
    ];

    $parts[] = [
      'name' => 'filename',
      'contents' => $this->filename
    ];

    if ($this->signedUrl !== null) {
      $parts[] = [
        'name' => 'signed_url',
        'contents' => $this->signedUrl
      ];
    }

    if ($this->thumbnailSignedUrl !== null) {
      $parts[] = [
        'name' => 'thumbnail_signed_url',
        'contents' => $this->thumbnailSignedUrl
      ];
    }

    if ($this->type !== null) {
      $parts[] = [
        'name' => 'type',
        'contents' => $this->type
      ];
    }

    if ($this->source !== null) {
      $parts[] = [
        'name' => 'source',
        'contents' => $this->source
      ];
    }

    $parts[] = [
      'name' => 'file_size_bytes',
      'contents' => (string) $this->fileSizeBytes
    ];

    $parts[] = [
      'name' => 'width',
      'contents' => (string) $this->width
    ];

    $parts[] = [
      'name' => 'height',
      'contents' => (string) $this->height
    ];

    if ($this->trackId !== null) {
      $parts[] = [
        'name' => 'track_id',
        'contents' => $this->trackId
      ];
    }

    $parts[] = [
      'name' => 'offset_ms',
      'contents' => (string) $this->offsetMs
    ];

    $parts[] = [
      'name' => 'duration_ms',
      'contents' => (string) $this->durationMs
    ];

    $parts[] = [
      'name' => 'order',
      'contents' => $this->order
    ];

    $parts[] = [
      'name' => 'canvas_placement',
      'contents' => json_encode($this->canvasPlacement),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->animation !== null) {
      $parts[] = [
        'name' => 'animation',
        'contents' => json_encode($this->animation),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->opacity !== null) {
      $parts[] = [
        'name' => 'opacity',
        'contents' => (string) $this->opacity
      ];
    }

    $parts[] = [
      'name' => 'created_at_ms',
      'contents' => (string) $this->createdAtMs
    ];

    $parts[] = [
      'name' => 'updated_at_ms',
      'contents' => (string) $this->updatedAtMs
    ];

    if ($this->currentSnapshotId !== null) {
      $parts[] = [
        'name' => 'current_snapshot_id',
        'contents' => $this->currentSnapshotId
      ];
    }

    if ($this->sourceAssetId !== null) {
      $parts[] = [
        'name' => 'source_asset_id',
        'contents' => $this->sourceAssetId
      ];
    }

    if ($this->sourcePlatformAssetId !== null) {
      $parts[] = [
        'name' => 'source_platform_asset_id',
        'contents' => $this->sourcePlatformAssetId
      ];
    }

    if ($this->error !== null) {
      $parts[] = [
        'name' => 'error',
        'contents' => $this->error
      ];
    }

    if ($this->pendingTask !== null) {
      $parts[] = [
        'name' => 'pending_task',
        'contents' => json_encode($this->pendingTask),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->analysis !== null) {
      $parts[] = [
        'name' => 'analysis',
        'contents' => json_encode($this->analysis),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->canvasPlacement->validate();
    $this->animation?->validate();
    Validator::validateNumber($this->opacity, 'opacity', min: 0, max: 1);
    $this->pendingTask?->validate();
    $this->analysis?->validate();
  }
}
