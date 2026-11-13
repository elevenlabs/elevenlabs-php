<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * A common model for workflow tool responses.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class WorkflowToolResponseModelInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\WorkflowToolResponseModelInputStepsItem[]|null
   */
  #[
    JsonProperty('steps'),
    ArrayType([\ElevenLabs\Types\WorkflowToolResponseModelInputStepsItem::class])
  ]
  public ?array $steps;

  /**
   * @param array{
   *   steps?: \ElevenLabs\Types\WorkflowToolResponseModelInputStepsItem[]|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->steps = $values['steps'] ?? null;

    if (array_key_exists('steps', $values)) {
      $this->_dirtyFields['steps'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->steps !== null) {
      $parts[] = [
        'name' => 'steps',
        'contents' => json_encode($this->steps),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
