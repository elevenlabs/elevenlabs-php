<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * Signed, time-limited download URLs for a language target's outputs.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class DubbingLanguageOutputs extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Signed URL for the dubbed lossless audio track, in FLAC. The link expires one hour after it is issued; re-read the language target for a fresh one.
   */
  #[JsonProperty('lossless_audio')]
  public ?string $losslessAudio;

  /**
   * Signed URL for the translated lines as WebVTT subtitles, timed to the source speech. Null when none are available, such as for languages dubbed before subtitles were produced. The link expires one hour after it is issued.
   */
  #[JsonProperty('subtitles')]
  public ?string $subtitles;

  /**
   * @param array{
   *   losslessAudio?: ?string,
   *   subtitles?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->losslessAudio = $values['losslessAudio'] ?? null;
    $this->subtitles = $values['subtitles'] ?? null;

    if (array_key_exists('losslessAudio', $values)) {
      $this->_dirtyFields['lossless_audio'] = true;
    }
    if (array_key_exists('subtitles', $values)) {
      $this->_dirtyFields['subtitles'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->losslessAudio !== null) {
      $parts[] = [
        'name' => 'lossless_audio',
        'contents' => $this->losslessAudio
      ];
    }

    if ($this->subtitles !== null) {
      $parts[] = [
        'name' => 'subtitles',
        'contents' => $this->subtitles
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
