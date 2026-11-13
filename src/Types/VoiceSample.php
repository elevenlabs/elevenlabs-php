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
class VoiceSample extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The ID of the sample.
   */
  #[JsonProperty('sample_id')]
  public ?string $sampleId;

  /**
   * The name of the sample file.
   */
  #[JsonProperty('file_name')]
  public ?string $fileName;

  /**
   * The MIME type of the sample file.
   */
  #[JsonProperty('mime_type')]
  public ?string $mimeType;

  /**
   * The size of the sample file in bytes.
   */
  #[JsonProperty('size_bytes')]
  public ?int $sizeBytes;

  /**
   * The hash of the sample file.
   */
  #[JsonProperty('hash')]
  public ?string $hash;

  #[JsonProperty('duration_secs')]
  public ?float $durationSecs;

  #[JsonProperty('remove_background_noise')]
  public ?bool $removeBackgroundNoise;

  #[JsonProperty('has_isolated_audio')]
  public ?bool $hasIsolatedAudio;

  #[JsonProperty('has_isolated_audio_preview')]
  public ?bool $hasIsolatedAudioPreview;

  #[JsonProperty('speaker_separation')]
  public ?\ElevenLabs\Types\SpeakerSeparationResponseModel $speakerSeparation;

  #[JsonProperty('trim_start')]
  public ?int $trimStart;

  #[JsonProperty('trim_end')]
  public ?int $trimEnd;

  /**
   * @param array{
   *   sampleId?: ?string,
   *   fileName?: ?string,
   *   mimeType?: ?string,
   *   sizeBytes?: ?int,
   *   hash?: ?string,
   *   durationSecs?: ?float,
   *   removeBackgroundNoise?: ?bool,
   *   hasIsolatedAudio?: ?bool,
   *   hasIsolatedAudioPreview?: ?bool,
   *   speakerSeparation?: ?\ElevenLabs\Types\SpeakerSeparationResponseModel,
   *   trimStart?: ?int,
   *   trimEnd?: ?int,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->sampleId = $values['sampleId'] ?? null;
    $this->fileName = $values['fileName'] ?? null;
    $this->mimeType = $values['mimeType'] ?? null;
    $this->sizeBytes = $values['sizeBytes'] ?? null;
    $this->hash = $values['hash'] ?? null;
    $this->durationSecs = $values['durationSecs'] ?? null;
    $this->removeBackgroundNoise = $values['removeBackgroundNoise'] ?? null;
    $this->hasIsolatedAudio = $values['hasIsolatedAudio'] ?? null;
    $this->hasIsolatedAudioPreview = $values['hasIsolatedAudioPreview'] ?? null;
    $this->speakerSeparation = $values['speakerSeparation'] ?? null;
    $this->trimStart = $values['trimStart'] ?? null;
    $this->trimEnd = $values['trimEnd'] ?? null;

    if (array_key_exists('sampleId', $values)) {
      $this->_dirtyFields['sample_id'] = true;
    }
    if (array_key_exists('fileName', $values)) {
      $this->_dirtyFields['file_name'] = true;
    }
    if (array_key_exists('mimeType', $values)) {
      $this->_dirtyFields['mime_type'] = true;
    }
    if (array_key_exists('sizeBytes', $values)) {
      $this->_dirtyFields['size_bytes'] = true;
    }
    if (array_key_exists('hash', $values)) {
      $this->_dirtyFields['hash'] = true;
    }
    if (array_key_exists('durationSecs', $values)) {
      $this->_dirtyFields['duration_secs'] = true;
    }
    if (array_key_exists('removeBackgroundNoise', $values)) {
      $this->_dirtyFields['remove_background_noise'] = true;
    }
    if (array_key_exists('hasIsolatedAudio', $values)) {
      $this->_dirtyFields['has_isolated_audio'] = true;
    }
    if (array_key_exists('hasIsolatedAudioPreview', $values)) {
      $this->_dirtyFields['has_isolated_audio_preview'] = true;
    }
    if (array_key_exists('speakerSeparation', $values)) {
      $this->_dirtyFields['speaker_separation'] = true;
    }
    if (array_key_exists('trimStart', $values)) {
      $this->_dirtyFields['trim_start'] = true;
    }
    if (array_key_exists('trimEnd', $values)) {
      $this->_dirtyFields['trim_end'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->sampleId !== null) {
      $parts[] = [
        'name' => 'sample_id',
        'contents' => $this->sampleId
      ];
    }

    if ($this->fileName !== null) {
      $parts[] = [
        'name' => 'file_name',
        'contents' => $this->fileName
      ];
    }

    if ($this->mimeType !== null) {
      $parts[] = [
        'name' => 'mime_type',
        'contents' => $this->mimeType
      ];
    }

    if ($this->sizeBytes !== null) {
      $parts[] = [
        'name' => 'size_bytes',
        'contents' => (string) $this->sizeBytes
      ];
    }

    if ($this->hash !== null) {
      $parts[] = [
        'name' => 'hash',
        'contents' => $this->hash
      ];
    }

    if ($this->durationSecs !== null) {
      $parts[] = [
        'name' => 'duration_secs',
        'contents' => (string) $this->durationSecs
      ];
    }

    if ($this->removeBackgroundNoise !== null) {
      $parts[] = [
        'name' => 'remove_background_noise',
        'contents' => $this->removeBackgroundNoise ? 'true' : 'false'
      ];
    }

    if ($this->hasIsolatedAudio !== null) {
      $parts[] = [
        'name' => 'has_isolated_audio',
        'contents' => $this->hasIsolatedAudio ? 'true' : 'false'
      ];
    }

    if ($this->hasIsolatedAudioPreview !== null) {
      $parts[] = [
        'name' => 'has_isolated_audio_preview',
        'contents' => $this->hasIsolatedAudioPreview ? 'true' : 'false'
      ];
    }

    if ($this->speakerSeparation !== null) {
      $parts[] = [
        'name' => 'speaker_separation',
        'contents' => json_encode($this->speakerSeparation),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->trimStart !== null) {
      $parts[] = [
        'name' => 'trim_start',
        'contents' => (string) $this->trimStart
      ];
    }

    if ($this->trimEnd !== null) {
      $parts[] = [
        'name' => 'trim_end',
        'contents' => (string) $this->trimEnd
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->speakerSeparation?->validate();
  }
}
