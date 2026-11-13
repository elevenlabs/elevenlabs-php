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
class NumericUniformScoring extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\NumericUniformScoringMode>
   */
  #[JsonProperty('mode')]
  public ?string $mode;

  #[JsonProperty('max_score', required: true)]
  public int $maxScore;

  #[JsonProperty('instructions')]
  public ?string $instructions;

  /**
   * @param array{
   *   maxScore: int,
   *   mode?: ?value-of<\ElevenLabs\Types\NumericUniformScoringMode>,
   *   instructions?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->mode = $values['mode'] ?? 'numeric_uniform';
    $this->maxScore = $values['maxScore'];
    $this->instructions = $values['instructions'] ?? null;

    $this->_dirtyFields = [
      'max_score' => true
    ];
    if (array_key_exists('mode', $values)) {
      $this->_dirtyFields['mode'] = true;
    }
    if (array_key_exists('instructions', $values)) {
      $this->_dirtyFields['instructions'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->mode !== null) {
      $parts[] = [
        'name' => 'mode',
        'contents' => $this->mode
      ];
    }

    $parts[] = [
      'name' => 'max_score',
      'contents' => (string) $this->maxScore
    ];

    if ($this->instructions !== null) {
      $parts[] = [
        'name' => 'instructions',
        'contents' => $this->instructions
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
