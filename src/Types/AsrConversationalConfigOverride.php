<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class AsrConversationalConfigOverride extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var string[]|null
   * Keywords to boost prediction probability for
   */
  #[JsonProperty('keywords'), ArrayType(['string'])]
  public ?array $keywords;

  /**
   * @param array{
   *   keywords?: string[]|null,
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
      foreach ($this->keywords ?? [] as $item) {
        $parts[] = [
          'name' => 'keywords',
          'contents' => $item
        ];
      }
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
