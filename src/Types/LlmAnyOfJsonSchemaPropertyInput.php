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
class LlmAnyOfJsonSchemaPropertyInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\LlmObjectJsonSchemaPropertyInput[]
   */
  #[
    JsonProperty('any_of', required: true),
    ArrayType([\ElevenLabs\Types\LlmObjectJsonSchemaPropertyInput::class])
  ]
  public array $anyOf;

  #[JsonProperty('description')]
  public ?string $description;

  /**
   * @param array{
   *   anyOf: \ElevenLabs\Types\LlmObjectJsonSchemaPropertyInput[],
   *   description?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->anyOf = $values['anyOf'];
    $this->description = $values['description'] ?? null;

    $this->_dirtyFields = [
      'any_of' => true
    ];
    if (array_key_exists('description', $values)) {
      $this->_dirtyFields['description'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'any_of',
      'contents' => json_encode($this->anyOf),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->description !== null) {
      $parts[] = [
        'name' => 'description',
        'contents' => $this->description
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->anyOf as $item) {
      $item->validate();
    }
  }
}
