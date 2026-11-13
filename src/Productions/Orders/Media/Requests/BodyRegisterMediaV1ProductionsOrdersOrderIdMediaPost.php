<?php

declare(strict_types=1);

namespace ElevenLabs\Productions\Orders\Media\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyRegisterMediaV1ProductionsOrdersOrderIdMediaPost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The language code of the media content (e.g. 'en', 'es-ES'). Must be a supported source language for some order item kind.
   */
  #[JsonProperty('declared_language', required: true)]
  public string $declaredLanguage;

  /**
   * @var ?\ElevenLabs\Utils\File
   * The media file to upload. Mutually exclusive with media_url.
   */
  #[JsonProperty('media')]
  public ?\ElevenLabs\Utils\File $media;

  /**
   * A URL to fetch the media file from. Mutually exclusive with media.
   */
  #[JsonProperty('media_url')]
  public ?string $mediaUrl;

  /**
   * The filename for URL-sourced media (e.g. 'example.mp4'). Required when using media_url.
   */
  #[JsonProperty('media_url_filename')]
  public ?string $mediaUrlFilename;

  /**
   * The MIME type for URL-sourced media (e.g. 'video/mp4'). Required when using media_url.
   */
  #[JsonProperty('media_url_content_type')]
  public ?string $mediaUrlContentType;

  /**
   * @param array{
   *   declaredLanguage: string,
   *   media?: ?\ElevenLabs\Utils\File,
   *   mediaUrl?: ?string,
   *   mediaUrlFilename?: ?string,
   *   mediaUrlContentType?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->declaredLanguage = $values['declaredLanguage'];
    $this->media = $values['media'] ?? null;
    $this->mediaUrl = $values['mediaUrl'] ?? null;
    $this->mediaUrlFilename = $values['mediaUrlFilename'] ?? null;
    $this->mediaUrlContentType = $values['mediaUrlContentType'] ?? null;

    $this->_dirtyFields = [
      'declared_language' => true
    ];
    if (array_key_exists('media', $values)) {
      $this->_dirtyFields['media'] = true;
    }
    if (array_key_exists('mediaUrl', $values)) {
      $this->_dirtyFields['media_url'] = true;
    }
    if (array_key_exists('mediaUrlFilename', $values)) {
      $this->_dirtyFields['media_url_filename'] = true;
    }
    if (array_key_exists('mediaUrlContentType', $values)) {
      $this->_dirtyFields['media_url_content_type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'declared_language',
      'contents' => $this->declaredLanguage
    ];

    if ($this->media !== null) {
      $parts[] = $this->media->toMultipartFormDataPart('media')->toGuzzlePart();
    }

    if ($this->mediaUrl !== null) {
      $parts[] = [
        'name' => 'media_url',
        'contents' => $this->mediaUrl
      ];
    }

    if ($this->mediaUrlFilename !== null) {
      $parts[] = [
        'name' => 'media_url_filename',
        'contents' => $this->mediaUrlFilename
      ];
    }

    if ($this->mediaUrlContentType !== null) {
      $parts[] = [
        'name' => 'media_url_content_type',
        'contents' => $this->mediaUrlContentType
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
