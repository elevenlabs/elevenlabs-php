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
class DefaultSharingGroupResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('group', required: true)]
  public \ElevenLabs\Types\WorkspaceGroupResponseModel $group;

  /**
   * @var value-of<\ElevenLabs\Types\DefaultSharingGroupResponseModelPermissionLevel>
   * The permission level to grant to the group
   */
  #[JsonProperty('permission_level', required: true)]
  public string $permissionLevel;

  /**
   * @param array{
   *   group: \ElevenLabs\Types\WorkspaceGroupResponseModel,
   *   permissionLevel: value-of<\ElevenLabs\Types\DefaultSharingGroupResponseModelPermissionLevel>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->group = $values['group'];
    $this->permissionLevel = $values['permissionLevel'];

    $this->_dirtyFields = [
      'group' => true,
      'permission_level' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'group',
      'contents' => json_encode($this->group),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'permission_level',
      'contents' => $this->permissionLevel
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->group->validate();
  }
}
