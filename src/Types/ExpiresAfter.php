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
class ExpiresAfter extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\ExpiresAfterAnchor>
   */
  #[JsonProperty('anchor')]
  public ?string $anchor;

  #[JsonProperty('seconds', required: true)]
  public int $seconds;

  /**
   * @param array{
   *   seconds: int,
   *   anchor?: ?value-of<\ElevenLabs\Types\ExpiresAfterAnchor>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->anchor = $values['anchor'] ?? 'created_at';
    $this->seconds = $values['seconds'];

    $this->_dirtyFields = [
      'seconds' => true
    ];
    if (array_key_exists('anchor', $values)) {
      $this->_dirtyFields['anchor'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->anchor !== null) {
      $parts[] = [
        'name' => 'anchor',
        'contents' => $this->anchor
      ];
    }

    $parts[] = [
      'name' => 'seconds',
      'contents' => (string) $this->seconds
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
