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
class GuardrailLlmVerdict extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\GuardrailLlmVerdictType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * The LLM's explanation for its decision.
   */
  #[JsonProperty('rationale', required: true)]
  public string $rationale;

  /**
   * @param array{
   *   rationale: string,
   *   type?: ?value-of<\ElevenLabs\Types\GuardrailLlmVerdictType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'llm';
    $this->rationale = $values['rationale'];

    $this->_dirtyFields = [
      'rationale' => true
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
      'name' => 'rationale',
      'contents' => $this->rationale
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
