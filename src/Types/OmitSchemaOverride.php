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
class OmitSchemaOverride extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\OmitSchemaOverrideSource>
   */
  #[JsonProperty('source')]
  public ?string $source;

  /**
   * @param array{
   *   source?: ?value-of<\ElevenLabs\Types\OmitSchemaOverrideSource>,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->source = $values['source'] ?? 'omit';

    if (array_key_exists('source', $values)) {
      $this->_dirtyFields['source'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->source !== null) {
      $parts[] = [
        'name' => 'source',
        'contents' => $this->source
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
