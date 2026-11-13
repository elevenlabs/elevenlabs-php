<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ObjectSchema extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('title')]
  public ?string $title;

  #[JsonProperty('description')]
  public ?string $description;

  /**
   * @var ?value-of<\ElevenLabs\Types\ObjectSchemaType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * @var array<string, \ElevenLabs\Types\ContentSchema>|null
   */
  #[JsonProperty('properties'), ArrayType(['string' => \ElevenLabs\Types\ContentSchema::class])]
  public ?array $properties;

  /**
   * @var string[]|null
   */
  #[JsonProperty('required'), ArrayType(['string'])]
  public ?array $required;

  /**
   * @param array{
   *   title?: ?string,
   *   description?: ?string,
   *   type?: ?value-of<\ElevenLabs\Types\ObjectSchemaType>,
   *   properties?: array<string, \ElevenLabs\Types\ContentSchema>|null,
   *   required?: string[]|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->title = $values['title'] ?? null;
    $this->description = $values['description'] ?? null;
    $this->type = $values['type'] ?? 'object';
    $this->properties = $values['properties'] ?? null;
    $this->required = $values['required'] ?? null;

    if (array_key_exists('title', $values)) {
      $this->_dirtyFields['title'] = true;
    }
    if (array_key_exists('description', $values)) {
      $this->_dirtyFields['description'] = true;
    }
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
    if (array_key_exists('properties', $values)) {
      $this->_dirtyFields['properties'] = true;
    }
    if (array_key_exists('required', $values)) {
      $this->_dirtyFields['required'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->title !== null) {
      $parts[] = [
        'name' => 'title',
        'contents' => $this->title
      ];
    }

    if ($this->description !== null) {
      $parts[] = [
        'name' => 'description',
        'contents' => $this->description
      ];
    }

    if ($this->type !== null) {
      $parts[] = [
        'name' => 'type',
        'contents' => $this->type
      ];
    }

    if ($this->properties !== null) {
      $parts[] = [
        'name' => 'properties',
        'contents' => json_encode($this->properties),
        'headers' => ['Content-Type' => 'application/json']
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

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->description, 'description', maxLength: 500);
  }
}
