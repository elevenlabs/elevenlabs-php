<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * One segment of a target transcript: a source segment plus its translation.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class DubbingTargetTranscriptSegment extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Stable identifier of the segment (from the source).
   */
  #[JsonProperty('id', required: true)]
  public string $id;

  /**
   * Identifier of the segment's speaker.
   */
  #[JsonProperty('speaker_id', required: true)]
  public string $speakerId;

  /**
   * Start time of the segment, in seconds.
   */
  #[JsonProperty('start_s', required: true)]
  public float $startS;

  /**
   * End time of the segment, in seconds.
   */
  #[JsonProperty('end_s', required: true)]
  public float $endS;

  /**
   * The source-language text of the segment.
   */
  #[JsonProperty('source_text', required: true)]
  public string $sourceText;

  /**
   * The translated text, or null if not translated yet (needs translation).
   */
  #[JsonProperty('translation')]
  public ?string $translation;

  /**
   * @param array{
   *   id: string,
   *   speakerId: string,
   *   startS: float,
   *   endS: float,
   *   sourceText: string,
   *   translation?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->id = $values['id'];
    $this->speakerId = $values['speakerId'];
    $this->startS = $values['startS'];
    $this->endS = $values['endS'];
    $this->sourceText = $values['sourceText'];
    $this->translation = $values['translation'] ?? null;

    $this->_dirtyFields = [
      'id' => true,
      'speaker_id' => true,
      'start_s' => true,
      'end_s' => true,
      'source_text' => true
    ];
    if (array_key_exists('translation', $values)) {
      $this->_dirtyFields['translation'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'id',
      'contents' => $this->id
    ];

    $parts[] = [
      'name' => 'speaker_id',
      'contents' => $this->speakerId
    ];

    $parts[] = [
      'name' => 'start_s',
      'contents' => (string) $this->startS
    ];

    $parts[] = [
      'name' => 'end_s',
      'contents' => (string) $this->endS
    ];

    $parts[] = [
      'name' => 'source_text',
      'contents' => $this->sourceText
    ];

    if ($this->translation !== null) {
      $parts[] = [
        'name' => 'translation',
        'contents' => $this->translation
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
