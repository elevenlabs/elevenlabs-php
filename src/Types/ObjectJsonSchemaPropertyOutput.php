<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Core\Types\Union;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ObjectJsonSchemaPropertyOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('description')]
  public ?string $description;

  /**
   * When set, the entire parameter is populated from this dynamic variable at runtime. Mutually exclusive with description (LLM-provided value), constant_value, and is_omitted.
   */
  #[JsonProperty('dynamic_variable')]
  public ?string $dynamicVariable;

  /**
   * @var array<string, mixed>|null
   * When set, the entire object uses this constant JSON value at runtime. Mutually exclusive with description (LLM-provided object), dynamic_variable, and is_omitted.
   */
  #[JsonProperty('constant_value'), ArrayType(['string' => 'mixed'])]
  public ?array $constantValue;

  /**
   * If true, this parameter will be completely omitted from the request. Only valid for optional parameters. Mutually exclusive with description, dynamic_variable, and constant_value.
   */
  #[JsonProperty('is_omitted')]
  public ?bool $isOmitted;

  /**
   * @var ?value-of<\ElevenLabs\Types\ObjectJsonSchemaPropertyOutputType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * @var string[]|null
   */
  #[JsonProperty('required'), ArrayType(['string'])]
  public ?array $required;

  /**
   * @var array<string, \ElevenLabs\Types\LiteralJsonSchemaProperty|\ElevenLabs\Types\ObjectJsonSchemaPropertyOutput|\ElevenLabs\Types\ArrayJsonSchemaPropertyOutput>|null
   */
  #[
    JsonProperty('properties'),
    ArrayType([
      'string' => new Union(
        \ElevenLabs\Types\LiteralJsonSchemaProperty::class,
        \ElevenLabs\Types\ObjectJsonSchemaPropertyOutput::class,
        \ElevenLabs\Types\ArrayJsonSchemaPropertyOutput::class
      )
    ])
  ]
  public ?array $properties;

  #[JsonProperty('required_constraints')]
  public ?\ElevenLabs\Types\RequiredConstraints $requiredConstraints;

  /**
   * @param array{
   *   description?: ?string,
   *   dynamicVariable?: ?string,
   *   constantValue?: array<string, mixed>|null,
   *   isOmitted?: ?bool,
   *   type?: ?value-of<\ElevenLabs\Types\ObjectJsonSchemaPropertyOutputType>,
   *   required?: string[]|null,
   *   properties?: array<string, \ElevenLabs\Types\LiteralJsonSchemaProperty|\ElevenLabs\Types\ObjectJsonSchemaPropertyOutput|\ElevenLabs\Types\ArrayJsonSchemaPropertyOutput>|null,
   *   requiredConstraints?: ?\ElevenLabs\Types\RequiredConstraints,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->description = $values['description'] ?? null;
    $this->dynamicVariable = $values['dynamicVariable'] ?? null;
    $this->constantValue = $values['constantValue'] ?? null;
    $this->isOmitted = $values['isOmitted'] ?? null;
    $this->type = $values['type'] ?? 'object';
    $this->required = $values['required'] ?? null;
    $this->properties = $values['properties'] ?? null;
    $this->requiredConstraints = $values['requiredConstraints'] ?? null;

    if (array_key_exists('description', $values)) {
      $this->_dirtyFields['description'] = true;
    }
    if (array_key_exists('dynamicVariable', $values)) {
      $this->_dirtyFields['dynamic_variable'] = true;
    }
    if (array_key_exists('constantValue', $values)) {
      $this->_dirtyFields['constant_value'] = true;
    }
    if (array_key_exists('isOmitted', $values)) {
      $this->_dirtyFields['is_omitted'] = true;
    }
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
    if (array_key_exists('required', $values)) {
      $this->_dirtyFields['required'] = true;
    }
    if (array_key_exists('properties', $values)) {
      $this->_dirtyFields['properties'] = true;
    }
    if (array_key_exists('requiredConstraints', $values)) {
      $this->_dirtyFields['required_constraints'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->description !== null) {
      $parts[] = [
        'name' => 'description',
        'contents' => $this->description
      ];
    }

    if ($this->dynamicVariable !== null) {
      $parts[] = [
        'name' => 'dynamic_variable',
        'contents' => $this->dynamicVariable
      ];
    }

    if ($this->constantValue !== null) {
      $parts[] = [
        'name' => 'constant_value',
        'contents' => json_encode($this->constantValue),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->isOmitted !== null) {
      $parts[] = [
        'name' => 'is_omitted',
        'contents' => $this->isOmitted ? 'true' : 'false'
      ];
    }

    if ($this->type !== null) {
      $parts[] = [
        'name' => 'type',
        'contents' => $this->type
      ];
    }

    if ($this->required !== null) {
      foreach ($this->required ?? [] as $item) {
        $parts[] = [
          'name' => 'required',
          'contents' => $item
        ];
      }
    }

    if ($this->properties !== null) {
      $parts[] = [
        'name' => 'properties',
        'contents' => json_encode($this->properties),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->requiredConstraints !== null) {
      $parts[] = [
        'name' => 'required_constraints',
        'contents' => json_encode($this->requiredConstraints),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->requiredConstraints?->validate();
  }
}
