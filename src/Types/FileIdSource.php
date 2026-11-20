<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class FileIdSource extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\FileIdSourceType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  /**
   * The ID that `POST /v1/convai/conversations/{conversation_id}/files` returned for this conversation.
   */
  #[JsonProperty('file_id', required: true)]
  public string $fileId;

  /**
   * @param array{
   *   type: value-of<\ElevenLabs\Types\FileIdSourceType>,
   *   fileId: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];
    $this->fileId = $values['fileId'];

    $this->_dirtyFields = [
      'type' => true,
      'file_id' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
    ];

    $parts[] = [
      'name' => 'file_id',
      'contents' => $this->fileId
    ];

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->fileId, 'file_id', minLength: 1);
  }
}
