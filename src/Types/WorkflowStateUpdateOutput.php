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
class WorkflowStateUpdateOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\WorkflowStateUpdateOutputType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  /**
   * Name of the dynamic variable to assign.
   */
  #[JsonProperty('variable_name', required: true)]
  public string $variableName;

  #[JsonProperty('expression', required: true)]
  public \ElevenLabs\Types\AstNodeOutput $expression;

  /**
   * When false, the LLM may omit the values this update relies on. The update is then skipped and the variable keeps its current value.
   */
  #[JsonProperty('required', required: true)]
  public bool $required;

  /**
   * @param array{
   *   type: value-of<\ElevenLabs\Types\WorkflowStateUpdateOutputType>,
   *   variableName: string,
   *   expression: \ElevenLabs\Types\AstNodeOutput,
   *   required: bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];
    $this->variableName = $values['variableName'];
    $this->expression = $values['expression'];
    $this->required = $values['required'];

    $this->_dirtyFields = [
      'type' => true,
      'variable_name' => true,
      'expression' => true,
      'required' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
    ];

    $parts[] = [
      'name' => 'variable_name',
      'contents' => $this->variableName
    ];

    $parts[] = [
      'name' => 'expression',
      'contents' => json_encode($this->expression),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'required',
      'contents' => $this->required ? 'true' : 'false'
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
