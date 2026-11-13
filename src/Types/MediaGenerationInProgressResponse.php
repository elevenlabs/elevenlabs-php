<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * A media generation that has not finished yet.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class MediaGenerationInProgressResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The unique identifier of the generation.
   */
  #[JsonProperty('id', required: true)]
  public string $id;

  /**
   * @var value-of<\ElevenLabs\Types\MediaGenerationInProgressResponseStatus>
   * The lifecycle status of the generation. It ends at `completed` or `failed`.
   */
  #[JsonProperty('status', required: true)]
  public string $status;

  /**
   * @param array{
   *   id: string,
   *   status: value-of<\ElevenLabs\Types\MediaGenerationInProgressResponseStatus>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->id = $values['id'];
    $this->status = $values['status'];

    $this->_dirtyFields = [
      'id' => true,
      'status' => true
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
      'name' => 'status',
      'contents' => $this->status
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
