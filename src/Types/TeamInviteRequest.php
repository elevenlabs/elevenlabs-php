<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

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
class TeamInviteRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The email address to invite.
   */
  #[JsonProperty('email', required: true)]
  public string $email;

  /**
   * @var ?value-of<\ElevenLabs\Types\TeamInviteRequestRole>
   * The role the invitee joins with: 'workspace_admin' or 'workspace_member'.
   */
  #[JsonProperty('role')]
  public ?string $role;

  /**
   * @param array{
   *   email: string,
   *   role?: ?value-of<\ElevenLabs\Types\TeamInviteRequestRole>,
   * } $values
   */
  public function __construct(array $values)
  {
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
