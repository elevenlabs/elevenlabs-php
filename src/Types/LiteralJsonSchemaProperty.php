<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Core\Types\Union;

/**
 * Schema property for literal JSON types. IMPORTANT: Only ONE of the following fields can be set: description (LLM provides value), dynamic_variable (value from variable), is_system_provided (system provides value), constant_value (fixed value), or is_omitted (parameter is omitted). These are mutually exclusive.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class LiteralJsonSchemaProperty extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('type', required: true), Union('string', ['string'])]
  public string|array $type;

  /**
   * The description of the property. When set, the LLM will provide the value based on this description. Mutually exclusive with dynamic_variable, is_system_provided, constant_value, and is_omitted.
   */
  #[JsonProperty('description')]
  public ?string $description;

  /**
   * @var string[]|null
   * List of allowed string values for string type parameters
   */
  #[JsonProperty('enum'), ArrayType(['string'])]
  public ?array $enum;

  /**
   * If true, the value will be populated by the system at runtime. Used by API Integration Webhook tools for templating. Mutually exclusive with description, dynamic_variable, constant_value, and is_omitted.
   */
  #[JsonProperty('is_system_provided')]
  public ?bool $isSystemProvided;

  /**
   * The name of the dynamic variable to use for this property's value. Mutually exclusive with description, is_system_provided, constant_value, and is_omitted.
   */
  #[JsonProperty('dynamic_variable')]
  public ?string $dynamicVariable;

  /**
   * Server-side rejection guard for an LLM-provided value: the runtime rejects any value outside the permitted set this object names, and the set is not advertised to the LLM as an enum. Only supported when the value source is `description`; combining it with dynamic_variable, is_system_provided, constant_value, or is_omitted is rejected.
   */
  #[JsonProperty('allowed_values')]
  public ?\ElevenLabs\Types\AllowedValues $allowedValues;

  /**
   * DEPRECATED: use `allowed_values` instead. When set, the LLM provides the value but the runtime rejects any value not present in the list held by this dynamic variable (must be a JSON array such as ["ws_alpha", "ws_beta"]). Use to let the LLM pick from a server-verified set (e.g. the IDs the current user is allowed to access). Requires description; mutually exclusive with dynamic_variable, is_system_provided, constant_value, and is_omitted.
   */
  #[JsonProperty('allowed_values_dynamic_variable')]
  public ?string $allowedValuesDynamicVariable;

  /**
   * A constant value to use for this property. Mutually exclusive with description, dynamic_variable, is_system_provided, and is_omitted.
   */
  #[JsonProperty('constant_value')]
  public string|int|float|bool|null $constantValue;

  /**
   * If true, this parameter will be completely omitted from the request. Only valid for optional parameters. Mutually exclusive with description, dynamic_variable, is_system_provided, and constant_value.
   */
  #[JsonProperty('is_omitted')]
  public ?bool $isOmitted;

  /**
   * @param array{
   *   type: string|array,
   *   description?: ?string,
   *   enum?: string[]|null,
   *   isSystemProvided?: ?bool,
   *   dynamicVariable?: ?string,
   *   allowedValues?: ?\ElevenLabs\Types\AllowedValues,
   *   allowedValuesDynamicVariable?: ?string,
   *   constantValue?: string|int|float|bool|null,
   *   isOmitted?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];
    $this->description = $values['description'] ?? null;
    $this->enum = $values['enum'] ?? null;
    $this->isSystemProvided = $values['isSystemProvided'] ?? null;
    $this->dynamicVariable = $values['dynamicVariable'] ?? null;
    $this->allowedValues = $values['allowedValues'] ?? null;
    $this->allowedValuesDynamicVariable = $values['allowedValuesDynamicVariable'] ?? null;
    $this->constantValue = $values['constantValue'] ?? null;
    $this->isOmitted = $values['isOmitted'] ?? null;

    $this->_dirtyFields = [
      'type' => true
    ];
    if (array_key_exists('description', $values)) {
      $this->_dirtyFields['description'] = true;
    }
    if (array_key_exists('enum', $values)) {
      $this->_dirtyFields['enum'] = true;
    }
    if (array_key_exists('isSystemProvided', $values)) {
      $this->_dirtyFields['is_system_provided'] = true;
    }
    if (array_key_exists('dynamicVariable', $values)) {
      $this->_dirtyFields['dynamic_variable'] = true;
    }
    if (array_key_exists('allowedValues', $values)) {
      $this->_dirtyFields['allowed_values'] = true;
    }
    if (array_key_exists('allowedValuesDynamicVariable', $values)) {
      $this->_dirtyFields['allowed_values_dynamic_variable'] = true;
    }
    if (array_key_exists('constantValue', $values)) {
      $this->_dirtyFields['constant_value'] = true;
    }
    if (array_key_exists('isOmitted', $values)) {
      $this->_dirtyFields['is_omitted'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'type',
      'contents' => json_encode($this->type),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->description !== null) {
      $parts[] = [
        'name' => 'description',
        'contents' => $this->description
      ];
    }

    if ($this->enum !== null) {
      foreach ($this->enum ?? [] as $item) {
        $parts[] = [
          'name' => 'enum',
          'contents' => $item
        ];
      }
    }

    if ($this->isSystemProvided !== null) {
      $parts[] = [
        'name' => 'is_system_provided',
        'contents' => $this->isSystemProvided ? 'true' : 'false'
      ];
    }

    if ($this->dynamicVariable !== null) {
      $parts[] = [
        'name' => 'dynamic_variable',
        'contents' => $this->dynamicVariable
      ];
    }

    if ($this->allowedValues !== null) {
      $parts[] = [
        'name' => 'allowed_values',
        'contents' => json_encode($this->allowedValues),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->allowedValuesDynamicVariable !== null) {
      $parts[] = [
        'name' => 'allowed_values_dynamic_variable',
        'contents' => $this->allowedValuesDynamicVariable
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

    return $parts;
  }

  public function validate(): void
  {
    $this->allowedValues?->validate();
  }
}
