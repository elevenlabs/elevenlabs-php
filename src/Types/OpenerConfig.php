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
class OpenerConfig extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\Llm>
   */
  #[JsonProperty('llm', required: true)]
  public string $llm;

  /**
   * @param array{
   *   llm: value-of<\ElevenLabs\Types\Llm>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->llm = $values['llm'];

    $this->_dirtyFields = [
      'llm' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'llm',
      'contents' => $this->llm
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
