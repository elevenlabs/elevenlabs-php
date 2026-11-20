<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class DubbingVoiceSettings extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * How strongly the dubbed speakers clone the source voices, 0 to 10.
   */
  #[JsonProperty('cloning_strength')]
  public ?int $cloningStrength;

  /**
   * @param array{
   *   cloningStrength?: ?int,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->cloningStrength = $values['cloningStrength'] ?? null;

    if (array_key_exists('cloningStrength', $values)) {
      $this->_dirtyFields['cloning_strength'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->cloningStrength !== null) {
      $parts[] = [
        'name' => 'cloning_strength',
        'contents' => (string) $this->cloningStrength
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateNumber($this->cloningStrength, 'cloning_strength', min: 0, max: 10);
  }
}
