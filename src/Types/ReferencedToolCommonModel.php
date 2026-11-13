<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * Reference to a tool for unit test evaluation.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ReferencedToolCommonModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The ID of the tool
   */
  #[JsonProperty('id', required: true)]
  public string $id;

  /**
   * @var value-of<\ElevenLabs\Types\ReferencedToolCommonModelType>
   * The type of the tool
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  /**
   * @param array{
   *   id: string,
   *   type: value-of<\ElevenLabs\Types\ReferencedToolCommonModelType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->id = $values['id'];
    $this->type = $values['type'];

    $this->_dirtyFields = [
      'id' => true,
      'type' => true
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
      'name' => 'type',
      'contents' => $this->type
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
