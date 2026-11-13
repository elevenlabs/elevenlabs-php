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
class GetPronunciationDictionaryWithRulesResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The ID of the pronunciation dictionary.
   */
  #[JsonProperty('id', required: true)]
  public string $id;

  /**
   * The ID of the latest version of the pronunciation dictionary.
   */
  #[JsonProperty('latest_version_id', required: true)]
  public string $latestVersionId;

  /**
   * The number of rules in the latest version of the pronunciation dictionary.
   */
  #[JsonProperty('latest_version_rules_num', required: true)]
  public int $latestVersionRulesNum;

  /**
   * The name of the pronunciation dictionary.
   */
  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * @var ?value-of<\ElevenLabs\Types\GetPronunciationDictionaryWithRulesResponseModelPermissionOnResource>
   * The permission on the resource of the pronunciation dictionary.
   */
  #[JsonProperty('permission_on_resource', required: true)]
  public ?string $permissionOnResource;

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
   * The archive time of the pronunciation dictionary in Unix timestamp.
   */
  #[JsonProperty('archived_time_unix')]
  public ?int $archivedTimeUnix;

  /**
   * The description of the pronunciation dictionary.
   */
  #[JsonProperty('description')]
  public ?string $description;

  /**
   * @var \ElevenLabs\Types\GetPronunciationDictionaryWithRulesResponseModelRulesItem[]
   * The rules in the latest version of the pronunciation dictionary.
   */
  #[
    JsonProperty('rules', required: true),
    ArrayType([\ElevenLabs\Types\GetPronunciationDictionaryWithRulesResponseModelRulesItem::class])
  ]
  public array $rules;

  /**
   * @param array{
   *   id: string,
   *   latestVersionId: string,
   *   latestVersionRulesNum: int,
   *   name: string,
   *   permissionOnResource: ?value-of<\ElevenLabs\Types\GetPronunciationDictionaryWithRulesResponseModelPermissionOnResource>,
   *   createdBy: string,
   *   creationTimeUnix: int,
   *   rules: \ElevenLabs\Types\GetPronunciationDictionaryWithRulesResponseModelRulesItem[],
   *   archivedTimeUnix?: ?int,
   *   description?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->id = $values['id'];
    $this->latestVersionId = $values['latestVersionId'];
    $this->latestVersionRulesNum = $values['latestVersionRulesNum'];
    $this->name = $values['name'];
    $this->permissionOnResource = $values['permissionOnResource'];
    $this->createdBy = $values['createdBy'];
    $this->creationTimeUnix = $values['creationTimeUnix'];
    $this->archivedTimeUnix = $values['archivedTimeUnix'] ?? null;
    $this->description = $values['description'] ?? null;
    $this->rules = $values['rules'];

    $this->_dirtyFields = [
      'id' => true,
      'latest_version_id' => true,
      'latest_version_rules_num' => true,
      'name' => true,
      'permission_on_resource' => true,
      'created_by' => true,
      'creation_time_unix' => true,
      'rules' => true
    ];
    if (array_key_exists('archivedTimeUnix', $values)) {
      $this->_dirtyFields['archived_time_unix'] = true;
    }
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
      'name' => 'latest_version_id',
      'contents' => $this->latestVersionId
    ];

    $parts[] = [
      'name' => 'latest_version_rules_num',
      'contents' => (string) $this->latestVersionRulesNum
    ];

    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    $parts[] = [
      'name' => 'permission_on_resource',
      'contents' => $this->permissionOnResource
    ];

    $parts[] = [
      'name' => 'created_by',
      'contents' => $this->createdBy
    ];

    $parts[] = [
      'name' => 'creation_time_unix',
      'contents' => (string) $this->creationTimeUnix
    ];

    if ($this->archivedTimeUnix !== null) {
      $parts[] = [
        'name' => 'archived_time_unix',
        'contents' => (string) $this->archivedTimeUnix
      ];
    }

    if ($this->description !== null) {
      $parts[] = [
        'name' => 'description',
        'contents' => $this->description
      ];
    }

    $parts[] = [
      'name' => 'rules',
      'contents' => json_encode($this->rules),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
