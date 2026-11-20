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
class Base64FileSource extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\Base64FileSourceType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  /**
   * The name of the file, with its extension.
   */
  #[JsonProperty('filename', required: true)]
  public string $filename;

  /**
   * @var value-of<\ElevenLabs\Types\FileInputMimeType>
   */
  #[JsonProperty('media_type', required: true)]
  public string $mediaType;

  /**
   * The content of the file, base64-encoded.
   */
  #[JsonProperty('data', required: true)]
  public string $data;

  /**
   * @param array{
   *   type: value-of<\ElevenLabs\Types\Base64FileSourceType>,
   *   filename: string,
   *   mediaType: value-of<\ElevenLabs\Types\FileInputMimeType>,
   *   data: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];
    $this->filename = $values['filename'];
    $this->mediaType = $values['mediaType'];
    $this->data = $values['data'];

    $this->_dirtyFields = [
      'type' => true,
      'filename' => true,
      'media_type' => true,
      'data' => true
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
      'name' => 'filename',
      'contents' => $this->filename
    ];

    $parts[] = [
      'name' => 'media_type',
      'contents' => $this->mediaType
    ];

    $parts[] = [
      'name' => 'data',
      'contents' => $this->data
    ];

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->filename, 'filename', minLength: 1);
  }
}
