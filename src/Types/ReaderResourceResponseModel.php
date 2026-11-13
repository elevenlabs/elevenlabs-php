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
class ReaderResourceResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\ReaderResourceResponseModelResourceType>
   * The type of resource.
   */
  #[JsonProperty('resource_type', required: true)]
  public string $resourceType;

  /**
   * The ID of the resource.
   */
  #[JsonProperty('resource_id', required: true)]
  public string $resourceId;

  /**
   * @param array{
   *   resourceType: value-of<\ElevenLabs\Types\ReaderResourceResponseModelResourceType>,
   *   resourceId: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->resourceType = $values['resourceType'];
    $this->resourceId = $values['resourceId'];

    $this->_dirtyFields = [
      'resource_type' => true,
      'resource_id' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'resource_type',
      'contents' => $this->resourceType
    ];

    $parts[] = [
      'name' => 'resource_id',
      'contents' => $this->resourceId
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
