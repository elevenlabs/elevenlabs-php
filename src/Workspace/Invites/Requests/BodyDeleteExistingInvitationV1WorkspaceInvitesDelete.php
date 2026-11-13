<?php

declare(strict_types=1);

namespace ElevenLabs\Workspace\Invites\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyDeleteExistingInvitationV1WorkspaceInvitesDelete extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The email of the customer
   */
  #[JsonProperty('email', required: true)]
  public string $email;

  /**
   * @param array{
   *   email: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->email = $values['email'];

    $this->_dirtyFields = [
      'email' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'email',
      'contents' => $this->email
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
