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
class ReceptionTeamMemberResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The member's user ID.
   */
  #[JsonProperty('user_id', required: true)]
  public string $userId;

  /**
   * The member's email address.
   */
  #[JsonProperty('email', required: true)]
  public string $email;

  /**
   * The member's first name, if set.
   */
  #[JsonProperty('first_name')]
  public ?string $firstName;

  /**
   * Whether the member owns the workspace.
   */
  #[JsonProperty('is_owner', required: true)]
  public bool $isOwner;

  /**
   * Whether the member is a workspace admin.
   */
  #[JsonProperty('is_admin', required: true)]
  public bool $isAdmin;

  /**
   * URL of the member's profile picture, if set.
   */
  #[JsonProperty('picture_url')]
  public ?string $pictureUrl;

  /**
   * Whether the member's access to the workspace is suspended.
   */
  #[JsonProperty('is_suspended')]
  public ?bool $isSuspended;

  /**
   * @param array{
   *   userId: string,
   *   email: string,
   *   isOwner: bool,
   *   isAdmin: bool,
   *   firstName?: ?string,
   *   pictureUrl?: ?string,
   *   isSuspended?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->userId = $values['userId'];
    $this->email = $values['email'];
    $this->firstName = $values['firstName'] ?? null;
    $this->isOwner = $values['isOwner'];
    $this->isAdmin = $values['isAdmin'];
    $this->pictureUrl = $values['pictureUrl'] ?? null;
    $this->isSuspended = $values['isSuspended'] ?? null;

    $this->_dirtyFields = [
      'user_id' => true,
      'email' => true,
      'is_owner' => true,
      'is_admin' => true
    ];
    if (array_key_exists('firstName', $values)) {
      $this->_dirtyFields['first_name'] = true;
    }
    if (array_key_exists('pictureUrl', $values)) {
      $this->_dirtyFields['picture_url'] = true;
    }
    if (array_key_exists('isSuspended', $values)) {
      $this->_dirtyFields['is_suspended'] = true;
    }
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

    if ($this->firstName !== null) {
      $parts[] = [
        'name' => 'first_name',
        'contents' => $this->firstName
      ];
    }

    $parts[] = [
      'name' => 'is_owner',
      'contents' => $this->isOwner ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'is_admin',
      'contents' => $this->isAdmin ? 'true' : 'false'
    ];

    if ($this->pictureUrl !== null) {
      $parts[] = [
        'name' => 'picture_url',
        'contents' => $this->pictureUrl
      ];
    }

    if ($this->isSuspended !== null) {
      $parts[] = [
        'name' => 'is_suspended',
        'contents' => $this->isSuspended ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
