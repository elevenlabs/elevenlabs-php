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
class SendTextMulti extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('text', required: true)]
  public string $text;

  #[JsonProperty('context_id')]
  public ?string $contextId;

  #[JsonProperty('flush')]
  public ?bool $flush;

  /**
   * @param array{
   *   text: string,
   *   contextId?: ?string,
   *   flush?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->text = $values['text'];
    $this->contextId = $values['contextId'] ?? null;
    $this->flush = $values['flush'] ?? null;

    $this->_dirtyFields = [
      'text' => true
    ];
    if (array_key_exists('contextId', $values)) {
      $this->_dirtyFields['context_id'] = true;
    }
    if (array_key_exists('flush', $values)) {
      $this->_dirtyFields['flush'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'text',
      'contents' => $this->text
    ];

    if ($this->contextId !== null) {
      $parts[] = [
        'name' => 'context_id',
        'contents' => $this->contextId
      ];
    }

    if ($this->flush !== null) {
      $parts[] = [
        'name' => 'flush',
        'contents' => $this->flush ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
