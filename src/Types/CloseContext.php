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
class CloseContext extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('context_id', required: true)]
  public string $contextId;

  #[JsonProperty('close_context', required: true)]
  public bool $closeContext;

  /**
   * @param array{
   *   contextId: string,
   *   closeContext: bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->contextId = $values['contextId'];
    $this->closeContext = $values['closeContext'];

    $this->_dirtyFields = [
      'context_id' => true,
      'close_context' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'context_id',
      'contents' => $this->contextId
    ];

    $parts[] = [
      'name' => 'close_context',
      'contents' => $this->closeContext ? 'true' : 'false'
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
