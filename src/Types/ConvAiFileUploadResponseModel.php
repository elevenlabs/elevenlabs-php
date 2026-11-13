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
class ConvAiFileUploadResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('file_id', required: true)]
  public string $fileId;

  /**
   * @param array{
   *   fileId: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->fileId = $values['fileId'];

    $this->_dirtyFields = [
      'file_id' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'file_id',
      'contents' => $this->fileId
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
