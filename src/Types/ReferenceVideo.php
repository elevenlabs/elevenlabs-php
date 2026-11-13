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
class ReferenceVideo extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('generation_id')]
  public ?string $generationId;

  #[JsonProperty('content_asset_id')]
  public ?string $contentAssetId;

  #[JsonProperty('template_node_id')]
  public ?string $templateNodeId;

  #[JsonProperty('studio_clip')]
  public ?\ElevenLabs\Types\StudioClipLocator $studioClip;

  /**
   * @param array{
   *   generationId?: ?string,
   *   contentAssetId?: ?string,
   *   templateNodeId?: ?string,
   *   studioClip?: ?\ElevenLabs\Types\StudioClipLocator,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->generationId = $values['generationId'] ?? null;
    $this->contentAssetId = $values['contentAssetId'] ?? null;
    $this->templateNodeId = $values['templateNodeId'] ?? null;
    $this->studioClip = $values['studioClip'] ?? null;

    if (array_key_exists('generationId', $values)) {
      $this->_dirtyFields['generation_id'] = true;
    }
    if (array_key_exists('contentAssetId', $values)) {
      $this->_dirtyFields['content_asset_id'] = true;
    }
    if (array_key_exists('templateNodeId', $values)) {
      $this->_dirtyFields['template_node_id'] = true;
    }
    if (array_key_exists('studioClip', $values)) {
      $this->_dirtyFields['studio_clip'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->generationId !== null) {
      $parts[] = [
        'name' => 'generation_id',
        'contents' => $this->generationId
      ];
    }

    if ($this->contentAssetId !== null) {
      $parts[] = [
        'name' => 'content_asset_id',
        'contents' => $this->contentAssetId
      ];
    }

    if ($this->templateNodeId !== null) {
      $parts[] = [
        'name' => 'template_node_id',
        'contents' => $this->templateNodeId
      ];
    }

    if ($this->studioClip !== null) {
      $parts[] = [
        'name' => 'studio_clip',
        'contents' => json_encode($this->studioClip),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->studioClip?->validate();
  }
}
