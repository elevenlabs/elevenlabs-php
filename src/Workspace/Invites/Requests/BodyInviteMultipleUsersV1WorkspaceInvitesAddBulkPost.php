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
class BodyInviteMultipleUsersV1WorkspaceInvitesAddBulkPost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var string[]
   * The email of the customer
   */
  #[JsonProperty('emails', required: true), ArrayType(['string'])]
  public array $emails;

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
   *   emails: string[],
   *   seatType?: ?value-of<\ElevenLabs\Types\SeatType>,
   *   groupIds?: string[]|null,
   *   usageLimit?: ?int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->emails = $values['emails'];
    $this->seatType = $values['seatType'] ?? null;
    $this->groupIds = $values['groupIds'] ?? null;
    $this->usageLimit = $values['usageLimit'] ?? null;

    $this->_dirtyFields = [
      'emails' => true
    ];
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
    foreach ($this->emails as $item) {
      $parts[] = [
        'name' => 'emails',
        'contents' => $item
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
