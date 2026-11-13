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
class StringSchema extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('title')]
  public ?string $title;

  #[JsonProperty('description')]
  public ?string $description;

  /**
   * @var ?value-of<\ElevenLabs\Types\StringSchemaType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * @var string[]|null
   */
  #[JsonProperty('enum'), ArrayType(['string'])]
  public ?array $enum;

  /**
   * @param array{
   *   title?: ?string,
   *   description?: ?string,
   *   type?: ?value-of<\ElevenLabs\Types\StringSchemaType>,
   *   enum?: string[]|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->title = $values['title'] ?? null;
    $this->description = $values['description'] ?? null;
    $this->type = $values['type'] ?? 'string';
    $this->enum = $values['enum'] ?? null;

    if (array_key_exists('title', $values)) {
      $this->_dirtyFields['title'] = true;
    }
    if (array_key_exists('description', $values)) {
      $this->_dirtyFields['description'] = true;
    }
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
    if (array_key_exists('enum', $values)) {
      $this->_dirtyFields['enum'] = true;
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
    Validator::validateString($this->description, 'description', maxLength: 500);
  }
}
