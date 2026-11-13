<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * Custom hold audio played on loop to callers waiting in the agent's queue.
 *
 * Set by uploading a file through the agent hold-audio endpoint. Values sent in
 * agent create or update requests are ignored.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class AgentHoldAudioConfig extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Storage path of the uploaded clip
   */
  #[JsonProperty('audio_path', required: true)]
  public string $audioPath;

  /**
   * Public CDN URL of the uploaded clip
   */
  #[JsonProperty('audio_url', required: true)]
  public string $audioUrl;

  /**
   * Filename of the uploaded clip as provided by the user
   */
  #[JsonProperty('original_filename', required: true)]
  public string $originalFilename;

  /**
   * Duration of the uploaded clip in seconds
   */
  #[JsonProperty('duration_secs', required: true)]
  public float $durationSecs;

  /**
   * Size of the uploaded clip in bytes
   */
  #[JsonProperty('size_bytes', required: true)]
  public int $sizeBytes;

  /**
   * @param array{
   *   audioPath: string,
   *   audioUrl: string,
   *   originalFilename: string,
   *   durationSecs: float,
   *   sizeBytes: int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->audioPath = $values['audioPath'];
    $this->audioUrl = $values['audioUrl'];
    $this->originalFilename = $values['originalFilename'];
    $this->durationSecs = $values['durationSecs'];
    $this->sizeBytes = $values['sizeBytes'];

    $this->_dirtyFields = [
      'audio_path' => true,
      'audio_url' => true,
      'original_filename' => true,
      'duration_secs' => true,
      'size_bytes' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'audio_path',
      'contents' => $this->audioPath
    ];

    $parts[] = [
      'name' => 'audio_url',
      'contents' => $this->audioUrl
    ];

    $parts[] = [
      'name' => 'original_filename',
      'contents' => $this->originalFilename
    ];

    $parts[] = [
      'name' => 'duration_secs',
      'contents' => (string) $this->durationSecs
    ];

    $parts[] = [
      'name' => 'size_bytes',
      'contents' => (string) $this->sizeBytes
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
