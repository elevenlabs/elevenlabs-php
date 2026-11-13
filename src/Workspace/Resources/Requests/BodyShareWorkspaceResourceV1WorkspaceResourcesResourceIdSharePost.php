<?php

declare(strict_types=1);

namespace ElevenLabs\Workspace\Resources\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyShareWorkspaceResourceV1WorkspaceResourcesResourceIdSharePost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Workspace\Resources\Types\BodyShareWorkspaceResourceV1WorkspaceResourcesResourceIdSharePostRole>
   * Role to grant to the target: one of 'admin', 'editor', 'commenter', or 'viewer'.
   */
  #[JsonProperty('role', required: true)]
  public string $role;

  /**
   * @var value-of<\ElevenLabs\Types\WorkspaceResourceType>
   * Resource types that can be shared in the workspace. The name always need to match the collection names
   */
  #[JsonProperty('resource_type', required: true)]
  public string $resourceType;

  /**
   * The email of the user or service account.
   */
  #[JsonProperty('user_email')]
  public ?string $userEmail;

  /**
   * The ID of the target group. Use 'default' to set the resource's baseline role — every workspace member receives this role unless they hold a higher one through a direct user grant, group membership, or workspace (service account) API key.
   */
  #[JsonProperty('group_id')]
  public ?string $groupId;

  /**
   * The ID of the target workspace (service account) API key. This is not the API key string itself that you pass in the header for authentication — it is the key's ID, which workspace admins can find under Developers → Service Accounts.
   */
  #[JsonProperty('workspace_api_key_id')]
  public ?string $workspaceApiKeyId;

  /**
   * @param array{
   *   role: value-of<\ElevenLabs\Workspace\Resources\Types\BodyShareWorkspaceResourceV1WorkspaceResourcesResourceIdSharePostRole>,
   *   resourceType: value-of<\ElevenLabs\Types\WorkspaceResourceType>,
   *   userEmail?: ?string,
   *   groupId?: ?string,
   *   workspaceApiKeyId?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->role = $values['role'];
    $this->resourceType = $values['resourceType'];
    $this->userEmail = $values['userEmail'] ?? null;
    $this->groupId = $values['groupId'] ?? null;
    $this->workspaceApiKeyId = $values['workspaceApiKeyId'] ?? null;

    $this->_dirtyFields = [
      'role' => true,
      'resource_type' => true
    ];
    if (array_key_exists('userEmail', $values)) {
      $this->_dirtyFields['user_email'] = true;
    }
    if (array_key_exists('groupId', $values)) {
      $this->_dirtyFields['group_id'] = true;
    }
    if (array_key_exists('workspaceApiKeyId', $values)) {
      $this->_dirtyFields['workspace_api_key_id'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'role',
      'contents' => $this->role
    ];

    $parts[] = [
      'name' => 'resource_type',
      'contents' => $this->resourceType
    ];

    if ($this->userEmail !== null) {
      $parts[] = [
        'name' => 'user_email',
        'contents' => $this->userEmail
      ];
    }

    if ($this->groupId !== null) {
      $parts[] = [
        'name' => 'group_id',
        'contents' => $this->groupId
      ];
    }

    if ($this->workspaceApiKeyId !== null) {
      $parts[] = [
        'name' => 'workspace_api_key_id',
        'contents' => $this->workspaceApiKeyId
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
