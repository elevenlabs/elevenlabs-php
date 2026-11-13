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
class ResourceAccessInfo extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Whether the user making the request is the creator of the agent
   */
  #[JsonProperty('is_creator', required: true)]
  public bool $isCreator;

  /**
   * Name of the agent's creator
   */
  #[JsonProperty('creator_name', required: true)]
  public string $creatorName;

  /**
   * Email of the agent's creator
   */
  #[JsonProperty('creator_email', required: true)]
  public string $creatorEmail;

  /**
   * @var value-of<\ElevenLabs\Types\ResourceAccessInfoRole>
   * The role of the user making the request
   */
  #[JsonProperty('role', required: true)]
  public string $role;

  /**
   * @var ?value-of<\ElevenLabs\Types\ResourceAccessInfoAnonymousAccessLevelOverride>
   * The access level for anonymous users. If None, the resource is not shared publicly.
   */
  #[JsonProperty('anonymous_access_level_override')]
  public ?string $anonymousAccessLevelOverride;

  /**
   * @var ?value-of<\ElevenLabs\Types\ResourceAccessInfoAccessSource>
   * Why the requesting user has access to this resource. 'creator' = caller is the owner. 'explicit' = caller (or one of their workspace groups) is listed in role_to_group_ids beyond the workspace-wide everyone group. 'workspace_default' = the workspace-wide everyone group is listed in role_to_group_ids (every non-anon workspace member, including admins, sees this resource). 'workspace_admin' = caller is a workspace admin and the admin seat is the `only` path to access; reserved for docs nobody else can see. Lets the UI disclose why an admin-bypass viewer sees a doc that wasn't explicitly shared with them.
   */
  #[JsonProperty('access_source')]
  public ?string $accessSource;

  /**
   * @param array{
   *   isCreator: bool,
   *   creatorName: string,
   *   creatorEmail: string,
   *   role: value-of<\ElevenLabs\Types\ResourceAccessInfoRole>,
   *   anonymousAccessLevelOverride?: ?value-of<\ElevenLabs\Types\ResourceAccessInfoAnonymousAccessLevelOverride>,
   *   accessSource?: ?value-of<\ElevenLabs\Types\ResourceAccessInfoAccessSource>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->isCreator = $values['isCreator'];
    $this->creatorName = $values['creatorName'];
    $this->creatorEmail = $values['creatorEmail'];
    $this->role = $values['role'];
    $this->anonymousAccessLevelOverride = $values['anonymousAccessLevelOverride'] ?? null;
    $this->accessSource = $values['accessSource'] ?? null;

    $this->_dirtyFields = [
      'is_creator' => true,
      'creator_name' => true,
      'creator_email' => true,
      'role' => true
    ];
    if (array_key_exists('anonymousAccessLevelOverride', $values)) {
      $this->_dirtyFields['anonymous_access_level_override'] = true;
    }
    if (array_key_exists('accessSource', $values)) {
      $this->_dirtyFields['access_source'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'is_creator',
      'contents' => $this->isCreator ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'creator_name',
      'contents' => $this->creatorName
    ];

    $parts[] = [
      'name' => 'creator_email',
      'contents' => $this->creatorEmail
    ];

    $parts[] = [
      'name' => 'role',
      'contents' => $this->role
    ];

    if ($this->anonymousAccessLevelOverride !== null) {
      $parts[] = [
        'name' => 'anonymous_access_level_override',
        'contents' => $this->anonymousAccessLevelOverride
      ];
    }

    if ($this->accessSource !== null) {
      $parts[] = [
        'name' => 'access_source',
        'contents' => $this->accessSource
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
