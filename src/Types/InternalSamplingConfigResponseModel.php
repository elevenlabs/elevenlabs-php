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
class InternalSamplingConfigResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('focus')]
  public ?float $focus;

  #[JsonProperty('similarity')]
  public ?float $similarity;

  #[JsonProperty('stability')]
  public ?float $stability;

  /**
   * @param array{
   *   focus?: ?float,
   *   similarity?: ?float,
   *   stability?: ?float,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->focus = $values['focus'] ?? null;
    $this->similarity = $values['similarity'] ?? null;
    $this->stability = $values['stability'] ?? null;

    if (array_key_exists('focus', $values)) {
      $this->_dirtyFields['focus'] = true;
    }
    if (array_key_exists('similarity', $values)) {
      $this->_dirtyFields['similarity'] = true;
    }
    if (array_key_exists('stability', $values)) {
      $this->_dirtyFields['stability'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->focus !== null) {
      $parts[] = [
        'name' => 'focus',
        'contents' => (string) $this->focus
      ];
    }

    if ($this->similarity !== null) {
      $parts[] = [
        'name' => 'similarity',
        'contents' => (string) $this->similarity
      ];
    }

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
    Validator::validateNumber($this->focus, 'focus', min: 0, max: 1);
    Validator::validateNumber($this->similarity, 'similarity', min: 0, max: 1);
    Validator::validateNumber($this->stability, 'stability', min: 0, max: 1);
  }
}
