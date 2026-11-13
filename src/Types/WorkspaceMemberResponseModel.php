<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * Public workspace member fields exposed via GET /v1/workspace/members.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class WorkspaceMemberResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The user ID of the workspace member.
   */
  #[JsonProperty('user_id', required: true)]
  public string $userId;

  /**
   * The email address of the workspace member.
   */
  #[JsonProperty('email', required: true)]
  public string $email;

  /**
   * The first name of the workspace member, if available.
   */
  #[JsonProperty('first_name', required: true)]
  public ?string $firstName;

  /**
   * @var ?value-of<\ElevenLabs\Types\SeatType>
   * The seat type (role) of the workspace member.
   */
  #[JsonProperty('seat_type', required: true)]
  public ?string $seatType;

  /**
   * Whether the member is the workspace owner.
   */
  #[JsonProperty('is_owner', required: true)]
  public bool $isOwner;

  /**
   * Whether the member's account is locked in this workspace.
   */
  #[JsonProperty('is_locked', required: true)]
  public bool $isLocked;

  /**
   * @param array{
   *   userId: string,
   *   email: string,
   *   firstName: ?string,
   *   seatType: ?value-of<\ElevenLabs\Types\SeatType>,
   *   isOwner: bool,
   *   isLocked: bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->userId = $values['userId'];
    $this->email = $values['email'];
    $this->firstName = $values['firstName'];
    $this->seatType = $values['seatType'];
    $this->isOwner = $values['isOwner'];
    $this->isLocked = $values['isLocked'];

    $this->_dirtyFields = [
      'user_id' => true,
      'email' => true,
      'first_name' => true,
      'seat_type' => true,
      'is_owner' => true,
      'is_locked' => true
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
      'name' => 'seat_type',
      'contents' => $this->seatType
    ];

    $parts[] = [
      'name' => 'is_owner',
      'contents' => $this->isOwner ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'is_locked',
      'contents' => $this->isLocked ? 'true' : 'false'
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
