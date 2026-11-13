<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\Union;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class LlmArrayJsonSchemaPropertyOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\LlmArrayJsonSchemaPropertyOutputType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  #[JsonProperty('description')]
  public ?string $description;

  #[
    JsonProperty('items', required: true),
    Union(
      \ElevenLabs\Types\LlmLiteralJsonSchemaProperty::class,
      \ElevenLabs\Types\LlmObjectJsonSchemaPropertyOutput::class,
      \ElevenLabs\Types\LlmArrayJsonSchemaPropertyOutput::class,
      ['string' => 'mixed']
    )
  ]
  public \ElevenLabs\Types\LlmLiteralJsonSchemaProperty|\ElevenLabs\Types\LlmObjectJsonSchemaPropertyOutput|\ElevenLabs\Types\LlmArrayJsonSchemaPropertyOutput|array $items;

  /**
   * @param array{
   *   items: \ElevenLabs\Types\LlmLiteralJsonSchemaProperty|\ElevenLabs\Types\LlmObjectJsonSchemaPropertyOutput|\ElevenLabs\Types\LlmArrayJsonSchemaPropertyOutput|array,
   *   type?: ?value-of<\ElevenLabs\Types\LlmArrayJsonSchemaPropertyOutputType>,
   *   description?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'array';
    $this->description = $values['description'] ?? null;
    $this->items = $values['items'];

    $this->_dirtyFields = [
      'items' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
    if (array_key_exists('description', $values)) {
      $this->_dirtyFields['description'] = true;
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

    if ($this->description !== null) {
      $parts[] = [
        'name' => 'description',
        'contents' => $this->description
      ];
    }

    $parts[] = [
      'name' => 'items',
      'contents' => json_encode($this->items),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
