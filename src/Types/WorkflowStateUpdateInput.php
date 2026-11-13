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
class WorkflowStateUpdateInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\WorkflowStateUpdateInputType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * Name of the dynamic variable to assign.
   */
  #[JsonProperty('variable_name', required: true)]
  public string $variableName;

  #[JsonProperty('expression', required: true)]
  public \ElevenLabs\Types\AstNodeInput $expression;

  /**
   * When false, the LLM may omit the values this update relies on. The update is then skipped and the variable keeps its current value.
   */
  #[JsonProperty('required')]
  public ?bool $required;

  /**
   * @param array{
   *   variableName: string,
   *   expression: \ElevenLabs\Types\AstNodeInput,
   *   type?: ?value-of<\ElevenLabs\Types\WorkflowStateUpdateInputType>,
   *   required?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'dynamic_variable';
    $this->variableName = $values['variableName'];
    $this->expression = $values['expression'];
    $this->required = $values['required'] ?? null;

    $this->_dirtyFields = [
      'variable_name' => true,
      'expression' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
    if (array_key_exists('required', $values)) {
      $this->_dirtyFields['required'] = true;
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
      'name' => 'variable_name',
      'contents' => $this->variableName
    ];

    $parts[] = [
      'name' => 'expression',
      'contents' => json_encode($this->expression),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->required !== null) {
      $parts[] = [
        'name' => 'required',
        'contents' => $this->required ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
