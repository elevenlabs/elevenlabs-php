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
class PronunciationDictionaryVersionResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('version_id', required: true)]
  public string $versionId;

  #[JsonProperty('version_rules_num', required: true)]
  public int $versionRulesNum;

  #[JsonProperty('pronunciation_dictionary_id', required: true)]
  public string $pronunciationDictionaryId;

  #[JsonProperty('dictionary_name', required: true)]
  public string $dictionaryName;

  #[JsonProperty('version_name', required: true)]
  public string $versionName;

  /**
   * @var ?value-of<\ElevenLabs\Types\PronunciationDictionaryVersionResponseModelPermissionOnResource>
   */
  #[JsonProperty('permission_on_resource', required: true)]
  public ?string $permissionOnResource;

  #[JsonProperty('created_by', required: true)]
  public string $createdBy;

  #[JsonProperty('creation_time_unix', required: true)]
  public int $creationTimeUnix;

  #[JsonProperty('archived_time_unix')]
  public ?int $archivedTimeUnix;

  /**
   * @param array{
   *   versionId: string,
   *   versionRulesNum: int,
   *   pronunciationDictionaryId: string,
   *   dictionaryName: string,
   *   versionName: string,
   *   permissionOnResource: ?value-of<\ElevenLabs\Types\PronunciationDictionaryVersionResponseModelPermissionOnResource>,
   *   createdBy: string,
   *   creationTimeUnix: int,
   *   archivedTimeUnix?: ?int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->versionId = $values['versionId'];
    $this->versionRulesNum = $values['versionRulesNum'];
    $this->pronunciationDictionaryId = $values['pronunciationDictionaryId'];
    $this->dictionaryName = $values['dictionaryName'];
    $this->versionName = $values['versionName'];
    $this->permissionOnResource = $values['permissionOnResource'];
    $this->createdBy = $values['createdBy'];
    $this->creationTimeUnix = $values['creationTimeUnix'];
    $this->archivedTimeUnix = $values['archivedTimeUnix'] ?? null;

    $this->_dirtyFields = [
      'version_id' => true,
      'version_rules_num' => true,
      'pronunciation_dictionary_id' => true,
      'dictionary_name' => true,
      'version_name' => true,
      'permission_on_resource' => true,
      'created_by' => true,
      'creation_time_unix' => true
    ];
    if (array_key_exists('archivedTimeUnix', $values)) {
      $this->_dirtyFields['archived_time_unix'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'version_id',
      'contents' => $this->versionId
    ];

    $parts[] = [
      'name' => 'version_rules_num',
      'contents' => (string) $this->versionRulesNum
    ];

    $parts[] = [
      'name' => 'pronunciation_dictionary_id',
      'contents' => $this->pronunciationDictionaryId
    ];

    $parts[] = [
      'name' => 'dictionary_name',
      'contents' => $this->dictionaryName
    ];

    $parts[] = [
      'name' => 'version_name',
      'contents' => $this->versionName
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

    return $parts;
  }

  public function validate(): void
  {
  }
}
