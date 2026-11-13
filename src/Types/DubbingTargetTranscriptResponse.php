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
class DubbingTargetTranscriptResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * BCP-47 language tag of the source transcript.
   */
  #[JsonProperty('source_language')]
  public ?string $sourceLanguage;

  /**
   * BCP-47 language tag this target is translated into.
   */
  #[JsonProperty('target_language', required: true)]
  public string $targetLanguage;

  /**
   * @var \ElevenLabs\Types\DubbingTargetTranscriptSegment[]
   * The target segments, in playback order.
   */
  #[
    JsonProperty('segments', required: true),
    ArrayType([\ElevenLabs\Types\DubbingTargetTranscriptSegment::class])
  ]
  public array $segments;

  /**
   * The target's revision at read time.
   */
  #[JsonProperty('revision', required: true)]
  public int $revision;

  /**
   * @param array{
   *   targetLanguage: string,
   *   segments: \ElevenLabs\Types\DubbingTargetTranscriptSegment[],
   *   revision: int,
   *   sourceLanguage?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->sourceLanguage = $values['sourceLanguage'] ?? null;
    $this->targetLanguage = $values['targetLanguage'];
    $this->segments = $values['segments'];
    $this->revision = $values['revision'];

    $this->_dirtyFields = [
      'target_language' => true,
      'segments' => true,
      'revision' => true
    ];
    if (array_key_exists('sourceLanguage', $values)) {
      $this->_dirtyFields['source_language'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->sourceLanguage !== null) {
      $parts[] = [
        'name' => 'source_language',
        'contents' => $this->sourceLanguage
      ];
    }

    $parts[] = [
      'name' => 'target_language',
      'contents' => $this->targetLanguage
    ];

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
