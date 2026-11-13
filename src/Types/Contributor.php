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
class Contributor extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('name', required: true)]
  public string $name;

  #[JsonProperty('role', required: true)]
  public string $role;

  #[JsonProperty('bio')]
  public ?string $bio;

  #[JsonProperty('profile_id')]
  public ?string $profileId;

  /**
   * @param array{
   *   name: string,
   *   role: string,
   *   bio?: ?string,
   *   profileId?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->name = $values['name'];
    $this->role = $values['role'];
    $this->bio = $values['bio'] ?? null;
    $this->profileId = $values['profileId'] ?? null;

    $this->_dirtyFields = [
      'name' => true,
      'role' => true
    ];
    if (array_key_exists('bio', $values)) {
      $this->_dirtyFields['bio'] = true;
    }
    if (array_key_exists('profileId', $values)) {
      $this->_dirtyFields['profile_id'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    $parts[] = [
      'name' => 'role',
      'contents' => $this->role
    ];

    if ($this->bio !== null) {
      $parts[] = [
        'name' => 'bio',
        'contents' => $this->bio
      ];
    }

    if ($this->profileId !== null) {
      $parts[] = [
        'name' => 'profile_id',
        'contents' => $this->profileId
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
