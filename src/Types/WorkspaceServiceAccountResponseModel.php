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
class WorkspaceServiceAccountResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('service_account_user_id', required: true)]
  public string $serviceAccountUserId;

  #[JsonProperty('name', required: true)]
  public string $name;

  #[JsonProperty('created_at_unix')]
  public ?int $createdAtUnix;

  /**
   * @var \ElevenLabs\Types\WorkspaceApiKeyResponseModel[]
   */
  #[
    JsonProperty('api-keys', required: true),
    ArrayType([\ElevenLabs\Types\WorkspaceApiKeyResponseModel::class])
  ]
  public array $apiKeys;

  /**
   * @var \ElevenLabs\Types\DefaultSharingGroupResponseModel[]|null
   */
  #[
    JsonProperty('default_sharing_groups'),
    ArrayType([\ElevenLabs\Types\DefaultSharingGroupResponseModel::class])
  ]
  public ?array $defaultSharingGroups;

  /**
   * @param array{
   *   serviceAccountUserId: string,
   *   name: string,
   *   apiKeys: \ElevenLabs\Types\WorkspaceApiKeyResponseModel[],
   *   createdAtUnix?: ?int,
   *   defaultSharingGroups?: \ElevenLabs\Types\DefaultSharingGroupResponseModel[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->serviceAccountUserId = $values['serviceAccountUserId'];
    $this->name = $values['name'];
    $this->createdAtUnix = $values['createdAtUnix'] ?? null;
    $this->apiKeys = $values['apiKeys'];
    $this->defaultSharingGroups = $values['defaultSharingGroups'] ?? null;

    $this->_dirtyFields = [
      'service_account_user_id' => true,
      'name' => true,
      'api-keys' => true
    ];
    if (array_key_exists('createdAtUnix', $values)) {
      $this->_dirtyFields['created_at_unix'] = true;
    }
    if (array_key_exists('defaultSharingGroups', $values)) {
      $this->_dirtyFields['default_sharing_groups'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'service_account_user_id',
      'contents' => $this->serviceAccountUserId
    ];

    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    if ($this->createdAtUnix !== null) {
      $parts[] = [
        'name' => 'created_at_unix',
        'contents' => (string) $this->createdAtUnix
      ];
    }

    $parts[] = [
      'name' => 'api-keys',
      'contents' => json_encode($this->apiKeys),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->defaultSharingGroups !== null) {
      $parts[] = [
        'name' => 'default_sharing_groups',
        'contents' => json_encode($this->defaultSharingGroups),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->apiKeys as $item) {
      $item->validate();
    }
    foreach ($this->defaultSharingGroups ?? [] as $item) {
      $item->validate();
    }
  }
}
