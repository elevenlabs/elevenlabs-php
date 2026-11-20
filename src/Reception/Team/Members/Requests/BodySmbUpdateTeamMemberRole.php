<?php

declare(strict_types=1);

namespace ElevenLabs\Reception\Team\Members\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodySmbUpdateTeamMemberRole extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The customer workspace a reseller's API key acts on.
   */
  public string $xiWorkspaceId;

  /**
   * @var value-of<\ElevenLabs\Reception\Team\Members\Types\BodySmbUpdateTeamMemberRoleRole>
   * The member's new role.
   */
  #[JsonProperty('role', required: true)]
  public string $role;

  /**
   * @param array{
   *   xiWorkspaceId: string,
   *   role: value-of<\ElevenLabs\Reception\Team\Members\Types\BodySmbUpdateTeamMemberRoleRole>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->xiWorkspaceId = $values['xiWorkspaceId'];
    $this->role = $values['role'];

    $this->_dirtyFields = [
      'role' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'role',
      'contents' => $this->role
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
