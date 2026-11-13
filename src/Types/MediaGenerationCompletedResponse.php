<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * A completed media generation and its output.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class MediaGenerationCompletedResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The unique identifier of the generation.
   */
  #[JsonProperty('id', required: true)]
  public string $id;

  /**
   * @var value-of<\ElevenLabs\Types\MediaGenerationCompletedResponseStatus>
   * The lifecycle status of the generation.
   */
  #[JsonProperty('status', required: true)]
  public string $status;

  /**
   * A signed URL to download the generated media from. It expires about an hour after this response is returned; fetch the generation again for a fresh URL.
   */
  #[JsonProperty('content_url', required: true)]
  public string $contentUrl;

  /**
   * The MIME type of the generated media.
   */
  #[JsonProperty('content_mime_type', required: true)]
  public string $contentMimeType;

  /**
   * @param array{
   *   id: string,
   *   status: value-of<\ElevenLabs\Types\MediaGenerationCompletedResponseStatus>,
   *   contentUrl: string,
   *   contentMimeType: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->id = $values['id'];
    $this->status = $values['status'];
    $this->contentUrl = $values['contentUrl'];
    $this->contentMimeType = $values['contentMimeType'];

    $this->_dirtyFields = [
      'id' => true,
      'status' => true,
      'content_url' => true,
      'content_mime_type' => true
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

    $parts[] = [
      'name' => 'content_url',
      'contents' => $this->contentUrl
    ];

    $parts[] = [
      'name' => 'content_mime_type',
      'contents' => $this->contentMimeType
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
