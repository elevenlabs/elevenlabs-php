<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class DynamicVariableSchemaOverride extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\DynamicVariableSchemaOverrideSource>
   */
  #[JsonProperty('source')]
  public ?string $source;

  /**
   * The name of the dynamic variable to use
   */
  #[JsonProperty('dynamic_variable', required: true)]
  public string $dynamicVariable;

  /**
   * @param array{
   *   dynamicVariable: string,
   *   source?: ?value-of<\ElevenLabs\Types\DynamicVariableSchemaOverrideSource>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->source = $values['source'] ?? 'dynamic_variable';
    $this->dynamicVariable = $values['dynamicVariable'];

    $this->_dirtyFields = [
      'dynamic_variable' => true
    ];
    if (array_key_exists('source', $values)) {
      $this->_dirtyFields['source'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->source !== null) {
      $parts[] = [
        'name' => 'source',
        'contents' => $this->source
      ];
    }

    $parts[] = [
      'name' => 'dynamic_variable',
      'contents' => $this->dynamicVariable
    ];

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->dynamicVariable, 'dynamic_variable', minLength: 1);
  }
}
