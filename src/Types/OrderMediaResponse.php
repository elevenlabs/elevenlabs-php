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
class OrderMediaResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('media_id', required: true)]
  public string $mediaId;

  /**
   * The original filename of the uploaded media.
   */
  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * The MIME type of the media file (e.g. 'video/mp4').
   */
  #[JsonProperty('content_type', required: true)]
  public string $contentType;

  /**
   * The detected or declared language of the media, if available.
   */
  #[JsonProperty('language')]
  public ?string $language;

  /**
   * A time-limited URL to download the media file.
   */
  #[JsonProperty('signed_url', required: true)]
  public string $signedUrl;

  /**
   * @param array{
   *   mediaId: string,
   *   name: string,
   *   contentType: string,
   *   signedUrl: string,
   *   language?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->mediaId = $values['mediaId'];
    $this->name = $values['name'];
    $this->contentType = $values['contentType'];
    $this->language = $values['language'] ?? null;
    $this->signedUrl = $values['signedUrl'];

    $this->_dirtyFields = [
      'media_id' => true,
      'name' => true,
      'content_type' => true,
      'signed_url' => true
    ];
    if (array_key_exists('language', $values)) {
      $this->_dirtyFields['language'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'media_id',
      'contents' => $this->mediaId
    ];

    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    $parts[] = [
      'name' => 'content_type',
      'contents' => $this->contentType
    ];

    if ($this->language !== null) {
      $parts[] = [
        'name' => 'language',
        'contents' => $this->language
      ];
    }

    $parts[] = [
      'name' => 'signed_url',
      'contents' => $this->signedUrl
    ];

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->mediaId, 'media_id', pattern: '^prodmedia_[a-z0-9]{26}$');
  }
}
