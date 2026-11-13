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
class AsrConversationalConfigOverrideConfig extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Whether to allow overriding the keywords field.
   */
  #[JsonProperty('keywords')]
  public ?bool $keywords;

  /**
   * @param array{
   *   keywords?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->keywords = $values['keywords'] ?? null;

    if (array_key_exists('keywords', $values)) {
      $this->_dirtyFields['keywords'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->keywords !== null) {
      $parts[] = [
        'name' => 'keywords',
        'contents' => $this->keywords ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
