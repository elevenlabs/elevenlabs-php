<?php

declare(strict_types=1);

namespace ElevenLabs\Workspace\Members\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class UpdateMemberRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Email of the target user.
   */
  #[JsonProperty('email', required: true)]
  public string $email;

  /**
   * Whether to lock or unlock the user account.
   */
  #[JsonProperty('is_locked')]
  public ?bool $isLocked;

  /**
   * @var ?value-of<\ElevenLabs\Types\SeatType>
   * The workspace role of the user. This is deprecated, use `workspace_seat_type` instead.
   */
  #[JsonProperty('workspace_role')]
  public ?string $workspaceRole;

  /**
   * @var ?value-of<\ElevenLabs\Types\SeatType>
   * The workspace seat type
   */
  #[JsonProperty('workspace_seat_type')]
  public ?string $workspaceSeatType;

  /**
   * When unlocking a user whose original seat type has no seats available but a basic seat is available, downgrade the user to a basic seat instead of failing.
   */
  #[JsonProperty('allow_downgrade_to_basic_seat')]
  public ?bool $allowDowngradeToBasicSeat;

  /**
   * @param array{
   *   email: string,
   *   isLocked?: ?bool,
   *   workspaceRole?: ?value-of<\ElevenLabs\Types\SeatType>,
   *   workspaceSeatType?: ?value-of<\ElevenLabs\Types\SeatType>,
   *   allowDowngradeToBasicSeat?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->email = $values['email'];
    $this->isLocked = $values['isLocked'] ?? null;
    $this->workspaceRole = $values['workspaceRole'] ?? null;
    $this->workspaceSeatType = $values['workspaceSeatType'] ?? null;
    $this->allowDowngradeToBasicSeat = $values['allowDowngradeToBasicSeat'] ?? null;

    $this->_dirtyFields = [
      'email' => true
    ];
    if (array_key_exists('isLocked', $values)) {
      $this->_dirtyFields['is_locked'] = true;
    }
    if (array_key_exists('workspaceRole', $values)) {
      $this->_dirtyFields['workspace_role'] = true;
    }
    if (array_key_exists('workspaceSeatType', $values)) {
      $this->_dirtyFields['workspace_seat_type'] = true;
    }
    if (array_key_exists('allowDowngradeToBasicSeat', $values)) {
      $this->_dirtyFields['allow_downgrade_to_basic_seat'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'email',
      'contents' => $this->email
    ];

    if ($this->isLocked !== null) {
      $parts[] = [
        'name' => 'is_locked',
        'contents' => $this->isLocked ? 'true' : 'false'
      ];
    }

    if ($this->workspaceRole !== null) {
      $parts[] = [
        'name' => 'workspace_role',
        'contents' => $this->workspaceRole
      ];
    }

    if ($this->workspaceSeatType !== null) {
      $parts[] = [
        'name' => 'workspace_seat_type',
        'contents' => $this->workspaceSeatType
      ];
    }

    if ($this->allowDowngradeToBasicSeat !== null) {
      $parts[] = [
        'name' => 'allow_downgrade_to_basic_seat',
        'contents' => $this->allowDowngradeToBasicSeat ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
