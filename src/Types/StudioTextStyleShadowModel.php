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
class StudioTextStyleShadowModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('enabled', required: true)]
  public bool $enabled;

  #[JsonProperty('color', required: true)]
  public string $color;

  #[JsonProperty('opacity', required: true)]
  public float $opacity;

  #[JsonProperty('blur', required: true)]
  public float $blur;

  #[JsonProperty('offset_x', required: true)]
  public float $offsetX;

  #[JsonProperty('offset_y', required: true)]
  public float $offsetY;

  /**
   * @param array{
   *   enabled: bool,
   *   color: string,
   *   opacity: float,
   *   blur: float,
   *   offsetX: float,
   *   offsetY: float,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->enabled = $values['enabled'];
    $this->color = $values['color'];
    $this->opacity = $values['opacity'];
    $this->blur = $values['blur'];
    $this->offsetX = $values['offsetX'];
    $this->offsetY = $values['offsetY'];

    $this->_dirtyFields = [
      'enabled' => true,
      'color' => true,
      'opacity' => true,
      'blur' => true,
      'offset_x' => true,
      'offset_y' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'enabled',
      'contents' => $this->enabled ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'color',
      'contents' => $this->color
    ];

    $parts[] = [
      'name' => 'opacity',
      'contents' => (string) $this->opacity
    ];

    $parts[] = [
      'name' => 'blur',
      'contents' => (string) $this->blur
    ];

    $parts[] = [
      'name' => 'offset_x',
      'contents' => (string) $this->offsetX
    ];

    $parts[] = [
      'name' => 'offset_y',
      'contents' => (string) $this->offsetY
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
