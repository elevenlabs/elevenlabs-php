<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * One page of the workspace's assets, most recently created first.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class AssetListResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\AssetResponse[]
   * List of Asset objects.
   */
  #[JsonProperty('assets', required: true), ArrayType([\ElevenLabs\Types\AssetResponse::class])]
  public array $assets;

  /**
   * Pass as `cursor` to fetch the next page. `null` if there are no more results.
   */
  #[JsonProperty('next_cursor', required: true)]
  public ?string $nextCursor;

  /**
   * Whether there are more results to fetch.
   */
  #[JsonProperty('has_more')]
  public ?bool $hasMore;

  /**
   * @param array{
   *   assets: \ElevenLabs\Types\AssetResponse[],
   *   nextCursor: ?string,
   *   hasMore?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->assets = $values['assets'];
    $this->nextCursor = $values['nextCursor'];
    $this->hasMore = $values['hasMore'] ?? null;

    $this->_dirtyFields = [
      'assets' => true,
      'next_cursor' => true
    ];
    if (array_key_exists('hasMore', $values)) {
      $this->_dirtyFields['has_more'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'assets',
      'contents' => json_encode($this->assets),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'next_cursor',
      'contents' => $this->nextCursor
    ];

    if ($this->hasMore !== null) {
      $parts[] = [
        'name' => 'has_more',
        'contents' => $this->hasMore ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->assets as $item) {
      $item->validate();
    }
  }
}
