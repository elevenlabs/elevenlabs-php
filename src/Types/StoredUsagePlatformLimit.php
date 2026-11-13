<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * Platform limit with usage stored in Firestore. Example: credit usage tracked in Firestore.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class StoredUsagePlatformLimit extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('limit')]
  public ?int $limit;

  /**
   * Current usage
   */
  #[JsonProperty('usage')]
  public ?int $usage;

  /**
   * @param array{
   *   limit?: ?int,
   *   usage?: ?int,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->limit = $values['limit'] ?? null;
    $this->usage = $values['usage'] ?? null;

    if (array_key_exists('limit', $values)) {
      $this->_dirtyFields['limit'] = true;
    }
    if (array_key_exists('usage', $values)) {
      $this->_dirtyFields['usage'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->limit !== null) {
      $parts[] = [
        'name' => 'limit',
        'contents' => (string) $this->limit
      ];
    }

    if ($this->usage !== null) {
      $parts[] = [
        'name' => 'usage',
        'contents' => (string) $this->usage
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
