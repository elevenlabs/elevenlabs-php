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
class DefaultSharingGroupConfig extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The ID of the group to share with
   */
  #[JsonProperty('group_id', required: true)]
  public string $groupId;

  /**
   * @var value-of<\ElevenLabs\Types\DefaultSharingGroupConfigPermissionLevel>
   * The permission level to grant to the group
   */
  #[JsonProperty('permission_level', required: true)]
  public string $permissionLevel;

  /**
   * @param array{
   *   groupId: string,
   *   permissionLevel: value-of<\ElevenLabs\Types\DefaultSharingGroupConfigPermissionLevel>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->groupId = $values['groupId'];
    $this->permissionLevel = $values['permissionLevel'];

    $this->_dirtyFields = [
      'group_id' => true,
      'permission_level' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'group_id',
      'contents' => $this->groupId
    ];

    $parts[] = [
      'name' => 'permission_level',
      'contents' => $this->permissionLevel
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
