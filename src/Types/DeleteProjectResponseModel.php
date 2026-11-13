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
class DeleteProjectResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The status of the studio project deletion request. If the request was successful, the status will be 'ok'. Otherwise an error message with status 500 will be returned.
   */
  #[JsonProperty('status', required: true)]
  public string $status;

  /**
   * @param array{
   *   status: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->status = $values['status'];

    $this->_dirtyFields = [
      'status' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'status',
      'contents' => $this->status
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
