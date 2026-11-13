<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ResourceMetadataResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The ID of the resource.
   */
  #[JsonProperty('resource_id', required: true)]
  public string $resourceId;

  /**
   * The name of the resource, if available.
   */
  #[JsonProperty('resource_name', required: true)]
  public ?string $resourceName;

  /**
   * @var value-of<\ElevenLabs\Types\WorkspaceResourceType>
   * Resource types that can be shared in the workspace. The name always need to match the collection names
   */
  #[JsonProperty('resource_type', required: true)]
  public string $resourceType;

  /**
   * The ID of the user who created the resource.
   */
  #[JsonProperty('creator_user_id', required: true)]
  public ?string $creatorUserId;

  /**
   * @var ?value-of<\ElevenLabs\Types\ResourceMetadataResponseModelAnonymousAccessLevelOverride>
   * The access level for anonymous users. If None, the resource is not shared publicly.
   */
  #[JsonProperty('anonymous_access_level_override', required: true)]
  public ?string $anonymousAccessLevelOverride;

  /**
   * @var array<string, string[]>
   * A mapping of grant slots to group IDs. Keys are the preset access roles plus workspace custom-role ids ('role_...'). When the resource is shared with a user, the group id is the user's id.
   */
  #[JsonProperty('role_to_group_ids', required: true), ArrayType(['string' => ['string']])]
  public array $roleToGroupIds;

  /**
   * @var \ElevenLabs\Types\ShareOptionResponseModel[]
   * List of options for sharing the resource further in the workspace. These are users who don't have access to the resource yet.
   */
  #[
    JsonProperty('share_options', required: true),
    ArrayType([\ElevenLabs\Types\ShareOptionResponseModel::class])
  ]
  public array $shareOptions;

  /**
   * @param array{
   *   resourceId: string,
   *   resourceName: ?string,
   *   resourceType: value-of<\ElevenLabs\Types\WorkspaceResourceType>,
   *   creatorUserId: ?string,
   *   anonymousAccessLevelOverride: ?value-of<\ElevenLabs\Types\ResourceMetadataResponseModelAnonymousAccessLevelOverride>,
   *   roleToGroupIds: array<string, string[]>,
   *   shareOptions: \ElevenLabs\Types\ShareOptionResponseModel[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->resourceId = $values['resourceId'];
    $this->resourceName = $values['resourceName'];
    $this->resourceType = $values['resourceType'];
    $this->creatorUserId = $values['creatorUserId'];
    $this->anonymousAccessLevelOverride = $values['anonymousAccessLevelOverride'];
    $this->roleToGroupIds = $values['roleToGroupIds'];
    $this->shareOptions = $values['shareOptions'];

    $this->_dirtyFields = [
      'resource_id' => true,
      'resource_name' => true,
      'resource_type' => true,
      'creator_user_id' => true,
      'anonymous_access_level_override' => true,
      'role_to_group_ids' => true,
      'share_options' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'resource_id',
      'contents' => $this->resourceId
    ];

    $parts[] = [
      'name' => 'resource_name',
      'contents' => $this->resourceName
    ];

    $parts[] = [
      'name' => 'resource_type',
      'contents' => $this->resourceType
    ];

    $parts[] = [
      'name' => 'creator_user_id',
      'contents' => $this->creatorUserId
    ];

    $parts[] = [
      'name' => 'anonymous_access_level_override',
      'contents' => $this->anonymousAccessLevelOverride
    ];

    $parts[] = [
      'name' => 'role_to_group_ids',
      'contents' => json_encode($this->roleToGroupIds),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'share_options',
      'contents' => json_encode($this->shareOptions),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->shareOptions as $item) {
      $item->validate();
    }
  }
}
