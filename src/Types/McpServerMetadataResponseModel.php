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
class McpServerMetadataResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('created_at', required: true)]
  public int $createdAt;

  #[JsonProperty('owner_user_id')]
  public ?string $ownerUserId;

  /**
   * @param array{
   *   createdAt: int,
   *   ownerUserId?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->createdAt = $values['createdAt'];
    $this->ownerUserId = $values['ownerUserId'] ?? null;

    $this->_dirtyFields = [
      'created_at' => true
    ];
    if (array_key_exists('ownerUserId', $values)) {
      $this->_dirtyFields['owner_user_id'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'created_at',
      'contents' => (string) $this->createdAt
    ];

    if ($this->ownerUserId !== null) {
      $parts[] = [
        'name' => 'owner_user_id',
        'contents' => $this->ownerUserId
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
