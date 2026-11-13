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
class KnowledgeBaseLocator extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\KnowledgeBaseDocumentType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  /**
   * The name of the knowledge base
   */
  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * The ID of the knowledge base
   */
  #[JsonProperty('id', required: true)]
  public string $id;

  /**
   * @var ?value-of<\ElevenLabs\Types\DocumentUsageModeEnum>
   */
  #[JsonProperty('usage_mode')]
  public ?string $usageMode;

  /**
   * @param array{
   *   type: value-of<\ElevenLabs\Types\KnowledgeBaseDocumentType>,
   *   name: string,
   *   id: string,
   *   usageMode?: ?value-of<\ElevenLabs\Types\DocumentUsageModeEnum>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];
    $this->name = $values['name'];
    $this->id = $values['id'];
    $this->usageMode = $values['usageMode'] ?? null;

    $this->_dirtyFields = [
      'type' => true,
      'name' => true,
      'id' => true
    ];
    if (array_key_exists('usageMode', $values)) {
      $this->_dirtyFields['usage_mode'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
    ];

    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    $parts[] = [
      'name' => 'id',
      'contents' => $this->id
    ];

    if ($this->usageMode !== null) {
      $parts[] = [
        'name' => 'usage_mode',
        'contents' => $this->usageMode
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
