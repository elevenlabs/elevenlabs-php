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
class UserVoiceCollectionResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The ID of the voice collection.
   */
  #[JsonProperty('collection_id', required: true)]
  public string $collectionId;

  /**
   * The title of the voice collection.
   */
  #[JsonProperty('title', required: true)]
  public string $title;

  /**
   * The icon of the voice collection.
   */
  #[JsonProperty('icon', required: true)]
  public string $icon;

  /**
   * @var value-of<\ElevenLabs\Types\UserVoiceCollectionResponseModelPermissionOnResource>
   * The caller's access role on the voice collection.
   */
  #[JsonProperty('permission_on_resource', required: true)]
  public string $permissionOnResource;

  /**
   * @param array{
   *   collectionId: string,
   *   title: string,
   *   icon: string,
   *   permissionOnResource: value-of<\ElevenLabs\Types\UserVoiceCollectionResponseModelPermissionOnResource>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->collectionId = $values['collectionId'];
    $this->title = $values['title'];
    $this->icon = $values['icon'];
    $this->permissionOnResource = $values['permissionOnResource'];

    $this->_dirtyFields = [
      'collection_id' => true,
      'title' => true,
      'icon' => true,
      'permission_on_resource' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'collection_id',
      'contents' => $this->collectionId
    ];

    $parts[] = [
      'name' => 'title',
      'contents' => $this->title
    ];

    $parts[] = [
      'name' => 'icon',
      'contents' => $this->icon
    ];

    $parts[] = [
      'name' => 'permission_on_resource',
      'contents' => $this->permissionOnResource
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
