<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Core\Types\Union;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class WorkspaceGroupResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('name', required: true)]
  public string $name;

  #[JsonProperty('id', required: true)]
  public string $id;

  /**
   * @var string[]
   */
  #[JsonProperty('members', required: true), ArrayType(['string'])]
  public array $members;

  /**
   * @var array<value-of<\ElevenLabs\Types\WorkspaceGroupPermission>>|null
   */
  #[JsonProperty('permissions', required: true), ArrayType(['string'])]
  public ?array $permissions;

  #[JsonProperty('group_usage_limit'), Union('integer', 'string', 'null')]
  public int|string|null $groupUsageLimit;

  #[JsonProperty('group_pvc_limit'), Union('integer', 'string', 'null')]
  public int|string|null $groupPvcLimit;

  #[JsonProperty('group_concurrency_limit'), Union('integer', 'string', 'null')]
  public int|string|null $groupConcurrencyLimit;

  #[JsonProperty('group_dubbing_concurrency_limit'), Union('integer', 'string', 'null')]
  public int|string|null $groupDubbingConcurrencyLimit;

  #[JsonProperty('group_music_concurrency_limit'), Union('integer', 'string', 'null')]
  public int|string|null $groupMusicConcurrencyLimit;

  #[JsonProperty('character_count')]
  public ?int $characterCount;

  #[JsonProperty('is_scim_synced')]
  public ?bool $isScimSynced;

  #[JsonProperty('scim_group')]
  public ?\ElevenLabs\Types\ScimGroupResponseModel $scimGroup;

  #[JsonProperty('scim_frozen')]
  public ?bool $scimFrozen;

  /**
   * @param array{
   *   name: string,
   *   id: string,
   *   members: string[],
   *   permissions: array<value-of<\ElevenLabs\Types\WorkspaceGroupPermission>>|null,
   *   groupUsageLimit?: int|string|null,
   *   groupPvcLimit?: int|string|null,
   *   groupConcurrencyLimit?: int|string|null,
   *   groupDubbingConcurrencyLimit?: int|string|null,
   *   groupMusicConcurrencyLimit?: int|string|null,
   *   characterCount?: ?int,
   *   isScimSynced?: ?bool,
   *   scimGroup?: ?\ElevenLabs\Types\ScimGroupResponseModel,
   *   scimFrozen?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->name = $values['name'];
    $this->id = $values['id'];
    $this->members = $values['members'];
    $this->permissions = $values['permissions'];
    $this->groupUsageLimit = $values['groupUsageLimit'] ?? null;
    $this->groupPvcLimit = $values['groupPvcLimit'] ?? null;
    $this->groupConcurrencyLimit = $values['groupConcurrencyLimit'] ?? null;
    $this->groupDubbingConcurrencyLimit = $values['groupDubbingConcurrencyLimit'] ?? null;
    $this->groupMusicConcurrencyLimit = $values['groupMusicConcurrencyLimit'] ?? null;
    $this->characterCount = $values['characterCount'] ?? null;
    $this->isScimSynced = $values['isScimSynced'] ?? null;
    $this->scimGroup = $values['scimGroup'] ?? null;
    $this->scimFrozen = $values['scimFrozen'] ?? null;

    $this->_dirtyFields = [
      'name' => true,
      'id' => true,
      'members' => true,
      'permissions' => true
    ];
    if (array_key_exists('groupUsageLimit', $values)) {
      $this->_dirtyFields['group_usage_limit'] = true;
    }
    if (array_key_exists('groupPvcLimit', $values)) {
      $this->_dirtyFields['group_pvc_limit'] = true;
    }
    if (array_key_exists('groupConcurrencyLimit', $values)) {
      $this->_dirtyFields['group_concurrency_limit'] = true;
    }
    if (array_key_exists('groupDubbingConcurrencyLimit', $values)) {
      $this->_dirtyFields['group_dubbing_concurrency_limit'] = true;
    }
    if (array_key_exists('groupMusicConcurrencyLimit', $values)) {
      $this->_dirtyFields['group_music_concurrency_limit'] = true;
    }
    if (array_key_exists('characterCount', $values)) {
      $this->_dirtyFields['character_count'] = true;
    }
    if (array_key_exists('isScimSynced', $values)) {
      $this->_dirtyFields['is_scim_synced'] = true;
    }
    if (array_key_exists('scimGroup', $values)) {
      $this->_dirtyFields['scim_group'] = true;
    }
    if (array_key_exists('scimFrozen', $values)) {
      $this->_dirtyFields['scim_frozen'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    $parts[] = [
      'name' => 'id',
      'contents' => $this->id
    ];

    foreach ($this->members as $item) {
      $parts[] = [
        'name' => 'members',
        'contents' => $item
      ];
    }

    foreach ($this->permissions ?? [] as $item) {
      $parts[] = [
        'name' => 'permissions',
        'contents' => $item
      ];
    }

    if ($this->groupUsageLimit !== null) {
      $parts[] = [
        'name' => 'group_usage_limit',
        'contents' => json_encode($this->groupUsageLimit),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->groupPvcLimit !== null) {
      $parts[] = [
        'name' => 'group_pvc_limit',
        'contents' => json_encode($this->groupPvcLimit),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->groupConcurrencyLimit !== null) {
      $parts[] = [
        'name' => 'group_concurrency_limit',
        'contents' => json_encode($this->groupConcurrencyLimit),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->groupDubbingConcurrencyLimit !== null) {
      $parts[] = [
        'name' => 'group_dubbing_concurrency_limit',
        'contents' => json_encode($this->groupDubbingConcurrencyLimit),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->groupMusicConcurrencyLimit !== null) {
      $parts[] = [
        'name' => 'group_music_concurrency_limit',
        'contents' => json_encode($this->groupMusicConcurrencyLimit),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->characterCount !== null) {
      $parts[] = [
        'name' => 'character_count',
        'contents' => (string) $this->characterCount
      ];
    }

    if ($this->isScimSynced !== null) {
      $parts[] = [
        'name' => 'is_scim_synced',
        'contents' => $this->isScimSynced ? 'true' : 'false'
      ];
    }

    if ($this->scimGroup !== null) {
      $parts[] = [
        'name' => 'scim_group',
        'contents' => json_encode($this->scimGroup),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->scimFrozen !== null) {
      $parts[] = [
        'name' => 'scim_frozen',
        'contents' => $this->scimFrozen ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->scimGroup?->validate();
  }
}
