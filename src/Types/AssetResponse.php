<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The public Asset object.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class AssetResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Unique identifier for the asset.
   */
  #[JsonProperty('asset_id', required: true)]
  public string $assetId;

  /**
   * Display name of the asset.
   */
  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * MIME type of the uploaded file (e.g. `audio/mpeg`).
   */
  #[JsonProperty('mime_type', required: true)]
  public string $mimeType;

  /**
   * Unix timestamp (seconds) the asset was created.
   */
  #[JsonProperty('created_at_unix', required: true)]
  public int $createdAtUnix;

  /**
   * Signed URL to fetch the asset's content. May be `null` if the asset has not finished processing. Do not rely on it being valid for more than 1 hour; fetch the asset again for a fresh URL.
   */
  #[JsonProperty('content_url', required: true)]
  public ?string $contentUrl;

  /**
   * @param array{
   *   assetId: string,
   *   name: string,
   *   mimeType: string,
   *   createdAtUnix: int,
   *   contentUrl: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->assetId = $values['assetId'];
    $this->name = $values['name'];
    $this->mimeType = $values['mimeType'];
    $this->createdAtUnix = $values['createdAtUnix'];
    $this->contentUrl = $values['contentUrl'];

    $this->_dirtyFields = [
      'asset_id' => true,
      'name' => true,
      'mime_type' => true,
      'created_at_unix' => true,
      'content_url' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'asset_id',
      'contents' => $this->assetId
    ];

    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    $parts[] = [
      'name' => 'mime_type',
      'contents' => $this->mimeType
    ];

    $parts[] = [
      'name' => 'created_at_unix',
      'contents' => (string) $this->createdAtUnix
    ];

    $parts[] = [
      'name' => 'content_url',
      'contents' => $this->contentUrl
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
