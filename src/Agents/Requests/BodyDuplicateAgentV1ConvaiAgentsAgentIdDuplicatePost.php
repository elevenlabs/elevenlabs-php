<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyDuplicateAgentV1ConvaiAgentsAgentIdDuplicatePost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * A name to make the agent easier to find
   */
  #[JsonProperty('name')]
  public ?string $name;

  /**
   * @param array{
   *   name?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->name = $values['name'] ?? null;

    if (array_key_exists('name', $values)) {
      $this->_dirtyFields['name'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->name !== null) {
      $parts[] = [
        'name' => 'name',
        'contents' => $this->name
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
