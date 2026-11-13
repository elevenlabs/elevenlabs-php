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
class ToDialogueSettingsResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Determines how stable the voice is and the randomness between each generation. Lower values introduce broader emotional range for the voice. Higher values can result in a monotonous voice with limited emotion.
   */
  #[JsonProperty('stability')]
  public ?float $stability;

  /**
   * Determines how strongly the model is guided while generating. Higher values make the model adhere more closely to the voice, at the cost of variation. Not supported by every model.
   */
  #[JsonProperty('similarity')]
  public ?float $similarity;

  /**
   * Controls how closely the output matches your professional voice clone samples (0–1). Lower values sound more versatile, while higher values preserve more of the original voice characteristics. We recommend 0 for most use cases, but if you do run into issues 0.5 could be a good fallback. Applies only to professional voice clones fine-tuned for the selected v4 model.
   */
  #[JsonProperty('clone_strength')]
  public ?float $cloneStrength;

  /**
   * @param array{
   *   stability?: ?float,
   *   similarity?: ?float,
   *   cloneStrength?: ?float,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->stability = $values['stability'] ?? null;
    $this->similarity = $values['similarity'] ?? null;
    $this->cloneStrength = $values['cloneStrength'] ?? null;

    if (array_key_exists('stability', $values)) {
      $this->_dirtyFields['stability'] = true;
    }
    if (array_key_exists('similarity', $values)) {
      $this->_dirtyFields['similarity'] = true;
    }
    if (array_key_exists('cloneStrength', $values)) {
      $this->_dirtyFields['clone_strength'] = true;
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

    if ($this->similarity !== null) {
      $parts[] = [
        'name' => 'similarity',
        'contents' => (string) $this->similarity
      ];
    }

    if ($this->cloneStrength !== null) {
      $parts[] = [
        'name' => 'clone_strength',
        'contents' => (string) $this->cloneStrength
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateNumber($this->stability, 'stability', min: 0, max: 1);
    Validator::validateNumber($this->similarity, 'similarity', min: 0, max: 1);
    Validator::validateNumber($this->cloneStrength, 'clone_strength', min: 0, max: 1);
  }
}
