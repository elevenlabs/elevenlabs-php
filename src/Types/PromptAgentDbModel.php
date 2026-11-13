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
class PromptAgentDbModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('tools')]
  public mixed $tools;

  /**
   * @param array{
   *   tools?: mixed,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->tools = $values['tools'] ?? null;

    if (array_key_exists('tools', $values)) {
      $this->_dirtyFields['tools'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->tools !== null) {
      $parts[] = [
        'name' => 'tools',
        'contents' => json_encode($this->tools),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
