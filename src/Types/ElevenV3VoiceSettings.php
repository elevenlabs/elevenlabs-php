<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * Overrides for the voice's saved settings, applied to one generation.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ElevenV3VoiceSettings extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * How consistent the voice stays across generations. Lower values give more expressive, varied speech.
   */
  #[JsonProperty('stability')]
  public ?float $stability;

  /**
   * @param array{
   *   stability?: ?float,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->stability = $values['stability'] ?? null;

    if (array_key_exists('stability', $values)) {
      $this->_dirtyFields['stability'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->stability !== null) {
      $parts[] = [
        'name' => 'stability',
        'contents' => (string) $this->stability
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateNumber($this->stability, 'stability', min: 0, max: 1);
  }
}
