<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * Metadata about the project's source media.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class DubbingSourceMediaInfo extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Original filename of the uploaded source media (null for URL sources).
   */
  #[JsonProperty('filename')]
  public ?string $filename;

  /**
   * Duration of the source media, in seconds.
   */
  #[JsonProperty('duration_s')]
  public ?float $durationS;

  /**
   * Whether the source media contains a video stream.
   */
  #[JsonProperty('has_video')]
  public ?bool $hasVideo;

  /**
   * MIME type of the uploaded source media (null for URL sources).
   */
  #[JsonProperty('mime_type')]
  public ?string $mimeType;

  /**
   * @param array{
   *   filename?: ?string,
   *   durationS?: ?float,
   *   hasVideo?: ?bool,
   *   mimeType?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->filename = $values['filename'] ?? null;
    $this->durationS = $values['durationS'] ?? null;
    $this->hasVideo = $values['hasVideo'] ?? null;
    $this->mimeType = $values['mimeType'] ?? null;

    if (array_key_exists('filename', $values)) {
      $this->_dirtyFields['filename'] = true;
    }
    if (array_key_exists('durationS', $values)) {
      $this->_dirtyFields['duration_s'] = true;
    }
    if (array_key_exists('hasVideo', $values)) {
      $this->_dirtyFields['has_video'] = true;
    }
    if (array_key_exists('mimeType', $values)) {
      $this->_dirtyFields['mime_type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->filename !== null) {
      $parts[] = [
        'name' => 'filename',
        'contents' => $this->filename
      ];
    }

    if ($this->durationS !== null) {
      $parts[] = [
        'name' => 'duration_s',
        'contents' => (string) $this->durationS
      ];
    }

    if ($this->hasVideo !== null) {
      $parts[] = [
        'name' => 'has_video',
        'contents' => $this->hasVideo ? 'true' : 'false'
      ];
    }

    if ($this->mimeType !== null) {
      $parts[] = [
        'name' => 'mime_type',
        'contents' => $this->mimeType
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
