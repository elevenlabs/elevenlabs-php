<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * Safety object that has the information of safety evaluations based on used voice.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class SafetyCommonModelOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Safety evaluation of the agent. Prompt and first message is taken into account.
   * The unsafe reason is provided from the evaluation
   */
  #[JsonProperty('ivc')]
  public ?\ElevenLabs\Types\SafetyEvaluation $ivc;

  /**
   * Safety evaluation of the agent. Prompt and first message is taken into account.
   * The unsafe reason is provided from the evaluation
   */
  #[JsonProperty('non_ivc')]
  public ?\ElevenLabs\Types\SafetyEvaluation $nonIvc;

  /**
   * @param array{
   *   ivc?: ?\ElevenLabs\Types\SafetyEvaluation,
   *   nonIvc?: ?\ElevenLabs\Types\SafetyEvaluation,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->ivc = $values['ivc'] ?? null;
    $this->nonIvc = $values['nonIvc'] ?? null;

    if (array_key_exists('ivc', $values)) {
      $this->_dirtyFields['ivc'] = true;
    }
    if (array_key_exists('nonIvc', $values)) {
      $this->_dirtyFields['non_ivc'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->ivc !== null) {
      $parts[] = [
        'name' => 'ivc',
        'contents' => json_encode($this->ivc),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->nonIvc !== null) {
      $parts[] = [
        'name' => 'non_ivc',
        'contents' => json_encode($this->nonIvc),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->ivc?->validate();
    $this->nonIvc?->validate();
  }
}
