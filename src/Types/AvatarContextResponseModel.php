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
class AvatarContextResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The ID of the avatar.
   */
  #[JsonProperty('avatar_id')]
  public ?string $avatarId;

  /**
   * The ID of the avatar style.
   */
  #[JsonProperty('avatar_style_id')]
  public ?string $avatarStyleId;

  /**
   * The name of the avatar.
   */
  #[JsonProperty('avatar_name')]
  public ?string $avatarName;

  /**
   * The name of the avatar style.
   */
  #[JsonProperty('avatar_style_name')]
  public ?string $avatarStyleName;

  /**
   * @param array{
   *   avatarId?: ?string,
   *   avatarStyleId?: ?string,
   *   avatarName?: ?string,
   *   avatarStyleName?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->avatarId = $values['avatarId'] ?? null;
    $this->avatarStyleId = $values['avatarStyleId'] ?? null;
    $this->avatarName = $values['avatarName'] ?? null;
    $this->avatarStyleName = $values['avatarStyleName'] ?? null;

    if (array_key_exists('avatarId', $values)) {
      $this->_dirtyFields['avatar_id'] = true;
    }
    if (array_key_exists('avatarStyleId', $values)) {
      $this->_dirtyFields['avatar_style_id'] = true;
    }
    if (array_key_exists('avatarName', $values)) {
      $this->_dirtyFields['avatar_name'] = true;
    }
    if (array_key_exists('avatarStyleName', $values)) {
      $this->_dirtyFields['avatar_style_name'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->avatarId !== null) {
      $parts[] = [
        'name' => 'avatar_id',
        'contents' => $this->avatarId
      ];
    }

    if ($this->avatarStyleId !== null) {
      $parts[] = [
        'name' => 'avatar_style_id',
        'contents' => $this->avatarStyleId
      ];
    }

    if ($this->avatarName !== null) {
      $parts[] = [
        'name' => 'avatar_name',
        'contents' => $this->avatarName
      ];
    }

    if ($this->avatarStyleName !== null) {
      $parts[] = [
        'name' => 'avatar_style_name',
        'contents' => $this->avatarStyleName
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
