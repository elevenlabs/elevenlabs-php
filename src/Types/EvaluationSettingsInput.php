<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * Settings to evaluate an agent's performance.
 * Agents are evaluated against a set of criteria, with success being defined as meeting some combination of those criteria.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class EvaluationSettingsInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\PromptEvaluationCriteria[]|null
   * Individual criteria that the agent should be evaluated against. Each criterion is stored as an analysis item attached to the agent (see analysis_items).
   */
  #[JsonProperty('criteria'), ArrayType([\ElevenLabs\Types\PromptEvaluationCriteria::class])]
  public ?array $criteria;

  /**
   * @param array{
   *   criteria?: \ElevenLabs\Types\PromptEvaluationCriteria[]|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->criteria = $values['criteria'] ?? null;

    if (array_key_exists('criteria', $values)) {
      $this->_dirtyFields['criteria'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->criteria !== null) {
      $parts[] = [
        'name' => 'criteria',
        'contents' => json_encode($this->criteria),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->criteria ?? [] as $item) {
      $item->validate();
    }
  }
}
