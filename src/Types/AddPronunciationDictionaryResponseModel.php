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
class AddPronunciationDictionaryResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The ID of the created pronunciation dictionary.
   */
  #[JsonProperty('id', required: true)]
  public string $id;

  /**
   * The name of the created pronunciation dictionary.
   */
  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * The user ID of the creator of the pronunciation dictionary.
   */
  #[JsonProperty('created_by', required: true)]
  public string $createdBy;

  /**
   * The creation time of the pronunciation dictionary in Unix timestamp.
   */
  #[JsonProperty('creation_time_unix', required: true)]
  public int $creationTimeUnix;

  /**
   * The ID of the created pronunciation dictionary version.
   */
  #[JsonProperty('version_id', required: true)]
  public string $versionId;

  /**
   * The number of rules in the version of the pronunciation dictionary.
   */
  #[JsonProperty('version_rules_num', required: true)]
  public int $versionRulesNum;

  /**
   * The description of the pronunciation dictionary.
   */
  #[JsonProperty('description')]
  public ?string $description;

  /**
   * @var ?value-of<\ElevenLabs\Types\AddPronunciationDictionaryResponseModelPermissionOnResource>
   * The permission on the resource of the pronunciation dictionary.
   */
  #[JsonProperty('permission_on_resource', required: true)]
  public ?string $permissionOnResource;

  /**
   * @param array{
   *   id: string,
   *   name: string,
   *   createdBy: string,
   *   creationTimeUnix: int,
   *   versionId: string,
   *   versionRulesNum: int,
   *   permissionOnResource: ?value-of<\ElevenLabs\Types\AddPronunciationDictionaryResponseModelPermissionOnResource>,
   *   description?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->id = $values['id'];
    $this->name = $values['name'];
    $this->createdBy = $values['createdBy'];
    $this->creationTimeUnix = $values['creationTimeUnix'];
    $this->versionId = $values['versionId'];
    $this->versionRulesNum = $values['versionRulesNum'];
    $this->description = $values['description'] ?? null;
    $this->permissionOnResource = $values['permissionOnResource'];

    $this->_dirtyFields = [
      'id' => true,
      'name' => true,
      'created_by' => true,
      'creation_time_unix' => true,
      'version_id' => true,
      'version_rules_num' => true,
      'permission_on_resource' => true
    ];
    if (array_key_exists('description', $values)) {
      $this->_dirtyFields['description'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'id',
      'contents' => $this->id
    ];

    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    $parts[] = [
      'name' => 'created_by',
      'contents' => $this->createdBy
    ];

    $parts[] = [
      'name' => 'creation_time_unix',
      'contents' => (string) $this->creationTimeUnix
    ];

    $parts[] = [
      'name' => 'version_id',
      'contents' => $this->versionId
    ];

    $parts[] = [
      'name' => 'version_rules_num',
      'contents' => (string) $this->versionRulesNum
    ];

    if ($this->description !== null) {
      $parts[] = [
        'name' => 'description',
        'contents' => $this->description
      ];
    }

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
