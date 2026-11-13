<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * Configuration for extracting values from tool responses and assigning them to dynamic variables.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class DynamicVariableAssignment extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\DynamicVariableAssignmentSource>
   * The source to extract the value from. Currently only 'response' is supported.
   */
  #[JsonProperty('source')]
  public ?string $source;

  /**
   * The name of the dynamic variable to assign the extracted value to
   */
  #[JsonProperty('dynamic_variable', required: true)]
  public string $dynamicVariable;

  /**
   * Dot notation path to extract the value from the source (e.g., 'user.name' or 'data.0.id')
   */
  #[JsonProperty('value_path', required: true)]
  public string $valuePath;

  /**
   * If true, this assignment's value will be removed from the tool response before sending to the LLM and transcript, but still processed for variable assignment.
   */
  #[JsonProperty('sanitize')]
  public ?bool $sanitize;

  /**
   * If true, non-scalar values (lists, objects) extracted from the tool response are stored as their native type instead of being stringified to JSON. Enable this to use extracted arrays directly as list dynamic variables.
   */
  #[JsonProperty('preserve_native_type')]
  public ?bool $preserveNativeType;

  /**
   * @param array{
   *   dynamicVariable: string,
   *   valuePath: string,
   *   source?: ?value-of<\ElevenLabs\Types\DynamicVariableAssignmentSource>,
   *   sanitize?: ?bool,
   *   preserveNativeType?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->source = $values['source'] ?? 'response';
    $this->dynamicVariable = $values['dynamicVariable'];
    $this->valuePath = $values['valuePath'];
    $this->sanitize = $values['sanitize'] ?? null;
    $this->preserveNativeType = $values['preserveNativeType'] ?? null;

    $this->_dirtyFields = [
      'dynamic_variable' => true,
      'value_path' => true
    ];
    if (array_key_exists('source', $values)) {
      $this->_dirtyFields['source'] = true;
    }
    if (array_key_exists('sanitize', $values)) {
      $this->_dirtyFields['sanitize'] = true;
    }
    if (array_key_exists('preserveNativeType', $values)) {
      $this->_dirtyFields['preserve_native_type'] = true;
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

    $parts[] = [
      'name' => 'value_path',
      'contents' => $this->valuePath
    ];

    if ($this->sanitize !== null) {
      $parts[] = [
        'name' => 'sanitize',
        'contents' => $this->sanitize ? 'true' : 'false'
      ];
    }

    if ($this->preserveNativeType !== null) {
      $parts[] = [
        'name' => 'preserve_native_type',
        'contents' => $this->preserveNativeType ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
