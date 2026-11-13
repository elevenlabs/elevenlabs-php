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
class FlushContext extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('context_id', required: true)]
  public string $contextId;

  #[JsonProperty('text')]
  public ?string $text;

  #[JsonProperty('flush', required: true)]
  public bool $flush;

  /**
   * @param array{
   *   contextId: string,
   *   flush: bool,
   *   text?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->contextId = $values['contextId'];
    $this->text = $values['text'] ?? null;
    $this->flush = $values['flush'];

    $this->_dirtyFields = [
      'context_id' => true,
      'flush' => true
    ];
    if (array_key_exists('text', $values)) {
      $this->_dirtyFields['text'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'context_id',
      'contents' => $this->contextId
    ];

    if ($this->text !== null) {
      $parts[] = [
        'name' => 'text',
        'contents' => $this->text
      ];
    }

    $parts[] = [
      'name' => 'flush',
      'contents' => $this->flush ? 'true' : 'false'
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
