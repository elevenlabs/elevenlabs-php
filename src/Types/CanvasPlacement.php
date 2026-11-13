<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * Defines asset positioning and transformation on canvas.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class CanvasPlacement extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('x_relative')]
  public ?float $xRelative;

  #[JsonProperty('y_relative')]
  public ?float $yRelative;

  #[JsonProperty('scale_x')]
  public ?float $scaleX;

  #[JsonProperty('scale_y')]
  public ?float $scaleY;

  #[JsonProperty('pivot_x')]
  public ?float $pivotX;

  #[JsonProperty('pivot_y')]
  public ?float $pivotY;

  #[JsonProperty('skew_x')]
  public ?float $skewX;

  #[JsonProperty('skew_y')]
  public ?float $skewY;

  #[JsonProperty('crop_top')]
  public ?float $cropTop;

  #[JsonProperty('crop_right')]
  public ?float $cropRight;

  #[JsonProperty('crop_bottom')]
  public ?float $cropBottom;

  #[JsonProperty('crop_left')]
  public ?float $cropLeft;

  #[JsonProperty('flip_x')]
  public ?bool $flipX;

  #[JsonProperty('flip_y')]
  public ?bool $flipY;

  /**
   * @param array{
   *   xRelative?: ?float,
   *   yRelative?: ?float,
   *   scaleX?: ?float,
   *   scaleY?: ?float,
   *   pivotX?: ?float,
   *   pivotY?: ?float,
   *   skewX?: ?float,
   *   skewY?: ?float,
   *   cropTop?: ?float,
   *   cropRight?: ?float,
   *   cropBottom?: ?float,
   *   cropLeft?: ?float,
   *   flipX?: ?bool,
   *   flipY?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->xRelative = $values['xRelative'] ?? null;
    $this->yRelative = $values['yRelative'] ?? null;
    $this->scaleX = $values['scaleX'] ?? null;
    $this->scaleY = $values['scaleY'] ?? null;
    $this->pivotX = $values['pivotX'] ?? null;
    $this->pivotY = $values['pivotY'] ?? null;
    $this->skewX = $values['skewX'] ?? null;
    $this->skewY = $values['skewY'] ?? null;
    $this->cropTop = $values['cropTop'] ?? null;
    $this->cropRight = $values['cropRight'] ?? null;
    $this->cropBottom = $values['cropBottom'] ?? null;
    $this->cropLeft = $values['cropLeft'] ?? null;
    $this->flipX = $values['flipX'] ?? null;
    $this->flipY = $values['flipY'] ?? null;

    if (array_key_exists('xRelative', $values)) {
      $this->_dirtyFields['x_relative'] = true;
    }
    if (array_key_exists('yRelative', $values)) {
      $this->_dirtyFields['y_relative'] = true;
    }
    if (array_key_exists('scaleX', $values)) {
      $this->_dirtyFields['scale_x'] = true;
    }
    if (array_key_exists('scaleY', $values)) {
      $this->_dirtyFields['scale_y'] = true;
    }
    if (array_key_exists('pivotX', $values)) {
      $this->_dirtyFields['pivot_x'] = true;
    }
    if (array_key_exists('pivotY', $values)) {
      $this->_dirtyFields['pivot_y'] = true;
    }
    if (array_key_exists('skewX', $values)) {
      $this->_dirtyFields['skew_x'] = true;
    }
    if (array_key_exists('skewY', $values)) {
      $this->_dirtyFields['skew_y'] = true;
    }
    if (array_key_exists('cropTop', $values)) {
      $this->_dirtyFields['crop_top'] = true;
    }
    if (array_key_exists('cropRight', $values)) {
      $this->_dirtyFields['crop_right'] = true;
    }
    if (array_key_exists('cropBottom', $values)) {
      $this->_dirtyFields['crop_bottom'] = true;
    }
    if (array_key_exists('cropLeft', $values)) {
      $this->_dirtyFields['crop_left'] = true;
    }
    if (array_key_exists('flipX', $values)) {
      $this->_dirtyFields['flip_x'] = true;
    }
    if (array_key_exists('flipY', $values)) {
      $this->_dirtyFields['flip_y'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->xRelative !== null) {
      $parts[] = [
        'name' => 'x_relative',
        'contents' => (string) $this->xRelative
      ];
    }

    if ($this->yRelative !== null) {
      $parts[] = [
        'name' => 'y_relative',
        'contents' => (string) $this->yRelative
      ];
    }

    if ($this->scaleX !== null) {
      $parts[] = [
        'name' => 'scale_x',
        'contents' => (string) $this->scaleX
      ];
    }

    if ($this->scaleY !== null) {
      $parts[] = [
        'name' => 'scale_y',
        'contents' => (string) $this->scaleY
      ];
    }

    if ($this->pivotX !== null) {
      $parts[] = [
        'name' => 'pivot_x',
        'contents' => (string) $this->pivotX
      ];
    }

    if ($this->pivotY !== null) {
      $parts[] = [
        'name' => 'pivot_y',
        'contents' => (string) $this->pivotY
      ];
    }

    if ($this->skewX !== null) {
      $parts[] = [
        'name' => 'skew_x',
        'contents' => (string) $this->skewX
      ];
    }

    if ($this->skewY !== null) {
      $parts[] = [
        'name' => 'skew_y',
        'contents' => (string) $this->skewY
      ];
    }

    if ($this->cropTop !== null) {
      $parts[] = [
        'name' => 'crop_top',
        'contents' => (string) $this->cropTop
      ];
    }

    if ($this->cropRight !== null) {
      $parts[] = [
        'name' => 'crop_right',
        'contents' => (string) $this->cropRight
      ];
    }

    if ($this->cropBottom !== null) {
      $parts[] = [
        'name' => 'crop_bottom',
        'contents' => (string) $this->cropBottom
      ];
    }

    if ($this->cropLeft !== null) {
      $parts[] = [
        'name' => 'crop_left',
        'contents' => (string) $this->cropLeft
      ];
    }

    if ($this->flipX !== null) {
      $parts[] = [
        'name' => 'flip_x',
        'contents' => $this->flipX ? 'true' : 'false'
      ];
    }

    if ($this->flipY !== null) {
      $parts[] = [
        'name' => 'flip_y',
        'contents' => $this->flipY ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
