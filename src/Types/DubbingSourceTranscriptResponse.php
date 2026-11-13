<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class DubbingSourceTranscriptResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * BCP-47 language tag of the source transcript (null if unknown).
   */
  #[JsonProperty('language')]
  public ?string $language;

  /**
   * @var \ElevenLabs\Types\DubbingTranscriptSegment[]
   * The source segments, in playback order.
   */
  #[
    JsonProperty('segments', required: true),
    ArrayType([\ElevenLabs\Types\DubbingTranscriptSegment::class])
  ]
  public array $segments;

  /**
   * The project's source-transcript revision at read time.
   */
  #[JsonProperty('revision', required: true)]
  public int $revision;

  /**
   * @param array{
   *   segments: \ElevenLabs\Types\DubbingTranscriptSegment[],
   *   revision: int,
   *   language?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->language = $values['language'] ?? null;
    $this->segments = $values['segments'];
    $this->revision = $values['revision'];

    $this->_dirtyFields = [
      'segments' => true,
      'revision' => true
    ];
    if (array_key_exists('language', $values)) {
      $this->_dirtyFields['language'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->language !== null) {
      $parts[] = [
        'name' => 'language',
        'contents' => $this->language
      ];
    }

    $parts[] = [
      'name' => 'segments',
      'contents' => json_encode($this->segments),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'revision',
      'contents' => (string) $this->revision
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->segments as $item) {
      $item->validate();
    }
  }
}
