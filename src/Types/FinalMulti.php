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
class FinalMulti extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Marks the end of the closing flush sequence.
   */
  #[JsonProperty('is_final', required: true)]
  public bool $isFinal;

  /**
   * Identifies which context this response belongs to. Only set on the multi-context endpoint; omitted (None) on the single-context endpoint.
   */
  #[JsonProperty('context_id')]
  public ?string $contextId;

  /**
   * @param array{
   *   isFinal: bool,
   *   contextId?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->isFinal = $values['isFinal'];
    $this->contextId = $values['contextId'] ?? null;

    $this->_dirtyFields = [
      'is_final' => true
    ];
    if (array_key_exists('contextId', $values)) {
      $this->_dirtyFields['context_id'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'is_final',
      'contents' => $this->isFinal ? 'true' : 'false'
    ];

    if ($this->contextId !== null) {
      $parts[] = [
        'name' => 'context_id',
        'contents' => $this->contextId
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
