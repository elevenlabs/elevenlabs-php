<?php

declare(strict_types=1);

namespace ElevenLabs\Workspace\Invites\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class InviteUserRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The email of the customer
   */
  #[JsonProperty('email', required: true)]
  public string $email;

  /**
   * The workspace permission of the user. This is deprecated, use `seat_type` instead.
   */
  #[JsonProperty('workspace_permission')]
  public ?string $workspacePermission;

  /**
   * @var ?value-of<\ElevenLabs\Types\SeatType>
   * The seat type of the user
   */
  #[JsonProperty('seat_type')]
  public ?string $seatType;

  /**
   * @var string[]|null
   * The group ids of the user
   */
  #[JsonProperty('group_ids'), ArrayType(['string'])]
  public ?array $groupIds;

  /**
   * Monthly credit usage limit for the invitee. Omit or set to null for no custom cap.
   */
  #[JsonProperty('usage_limit')]
  public ?int $usageLimit;

  /**
   * @param array{
   *   email: string,
   *   workspacePermission?: ?string,
   *   seatType?: ?value-of<\ElevenLabs\Types\SeatType>,
   *   groupIds?: string[]|null,
   *   usageLimit?: ?int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->email = $values['email'];
    $this->workspacePermission = $values['workspacePermission'] ?? null;
    $this->seatType = $values['seatType'] ?? null;
    $this->groupIds = $values['groupIds'] ?? null;
    $this->usageLimit = $values['usageLimit'] ?? null;

    $this->_dirtyFields = [
      'email' => true
    ];
    if (array_key_exists('workspacePermission', $values)) {
      $this->_dirtyFields['workspace_permission'] = true;
    }
    if (array_key_exists('seatType', $values)) {
      $this->_dirtyFields['seat_type'] = true;
    }
    if (array_key_exists('groupIds', $values)) {
      $this->_dirtyFields['group_ids'] = true;
    }
    if (array_key_exists('usageLimit', $values)) {
      $this->_dirtyFields['usage_limit'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'email',
      'contents' => $this->email
    ];

    if ($this->workspacePermission !== null) {
      $parts[] = [
        'name' => 'workspace_permission',
        'contents' => $this->workspacePermission
      ];
    }

    if ($this->seatType !== null) {
      $parts[] = [
        'name' => 'seat_type',
        'contents' => $this->seatType
      ];
    }

    if ($this->groupIds !== null) {
      foreach ($this->groupIds ?? [] as $item) {
        $parts[] = [
          'name' => 'group_ids',
          'contents' => $item
        ];
      }
    }

    if ($this->usageLimit !== null) {
      $parts[] = [
        'name' => 'usage_limit',
        'contents' => (string) $this->usageLimit
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateNumber($this->usageLimit, 'usage_limit', min: 0);
  }
}
