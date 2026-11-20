<?php

declare(strict_types=1);

namespace ElevenLabs\Reception\Team\Invites\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class CreateTeamInviteRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The customer workspace a reseller's API key acts on.
   */
  public string $xiWorkspaceId;

  /**
   * The email address to invite.
   */
  #[JsonProperty('email', required: true)]
  public string $email;

  /**
   * @var ?value-of<\ElevenLabs\Reception\Team\Invites\Types\CreateTeamInviteRequestRole>
   * The role the invitee joins with: 'workspace_admin' or 'workspace_member'.
   */
  #[JsonProperty('role')]
  public ?string $role;

  /**
   * @param array{
   *   xiWorkspaceId: string,
   *   email: string,
   *   role?: ?value-of<\ElevenLabs\Reception\Team\Invites\Types\CreateTeamInviteRequestRole>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->xiWorkspaceId = $values['xiWorkspaceId'];
    $this->email = $values['email'];
    $this->role = $values['role'] ?? null;

    $this->_dirtyFields = [
      'email' => true
    ];
    if (array_key_exists('role', $values)) {
      $this->_dirtyFields['role'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'email',
      'contents' => $this->email
    ];

    if ($this->role !== null) {
      $parts[] = [
        'name' => 'role',
        'contents' => $this->role
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->email, 'email', minLength: 1, maxLength: 254);
  }
}
