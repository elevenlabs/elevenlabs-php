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
class LlmObjectJsonSchemaPropertyOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\LlmObjectJsonSchemaPropertyOutputType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * @var string[]|null
   */
  #[JsonProperty('required'), ArrayType(['string'])]
  public ?array $required;

  #[JsonProperty('description')]
  public ?string $description;

  /**
   * @var array<string, \ElevenLabs\Types\LlmLiteralJsonSchemaProperty|\ElevenLabs\Types\LlmObjectJsonSchemaPropertyOutput|\ElevenLabs\Types\LlmArrayJsonSchemaPropertyOutput|array>|null
   */
  #[
    JsonProperty('properties'),
    ArrayType([
      'string' => new Union(
        \ElevenLabs\Types\LlmLiteralJsonSchemaProperty::class,
        \ElevenLabs\Types\LlmObjectJsonSchemaPropertyOutput::class,
        \ElevenLabs\Types\LlmArrayJsonSchemaPropertyOutput::class,
        ['string' => 'mixed']
      )
    ])
  ]
  public ?array $properties;

  /**
   * @param array{
   *   type?: ?value-of<\ElevenLabs\Types\LlmObjectJsonSchemaPropertyOutputType>,
   *   required?: string[]|null,
   *   description?: ?string,
   *   properties?: array<string, \ElevenLabs\Types\LlmLiteralJsonSchemaProperty|\ElevenLabs\Types\LlmObjectJsonSchemaPropertyOutput|\ElevenLabs\Types\LlmArrayJsonSchemaPropertyOutput|array>|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->type = $values['type'] ?? 'object';
    $this->required = $values['required'] ?? null;
    $this->description = $values['description'] ?? null;
    $this->properties = $values['properties'] ?? null;

    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
    if (array_key_exists('required', $values)) {
      $this->_dirtyFields['required'] = true;
    }
    if (array_key_exists('description', $values)) {
      $this->_dirtyFields['description'] = true;
    }
    if (array_key_exists('properties', $values)) {
      $this->_dirtyFields['properties'] = true;
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

    if ($this->required !== null) {
      foreach ($this->required ?? [] as $item) {
        $parts[] = [
          'name' => 'required',
          'contents' => $item
        ];
      }
    }

    if ($this->description !== null) {
      $parts[] = [
        'name' => 'description',
        'contents' => $this->description
      ];
    }

    if ($this->properties !== null) {
      $parts[] = [
        'name' => 'properties',
        'contents' => json_encode($this->properties),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
