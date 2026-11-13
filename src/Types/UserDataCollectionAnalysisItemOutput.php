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
class UserDataCollectionAnalysisItemOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * @var ?value-of<\ElevenLabs\Types\UserDataCollectionAnalysisItemOutputSource>
   */
  #[JsonProperty('source')]
  public ?string $source;

  /**
   * @var ?value-of<\ElevenLabs\Types\Llm>
   * LLM to use for this item. If unset, the attaching agent's analysis_llm default is used.
   */
  #[JsonProperty('llm')]
  public ?string $llm;

  /**
   * @var ?value-of<\ElevenLabs\Types\UserDataCollectionAnalysisItemOutputKind>
   */
  #[JsonProperty('kind')]
  public ?string $kind;

  /**
   * Schema property for literal JSON types. IMPORTANT: Only ONE of the following fields can be set: description (LLM provides value), dynamic_variable (value from variable), is_system_provided (system provides value), constant_value (fixed value), or is_omitted (parameter is omitted). These are mutually exclusive.
   */
  #[JsonProperty('value_schema', required: true)]
  public \ElevenLabs\Types\DataCollectionValueSchema $valueSchema;

  /**
   * @param array{
   *   name: string,
   *   valueSchema: \ElevenLabs\Types\DataCollectionValueSchema,
   *   source?: ?value-of<\ElevenLabs\Types\UserDataCollectionAnalysisItemOutputSource>,
   *   llm?: ?value-of<\ElevenLabs\Types\Llm>,
   *   kind?: ?value-of<\ElevenLabs\Types\UserDataCollectionAnalysisItemOutputKind>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->name = $values['name'];
    $this->source = $values['source'] ?? 'user';
    $this->llm = $values['llm'] ?? null;
    $this->kind = $values['kind'] ?? 'data_collection';
    $this->valueSchema = $values['valueSchema'];

    $this->_dirtyFields = [
      'name' => true,
      'value_schema' => true
    ];
    if (array_key_exists('source', $values)) {
      $this->_dirtyFields['source'] = true;
    }
    if (array_key_exists('llm', $values)) {
      $this->_dirtyFields['llm'] = true;
    }
    if (array_key_exists('kind', $values)) {
      $this->_dirtyFields['kind'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    if ($this->source !== null) {
      $parts[] = [
        'name' => 'source',
        'contents' => $this->source
      ];
    }

    if ($this->llm !== null) {
      $parts[] = [
        'name' => 'llm',
        'contents' => $this->llm
      ];
    }

    if ($this->kind !== null) {
      $parts[] = [
        'name' => 'kind',
        'contents' => $this->kind
      ];
    }

    $parts[] = [
      'name' => 'value_schema',
      'contents' => json_encode($this->valueSchema),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->valueSchema->validate();
  }
}
