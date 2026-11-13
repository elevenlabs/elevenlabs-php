<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * Platform limit with usage computed externally. Example: PVCs use the count_owned_pro_voices_in_billing_group function to compute the usage.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ComputedUsagePlatformLimit extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('limit')]
  public ?int $limit;

  /**
   * @param array{
   *   limit?: ?int,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->limit = $values['limit'] ?? null;

    if (array_key_exists('limit', $values)) {
      $this->_dirtyFields['limit'] = true;
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

    return $parts;
  }

  public function validate(): void
  {
  }
}
