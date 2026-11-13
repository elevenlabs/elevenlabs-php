<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * An asset uploaded via the assets API.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class StaticAssetReference extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\StaticAssetReferenceType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  /**
   * The ID of an asset uploaded via the assets API (`POST /v1/assets`), as returned in that response's `asset_id`.
   */
  #[JsonProperty('asset_id', required: true)]
  public string $assetId;

  /**
   * @param array{
   *   type: value-of<\ElevenLabs\Types\StaticAssetReferenceType>,
   *   assetId: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];
    $this->assetId = $values['assetId'];

    $this->_dirtyFields = [
      'type' => true,
      'asset_id' => true
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
      'name' => 'asset_id',
      'contents' => $this->assetId
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
