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
class BackupLlmDisabled extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\BackupLlmDisabledPreference>
   */
  #[JsonProperty('preference')]
  public ?string $preference;

  /**
   * @param array{
   *   preference?: ?value-of<\ElevenLabs\Types\BackupLlmDisabledPreference>,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->preference = $values['preference'] ?? 'disabled';

    if (array_key_exists('preference', $values)) {
      $this->_dirtyFields['preference'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->preference !== null) {
      $parts[] = [
        'name' => 'preference',
        'contents' => $this->preference
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
