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
class ConversationDeletionSettings extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('deletion_time_unix_secs')]
  public ?int $deletionTimeUnixSecs;

  #[JsonProperty('deleted_logs_at_time_unix_secs')]
  public ?int $deletedLogsAtTimeUnixSecs;

  #[JsonProperty('deleted_audio_at_time_unix_secs')]
  public ?int $deletedAudioAtTimeUnixSecs;

  #[JsonProperty('deleted_transcript_at_time_unix_secs')]
  public ?int $deletedTranscriptAtTimeUnixSecs;

  #[JsonProperty('delete_transcript_and_pii')]
  public ?bool $deleteTranscriptAndPii;

  #[JsonProperty('delete_audio')]
  public ?bool $deleteAudio;

  /**
   * @param array{
   *   deletionTimeUnixSecs?: ?int,
   *   deletedLogsAtTimeUnixSecs?: ?int,
   *   deletedAudioAtTimeUnixSecs?: ?int,
   *   deletedTranscriptAtTimeUnixSecs?: ?int,
   *   deleteTranscriptAndPii?: ?bool,
   *   deleteAudio?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->deletionTimeUnixSecs = $values['deletionTimeUnixSecs'] ?? null;
    $this->deletedLogsAtTimeUnixSecs = $values['deletedLogsAtTimeUnixSecs'] ?? null;
    $this->deletedAudioAtTimeUnixSecs = $values['deletedAudioAtTimeUnixSecs'] ?? null;
    $this->deletedTranscriptAtTimeUnixSecs = $values['deletedTranscriptAtTimeUnixSecs'] ?? null;
    $this->deleteTranscriptAndPii = $values['deleteTranscriptAndPii'] ?? null;
    $this->deleteAudio = $values['deleteAudio'] ?? null;

    if (array_key_exists('deletionTimeUnixSecs', $values)) {
      $this->_dirtyFields['deletion_time_unix_secs'] = true;
    }
    if (array_key_exists('deletedLogsAtTimeUnixSecs', $values)) {
      $this->_dirtyFields['deleted_logs_at_time_unix_secs'] = true;
    }
    if (array_key_exists('deletedAudioAtTimeUnixSecs', $values)) {
      $this->_dirtyFields['deleted_audio_at_time_unix_secs'] = true;
    }
    if (array_key_exists('deletedTranscriptAtTimeUnixSecs', $values)) {
      $this->_dirtyFields['deleted_transcript_at_time_unix_secs'] = true;
    }
    if (array_key_exists('deleteTranscriptAndPii', $values)) {
      $this->_dirtyFields['delete_transcript_and_pii'] = true;
    }
    if (array_key_exists('deleteAudio', $values)) {
      $this->_dirtyFields['delete_audio'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->deletionTimeUnixSecs !== null) {
      $parts[] = [
        'name' => 'deletion_time_unix_secs',
        'contents' => (string) $this->deletionTimeUnixSecs
      ];
    }

    if ($this->deletedLogsAtTimeUnixSecs !== null) {
      $parts[] = [
        'name' => 'deleted_logs_at_time_unix_secs',
        'contents' => (string) $this->deletedLogsAtTimeUnixSecs
      ];
    }

    if ($this->deletedAudioAtTimeUnixSecs !== null) {
      $parts[] = [
        'name' => 'deleted_audio_at_time_unix_secs',
        'contents' => (string) $this->deletedAudioAtTimeUnixSecs
      ];
    }

    if ($this->deletedTranscriptAtTimeUnixSecs !== null) {
      $parts[] = [
        'name' => 'deleted_transcript_at_time_unix_secs',
        'contents' => (string) $this->deletedTranscriptAtTimeUnixSecs
      ];
    }

    if ($this->deleteTranscriptAndPii !== null) {
      $parts[] = [
        'name' => 'delete_transcript_and_pii',
        'contents' => $this->deleteTranscriptAndPii ? 'true' : 'false'
      ];
    }

    if ($this->deleteAudio !== null) {
      $parts[] = [
        'name' => 'delete_audio',
        'contents' => $this->deleteAudio ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
