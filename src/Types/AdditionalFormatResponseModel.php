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
class AdditionalFormatResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The requested format.
   */
  #[JsonProperty('requested_format', required: true)]
  public string $requestedFormat;

  /**
   * The file extension of the additional format.
   */
  #[JsonProperty('file_extension', required: true)]
  public string $fileExtension;

  /**
   * The content type of the additional format.
   */
  #[JsonProperty('content_type', required: true)]
  public string $contentType;

  /**
   * Whether the content is base64 encoded.
   */
  #[JsonProperty('is_base64_encoded', required: true)]
  public bool $isBase64Encoded;

  /**
   * The content of the additional format.
   */
  #[JsonProperty('content', required: true)]
  public string $content;

  /**
   * @param array{
   *   requestedFormat: string,
   *   fileExtension: string,
   *   contentType: string,
   *   isBase64Encoded: bool,
   *   content: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->requestedFormat = $values['requestedFormat'];
    $this->fileExtension = $values['fileExtension'];
    $this->contentType = $values['contentType'];
    $this->isBase64Encoded = $values['isBase64Encoded'];
    $this->content = $values['content'];

    $this->_dirtyFields = [
      'requested_format' => true,
      'file_extension' => true,
      'content_type' => true,
      'is_base64_encoded' => true,
      'content' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'requested_format',
      'contents' => $this->requestedFormat
    ];

    $parts[] = [
      'name' => 'file_extension',
      'contents' => $this->fileExtension
    ];

    $parts[] = [
      'name' => 'content_type',
      'contents' => $this->contentType
    ];

    $parts[] = [
      'name' => 'is_base64_encoded',
      'contents' => $this->isBase64Encoded ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'content',
      'contents' => $this->content
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
