<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class QueryParamsJsonSchemaOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var array<string, \ElevenLabs\Types\LiteralJsonSchemaProperty>
   */
  #[
    JsonProperty('properties', required: true),
    ArrayType(['string' => \ElevenLabs\Types\LiteralJsonSchemaProperty::class])
  ]
  public array $properties;

  /**
   * @var string[]|null
   */
  #[JsonProperty('required'), ArrayType(['string'])]
  public ?array $required;

  /**
   * @param array{
   *   properties: array<string, \ElevenLabs\Types\LiteralJsonSchemaProperty>,
   *   required?: string[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->properties = $values['properties'];
    $this->required = $values['required'] ?? null;

    $this->_dirtyFields = [
      'properties' => true
    ];
    if (array_key_exists('required', $values)) {
      $this->_dirtyFields['required'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'properties',
      'contents' => json_encode($this->properties),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->required !== null) {
      foreach ($this->required ?? [] as $item) {
        $parts[] = [
          'name' => 'required',
          'contents' => $item
        ];
      }
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
