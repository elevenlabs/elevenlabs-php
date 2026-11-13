<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Core\Types\Union;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class LlmLiteralJsonSchemaProperty extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('type', required: true), Union('string', ['string'])]
  public string|array $type;

  #[JsonProperty('description', required: true)]
  public string $description;

  /**
   * @var string[]|null
   * List of allowed string values for string type parameters
   */
  #[JsonProperty('enum'), ArrayType(['string'])]
  public ?array $enum;

  /**
   * @param array{
   *   type: string|array,
   *   description: string,
   *   enum?: string[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];
    $this->description = $values['description'];
    $this->enum = $values['enum'] ?? null;

    $this->_dirtyFields = [
      'type' => true,
      'description' => true
    ];
    if (array_key_exists('enum', $values)) {
      $this->_dirtyFields['enum'] = true;
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

    $parts[] = [
      'name' => 'description',
      'contents' => $this->description
    ];

    if ($this->enum !== null) {
      foreach ($this->enum ?? [] as $item) {
        $parts[] = [
          'name' => 'enum',
          'contents' => $item
        ];
      }
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->description, 'description', minLength: 0);
  }
}
