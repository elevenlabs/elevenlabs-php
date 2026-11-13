<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ProjectVideoResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('video_id', required: true)]
  public string $videoId;

  #[JsonProperty('filename', required: true)]
  public string $filename;

  #[JsonProperty('signed_url', required: true)]
  public ?string $signedUrl;

  #[JsonProperty('signed_preview_url', required: true)]
  public ?string $signedPreviewUrl;

  #[JsonProperty('offset_ms', required: true)]
  public int $offsetMs;

  #[JsonProperty('duration_ms', required: true)]
  public int $durationMs;

  #[JsonProperty('volume_gain_db', required: true)]
  public float $volumeGainDb;

  #[JsonProperty('muted', required: true)]
  public bool $muted;

  #[JsonProperty('fade_in_ms')]
  public ?int $fadeInMs;

  #[JsonProperty('fade_out_ms')]
  public ?int $fadeOutMs;

  #[JsonProperty('width', required: true)]
  public int $width;

  #[JsonProperty('height', required: true)]
  public int $height;

  #[JsonProperty('codec', required: true)]
  public string $codec;

  #[JsonProperty('order', required: true)]
  public string $order;

  #[JsonProperty('created_at_ms', required: true)]
  public int $createdAtMs;

  #[JsonProperty('updated_at_ms', required: true)]
  public int $updatedAtMs;

  #[JsonProperty('error')]
  public ?string $error;

  #[JsonProperty('thumbnail_interval_seconds', required: true)]
  public float $thumbnailIntervalSeconds;

  /**
   * @var int[]
   */
  #[JsonProperty('thumbnail_size', required: true), ArrayType(['integer'])]
  public array $thumbnailSize;

  /**
   * @var \ElevenLabs\Types\ProjectVideoThumbnailSheetResponseModel[]
   */
  #[
    JsonProperty('thumbnail_sheets', required: true),
    ArrayType([\ElevenLabs\Types\ProjectVideoThumbnailSheetResponseModel::class])
  ]
  public array $thumbnailSheets;

  #[JsonProperty('start_time_ms', required: true)]
  public int $startTimeMs;

  #[JsonProperty('end_time_ms', required: true)]
  public ?int $endTimeMs;

  #[JsonProperty('asset_preview_signed_url')]
  public ?string $assetPreviewSignedUrl;

  #[JsonProperty('source_video_id')]
  public ?string $sourceVideoId;

  #[JsonProperty('source_asset_id')]
  public ?string $sourceAssetId;

  #[JsonProperty('source_platform_asset_id')]
  public ?string $sourcePlatformAssetId;

  #[JsonProperty('pending_blocks_metadata')]
  public ?\ElevenLabs\Types\PendingBlocksMetadataModel $pendingBlocksMetadata;

  #[JsonProperty('pending_external_audios_metadata')]
  public ?\ElevenLabs\Types\PendingExternalAudiosMetadataModel $pendingExternalAudiosMetadata;

  #[JsonProperty('speech_imported')]
  public ?bool $speechImported;

  #[JsonProperty('pending_task')]
  public ?\ElevenLabs\Types\PendingClipTask $pendingTask;

  #[JsonProperty('audio_track_ready')]
  public ?bool $audioTrackReady;

  #[JsonProperty('export_format_ready')]
  public ?bool $exportFormatReady;

  #[JsonProperty('current_snapshot_id')]
  public ?string $currentSnapshotId;

  #[JsonProperty('source_context')]
  public ?\ElevenLabs\Types\GenerationSourceContext $sourceContext;

  #[JsonProperty('analysis')]
  public ?\ElevenLabs\Types\VideoAnalysis $analysis;

  #[JsonProperty('transcription')]
  public ?\ElevenLabs\Types\AssetTranscription $transcription;

  /**
   * @var ?value-of<\ElevenLabs\Types\ProjectVideoResponseModelType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * Defines asset positioning and transformation on canvas.
   */
  #[JsonProperty('canvas_placement')]
  public ?\ElevenLabs\Types\CanvasPlacement $canvasPlacement;

  #[JsonProperty('animation')]
  public ?\ElevenLabs\Types\ClipAnimation $animation;

  #[JsonProperty('playback_speed')]
  public ?float $playbackSpeed;

  #[JsonProperty('opacity')]
  public ?float $opacity;

  #[JsonProperty('track_id')]
  public ?string $trackId;

  #[JsonProperty('preview_job_progress')]
  public ?float $previewJobProgress;

  #[JsonProperty('import_speech_progress')]
  public ?float $importSpeechProgress;

  /**
   * @param array{
   *   videoId: string,
   *   filename: string,
   *   signedUrl: ?string,
   *   signedPreviewUrl: ?string,
   *   offsetMs: int,
   *   durationMs: int,
   *   volumeGainDb: float,
   *   muted: bool,
   *   width: int,
   *   height: int,
   *   codec: string,
   *   order: string,
   *   createdAtMs: int,
   *   updatedAtMs: int,
   *   thumbnailIntervalSeconds: float,
   *   thumbnailSize: int[],
   *   thumbnailSheets: \ElevenLabs\Types\ProjectVideoThumbnailSheetResponseModel[],
   *   startTimeMs: int,
   *   endTimeMs: ?int,
   *   fadeInMs?: ?int,
   *   fadeOutMs?: ?int,
   *   error?: ?string,
   *   assetPreviewSignedUrl?: ?string,
   *   sourceVideoId?: ?string,
   *   sourceAssetId?: ?string,
   *   sourcePlatformAssetId?: ?string,
   *   pendingBlocksMetadata?: ?\ElevenLabs\Types\PendingBlocksMetadataModel,
   *   pendingExternalAudiosMetadata?: ?\ElevenLabs\Types\PendingExternalAudiosMetadataModel,
   *   speechImported?: ?bool,
   *   pendingTask?: ?\ElevenLabs\Types\PendingClipTask,
   *   audioTrackReady?: ?bool,
   *   exportFormatReady?: ?bool,
   *   currentSnapshotId?: ?string,
   *   sourceContext?: ?\ElevenLabs\Types\GenerationSourceContext,
   *   analysis?: ?\ElevenLabs\Types\VideoAnalysis,
   *   transcription?: ?\ElevenLabs\Types\AssetTranscription,
   *   type?: ?value-of<\ElevenLabs\Types\ProjectVideoResponseModelType>,
   *   canvasPlacement?: ?\ElevenLabs\Types\CanvasPlacement,
   *   animation?: ?\ElevenLabs\Types\ClipAnimation,
   *   playbackSpeed?: ?float,
   *   opacity?: ?float,
   *   trackId?: ?string,
   *   previewJobProgress?: ?float,
   *   importSpeechProgress?: ?float,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->videoId = $values['videoId'];
    $this->filename = $values['filename'];
    $this->signedUrl = $values['signedUrl'];
    $this->signedPreviewUrl = $values['signedPreviewUrl'];
    $this->offsetMs = $values['offsetMs'];
    $this->durationMs = $values['durationMs'];
    $this->volumeGainDb = $values['volumeGainDb'];
    $this->muted = $values['muted'];
    $this->fadeInMs = $values['fadeInMs'] ?? null;
    $this->fadeOutMs = $values['fadeOutMs'] ?? null;
    $this->width = $values['width'];
    $this->height = $values['height'];
    $this->codec = $values['codec'];
    $this->order = $values['order'];
    $this->createdAtMs = $values['createdAtMs'];
    $this->updatedAtMs = $values['updatedAtMs'];
    $this->error = $values['error'] ?? null;
    $this->thumbnailIntervalSeconds = $values['thumbnailIntervalSeconds'];
    $this->thumbnailSize = $values['thumbnailSize'];
    $this->thumbnailSheets = $values['thumbnailSheets'];
    $this->startTimeMs = $values['startTimeMs'];
    $this->endTimeMs = $values['endTimeMs'];
    $this->assetPreviewSignedUrl = $values['assetPreviewSignedUrl'] ?? null;
    $this->sourceVideoId = $values['sourceVideoId'] ?? null;
    $this->sourceAssetId = $values['sourceAssetId'] ?? null;
    $this->sourcePlatformAssetId = $values['sourcePlatformAssetId'] ?? null;
    $this->pendingBlocksMetadata = $values['pendingBlocksMetadata'] ?? null;
    $this->pendingExternalAudiosMetadata = $values['pendingExternalAudiosMetadata'] ?? null;
    $this->speechImported = $values['speechImported'] ?? null;
    $this->pendingTask = $values['pendingTask'] ?? null;
    $this->audioTrackReady = $values['audioTrackReady'] ?? null;
    $this->exportFormatReady = $values['exportFormatReady'] ?? null;
    $this->currentSnapshotId = $values['currentSnapshotId'] ?? null;
    $this->sourceContext = $values['sourceContext'] ?? null;
    $this->analysis = $values['analysis'] ?? null;
    $this->transcription = $values['transcription'] ?? null;
    $this->type = $values['type'] ?? 'video';
    $this->canvasPlacement = $values['canvasPlacement'] ?? null;
    $this->animation = $values['animation'] ?? null;
    $this->playbackSpeed = $values['playbackSpeed'] ?? null;
    $this->opacity = $values['opacity'] ?? null;
    $this->trackId = $values['trackId'] ?? null;
    $this->previewJobProgress = $values['previewJobProgress'] ?? null;
    $this->importSpeechProgress = $values['importSpeechProgress'] ?? null;

    $this->_dirtyFields = [
      'video_id' => true,
      'filename' => true,
      'signed_url' => true,
      'signed_preview_url' => true,
      'offset_ms' => true,
      'duration_ms' => true,
      'volume_gain_db' => true,
      'muted' => true,
      'width' => true,
      'height' => true,
      'codec' => true,
      'order' => true,
      'created_at_ms' => true,
      'updated_at_ms' => true,
      'thumbnail_interval_seconds' => true,
      'thumbnail_size' => true,
      'thumbnail_sheets' => true,
      'start_time_ms' => true,
      'end_time_ms' => true
    ];
    if (array_key_exists('fadeInMs', $values)) {
      $this->_dirtyFields['fade_in_ms'] = true;
    }
    if (array_key_exists('fadeOutMs', $values)) {
      $this->_dirtyFields['fade_out_ms'] = true;
    }
    if (array_key_exists('error', $values)) {
      $this->_dirtyFields['error'] = true;
    }
    if (array_key_exists('assetPreviewSignedUrl', $values)) {
      $this->_dirtyFields['asset_preview_signed_url'] = true;
    }
    if (array_key_exists('sourceVideoId', $values)) {
      $this->_dirtyFields['source_video_id'] = true;
    }
    if (array_key_exists('sourceAssetId', $values)) {
      $this->_dirtyFields['source_asset_id'] = true;
    }
    if (array_key_exists('sourcePlatformAssetId', $values)) {
      $this->_dirtyFields['source_platform_asset_id'] = true;
    }
    if (array_key_exists('pendingBlocksMetadata', $values)) {
      $this->_dirtyFields['pending_blocks_metadata'] = true;
    }
    if (array_key_exists('pendingExternalAudiosMetadata', $values)) {
      $this->_dirtyFields['pending_external_audios_metadata'] = true;
    }
    if (array_key_exists('speechImported', $values)) {
      $this->_dirtyFields['speech_imported'] = true;
    }
    if (array_key_exists('pendingTask', $values)) {
      $this->_dirtyFields['pending_task'] = true;
    }
    if (array_key_exists('audioTrackReady', $values)) {
      $this->_dirtyFields['audio_track_ready'] = true;
    }
    if (array_key_exists('exportFormatReady', $values)) {
      $this->_dirtyFields['export_format_ready'] = true;
    }
    if (array_key_exists('currentSnapshotId', $values)) {
      $this->_dirtyFields['current_snapshot_id'] = true;
    }
    if (array_key_exists('sourceContext', $values)) {
      $this->_dirtyFields['source_context'] = true;
    }
    if (array_key_exists('analysis', $values)) {
      $this->_dirtyFields['analysis'] = true;
    }
    if (array_key_exists('transcription', $values)) {
      $this->_dirtyFields['transcription'] = true;
    }
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
    if (array_key_exists('canvasPlacement', $values)) {
      $this->_dirtyFields['canvas_placement'] = true;
    }
    if (array_key_exists('animation', $values)) {
      $this->_dirtyFields['animation'] = true;
    }
    if (array_key_exists('playbackSpeed', $values)) {
      $this->_dirtyFields['playback_speed'] = true;
    }
    if (array_key_exists('opacity', $values)) {
      $this->_dirtyFields['opacity'] = true;
    }
    if (array_key_exists('trackId', $values)) {
      $this->_dirtyFields['track_id'] = true;
    }
    if (array_key_exists('previewJobProgress', $values)) {
      $this->_dirtyFields['preview_job_progress'] = true;
    }
    if (array_key_exists('importSpeechProgress', $values)) {
      $this->_dirtyFields['import_speech_progress'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'video_id',
      'contents' => $this->videoId
    ];

    $parts[] = [
      'name' => 'filename',
      'contents' => $this->filename
    ];

    $parts[] = [
      'name' => 'signed_url',
      'contents' => $this->signedUrl
    ];

    $parts[] = [
      'name' => 'signed_preview_url',
      'contents' => $this->signedPreviewUrl
    ];

    $parts[] = [
      'name' => 'offset_ms',
      'contents' => (string) $this->offsetMs
    ];

    $parts[] = [
      'name' => 'duration_ms',
      'contents' => (string) $this->durationMs
    ];

    $parts[] = [
      'name' => 'volume_gain_db',
      'contents' => (string) $this->volumeGainDb
    ];

    $parts[] = [
      'name' => 'muted',
      'contents' => $this->muted ? 'true' : 'false'
    ];

    if ($this->fadeInMs !== null) {
      $parts[] = [
        'name' => 'fade_in_ms',
        'contents' => (string) $this->fadeInMs
      ];
    }

    if ($this->fadeOutMs !== null) {
      $parts[] = [
        'name' => 'fade_out_ms',
        'contents' => (string) $this->fadeOutMs
      ];
    }

    $parts[] = [
      'name' => 'width',
      'contents' => (string) $this->width
    ];

    $parts[] = [
      'name' => 'height',
      'contents' => (string) $this->height
    ];

    $parts[] = [
      'name' => 'codec',
      'contents' => $this->codec
    ];

    $parts[] = [
      'name' => 'order',
      'contents' => $this->order
    ];

    $parts[] = [
      'name' => 'created_at_ms',
      'contents' => (string) $this->createdAtMs
    ];

    $parts[] = [
      'name' => 'updated_at_ms',
      'contents' => (string) $this->updatedAtMs
    ];

    if ($this->error !== null) {
      $parts[] = [
        'name' => 'error',
        'contents' => $this->error
      ];
    }

    $parts[] = [
      'name' => 'thumbnail_interval_seconds',
      'contents' => (string) $this->thumbnailIntervalSeconds
    ];

    foreach ($this->thumbnailSize as $item) {
      $parts[] = [
        'name' => 'thumbnail_size',
        'contents' => (string) $item
      ];
    }

    $parts[] = [
      'name' => 'thumbnail_sheets',
      'contents' => json_encode($this->thumbnailSheets),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'start_time_ms',
      'contents' => (string) $this->startTimeMs
    ];

    $parts[] = [
      'name' => 'end_time_ms',
      'contents' => (string) $this->endTimeMs
    ];

    if ($this->assetPreviewSignedUrl !== null) {
      $parts[] = [
        'name' => 'asset_preview_signed_url',
        'contents' => $this->assetPreviewSignedUrl
      ];
    }

    if ($this->sourceVideoId !== null) {
      $parts[] = [
        'name' => 'source_video_id',
        'contents' => $this->sourceVideoId
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

    if ($this->pendingBlocksMetadata !== null) {
      $parts[] = [
        'name' => 'pending_blocks_metadata',
        'contents' => json_encode($this->pendingBlocksMetadata),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->pendingExternalAudiosMetadata !== null) {
      $parts[] = [
        'name' => 'pending_external_audios_metadata',
        'contents' => json_encode($this->pendingExternalAudiosMetadata),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->speechImported !== null) {
      $parts[] = [
        'name' => 'speech_imported',
        'contents' => $this->speechImported ? 'true' : 'false'
      ];
    }

    if ($this->pendingTask !== null) {
      $parts[] = [
        'name' => 'pending_task',
        'contents' => json_encode($this->pendingTask),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->audioTrackReady !== null) {
      $parts[] = [
        'name' => 'audio_track_ready',
        'contents' => $this->audioTrackReady ? 'true' : 'false'
      ];
    }

    if ($this->exportFormatReady !== null) {
      $parts[] = [
        'name' => 'export_format_ready',
        'contents' => $this->exportFormatReady ? 'true' : 'false'
      ];
    }

    if ($this->currentSnapshotId !== null) {
      $parts[] = [
        'name' => 'current_snapshot_id',
        'contents' => $this->currentSnapshotId
      ];
    }

    if ($this->sourceContext !== null) {
      $parts[] = [
        'name' => 'source_context',
        'contents' => json_encode($this->sourceContext),
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

    if ($this->transcription !== null) {
      $parts[] = [
        'name' => 'transcription',
        'contents' => json_encode($this->transcription),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->type !== null) {
      $parts[] = [
        'name' => 'type',
        'contents' => $this->type
      ];
    }

    if ($this->canvasPlacement !== null) {
      $parts[] = [
        'name' => 'canvas_placement',
        'contents' => json_encode($this->canvasPlacement),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->animation !== null) {
      $parts[] = [
        'name' => 'animation',
        'contents' => json_encode($this->animation),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->playbackSpeed !== null) {
      $parts[] = [
        'name' => 'playback_speed',
        'contents' => (string) $this->playbackSpeed
      ];
    }

    if ($this->opacity !== null) {
      $parts[] = [
        'name' => 'opacity',
        'contents' => (string) $this->opacity
      ];
    }

    if ($this->trackId !== null) {
      $parts[] = [
        'name' => 'track_id',
        'contents' => $this->trackId
      ];
    }

    if ($this->previewJobProgress !== null) {
      $parts[] = [
        'name' => 'preview_job_progress',
        'contents' => (string) $this->previewJobProgress
      ];
    }

    if ($this->importSpeechProgress !== null) {
      $parts[] = [
        'name' => 'import_speech_progress',
        'contents' => (string) $this->importSpeechProgress
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateArray($this->thumbnailSize, 'thumbnail_size', minItems: 2, maxItems: 2);
    foreach ($this->thumbnailSheets as $item) {
      $item->validate();
    }
    $this->pendingBlocksMetadata?->validate();
    $this->pendingExternalAudiosMetadata?->validate();
    $this->pendingTask?->validate();
    $this->sourceContext?->validate();
    $this->analysis?->validate();
    $this->transcription?->validate();
    $this->canvasPlacement?->validate();
    $this->animation?->validate();
    Validator::validateNumber($this->opacity, 'opacity', min: 0, max: 1);
  }
}
