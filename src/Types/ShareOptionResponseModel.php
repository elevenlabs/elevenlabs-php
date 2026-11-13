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
class ShareOptionResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The name of the principal.
   */
  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * The ID of the principal.
   */
  #[JsonProperty('id', required: true)]
  public string $id;

  /**
   * @var value-of<\ElevenLabs\Types\ShareOptionResponseModelType>
   * The type of the principal: user, group, or service account (under 'key').
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  /**
   * @param array{
   *   name: string,
   *   id: string,
   *   type: value-of<\ElevenLabs\Types\ShareOptionResponseModelType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->name = $values['name'];
    $this->id = $values['id'];
    $this->type = $values['type'];

    $this->_dirtyFields = [
      'name' => true,
      'id' => true,
      'type' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

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
