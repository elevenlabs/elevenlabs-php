<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class DataCollectionResultCommonModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('data_collection_id', required: true)]
  public string $dataCollectionId;

  #[JsonProperty('name')]
  public ?string $name;

  #[JsonProperty('value')]
  public mixed $value;

  #[JsonProperty('json_schema')]
  public ?\ElevenLabs\Types\LiteralJsonSchemaProperty $jsonSchema;

  #[JsonProperty('rationale', required: true)]
  public string $rationale;

  /**
   * @param array{
   *   dataCollectionId: string,
   *   rationale: string,
   *   name?: ?string,
   *   value?: mixed,
   *   jsonSchema?: ?\ElevenLabs\Types\LiteralJsonSchemaProperty,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->dataCollectionId = $values['dataCollectionId'];
    $this->name = $values['name'] ?? null;
    $this->value = $values['value'] ?? null;
    $this->jsonSchema = $values['jsonSchema'] ?? null;
    $this->rationale = $values['rationale'];

    $this->_dirtyFields = [
      'data_collection_id' => true,
      'rationale' => true
    ];
    if (array_key_exists('name', $values)) {
      $this->_dirtyFields['name'] = true;
    }
    if (array_key_exists('value', $values)) {
      $this->_dirtyFields['value'] = true;
    }
    if (array_key_exists('jsonSchema', $values)) {
      $this->_dirtyFields['json_schema'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'data_collection_id',
      'contents' => $this->dataCollectionId
    ];

    if ($this->name !== null) {
      $parts[] = [
        'name' => 'name',
        'contents' => $this->name
      ];
    }

    if ($this->value !== null) {
      $parts[] = [
        'name' => 'value',
        'contents' => json_encode($this->value),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->jsonSchema !== null) {
      $parts[] = [
        'name' => 'json_schema',
        'contents' => json_encode($this->jsonSchema),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    $parts[] = [
      'name' => 'rationale',
      'contents' => $this->rationale
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->jsonSchema?->validate();
  }
}
