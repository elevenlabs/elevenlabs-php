<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * The accepted re-dub: what it covers and what it cost.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class DubbingRegenerateResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var string[]
   * The segments this re-dub re-synthesizes: those with edits to apply.
   */
  #[JsonProperty('regenerated_segment_ids', required: true), ArrayType(['string'])]
  public array $regeneratedSegmentIds;

  /**
   * Seconds of audio this re-dub covers — the edited regions only, never the whole target. `charged_seconds` is the part of it that was billed.
   */
  #[JsonProperty('regenerated_seconds', required: true)]
  public float $regeneratedSeconds;

  /**
   * Seconds actually billed, after the free-regeneration allowance. Zero when the re-dub cost nothing — either the allowance covered all of it, or the project's included generation did.
   */
  #[JsonProperty('charged_seconds', required: true)]
  public float $chargedSeconds;

  /**
   * Free-regeneration seconds left for this language target after this re-dub. The allowance is the source's own duration.
   */
  #[JsonProperty('free_regeneration_seconds_remaining', required: true)]
  public float $freeRegenerationSecondsRemaining;

  /**
   * @param array{
   *   regeneratedSegmentIds: string[],
   *   regeneratedSeconds: float,
   *   chargedSeconds: float,
   *   freeRegenerationSecondsRemaining: float,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->regeneratedSegmentIds = $values['regeneratedSegmentIds'];
    $this->regeneratedSeconds = $values['regeneratedSeconds'];
    $this->chargedSeconds = $values['chargedSeconds'];
    $this->freeRegenerationSecondsRemaining = $values['freeRegenerationSecondsRemaining'];

    $this->_dirtyFields = [
      'regenerated_segment_ids' => true,
      'regenerated_seconds' => true,
      'charged_seconds' => true,
      'free_regeneration_seconds_remaining' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    foreach ($this->regeneratedSegmentIds as $item) {
      $parts[] = [
        'name' => 'regenerated_segment_ids',
        'contents' => $item
      ];
    }

    $parts[] = [
      'name' => 'regenerated_seconds',
      'contents' => (string) $this->regeneratedSeconds
    ];

    $parts[] = [
      'name' => 'charged_seconds',
      'contents' => (string) $this->chargedSeconds
    ];

    $parts[] = [
      'name' => 'free_regeneration_seconds_remaining',
      'contents' => (string) $this->freeRegenerationSecondsRemaining
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
