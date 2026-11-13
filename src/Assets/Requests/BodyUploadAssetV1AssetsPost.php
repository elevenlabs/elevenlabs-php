<?php

declare(strict_types=1);

namespace ElevenLabs\Assets\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyUploadAssetV1AssetsPost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Utils\File
   * The file to upload.
   */
  #[JsonProperty('asset', required: true)]
  public \ElevenLabs\Utils\File $asset;

  /**
   * Display name for the asset.
   */
  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * @param array{
   *   asset: \ElevenLabs\Utils\File,
   *   name: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->asset = $values['asset'];
    $this->name = $values['name'];

    $this->_dirtyFields = [
      'asset' => true,
      'name' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = $this->asset->toMultipartFormDataPart('asset')->toGuzzlePart();

    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
