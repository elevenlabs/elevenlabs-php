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
class OpenAiFunctionTool extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\OpenAiFunctionToolType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  #[JsonProperty('name', required: true)]
  public string $name;

  #[JsonProperty('description')]
  public ?string $description;

  /**
   * @var array<string, mixed>|null
   */
  #[JsonProperty('parameters'), ArrayType(['string' => 'mixed'])]
  public ?array $parameters;

  /**
   * @param array{
   *   name: string,
   *   type?: ?value-of<\ElevenLabs\Types\OpenAiFunctionToolType>,
   *   description?: ?string,
   *   parameters?: array<string, mixed>|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'function';
    $this->name = $values['name'];
    $this->description = $values['description'] ?? null;
    $this->parameters = $values['parameters'] ?? null;

    $this->_dirtyFields = [
      'name' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
    if (array_key_exists('description', $values)) {
      $this->_dirtyFields['description'] = true;
    }
    if (array_key_exists('parameters', $values)) {
      $this->_dirtyFields['parameters'] = true;
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
      'name' => 'name',
      'contents' => $this->name
    ];

    if ($this->description !== null) {
      $parts[] = [
        'name' => 'description',
        'contents' => $this->description
      ];
    }

    if ($this->parameters !== null) {
      $parts[] = [
        'name' => 'parameters',
        'contents' => json_encode($this->parameters),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
