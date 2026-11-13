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
class AssignableUserResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('user_id', required: true)]
  public string $userId;

  #[JsonProperty('email', required: true)]
  public string $email;

  #[JsonProperty('first_name', required: true)]
  public ?string $firstName;

  #[JsonProperty('is_service_account', required: true)]
  public bool $isServiceAccount;

  /**
   * Whether this workspace member currently has at least viewer access to the agent. Members without access are still returned so they can be surfaced (e.g. grayed out) and granted access before being assigned.
   */
  #[JsonProperty('has_access', required: true)]
  public bool $hasAccess;

  /**
   * @param array{
   *   userId: string,
   *   email: string,
   *   firstName: ?string,
   *   isServiceAccount: bool,
   *   hasAccess: bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->userId = $values['userId'];
    $this->email = $values['email'];
    $this->firstName = $values['firstName'];
    $this->isServiceAccount = $values['isServiceAccount'];
    $this->hasAccess = $values['hasAccess'];

    $this->_dirtyFields = [
      'user_id' => true,
      'email' => true,
      'first_name' => true,
      'is_service_account' => true,
      'has_access' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'user_id',
      'contents' => $this->userId
    ];

    $parts[] = [
      'name' => 'email',
      'contents' => $this->email
    ];

    $parts[] = [
      'name' => 'first_name',
      'contents' => $this->firstName
    ];

    $parts[] = [
      'name' => 'is_service_account',
      'contents' => $this->isServiceAccount ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'has_access',
      'contents' => $this->hasAccess ? 'true' : 'false'
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
