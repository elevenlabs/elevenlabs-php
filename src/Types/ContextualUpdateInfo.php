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
class ContextualUpdateInfo extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Client-supplied identifier grouping related contextual updates.
   */
  #[JsonProperty('context_id', required: true)]
  public string $contextId;

  /**
   * True when this contextual update has been replaced by a newer update with the same context_id.
   */
  #[JsonProperty('is_superseded')]
  public ?bool $isSuperseded;

  /**
   * @param array{
   *   contextId: string,
   *   isSuperseded?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->contextId = $values['contextId'];
    $this->isSuperseded = $values['isSuperseded'] ?? null;

    $this->_dirtyFields = [
      'context_id' => true
    ];
    if (array_key_exists('isSuperseded', $values)) {
      $this->_dirtyFields['is_superseded'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'context_id',
      'contents' => $this->contextId
    ];

    if ($this->isSuperseded !== null) {
      $parts[] = [
        'name' => 'is_superseded',
        'contents' => $this->isSuperseded ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
