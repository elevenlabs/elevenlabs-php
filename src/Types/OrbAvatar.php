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
class OrbAvatar extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\OrbAvatarType>
   * The type of the avatar
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * The first color of the avatar
   */
  #[JsonProperty('color_1')]
  public ?string $color1;

  /**
   * The second color of the avatar
   */
  #[JsonProperty('color_2')]
  public ?string $color2;

  /**
   * @param array{
   *   type?: ?value-of<\ElevenLabs\Types\OrbAvatarType>,
   *   color1?: ?string,
   *   color2?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->type = $values['type'] ?? 'orb';
    $this->color1 = $values['color1'] ?? null;
    $this->color2 = $values['color2'] ?? null;

    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
    if (array_key_exists('color1', $values)) {
      $this->_dirtyFields['color_1'] = true;
    }
    if (array_key_exists('color2', $values)) {
      $this->_dirtyFields['color_2'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->type !== null) {
      $parts[] = [
        'name' => 'type',
        'contents' => $this->type
      ];
    }

    if ($this->color1 !== null) {
      $parts[] = [
        'name' => 'color_1',
        'contents' => $this->color1
      ];
    }

    if ($this->color2 !== null) {
      $parts[] = [
        'name' => 'color_2',
        'contents' => $this->color2
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
