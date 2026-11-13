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
class ProjectVideoThumbnailSheetResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('start_thumbnail_index', required: true)]
  public int $startThumbnailIndex;

  #[JsonProperty('thumbnail_count', required: true)]
  public int $thumbnailCount;

  #[JsonProperty('signed_cloud_url', required: true)]
  public string $signedCloudUrl;

  /**
   * @param array{
   *   startThumbnailIndex: int,
   *   thumbnailCount: int,
   *   signedCloudUrl: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->startThumbnailIndex = $values['startThumbnailIndex'];
    $this->thumbnailCount = $values['thumbnailCount'];
    $this->signedCloudUrl = $values['signedCloudUrl'];

    $this->_dirtyFields = [
      'start_thumbnail_index' => true,
      'thumbnail_count' => true,
      'signed_cloud_url' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'start_thumbnail_index',
      'contents' => (string) $this->startThumbnailIndex
    ];

    $parts[] = [
      'name' => 'thumbnail_count',
      'contents' => (string) $this->thumbnailCount
    ];

    $parts[] = [
      'name' => 'signed_cloud_url',
      'contents' => $this->signedCloudUrl
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
