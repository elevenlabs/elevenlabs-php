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
class KeepContextAlive extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\KeepContextAliveText>
   * An empty string. Ignored by the server but resets the inactivity timeout for the context.
   */
  #[JsonProperty('text', required: true)]
  public string $text;

  #[JsonProperty('context_id', required: true)]
  public string $contextId;

  /**
   * @param array{
   *   text: value-of<\ElevenLabs\Types\KeepContextAliveText>,
   *   contextId: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->text = $values['text'];
    $this->contextId = $values['contextId'];

    $this->_dirtyFields = [
      'text' => true,
      'context_id' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'text',
      'contents' => $this->text
    ];

    $parts[] = [
      'name' => 'context_id',
      'contents' => $this->contextId
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
