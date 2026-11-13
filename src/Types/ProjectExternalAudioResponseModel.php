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
class ProjectExternalAudioResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('external_audio_id', required: true)]
  public string $externalAudioId;

  #[JsonProperty('filename', required: true)]
  public string $filename;

  #[JsonProperty('signed_url', required: true)]
  public ?string $signedUrl;

  #[JsonProperty('offset_ms', required: true)]
  public int $offsetMs;

  #[JsonProperty('duration_ms', required: true)]
  public int $durationMs;

  #[JsonProperty('start_time_ms', required: true)]
  public int $startTimeMs;

  #[JsonProperty('end_time_ms', required: true)]
  public ?int $endTimeMs;

  #[JsonProperty('order', required: true)]
  public string $order;

  #[JsonProperty('track_id', required: true)]
  public string $trackId;

  #[JsonProperty('created_at_ms', required: true)]
  public int $createdAtMs;

  #[JsonProperty('updated_at_ms', required: true)]
  public int $updatedAtMs;

  #[JsonProperty('volume_gain_db')]
  public ?float $volumeGainDb;

  #[JsonProperty('muted')]
  public ?bool $muted;

  #[JsonProperty('fade_in_ms')]
  public ?int $fadeInMs;

  #[JsonProperty('fade_out_ms')]
  public ?int $fadeOutMs;

  #[JsonProperty('source_external_audio_id')]
  public ?string $sourceExternalAudioId;

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

  #[JsonProperty('error')]
  public ?string $error;

  #[JsonProperty('current_snapshot_id')]
  public ?string $currentSnapshotId;

  #[JsonProperty('source_context')]
  public ?\ElevenLabs\Types\ProjectExternalAudioResponseModelSourceContext $sourceContext;

  #[JsonProperty('analysis')]
  public ?\ElevenLabs\Types\AudioAnalysis $analysis;

  #[JsonProperty('transcription')]
  public ?\ElevenLabs\Types\AssetTranscription $transcription;

  /**
   * @var ?value-of<\ElevenLabs\Types\ProjectExternalAudioResponseModelType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  #[JsonProperty('import_speech_progress')]
  public ?float $importSpeechProgress;

  /**
   * @param array{
   *   externalAudioId: string,
   *   filename: string,
   *   signedUrl: ?string,
   *   offsetMs: int,
   *   durationMs: int,
   *   startTimeMs: int,
   *   endTimeMs: ?int,
   *   order: string,
   *   trackId: string,
   *   createdAtMs: int,
   *   updatedAtMs: int,
   *   volumeGainDb?: ?float,
   *   muted?: ?bool,
   *   fadeInMs?: ?int,
   *   fadeOutMs?: ?int,
   *   sourceExternalAudioId?: ?string,
   *   sourceAssetId?: ?string,
   *   sourcePlatformAssetId?: ?string,
   *   pendingBlocksMetadata?: ?\ElevenLabs\Types\PendingBlocksMetadataModel,
   *   pendingExternalAudiosMetadata?: ?\ElevenLabs\Types\PendingExternalAudiosMetadataModel,
   *   speechImported?: ?bool,
   *   pendingTask?: ?\ElevenLabs\Types\PendingClipTask,
   *   error?: ?string,
   *   currentSnapshotId?: ?string,
   *   sourceContext?: ?\ElevenLabs\Types\ProjectExternalAudioResponseModelSourceContext,
   *   analysis?: ?\ElevenLabs\Types\AudioAnalysis,
   *   transcription?: ?\ElevenLabs\Types\AssetTranscription,
   *   type?: ?value-of<\ElevenLabs\Types\ProjectExternalAudioResponseModelType>,
   *   importSpeechProgress?: ?float,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->externalAudioId = $values['externalAudioId'];
    $this->filename = $values['filename'];
    $this->signedUrl = $values['signedUrl'];
    $this->offsetMs = $values['offsetMs'];
    $this->durationMs = $values['durationMs'];
    $this->startTimeMs = $values['startTimeMs'];
    $this->endTimeMs = $values['endTimeMs'];
    $this->order = $values['order'];
    $this->trackId = $values['trackId'];
    $this->createdAtMs = $values['createdAtMs'];
    $this->updatedAtMs = $values['updatedAtMs'];
    $this->volumeGainDb = $values['volumeGainDb'] ?? null;
    $this->muted = $values['muted'] ?? null;
    $this->fadeInMs = $values['fadeInMs'] ?? null;
    $this->fadeOutMs = $values['fadeOutMs'] ?? null;
    $this->sourceExternalAudioId = $values['sourceExternalAudioId'] ?? null;
    $this->sourceAssetId = $values['sourceAssetId'] ?? null;
    $this->sourcePlatformAssetId = $values['sourcePlatformAssetId'] ?? null;
    $this->pendingBlocksMetadata = $values['pendingBlocksMetadata'] ?? null;
    $this->pendingExternalAudiosMetadata = $values['pendingExternalAudiosMetadata'] ?? null;
    $this->speechImported = $values['speechImported'] ?? null;
    $this->pendingTask = $values['pendingTask'] ?? null;
    $this->error = $values['error'] ?? null;
    $this->currentSnapshotId = $values['currentSnapshotId'] ?? null;
    $this->sourceContext = $values['sourceContext'] ?? null;
    $this->analysis = $values['analysis'] ?? null;
    $this->transcription = $values['transcription'] ?? null;
    $this->type = $values['type'] ?? 'audio';
    $this->importSpeechProgress = $values['importSpeechProgress'] ?? null;

    $this->_dirtyFields = [
      'external_audio_id' => true,
      'filename' => true,
      'signed_url' => true,
      'offset_ms' => true,
      'duration_ms' => true,
      'start_time_ms' => true,
      'end_time_ms' => true,
      'order' => true,
      'track_id' => true,
      'created_at_ms' => true,
      'updated_at_ms' => true
    ];
    if (array_key_exists('volumeGainDb', $values)) {
      $this->_dirtyFields['volume_gain_db'] = true;
    }
    if (array_key_exists('muted', $values)) {
      $this->_dirtyFields['muted'] = true;
    }
    if (array_key_exists('fadeInMs', $values)) {
      $this->_dirtyFields['fade_in_ms'] = true;
    }
    if (array_key_exists('fadeOutMs', $values)) {
      $this->_dirtyFields['fade_out_ms'] = true;
    }
    if (array_key_exists('sourceExternalAudioId', $values)) {
      $this->_dirtyFields['source_external_audio_id'] = true;
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
    if (array_key_exists('error', $values)) {
      $this->_dirtyFields['error'] = true;
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
    if (array_key_exists('importSpeechProgress', $values)) {
      $this->_dirtyFields['import_speech_progress'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'external_audio_id',
      'contents' => $this->externalAudioId
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
      'name' => 'offset_ms',
      'contents' => (string) $this->offsetMs
    ];

    $parts[] = [
      'name' => 'duration_ms',
      'contents' => (string) $this->durationMs
    ];

    $parts[] = [
      'name' => 'start_time_ms',
      'contents' => (string) $this->startTimeMs
    ];

    $parts[] = [
      'name' => 'end_time_ms',
      'contents' => (string) $this->endTimeMs
    ];

    $parts[] = [
      'name' => 'order',
      'contents' => $this->order
    ];

    $parts[] = [
      'name' => 'track_id',
      'contents' => $this->trackId
    ];

    $parts[] = [
      'name' => 'created_at_ms',
      'contents' => (string) $this->createdAtMs
    ];

    $parts[] = [
      'name' => 'updated_at_ms',
      'contents' => (string) $this->updatedAtMs
    ];

    if ($this->volumeGainDb !== null) {
      $parts[] = [
        'name' => 'volume_gain_db',
        'contents' => (string) $this->volumeGainDb
      ];
    }

    if ($this->muted !== null) {
      $parts[] = [
        'name' => 'muted',
        'contents' => $this->muted ? 'true' : 'false'
      ];
    }

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

    if ($this->sourceExternalAudioId !== null) {
      $parts[] = [
        'name' => 'source_external_audio_id',
        'contents' => $this->sourceExternalAudioId
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

    if ($this->error !== null) {
      $parts[] = [
        'name' => 'error',
        'contents' => $this->error
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
    $this->pendingBlocksMetadata?->validate();
    $this->pendingExternalAudiosMetadata?->validate();
    $this->pendingTask?->validate();
    $this->analysis?->validate();
    $this->transcription?->validate();
  }
}
