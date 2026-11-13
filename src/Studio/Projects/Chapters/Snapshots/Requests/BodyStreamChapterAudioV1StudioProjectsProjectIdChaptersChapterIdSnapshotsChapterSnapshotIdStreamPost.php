<?php

declare(strict_types=1);

namespace ElevenLabs\Studio\Projects\Chapters\Snapshots\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyStreamChapterAudioV1StudioProjectsProjectIdChaptersChapterIdSnapshotsChapterSnapshotIdStreamPost
  extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Whether to convert the audio to mpeg format.
   */
  #[JsonProperty('convert_to_mpeg')]
  public ?bool $convertToMpeg;

  /**
   * @param array{
   *   convertToMpeg?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->convertToMpeg = $values['convertToMpeg'] ?? null;

    if (array_key_exists('convertToMpeg', $values)) {
      $this->_dirtyFields['convert_to_mpeg'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->convertToMpeg !== null) {
      $parts[] = [
        'name' => 'convert_to_mpeg',
        'contents' => $this->convertToMpeg ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
