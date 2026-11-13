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
class StudioTextStyleOutlineModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('enabled', required: true)]
  public bool $enabled;

  #[JsonProperty('color', required: true)]
  public string $color;

  #[JsonProperty('opacity', required: true)]
  public float $opacity;

  #[JsonProperty('width', required: true)]
  public float $width;

  /**
   * @param array{
   *   enabled: bool,
   *   color: string,
   *   opacity: float,
   *   width: float,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->enabled = $values['enabled'];
    $this->color = $values['color'];
    $this->opacity = $values['opacity'];
    $this->width = $values['width'];

    $this->_dirtyFields = [
      'enabled' => true,
      'color' => true,
      'opacity' => true,
      'width' => true
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
      'name' => 'width',
      'contents' => (string) $this->width
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
