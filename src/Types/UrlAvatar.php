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
class UrlAvatar extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\UrlAvatarType>
   * The type of the avatar
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * The custom URL of the avatar
   */
  #[JsonProperty('custom_url')]
  public ?string $customUrl;

  /**
   * @param array{
   *   type?: ?value-of<\ElevenLabs\Types\UrlAvatarType>,
   *   customUrl?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->type = $values['type'] ?? 'url';
    $this->customUrl = $values['customUrl'] ?? null;

    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
    if (array_key_exists('customUrl', $values)) {
      $this->_dirtyFields['custom_url'] = true;
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

    if ($this->customUrl !== null) {
      $parts[] = [
        'name' => 'custom_url',
        'contents' => $this->customUrl
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
