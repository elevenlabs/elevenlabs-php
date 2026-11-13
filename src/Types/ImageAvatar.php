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
class ImageAvatar extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\ImageAvatarType>
   * The type of the avatar
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * The URL of the avatar
   */
  #[JsonProperty('url')]
  public ?string $url;

  /**
   * @param array{
   *   type?: ?value-of<\ElevenLabs\Types\ImageAvatarType>,
   *   url?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->type = $values['type'] ?? 'image';
    $this->url = $values['url'] ?? null;

    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
    if (array_key_exists('url', $values)) {
      $this->_dirtyFields['url'] = true;
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

    if ($this->url !== null) {
      $parts[] = [
        'name' => 'url',
        'contents' => $this->url
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
