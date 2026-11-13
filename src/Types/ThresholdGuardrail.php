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
class ThresholdGuardrail extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('is_enabled')]
  public ?bool $isEnabled;

  #[JsonProperty('threshold')]
  public ?float $threshold;

  /**
   * @param array{
   *   isEnabled?: ?bool,
   *   threshold?: ?float,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->isEnabled = $values['isEnabled'] ?? null;
    $this->threshold = $values['threshold'] ?? null;

    if (array_key_exists('isEnabled', $values)) {
      $this->_dirtyFields['is_enabled'] = true;
    }
    if (array_key_exists('threshold', $values)) {
      $this->_dirtyFields['threshold'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->isEnabled !== null) {
      $parts[] = [
        'name' => 'is_enabled',
        'contents' => $this->isEnabled ? 'true' : 'false'
      ];
    }

    if ($this->threshold !== null) {
      $parts[] = [
        'name' => 'threshold',
        'contents' => (string) $this->threshold
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateNumber($this->threshold, 'threshold', min: 0, max: 1);
  }
}
