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
class TestConditionResultCommonModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\EvaluationSuccessResult>
   */
  #[JsonProperty('result', required: true)]
  public string $result;

  #[JsonProperty('rationale')]
  public ?\ElevenLabs\Types\TestConditionRationaleCommonModel $rationale;

  /**
   * @param array{
   *   result: value-of<\ElevenLabs\Types\EvaluationSuccessResult>,
   *   rationale?: ?\ElevenLabs\Types\TestConditionRationaleCommonModel,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->result = $values['result'];
    $this->rationale = $values['rationale'] ?? null;

    $this->_dirtyFields = [
      'result' => true
    ];
    if (array_key_exists('rationale', $values)) {
      $this->_dirtyFields['rationale'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'result',
      'contents' => $this->result
    ];

    if ($this->rationale !== null) {
      $parts[] = [
        'name' => 'rationale',
        'contents' => json_encode($this->rationale),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->rationale?->validate();
  }
}
