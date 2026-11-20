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
class ReceptionTeamInviteResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The invited email address.
   */
  #[JsonProperty('email', required: true)]
  public string $email;

  /**
   * @var value-of<\ElevenLabs\Types\SeatType>
   * Seat types for workspace members.
   */
  #[JsonProperty('seat_type', required: true)]
  public string $seatType;

  /**
   * Email address of the member who sent the invite, if known.
   */
  #[JsonProperty('inviting_user_email')]
  public ?string $invitingUserEmail;

  /**
   * When the invite was sent, as a Unix timestamp in seconds.
   */
  #[JsonProperty('created_at_unix')]
  public ?int $createdAtUnix;

  /**
   * @param array{
   *   email: string,
   *   seatType: value-of<\ElevenLabs\Types\SeatType>,
   *   invitingUserEmail?: ?string,
   *   createdAtUnix?: ?int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->email = $values['email'];
    $this->seatType = $values['seatType'];
    $this->invitingUserEmail = $values['invitingUserEmail'] ?? null;
    $this->createdAtUnix = $values['createdAtUnix'] ?? null;

    $this->_dirtyFields = [
      'email' => true,
      'seat_type' => true
    ];
    if (array_key_exists('invitingUserEmail', $values)) {
      $this->_dirtyFields['inviting_user_email'] = true;
    }
    if (array_key_exists('createdAtUnix', $values)) {
      $this->_dirtyFields['created_at_unix'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'email',
      'contents' => $this->email
    ];

    $parts[] = [
      'name' => 'seat_type',
      'contents' => $this->seatType
    ];

    if ($this->invitingUserEmail !== null) {
      $parts[] = [
        'name' => 'inviting_user_email',
        'contents' => $this->invitingUserEmail
      ];
    }

    if ($this->createdAtUnix !== null) {
      $parts[] = [
        'name' => 'created_at_unix',
        'contents' => (string) $this->createdAtUnix
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
