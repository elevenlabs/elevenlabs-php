<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * Media passed inline as base64. Stored as an ephemeral asset with no
 * guaranteed retention. To keep an input and reuse it, upload via
 * ``POST /v1/assets`` and pass an ``asset`` reference instead.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class InlineBase64Reference extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\InlineBase64ReferenceType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  /**
   * The media file's bytes, base64-encoded (standard alphabet). Up to 25MB decoded.
   */
  #[JsonProperty('content_base64', required: true)]
  public string $contentBase64;

  /**
   * @var value-of<\ElevenLabs\Types\InlineBase64ReferenceMimeType>
   * The MIME type of the encoded media.
   */
  #[JsonProperty('mime_type', required: true)]
  public string $mimeType;

  /**
   * @param array{
   *   type: value-of<\ElevenLabs\Types\InlineBase64ReferenceType>,
   *   contentBase64: string,
   *   mimeType: value-of<\ElevenLabs\Types\InlineBase64ReferenceMimeType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];
    $this->contentBase64 = $values['contentBase64'];
    $this->mimeType = $values['mimeType'];

    $this->_dirtyFields = [
      'type' => true,
      'content_base64' => true,
      'mime_type' => true
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
      'name' => 'content_base64',
      'contents' => $this->contentBase64
    ];

    $parts[] = [
      'name' => 'mime_type',
      'contents' => $this->mimeType
    ];

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->contentBase64, 'content_base64', maxLength: 34952536);
  }
}
