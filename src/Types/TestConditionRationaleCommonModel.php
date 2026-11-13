<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * Structured rationale for test condition results containing individual failure/success reasons.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class TestConditionRationaleCommonModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var string[]|null
   * List of individual parameter evaluation messages or reasons
   */
  #[JsonProperty('messages'), ArrayType(['string'])]
  public ?array $messages;

  /**
   * High-level summary of the evaluation result
   */
  #[JsonProperty('summary')]
  public ?string $summary;

  /**
   * @param array{
   *   messages?: string[]|null,
   *   summary?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->messages = $values['messages'] ?? null;
    $this->summary = $values['summary'] ?? null;

    if (array_key_exists('messages', $values)) {
      $this->_dirtyFields['messages'] = true;
    }
    if (array_key_exists('summary', $values)) {
      $this->_dirtyFields['summary'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->messages !== null) {
      foreach ($this->messages ?? [] as $item) {
        $parts[] = [
          'name' => 'messages',
          'contents' => $item
        ];
      }
    }

    if ($this->summary !== null) {
      $parts[] = [
        'name' => 'summary',
        'contents' => $this->summary
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
