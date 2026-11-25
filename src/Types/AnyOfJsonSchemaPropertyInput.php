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
class AnyOfJsonSchemaPropertyInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\ObjectJsonSchemaPropertyInput[]
   * The object shapes the value can take.
   */
  #[
    JsonProperty('any_of', required: true),
    ArrayType([\ElevenLabs\Types\ObjectJsonSchemaPropertyInput::class])
  ]
  public array $anyOf;

  /**
   * The property every branch declares as a required string with a single enum value; that value names the branch.
   */
  #[JsonProperty('discriminator', required: true)]
  public string $discriminator;

  /**
   * What the value is, for the LLM.
   */
  #[JsonProperty('description')]
  public ?string $description;

  /**
   * @param array{
   *   anyOf: \ElevenLabs\Types\ObjectJsonSchemaPropertyInput[],
   *   discriminator: string,
   *   description?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->anyOf = $values['anyOf'];
    $this->discriminator = $values['discriminator'];
    $this->description = $values['description'] ?? null;

    $this->_dirtyFields = [
      'any_of' => true,
      'discriminator' => true
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

    $parts[] = [
      'name' => 'discriminator',
      'contents' => $this->discriminator
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
    Validator::validateArray($this->anyOf, 'any_of', minItems: 2);
    Validator::validateString($this->discriminator, 'discriminator', minLength: 1);
  }
}
