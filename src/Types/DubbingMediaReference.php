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
class DubbingMediaReference extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('src', required: true)]
  public string $src;

  #[JsonProperty('content_type', required: true)]
  public string $contentType;

  #[JsonProperty('bucket_name', required: true)]
  public string $bucketName;

  #[JsonProperty('random_path_slug', required: true)]
  public string $randomPathSlug;

  #[JsonProperty('duration_secs', required: true)]
  public float $durationSecs;

  #[JsonProperty('is_audio', required: true)]
  public bool $isAudio;

  #[JsonProperty('url', required: true)]
  public string $url;

  /**
   * @param array{
   *   src: string,
   *   contentType: string,
   *   bucketName: string,
   *   randomPathSlug: string,
   *   durationSecs: float,
   *   isAudio: bool,
   *   url: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->src = $values['src'];
    $this->contentType = $values['contentType'];
    $this->bucketName = $values['bucketName'];
    $this->randomPathSlug = $values['randomPathSlug'];
    $this->durationSecs = $values['durationSecs'];
    $this->isAudio = $values['isAudio'];
    $this->url = $values['url'];

    $this->_dirtyFields = [
      'src' => true,
      'content_type' => true,
      'bucket_name' => true,
      'random_path_slug' => true,
      'duration_secs' => true,
      'is_audio' => true,
      'url' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'src',
      'contents' => $this->src
    ];

    $parts[] = [
      'name' => 'content_type',
      'contents' => $this->contentType
    ];

    $parts[] = [
      'name' => 'bucket_name',
      'contents' => $this->bucketName
    ];

    $parts[] = [
      'name' => 'random_path_slug',
      'contents' => $this->randomPathSlug
    ];

    $parts[] = [
      'name' => 'duration_secs',
      'contents' => (string) $this->durationSecs
    ];

    $parts[] = [
      'name' => 'is_audio',
      'contents' => $this->isAudio ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'url',
      'contents' => $this->url
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
