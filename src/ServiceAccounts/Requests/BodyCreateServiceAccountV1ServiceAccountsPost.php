<?php

declare(strict_types=1);

namespace ElevenLabs\ServiceAccounts\Requests;

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
class BodyCreateServiceAccountV1ServiceAccountsPost extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * @var \ElevenLabs\Types\DefaultSharingGroupConfig[]|null
   * List of groups with their permission levels to share with by default. Each entry should specify a group_id and a permission_level (admin, editor, or viewer).
   */
  #[
    JsonProperty('default_sharing_groups'),
    ArrayType([\ElevenLabs\Types\DefaultSharingGroupConfig::class])
  ]
  public ?array $defaultSharingGroups;

  /**
   * @param array{
   *   name: string,
   *   defaultSharingGroups?: \ElevenLabs\Types\DefaultSharingGroupConfig[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->name = $values['name'];
    $this->defaultSharingGroups = $values['defaultSharingGroups'] ?? null;

    $this->_dirtyFields = [
      'name' => true
    ];
    if (array_key_exists('defaultSharingGroups', $values)) {
      $this->_dirtyFields['default_sharing_groups'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
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
    foreach ($this->defaultSharingGroups ?? [] as $item) {
      $item->validate();
    }
  }
}
