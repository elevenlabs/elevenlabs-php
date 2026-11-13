<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * A newly queued media generation; fetch the GET endpoint for the output.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class MediaGenerationCreateResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The unique identifier of the generation. Pass it to the corresponding GET endpoint to retrieve the output.
   */
  #[JsonProperty('id', required: true)]
  public string $id;

  /**
   * @var value-of<\ElevenLabs\Types\MediaGenerationCreateResponseStatus>
   * A newly created generation is always `pending`.
   */
  #[JsonProperty('status', required: true)]
  public string $status;

  /**
   * @param array{
   *   id: string,
   *   status: value-of<\ElevenLabs\Types\MediaGenerationCreateResponseStatus>,
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
