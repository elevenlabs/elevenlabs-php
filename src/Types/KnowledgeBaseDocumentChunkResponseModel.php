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
class KnowledgeBaseDocumentChunkResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('id', required: true)]
  public string $id;

  #[JsonProperty('name', required: true)]
  public string $name;

  #[JsonProperty('content', required: true)]
  public string $content;

  /**
   * @param array{
   *   id: string,
   *   name: string,
   *   content: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->id = $values['id'];
    $this->name = $values['name'];
    $this->content = $values['content'];

    $this->_dirtyFields = [
      'id' => true,
      'name' => true,
      'content' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'id',
      'contents' => $this->id
    ];

    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    $parts[] = [
      'name' => 'content',
      'contents' => $this->content
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
