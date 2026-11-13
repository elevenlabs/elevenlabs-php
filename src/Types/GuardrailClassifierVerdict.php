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
class GuardrailClassifierVerdict extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\GuardrailClassifierVerdictType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * Classifier score for the triggered category, from 0 to 1.
   */
  #[JsonProperty('score', required: true)]
  public float $score;

  /**
   * Score at or above which the guardrail triggers.
   */
  #[JsonProperty('threshold', required: true)]
  public float $threshold;

  /**
   * @param array{
   *   score: float,
   *   threshold: float,
   *   type?: ?value-of<\ElevenLabs\Types\GuardrailClassifierVerdictType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'classifier';
    $this->score = $values['score'];
    $this->threshold = $values['threshold'];

    $this->_dirtyFields = [
      'score' => true,
      'threshold' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->type !== null) {
      $parts[] = [
        'name' => 'type',
        'contents' => $this->type
      ];
    }

    $parts[] = [
      'name' => 'score',
      'contents' => (string) $this->score
    ];

    $parts[] = [
      'name' => 'threshold',
      'contents' => (string) $this->threshold
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
