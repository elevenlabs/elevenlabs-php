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
class BranchSyncStatus extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Latest automatic attempt to pull the synced branch's new versions in, run after each of them. Null when none has run since sync was turned on.
   */
  #[JsonProperty('last_attempt')]
  public ?\ElevenLabs\Types\AutoRebaseAttempt $lastAttempt;

  /**
   * @param array{
   *   lastAttempt?: ?\ElevenLabs\Types\AutoRebaseAttempt,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->lastAttempt = $values['lastAttempt'] ?? null;

    if (array_key_exists('lastAttempt', $values)) {
      $this->_dirtyFields['last_attempt'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->lastAttempt !== null) {
      $parts[] = [
        'name' => 'last_attempt',
        'contents' => json_encode($this->lastAttempt),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->lastAttempt?->validate();
  }
}
